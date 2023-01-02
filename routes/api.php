<?php

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
include base_path('routes/api/login.php');

Route::group(['middleware' => 'auth:api'], function () {
    include base_path('routes/api/jimpitan.php');
    include base_path('routes/api/dashboard.php');
});
