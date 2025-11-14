<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ServicesController extends Controller
{
    /**
     * Show loan application page
     */
    public function loanApplication(): Response
    {
        $user = Auth::user();
        $status = $user->member?->membership_status ?? 'none'; // Get user membership status

        return Inertia::render('member/services/LoanApplication', [
            'status' => $status, // Pass status to the frontend
        ]);
    }

    /**
     * Show credit scoring page
     */
    public function creditScoring(): Response
    {
        $user = Auth::user();
        $status = $user->member?->membership_status ?? 'none'; // Get user membership status

        return Inertia::render('member/services/CreditScoring', [
            'status' => $status, // Pass status to the frontend
        ]);
    }

    /**
     * Show loan status page
     */
    public function loanStatus(): Response
    {
        $user = Auth::user();
        $status = $user->member?->membership_status ?? 'none'; // Get user membership status

        return Inertia::render('member/services/LoanStatus', [
            'status' => $status, // Pass status to the frontend
        ]);
    }
}

