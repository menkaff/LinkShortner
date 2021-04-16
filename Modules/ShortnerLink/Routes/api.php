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


Route::group([
    'prefix' => 'shortner-link/v0/',
    'namespace' => 'API',
], function ($api) {

    Route::get('/links', 'ShortnerLinkController@index');
    Route::post('/links/store', 'ShortnerLinkController@store');
    Route::post('/links/update', 'ShortnerLinkController@update');
    Route::get('/{short_link}', 'ShortnerLinkController@retrive');
    Route::get('/database/{short_link}', 'ShortnerLinkController@retriveDatabase');
});
