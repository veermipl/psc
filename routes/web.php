<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CotedController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\GoInvestController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\CoreValueController;
use App\Http\Controllers\Admin\IDBInvestController;
use App\Http\Controllers\Admin\TradeDataController;
use App\Http\Controllers\Admin\CaricomCETController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AnnulReportController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CommitteessController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PressReleaseController;
use App\Http\Controllers\Admin\MemberBenefitController;
use App\Http\Controllers\Admin\MembershipTypeController;
use App\Http\Controllers\Admin\NationalBudgetController;
use App\Http\Controllers\Admin\BusinessDirectoryController;
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
    Artisan::call('config:clear');
    Artisan::call('optimize');

    return "Cache cleared !";
});

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('storage_link', function () {
    if (File::exists(public_path('storage'))) {
        File::delete(public_path('storage'));
    }
    Artisan::call('storage:link');
    return "Storage linked !";
});

Route::get('/', [FrontController::class, 'index']);
Route::get('home', [FrontController::class, 'index'])->name('home');
Route::get('home/banner-show/{id}', [FrontController::class, 'show_banner'])->name('home.banner.show');
Route::get('home/sub-banner-show/{id}', [FrontController::class, 'show_subBanner'])->name('home.sub-banner.show');
Route::get('home/post-show/{id}', [FrontController::class, 'show_post'])->name('home.post.show');
Route::get('contact-us', [FrontController::class, 'contactUs'])->name('contact-us');
Route::post('contact-us-save', [FrontController::class, 'save_contactUs'])->name('contact-us-save');
Route::get('guyana-economy', [FrontController::class, 'guyanaEconomy'])->name('guyana-economy');
Route::get('guyana-economy-show/{id}', [FrontController::class, 'show_guyanaEconomy'])->name('guyana-economy-show');

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
    Route::get('national-budgets-source-show/{id}', [FrontController::class, 'show_NationalBudget_Source'])->name('national-budgets-source-show');
    Route::get('trade-data', [FrontController::class, 'data_TradeData'])->name('trade-data');
    Route::get('coted', [FrontController::class, 'data_Coted'])->name('coted');
    Route::get('coted-entrepreneurship-development-show/{id}', [FrontController::class, 'show_Coted_EntrepreneurshipDevelopment'])->name('coted-entrepreneurship-development-show');
    Route::get('caricom-cet', [FrontController::class, 'data_CaricomCet'])->name('caricom-cet');
    Route::get('caricom-cet-objective-show/{id}', [FrontController::class, 'show_CaricomCet_Objective'])->name('caricom-cet-objective-show');
});

Route::prefix('resources')->name('resources.')->group(function () {
    Route::get('business-readiness-desk', [FrontController::class, 'resources_BusinessReadinessDesk'])->name('business-readiness-desk');
    Route::get('go-invest', [FrontController::class, 'resources_GoInvest'])->name('go-invest');
    Route::get('go-invest-details/{id}', [FrontController::class, 'resources_Detils'])->name('go-invest.details');
    Route::get('idb-invest', [FrontController::class, 'resources_IDBInvest'])->name('idb-invest');
    Route::get('procurement-process-in-guyana', [FrontController::class, 'resources_ProcurementProcessInGuyana'])->name('procurement-process-in-guyana');
    Route::get('certificate-of-origins', [FrontController::class, 'resources_CertificateOfOrigins'])->name('certificate-of-origins');
    Route::get('annual-report', [FrontController::class, 'resources_AnnualReport'])->name('annual-report');
    Route::get('resources-business-details/{id}', [FrontController::class, 'resources_Businessdetails'])->name('business.details');
    Route::get('procurement-process-in-guyana-details/{id}', [FrontController::class, 'resources_ProcurementProcessDetails'])->name('procurement.deatils');
    Route::get('annual-report-details/{id}', [FrontController::class, 'resources_Annualdetails'])->name('annual.report.details');
    Route::get('certificate-of-origins-details/{id}', [FrontController::class, 'resources_CertificateDetails'])->name('certificate-of-origins.deatils');
    Route::get('idb-invest-details/{id}', [FrontController::class, 'resources_IDBDetails'])->name('idb-invest.details');
});

