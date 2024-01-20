<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index() 
    {
        $products=Product::active()->with(["store", "category"])->where('quantity','!=',0)->latest()->limit(10)->get();
       return view('front.home',compact('products'));
    }
}
