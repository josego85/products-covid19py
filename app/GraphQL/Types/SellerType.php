<?php

namespace App\GraphQL\Types;

use App\Models\Product;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class SellerType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Seller',
        'description' => 'A type that represents a seller',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The ID of the seller',
            ],
            'longitude' => [
                'type' => Type::float(),
                'description' => 'The longitude of the seller',
            ],
            'latitude' => [
                'type' => Type::float(),
                'description' => 'The latitude of the seller',
            ],
            'comment' => [
                'type' => Type::string(),
                'description' => 'The comment of the seller',
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'The user associated with the seller',
                'resolve' => function ($seller) {
                    return User::find($seller->user_id);
                },
            ],
            'products' => [
                'type' => Type::listOf(GraphQL::type('Product')),
                'description' => 'The products associated with the seller',
                'resolve' => function ($seller) {
                    return $seller->products;
                },
            ],
        ];
    }
}