<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index() 
    {
        $products=Product::active()->with(["store", "category"])->latest()->limit(5)->get();
       return view('front.home',compact('products'));
    }
}
