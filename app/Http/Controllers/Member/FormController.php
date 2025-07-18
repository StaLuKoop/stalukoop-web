<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class FormController extends Controller
{
  public function memberForm(): Response
  {
    return Inertia::render('member/forms/MemberForm');
  }

  public function loanForm(): Response
  {
    $user = Auth::user();
    $status = $user->member?->membership_status ?? 'none';

    return Inertia::render('member/forms/LoanForm', [
      'status' => $status
    ]);
  }
}
