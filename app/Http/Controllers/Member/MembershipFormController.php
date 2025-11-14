<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MembershipPayment;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MembershipFormController extends Controller
{
  public function index()
  {
    $info = PersonalInfo::where('id', auth()->id())->first();

    return Inertia::render('Member/MembershipForm/Index', [
      'personalInfo' => $info
    ]);
  }

  public function create()
  {
    return Inertia::render('Member/MembershipForm/Create');
  }

  public function store(Request $request)
  {
    $validated = $request->all();

    PersonalInfo::updateOrCreate(
      ['id' => auth()->id()],
      $validated
    );

    return redirect()->route('member.membership.index')
      ->with('success', 'Membership form submitted.');
  }

  public function show(PersonalInfo $personalInfo)
  {
    return Inertia::render('Member/MembershipForm/Show', [
      'personalInfo' => $personalInfo
    ]);
  }

  public function edit(PersonalInfo $personalInfo)
  {
    return Inertia::render('Member/MembershipForm/Edit', [
      'personalInfo' => $personalInfo
    ]);
  }

  public function update(Request $request, PersonalInfo $personalInfo)
  {
    $validated = $request->all();

    $personalInfo->update($validated);

    return redirect()->back()->with('success', 'Membership form updated.');
  }

  public function destroy(PersonalInfo $personalInfo)
  {
    $personalInfo->delete();
    return redirect()->back()->with('success', 'Record deleted.');
  }
}
