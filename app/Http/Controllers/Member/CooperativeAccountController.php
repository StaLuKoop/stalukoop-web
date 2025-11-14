<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MemberTransaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CooperativeAccountController extends Controller
{
  public function index()
  {
    $transactions = MemberTransaction::where('user_id', auth()->id())
      ->orderByDesc('created_at')
      ->get();

    return Inertia::render('Member/CooperativeAccount/Index', [
      'transactions' => $transactions
    ]);
  }

  public function create()
  {
    return Inertia::render('Member/CooperativeAccount/Create');
  }

  public function store(Request $request)
  {
    $validated = $request->all();

    MemberTransaction::create([
      'user_id'   => auth()->id(),
      'amount'    => $validated['amount'],
      'mode'      => $validated['payment_mode'],
      'reference' => $validated['reference'],
      'proof'     => null, // will upload via PaymentUploadController
      'status'    => 'Pending Verification',
      'type'      => $validated['type'], // savings/share_capital
    ]);

    return redirect()->route('member.cooperative-account.index')
      ->with('success', 'Transaction submitted for verification.');
  }
}
