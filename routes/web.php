<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;

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

Route::get('storage', function () {
    Artisan::call('storage:link');
    return "storage linked successfully";
});


Route::get('/', [FrontController::class, 'index']);
Route::get('home', [FrontController::class, 'index'])->name('home');
Route::get('contact-us', [FrontController::class, 'contactUs'])->name('contact-us');
Route::get('guyana-economy', [FrontController::class, 'guyanaEconomy'])->name('guyana-economy');

Route::get('about-us', [FrontController::class, 'aboutUs'])->name('about-us');
Route::prefix('about-us')->name('about-us.')->group(function () {
    Route::get('introduction', [FrontController::class, 'aboutUs_Introduction'])->name('introduction');
    Route::get('staff', [FrontController::class, 'aboutUs_Staff'])->name('staff');
    Route::get('council', [FrontController::class, 'aboutUs_Council'])->name('council');
    Route::get('history', [FrontController::class, 'aboutUs_History'])->name('history');
    Route::get('committeess', [FrontController::class, 'aboutUs_Committeess'])->name('committeess');
});

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




//member routes
Route::middleware(['auth', 'role_per'])->prefix('member')->name('member.')->group(function () {
    Route::get('/', [MemberController::class, 'dashboard']);
    Route::get('dashboard', [MemberController::class, 'dashboard'])->name('dashboard');

    Route::post('file-details', [MemberController::class, 'getFileDetails'])->name('file-details');
    Route::post('file-download', [MemberController::class, 'downFileDetails'])->name('file-download');
});
//


//
Route::middleware(['auth', 'role_per'])->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
});
//


// admin routes
Route::middleware(['auth', 'role_per'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('user', AdminUserController::class);
    Route::post('user/filter', [AdminUserController::class, 'index'])->name('user.filter');
    Route::post('user/export', [AdminUserController::class, 'export'])->name('user.export');
    Route::post('user/status', [AdminUserController::class, 'statusToggle'])->name('user.status');

    Route::resource('member', AdminMemberController::class);
    Route::post('member/filter', [AdminMemberController::class, 'index'])->name('member.filter');
    Route::post('member/export', [AdminMemberController::class, 'export'])->name('member.export');
    Route::post('member/status', [AdminMemberController::class, 'statusToggle'])->name('member.status');

    Route::prefix('cms')->name('cms.')->group(function () {
        Route::get('guyana-economy', [CMSController::class, 'guyanaEconomy'])->name('guyana-economy');
        Route::post('guyana-economy/filter', [CMSController::class, 'guyanaEconomy'])->name('guyana-economy.filter');
        Route::get('guyana-economy/create', [CMSController::class, 'guyanaEconomyCreate'])->name('guyana-economy.create');
        Route::post('guyana-economy/store', [CMSController::class, 'guyanaEconomyStore'])->name('guyana-economy.store');
        Route::get('guyana-economy/show/{id}', [CMSController::class, 'guyanaEconomyShow'])->name('guyana-economy.show');
        Route::get('guyana-economy/edit/{id}', [CMSController::class, 'guyanaEconomyEdit'])->name('guyana-economy.edit');
        Route::patch('guyana-economy/update', [CMSController::class, 'guyanaEconomyUpdate'])->name('guyana-economy.update');
        Route::delete('guyana-economy/delete/{id}', [CMSController::class, 'guyanaEconomyDelete'])->name('guyana-economy.delete');
        Route::post('guyana-economy/status', [CMSController::class, 'guyanaEconomyStatusToggle'])->name('guyana-economy.status');
        Route::post('guyana-economy/export', [CMSController::class, 'guyanaEconomyExport'])->name('guyana-economy.export');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('general', [SettingsController::class, 'general'])->name('general');
        Route::patch('general', [SettingsController::class, 'updateGeneral']);
        Route::get('contact-us', [SettingsController::class, 'contactUs'])->name('contact-us');
        Route::patch('contact-us', [SettingsController::class, 'updateContactUs']);
    });
});
//


Route::get('test', [TestController::class, 'test'])->name('test');


require __DIR__ . '/auth.php';
