<?php

use App\Http\Controllers\ClientCodeController;
use App\Http\Controllers\ContactUsPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ServicesPageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomePageController::class, 'index']);
Route::get('/services', [ServicesPageController::class, 'index']);
Route::get('/contact-us', [ContactUsPageController::class, 'index']);
Route::get('/pdf/{path}',[PdfController::class, 'getPdf'])->name('pdf');
Route::post('/api/request/client-code', [ClientCodeController::class, 'sendClientCode'])->name('client-code.request');








Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
