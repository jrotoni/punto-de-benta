<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\Product;
use Auth;
use Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function add(Request $request) {
        $check = Cart::where('product_id',$request->product_id)->first();
        $product = Product::Find($request->product_id);

        if($check){
            $check->quantity = $check->quantity + 1;
            $check->sub_amount = $check->quantity * $check->price;
            $check->save();
        } else {
            $id = Auth::user()->id;
            
            $cart = new Cart();
            $cart->user_id = $id;
            $cart->product_id = $request->product_id;
            $cart->product_name = $product->name;
            $cart->price = $product->retail_price;
            $cart->quantity = 1;
            $cart->sub_amount = 1 * $cart->price;
            $cart->save();
        }

    }

    function delete(Request $request) {
        $remove_cart = Cart::where('product_id',$request->product_id)->first();
        $remove_cart->delete();
    }

    function update(Request $request) {
        $cart = Cart::where('product_id',$request->cart_id)->first();
        $cart->quantity = $request->quantity;
        $cart->sub_amount = $request->total;
        $cart->save();
    }
}
