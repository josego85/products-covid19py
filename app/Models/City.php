<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Illuminate\Database\Eloquent\Model;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
class City extends Model
{
    protected $fillable = ['name', 'geom'];
    protected $hidden = ['geom'];
}
