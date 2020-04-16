<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Cities
{

    public function getCities()
    {
        $expression_raw = 'c.city_id, c.city_name';;
        $data = DB::table('cities as c')
          ->select(array( DB::raw($expression_raw)))
          ->orderBy('c.city_name', 'asc')
          ->get();
        return $data;
    }
}