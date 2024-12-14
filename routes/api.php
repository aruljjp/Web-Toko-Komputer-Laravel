<?php

use App\Http\Controllers\MobileCtrl;
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
// Route::get('/produk', [MobileCtrl::class, 'index']);
Route::group(['middleware'=>'cors'],function(){
    Route::get('/produk/{kategori?}','MobileCtrl@produk');
    Route::get("/getorder","MobileCtrl@getOrder");
    Route::get('/getdetailorder/{kdorder}','MobileCtrl@getDetailOrder');
    Route::post("/saveorder","MobileCtrl@saveOrder");
    Route::post('/login','MobileCtrl@login');
    Route::post('/register','MobileCtrl@register');
});