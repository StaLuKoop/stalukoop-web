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
    return Inertia::render('MembershipStep');  // This will render MembershipStep.vue
})->name('membership-step');


Route::get('privacy-policy', function () {
  return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::get('terms-of-service', function () {
  return Inertia::render('TermsOfService');
})->name('terms-of-service');

// Dashboard Route
Route::get('dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::group(['prefix' => 'admin',  'middleware' => ['auth',  'admin']], function () {

//   //Admin Dashboard
//   Route::controller(AdminDashboardController::class)->group(function () {
//     Route::get("/dashboard", 'index');
//   });

// });

// Route::group(['prefix' => 'home', 'middleware' => ['auth']], function () {
//   // User Routes
//   Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
// });

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
