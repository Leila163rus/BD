<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class StocksController extends Controller
{
  public function index()
  {
      $key=config('custom.KEY');
      $api="http://89.108.115.241:6969/api/stocks?dateFrom=2024-12-15&dateTo=2024-12-15&page=1&key={$key}&limit=30";
      try {
          $res=Http::get($api);
          $data = json_decode($res, true);
          print_r($res->status());
          foreach($data as $i=>$val) {
              foreach(((array)$data)[$i] as $stock) {
                  if(is_array($stock) && array_key_exists('supplier_article', $stock)) {
                      DB::table('stocks')->insert($stock);
                }
              }
          }
      } catch(Exception $e) {
          return $e->getMessage();
      }
  }
}
