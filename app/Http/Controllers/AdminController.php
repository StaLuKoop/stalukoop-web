<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
  public function dashboard()
  {
    return Inertia::render('admin/Dashboard');
  }

  public function manageMembers()
  {
    $members = Member::with('user')->get();
    return Inertia::render('admin/Members', compact('members'));
  }
}
