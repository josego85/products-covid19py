<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cities as citiesModel;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch cities.
        $citiesModel = new citiesModel();
        $cities = $citiesModel->getCities();
 
        return view('main')->with("cities", $cities);
    }
}
