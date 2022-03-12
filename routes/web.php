<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\UserProfileController;
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
Route::get('/countries/{country}/states', [CountryController::class, 'states'])->name('country.states');
Route::get('/borrow-money', [AnnouncementController::class, 'showBorrowMoneyForm'])->name('borrow.money');
Route::post('/borrow-money', [AnnouncementController::class, 'storeBorrowMoney'])->name('borrow.money.store');
Route::get('/lend-money', [AnnouncementController::class, 'showLendMoneyForm'])->name('lend.money');
Route::post('/lend-money', [AnnouncementController::class, 'storeLendMoney'])->name('lend.money.store');
Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha'])->name('reload-captcha');

Route::get('/announcements/{announcement}/{slug?}', [HomeController::class, 'show'])->name('announcement.show');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('/change-password', [UserProfileController::class, 'showChangePasswordForm'])->name('change-password');
        Route::put('/change-password', [UserProfileController::class, 'changePassword'])->name('change-password.update');
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::view('/', 'admin.index')->name('index');
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries');
        Route::get('/inquiries/{inquiry}/', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::delete('/inquiries/{inquiry}/destroy', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
        Route::get('/inquiries/mark-all/as-read', [InquiryController::class, 'markAllAsRead'])->name('inquiries.mark-all-as-read');
        Route::resource('settings', SettingController::class)->except(['create', 'store', 'destroy']);
        Route::resource('users', UserController::class)->except(['show']);
    });
});
