<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
  /**
   * Show the registration page.
   */
  public function create(): Response
  {
    return Inertia::render('auth/Register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      // User fields
      'name' => 'required|string|max:255',
      'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
      'password' => ['required', 'confirmed', Rules\Password::defaults()],

      // Member fields
      'cdv_number' => 'nullable|string|max:255',
      'date_of_birth' => 'nullable|date',
      'place_of_birth' => 'nullable|string|max:255',
      'gender' => 'nullable|in:male,female',
      'civil_status' => 'nullable|in:single,married,widow,separated',
      'religion' => 'nullable|string|max:255',
      'nationality' => 'nullable|string|max:255',
      'dependents' => 'nullable|integer|min:0',
      'present_address' => 'nullable|string',
      'permanent_address' => 'nullable|string',
      'mobile_no' => 'nullable|string|max:20',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => 'member', // explicitly set role
    ]);

    Member::create([
      'user_id' => $user->id,
      'cdv_number' => $request->cdv_number,
      'date_of_birth' => $request->date_of_birth,
      'place_of_birth' => $request->place_of_birth,
      'gender' => $request->gender,
      'civil_status' => $request->civil_status,
      'religion' => $request->religion,
      'nationality' => $request->nationality,
      'dependents' => $request->dependents,
      'present_address' => $request->present_address,
      'permanent_address' => $request->permanent_address,
      'mobile_no' => $request->mobile_no,
      // 'membership_status' and 'activity_status' default to 'pending' and 'active' respectively
    ]);

    event(new Registered($user));

    Auth::login($user);

    return to_route('member.dashboard');
  }
}
