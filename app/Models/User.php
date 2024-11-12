<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'user_id';
  protected $fillable = [
    'user_full_name',
    'user_email',
    'user_registration',
    'user_phone',
    'user_lng',
    'user_lat',
    'user_state',
    'user_comment'
  ];


  /**
   * Get users with optional filters.
   *
   * @param array|null $filterProducts
   * @param int|null $filterCity
   * @param bool $withCoordinatesNull
   * @return array
   */
  public function getUsers(
    array $filterProducts = null,
    int $filterCity = null,
    bool $withCoordinatesNull = null
  ) {

    $query = DB::table('users as u')
      ->select([
        'u.user_id',
        'u.user_full_name',
        'u.user_phone',
        'u.user_comment',
        'u.user_lng',
        'u.user_lat'
      ])
      ->where('u.user_state', 'active');

    if ($filterCity) {
      $query->join('cities as c', DB::raw("ST_CONTAINS(c.geom, GeomFromText(CONCAT('POINT(', u.user_lng, ' ', u.user_lat, ')'), 1))"), '=', DB::raw('1'))
        ->where('c.city_id', $filterCity);
    }

    if (!$withCoordinatesNull) {
      $query->whereNotNull('u.user_lng')
        ->whereNotNull('u-user_lat');
    }

    if ($filterProducts) {
      $query->join('products_users as p_u', 'p_u.user_id', '=', 'u.user_id')
        ->join('products as p', 'p.product_id', '=', 'p_u.product_id')
        ->whereIn('p.product_id', $filterProducts);
    }

    // Exclude certain users (e.g., not in Paraguay) and
    // apply temporary limit if needed
    $query->whereNotIn('u.user_id', [69, 122])
      ->limit(env('LIMIT_VENDORS_WENDA', 100))
      ->orderBy('u.user_registration', 'desc');

    $resultData = $query->get();
    $total = DB::table(DB::raw('users'))
      ->selectRaw('FOUND_ROWS() AS total')
      ->value(
        'total'
      );

    return [
      'total' =>  $total,
      'data'  =>  $resultData->toArray()
    ];
  }

  /**
   * Insert a new user.
   *
   * @param array $data
   * @return int
   */
  public function setUser(array $data)
  {
    return $this->create($data)->user_id;
  }

  /**
   * Insert a role-user association.
   *
   * @param int $roleId
   * @param int $userId
   * @return bool
   */
  public function setRoleUser(int $role_id, int $user_id)
  {
    return DB::table('roles_users')->insert(
      [
        'user_id' => $user_id,
        'role_id' => $role_id
      ]
    );
  }
}
