<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Illuminate\Database\Eloquent\Model;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
    ]
)]
class Seller extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'comment',
    ];
}
