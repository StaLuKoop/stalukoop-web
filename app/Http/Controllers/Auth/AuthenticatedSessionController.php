<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
  public function store(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();

    // If not verified or verified for more than a certain time
    if (
      is_null($user->email_verified_at) ||
      $user->email_verified_at->lt(now()->subMinutes(1))
    ) {
      // Reset and resend verification
      $user->email_verified_at = null;
      $user->save();

      $user->sendEmailVerificationNotification();

      return redirect()->route('verification.notice');
    }

    // Proceed to the appropriate dashboard
    return redirect()->intended(match ($user->role) {
      'admin' => route('admin.dashboard'),
      'member' => route('member.dashboard'),
      default => '/',
    });
  }

  /**
   * Destroy an authenticated session.
   */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
