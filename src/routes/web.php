<?php

use App\Http\Controllers\AboutUsPageController;
use App\Http\Controllers\ProposalsPageController;
use App\Http\Controllers\PaymentsPageController;
use App\Http\Controllers\ClientCodeController;
use App\Http\Controllers\ContactUsPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ServicesPageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomePageController::class, 'index'])->name('page.home');
Route::get('/about-us', [AboutUsPageController::class, 'index'])->name('page.about-us');
Route::get('/proposals', [ProposalsPageController::class, 'index'])->name('page.proposals');
Route::get('/payments', [PaymentsPageController::class, 'index'])->name('page.payments');
Route::get('/services', [ServicesPageController::class, 'index']);
Route::get('/contact-us', [ContactUsPageController::class, 'index']);
Route::get('/pdf/{path}',[PdfController::class, 'getPdf'])->name('pdf');
Route::post('/api/request/client-code', [ClientCodeController::class, 'sendClientCode'])->name('client-code.request');


