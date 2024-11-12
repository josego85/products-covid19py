<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_id', 'product_name', 'product_type'];

    /**
     * Get products for a user.
     *
     * @param int $userId
     * @param array|null $filterProducts
     * @return array
     */
    public function getProducts(int $userId, ?array $filterProducts = null): array
    {
        $query = $this->select('products.product_name', 'products.product_type')
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

    /**
     * Get product ID by product type.
     *
     * @param string $productType
     * @return Collection
     */
    public function getProductID(string $productType): Collection
    {
        return $this->select('product_id')
            ->where('product_type', $productType)
            ->get();
    }

    /**
     * Insert product.
     *
     * @param array $data
     * @return int
     */
    public function setProduct(array $data): int
    {
        return $this->insertGetId([
            'product_type' => $data['product_type'],
            'product_name' => $data['product_name'] ?? null,
        ]);
    }
}
