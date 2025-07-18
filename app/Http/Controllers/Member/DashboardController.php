<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
  public function index(): Response
  {
    $user = Auth::user();
    $status = $user->member?->membership_status ?? 'none';

    return Inertia::render('member/Dashboard', [
      'status' => $status,
    ]);
  }
}
