<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/rt-rw/tambah', function () {
    return view('rt-rw.tambah');
});

Route::post('/rt-rw/post-tambah', function (Request $request) {
    $rt = \App\Models\RtRw::create([
        'rt' => $request->rt,
        'rw' => $request->rw,
    ]);

    if ($rt) {
        return redirect('/rt-rw/tampil')->with('message', 'Berhasil Menambah!');
    } else {
        return redirect('/rt-rw/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/rt-rw/tampil', function (Request $request) {
    $result = \App\Models\RtRw::select([
        '*',
    ])
    ->whereNull('rt_rw.deleted_at')
    ->orderBy('rt_rw.created_at', 'desc')
    ->paginate(10);

    return view('rt-rw.tampil', [
        'rt_rw' => $result,
    ]);
});

Route::get('/rt-rw/filter', function (Request $request) {
    $result = \App\Models\RtRw::select([
        '*',
    ])
    ->where('rt', 'like', '%'.$request->cari.'%')
    ->orWhere('rw', 'like', '%'.$request->cari.'%')
    ->whereNull('rt_rw.deleted_at')
    ->orderBy('rt_rw.created_at', 'desc')
    ->get();

    return response()->json([
        'status' => 'success',
        'data' => $result,
        'message' => 'Information load successfully!',
    ], 200);
});

Route::get('/rt-rw/hapus/{id}', function ($id) {
    \App\Models\RtRw::find($id)->delete();

    return redirect('rt-rw/tampil');
});

Route::post('/rt-rw/post-ubah/{id}', function (Request $request, $id) {
    $rt_rw = \App\Models\RtRw::find($id)->update([
        'rt' => $request->rt,
        'rw' => $request->rw,
    ]);

    if ($rt_rw) {
        return redirect('/rt-rw/tampil')->with('message', 'Berhasil Mengubah!');
    } else {
        return redirect('/rt-rw/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/rt-rw/get-ubah/{id}', function ($id) {
    $rt_rw = \App\Models\RtRw::find($id);

    return view('rt-rw.ubah', [
        'rt_rw' => $rt_rw,
    ]);
});
