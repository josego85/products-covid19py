<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('/disclaimer', function () {
    return view('pages.disclaimer');
});

Route::get('/vendors', function () {
    return view('vendors');
});

Route::get('/sitemap.xml', 'SiteMapController@index');

// // Create image upload form.
// Route::get('/image-upload', 'ImageUpload@createForm');

// // Store image.
// Route::post('/image-upload', 'ImageUpload@imageUpload')->name('imageUpload');

/**
 * Utilidades Paralelas, mejorar para la aplicacion que se iran insertando 
 * de manera gradual
 * @since 1.*
 * 
 */ 
// Route::prefix('p')->namespace('Web')->group(function(){

// 	Route::get('/', function () {
// 	    return view('pages.index');
// 	});

// 	Route::get('/disclaimer', function () {
// 	    return view('pages.disclaimer');
// 	});

// 	Route::get('/vendor', function () {
// 	    return view('pages.vendor-create');
// 	});

// 	// Nuevas funcionalidades
// 	Route::resources([
// 		'vendors' => 'VendorCtrl'
// 	]);
// });