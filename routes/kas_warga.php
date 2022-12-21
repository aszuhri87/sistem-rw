<?php

use App\Models\RtRw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/kas-warga/tambah', function () {
    $rt;

    if (!Auth::user()->id_rt_rw) {
        $rt = RtRw::all();
    } else {
        $rt = RtRw::where('id', Auth::user()->id_rt_rw)->get();
    }

    return view('kas-warga.tambah', compact('rt'));
});

Route::post('/kas-warga/post-tambah', function (Request $request) {
    $rt;

    if ($request->rt) {
        $rt = $request->rt;
    } else {
        $rt = Auth::user()->id_rt_rw;
    }

    $kas = \App\Models\KasWarga::create([
        'nominal' => $request->nominal,
        'tanggal' => $request->tanggal,
        'tipe' => $request->tipe,
        'kategori' => $request->kategori,
        'catatan' => $request->catatan,
        'id_rt_rw' => $rt,
    ]);

    if ($kas) {
        return redirect('/kas-warga/tampil')->with('message', 'Berhasil Menambah!');
    } else {
        return redirect('/kas-warga/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/kas-warga/tampil', function (Request $request) {
    $kas_warga = null;
    $rt = Auth::user()->id_rt_rw;

    $result = \App\Models\KasWarga::select([
        'kas_warga.*',
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
    ->leftJoin('rt_rw', 'rt_rw.id', 'kas_warga.id_rt_rw')
    ->whereNull('kas_warga.deleted_at')
    ->orderBy('tanggal', 'desc');

    if ($rt) {
        $kas_warga = $result->where('id_rt_rw', $rt)->paginate(10);
    } else {
        $kas_warga = $result->paginate(10);
    }

    return view('kas-warga.tampil', [
        'kas_warga' => $kas_warga,
    ]);
});

Route::get('/kas-warga/filter', function (Request $request) {
    $rt = Auth::user()->id_rt_rw;

    $result = \App\Models\KasWarga::select([
        'kas_warga.*',
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
    ->leftJoin('rt_rw', 'rt_rw.id', 'kas_warga.id_rt_rw')
    ->whereNull('kas_warga.deleted_at')
    ->where('tipe', 'like', '%'.$request->cari.'%');

    $kas_warga = null;

    if ($rt == null) {
        $kas_warga = $result;
    } else {
        $kas_warga = $result->where('id_rt_rw', $rt);
    }

    if ($request->kategori) {
        $kas_warga->where('kategori', 'like', '%'.$request->kategori.'%');
    }

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
    $rt;

    if ($request->rt) {
        $rt = $request->rt;
    } else {
        $rt = Auth::user()->id_rt_rw;
    }

    $kas_warga = \App\Models\KasWarga::find($id)->update([
        'nominal' => $request->nominal,
        'tanggal' => $request->tanggal,
        'kategori' => $request->kategori,
        'catatan' => $request->catatan,
        'tipe' => $request->tipe,
        'id_rt_rw' => $rt,
    ]);

    if ($kas_warga) {
        return redirect('/kas-warga/tampil')->with('message', 'Berhasil Mengubah!');
    } else {
        return redirect('/kas-warga/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/kas-warga/ubah/{id}', function ($id) {
    $kas_warga = \App\Models\KasWarga::select([
        'kas_warga.*',
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
    ->leftJoin('rt_rw', 'rt_rw.id', 'kas_warga.id_rt_rw')
    ->where('kas_warga.id', $id)
    ->first();

    $rt;

    if (!Auth::user()->id_rt_rw) {
        $rt = RtRw::all();
    } else {
        $rt = RtRw::where('id', Auth::user()->id_rt_rw)->get();
    }

    return view('kas-warga.ubah', [
        'kas_warga' => $kas_warga,
        'rt' => $rt,
    ]);
});

Route::get('/kas-warga/lihat/{id}', function ($id) {
    $kas_warga = \App\Models\KasWarga::select([
        'kas_warga.*',
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
    ->leftJoin('rt_rw', 'rt_rw.id', 'kas_warga.id_rt_rw')
    ->whereNull('kas_warga.deleted_at')
    ->where('kas_warga.id', $id)
    ->first();

    return view('kas-warga.lihat', [
        'kas_warga' => $kas_warga,
    ]);
});
