<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
  public function index()
  {
      $key=config('custom.KEY');
      $api="http://89.108.115.241:6969/api/sales?dateFrom=2024-01-01&dateTo=2024-06-30&page=1&key={$key}&limit=30";
      try {
          $res=Http::get($api);
          $data = json_decode($res, true);
          print_r($res->status());
          foreach($data as $i=>$val) {
              foreach(((array)$data)[$i] as $sale) {
                  if(is_array($sale) && array_key_exists('g_number', $sale)) {
                      DB::table('sales')->insert($sale);
                   }
              }
          }
      } catch(\Exception $e) {
            return $e-> GetMessage();
      }
  }
}
