<?php

use App\Http\Controllers\Admin\AboutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\PressReleaseController;
use App\Http\Controllers\Admin\MemberBenefitController;
use App\Http\Controllers\Admin\MembershipTypeController;
use App\Http\Controllers\Admin\BusinessDirectoryController;
use App\Http\Controllers\Admin\CaricomCETController;
use App\Http\Controllers\Admin\CotedController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\NationalBudgetController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TradeDataController;

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
    Route::post('profile/update', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/status', [UserController::class, 'profileStatus'])->name('profile.status');
});
//


// admin routes
Route::middleware(['auth', 'role_per'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::post('user/filter', [AdminUserController::class, 'index'])->name('user.filter');
    Route::post('user/export', [AdminUserController::class, 'export'])->name('user.export');
    Route::post('user/status', [AdminUserController::class, 'statusToggle'])->name('user.status');
    Route::resource('user', AdminUserController::class);

    Route::get('member/import', [AdminMemberController::class, 'import'])->name('member.import');
    Route::get('member/import-sample', [AdminMemberController::class, 'importSample'])->name('member.import-sample');
    Route::post('member/import-excel', [AdminMemberController::class, 'importWithExcel'])->name('member.import-excel');
    Route::post('member/import-excel-add', [AdminMemberController::class, 'importWithExcelAdd'])->name('member.import-excel-add');
    Route::post('member/filter', [AdminMemberController::class, 'index'])->name('member.filter');
    Route::post('member/export', [AdminMemberController::class, 'export'])->name('member.export');
    Route::post('member/status', [AdminMemberController::class, 'statusToggle'])->name('member.status');
    Route::post('member/delete-doc', [AdminMemberController::class, 'deleteDoc'])->name('member.delete-doc');
    Route::resource('member', AdminMemberController::class);

    Route::prefix('data')->name('data.')->group(function () {
        Route::get('national-budget', [NationalBudgetController::class, 'index'])->name('national-budget');
        Route::post('national-budget/update', [NationalBudgetController::class, 'update'])->name('national-budget.update');
        Route::get('national-budget/create-source', [NationalBudgetController::class, 'createSource'])->name('national-budget.create-source');
        Route::post('national-budget/save-source', [NationalBudgetController::class, 'saveSource'])->name('national-budget.save-source');
        Route::get('national-budget/edit-source/{id}', [NationalBudgetController::class, 'editSource'])->name('national-budget.edit-source');
        Route::post('national-budget/update-source', [NationalBudgetController::class, 'updateSource'])->name('national-budget.update-source');
        Route::post('national-budget/update-source-status', [NationalBudgetController::class, 'updateSourceStatus'])->name('national-budget.update-source-status');
        Route::post('national-budget/delete-source', [NationalBudgetController::class, 'deleteSource'])->name('national-budget.delete-source');

        Route::get('trade-data', [TradeDataController::class, 'index'])->name('trade-data');
        Route::post('trade-data/update', [TradeDataController::class, 'update'])->name('trade-data.update');
        Route::get('trade-data/create-top-partner', [TradeDataController::class, 'createTopPartner'])->name('trade-data.create-top-partner');
        Route::post('trade-data/save-top-partner', [TradeDataController::class, 'saveTopPartner'])->name('trade-data.save-top-partner');
        Route::get('trade-data/edit-top-partner/{id}', [TradeDataController::class, 'editTopPartner'])->name('trade-data.edit-top-partner');
        Route::post('trade-data/update-top-partner', [TradeDataController::class, 'updateTopPartner'])->name('trade-data.update-top-partner');
        Route::post('trade-data/update-top-partner-status', [TradeDataController::class, 'updateTopPartnerStatus'])->name('trade-data.update-top-partner-status');
        Route::post('trade-data/delete-top-partner', [TradeDataController::class, 'deleteTopPartner'])->name('trade-data.delete-top-partner');
        Route::get('trade-data/create-top-country', [TradeDataController::class, 'createTopCountry'])->name('trade-data.create-top-country');
        Route::post('trade-data/save-top-country', [TradeDataController::class, 'saveTopCountry'])->name('trade-data.save-top-country');
        Route::get('trade-data/edit-top-country/{id}', [TradeDataController::class, 'editTopCountry'])->name('trade-data.edit-top-country');
        Route::post('trade-data/update-top-country', [TradeDataController::class, 'updateTopCountry'])->name('trade-data.update-top-country');
        Route::post('trade-data/update-top-country-status', [TradeDataController::class, 'updateTopCountryStatus'])->name('trade-data.update-top-country-status');
        Route::post('trade-data/delete-top-country', [TradeDataController::class, 'deleteTopCountry'])->name('trade-data.delete-top-country');

        Route::get('coted', [CotedController::class, 'index'])->name('coted');
        Route::post('coted/update', [CotedController::class, 'update'])->name('coted.update');
        Route::get('coted/create-entrepreneurship-development', [CotedController::class, 'createEntrepreneurshipDevelopment'])->name('coted.create-entrepreneurship-development');
        Route::post('coted/save-entrepreneurship-development', [CotedController::class, 'saveEntrepreneurshipDevelopment'])->name('coted.save-entrepreneurship-development');
        Route::get('coted/edit-entrepreneurship-development/{id}', [CotedController::class, 'editEntrepreneurshipDevelopment'])->name('coted.edit-entrepreneurship-development');
        Route::post('coted/update-entrepreneurship-development', [CotedController::class, 'updateEntrepreneurshipDevelopment'])->name('coted.update-entrepreneurship-development');
        Route::post('coted/update-entrepreneurship-development-status', [CotedController::class, 'updateEntrepreneurshipDevelopmentStatus'])->name('coted.update-entrepreneurship-development-status');
        Route::post('coted/delete-entrepreneurship-development', [CotedController::class, 'deleteEntrepreneurshipDevelopment'])->name('coted.delete-entrepreneurship-development');

        Route::get('caricom-cet', [CaricomCETController::class, 'index'])->name('caricom-cet');
        Route::post('caricom-cet/update', [CaricomCETController::class, 'update'])->name('caricom-cet.update');
        Route::get('caricom-cet/create-objective', [CaricomCETController::class, 'createObjective'])->name('caricom-cet.create-objective');
        Route::post('caricom-cet/save-objective', [CaricomCETController::class, 'saveObjective'])->name('caricom-cet.save-objective');
        Route::get('caricom-cet/edit-objective/{id}', [CaricomCETController::class, 'editObjective'])->name('caricom-cet.edit-objective');
        Route::post('caricom-cet/update-objective', [CaricomCETController::class, 'updateObjective'])->name('caricom-cet.update-objective');
        Route::post('caricom-cet/update-objective-status', [CaricomCETController::class, 'updateObjectiveStatus'])->name('caricom-cet.update-objective-status');
        Route::post('caricom-cet/delete-objective', [CaricomCETController::class, 'deleteObjective'])->name('caricom-cet.delete-objective');
    });

    Route::prefix('resource')->name('resource.')->group(function () {
    });

    Route::prefix('media-center')->name('media-center.')->group(function () {
        Route::post('news/filter', [NewsController::class, 'index'])->name('news.filter');
        Route::post('news/status', [NewsController::class, 'statusToggle'])->name('news.status');
        Route::post('news/delete-file', [NewsController::class, 'deleteFile'])->name('news.delete-file');
        Route::resource('news', NewsController::class);

        Route::post('press-release/filter', [PressReleaseController::class, 'index'])->name('press-release.filter');
        Route::post('press-release/status', [PressReleaseController::class, 'statusToggle'])->name('press-release.status');
        Route::post('press-release/delete-file', [PressReleaseController::class, 'deleteFile'])->name('press-release.delete-file');
        Route::resource('press-release', PressReleaseController::class);

        Route::post('social-media/filter', [SocialMediaController::class, 'index'])->name('social-media.filter');
        Route::post('social-media/status', [SocialMediaController::class, 'statusToggle'])->name('social-media.status');
        Route::resource('social-media', SocialMediaController::class);

        Route::post('photo/filter', [PhotoController::class, 'index'])->name('photo.filter');
        Route::post('photo/status', [PhotoController::class, 'statusToggle'])->name('photo.status');
        Route::resource('photo', PhotoController::class);

        Route::post('video/filter', [VideoController::class, 'index'])->name('video.filter');
        Route::post('video/status', [VideoController::class, 'statusToggle'])->name('video.status');
        Route::resource('video', VideoController::class);

    });

    Route::prefix('membership')->name('membership.')->group(function () {
        Route::post('type/filter', [MembershipTypeController::class, 'index'])->name('type.filter');
        Route::post('type/export', [MembershipTypeController::class, 'export'])->name('type.export');
        Route::post('type/status', [MembershipTypeController::class, 'statusToggle'])->name('type.status');
        Route::resource('type', MembershipTypeController::class);

        Route::post('business-directory/filter', [BusinessDirectoryController::class, 'index'])->name('business-directory.filter');
        Route::post('business-directory/status', [BusinessDirectoryController::class, 'statusToggle'])->name('business-directory.status');
        Route::resource('business-directory', BusinessDirectoryController::class);

        Route::get('member-benefit', [MemberBenefitController::class, 'index'])->name('member-benefit');
        Route::post('member-benefit/update', [MemberBenefitController::class, 'update'])->name('member-benefit.update');
        // Route::resource('member-benefit', MemberBenefitController::class);
    });

    Route::prefix('cms')->name('cms.')->group(function () {
        Route::get('guyana-economy', [CMSController::class, 'guyanaEconomy'])->name('guyana-economy');
        Route::get('guyana-economy/create', [CMSController::class, 'guyanaEconomyCreate'])->name('guyana-economy.create');
        Route::post('guyana-economy/store', [CMSController::class, 'guyanaEconomyStore'])->name('guyana-economy.store');
        Route::get('guyana-economy/show/{id}', [CMSController::class, 'guyanaEconomyShow'])->name('guyana-economy.show');
        Route::get('guyana-economy/edit/{id}', [CMSController::class, 'guyanaEconomyEdit'])->name('guyana-economy.edit');
        Route::patch('guyana-economy/update', [CMSController::class, 'guyanaEconomyUpdate'])->name('guyana-economy.update');
        Route::delete('guyana-economy/delete/{id}', [CMSController::class, 'guyanaEconomyDelete'])->name('guyana-economy.delete');
        Route::post('guyana-economy/delete-image', [CMSController::class, 'guyanaEconomyDeleteImage'])->name('guyana-economy.delete-image');
        Route::post('guyana-economy/filter', [CMSController::class, 'guyanaEconomy'])->name('guyana-economy.filter');
        Route::post('guyana-economy/export', [CMSController::class, 'guyanaEconomyExport'])->name('guyana-economy.export');
        Route::post('guyana-economy/status', [CMSController::class, 'guyanaEconomyStatusToggle'])->name('guyana-economy.status');
    });

    Route::prefix('authorization')->name('authorization.')->group(function () {
        Route::post('role/filter', [RoleController::class, 'index'])->name('role.filter');
        Route::resource('role', RoleController::class);

        Route::resource('permission', PermissionController::class);
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('general', [SettingsController::class, 'general'])->name('general');
        Route::patch('general', [SettingsController::class, 'updateGeneral']);
        Route::get('email', [SettingsController::class, 'email'])->name('email');
        Route::patch('email', [SettingsController::class, 'updateEmail']);
        Route::get('contact-us', [SettingsController::class, 'contactUs'])->name('contact-us');
        Route::patch('contact-us', [SettingsController::class, 'updateContactUs']);
    });
    Route::controller(StaffController::class)->prefix('staff')->name('staff.')->group(function () {
        Route::get('create', 'create')->name('create');
        Route::Post('store', 'store')->name('store');
        Route::get('list', 'list')->name('list');
        Route::Post('status', 'status')->name('status');
        Route::get('destroy/{id}', 'destroy')->name('destroy');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::patch('update/{id}', 'Update')->name('update');
        
    });

    Route::controller(AboutController::class)->prefix('about')->name('about.')->group(function () {
        Route::get('council', 'Council')->name('council');
        Route::patch('council/{id}', 'Council_update')->name('council_update');
        Route::get('history', 'History')->name('history');
        Route::patch('history/{id}', 'History_update')->name('history_update');
       
        
    });
//
});

Route::get('test', [TestController::class, 'test'])->name('test');


require __DIR__ . '/auth.php';