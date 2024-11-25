<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class VendorService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function getFilteredVendors(array $filters): array
    {
        $filteredProducts = $this->getFilteredProductIds($filters['products']);
        $vendors = $this->userRepository->getUsers($filteredProducts, $filters['city'], $filters['withCoordinatesNull'])['data'];

        foreach ($vendors as $vendor) {
            $vendor->products = $this->getVendorProducts($vendor->user_id, $filteredProducts);
        }

        return $vendors;
    }

    public function createVendor(array $data)
    {
        $userId = $this->userRepository->setUser($this->prepareUserData($data));
        $this->userRepository->setRoleUser(2, $userId);
        $this->attachUserProducts($userId, $data['products']);

        return $this->userRepository->getUser($userId);
    }

    private function getFilteredProductIds(array|null $productsFilter)
    {
        if (!isset($productsFilter) || !is_array($productsFilter) || empty($productsFilter)) {
            return null;
        }

        return array_map(function ($product) {
            return $this->productRepository->getProductID($product)[0]->product_id;
        }, $productsFilter);
    }

    private function getVendorProducts($vendorId, $filterProducts)
    {
        $result = $this->productRepository->getProducts($vendorId, $filterProducts);
        return $result['total'] != 0 ? $result['data'] : null;
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
                $productId = $this->productRepository->getProductID($product)[0]->product_id;
                $this->userRepository->attachProductToUser($userId, $productId);
            }
        }
    }
}
