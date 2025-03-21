<?php

namespace App\GraphQL\Queries;

use App\Repositories\CityRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CityAllQuery extends Query
{
    protected $attributes = [
        'name' => 'cities',
    ];

    protected $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('City'));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, $args)
    {
        return $this->cityRepository->getCities();
    }
}