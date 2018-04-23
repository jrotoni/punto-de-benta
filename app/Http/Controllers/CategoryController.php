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

        if(!Category::where($unique)->first()){
            $new_category = new Category();
            $new_category->company_id = $id;
            $new_category->name = $request->name;
            $new_category->save();
            echo 'success';
        } else {
           echo $request->name; 
        }
        // echo $var . ' ' . $request->name;
    }

    function delete(Request $request) {
        $category = Category::find($request->id);
        try{
            $category->delete();
            echo 'true';
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    
    function update(Request $request) {
        $id = Auth::user()->company_id;
        $unique =['name' => $request->name, 'company_id' => $id];
        
        if(!Category::where($unique)->first()){
            $category = Category::find($request->id);
            $category->name = $request->name; 
            $category->save();    
            echo 'success';
        } else {
           echo $request->name; 
        }        
    }
}
