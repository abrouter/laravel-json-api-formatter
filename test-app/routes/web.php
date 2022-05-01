<?php

use AbRouter\JsonApiFormatter\DataSource\DataProviders\SimpleDataProvider;
use AbRouter\JsonApiFormatter\Example\Resources\UserSchema;
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
    return view('welcome');
});

Route::get('/zalupa', function () {
    $ad = new \stdClass();
    $ad->zhopa = 'zhopa2';
    $ad->profile = $ad;

    return new UserSchema(
        new SimpleDataProvider((new \App\Models\User())->newQuery()->get())
    );
});

