<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type that represents a user',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The ID of the user',
            ],
            'full_name' => [
                'type' => Type::string(),
                'description' => 'The full name of the user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user',
            ],
            'phone_number' => [
                'type' => Type::string(),
                'description' => 'The phone number of the user',
            ],
        ];
    }
}
