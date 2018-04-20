<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Category;
use App\User;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function show() {
        $id = Auth::user()->company_id;
        // $company = Company::find($id)->company_name;
        // $categories = Category::All();
        $company = Company::Find($id);
        return view('settings.products', compact('company'));
    }

}
