<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/jimpitan/tambah', function () {
    return view('jimpitan/tambah');
});

Route::post('/jimpitan/tambah', function (Request $request) {

    $admin = session()->get('admin');
    \App\Models\Jimpitan::create([
        'id_warga' => $request->id_warga,
        'nominal' => $request->nominal,
        'id_admin' => $admin->id ,

    ]);

    return redirect('jimpitan/tampil');
});
Route::get('/jimpitan/tampil', function () {

    $jimpitan = \DB::select("SELECT jimpitan.*,warga.nama_lengkap FROM `jimpitan` 
    left join warga on warga.id = jimpitan.id_warga;");

    return view('jimpitan/tampil', [
        'jimpitan' => $jimpitan
    ]);
});
Route::get('/jimpitan/hapus/{id}', function ($id) {

    \App\Models\Jimpitan::find($id)->delete();

    return redirect('jimpitan/tampil');
});
Route::post('/jimpitan/ubah/{id}', function (Request $request, $id) {

    $admin = session()->get('admin');
    $jimpitan = \App\Models\Jimpitan::find($id)->update([
        'nominal' => $request->nominal,
        'id_admin' => $admin->id ,
    ]);
    return redirect('jimpitan/tampil');
});

Route::get('/jimpitan/ubah/{id}', function ($id) {

    $jimpitan = \App\Models\Jimpitan::find($id);
    return view('jimpitan/ubah', compact('jimpitan'));
});

