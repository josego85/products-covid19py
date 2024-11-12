<?php

namespace App\Repositories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Products $model)
    {
        $this->model = $model;
    }

    public function getProducts(int $userId, ?array $filterProducts = null): array
    {
        $query = $this->model->select('products.product_name', 'products.product_type')
            ->join('products_users', 'products_users.product_id', '=', 'products.product_id')
            ->join('users', 'users.user_id', '=', 'products_users.user_id')
            ->where('users.user_state', 'active')
            ->where('products_users.user_id', $userId);

        if ($filterProducts) {
            $query->whereIn('products.product_id', $filterProducts);
        }

        $products = $query->get();

        return [
            'total' => $products->count(),
            'data'  => $products->toArray()
        ];
    }

    public function getProductID(string $productType): Collection
    {
        return $this->model->select('product_id')
            ->where('product_type', $productType)
            ->get();
    }
    public function setProduct(array $data): int
    {
        return $this->model->insertGetId([
            'product_type' => $data['product_type'],
            'product_name' => $data['product_name'] ?? null,
        ]);
    }
}
