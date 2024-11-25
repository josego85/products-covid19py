<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getProducts(int $userId, ?array $filterProducts = null): array;
    public function getProductId(string $productType): Collection;
    public function setProduct(array $data): int;
}
