<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ToolController extends Controller
{
  public function calendar(): Response
  {
    return Inertia::render('admin/tools/Calendar');
  }

  public function calculator(): Response
  {
    return Inertia::render('admin/tools/Calculator');
  }

  public function export(): Response
  {
    return Inertia::render('admin/tools/Export');
  }
}
