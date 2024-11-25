<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getProducts(int $userId, ?array $filterProducts = null): array
    {
        $query = $this->model->select('products.name', 'products.type')
            ->join('product_seller as p_s', 'p_s.product_id', '=', 'products.id')
            ->join('sellers as s', 'products.id', '=', 'p_s.product_id')
            ->join('users as u', 'u.id', '=', 's.user_id')
            ->where('u.status', 'active')
            ->where('s.user_id', $userId);

        if ($filterProducts) {
            $query->whereIn('products.id', $filterProducts);
        }

        $products = $query->get();

        return [
            'total' => $products->count(),
            'data'  => $products->toArray()
        ];
    }

    public function getProductId(string $productType): Collection
    {
        return $this->model->select('id')
            ->where('type', $productType)
            ->get();
    }
    public function setProduct(array $data): int
    {
        return $this->model->insertGetId([
            'type' => $data['product_type'],
            'name' => $data['product_name'] ?? null,
        ]);
    }
}
