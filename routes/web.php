<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return "Cache cleared successfully";
});

Route::get('key-gen', function () {
    Artisan::call('key:generate');
    return "encryption key generated successfully";
});

Route::get('migrate', function () {
    Artisan::call('migrate:fresh --seed');
    return "migration successfully";
});

Route::prefix('admin')->group(function () {
    
});

Route::get('/', [FrontController::class, 'index']);
Route::get('home', [FrontController::class, 'index'])->name('home');
Route::get('about-us', [FrontController::class, 'aboutUs'])->name('about-us');
Route::get('about-us/{id}', [FrontController::class, 'aboutUsType'])->name('about-us-type');
Route::get('contact-us', [FrontController::class, 'contactUs'])->name('contact-us');
Route::get('guyana-economy', [FrontController::class, 'guyanaEconomy'])->name('guyana-economy');

Route::prefix('membership')->name('membership.')->group(function () {
    Route::get('business-directory', [FrontController::class, 'membership_BusinessDirectory'])->name('business-directory');
    Route::get('member-benefits', [FrontController::class, 'membership_MemberBenefits'])->name('member-benefits');
});

Route::prefix('data')->name('data.')->group(function () {
    Route::get('national-budgets', [FrontController::class, 'data_NationalBudgets'])->name('national_budgets');
    Route::get('trade-data', [FrontController::class, 'data_TradeData'])->name('trade-data');
    Route::get('coted', [FrontController::class, 'data_Coted'])->name('coted');
    Route::get('caricom-cet', [FrontController::class, 'data_CaricomCet'])->name('caricom-cet');
});

Route::prefix('resources')->name('resources.')->group(function () {
    Route::get('business-readiness-desk', [FrontController::class, 'resources_BusinessReadinessDesk'])->name('business-readiness-desk');
    Route::get('go-invest', [FrontController::class, 'resources_GoInvest'])->name('go-invest');
    Route::get('idb-invest', [FrontController::class, 'resources_IDBInvest'])->name('idb-invest');
    Route::get('procurement-process-in-guyana', [FrontController::class, 'resources_ProcurementProcessInGuyana'])->name('procurement-process-in-guyana');
    Route::get('certificate-of-origins', [FrontController::class, 'resources_CertificateOfOrigins'])->name('certificate-of-origins');
    Route::get('annual-report', [FrontController::class, 'resources_AnnualReport'])->name('annual-report');
});

Route::prefix('media')->name('media.')->group(function () {
    Route::get('news', [FrontController::class, 'media_News'])->name('news');
    Route::get('press-release', [FrontController::class, 'media_PressRelease'])->name('press-release');
    Route::get('social-media', [FrontController::class, 'media_SocialMedia'])->name('social-media');
    Route::get('photos', [FrontController::class, 'media_Photos'])->name('photos');
    Route::get('videos', [FrontController::class, 'media_Videos'])->name('videos');
});
//end front-route




//user routes
Route::middleware(['auth', 'role_per'])->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('file-details', [UserController::class, 'getFileDetails'])->name('file-details');
    Route::post('file-download', [UserController::class, 'downFileDetails'])->name('file-download');
});
//




// admin routes
Route::middleware(['auth', 'role_per'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('user', AdminUserController::class);
    Route::post('user/filter', [AdminUserController::class, 'index'])->name('user.filter');
    Route::post('user/export', [AdminUserController::class, 'export'])->name('user.export');

    Route::prefix('cms')->name('cms.')->group(function() {
        Route::get('contact-us', [CMSController::class, 'contactUs'])->name('contact-us');
    });
});
//




require __DIR__ . '/auth.php';
