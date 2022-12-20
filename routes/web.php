<?php

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
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

include base_path('routes/warga.php');

include base_path('routes/admin.php');

include base_path('routes/login.php');
include base_path('routes/jimpitan.php');
include base_path('routes/kas_warga.php');
include base_path('routes/dashboard.php');
include base_path('routes/qr.php');
include base_path('routes/rt_rw.php');

