<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalInfoController extends Controller
{
  public function index()
  {
    $info = PersonalInfo::where('id', auth()->id())->first();

    return Inertia::render('Member/PersonalInfo/Index', [
      'personalInfo' => $info
    ]);
  }

  public function create()
  {
    return Inertia::render('Member/PersonalInfo/Create');
  }

  public function store(Request $request)
  {
    // will replace with FormRequest soon
    $validated = $request->all();

    PersonalInfo::create($validated);

    return redirect()->back()->with('success', 'Personal information saved.');
  }

  public function show(PersonalInfo $personalInfo)
  {
    return Inertia::render('Member/PersonalInfo/Show', [
      'personalInfo' => $personalInfo
    ]);
  }

  public function edit(PersonalInfo $personalInfo)
  {
    return Inertia::render('Member/PersonalInfo/Edit', [
      'personalInfo' => $personalInfo
    ]);
  }

  public function update(Request $request, PersonalInfo $personalInfo)
  {
    $validated = $request->all();

    $personalInfo->update($validated);

    return redirect()->back()->with('success', 'Personal information updated.');
  }

  public function destroy(PersonalInfo $personalInfo)
  {
    $personalInfo->delete();
    return redirect()->back()->with('success', 'Record removed.');
  }
}
