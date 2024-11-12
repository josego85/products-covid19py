<?php

namespace App\Repositories;

use App\Models\Cities;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements CityRepositoryInterface
{
    protected $model;

    public function __construct(Cities $model)
    {
        $this->model = $model;
    }

    /**
     * Get all cities ordered by name.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCities(): Collection
    {
        return $this->model->select(['city_id', 'city_name'])
            ->orderBy('city_name', 'asc')
            ->get();
    }
}
