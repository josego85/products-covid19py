<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class SellerRepository implements SellerRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get sellers with optional filters.
     *
     * @param array|null $filterProducts
     * @param int|null $filterCity
     * @param bool $withCoordinatesNull
     * @return array
     */
    public function getSellers(
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
        return DB::table('sellers as s')
            ->select([
                's.user_id',
                'u.full_name',
                'u.phone_number',
                's.comment',
                's.longitude',
                's.latitude',
            ])
            ->join('users as u', 'u.id', '=', 's.user_id')
            ->where('u.status', 'active');
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
            $query->join('cities as c', DB::raw("ST_CONTAINS(c.geom, ST_GeomFromText(CONCAT('POINT(', s.longitude, ' ', s.latitude, ')'), 4326))"), '=', DB::raw('1'))
                ->where('c.id', $filterCity);
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
            $query->whereNotNull('s.longitude')
                ->whereNotNull('s.latitude');
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
                ->join('product_seller as p_s', 'p_s.seller_id', '=', 's.id')
                ->join('products as p', 'p.id', '=', 'p_s.product_id')
                ->whereIn('p.id', $filterProducts);
        }
    }

    /**
     * Apply exclusions and limits.
     *
     * @param Builder $query
     */
    private function applyExclusionsAndLimits(Builder $query): void
    {
        $query->whereNotIn('s.user_id', [69, 122])
            ->limit(config('app.limit_sellers_wenda', 100));
        // ->orderBy('u.user_registration', 'desc');
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
}
