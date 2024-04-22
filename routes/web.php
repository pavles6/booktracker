<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReadingController;
use App\Http\Controllers\JSONExportController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Authorization;
use Illuminate\Support\Facades\Route;

Route::get("/register", [RegisterController::class, "index"])
    ->name("register")
    ->middleware("guest");
Route::post("/register", [RegisterController::class, "store"])
    ->middleware("guest");

Route::get('/login', [LoginController::class, 'index'])->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware("guest");

Route::post('/logout', [LogoutController::class, 'store'])
    ->name('logout')
    ->middleware('auth');

Route::get('/logout', [LogoutController::class, 'index'])
    ->name('logout-page')
    ->middleware('auth');

Route::get('/', [BookController::class, 'index'])
    ->name('home');

Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin')
    ->middleware(Authorization::class);


Route::post("/books/{book}/mark-as-reading", [BookReadingController::class, "store"])
    ->name("books.mark-as-reading")
    ->middleware("auth");

Route::post("/books/{book}/unmark-as-reading", [BookReadingController::class, "destroy"])
    ->name("books.unmark-as-reading")
    ->middleware("auth");

Route::get('/export-json', [JSONExportController::class, 'export'])->name('export.json');
