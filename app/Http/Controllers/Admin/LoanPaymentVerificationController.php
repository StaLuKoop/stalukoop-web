<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanPayment;
use App\Models\MemberTransaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoanPaymentVerificationController extends Controller
{
  public function index()
  {
    return Inertia::render('Admin/PaymentVerification/Index', []);
  }

  public function update(Request $request, $id)
  {
    $type = $request->type;

    if ($type === 'loan') {
    } else {
    }

    return back()->with('success', 'Payment status updated.');
  }
}
