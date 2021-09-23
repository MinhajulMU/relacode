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

Route::group(['namespace' => 'App\Modules\\'.$module.'\Controllers','middleware' => ['web','auth','module.privilege']], function () use ($slug, $module) {
    Route::resource($slug, $module . 'Controller');
    Route::get($slug."/restore/index", $module . 'Controller@restore')->name($slug.'.restore.index');
});
