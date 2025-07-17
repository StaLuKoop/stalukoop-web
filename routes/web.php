<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth', 'verified', 'prevent-back'])->group(function () {
  Route::get('/admin/dashboard', function () {
    abort_unless(auth()->user()->role === 'admin', 403);
    return Inertia::render('admin/Dashboard');
  })->middleware(['auth', 'verified'])->name('admin.dashboard');

  Route::get('/member/dashboard', function () {
    abort_unless(auth()->user()->role === 'member', 403);
    return Inertia::render('member/Dashboard');
  })->middleware(['auth', 'verified'])->name('member.dashboard');

  Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
      return redirect()->route('admin.dashboard');
    }

    return redirect()->route('member.dashboard');
  })->name('dashboard');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
