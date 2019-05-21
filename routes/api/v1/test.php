<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'namespace' => 'Api\v1\Test',
        'middleware' => ['auth:api', ],
    ],
    function () {
        Route::get('test', 'TestController@index');
    }
);
