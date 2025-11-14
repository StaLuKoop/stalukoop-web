<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\LoanApplication;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoanStatusController extends Controller
{
  public function index()
  {
    $applications = LoanApplication::where('personal_info', auth()->id())
      ->with(['info', 'security', 'employment'])
      ->get();

    return Inertia::render('Member/LoanStatus/Index', [
      'applications' => $applications
    ]);
  }

  public function show(LoanApplication $loanApplication)
  {
    // Ensure member can access only their own loan
    if ($loanApplication->personal_info !== auth()->id()) {
      abort(403);
    }

    $loanApplication->load(['info', 'security', 'employment']);

    return Inertia::render('Member/LoanStatus/Show', [
      'loan' => $loanApplication
    ]);
  }

  public function update(Request $request, LoanApplication $loanApplication)
  {
    // Typically used for resubmitting or editing some parts
    return redirect()->back()->with('success', 'Loan status updated.');
  }

  public function destroy(LoanApplication $loanApplication)
  {
    // Members usually cannot delete loan applications once reviewed
    abort(403);
  }
}
