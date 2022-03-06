<?php

use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\AdminAuthenticationController;
use App\Http\Controllers\Auth\AdminProfileController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('locale/{locale}', LocalizationController::class)->name('locale');

Route::get('/privacy-policy', [SiteController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-use', [SiteController::class, 'terms'])->name('terms');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::view('/contact', 'visitor.site.contact')->name('contact');
Route::put('/contact', [SiteController::class, 'contact'])->name('contact.post')->middleware('throttle:contact');
Route::get('/countries/{country}/states', [AnnouncementController::class, 'getStates'])->name('country.states');
Route::get('/borrow-money', [AnnouncementController::class, 'showBorrowMoneyForm'])->name('borrow.money');
Route::post('/borrow-money', [AnnouncementController::class, 'storeBorrowMoney'])->name('borrow.money.store');
Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha'])->name('reload-captcha');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthenticationController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthenticationController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthenticationController::class, 'destroy'])->name('logout');
        Route::get('/change-password', [AdminProfileController::class, 'showChangePasswordForm'])->name('change-password');
        Route::put('/change-password', [AdminProfileController::class, 'changePassword'])->name('change-password.update');
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::view('/', 'admin.index')->name('index');
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries');
        Route::get('/inquiries/{inquiry}/', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::delete('/inquiries/{inquiry}/destroy', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
        Route::get('/inquiries/mark-all/as-read', [InquiryController::class, 'markAllAsRead'])->name('inquiries.mark-all-as-read');
        Route::resource('settings', SettingController::class)->except(['create', 'store', 'destroy']);
        Route::resource('users', UserController::class)->except(['show']);
    });
});
