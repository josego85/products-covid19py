<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Support\Collection;

interface CityRepositoryInterface
{
    public function getCities(): Collection;
    public function getCityById(int $id): City;
    public function getCityFromCoordinates(float $longitude, float $latitude): string;
}
