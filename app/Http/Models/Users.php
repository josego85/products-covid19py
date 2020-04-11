<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Users
{

    /**
     * 
     * @method getUsers
     * @param  void
     * @return array
     */
    public function getUsers ($filter_products = null)
    {
        $expression_raw = 'SQL_CALC_FOUND_ROWS u.user_id, u.user_full_name, u.user_phone, u.user_lng, ' .
          'u.user_lat';

        $query = DB::table('users as u')
          ->select(array( DB::raw($expression_raw)));

        if (isset($filter_products))
        {
            $query->join('products_users as p_u', 'p_u.user_id', '=' ,'u.user_id')
              ->join('products as p', 'p.product_id', '=' ,'p_u.product_id')
              ->whereIn('p.product_id', $filter_products)
              ->groupBy('u.user_id')
              ->groupBy('u.user_full_name')
              ->groupBy('u.user_phone')
              ->groupBy('u.user_lng')
              ->groupBy('u.user_lat');
        }
          
        $result = $query->get();
        $total = DB::select(DB::raw("SELECT FOUND_ROWS() AS total;"))[0];
        $return = [
            'total' =>  $total->total,
            'data'  =>  $result->all()
        ];
        return $return;
    }

    /**
     * Insert user.
     * @method setUser
     * @param array $p_data
     * @return type
     */
    public function setUser ($p_data)
    {
        $user_id = DB::table('users')->insertGetId($p_data);
        return $user_id;
    }

    /**
     * Insert role user.
     * @method setRoleUser
     * @param int $role_id
     * @param int $user_id
     * @return type
     */
    public function setRoleUser ($role_id, $user_id)
    {
        $result = DB::table('roles_users')->insert(
        [
            'user_id' => $user_id,
            'role_id' => $role_id
        ]);
        return $result;
    }
}