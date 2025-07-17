<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ManagementController extends Controller
{
  public function members(): Response
  {
    return Inertia::render('admin/management/Members');
  }

  public function concerns(): Response
  {
    return Inertia::render('admin/management/Concerns');
  }
}
