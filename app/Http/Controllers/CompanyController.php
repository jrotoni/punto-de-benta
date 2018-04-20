<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    function register(Request $request) {
        $rules = array(
            'company_name' => 'required',
            'company_email' => 'required|string|email|max:191|unique:companies',
        );
        $this->validate($request, $rules);
        
        $random_code = str_random(7);
        $new_company = new Company();
        $new_company->company_name = $request->company_name;
        $new_company->company_email = $request->company_email;
        $new_company->verified = 'unverified';
        $new_company->token = bcrypt($random_code); 
        $new_company->save();
        return redirect()->back();
    }

    function registered_email(Request $request){

        if(Company::where('company_email',$request->company_email)->first()){
            echo "fail";
        }
        else {
            echo "success";
        }

    }
}
