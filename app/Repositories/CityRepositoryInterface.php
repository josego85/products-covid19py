<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface CityRepositoryInterface
{
    public function getCities(): Collection;
}
