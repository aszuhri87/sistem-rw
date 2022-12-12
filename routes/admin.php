<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/admin/get-tambah', function () {
    if (!session()->get('admin')) {
        return redirect('/login');
    }

    return view('admin.tambah');
});

Route::post('/admin/post-tambah', function (Request $request) {
    if (!session()->get('admin')) {
        return redirect('/login');
    }
    \App\Models\Admin::create([
    'nama' => $request->nama,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'level' => $request->level,
    'rt' => $request->rt,
    'rw' => $request->rw,
]);

    if ($admin) {
        return redirect('/admin/tampil')->with('message', 'Berhasil menambah!');
    } else {
        return redirect('/admin/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/admin/tampil', function () {
    if (!session()->get('admin')) {
        return redirect('/login');
    }
    $admin = \App\Models\Admin::all();

    return view('admin.tampil', [
    'admin' => $admin,
    ]);
});

Route::get('/admin/get-ubah/{id}', function ($id) {
    if (!session()->get('admin')) {
        return redirect('/login');
    }

    $admin = \App\Models\Admin::find($id);

    return view('admin.ubah', compact('admin'));
});

Route::post('/admin/post-ubah/{id}', function (Request $request, $id) {
    if (!session()->get('admin')) {
        return redirect('/login');
    }

    $password = null;

    $admin = \App\Models\Admin::find($id);

    if (!$request->password) {
        $password = $admin->password;
    } else {
        $password = Hash::make($request->password);
    }
    $admin->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => $password,
        'level' => $request->level,
        'rt' => $request->rt,
        'rw' => $request->rw,
    ]);

    if ($admin) {
        return redirect('/admin/tampil')->with('message', 'Berhasil mengubah!');
    } else {
        return redirect('/admin/tampil')->withErrors('error', 'Gagal!');
    }
});

Route::get('/admin/get-hapus/{id}', function ($id) {
    if (!session()->get('admin')) {
        return redirect('/login');
    }
    \App\Models\Admin::find($id)->delete();

    return redirect('/admin/tampil');
});
