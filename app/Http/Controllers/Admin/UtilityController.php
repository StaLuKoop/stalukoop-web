<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class UtilityController extends Controller
{
  public function calculator(): Response
  {
    return Inertia::render('admin/utility/Calculator');
  }

  public function calendar(): Response
  {
    return Inertia::render('admin/utility/Calendar');
  }

  public function reports(): Response
  {
    return Inertia::render('admin/utility/Reports');
  }
}
