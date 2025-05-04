<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection()
    ]
)]
class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'type'];

    /**
     * Define the relationship with users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Seller::class, 'product_seller');
    }
}
