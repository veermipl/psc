<?php

namespace App\Http\Controllers\Front;

use App\Models\Coted;
use App\Models\Query;
use App\Models\Settings;
use App\Models\TradeData;
use App\Models\CaricomCET;
use Illuminate\Http\Request;
use App\Models\GuyanaEconomy;
use App\Models\MemberBenefit;
use App\Models\MembershipType;
use App\Models\NationalBudget;
use App\Models\BusinessDirectory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        return view('front.about_us.introduction');
    }

    public function aboutUs_Staff()
    {
        return view('front.about_us.staff');
    }

    public function aboutUs_Council()
    {
        return view('front.about_us.council');
    }

    public function aboutUs_History()
    {
        return view('front.about_us.history');
    }

    public function aboutUs_Committeess()
    {
        return view('front.about_us.committeess');
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

    public function resources_BusinessReadinessDesk()
    {
        return view('front.resources.business_readiness_desk');
    }

    public function resources_GoInvest()
    {
        return view('front.resources.go_invest');
    }

    public function resources_IDBInvest()
    {
        return view('front.resources.ibd_invest');
    }

    public function resources_ProcurementProcessInGuyana()
    {
        return view('front.resources.procurement_process_in_guyana');
    }

    public function resources_CertificateOfOrigins()
    {
        return view('front.resources.certificate_of_origins');
    }

    public function resources_AnnualReport()
    {
        return view('front.resources.annual_report');
    }

    public function media_News()
    {
        return view('front.media.news');
    }

    public function media_PressRelease()
    {
        return view('front.media.press_release');
    }

    public function media_SocialMedia()
    {
        return view('front.media.social_media');
    }

    public function media_Photos()
    {
        return view('front.media.photos');
    }

    public function media_Videos()
    {
        return view('front.media.videos');
    }
}
