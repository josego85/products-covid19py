<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Users
{

    /**
     * Public method that returns all users. 
     * In case you have the product filter, it will return all the users that contain those products.
     * @method getUsers
     * @param  void $p_filter_products
     * @param  void $p_filter_city
     * @return array
     */
    public function getUsers ($p_filter_products = null, $p_filter_city = null)
    {
        $expression_raw = 'SQL_CALC_FOUND_ROWS u.id, u.name, u.phone, u.comment, u.longitude, ' .
          'u.latitude';
        if (isset($p_filter_city))
        {
            $sql_join = "";
            $sql_where = "";
            if (isset($p_filter_products))
            {
                $products = "(" . join(',', $p_filter_products) . ")";
                $sql_join = "JOIN products_users as p_u ON p_u.user_id = u.id
                  JOIN products as p ON p.product_id = p_u.product_id";
                $sql_where = "and p.product_id IN $products";
            }
            $sql = "SELECT $expression_raw
              FROM
                users as u
              $sql_join
              JOIN cities as c
                ON 
                    ST_CONTAINS(
                      c.geom,
                      GeomFromText(CONCAT('POINT(', u.longitude, ' ', u.latitude, ')'), 1)
                    )
              WHERE c.city_id = $p_filter_city and u.user_state = 'active'
                $sql_where
                GROUP By u.id, u.name, u.phone, u.comment, u.longitude, u.latitude
                ORDER BY u.created_at DESC;
            ";
            $query = DB::select(DB::raw($sql));
            $result_data = $query;
        }
        else
        {
            $query = DB::table('users as u')
            ->select(array( DB::raw($expression_raw)));
            $query->where('u.state', 'active');
            $query->orderBy('u.created_at', 'desc');

            if (isset($p_filter_products))
            {
                $query->join('products_users as p_u', 'p_u.user_id', '=' ,'u.id')
                  ->join('products as p', 'p.product_id', '=' ,'p_u.product_id')
                  ->whereIn('p.product_id', $p_filter_products)
                  ->groupBy('u.id')
                  ->groupBy('u.name')
                  ->groupBy('u.phone')
                  ->groupBy('u.comment')
                  ->groupBy('u.longitude')
                  ->groupBy('u.latitude');
            }
            $result = $query->get();
            $result_data = $result->all();
        }
        $total = DB::select(DB::raw("SELECT FOUND_ROWS() AS total;"))[0];
        $return =
        [
            'total' =>  $total->total,
            'data'  =>  $result_data
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