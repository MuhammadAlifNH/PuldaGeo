<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\RoleCheck;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');



// web.php

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('facilities', FacilityController::class);
});




// web.php
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});



Route::prefix('admin')->middleware(['auth', RoleCheck::class.':admin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('admin')->middleware(['auth', RoleCheck::class.':admin'])->group(function () {
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
});

Route::prefix('admin')->middleware(['auth', RoleCheck::class.':admin'])->group(function () {
    Route::resource('facilities', App\Http\Controllers\Admin\FacilityController::class);
});


Route::prefix('user')->middleware(['auth', RoleCheck::class.':user'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
});