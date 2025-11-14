<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Public\InquiryController as PublicInquiryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\LoanApplicationController;
use App\Http\Controllers\Admin\PmesController;
use App\Http\Controllers\Admin\CreditScoreController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\UtilityController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\CooperativeController;
use App\Http\Controllers\Member\RequirementsController;
use App\Http\Controllers\Member\ServicesController;

// Public Pages
Route::get('/', fn() => Inertia::render('Home'))->name('home');
Route::get('about', fn() => Inertia::render('About'))->name('about');
Route::get('contact', fn() => Inertia::render('Contact'))->name('contact');
Route::get('services', fn() => Inertia::render('Services'))->name('services');
Route::get('membership', fn() => Inertia::render('Membership'))->name('membership');
Route::get('membership-step', fn() => Inertia::render('MembershipStep'))->name('membership-step');
Route::get('privacy-policy', fn() => Inertia::render('PrivacyPolicy'))->name('privacy-policy');
Route::get('terms-and-conditions', fn() => Inertia::render('TermsAndConditions'))->name('terms-and-conditions');
Route::get('loan', fn() => Inertia::render('Loan'))->name('loan');
Route::get('payment', fn() => Inertia::render('Payment'))->name('payment');
Route::get('office', fn() => Inertia::render('Office'))->name('office');
Route::get('products', fn() => Inertia::render('Products'))->name('products');
Route::post('/inquiries', [PublicInquiryController::class, 'store'])->name('public.inquiries.store');

// Authenticated Pages
Route::middleware(['auth', 'verified', 'prevent-back'])->group(function () {

  // Universal Dashboard (redirect to role-specific dashboards)
  Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
      'admin' => redirect()->route('admin.dashboard'),
      'member' => redirect()->route('member.dashboard'),
      default => abort(403),
    };
  })->name('dashboard');

  // ------------------
  // Admin Routes
  // ------------------
  Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('management')->name('management.')->group(function () {
      Route::resource('members', MemberController::class);
      Route::resource('inquiries', InquiryController::class);
      Route::resource('loans', LoanController::class);
      Route::resource('loanapplication', LoanApplicationController::class);
      Route::resource('pmes', PmesController::class);
      Route::resource('creditscoring', CreditScoreController::class);

    });

    Route::prefix('utility')->name('utility.')->group(function () {
      Route::get('calendar', [UtilityController::class, 'calendar'])->name('calendar');
      Route::get('calculator', [UtilityController::class, 'calculator'])->name('calculator');
      Route::get('reports', [UtilityController::class, 'reports'])->name('reports');
    });
  });

// ------------------
// Member Routes
// ------------------
Route::middleware('role:member')->prefix('member')->name('member.')->group(function () {
    Route::get('dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('cooperative')->name('cooperative.')->group(function () {
        Route::get('/account', [CooperativeController::class, 'account'])->name('account');
        Route::get('/policy', [CooperativeController::class, 'policy'])->name('policy');
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/loan-application', [ServicesController::class, 'loanApplication'])->name('loan-application');
        Route::get('/credit-scoring', [ServicesController::class, 'creditScoring'])->name('credit-scoring');
        Route::get('/loan-status', [ServicesController::class, 'loanStatus'])->name('loan-status');
    });

    Route::prefix('requirements')->name('requirements.')->group(function () {
        Route::get('/membership-form', [RequirementsController::class, 'membershipForm'])->name('membership-form');
        Route::get('/pmes', [RequirementsController::class, 'pmes'])->name('pmes');
    });
});

});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
