<?php

use App\Http\Controllers\ClientCodeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/contact-us', [ContactUsController::class, 'index']);
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