Route::prefix('media')->name('media.')->group(function () {
    Route::get('news', [FrontController::class, 'media_News'])->name('news');
    Route::get('news-show/{id}', [FrontController::class, 'show_News'])->name('news-show');
    Route::get('press-release', [FrontController::class, 'media_PressRelease'])->name('press-release');
    Route::get('press-release-show/{id}', [FrontController::class, 'show_PressRelease'])->name('press-release-show');
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
    Route::get('profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
    Route::post('profile/update', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/status', [UserController::class, 'profileStatus'])->name('profile.status');
    Route::post('profile/delete', [UserController::class, 'profileDelete'])->name('profile.delete');
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

        Route::get('caricom-cet/create-how-it-works', [CaricomCETController::class, 'createHowItWorks'])->name('caricom-cet.create-how-it-works');
        Route::post('caricom-cet/save-how-it-works', [CaricomCETController::class, 'saveHowItWorks'])->name('caricom-cet.save-how-it-works');
        Route::get('caricom-cet/edit-how-it-works/{id}', [CaricomCETController::class, 'editHowItWorks'])->name('caricom-cet.edit-how-it-works');
        Route::post('caricom-cet/update-how-it-works', [CaricomCETController::class, 'updateHowItWorks'])->name('caricom-cet.update-how-it-works');
        Route::post('caricom-cet/update-how-it-works-status', [CaricomCETController::class, 'updateHowItWorksStatus'])->name('caricom-cet.update-how-it-works-status');
        Route::post('caricom-cet/delete-how-it-works', [CaricomCETController::class, 'deleteHowItWorks'])->name('caricom-cet.delete-how-it-works');
    });

    Route::prefix('readines/')->name('readines.')->group(function () {
        Route::get('business', [BusinessController::class, 'business'])->name('business');
        Route::Post('update-business', [BusinessController::class, 'business_update'])->name('update_business');

        Route::get('certificate', [BusinessController::class, 'certificate'])->name('certificate');
        Route::get('certificate-add', [BusinessController::class, 'certificate_add'])->name('certificate.add');
        Route::post('certificate-store', [BusinessController::class, 'certificate_store'])->name('certificate.store');
        Route::post('certificate-status', [BusinessController::class, 'certificate_status'])->name('certificate.status');
        Route::post('certificate-destroy', [BusinessController::class, 'certificate_destroy'])->name('certificate.destroy');
        Route::get('certificate-edit/{id}', [BusinessController::class, 'certificate_edit'])->name('certificate.edit');
        Route::post('certificate-update/{id}', [BusinessController::class, 'certificate_update'])->name('certificate.update');


        Route::get('benefits-certificate', [BusinessController::class, 'benefits'])->name('benefits');
        Route::get('benefits-add', [BusinessController::class, 'benefits_add'])->name('benefits.add');
        Route::post('benefits-store', [BusinessController::class, 'benefits_store'])->name('benefits.store');
        Route::post('benefits-status', [BusinessController::class, 'benefits_status'])->name('benefits.status');
        Route::post('benefits-destroy', [BusinessController::class, 'benefits_destroy'])->name('benefits.destroy');
        Route::get('benefits-edit/{id}', [BusinessController::class, 'benefits_edit'])->name('benefits.edit');
        Route::post('benefits-update/{id}', [BusinessController::class, 'benefits_update'])->name('benefits.update');


        Route::controller(GoInvestController::class)->group(function () {
            Route::get('go-invest', 'GoInves')->name('goinvest');
            Route::Post('update-go-invest',  'GoInvest_update')->name('update_goinvest');
            Route::get('investment',  'Investment')->name('investment');
            Route::get('investment-add', 'Investment_add')->name('investment.add');
            Route::post('investment-store',  'Investment_store')->name('investment.store');
            Route::post('investment-status', 'Investment_status')->name('investment.status');
            Route::Post('investment-destroy', 'Investment_destroy')->name('investment.destroy');
            Route::get('investment-edit/{id}',  'Investment_edit')->name('investment.edit');
            Route::post('investment-update/{id}', 'Investment_update')->name('investment.update');
        });

        Route::controller(IDBInvestController::class)->group(function () {
            Route::get('idb-inves', 'idb_inves')->name('idbinves');
            Route::Post('update-idb-inves',  'inves_update')->name('update_idbinves');

            Route::get('key-areas',  'key_areas')->name('key_areas');
            Route::get('key-areas-add', 'areas_add')->name('areas.add');
            Route::post('key-areas-store',  'areas_store')->name('areas.store');
            Route::post('key-areas-status', 'areas_status')->name('areas.status');
            Route::post('key-areas-destroy', 'areas_destroy')->name('areas.destroy');
            Route::get('key-areas-edit/{id}',  'areas_edit')->name('areas.edit');
            Route::post('key-areas-update/{id}', 'areas_update')->name('areas.update');

            // Route::get('idb-investment',  'IDB_Investment')->name('IDB_Investment');
            Route::get('idb-investment-add', 'idb_investment_add')->name('IDB.add');
            Route::post('idb-investment-store',  'idb_investment_store')->name('IDB.store');
            Route::post('idb-investment-status', 'idb_investment_status')->name('IDB.status');
            Route::post('idb-investment-destroy', 'idb_investment_destroy')->name('IDB.destroy');
            Route::get('idb-investment-edit/{id}',  'idb_investment_edit')->name('IDB.edit');
            Route::post('idb-investment-update/{id}', 'idb_investment_update')->name('IDB.update');
        });

        Route::controller(ProcurementController::class)->group(function () {
            Route::get('procurement', 'procurement')->name('procurement');
            Route::Post('update-procurement',  'procurement_update')->name('procurement_update');

            // Route::get('methods',  'methods')->name('methods');
            Route::get('methods-add', 'methods_add')->name('methods.add');
            Route::post('methods-store',  'methods_store')->name('methods.store');
            Route::post('methods-status', 'methods_status')->name('methods.status');
            Route::post('methods-destroy', 'methods_destroy')->name('methods.destroy');
            Route::get('methods-edit/{id}',  'methods_edit')->name('methods.edit');
            Route::post('methods-update/{id}', 'methods_update')->name('methods.update');

            Route::get('methods-services',  'methods_services')->name('services');
            Route::get('methods-services-add', 'methods_services_add')->name('services.add');
            Route::post('methods-services-store',  'methods_services_store')->name('services.store');
            Route::post('methods-services-status', 'methods_services_status')->name('services.status');
            Route::post('methods-services-destroy', 'methods_services_destroy')->name('services.destroy');
            Route::get('methods-services-edit/{id}',  'methods_services_edit')->name('services.edit');
            Route::post('methods-services-update/{id}', 'methods_services_update')->name('services.update');
        });

        Route::controller(CertificateController::class)->group(function () {

            Route::get('origins/certificate', 'certificate')->name('certificate.origins');
            Route::Post('origins/certificate',  'certificate_update')->name('origins.certificate_update');

            Route::get('origins/type-certificate',  'type_certificate')->name('origins.type.certificate');
            Route::get('origins/type-add', 'type_add')->name('origins.add');
            Route::post('origins/type-store',  'type_store')->name('origins.store');
            Route::post('origins/type-status',  'type_status')->name('origins.status');
            Route::post('origins/type-destroy',  'type_destroy')->name('origins.destroy');
            Route::get('origins/type-edit/{id}',  'type_edit')->name('origins.edit');
            Route::post('origins/type-update/{id}', 'type_update')->name('origins.update');

            Route::get('origins/certificates',  'certificatess')->name('origins.certificate');
            Route::get('origins/certificate-add', 'origins_add')->name('origins.certificate.add');
            Route::post('origins/certificate-store',  'origins_store')->name('origins.certificate.store');
            Route::post('origins/certificate-status',  'origins_status')->name('origins.certificate.status');
            Route::post('origins/certificate-destroy',  'origins_destroy')->name('origins.certificate.destroy');
            Route::get('origins/certificate-edit/{id}',  'origins_edit')->name('origins.certificate.edit');
            Route::post('origins/certificate-update/{id}', 'origins_update')->name('origins.certificate.update');
        });


        Route::controller(AnnulReportController::class)->group(function () {

            Route::get('annual',  'annual')->name('annul');
            Route::get('annual-add', 'annual_add')->name('annul.add');
            Route::post('annual-store',  'annual_store')->name('annul.store');
            Route::post('annual-status',  'annual_status')->name('annul.status');
            Route::get('annual-destroy/{id}', 'annual_destroy')->name('annul.destroy');
            Route::get('annual-edit/{id}',  'annual_edit')->name('annul.edit');
            Route::post('annual-update/{id}', 'annual_update')->name('annul.update');
        });
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
        Route::post('business-directory/export', [BusinessDirectoryController::class, 'export'])->name('business-directory.export');
        Route::post('business-directory/status', [BusinessDirectoryController::class, 'statusToggle'])->name('business-directory.status');
        Route::resource('business-directory', BusinessDirectoryController::class);

        Route::get('member-benefit', [MemberBenefitController::class, 'index'])->name('member-benefit');
        Route::post('member-benefit/update', [MemberBenefitController::class, 'update'])->name('member-benefit.update');
        // Route::resource('member-benefit', MemberBenefitController::class);
    });

    Route::prefix('about-us/')->group(function () {

        Route::controller(StaffController::class)->prefix('staff')->name('staff.')->group(function () {
            Route::get('create', 'create')->name('create');
            Route::Post('store', 'store')->name('store');
            Route::get('list', 'list')->name('list');
            Route::Post('status', 'status')->name('status');
            Route::get('destroy/{id}', 'destroy')->name('destroy');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::patch('update/{id}', 'Update')->name('update');
        });

        Route::controller(CommitteessController::class)->prefix('committeess')->name('committeess.')->group(function () {
            Route::get('create', 'create')->name('create');
            Route::Post('store', 'store')->name('store');
            Route::get('list', 'list')->name('list');
            Route::Post('status', 'status')->name('status');
            Route::get('destroy/{id}', 'destroy')->name('destroy');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::patch('update/{id}', 'Update')->name('update');
        });

        Route::controller(AboutController::class)->prefix('about')->name('about.')->group(function () {

            Route::get('introduction', 'Introduction')->name('introduction');
            Route::Post('introduction', 'Introduction_update')->name('introduction_update');
            Route::get('mission', 'Mission')->name('mission');
            Route::post('mission', 'Mission_update')->name('mission_update');

            Route::get('council', 'Council')->name('council');
            Route::post('council', 'Council_update')->name('council_update');
            Route::get('history', 'History')->name('history');
            Route::Post('history', 'History_update')->name('history_update');
        });

        Route::controller(TestimonialController::class)->prefix('testimonial')->name('testimonial.')->group(function () {
            Route::get('list', 'Index')->name('list');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'Store')->name('store');
            Route::Post('status', 'status')->name('status');
            Route::Post('destroy', 'destroy')->name('destroy');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::Post('update/{id}', 'Update')->name('update');
        });

        Route::controller(PerformanceController::class)->group(function () {
            Route::get('performance', 'Index')->name('performance');
            Route::get('create-performance', 'add_performance')->name('add_performance');
            Route::Post('store-performance', 'store_performance')->name('store_performance');
            Route::Post('status-performance', 'status')->name('performance_status');
            Route::post('destroy-performance', 'destroy')->name('performance_destroy');
            Route::get('edit-performance/{id}', 'edit')->name('performance_edit');
            Route::post('update-performance/{id}', 'Update')->name('performance_update');
        });


        Route::controller(CoreValueController::class)->group(function () {
            Route::get('core-value', 'Index')->name('corevalue');
            Route::get('create-corevalue', 'add')->name('add_corevalue');
            Route::Post('store-corevalue', 'store')->name('store_corevalue');
            Route::Post('status-corevalue', 'status')->name('status_corevalue');
            Route::Post('destroy-corevalue', 'destroy')->name('destroy_corevalue');
            Route::get('edit-corevalue/{id}', 'edit')->name('edit_corevalue');
            Route::post('update-corevalue/{id}', 'Update')->name('update_corevalue');
        });
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

        Route::get('landing-page', [CMSController::class, 'landingPage'])->name('landing-page');
        Route::post('landing-page/update-about-us', [CMSController::class, 'updateAboutUs'])->name('landing-page.update.about-us');
        Route::post('landing-page/update-report', [CMSController::class, 'updateReport'])->name('landing-page.update.report');

        Route::post('landing-page/update-status', [CMSController::class, 'updateStatus'])->name('landing-page.update-status');
        Route::post('landing-page/delete', [CMSController::class, 'delete'])->name('landing-page.delete');

        Route::get('landing-page/create-header', [CMSController::class, 'createHeader'])->name('landing-page.create.header');
        Route::post('landing-page/save-header', [CMSController::class, 'saveHeader'])->name('landing-page.save.header');
        Route::get('landing-page/edit-header/{id}', [CMSController::class, 'editHeader'])->name('landing-page.edit.header');
        Route::post('landing-page/update-header', [CMSController::class, 'updateHeader'])->name('landing-page.update.header');

        Route::get('landing-page/create-sub-header', [CMSController::class, 'createSubHeader'])->name('landing-page.create.sub-header');
        Route::post('landing-page/save-sub-header', [CMSController::class, 'saveSubHeader'])->name('landing-page.save.sub-header');
        Route::get('landing-page/edit-sub-header/{id}', [CMSController::class, 'editSubHeader'])->name('landing-page.edit.sub-header');
        Route::post('landing-page/update-sub-header', [CMSController::class, 'updateSubHeader'])->name('landing-page.update.sub-header');

        Route::get('landing-page/create-sector-committee', [CMSController::class, 'createSectorCommittee'])->name('landing-page.create.sector-committee');
        Route::post('landing-page/save-sector-committee', [CMSController::class, 'saveSectorCommittee'])->name('landing-page.save.sector-committee');
        Route::get('landing-page/edit-sector-committee/{id}', [CMSController::class, 'editSectorCommittee'])->name('landing-page.edit.sector-committee');
        Route::post('landing-page/update-sector-committee', [CMSController::class, 'updateSectorCommittee'])->name('landing-page.update.sector-committee');

        Route::get('landing-page/create-post', [CMSController::class, 'createPost'])->name('landing-page.create.post');
        Route::post('landing-page/save-post', [CMSController::class, 'savePost'])->name('landing-page.save.post');
        Route::get('landing-page/edit-post/{id}', [CMSController::class, 'editPost'])->name('landing-page.edit.post');
        Route::post('landing-page/update-post', [CMSController::class, 'updatePost'])->name('landing-page.update.post');
    });

    Route::prefix('queries')->name('queries.')->group(function () {
        Route::get('contact-us', [QueryController::class, 'list_contactUs'])->name('contact-us');
        Route::post('contact-us/filter', [QueryController::class, 'list_contactUs'])->name('contact-us.filter');
        Route::get('contact-us/view/{id}', [QueryController::class, 'view_contactUs'])->name('contact-us.view');

        Route::post('export', [QueryController::class, 'export'])->name('export');
        Route::post('delete', [QueryController::class, 'delete'])->name('delete');
    });

    Route::prefix('authorization')->name('authorization.')->group(function () {
        Route::post('role/export', [RoleController::class, 'export'])->name('role.export');
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

    Route::prefix('system')->name('system.')->group(function () {
        Route::get('notification/reload-table', [NotificationController::class, 'reloadTable'])->name('notification.reload-table');
        Route::post('notification/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notification.mark-as-read');
        Route::get('notification/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notification.mark-all-as-read');
        Route::resource('notification', NotificationController::class);
    });
});

// Route::get('test', [TestController::class, 'test'])->name('test');


require __DIR__ . '/auth.php';
