<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
    ]
)]
class User extends Model
{
    use HasFactory;
    
    protected $fillable = [
      'full_name',
      'email',
      'password',
      'phone_number',
      'status',
    ];

    protected $hidden = [
        'password',
    ];
}
