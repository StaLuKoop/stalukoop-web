<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
  public function store(Request $request)
  {
    $validated = $request->validate([
      'first_name' => 'required|string|max:100',
      'last_name'  => 'required|string|max:100',
      'email'      => 'required|email|max:100',
      'phone'      => 'required|string|max:20',
      'inquiry'    => 'required|string|max:255',
      'message'    => 'required|string',
    ]);

    Inquiry::create($validated);

    return back()->with('success', 'Your message has been sent!');
  }
}
