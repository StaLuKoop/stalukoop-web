<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoanManagementController extends Controller
{
  public function index()
  {
    $loans = LoanApplication::where('status', 'Approved')
      ->with(['personal', 'info'])
      ->get();

    return Inertia::render('Admin/LoanManagement/Index', [
      'loans' => $loans
    ]);
  }

  public function show(LoanApplication $loanApplication)
  {
    return Inertia::render('Admin/LoanManagement/Show', [
      'loan' => $loanApplication->load(['personal', 'info'])
    ]);
  }

  public function update(Request $request, LoanApplication $loanApplication)
  {
    // Example: mark loan as completed
    $loanApplication->update(['loan_status' => $request->loan_status]);

    return back()->with('success', 'Loan status updated.');
  }
}
