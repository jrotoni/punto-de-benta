<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Cart;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        $user = User::Find($id);
        $company = Company::Find($company_id);
        return view('home',compact('user', 'company'));
    }
}
