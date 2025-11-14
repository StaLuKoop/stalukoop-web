<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use App\Models\LoanApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreditScoringController extends Controller
{
  public function index()
  {
    $members = PersonalInfo::select('id', 'firstname', 'lastname', 'credit_score')->get();

    return Inertia::render('Admin/CreditScoring/Index', [
      'members' => $members
    ]);
  }

  public function show(PersonalInfo $personalInfo)
  {
    $applications = LoanApplication::where('personal_info', $personalInfo->id)->get();

    return Inertia::render('Admin/CreditScoring/Show', [
      'member' => $personalInfo,
      'applications' => $applications
    ]);
  }

  public function update(Request $request, PersonalInfo $personalInfo)
  {
    $personalInfo->update([
      'credit_score' => $request->credit_score
    ]);

    return back()->with('success', 'Credit score updated.');
  }
}
