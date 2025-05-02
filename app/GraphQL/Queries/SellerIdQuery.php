<?php

namespace App\GraphQL\Queries;

use App\Repositories\SellerRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class SellerIdQuery extends Query
{
    protected $attributes = [
        'name' => 'sellerId',
    ];

    protected $sellerRepository;

    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function type(): Type
    {
        return GraphQL::type('Seller');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The ID of the seller',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return $this->sellerRepository->getSeller($args['id']);
    }
}
