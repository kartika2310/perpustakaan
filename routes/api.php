<?php

use Illuminate\Http\Request;

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
// Route::group(
// ['as' => 'api.', 'middleware'=>['cors']],
// function(){
// 	Route::resource('latihan', 'API\LatihanController');
// }
// );
Route::group(['middleware' => 'cors'],function(){
});
Route::group(['middleware' => 'cors'],function(){
	Route::get('kelas','ApiController@kelas');
});
Route::group(['middleware' => 'cors'],function(){
	Route::get('buku','ApiController@buku');
});
Route::group(['middleware' => 'cors'],function(){
	Route::get('pengujung','ApiController@pengujung');
});
Route::group(['middleware' => 'cors'],function(){
	Route::get('pinjam','ApiController@pinjam');
});
Route::group(['middleware' => 'cors'],function(){
	Route::get('kembali','ApiController@kembali');
});
Route::group(['middleware' => 'cors'],function(){
	Route::get('siswa','ApiController@siswa');
});