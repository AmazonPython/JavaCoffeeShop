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

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::get('/user', function( Request $request ){
        return $request->user();
    });

    /*
     |-------------------------------------------------------------------------------
     | 获取全部咖啡店
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes
     | Controller:     API\CafesController@getCafes
     | Method:         GET
     | Description:    获取该应用内的全部咖啡店
    */
    Route::get('/cafes', 'API\CafesController@getCafes');

    /*
     |-------------------------------------------------------------------------------
     | 找一个单独的咖啡馆
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes/{id}
     | Controller:     API\CafesController@getCafe
     | Method:         GET
     | Description:    找一个单独的咖啡馆
    */
    Route::get('/cafes/{id}', 'API\CafesController@getCafe');

    /*
     |-------------------------------------------------------------------------------
     | 添加一个新的咖啡店
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/cafes
     | Controller:     API\CafesController@postNewCafe
     | Method:         POST
     | Description:    在该应用内添加一个新的咖啡店
    */
    Route::post('/cafes', 'API\CafesController@postNewCafe');
});
