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
  public function index(Request $request)
  {
    $search = $request->input('search');

    $inquiries = Inquiry::when($search, function ($query, $search) {
      $query->where('first_name', 'like', "%{$search}%")
        ->orWhere('last_name', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%")
        ->orWhere('inquiry', 'like', "%{$search}%");
    })
      ->paginate(10)
      ->withQueryString();

    return Inertia::render('admin/management/inquiries/Index', [
      'inquiries' => $inquiries,
      'filters' => [
        'search' => $search,
      ],
      'meta' => [
        'links' => $inquiries->linkCollection(),
        'current_page' => $inquiries->currentPage(),
        'last_page' => $inquiries->lastPage(),
      ],
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
