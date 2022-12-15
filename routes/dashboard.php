<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $rt = \Session::get('admin')->rt;

    // $rt = Auth::user()->rt;

    $warga_rt_res = null;
    $jimpit_res = null;
    $warga_jk_res = null;
    $warga_res = null;
    $kas_warga_res = null;
    $kas_masuk_res = null;
    $kas_keluar_res = null;

    $warga_rt = DB::table('warga')
        ->select(DB::raw('count(*) as jumlah, rt'))
        ->groupBy('rt');

    if ($rt == null) {
        $warga_rt_res = $warga_rt->get();
    } else {
        $warga_rt_res = $warga_rt->where('rt', $rt)->get();
    }

    $warga_jenis_kelamin = DB::table('warga')
        ->select([
            DB::raw('count(*) as jumlah'),
            DB::raw("CASE WHEN jenis_kelamin = 'L' THEN 'Laki-laki' ELSE 'Perempuan' END as jenis_kelamin"),
           ])
        ->groupBy('jenis_kelamin');

    if ($rt == null) {
        $warga_jk_res = $warga_jenis_kelamin->get();
    } else {
        $warga_jk_res = $warga_jenis_kelamin->where('rt', $rt)->get();
    }

    $kas_masuk = \App\Models\KasWarga::select([
        \DB::raw('SUM(nominal) as count'),
    ])
    ->where('tipe', 'masuk');

    if ($rt == null) {
        $kas_masuk_res = $kas_masuk->first()->count;
    } else {
        $kas_masuk_res = $kas_masuk->where('rt', $rt)->first()->count;
    }

    $kas_keluar = \App\Models\KasWarga::select([
        \DB::raw('SUM(nominal) as count'),
    ])
    ->where('tipe', 'keluar');

    if ($rt == null) {
        $kas_keluar_res = $kas_keluar->first()->count;
    } else {
        $kas_keluar_res = $kas_keluar->where('rt', $rt)->first()->count;
    }

    $kas_warga = \App\Models\KasWarga::select(DB::raw('sum(nominal) as jumlah '), DB::raw("DATE_FORMAT(tanggal,'%M %Y') as bulan"))
    ->groupBy('bulan');

    if ($rt == null) {
        $kas_warga_res = $kas_warga->get();
    } else {
        $kas_warga_res = $kas_warga->where('rt', $rt)->get();
    }

    $jimpit = \App\Models\Jimpitan::select([
        \DB::raw('SUM(jimpitan.nominal) as count'),
    ])->leftJoin('warga', 'warga.id', 'jimpitan.id_warga');

    if ($rt == null) {
        $jimpit_res = $jimpit->first();
    } else {
        $jimpit_res = $jimpit->where('rt', $rt)->first();
    }

    $warga = \App\Models\Warga::select([
        \DB::raw('count(id) as count'),
    ]);

    if ($rt == null) {
        $warga_res = $warga->first()->count;
    } else {
        $warga_res = $warga->where('rt', $rt)->first()->count;
    }

    $jimpit_per_bulan = \App\Models\Jimpitan::select(DB::raw('sum(jimpitan.nominal) as count'), DB::raw('MONTHNAME(jimpitan.tanggal) as bulan'))
    ->leftJoin('warga', 'warga.id', 'jimpitan.id_warga')
    ->where('jimpitan.id', '!=', null)
    ->whereYear('jimpitan.tanggal', date('Y'))
    ->groupBy(DB::raw('MONTHNAME(jimpitan.tanggal)'), 'bulan');

    if ($rt == null) {
        $jimpit_per_bulan->get();
    } else {
        $jimpit_per_bulan->where('warga.rt', $rt)->get();
    }

    $jimpit_per_bulan_sum = \App\Models\Jimpitan::select(DB::raw('count(id) as count'), DB::raw('MONTHNAME(tanggal) as bulan'))
    ->where('id', '!=', null)
    ->whereYear('tanggal', date('Y'))
    ->groupBy(DB::raw('MONTHNAME(tanggal)'), 'bulan')
    ->get();

    $jimpit_data = [];
    foreach ($jimpit_per_bulan as $key => $row) {
        $jimpit_data['bulan'][] = $row['bulan'];
        $jimpit_data['count'][] = (int) $row['count'];
    }

    $jimpit_data_sum = [];
    foreach ($jimpit_per_bulan_sum as $key => $row) {
        $jimpit_data_sum['bulan'][] = $row['bulan'];
        $jimpit_data_sum['count'][] = (int) $row['count'];
    }

    return view('dashboard.index', [
        'warga_rt' => $warga_rt_res,
        'warga_jenis_kelamin' => $warga_jk_res,
        'kas_masuk' => $kas_masuk_res,
        'kas_keluar' => $kas_keluar_res,
        'jimpitan' => $jimpit_res->count,
        'warga' => $warga_res,
        'jimpit_per_bulan' => $jimpit_data,
        'jimpit_per_bulan_sum' => $jimpit_data_sum,
        'kas_warga' => $kas_warga_res,
    ]);
});
