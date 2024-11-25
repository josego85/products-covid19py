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
    Route::get('/vendors', 'SellerProductController@getSellersWithProducts')->name('getSellersWithProducts');
    Route::post('/vendors', 'SellerProductController@postSellersWithProducts')->name('postSellersWithProducts');

    // // Plataforma wenda. No cambiar la estructura ni la url porque se esta
    // // utilizando en produccion.
    // Route::get('/vendedores', 'SellerProductController@getUsers')->name('getUsers');
});
