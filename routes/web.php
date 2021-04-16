<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
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

Route::get('/', function () {
    // return view('welcome');
    Cache::store('redis')->put('bar', 'baz', 600);
    return Cache::get('bar');
    // return 1;
    $ss = [];
    $id = 1000001;
    $map = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $result = [];
    while ($id > 0) {
        $result[] = $map[$id % 62];
        $id = floor($id / 62);
    }
    $result = array_reverse($result);

    $ss[] = $short_link = join("", $result);

    $id = 1000027;
    $map = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $result = [];
    while ($id > 0) {
        $result[] = $map[$id % 62];
        $id = floor($id / 62);
    }
    $result = array_reverse($result);

    $ss[] = $short_link = join("", $result);

    return $ss;
});
