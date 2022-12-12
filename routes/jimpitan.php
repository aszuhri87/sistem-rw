<?php

use App\Exports\JimpitanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/jimpitan/tambah', function () {
    return view('jimpitan/tambah');
});

Route::post('/jimpitan/tambah', function (Request $request) {
    $warga = \App\Models\Warga::where('no_kk', $request->no_kk)->first();

    $admin = session()->get('admin');
    \App\Models\Jimpitan::create([
        'id_warga' => $warga->id,
        'nominal' => $request->nominal,
        'id_admin' => $admin->id,
    ]);

    if ($admin) {
        return redirect('jimpitan/tampil')->with('message', 'Berhasil Ditambahkan!');
    } else {
        return redirect('jimpitan/tampil')->withErrors('error', 'Penambahan jimpitan gagal!');
    }
});

Route::get('/jimpitan/tampil', function () {
    $rt = \Session::get('admin')->rt;

    $result = \DB::table('jimpitan')->select([
        'jimpitan.*',
        'warga.nama_lengkap',
    ])
    ->leftJoin('warga', 'warga.id', 'jimpitan.id_warga')
    ->orderBy('jimpitan.tanggal', 'desc');

    $jimpitan = null;

    if ($rt == null) {
        $jimpitan = $result->paginate(10);
    } else {
        $jimpitan = $result->where('warga.rt', $rt)->paginate(10);
    }

    return view('jimpitan/tampil', [
        'jimpitan' => $jimpitan,
    ]);
});

Route::get('/jimpitan/filter', function (Request $request) {
    $jimpitan = \App\Models\Jimpitan::select([
        'jimpitan.*',
        'warga.nama_lengkap',
    ])
    ->leftJoin('warga', 'warga.id', 'jimpitan.id_warga');

    if ($request->cari) {
        $jimpitan->where('warga.nama_lengkap', 'like', '%'.$request->cari.'%');
    }

    if ($request->ke && $request->dari) {
        $jimpitan->whereBetween('jimpitan.tanggal', [$request->dari, $request->ke]);
    }

    return response()->json([
        'status' => 'success',
        'data' => $jimpitan->get(),
        'message' => 'Information load successfully!',
    ], 200);
});

Route::get('/jimpitan/hapus/{id}', function ($id) {
    \App\Models\Jimpitan::find($id)->delete();

    return redirect('jimpitan/tampil');
});

Route::post('/jimpitan/ubah/{id}', function (Request $request, $id) {
    $admin = session()->get('admin');
    $jimpitan = \App\Models\Jimpitan::find($id)->update([
        'nominal' => $request->nominal,
        'id_admin' => $admin->id,
    ]);

    if ($jimpitan) {
        return redirect('/jimpitan/tampil')->with('message', 'Berhasil Mengubah!');
    } else {
        return redirect('/jimpitan/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/jimpitan/ubah/{id}', function ($id) {
    $jimpitan = \App\Models\Jimpitan::find($id);

    return view('jimpitan/ubah', compact('jimpitan'));
});

Route::get('/jimpitan/export', function () {
    return Excel::download(new JimpitanExport(), 'Laporan jimpitan bulan '.date('F').' - '.date('d-m-Y').'.xlsx');
});
