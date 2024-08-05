<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CMSController extends Controller
{
    public function contactUs(){
        return view('admin.cms.contact_us');
    }

    public function contactUsUpdate(Request $request){
        $validated = $request->validated();
        dd($validated);

        DB::transaction(function () {
            
        });
    }
}
