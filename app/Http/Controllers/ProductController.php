<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Category;
use App\User;
use App\Product;
use Auth;
use Session;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;

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

    protected function getFileName($file) {
        $ldate = date('Y-m-d_His');
        return $ldate . '.' . $file->extension();
    }

    function additem(Request $request) {
        $id = Auth::user()->company_id;
        $rules = array(
            'name' => Rule::unique('products')->where(function ($query) {
                    $id = Auth::user()->company_id;
                    $unique = ['company_id' => $id];
                    return $query->where($unique);
                    }),
            'stock_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'stocks' => 'required|numeric',
            'reorder_point' => 'required|numeric',
            'stock_unit' => 'required|string',
            'picture' => 'image|mimes:jpeg,bmp,png|max:5000'
        );
        $this->validate($request, $rules);


        if (Input::hasFile('picture')) {
            $filename = $this->getFileName($request->picture);
            $path = base_path('public/images/' . $id);
            $request->picture->move($path, $filename);
            // dd($filename);
        } else {
            $filename =  'noimage.png';
            // dd($filename);
        }
        

        $product = new Product();
        $product->company_id = $id;
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->stock_price = $request->stock_price;
        $product->retail_price = $request->retail_price;
        $product->stocks = $request->stocks;
        $product->stocks = $request->stocks;
        $product->stock_unit = $request->stock_unit;
        $product->stock_unit = $request->stock_unit;
        $product->reorder_point = $request->reorder_point;
        $product->picture = $filename;
        $product->save();
        
        

        Session::flash('status','New product has been successfully created!');
        // dd($request);
        return redirect()->back();
    }

}
