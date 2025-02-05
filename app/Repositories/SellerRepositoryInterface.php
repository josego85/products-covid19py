<?php

namespace App\Repositories;

use App\Models\User;

interface SellerRepositoryInterface
{
    public function getSellers(
        ?array $filterProducts = null,
        ?int $filterCity = null,
        ?bool $withCoordinatesNull = null
    ): array;
    public function setUser(array $data): int;
    public function setRoleUser(int $role_id, int $user_id): bool;
    public function attachProductToUser(int $userId, int $productId): void;
    public function getUser(int $userId): User;
}
