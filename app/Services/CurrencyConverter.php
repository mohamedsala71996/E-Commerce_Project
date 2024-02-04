<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{

  protected $api;

  protected $base_url='https://api.freecurrencyapi.com/v1';


  public function __construct(string $api) {
      $this->api = $api;
  }

  public function convert( string $from, string $to , float $amount = 1,) 
  {
      $q="{$from}_{$to}";
    $response=Http::baseUrl($this->base_url)
      ->get('/convert',[
          'q' => $q,
          'compact' => 'ultra',
          'apiKey' => $this->api,

      ]);
    $result=$response->json();

    return $result[$q]['val'] * $amount;

  }


}
