<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Sale;
use App\Cart;
use App\Sale_Detail;
use Auth;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function add(Request $request) {
        $company_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;

        $sale = new Sale();
        $sale->company_id = $company_id;
        $sale->user_id = $user_id;
        $sale->total_sales = $request->total_amount;
        $sale->save();
        
        $sale_id = Sale::where('user_id',$user_id)->orderBy('created_at', 'desc')->first()->id;
        $cart_items = Cart::where('user_id', $user_id)->get();
        foreach($cart_items as $cart_item){
            $sale_detail = new Sale_Detail();
            $sale_detail->sale_id = $sale_id;
            $sale_detail->product_id = $cart_item->product_id;
            $sale_detail->product_name = $cart_item->product_name;
            $sale_detail->price = $cart_item->price;
            $sale_detail->quantity = $cart_item->quantity;
            $sale_detail->sub_amount = $cart_item->sub_amount;
            $sale_detail->save();
            $cart_item->delete();
        }
    }

    function show() {
        $id = Auth::user()->company_id;
        $company = Company::Find($id);
        // $company = Company::with('sales')->where('id','=',$id)->get();
        return view('settings.sales', compact('company'));
    }    
}
