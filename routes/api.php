<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
});

Route::group(['middleware' => ['cors']], function () {
   // Routes to which access will be allowed.
   Route::get('/vendors', 'VendorController@getVendors')->name('getVendors');
   Route::post('/vendors', 'VendorController@postVendor')->name('postVendor');

   // Plataforma wenda. No cambiar la estructura ni la url porque se esta
   // utilizando en produccion.
   Route::get('/vendedores', 'VendorController@getVendors')->name('getVendors');
});