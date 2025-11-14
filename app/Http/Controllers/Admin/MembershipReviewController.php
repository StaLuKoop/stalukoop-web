<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MembershipReviewController extends Controller
{
  public function index()
  {
    $pending = PersonalInfo::where('status', 'Pending')->get();

    return Inertia::render('Admin/MembershipReview/Index', [
      'applications' => $pending
    ]);
  }

  public function show(PersonalInfo $personalInfo)
  {
    return Inertia::render('Admin/MembershipReview/Show', [
      'application' => $personalInfo
    ]);
  }

  public function update(Request $request, PersonalInfo $personalInfo)
  {
    $personalInfo->update([
      'status' => $request->status,
      'admin_note' => $request->admin_note
    ]);

    return redirect()->back()->with('success', 'Membership review updated.');
  }
}
