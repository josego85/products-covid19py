<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Services\GisService;
use App\Services\ResponseService;
use App\Services\SellerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerProductController extends Controller
{
    public function __construct(
        private SellerService $sellerService,
        private GisService $gisService,
        private ResponseService $responseService
    ) {
    }
    /**
     * Get all sellers.
     */
    public function getSellersWithProducts(Request $request)
    {
        $filters = $this->prepareFilters($request);
        $vendors = $this->sellerService->getFilteredVendors($filters);

        return $this->gisService->createGeoJson($vendors);
    }


    /**
     *
     * Create new seller.
     *
     * @param Request $request
     */
    public function postVendor(VendorRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $vendor = $this->sellerService->createVendor($data);
            DB::commit();
            return $this->responseService->jsonResponse(200, 'Vendedor guardado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseService->jsonResponse(400, $e->getMessage());
        }
    }

    private function prepareFilters(Request $request): array
    {
        return [
            'products' => json_decode($this->securityCleanCode($request->input('products'))),
            'city' => json_decode($this->securityCleanCode($request->input('city'))),
            'withCoordinatesNull' => $request->path() !== 'api/vendedores', // Parche plataforma wenda.
        ];
    }
}
