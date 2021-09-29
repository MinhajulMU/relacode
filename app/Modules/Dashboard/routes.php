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
    Route::get($slug . "/change-role/{id_role?}", $module . "Controller@changeRole")->name($slug . ".change-role.update");
});

Route::group(['namespace' => 'App\Modules\\'.$module.'\Controllers', 'middleware' => ['web','auth','module.privilege']], function () use ($slug, $module) {
    Route::get("profile/index", $module . "Controller@profil")->name("dashboard.profile.index");
    Route::post("profile/edit", $module . "Controller@editProfil")->name("dashboard.profile.update");
    Route::put('profile/{id_user}',$module . "Controller@updateProfil")->name("dashboard.profile-update.update");
});

Route::group(['namespace' => 'App\Modules\\'.$module.'\Controllers', 'middleware' => ['web','auth','module.privilege']], function () use ($slug, $module) {
    Route::get("kamuflase/index", $module . "Controller@kamuflase")->name("kamuflase.index");
    Route::post("kamuflase/change", $module . "Controller@kamuflaseChange")->name("kamuflase.store");
});