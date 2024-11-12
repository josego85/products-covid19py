<?php

namespace App\Http\Controllers;

use App\Libraries\GIS;
use App\Libraries\Utils;
use App\Models\User as usersModel;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class VendorController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Retorna un listado de vendedores
     */
    public function getVendors(Request $request)
    {
        // Parche plataforma wenda.
        $with_coordinates_null = true;
        if ($request->path() === 'api/vendedores') {
            $with_coordinates_null = false;
        }

        // @todo validation
        $user = new usersModel();

        // Parameters
        $products_filter = json_decode($this->securityCleanCode($request->input('products')));
        $city_filter = json_decode($this->securityCleanCode($request->input('city')));
        $filter_products = null;
        if ($products_filter != null) {
            foreach ($products_filter as $product) {
                $result_product = $this->productRepository->getProductID($product);
                $product_id = $result_product[0]->product_id;
                $filter_products[] = $product_id;
            }
        }
        $result_vendors = $user->getUsers($filter_products, $city_filter, $with_coordinates_null);
        $vendors = $result_vendors['data'];

        foreach ($vendors as $vendor) {
            $vendor_id = $vendor->user_id;
            $result_products = $this->productRepository->getProducts($vendor_id, $filter_products);
            $total = $result_products['total'];
            $vendor->products = null;

            if ($total != 0) {
                $data = $result_products['data'];
                $vendor->products = $data;
            }
        }
        $geo_json = $vendors;
        $GISFunctions = new GIS();

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
        $validador = Validator::make(
            $request->all(),
            [
                'user_email' => 'email|nullable',
                'user_phone' => 'required|numeric',
                'user_comment' => 'max:4000',
                'user_lat' => 'required_without:user_lng|numeric',
                'products' => 'required|array|min:1'
            ],
            [
                'user_phone.required'       => 'El contacto es obligatorio.',
                'user_comment.max'          => 'La descripci&oacute;n no puede tener m&aacute; de 4000 car&aacute;cteres',
                'user_lat.required_without' => 'La ubicaci&oacute;n en el mapa es obligatoria.',
                'user_lng.required'         => 'La ubicaci&oacute;n en el mapa es obligatoria.',
                'products.required'         => 'Tiene que agregar por lo menos 1 producto.'
            ]
        );
        if ($validador->fails()) {
            return json_encode(
                [
                    'success' => true,
                    'result' => false,
                    'errors' => $validador->errors()->all()
                ],
                JSON_PRETTY_PRINT
            );
        }

        $user_email = $this->securityCleanCode($request->input('user_email'));
        $user_full_name = $this->securityCleanCode($request->input('user_full_name'));
        $user_phone = $this->securityCleanCode($request->input('user_phone'));
        $user_comment = $this->securityCleanCode($request->input('user_comment'));
        $user_lng = $this->securityCleanCode($request->input('user_lng'));
        $user_lat = $this->securityCleanCode($request->input('user_lat'));

        DB::beginTransaction();

        try {
            $user = new usersModel();
            $data_user =
                [
                    'user_full_name' => $user_full_name,
                    'user_email' => $user_email,
                    'user_registration' => $this->getDateHour(),
                    'user_phone' => $user_phone,
                    'user_comment' => $user_comment,
                    'user_lng' => ($user_lng) ? $user_lng : null,
                    'user_lat' => ($user_lat) ? $user_lat : null
                ];
            $user_id = $user->setUser($data_user);
            $user->setRoleUser(2, $user_id);

            // todo check products.

            $products = $this->securityCleanCode($request->input('products'));
            foreach ($products as $product) {
                if ($product != null) {
                    $resultProduct = $this->productRepository->getProductID($product);
                    $productId = $resultProduct[0]->product_id;
                    $user->products()->attach($productId);
                }
            }
            DB::commit();
            $msg = 'Vendedor guardado.';
        } catch (\Exception $e) {
            DB::rollback();
            $msg = $e->getMessage();
        } catch (\Throwable $e) {
            DB::rollback();
            $msg = 'Problemas en el servidor.';
        }

        $UtilsFunctions = new Utils();
        $code = 200;

        return $UtilsFunctions->json_response($code, $msg);
    }
}
