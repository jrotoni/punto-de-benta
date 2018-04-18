<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use Auth;

class ProductController extends Controller
{
    function show() {
        $company = Company::find(Auth::user()->company_id)->company_name;
        // dd($company);
        return view('settings/products', compact('company'));
    }
}
