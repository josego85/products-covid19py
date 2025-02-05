<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'longitude',
        'latitude',
        'comment',
    ];

    /**
     * Define the relationship with products.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_seller');
    }
}
