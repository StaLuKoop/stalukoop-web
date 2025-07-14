<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Home');
})->name('home');

Route::get('about', function () {
  return Inertia::render('About');
})->name('about');

Route::get('contact', function () {
  return Inertia::render('Contact');
})->name('contact');

Route::get('services', function () {
  return Inertia::render('Services');
})->name('services');

Route::get('membership', function () {
  return Inertia::render('Membership');
})->name('membership');

Route::get('membership-step', function () {
  return Inertia::render('MembershipStep');
})->name('membership-step');

Route::get('privacy-policy', function () {
  return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::get('terms-and-conditions', function () {
  return Inertia::render('TermsAndConditions');
})->name('terms-and-conditions');

Route::get('loan', function () {
  return Inertia::render('Loan');
})->name('loan');

Route::get('payment', function () {
  return Inertia::render('Payment');
})->name('payment');

Route::get('office', function () {
  return Inertia::render('Office');
})->name('office');

Route::get('products', function () {
  return Inertia::render('Products');
})->name('products');

// Route::get('dashboard', function () {
//   return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
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
