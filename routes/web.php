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

Route::get('Services', function () {
  return Inertia::render('Services');
})-> name('services');

Route::get('Membership', function () {
  return Inertia::render('Membership');
})->name('membership');

Route::get('dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
