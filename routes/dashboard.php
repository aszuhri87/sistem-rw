<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
Route::get('/dashboard', function () {
    $warga_rt = DB::table('warga')
             ->select(DB::raw('count(*) as jumlah, rt'))
             ->groupBy('rt')
             ->get();

    $warga_jenis_kelamin = DB::table('warga')
             ->select(DB::raw('count(*) as jumlah, jenis_kelamin'))
             ->groupBy('jenis_kelamin')
             ->get();

    $kas_warga = DB::table('kas_warga')
             ->select(DB::raw("sum(nominal) as jumlah "),DB::raw("DATE_FORMAT(tanggal,'%M %Y') as bulan"))
             ->groupBy("bulan")
             ->get();
           //  dd($kas_warga);

    return view('dashboard.index',[
        'warga_rt' => $warga_rt,
        'warga_jenis_kelamin' => $warga_jenis_kelamin,
        'kas_warga' => $kas_warga
    ]);
});
