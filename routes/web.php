<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// // Home page
// Route::get('/', function () {
//     return view('home');
// });


Route::get('/', function () {
    return view('home'); 
})->name('home');


// Cart page
Route::get('/cart', function () {
    return view('cart');
});

// Products page with category filter
Route::get('/products', function (Illuminate\Http\Request $request) {
    $category = $request->query('category');

    switch ($category) {
        case 'skincare': return view('skincare');
        case 'makeup': return view('makeup');
        case 'chocolates': return view('chocolates');
        case 'perfumes': return view('perfumes');
        default: return view('products');
    }
})->name('products');

// ---------------- Register & Login Routes ----------------
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------------- Dashboards ----------------
// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// User Dashboard
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');


// ---------------- Profile Management ----------------
// User Profile
Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
Route::post('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');

// Admin Profile
Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
Route::post('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
