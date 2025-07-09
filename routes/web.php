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
})-> name('services');

Route::get('membership', function () {
  return Inertia::render('Membership');
})->name('membership');

Route::get('privacy-policy', function () {
  return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::get('terms-of-service', function () {
  return Inertia::render('TermsOfService');
})->name('terms-of-service');

Route::get('dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::group(['prefix' => 'admin',  'middleware' => ['auth',  'admin']], function () {

//   //Admin Dashboard
//   Route::controller(AdminDashboardController::class)->group(function () {
//     Route::get("/dashboard", 'index');
//   });
// });

// // Non-Administrative (Normal User) Only Routes
// Route::group(['prefix' => 'home',  'middleware' => ['auth']], function () {

//   //User Dashboard
//   Route::controller(UserDashboardController::class)->group(function () {
//     Route::get("/dashboard", 'index');
//   });
// });

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
