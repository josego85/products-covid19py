<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    protected $fillable = [
      'user_full_name',
      'user_email',
      'user_registration',
      'user_phone',
      'user_lng',
      'user_lat',
      'user_state',
      'user_comment'
    ];

    /**
     * Define the relationship with products.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_users', 'user_id', 'product_id');
    }
}
