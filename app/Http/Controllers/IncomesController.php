<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class IncomesController extends Controller
{
    public function index()
    {
        $key=config('custom.KEY');
        $api="http://89.108.115.241:6969/api/incomes?dateFrom=2023-01-01&dateTo=2023-12-31&page=1&key={$key}&limit=30";
        try {
            $res=Http::get($api);
            $data = json_decode($res, true);
            print_r($res->status());
            foreach($data as $i=>$val) {
                foreach(((array)$data)[$i] as $income) {
                    if(is_array($income) && array_key_exists('income_id', $income)) {
                      DB::table('incomes')->insertOrIgnore($income);
                    }
                }
            }
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}
