<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\LoanApplication;
use App\Models\LoanInfo;
use App\Models\LoanSecurity;
use App\Models\LaEmploymentInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoanApplicationController extends Controller
{
  public function index()
  {
    $applications = LoanApplication::where('personal_info', auth()->id())->get();

    return Inertia::render('Member/LoanApplication/Index', [
      'applications' => $applications
    ]);
  }

  public function create()
  {
    return Inertia::render('Member/LoanApplication/Create');
  }

  public function store(Request $request)
  {
    $validated = $request->all();

    $loanInfo = LoanInfo::create($validated['loan_info']);
    $loanSecurity = LoanSecurity::create($validated['loan_security']);
    $employment = LaEmploymentInfo::create($validated['employment_info']);

    LoanApplication::create([
      'personal_info'   => auth()->id(),
      'loan_info'       => $loanInfo->id,
      'loan_security'   => $loanSecurity->id,
      'employment_info' => $employment->id,
    ]);

    return redirect()->route('member.loan-applications.index')
      ->with('success', 'Loan application submitted.');
  }

  public function show(LoanApplication $loanApplication)
  {
    return Inertia::render('Member/LoanApplication/Show', [
      'application' => $loanApplication->load(['info', 'security', 'employment'])
    ]);
  }

  public function edit(LoanApplication $loanApplication)
  {
    return Inertia::render('Member/LoanApplication/Edit', [
      'application' => $loanApplication
    ]);
  }

  public function update(Request $request, LoanApplication $loanApplication)
  {
    return redirect()->back()->with('success', 'Loan application updated.');
  }

  public function destroy(LoanApplication $loanApplication)
  {
    $loanApplication->delete();
    return redirect()->back()->with('success', 'Loan application removed.');
  }
}
