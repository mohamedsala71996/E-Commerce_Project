<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    
   public function store(Request $request)
    {

        $request->validate([
            'currency_code' =>'required|string|size:3',
        ]);
        $api_key=config('services.currency_converter.api_key');
        $base_currency_from=config("app.currency"); //from base_currency

        $currency_code_to = $request->input('currency_code'); //to currency_code
        Session::put('currency_code',  $currency_code_to);

       $rate= Cache::get('currency_code_'. $currency_code_to,0);
        if($rate==0){
            $converter= app('currency.converter');
            $rate=$converter->convert($base_currency_from,$currency_code_to);
            Cache::put('currency_code_'. $currency_code_to,$rate,now()->addHour());

        }
        
        // $converter= new CurrencyConverter( $api_key);
        // $rate=$converter->convert($base_currency_from,$currency_code_to);
        // Session::put('currency_rate', $rate);
        return redirect()->back();






    }
}
