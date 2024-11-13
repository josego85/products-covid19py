<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Services\GisService;
use App\Services\ResponseService;
use App\Services\VendorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function __construct(
        private VendorService $vendorService,
        private GisService $gisService,
        private ResponseService $responseService
    ) {}
    /**
     * Retorna un listado de vendedores
     */
    public function getVendors(Request $request)
    {
        $filters = $this->prepareFilters($request);
        $vendors = $this->vendorService->getFilteredVendors($filters);

        return $this->gisService->createGeoJson($vendors);
    }


    /**
     *
     * Inserta un nuevo vendedor
     *
     * @param Request $request
     */
    public function postVendor(VendorRequest $request)
    {

        try {
            DB::beginTransaction();

            $vendor = $this->vendorService->createVendor($request);
            DB::commit();
            return $this->responseService->success('Vendedor guardado.', $vendor);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseService->error($e->getMessage());
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
