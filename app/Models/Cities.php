<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    protected $fillable = ['city_id', 'city_name'];

    /**
     * Get all cities ordered by name.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCities()
    {
        return self::select(['city_id', 'city_name'])
            ->orderBy('city_name', 'asc')
            ->get();
    }
}
