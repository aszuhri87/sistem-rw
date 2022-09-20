<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/kas-warga/tambah', function () { 
    return view('kas-warga.tambah');
});

Route::post('/kas-warga/post-tambah', function (Request $request) {
    \App\Models\KasWarga::create([
        'nominal' => $request-> nominal,
        'tanggal' => $request-> tanggal,
    ]);

    return redirect('kas-warga/tampil');
});

Route::get('/kas-warga/tampil', function (Request $request) { 
    $kas_warga = \App\Models\KasWarga::all();

    return view('kas-warga.tampil', [ 
        'kas_warga' => $kas_warga
    ]);
});

Route::get('/kas-warga/hapus/{id}', function ($id) {

    \App\Models\KasWarga::find($id)->delete();

    return redirect('kas-warga/tampil');
});
Route::post('/kas-warga/post-ubah/{id}', function (Request $request, $id) {
    $kas_warga = \App\Models\KasWarga::find($id)->update([
        'nominal' => $request->nominal,
        'tanggal' => $request->tanggal,
    ]);
    return redirect('kas-warga/tampil');
});

Route::get('/kas-warga/ubah/{id}', function ($id) {

    $kas_warga = \App\Models\KasWarga::find($id);
    return view('kas-warga.ubah', [ 
        'kas_warga' => $kas_warga
    ]);
});