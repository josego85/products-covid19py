<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users as usersModel;
use App\Models\Products as productsModel;
use App\Libraries\GIS;
use App\Libraries\Utils;
use Validator;

class Vendors extends Controller
{   


    /**
     * Retorna un listado de vendedores
     */
    public function getVendors(Request $request)
    {
        // @todo validation
        $user = new usersModel();
        $products = new productsModel();

        // Parameters
        $products_filter = json_decode($this->securityCleanCode($request->input('products')));
        $filter_products = null;
        if ($products_filter != null)
        {
            foreach ($products_filter as $product)
            {
                $result_product = $products->getProductID($product);
                $product_id = $result_product[0]->product_id;
                $filter_products[] = $product_id;
            }
        }
        $result_vendors = $user->getUsers($filter_products);
        $vendors = $result_vendors['data'];

        foreach($vendors as $vendor)
        {
            $vendor_id = $vendor->user_id;
            $result_products = $products->getProducts($vendor_id, $filter_products);
            $total = $result_products['total'];
            $vendor->products = null;
            
            if ($total != 0)
            {
                $data = $result_products['data'];
                $vendor->products = $data;
            }
        }
        $geo_json = $vendors;
        $GISFunctions = new GIS;

        return $GISFunctions->create_geo_json($geo_json);
    }


    /**
     * 
     * Inserta un nuevo vendedor
     * 
     * @param Request $request
     */
    public function postVendor(Request $request)
    {
        $validador = Validator::make($request->all(),
        [            
            'user_email' => 'email|nullable',
            'user_phone' => 'required|numeric',
            'user_lat' => 'required_without:user_lng|numeric',
            "products" => "required|array|min:1"
        ],
        [
            'user_phone.required'       => 'El contacto es obligatorio.',
            'user_lat.required_without' => 'La ubicaci&oacute;n en el mapa es obligatoria.',
            'user_lng.required'         => 'La ubicaci&oacute;n en el mapa es obligatoria.',
            'products.required'         => 'Tiene que agregar por lo menos 1 producto.'
        ]);
        if ($validador->fails())
        {
            return json_encode(array
            (
                'success' => true,
                'result' => false,
                'errors' => $validador->errors()->all()
            ),
            JSON_PRETTY_PRINT);
        }

        $user_email = $this->securityCleanCode($request->input("user_email"));
        $user_full_name = $this->securityCleanCode($request->input("user_full_name"));
        $user_phone = $this->securityCleanCode($request->input("user_phone"));
        $user_lng = $this->securityCleanCode($request->input("user_lng"));
        $user_lat = $this->securityCleanCode($request->input("user_lat"));

        DB::beginTransaction();
        
        try 
        {
            $user = new usersModel();
            $data_user =
            [
                'user_full_name' => $user_full_name,
                'user_email' => $user_email,
                'user_registration' => $this->getDateHour(),
                'user_phone' => $user_phone,
                'user_lng' => ($user_lng)? $user_lng : null,
                'user_lat' => ($user_lat)? $user_lat : null
            ];
            $user_id = $user->setUser($data_user);
            $user->setRoleUser(2, $user_id);

            $product_model = new productsModel();

            // todo check products.
            
            $products = $this->securityCleanCode($request->input('products'));
            foreach ($products as $product)
            {
                if ($product != null)
                {
                    $result_product = $product_model->getProductID($product);
                    $product_id = $result_product[0]->product_id;
                    $product_model->setProductUser($product_id, $user_id);
                }
            }
            DB::commit();
            $msg = 'Vendedor guardado.';
        }
        catch (\Exception $e)
        {
            DB::rollback();
            $msg = $e->getMessage();
        }
        catch (\Throwable $e)
        {
            DB::rollback();
            $msg = 'Problemas en el servidor.';
        }

        $UtilsFunctions = new Utils;
        $code = 200;

        return $UtilsFunctions->json_response($code, $msg);
    }
}