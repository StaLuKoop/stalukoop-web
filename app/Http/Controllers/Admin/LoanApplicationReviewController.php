<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoanApplicationReviewController extends Controller
{
  public function index()
  {
    $applications = LoanApplication::with(['personal', 'info', 'security', 'employment'])
      ->where('status', 'Pending')
      ->get();

    return Inertia::render('Admin/LoanApplicationReview/Index', [
      'applications' => $applications
    ]);
  }

  public function show(LoanApplication $loanApplication)
  {
    return Inertia::render('Admin/LoanApplicationReview/Show', [
      'application' => $loanApplication->load(['personal', 'info', 'security', 'employment'])
    ]);
  }

  public function update(Request $request, LoanApplication $loanApplication)
  {
    $loanApplication->update([
      'status' => $request->status,
      'admin_note' => $request->admin_note
    ]);

    return back()->with('success', 'Loan application decision saved.');
  }
}
