<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements CityRepositoryInterface
{
    protected $model;

    public function __construct(City $model)
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
        return $this->model->select(['id', 'name'])
            ->orderBy('name', 'asc')
            ->get();
    }
}
