<?php

namespace App\Http\Controllers\Front;

use App\Models\News;
use App\Models\Coted;
use App\Models\Query;
use App\Models\Photos;
use App\Models\Videos;
use App\Models\Settings;
use App\Models\TradeData;
use App\Models\CaricomCET;
use App\Models\SocialMedia;
use App\Models\PressRelease;
use App\Models\About;
use App\Models\Business;
use App\Models\Committeess;
use App\Models\CoreValue;
use App\Models\Performance;
use App\Models\Staff;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Models\GuyanaEconomy;
use App\Models\MemberBenefit;
use App\Models\MembershipType;
use App\Models\NationalBudget;
use App\Models\BusinessDirectory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function aboutUs()
    {
        return view('front.about_us.about_us');
    }

    public function aboutUs_Introduction()
    {
        $introduction =  About::where('type', 'About')->where('status', '1')->first();
        $mission =  About::where('type', 'Mission')->where('status', '1')->first();
        $strategic =  Testimonials::where('status', '1')->orderby('id', 'desc')->get();
        $corevalue = CoreValue::where('status', '1')->orderby('id', 'desc')->get();
        $performance = Performance::where('status', '1')->orderby('id', 'desc')->get();

        return view('front.about_us.introduction', compact('introduction', 'mission', 'strategic', 'corevalue', 'performance'));
    }

    public function aboutUs_Staff()
    {
        $staff =  Staff::where('status', '1')->orderby('id', 'desc')->get();

        return view('front.about_us.staff', compact('staff'));
    }

    public function aboutUs_Council()
    {
        $council =  About::where('type', 'Council')->where('status', '1')->first();

        return view('front.about_us.council', compact('council'));
    }

    public function aboutUs_History()
    {
        $history =  About::where('type', 'History')->where('status', '1')->first();

        return view('front.about_us.history', compact('history'));
    }

    public function aboutUs_Committeess()
    {
        $committees = Committeess::where('status', '1')->orderby('id', 'desc')->get();

        return view('front.about_us.committeess', compact('committees'));
    }

    public function contactUs()
    {
        $settings = Settings::where('meta_type', 'contact_us')->get();

        $data['settings'] = $settings->pluck('meta_value', 'meta_key')->toArray();

        return view('front.contact_us', $data);
    }

    public function save_contactUs(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required',],
            'message' => ['required'],
            'type' => ['required', 'in:contact_us'],
        ]);

        DB::transaction(function () use ($validated) {
            Query::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'message' => $validated['message'],
                'type' => $validated['type'],
            ]);
        });

        return redirect()->back()->with('success', 'We will get back to you regarding you request!');
    }

    public function guyanaEconomy()
    {
        $guyana_list = GuyanaEconomy::orderBy('id', 'asc')->where('status', '1')->get() ?? [];

        $data['guyana_list'] = $guyana_list;

        return view('front.guyana_economy', $data);
    }

    public function show_guyanaEconomy($id)
    {
        $id = base64_decode($id);
        $latest_list = GuyanaEconomy::orderBy('id', 'asc')->where('status', '1')->where('id', '!=', $id)->limit(5)->get() ?? [];
        $details = GuyanaEconomy::where('status', '1')->findOrFail($id);

        $data['latest_list'] = $latest_list;
        $data['details'] = $details;

        return view('front.guyana_economy_show', $data);
    }

    public function membership_BusinessDirectory()
    {
        $membershipList = MembershipType::orderBy('name', 'asc')->where('status', '1')->get() ?? [];
        $business_directory_list = [];

        foreach ($membershipList as $key => $value) {

            $list_in_value = BusinessDirectory::select('name')->orderBy('name', 'asc')->where([
                'type' => $value['id'],
                'status' => '1',
            ])->get();
            $business_directory_list[$value['name']] = $list_in_value->pluck('name')->toArray();
        }

        $data['business_directory_list'] = $business_directory_list;

        return view('front.membership.business_directory', $data);
    }

    public function membership_MemberBenefits()
    {
        $main = MemberBenefit::where('type', 'main')->first();
        $data['main'] = $main;
        return view('front.membership.member_benefits', $data);
    }

    public function data_NationalBudgets()
    {
        $main = NationalBudget::where('type', 'main')->first();
        $sources = NationalBudget::orderBy('id', 'desc')->where([
            'type' => 'source',
            'status' => '1'
        ])->get();

        $data['main'] = $main;
        $data['sources'] = $sources;

        return view('front.data.national_budgets', $data);
    }

    public function show_NationalBudget_Source($id)
    {
        $id = base64_decode($id);
        $latest_list = NationalBudget::orderBy('id', 'asc')->where('id', '!=', $id)->where([
            'type' => 'source',
            'status' => '1'
        ])->limit(5)->get() ?? [];
        $details = NationalBudget::where('status', '1')->findOrFail($id);

        $data['latest_list'] = $latest_list;
        $data['details'] = $details;

        return view('front.data.national_budgets_show_source', $data);
    }

    public function data_TradeData()
    {
        $main = TradeData::where('type', 'main')->first();
        $top_partner = TradeData::orderBy('id', 'desc')->where([
            'type' => 'top_partner',
            'status' => '1'
        ])->get();
        $top_country = TradeData::orderBy('id', 'desc')->where([
            'type' => 'top_country',
            'status' => '1'
        ])->get();

        $data['main'] = $main;
        $data['top_partner'] = $top_partner;
        $data['top_country'] = $top_country;

        return view('front.data.trade_data', $data);
    }

    public function data_Coted()
    {
        $main = Coted::where('type', 'main')->first();
        $entrepreneurship_development = Coted::orderBy('id', 'desc')->where([
            'type' => 'entrepreneurship_development',
            'status' => '1'
        ])->get();

        $data['main'] = $main;
        $data['entrepreneurship_development'] = $entrepreneurship_development;

        return view('front.data.coted', $data);
    }

    public function show_Coted_EntrepreneurshipDevelopment($id)
    {
        $id = base64_decode($id);
        $latest_list = Coted::orderBy('id', 'asc')->where('id', '!=', $id)->where([
            'type' => 'entrepreneurship_development',
            'status' => '1'
        ])->limit(5)->get() ?? [];
        $details = Coted::where('status', '1')->findOrFail($id);

        $data['latest_list'] = $latest_list;
        $data['details'] = $details;

        return view('front.data.coted_show_entrepreneurship_development', $data);
    }

    public function data_CaricomCet()
    {
        $main = CaricomCET::where('type', 'main')->first();
        $objectives = CaricomCET::orderBy('id', 'desc')->where([
            'type' => 'objective',
            'status' => '1'
        ])->get();
        $how_it_works = CaricomCET::orderBy('id', 'desc')->where([
            'type' => 'how_it_works',
            'status' => '1'
        ])->get();

        $data['main'] = $main;
        $data['objectives'] = $objectives;
        $data['how_it_works'] = $how_it_works;

        return view('front.data.caricom_cet', $data);
    }

    public function show_CaricomCet_Objective($id)
    {
        $id = base64_decode($id);
        $latest_list = CaricomCET::orderBy('id', 'asc')->where('id', '!=', $id)->where([
            'type' => 'objective',
            'status' => '1'
        ])->limit(5)->get() ?? [];
        $details = CaricomCET::where('status', '1')->findOrFail($id);

        $data['latest_list'] = $latest_list;
        $data['details'] = $details;

        return view('front.data.caricom_cet_show_objective', $data);
    }

    public function resources_BusinessReadinessDesk()
    {
        $business = Business::where('type', 'Business')->where('status', '1')->first();
        $certificate = Business::where('type', 'Business_certificate')->where('status', '1')->orderby('id', 'desc')->get();
        $benefits = Business::where('type', 'Business_benefits')->where('status', '1')->orderby('id', 'desc')->get();
        return view('front.resources.business_readiness_desk', compact('business', 'certificate', 'benefits'));
    }

    public function resources_Businessdetails($id)
    {
        $ids = base64_decode($id);
        $certificate = Business::where('type', 'Business_certificate')->where('status', '1')->where('id', $ids)->first();
        $data = Business::where('type', 'Business_certificate')->where('status', '1')->orderby('id', 'desc')->limit(5)->get();
        return view('front.resources.business_readiness_details', compact( 'certificate', 'data'));
    }

    public function resources_GoInvest()
    {
        $invest = Business::where('type', 'Go_Invest')->where('status', '1')->first();
        $investment  = Business::where('type', 'Investment')->where('status', '1')->orderby('id', 'desc')->get();

        return view('front.resources.go_invest', compact('invest', 'investment'));
    }

    public function resources_Detils($id)
    {
        $ids = base64_decode($id);
        $details  = Business::where('type', 'Investment')->where('id', $ids)->where('status', '1')->first();
        $data = Business::where('type', 'Investment')->where('status', '1')->orderby('id', 'desc')->limit(5)->get();
        return view('front.resources.go_invest_details', compact('details', 'data'));
    }

    public function resources_IDBInvest()
    {
        $invest = Business::where('type', 'IDBInvest')->where('status', '1')->first();
        $about = Business::where('type', 'key_areas')->where('status', '1')->orderby('id', 'desc')->get();
        $services = Business::where('type', 'idb_investment')->where('status', '1')->orderby('id', 'desc')->get();

        return view('front.resources.ibd_invest', compact('invest', 'about', 'services'));
    }

    public function resources_IDBDetails($id)
    {  
        $ids = base64_decode($id);
        $data = Business::where('type', 'key_areas')->where('status', '1')->orderby('id', 'desc')->limit(5)->get();
        $details = Business::where('type', 'key_areas')->where('status', '1')->where('id', $ids)->first();
        return view('front.resources.ibd_invest_deatils', compact('details', 'data'));
    }

    public function resources_ProcurementProcessInGuyana()
    {
        $overview = Business::where('type', 'Procurement')->where('status', '1')->first();
        $methods = Business::where('type', 'Procurement_methods')->where('status', '1')->orderby('id', 'desc')->get();
        $services = Business::where('type', 'Procurement_services')->where('status', '1')->orderby('id', 'desc')->get();

        return view('front.resources.procurement_process_in_guyana', compact('overview', 'methods', 'services'));
    }

    public function resources_ProcurementProcessDetails($id)
    {
        $ids = base64_decode($id);
        $details = Business::where('type', 'Procurement_methods')->where('id', $ids)->where('status', '1')->first();
        $data = Business::where('type', 'Procurement_methods')->where('status', '1')->orderby('id', 'desc')->limit(5)->get();
        return view('front.resources.procurement_process_in_guyana_details', compact('details', 'data',));
    }

    public function resources_CertificateOfOrigins()
    {
        $origin = Business::where('type', 'Origins')->where('status', '1')->first();
        $types  = Business::where('type', 'Origins_certificate')->where('status', '1')->orderby('id', 'desc')->get();
        $certificate = Business::where('type', 'Origins_of_certificates')->where('status', '1')->orderby('id', 'desc')->get();

        return view('front.resources.certificate_of_origins', compact('origin', 'types', 'certificate'));
    }

    public function resources_CertificateDetails($id)
    {
       $ids = base64_decode($id);

        $data  = Business::where('type', 'Origins_certificate')->where('status', '1')->orderby('id', 'desc')->limit(5)->get();
        $details  = Business::where('type', 'Origins_certificate')->where('id', $ids)->where('status', '1')->first();
        return view('front.resources.certificate_of_origins_details', compact('data', 'details'));
    }

    public function resources_AnnualReport()
    {
        $data = Business::where('type', 'Annual_Reports')->where('status', '1')->orderby('id', 'desc')->get();

        return view('front.resources.annual_report', compact('data'));
    }

    public function resources_Annualdetails($id)
    {
        $ids = base64_decode($id);
        $details = Business::where('type', 'Annual_Reports')->where('id', $ids )->where('status', '1')->first();
        $data =Business::where('type', 'Annual_Reports')->where('status', '1')->orderby('id', 'desc')->limit(5)->get();
        return view('front.resources.annual-report-details', compact('data', 'details'));
    }

    public function media_News()
    {
        $news_list = News::orderBy('id', 'desc')->where('status', '1')->get() ?? [];

        $data['news_list'] = $news_list;

        return view('front.media.news', $data);
    }

    public function show_News($id)
    {
        $id = base64_decode($id);
        $latest_list = News::orderBy('id', 'asc')->where('id', '!=', $id)->where([
            'status' => '1'
        ])->limit(5)->get() ?? [];
        $details = News::where('status', '1')->findOrFail($id);

        $data['latest_list'] = $latest_list;
        $data['details'] = $details;

        return view('front.media.news_show', $data);
    }

    public function media_PressRelease()
    {
        $press_release_list = PressRelease::orderBy('id', 'desc')->where('status', '1')->get() ?? [];
        $recent_press_release_list = PressRelease::orderBy('id', 'desc')->where('status', '1')->whereDate('created_at', Carbon::today())->get() ?? [];

        $data['press_release_list'] = $press_release_list;
        $data['recent_press_release_list'] = $recent_press_release_list;

        return view('front.media.press_release', $data);
    }

    public function show_PressRelease($id)
    {
        $id = base64_decode($id);
        $latest_list = PressRelease::orderBy('id', 'asc')->where('id', '!=', $id)->where([
            'status' => '1'
        ])->limit(5)->get() ?? [];
        $details = PressRelease::where('status', '1')->findOrFail($id);

        $data['latest_list'] = $latest_list;
        $data['details'] = $details;

        return view('front.media.press_release_show', $data);
    }

    public function media_SocialMedia()
    {
        $social_media_list = SocialMedia::orderBy('id', 'desc')->get() ?? [];

        $data['social_media_list'] = $social_media_list;

        return view('front.media.social_media', $data);
    }

    public function media_Photos()
    {
        $photo_list = Photos::orderBy('id', 'desc')->where('status', '1')->get() ?? [];

        $data['photo_list'] = $photo_list;

        return view('front.media.photos', $data);
    }

    public function media_Videos()
    {
        $video_list = Videos::orderBy('id', 'desc')->where('status', '1')->get() ?? [];

        $data['video_list'] = $video_list;

        return view('front.media.videos', $data);
    }
}
