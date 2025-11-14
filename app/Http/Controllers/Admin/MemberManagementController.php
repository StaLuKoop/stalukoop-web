<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberManagementController extends Controller
{
  public function index()
  {
    $members = PersonalInfo::with('membershipPayment')->get();

    return Inertia::render('Admin/Members/Index', [
      'members' => $members
    ]);
  }

  public function show(PersonalInfo $personalInfo)
  {
    return Inertia::render('Admin/Members/Show', [
      'member' => $personalInfo->load([
        'parents.motherInfo',
        'parents.fatherInfo',
        'spouse',
        'contact',
        'govId',
        'expenses',
        'employment',
        'addresses.permanent',
        'addresses.present',
        'relative',
        'property.car',
        'property.house',
      ])
    ]);
  }

  public function update(Request $request, PersonalInfo $personalInfo)
  {
    // Example: update member status (Pending → Regular)
    $personalInfo->update($request->all());

    return back()->with('success', 'Member updated successfully.');
  }

  public function destroy(PersonalInfo $personalInfo)
  {
    $personalInfo->delete();

    return back()->with('success', 'Member record removed.');
  }
}
