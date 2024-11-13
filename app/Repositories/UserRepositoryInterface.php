<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getUsers(
        array $filterProducts = null,
        int $filterCity = null,
        bool $withCoordinatesNull = null
    ): array;
    public function setUser(array $data): int;
    public function setRoleUser(int $role_id, int $user_id): bool;
}
