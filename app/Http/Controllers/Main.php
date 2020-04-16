<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cities as citiesModel;
class Main extends Controller
{   
    public function index()
    {
        // Fetch cities.
        $citiesModel = new citiesModel();
        $cities = $citiesModel->getCities();

        return view('main')->with("cities", $cities);
      }
}