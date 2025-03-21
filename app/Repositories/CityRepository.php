<?php

namespace App\Repositories;

use App\Models\City;
use Illuminate\Support\Collection;

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
        return $this->model->orderBy('id', 'asc')->get(['id', 'name']);
    }

    /**
     * Get a city by its ID.
     * 
     * @param int $id The ID of the city to retrieve
     * @return City Returns the City model instance if found, throws ModelNotFoundException otherwise
     * @throws ModelNotFoundException When no city is found with the given ID
     */
    /**
     * Get city id.
     *
     * @return City
     */
    public function getCityById(int $id): City
    {
        return $this->model->select('id', 'name')->findOrFail($id);
    }

    public function getCityFromCoordinates(float $longitude, float $latitude): string
    {
        $city = $this->model->select('name')
          ->whereRaw("ST_CONTAINS(geom, ST_GeomFromText(?, 4326))", ["POINT($longitude $latitude)"])
          ->first();

        return $city ? $city->name : 'Unknown';
    }
}
