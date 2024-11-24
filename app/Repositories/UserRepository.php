<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get users with optional filters.
     *
     * @param array|null $filterProducts
     * @param int|null $filterCity
     * @param bool $withCoordinatesNull
     * @return array
     */
    public function getUsers(
        ?array $filterProducts = null,
        ?int $filterCity = null,
        ?bool $withCoordinatesNull = null
    ): array {
        $query = $this->baseQuery();

        $this->applyFilters($query, $filterProducts, $filterCity, $withCoordinatesNull);

        $resultData = $this->executeQuery($query);

        return [
            'total' => $resultData->count(),
            'data'  => $resultData->toArray()
        ];
    }

    /**
     * Insert a new user.
     *
     * @param array $data
     * @return int
     */
    public function setUser(array $data): int
    {
        return $this->model->create($data)->user_id;
    }

    /**
     * Insert a role-user association.
     *
     * @param int $roleId
     * @param int $userId
     * @return bool
     */
    public function setRoleUser(int $roleId, int $userId): bool
    {
        return DB::table('roles_users')->insert([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);
    }

    public function attachProductToUser(int $userId, int $productId): void
    {
        $user = User::find($userId);
        if ($user) {
            $user->products()->attach($productId);
        }
    }

    public function getUser(int $userId): User
    {
        return User::find($userId);
    }

    /**
     * Create the base query for users.
     *
     * @return Builder
     */
    private function baseQuery(): Builder
    {
        return DB::table('users as u')
            ->select([
                'u.user_id',
                'u.user_full_name',
                'u.user_phone',
                'u.user_comment',
                'u.user_lng',
                'u.user_lat'
            ])
            ->where('u.user_state', 'active');
    }

    /**
     * Apply filters to the query.
     *
     * @param Builder $query
     * @param array|null $filterProducts
     * @param int|null $filterCity
     * @param bool|null $withCoordinatesNull
     */
    private function applyFilters(Builder $query, ?array $filterProducts, ?int $filterCity, ?bool $withCoordinatesNull): void
    {
        $this->applyCityFilter($query, $filterCity);
        $this->applyCoordinatesFilter($query, $withCoordinatesNull);
        $this->applyProductsFilter($query, $filterProducts);
        $this->applyExclusionsAndLimits($query);
    }

    /**
     * Apply city filter.
     *
     * @param Builder $query
     * @param int|null $filterCity
     */
    private function applyCityFilter(Builder $query, ?int $filterCity): void
    {
        if ($filterCity) {
            $query->join('cities as c', DB::raw("ST_CONTAINS(c.geom, ST_GeomFromText(CONCAT('POINT(', u.user_lng, ' ', u.user_lat, ')'), 4326))"), '=', DB::raw('1'))
              ->where('c.city_id', $filterCity);
        }
    }

    /**
     * Apply coordinates filter.
     *
     * @param Builder $query
     * @param bool|null $withCoordinatesNull
     */
    private function applyCoordinatesFilter(Builder $query, ?bool $withCoordinatesNull): void
    {
        if (!$withCoordinatesNull) {
            $query->whereNotNull('u.user_lng')
                ->whereNotNull('u.user_lat');
        }
    }

    /**
     * Apply products filter.
     *
     * @param Builder $query
     * @param array|null $filterProducts
     */
    private function applyProductsFilter(Builder $query, ?array $filterProducts): void
    {
        if ($filterProducts) {
            $query
            ->join('products_users as p_u', 'p_u.user_id', '=', 'u.user_id')
              ->join('products as p', 'p.product_id', '=', 'p_u.product_id')
              ->whereIn('p.product_id', $filterProducts);
        }
    }

    /**
     * Apply exclusions and limits.
     *
     * @param Builder $query
     */
    private function applyExclusionsAndLimits(Builder $query): void
    {
        $query->whereNotIn('u.user_id', [69, 122])
            ->limit(config('app.limit_vendors_wenda', 100))
            ->orderBy('u.user_registration', 'desc');
    }

    /**
     * Execute the query.
     *
     * @param Builder $query
     * @return \Illuminate\Support\Collection
     */
    private function executeQuery(Builder $query)
    {
        return $query->get();
    }

    public function test()
    {
        echo 'Test';
    }
}
