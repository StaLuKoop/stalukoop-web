<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
  public function index(): Response
  {
    return Inertia::render('member/cooperative/Account');
  }
}
