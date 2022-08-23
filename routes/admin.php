<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/admin/get-tambah', function () { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    return view('admin.tambah');
});

Route::post('/admin/post-tambah', function (Request $request) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
\App\Models\Admin::create([
    'nama' => $request->nama,
    'email' => $request->email,
    'password' => $request->password,
]);

return redirect('admin/tampil');
});


Route::get('/admin/tampil', function () { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
$admin = \App\Models\Admin::all();

return view('admin.tampil', [
    
    'admin' => $admin
]);
});

Route::get('/admin/get-ubah/{id}', function ($id) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
$admin = \App\Models\Admin::find($id); 

return view('admin.ubah', compact('admin')); 
});

Route::post('/admin/post-ubah/{id}', function (Request $request, $id) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
$admin = \App\Models\Admin::find($id)->update([
    'nama' => $request->nama,
    'email' => $request->email,
    'password' => $request->password,
]); 

return redirect('/admin/tampil'); 
});

Route::get('/admin/get-hapus/{id}', function ($id) { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    \App\Models\Admin::find($id)->delete();

    return redirect('/admin/tampil');
});