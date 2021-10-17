<?php

use Illuminate\Support\Str;
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

$slug = Str::snake($module,"-");

Route::group(['namespace' => 'App\Modules\\'.$module.'\Controllers','middleware' => ['auth:sanctum'],'prefix'=>'api'], function () use ($slug, $module) {
    Route::get($slug, $module.'ApiController@index')->name($slug.'.api.read');
    Route::post($slug.'/store', $module.'ApiController@store')->name($slug.'.api.store');
    Route::get($slug.'/show/{id}', $module.'ApiController@show')->name($slug.'.api.show.read');
    Route::post($slug.'/update/{id}', $module.'ApiController@update')->name($slug.'.api.update');
    Route::get($slug.'/delete/{id}', $module.'ApiController@destroy')->name($slug.'.api.delete');
});
