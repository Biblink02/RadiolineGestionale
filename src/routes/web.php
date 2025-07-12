<?php

use App\Http\Controllers\ClientCodeController;
use App\Http\Controllers\ContactUsPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ServicesPageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomePageController::class, 'index']);
Route::get('/services', [ServicesPageController::class, 'index']);
Route::get('/contact-us', [ContactUsPageController::class, 'index']);
Route::get('/pdf/{path}',[PdfController::class, 'getPdf'])->name('pdf');
Route::post('/api/request/client-code', [ClientCodeController::class, 'sendClientCode'])->name('client-code.request');


