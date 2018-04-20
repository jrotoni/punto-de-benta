<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use Auth;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function add(Request $request) {
        $id = Auth::user()->company_id;
        $unique =['name' => $request->name, 'company_id' => $id];

        if(Category::where($unique)->first()){
            echo 'meron na! ibang cetegory name naman!';
        } else {
            echo 'Available pa sya sis! pwede mo syang gamitin na category name';
        }
        // $new_category = new Category();
        // $new_category->company_id = $id;
        // $new_category->name = $request->name;
        // $new_category->save();
        // echo $var . ' ' . $request->name;
    }

    function delete(Request $request) {
        $category = Category::find($request->id);
        $category->delete();
    }
    
    function update(Request $request) {
        $category = Category::find($request->id);
        $category->name = $request->name; 
        $category->save();
    }
}
