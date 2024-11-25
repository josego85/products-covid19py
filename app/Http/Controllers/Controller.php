<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB as DB;
use Stevebauman\Purify\Facades\Purify as Purify;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    private $date_hour;

    public function __construct()
    {
        $this->date_hour = DB::select('select NOW() date_hour;')[0]->date_hour;
    }

    protected function getDateHour()
    {
        return $this->date_hour;
    }

    protected function securityCleanCode($input)
    {
        $cleaned = Purify::clean($input);
        return $cleaned;
    }
}
