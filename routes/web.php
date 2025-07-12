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

// Route for Membership Page
Route::get('membership', function () {
  return Inertia::render('Membership');
})->name('membership');

// Route for Membership Step Page (for registration steps)
Route::get('membership-step', function () {
  return Inertia::render('MembershipStep');
})->name('membership-step');


Route::get('privacy-policy', function () {
  return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::get('terms-and-conditions', function () {
  return Inertia::render('TermsAndConditions');
})->name('terms-and-conditions');

// Define Routes for the Service Pages
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

// Dashboard Route
Route::get('dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// If needed, you can add admin and user-specific routes below
// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
//   // Admin Routes
//   Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
// });

// Route::group(['prefix' => 'home', 'middleware' => ['auth']], function () {
//   // User Routes
//   Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

// });

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
