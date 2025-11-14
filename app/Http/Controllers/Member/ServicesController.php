<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ServicesController extends Controller
{
  public function loanApplication(): Response
  {
    $user = Auth::user();
    $status = $user->member?->membership_status ?? 'none';

    return Inertia::render('member/services/LoanApplication', [
      'status' => $status,
    ]);
  }

  public function creditScoring(): Response
  {
    return Inertia::render('member/services/CreditScoring');
  }

  public function loanStatus(): Response
  {
    return Inertia::render('member/services/LoanStatus');
  }
}
