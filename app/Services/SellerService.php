<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SellerRepositoryInterface;

class SellerService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private SellerRepositoryInterface $sellerRepository
    ) {
    }

    public function getFilteredSellers(array $filters): array
    {
        $filteredProducts = $this->getFilteredProductIds($filters['products']);
        $sellers = $this->sellerRepository->getSellers($filteredProducts, $filters['city'], $filters['withCoordinatesNull'])['data'];

        $sellerIds = array_column($sellers, 'user_id');
        $productsBySeller = $this->productRepository->getProductsBySellers($sellerIds, $filteredProducts);

        foreach ($sellers as $seller) {
            $seller->products = $productsBySeller[$seller->user_id] ?? [];
        }

        return $sellers;
    }

    public function createSeller(array $data)
    {
        $userId = $this->sellerRepository->setUser($this->prepareUserData($data));
        $this->sellerRepository->setRoleUser(2, $userId);
        $this->attachUserProducts($userId, $data['products']);

        return $this->sellerRepository->getUser($userId);
    }

    private function getFilteredProductIds(array|null $productsFilter)
    {
        if (!isset($productsFilter) || !is_array($productsFilter) || empty($productsFilter)) {
            return null;
        }

        return array_map(function ($product) {
            return $this->productRepository->getProductId($product)[0]->product_id;
        }, $productsFilter);
    }

    private function prepareUserData(array $data): array
    {
        return [
            'full_name' => $data['user_full_name'],
            'email' => $data['user_email'],
            // 'user_registration' => now(),
            'phone_number' => $data['user_phone'],
            'comment' => $data['user_comment'],
            'longitude' => $data['user_lng'],
            'latitude' => $data['user_lat'],
        ];
    }

    private function attachUserProducts(int $userId, array $products)
    {
        foreach ($products as $product) {
            if ($product) {
                $productId = $this->productRepository->getProductId($product)[0]->product_id;
                $this->sellerRepository->attachProductToUser($userId, $productId);
            }
        }
    }
}
