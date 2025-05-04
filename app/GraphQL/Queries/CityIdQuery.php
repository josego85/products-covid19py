<?php

namespace App\GraphQL\Queries;

use App\Repositories\CityRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CityIdQuery extends Query
{
    protected $attributes = [
        'name' => 'cityId',
    ];

    protected $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('City');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The ID of the city',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return $this->cityRepository->getCityById($args['id']);
    }
}
