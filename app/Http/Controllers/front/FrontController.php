<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function aboutUs()
    {
        return view('front.about_us');
    }

    public function aboutUsType($type = null)
    {
        $data['typeData'] = [];

        if ($type) {
            return view('front.about_us_type', $data);
        }

        return view('front.about_us');
    }

    public function contactUs()
    {
        return view('front.contact_us');
    }

    public function guyanaEconomy()
    {
        return view('front.guyana_economy');
    }

    public function membership_BusinessDirectory(){
        return view('front.membership.business_directory');
    }

    public function membership_MemberBenefits(){
        return view('front.membership.member_benefits');
    }

    public function data_NationalBudgets(){
        return view('front.data.national_budgets');
    }

    public function data_TradeData(){
        return view('front.data.trade_data');
    }

    public function data_Coted(){
        return view('front.data.coted');
    }

    public function data_CaricomCet(){
        return view('front.data.caricom_cet');
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
