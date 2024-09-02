<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Business;
use App\Models\Committeess;
use App\Models\CoreValue;
use App\Models\Performance;
use App\Models\Staff;
use App\Models\Testimonials;
use Illuminate\Http\Request;

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
        return view('front.about_us.introduction', compact('introduction', 'mission', 'strategic', 'corevalue', 'performance') );
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
        $committees = Committeess::where('status', '0')->orderby('id', 'desc')->get();
        return view('front.about_us.committeess', compact('committees'));
    }

    public function contactUs()
    {
        return view('front.contact_us');
    }

    public function guyanaEconomy()
    {
        return view('front.guyana_economy');
    }

    public function membership_BusinessDirectory()
    {
        return view('front.membership.business_directory');
    }

    public function membership_MemberBenefits()
    {
        return view('front.membership.member_benefits');
    }

    public function data_NationalBudgets()
    {
        return view('front.data.national_budgets');
    }

    public function data_TradeData()
    {
        return view('front.data.trade_data');
    }

    public function data_Coted()
    {
        return view('front.data.coted');
    }

    public function data_CaricomCet()
    {
        return view('front.data.caricom_cet');
    }

    public function resources_BusinessReadinessDesk()
    {
        $business = Business::where('type', 'Business')->where('status', '1')->first();
        $certificate = Business::where('type', 'Business_certificate')->where('status', '1')->orderby('id', 'desc')->get(); 
        $benefits = Business::where('type', 'Business_benefits')->where('status', '1')->orderby('id', 'desc')->get(); 

        return view('front.resources.business_readiness_desk', compact('business', 'certificate', 'benefits'));
    }

    public function resources_GoInvest()
    {
        $invest = Business::where('type', 'Go_Invest')->where('status', '1')->first();
        $investment  = Business::where('type', 'Investment')->where('status', '1')->orderby('id', 'desc')->get(); 
        return view('front.resources.go_invest', compact('invest', 'investment'));
    }

    public function resources_IDBInvest()
    {
        $invest = Business::where('type', 'IDBInvest')->where('status', '1')->first();
        $about = Business::where('type', 'key_areas')->where('status', '1')->orderby('id', 'desc')->get(); 
        $services = Business::where('type', 'idb_investment')->where('status', '1')->orderby('id', 'desc')->get(); 

        return view('front.resources.ibd_invest', compact('invest', 'about', 'services'));
    }

    public function resources_ProcurementProcessInGuyana()
    {
        $overview = Business::where('type', 'Procurement')->where('status', '1')->first();
        $methods = Business::where('type', 'Procurement_methods')->where('status', '1')->orderby('id', 'desc')->get(); 
        $services = Business::where('type', 'Procurement_services')->where('status', '1')->orderby('id', 'desc')->get(); 
        return view('front.resources.procurement_process_in_guyana', compact('overview', 'methods', 'services' ));
    }

    public function resources_CertificateOfOrigins()
    {
        $origin = Business::where('type', 'Origins')->where('status', '1')->first();
        $types  = Business::where('type', 'Origins_certificate')->where('status', '1')->orderby('id', 'desc')->get(); 
        $certificate = Business::where('type', 'Origins_of_certificates')->where('status', '1')->orderby('id', 'desc')->get(); 
        return view('front.resources.certificate_of_origins',compact('origin', 'types', 'certificate' ));
    }

    public function resources_AnnualReport()
    {
        $data = Business::where('type', 'Annual_Reports')->where('status', '1')->orderby('id', 'desc')->get(); 
        return view('front.resources.annual_report', compact('data' ));
    }

    public function resources_Annualdetails($id)
    {
        $data = Business::where('type', 'Annual_Reports')->where('status', '1')->orderby('id', 'desc')->limit(5)->get( ); 

        $details = Business::where('type', 'Annual_Reports')->where('id', $id)->where('status', '1')->orderby('id', 'desc')->first(); 


        return view('front.resources.annual-report-details', compact('data' , 'details'));
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
