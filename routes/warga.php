<?php

use App\Imports\WargaImport;
use App\Models\RtRw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/warga/tambah', function () {
    $rt;

    if (!Auth::user()->id_rt_rw) {
        $rt = RtRw::all();
    } else {
        $rt = RtRw::where('id', Auth::user()->id_rt_rw)->get();
    }

    return view('warga.tambah', compact('rt'));
});

Route::post('/warga/post-tambah', function (Request $request) {
    $warga = \App\Models\Warga::create([
        'no_kk' => $request->no_kk,
        'nik' => $request->nik,
        'nama_lengkap' => $request->nama_lengkap,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'agama' => $request->agama,
        'alamat' => $request->alamat,
        'id_rt_rw' => $request->rt,
        'pendidikan' => $request->pendidikan,
        'pekerjaan' => $request->pekerjaan,
        'kewarganegaraan' => $request->kewarganegaraan,
        'status_perkawinan' => $request->status_perkawinan,
        'status_dalam_keluarga' => $request->status_dalam_keluarga,
        'nama_ayah' => $request->nama_ayah,
        'nama_ibu' => $request->nama_ibu,
        'keterangan' => $request->keterangan,
    ]);

    if ($warga) {
        return redirect('/warga/tampil')->with('message', 'Berhasil Menambah!');
    } else {
        return redirect('/warga/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/warga/tampil', function (Request $request) {
    $rt = Auth::user()->id_rt_rw;

    $result = \DB::table('warga')->select([
        'warga.*',
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
    ->leftJoin('rt_rw', 'rt_rw.id', 'warga.id_rt_rw')
    ->whereNull('warga.deleted_at')
    ->orderBy('warga.created_at', 'desc');

    $warga = null;

    if ($rt == null) {
        $warga = $result->paginate(10);
    } else {
        $warga = $result->where('id_rt_rw', $rt)->paginate(10);
    }

    return view('warga.tampil', compact('warga'));
});

Route::get('/warga/filter', function (Request $request) {
    $warga = null;
    $rt = Auth::user()->id_rt_rw;

    $result = \App\Models\Warga::select([
        'warga.*',
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
    ->leftJoin('rt_rw', 'rt_rw.id', 'warga.id_rt_rw')
    ->where('no_kk', 'like', '%'.$request->cari.'%')
    ->orWhere('nama_lengkap', 'like', '%'.$request->cari.'%')
    ->orWhere('nik', 'like', '%'.$request->cari.'%')
    ->orderBy('warga.created_at', 'desc')
    ->whereNull('warga.deleted_at');

    if ($rt == null) {
        $warga = $result;
    } else {
        $warga = $result->where('id_rt_rw', $rt);
    }

    return response()->json([
        'status' => 'success',
        'data' => $warga->get(),
        'message' => 'Information load successfully!',
    ], 200);
});

Route::get('/warga/ubah/{id}', function ($id) {
    $rt;

    if (!Auth::user()->id_rt_rw) {
        $rt = RtRw::all();
    } else {
        $rt = RtRw::where('id', Auth::user()->id_rt_rw)->get();
    }
    $warga = \App\Models\Warga::find($id);

    return view('warga.ubah', compact('warga', 'rt'));
});

Route::post('/warga/post-ubah/{id}', function (Request $request, $id) {
    $warga = \App\Models\Warga::find($id)->update([
        'no_kk' => $request->no_kk,
        'nik' => $request->nik,
        'nama_lengkap' => $request->nama_lengkap,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'agama' => $request->agama,
        'alamat' => $request->alamat,
        'id_rt_rw' => $request->rt,
        'pendidikan' => $request->pendidikan,
        'pekerjaan' => $request->pekerjaan,
        'kewarganegaraan' => $request->kewarganegaraan,
        'status_perkawinan' => $request->status_perkawinan,
        'status_dalam_keluarga' => $request->status_dalam_keluarga,
        'nama_ayah' => $request->nama_ayah,
        'nama_ibu' => $request->nama_ibu,
        'keterangan' => $request->keterangan,
    ]);

    if ($warga) {
        return redirect('/warga/tampil')->with('message', 'Berhasil Mengubah!');
    } else {
        return redirect('/warga/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/warga/hapus/{id}', function ($id) {
    \App\Models\Warga::find($id)->delete();

    return redirect('/warga/tampil');
});

Route::get('/warga/lihat/{id}', function ($id) {
    $warga = \App\Models\Warga::select([
        'warga.*',
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
    ->leftJoin('rt_rw', 'rt_rw.id', 'warga.id_rt_rw')
    ->where('warga.id', $id)
    ->whereNull('warga.deleted_at')
    ->first();

    return view('warga.lihat', compact('warga'));
});

Route::get('/warga/import', function () {
    return view('warga.import');
});

Route::get('/warga/download-format', function () {
    $file = public_path().'/contoh-format.xlsx';

    return Response::download($file, 'format.xlsx');
});

Route::post('/warga/post-import', function (Request $request) {
    $excel = Excel::import(new WargaImport(), $request->file);

    if ($excel) {
        return redirect('/warga/tampil')->with('message', 'Berhasil Menambah!');
    } else {
        return redirect('/warga/tampil')->withErrors('error', 'Gagal!');
    }
});
