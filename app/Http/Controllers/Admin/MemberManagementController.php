<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberManagementController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->input('search');

    $membersQuery = Member::with('user')
      ->when($search, function ($query, $search) {
        $query->whereHas('user', function ($q) use ($search) {
          $q->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
        });
      })
      ->select(
        'id',
        'user_id',
        'membership_status',
        'date_of_birth',
        'gender',
        'mobile_no'
      )
      ->latest();

    $membersPaginated = $membersQuery->paginate(10)->withQueryString();

    $members = $membersPaginated->map(function ($member) {
      return [
        'id' => $member->id,
        'name' => $member->user->name,
        'email' => $member->user->email,
        'status' => $member->membership_status,
        'date_of_birth' => $member->date_of_birth,
        'gender' => $member->gender,
        'mobile_no' => $member->mobile_no,
      ];
    });

    return Inertia::render('admin/management/members/Index', [
      'members' => $members,
      'meta' => [
        'links' => $membersPaginated->linkCollection(),
        'current_page' => $membersPaginated->currentPage(),
        'last_page' => $membersPaginated->lastPage(),
      ],
      'filters' => [
        'search' => $search,
      ],
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
