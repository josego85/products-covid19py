<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepositoryInterface;

class HomeController extends Controller
{
    protected $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->cityRepository->getCities();

        return view('main')->with('cities', $cities);
    }
}
