<?php

use App\Models\Publication;
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
Route::get('publications', function() {
    return Publication::all();
});
Route::get('publications/{id}', function($id) {
    return Publication::find($id);
});
Route::post('publications', function(Request $request) {
    return Publication::create($request->all());
});
Route::put('publications/{id}', function(Request $request, $id) {
    $article = Publication::findOrFail($id);
    $article->update($request->all());
    return $article;
});
Route::delete('publications/{id}', function($id) {
    Publication::find($id)->delete();
    return 204;
});

