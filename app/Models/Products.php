<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_id', 'product_name', 'product_type'];

    /**
     *
     * @method getProducts
     * @param int $userId
     * @param array $filterProducts
     * @return array
     */
    public function getProducts(int $userId, array $filterProducts = null)
    {
        $query = self::select([
            'p.product_name',
            'p.product_type'
        ])
            ->join('products_users as p_u', 'p_u.product_id', '=', 'p.product_id')
            ->join('users as u', 'u.user_id', '=', 'p_u.user_id')
            ->where('u.user_state', 'active')
            ->where('p_u.user_id', $userId);

        if (isset($filterProducts)) {
            $query->whereIn('p.product_id', $filterProducts);
        }

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
     *
     * @method getProductID
     * @param string $productType
     * @return array
     */
    public function getProductID(string $productType)
    {
        $query = self::select(['product_id'])
            ->where('product_type', $productType);

        return $query->get()->toArray();
    }

    /**
     * Insert product.
     * @method setProduct
     * @param array $data
     * @return type
     */
    public function setProduct(array $data)
    {
        DB::table('products')->insertGetId(
            [
                'product_type' => $data['product_type']
            ]
        );
    }

    /**
     * Insert product user.
     * @method setProductUser
     * @param int $productId
     * @param int $userId
     * @return type
     */
    public function setProductUser($productId, $userId)
    {
        return DB::table('products_users')->insert(
            [
                'product_id' => $productId,
                'user_id' => $userId
            ]
        );
    }
}
