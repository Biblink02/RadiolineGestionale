<?php

use App\Http\Controllers\AboutUsPageController;
use App\Http\Controllers\JubileePageController;
use App\Http\Controllers\OfficesPageController;
use App\Http\Controllers\ProposalsPageController;
use App\Http\Controllers\RadioRentPageController;
use App\Http\Controllers\GalleryPageController;
use App\Http\Controllers\PaymentsPageController;
use App\Http\Controllers\PrivacyPageController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ContactUsPageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ServicesPageController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => implode('|', config('custom.lang.available'))],
], function () {
    Route::name('page.')->group(function () {
        Route::get('/', [HomePageController::class, 'index'])->name('home');
        Route::get('/about-us', [AboutUsPageController::class, 'index'])->name('about-us');
        Route::get('/proposals', [ProposalsPageController::class, 'index'])->name('proposals');
        Route::get('/payments', [PaymentsPageController::class, 'index'])->name('payments');
        Route::get('/jubilee-2025', [JubileePageController::class, 'index'])->name('jubilee-2025');
        Route::get('/privacy-policy', [PrivacyPageController::class, 'index'])->name('privacy-policy');
        Route::get('/radio-rent', [RadioRentPageController::class, 'index'])->name('radio-rent');
        Route::get('/contact-us', [ContactUsPageController::class, 'index'])->name('contact-us');
        Route::get('/services', [ServicesPageController::class, 'index'])->name('services');
        Route::get('/offices', [OfficesPageController::class, 'index'])->name('offices');
        Route::get('/gallery', [GalleryPageController::class, 'index'])->name('gallery');
    });
});

$locale = config('custom.lang.fallback', 'en');
Route::redirect('/', $locale . '');
Route::redirect('/about-us', $locale . '/about-us');
Route::redirect('/proposals', $locale . '/proposals');
Route::redirect('/payments', $locale . '/payments');
Route::redirect('/jubilee-2025', $locale . '/jubilee-2025');
Route::redirect('/privacy-policy', $locale . '/privacy-policy');
Route::redirect('/radio-rent', $locale . '/radio-rent');
Route::redirect('/contact-us', $locale . '/contact-us');
Route::redirect('/services', $locale . '/services');
Route::redirect('/offices', $locale . '/offices');
Route::redirect('/gallery', $locale . '/gallery');


Route::get('/pdf/{path}', [PdfController::class, 'getPdf'])->name('pdf');

Route::prefix('api')
    ->name('api.')
    ->group(function () {
        Route::post('request/contact-form', [ContactFormController::class, 'handleContactFormRequest'])
            ->name('request.contact-form');
    });
