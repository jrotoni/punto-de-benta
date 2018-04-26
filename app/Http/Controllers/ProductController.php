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
            // 'stocks' => 'required|numeric',
            // 'reorder_point' => 'required|numeric',
            // 'stock_unit' => 'required|string',
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
        // $product->stocks = $request->stocks;
        // $product->stock_unit = $request->stock_unit;
        // $product->reorder_point = $request->reorder_point;
        $product->picture = $filename;
        $product->save();

        

        Session::flash('status','New product has been successfully created!');
        // dd($request);
        return redirect()->back();
    }

    function updatepicture(Request $request){
        
        $id = Auth::user()->company_id;
        $product = Product::Find($request->product_id);
        
        // dd($product);
        if (Input::hasFile('picture')) {
            $filename = $this->getFileName($request->picture);
            $path = base_path('public/images/' . $id);
            $request->picture->move($path, $filename);
            // dd($filename);
        } else {
            $filename =  $product->picture;
            // dd($filename);
        }
        $product->picture = $filename;
        $product->save();

        return redirect()->back();
    }

    function edititem(Request $request){
        $product = Product::Find($request->product_id);
        // if($product->category_id!=null){
        //     $category = Category::Find($product->category_id);
        //     $categoryname = $category->name;
        //     $categoryid = $product->category_id;
        // } else {
        //     $categoryname = null;
        //     $categoryid = null;
        // }
        // echo $categoryname;

        $array = [
            'id' => $request->product_id,
            'name' => $product->name,
            'stockprice' => $product->stock_price,
            'retailprice' => $product->retail_price
        ];
        
        echo json_encode($array);
        // return response()->json(['category' => $array]);
    }

    function updateitem(Request $request) {
        $product = Product::Find($request->id);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->stock_price = $request->stock_price;
        $product->retail_price = $request->retail_price;
        $product->save();
        return redirect()->back();
    }

    function search(Request $request) {
        $output='';
        $id = Auth::user()->company_id;
        
        if($request->category!=0){
            $products = Product::where('name','LIKE','%'.$request->search.'%')->where('company_id', '=', $id)->where('category_id', '=', $request->category)->get();
        } else {
            $products = Product::where('name','LIKE','%'.$request->search.'%')->where('company_id', '=', $id)->get();
        }   

        if($products) {
            foreach($products as $product) {
                if($product->picture=="noimage.png"){
                    $output .= '
                    <div class="panel col-md-3 productbox">
                        <div class="panel-body fill">
                            <img class="center-block" src="'.asset('images/noimage.png').'" alt="'.$product->name.'" height="150" width="150">
                        </div>
                        <div class="panel-heading text-center productheading">
                            <h4><strong id="product'.$product->id.'">'.$product->name.'</strong></h4>
                            <p>PHP <span id="retail'.$product->id.'">'.$product->retail_price.'</span></p>
                        </div>
                        <div class="overlay" onclick="addtocart('.$product->id.');">
                            <div class="text"><i class="fas fa-cart-plus"></i> Add Item</div>
                        </div>                      
                    </div>
                    ';
                } else {
                    $output .= '
                    <div class="panel col-md-3 productbox">
                        <div class="panel-body fill">
                                <img class="center-block" src="'.asset('images/'.$product->company_id.'/'.$product->picture.'').'" alt="'.$product->name.'" height="150" width="150">
                        </div>
                        <div class="panel-heading text-center productheading">
                            <h4><strong id="product'.$product->id.'">'.$product->name.'</strong></h4>
                            <p>PHP <span id="retail'.$product->id.'">'.$product->retail_price.'</span></p>
                        </div>
                        <div class="overlay" onclick="addtocart('.$product->id.');">
                            <div class="text"><i class="fas fa-cart-plus"></i> Add Item</div>
                        </div>                      
                    </div>
                    ';
                }
                
            }
            return response($output);
        }
    }

    function searchbycategory(Request $request) {
        $output='';
        if($request->search!=0){
            $products = Product::where('category_id', $request->search)->get();
        } else {
            $id = Auth::user()->company_id;
            $products = Product::where('company_id', $id)->get();
        }
        if($products) {
            foreach($products as $product) {
                if($product->picture=="noimage.png"){
                    $output .= '
                    <div class="panel col-md-3 productbox">
                        <div class="panel-body fill">
                            <img class="center-block" src="'.asset('images/noimage.png').'" alt="'.$product->name.'" height="150" width="150">
                        </div>
                        <div class="panel-heading text-center productheading">
                            <h4><strong id="product'.$product->id.'">'.$product->name.'</strong></h4>
                            <p>PHP <span id="retail'.$product->id.'">'.$product->retail_price.'</span></p>
                        </div>
                        <div class="overlay" onclick="addtocart('.$product->id.');">
                            <div class="text"><i class="fas fa-cart-plus"></i> Add Item</div>
                        </div>                      
                    </div>
                    ';
                } else {
                    $output .= '
                    <div class="panel col-md-3 productbox">
                        <div class="panel-body fill">
                                <img class="center-block" src="'.asset('images/'.$product->company_id.'/'.$product->picture.'').'" alt="'.$product->name.'" height="150" width="150">
                        </div>
                        <div class="panel-heading text-center productheading">
                            <h4><strong id="product'.$product->id.'">'.$product->name.'</strong></h4>
                            <p>PHP <span id="retail'.$product->id.'">'.$product->retail_price.'</span></p>
                        </div>
                        <div class="overlay" onclick="addtocart('.$product->id.');">
                            <div class="text"><i class="fas fa-cart-plus"></i> Add Item</div>
                        </div>                      
                    </div>
                    ';
                }
                
                }
            return response($output);
        }
    }
}
