<?php

namespace App\GraphQL\Queries;

use App\Models\Seller;
use App\Repositories\SellerRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class SellerAllQuery extends Query
{
    protected $attributes = [
        'name' => 'sellers',
    ];

    protected $sellerRepository;

    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Seller'));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, $args)
    {
        return Seller::with(['products', 'user'])->get();
    }
}
