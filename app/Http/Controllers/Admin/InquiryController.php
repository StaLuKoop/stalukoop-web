<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InquiryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $inquiries = Inquiry::get();

    return Inertia::render('admin/management/inquiries/Index', [
      'inquiries' => $inquiries
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Inquiry $inquiry)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Inquiry $inquiry)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Inquiry $inquiry)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Inquiry $inquiry)
  {
    //
  }
}
