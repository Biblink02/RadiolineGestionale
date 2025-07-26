<?php

use App\Http\Controllers\AboutUsPageController;
use App\Http\Controllers\JubileePageController;
use App\Http\Controllers\ProposalsPageController;
use App\Http\Controllers\RadioRentPageController;
use App\Http\Controllers\PaymentsPageController;
use App\Http\Controllers\PrivacyPageController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ContactUsPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ServicesPageController;
use Illuminate\Support\Facades\Route;


Route::get('/pdf/{path}', [PdfController::class, 'getPdf'])->name('pdf');

Route::name('page.')->group(function () {
    Route::get('/', [HomePageController::class, 'index'])->name('home');
    Route::get('/about-us', [AboutUsPageController::class, 'index'])->name('about-us');
    Route::get('/proposals', [ProposalsPageController::class, 'index'])->name('proposals');
    Route::get('/payments', [PaymentsPageController::class, 'index'])->name('payments');
    Route::get('/jubilee-2025', [JubileePageController::class, 'index'])->name('jubilee');
    Route::get('/privacy-policy', [PrivacyPageController::class, 'index'])->name('privacy');
    Route::get('/radio-rent', [RadioRentPageController::class, 'index'])->name('radio-rent');
    Route::get('/contact-us', [ContactUsPageController::class, 'index'])->name('contact-us');
    Route::get('/services', [ServicesPageController::class, 'index'])->name('services');
});

Route::prefix('api')
    ->name('api.')
    ->group(function () {
        Route::post('request/contact-form', [ContactFormController::class, 'handleContactFormRequest'])
            ->name('request.contact-form');
    });
