<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getProductsBySellers(array $sellerIds, ?array $filterProducts = null): array;
    public function getProductId(string $productType): Collection;
    public function setProduct(array $data): int;
}
