<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NumberFormatter;

class currencyFormat{


  // public  static function Format($amount,$currency=null) 
  // {
  //   $formatter = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
  //   if($currency==null){
  //     $currency=config('app.currency','USD');
  //   }
  //   return  $formatter->formatCurrency($amount,$currency);
  // }
  public  static function Format($amount,$currency=null) 
  {
    $base_currency=config('app.currency','USD');
    $formatter = new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
    if($currency==null){
      $currency= Session::get('currency_code',$base_currency);
    }
    if($currency!=$base_currency){
      $rate=Cache::get('currency_code_'. $currency,1);
      $amount = $amount *  $rate;
    }

    return  $formatter->formatCurrency($amount,$currency);
  }


}



