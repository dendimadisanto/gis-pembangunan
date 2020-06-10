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


Route::group(['middleware' => ['checkBoleh']], function () {

    //Router::post('/do-login', 'UserController@doLogin');
    Route::get('/get-data-gis','GisController@get');
    Route::post('/get-gis-kegiatan','GisController@getKegiatan');
    Route::get('/get-sumber-dana','SumberDanaController@get');
    Route::get('/get-dana-byid/{id}','SumberDanaController@getByID');
    Route::post('/add-sumber-dana','SumberDanaController@addData');
    Route::post('/simpan-kegiatan-fisik', 'KegiatanFisikController@simpan');
    Route::get('/hapus-dana/{id}', 'SumberDanaController@hapus');
    Route::get('/get-kegiatan-fisik', 'KegiatanFisikController@get');
    Route::get('/get-kegiatanById/{id}', 'KegiatanFisikController@getByid');
    Route::post('/simpan-kegiatan-fisik', 'KegiatanFisikController@simpan');
    Route::get('/hapus-kegiatan/{id}', 'KegiatanFisikController@hapus');
    Route::get('/get-sumber-dana-all','SumberDanaController@all');
});


Route::get('{any}', function () {
    return view('welcome');
})->where('any','.*');
