<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
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
    return Inertia::render('member/forms/LoanForm');
  }
}
