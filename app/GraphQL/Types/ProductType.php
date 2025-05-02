<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'description' => 'A type that represents a product',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The ID of the product',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the product',
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'The type of the product',
            ],
        ];
    }
}
