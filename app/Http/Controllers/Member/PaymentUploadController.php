<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\LoanPayment;
use App\Models\MemberTransaction;
use Illuminate\Http\Request;

class PaymentUploadController extends Controller
{
  public function store(Request $request)
  {
    $validated = $request->validate([
      'payment_id' => ['required', 'uuid'],
      'proof'      => ['required', 'file', 'mimes:jpg,png,jpeg,pdf', 'max:5120'],
      'type'       => ['required', 'string']
    ]);

    // Determine if payment is for loan or cooperative
    if ($validated['type'] === 'loan') {
      $payment = LoanPayment::findOrFail($validated['payment_id']);
    } else {
      $payment = MemberTransaction::findOrFail($validated['payment_id']);
    }

    // Upload proof
    $path = $request->file('proof')->store('payment_proofs', 'public');

    $payment->proof = $path;
    $payment->status = 'Pending Verification';
    $payment->save();

    return back()->with('success', 'Payment proof uploaded successfully.');
  }
}
