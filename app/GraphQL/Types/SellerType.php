<?php

namespace App\GraphQL\Types;

use App\Repositories\CityRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SellerType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Seller',
        'description' => 'A type that represents a seller',
    ];

    protected $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

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
                    return $seller->user;
                },
            ],
            'products' => [
                'type' => Type::listOf(GraphQL::type('Product')),
                'args' => [
                    'type' => [
                        'type' => Type::string(),
                        'description' => 'Filter products by type',
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Filter products by name',
                    ],
                ],
                'resolve' => function ($seller, $args) {
                    $query = $seller->products();

                    if (isset($args['type'])) {
                        $query->where('type', $args['type']);
                    }

                    if (isset($args['name'])) {
                        $query->where('name', 'like', "%{$args['name']}%");
                    }

                    return $query->get();
                },
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'The city where the seller is located, based on coordinates',
                'resolve' => function ($seller) {
                    if (!$this->hasValidCoordinates($seller)) {
                        return 'Unknown';
                    }

                    return $this->cityRepository->getCityFromCoordinates(
                        $seller->longitude,
                        $seller->latitude
                    );
                },
            ],
        ];
    }

    private function hasValidCoordinates($seller): bool
    {
        // Check if coordinates exist and are numeric
        if (!isset($seller->longitude) || !isset($seller->latitude)) {
            return false;
        }

        // Check if coordinates are numeric and within valid ranges
        if (!is_numeric($seller->longitude) || !is_numeric($seller->latitude)) {
            return false;
        }

        // Validate longitude range (-180 to 180)
        if ($seller->longitude < -180 || $seller->longitude > 180) {
            return false;
        }

        // Validate latitude range (-90 to 90)
        if ($seller->latitude < -90 || $seller->latitude > 90) {
            return false;
        }

        return true;
    }
}
