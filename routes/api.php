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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'namespace' => 'App\\Http\\Api\\Controllers'
    ],
    function () {
        Route::group(
            [
                'prefix' => 'news'
            ],
            function () {
                // Queries
                Route::get('/', 'NewsController@index');

                // Commands
                Route::post('/', 'NewsController@store');
                Route::put('/{id}', 'NewsController@update');
                Route::delete('/{id}', 'NewsController@destroy');
            }
        );
    }
);
