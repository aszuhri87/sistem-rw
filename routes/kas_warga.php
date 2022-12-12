<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/kas-warga/tambah', function () {
    return view('kas-warga.tambah');
});

Route::post('/kas-warga/post-tambah', function (Request $request) {
    $rt = null;
    $rw = null;

    if ($request->rt) {
        $rt = \Session::get('admin')->rt;
    } else {
        $rt = $request->rt;
    }

    if ($request->rw) {
        $rw = \Session::get('admin')->rw;
    } else {
        $rw = $request->rw;
    }

    $kas = \App\Models\KasWarga::create([
        'nominal' => $request->nominal,
        'tanggal' => $request->tanggal,
        'tipe' => $request->tipe,
        'rt' => $rt,
        'rw' => $rw,
    ]);

    if ($kas) {
        return redirect('/kas-warga/tampil')->with('message', 'Berhasil Menambah!');
    } else {
        return redirect('/kas-warga/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/kas-warga/tampil', function (Request $request) {
    $kas_warga = null;
    $rt = \Session::get('admin')->rt;

    $result = \App\Models\KasWarga::select([
        '*',
    ])
    ->orderBy('tanggal', 'desc');

    if ($rt) {
        $kas_warga = $result->where('rt', $rt)->paginate(10);
    } else {
        $kas_warga = $result->paginate(10);
    }

    return view('kas-warga.tampil', [
        'kas_warga' => $kas_warga,
    ]);
});

Route::get('/kas-warga/filter', function (Request $request) {
    $kas_warga = \App\Models\KasWarga::select([
        '*',
    ])
    ->where('tipe', 'like', '%'.$request->cari.'%');

    if ($request->ke && $request->dari) {
        $kas_warga->whereBetween('tanggal', [$request->dari, $request->ke]);
    }

    return response()->json([
        'status' => 'success',
        'data' => $kas_warga->get(),
        'message' => 'Information load successfully!',
    ], 200);
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

    if ($kas_warga) {
        return redirect('/kas-warga/tampil')->with('message', 'Berhasil Mengubah!');
    } else {
        return redirect('/kas-warga/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/kas-warga/ubah/{id}', function ($id) {
    $kas_warga = \App\Models\KasWarga::find($id);

    return view('kas-warga.ubah', [
        'kas_warga' => $kas_warga,
    ]);
});
