<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getProductsBySellers(array $sellerIds, ?array $filterProducts = null): array
    {
        return Cache::remember('products_by_sellers_' . implode('_', $sellerIds), now()->addMinutes(30), function () use ($sellerIds, $filterProducts) {
            $query = $this->model->toBase()
                ->select('products.name', 'products.type', 'u.id as user_id')
                ->join('product_seller as p_s', 'p_s.product_id', '=', 'products.id')
                ->join('sellers as s', 's.id', '=', 'p_s.seller_id')
                ->join('users as u', 's.user_id', '=', 'u.id')
                ->where('u.status', 'active')
                ->whereIn('u.id', $sellerIds);

            if ($filterProducts) {
                $query->whereIn('products.id', $filterProducts);
            }

            $products = $query->get()->groupBy('user_id');

            return $products->map(fn ($group) => $group->toArray())->toArray();
        });
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
