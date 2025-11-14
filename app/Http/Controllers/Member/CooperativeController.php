<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CooperativeController extends Controller
{
  public function account(): Response
  {
    $user = Auth::user();
    $status = $user->member?->membership_status ?? 'none';

    return Inertia::render('member/cooperative/Account', [
      'status' => $status,
    ]);
  }
}
