<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RequirementsController extends Controller
{
  public function membershipForm(): Response
  {
    return Inertia::render('member/requirements/MembershipForm');
  }

  public function pmes(): Response
  {
    return Inertia::render('member/requirements/PMES');
  }
}
