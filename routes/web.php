<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SitemapController;
use App\Http\Controllers\Admin\CityController;
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
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::post('/search/{country}/city', [HomeController::class, 'searchCity'])->name('search.city');
Route::get('locale/{locale}', LocalizationController::class)->name('locale');

Route::get('/privacy-policy', [SiteController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-use', [SiteController::class, 'terms'])->name('terms');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::view('/contact', 'visitor.site.contact')->name('contact');
Route::put('/contact', [SiteController::class, 'contact'])->name('contact.post')->middleware('throttle:contact');
Route::get('/countries/{country}/cities', [CountryController::class, 'cities'])->name('country.cities');
Route::get('/borrow-money', [AnnouncementController::class, 'showBorrowMoneyForm'])->name('borrow.money');
Route::post('/borrow-money', [AnnouncementController::class, 'storeBorrowMoney'])->name('borrow.money.store');
Route::get('/lend-money', [AnnouncementController::class, 'showLendMoneyForm'])->name('lend.money');
Route::post('/lend-money', [AnnouncementController::class, 'storeLendMoney'])->name('lend.money.store');
Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha'])->name('reload-captcha');

Route::get('/credit-calculator', [HomeController::class, 'creditCalculator'])->name('credit-calculator');
Route::get('/announcements/{category}', [HomeController::class, 'category'])->name('category');
Route::get('/announcement/{announcement:slug}', [HomeController::class, 'show'])->name('announcement.show');
Route::post('/announcement-comments/{announcement}/comment', [HomeController::class, 'comment'])->name('announcement.comment');
Route::post('/announcement-comments/{announcement}/comment/{comment}/reply', [HomeController::class, 'reply'])->name('announcement.comment.reply');

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
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}/update', [PageController::class, 'update'])->name('pages.update');
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('countries', CountryController::class)->except(['show']);
        Route::resource('cities', CityController::class)->except(['show']);
        Route::resource('announcements', AdminAnnouncementController::class)->except(['create', 'store', 'destroy', 'show']);
        Route::get('/generate-sitemap', SitemapController::class)->name('generate.sitemap');
    });
});

Route::get('/{country}/{city?}', [HomeController::class, 'country'])->name('country');
