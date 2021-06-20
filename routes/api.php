<?php

use App\Models\Publication;
use App\Models\Category;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//return $request->user();
//});

//Rutas para Publicaciones
Route::get('publications', 'App\Http\Controllers\PublicationController@index');
Route::get('publications/{publication}', 'App\Http\Controllers\PublicationController@show');
Route::post('publications', 'App\Http\Controllers\PublicationController@store');
Route::put('publications/{publication}', 'App\Http\Controllers\PublicationController@update');
Route::delete('publications/{publication}', 'App\Http\Controllers\PublicationController@delete');

//Rutas para Categorias

Route::get('categories', 'App\Http\Controllers\CategoryController@index');
Route::get('categories/{category}', 'App\Http\Controllers\CategoryController@show');
Route::post('categories', 'App\Http\Controllers\CategoryController@store');
Route::put('categories/{category}', 'App\Http\Controllers\CategoryController@update');
Route::delete('categories/{category}', 'App\Http\Controllers\CategoryController@delete');
