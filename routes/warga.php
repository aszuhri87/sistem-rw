<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/warga/tambah', function () { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    return view('warga.tambah');
});

Route::post('/warga/post-tambah', function (Request $request) {
    if(!session()->get('admin')){
        return redirect('/login');
    }
    \App\Models\Warga::create([
        'no_kk' => $request-> no_kk,
        'nik' => $request-> nik,
        'nama_lengkap' => $request-> nama_lengkap,
        'tempat_lahir' => $request-> tempat_lahir, 
        'tanggal_lahir' => $request-> tanggal_lahir,
        'jenis_kelamin' => $request-> jenis_kelamin,
        'agama' => $request-> agama,
        'alamat' => $request-> alamat,
        'rt' => $request-> rt,
        'rw' => $request-> rw,
        'pendidikan' => $request-> pendidikan,
        'pekerjaan' => $request-> pekerjaan,
        'kewarganegaraan' => $request-> kewarganegaraan,
        'status_perkawinan' => $request-> status_perkawinan,
        'status_dalam_keluarga' => $request-> status_dalam_keluarga,
        'nama_ayah' => $request-> nama_ayah,
        'nama_ibu' => $request-> nama_ibu,
        'keterangan' => $request-> keterangan, 
    ]);

    return redirect('warga/tampil');
});

Route::get('/warga/tampil', function (Request $request) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    $warga = \App\Models\Warga::all();

    return view("warga.tampil", compact('warga'));
});

Route::get('/warga/ubah/{id}', function ($id) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    $warga = \App\Models\Warga::find($id); 

    return view('warga.ubah', compact('warga')); 
});

Route::post('/warga/post-ubah/{id}', function (Request $request, $id) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    $warga = \App\Models\Warga::find($id)->update([
        'no_kk' => $request-> no_kk,
        'nik' => $request-> nik,
        'nama_lengkap' => $request-> nama_lengkap,
        'tempat_lahir' => $request-> tempat_lahir, 
        'tanggal_lahir' => $request-> tanggal_lahir,
        'jenis_kelamin' => $request-> jenis_kelamin,
        'agama' => $request-> agama,
        'alamat' => $request-> alamat,
        'rt' => $request-> rt,
        'rw' => $request-> rw,
        'pendidikan' => $request-> pendidikan,
        'pekerjaan' => $request-> pekerjaan,
        'kewarganegaraan' => $request-> kewarganegaraan,
        'status_perkawinan' => $request-> status_perkawinan,
        'status_dalam_keluarga' => $request-> status_dalam_keluarga,
        'nama_ayah' => $request-> nama_ayah,
        'nama_ibu' => $request-> nama_ibu,
        'keterangan' => $request-> keterangan, 
    ]); 
    return redirect('/warga/tampil'); 
});

Route::get('/warga/hapus/{id}', function ($id) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    \App\Models\Warga::find($id)->delete();

    return redirect('/warga/tampil');
});

Route::get('/warga/lihat/{id}', function ($id) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    $warga = \App\Models\Warga::find($id);

    return view("warga.lihat", compact('warga'));
});

Route::get('/warga/import', function () { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    return view('warga.import');
});

Route::post('/warga/post-import', function (Request $request) {
    if(!session()->get('admin')){
        return redirect('/login');
    }
    \App\Models\Warga::create([
        'import_warga' => $request-> import_warga,
        
    ]);

    return redirect('warga/import');
});