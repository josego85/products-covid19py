<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Products
{
    /**
     * 
     * @method getProducts
     * @param int $p_user_id
     * @param array $filter_products
     * @return array
     */
    public function getProducts($p_user_id, $filter_products = null)
    {
        $expression_raw = 'SQL_CALC_FOUND_ROWS p.product_name, p.product_type';

        $query = DB::table('products as p')
          ->select(array( DB::raw($expression_raw)))
          ->join('products_users as p_u', 'p_u.product_id', '=' ,'p.product_id')
          ->join('users as u', 'u.user_id', '=' ,'p_u.user_id')
          ->where('u.user_state', 'active')
          ->where('p_u.user_id', $p_user_id);

        if (isset($filter_products))
        {
            $query->whereIn('p.product_id', $filter_products);
        }
          
        $result = $query->get();
        $total = DB::select(DB::raw("SELECT FOUND_ROWS() AS total;"))[0];

        return [
            'total' =>  $total->total,
            'data'  =>  $result->all()
        ];
    }

    /**
     * 
     * @method getProductID
     * @param string $p_product_type
     * @return array
     */
    public function getProductID ($p_product_type)
    {
        $expression_raw = 'p.product_id';

        $query = DB::table('products as p')
          ->select(array( DB::raw($expression_raw)))
          ->where('p.product_type', $p_product_type);
          
        $result = $query->get();

        return $result->all();
    }

    /**
     * Insert product.
     * @method setProduct
     * @param type $p_data
     * @return type
     */
    public function setProduct ($p_data)
    {
        DB::table('products')->insertGetId(
        [
            'product_type' => $p_data['product_type']
        ]);
    }

    /**
     * Insert product user.
     * @method setProductUser
     * @param int $p_product_id
     * @param int $p_user_id
     * @return type
     */
    public function setProductUser ($p_product_id, $p_user_id)
    {
        return DB::table('products_users')->insert(
        [
            'product_id' => $p_product_id,
            'user_id' => $p_user_id
        ]);
    }
}