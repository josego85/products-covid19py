<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SiteMap;
use App\Models\Url;

class SiteMapController extends Controller
{
    private $siteMap;

    public function index()
    {
        $this->siteMap = new siteMap();

        $this->addPages();

        return response($this->siteMap->build(), 200)
            ->header('Content-Type', 'text/xml');
    }

    private function addPages()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->format('c');

        $this->siteMap->add(
            Url::create('/')
                ->lastUpdate($startOfMonth)
                ->frequency('always')
                ->priority('1.00')
        );

        $this->siteMap->add(
            Url::create('/vendor')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.9')
        );

        $this->siteMap->add(
            Url::create('/disclaimer')
                ->lastUpdate($startOfMonth)
                ->frequency('never')
                ->priority('0.8')
        );
    }   
}