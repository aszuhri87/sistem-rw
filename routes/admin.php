<?php

use App\Models\RtRw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get("/admin/get-tambah", function () {
    $rt;

    if (!Auth::user()->id_rt_rw) {
        $rt = RtRw::all();
    } else {
        $rt = RtRw::where("id", Auth::user()->id_rt_rw)->get();
    }

    return view("admin.tambah", ["rt" => $rt]);
});

Route::post("/admin/post-tambah", function (Request $request) {
    $admin = \App\Models\Admin::create([
        "nama" => $request->nama,
        "email" => $request->email,
        "password" => Hash::make($request->password),
        "level" => $request->level,
        "id_rt_rw" => $request->rt_rw,
    ]);

    if ($admin) {
        return redirect("/admin/tampil")->with("message", "Berhasil menambah!");
    } else {
        return redirect("/admin/tampil")->withErrors("error", "Gagal!");
    }
});

Route::get("/admin/tampil", function () {
    $admin = \App\Models\Admin::select([
        "admin.*",
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
        ->leftJoin("rt_rw", "rt_rw.id", "admin.id_rt_rw")
        ->whereNull("admin.deleted_at")
        ->orderBy("admin.created_at", "desc")
        ->paginate(10);

    return view("admin.tampil", [
        "admin" => $admin,
    ]);
});

Route::get("/admin/filter", function (Request $request) {
    $admin = \App\Models\Admin::select([
        "*",
        DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
        DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
    ])
        ->leftJoin("rt_rw", "rt_rw.id", "admin.id_rt_rw")
        ->where("admin.nama", "like", "%" . $request->cari . "%")
        ->orWhere("admin.email", "like", "%" . $request->cari . "%")
        ->orWhere("admin.level", "like", "%" . $request->cari . "%")
        ->orWhere("rt_rw.rt", "like", "%" . $request->cari . "%")
        ->orWhere("rt_rw.rw", "like", "%" . $request->cari . "%")
        ->orderBy("admin.created_at", "desc")
        ->whereNull("admin.deleted_at");

    return response()->json(
        [
            "status" => "success",
            "data" => $admin->get(),
            "message" => "Information load successfully!",
        ],
        200
    );
});

Route::get("/admin/get-ubah/{id}", function ($id) {
    $rt;

    if (!Auth::user()->id_rt_rw) {
        $rt = RtRw::all();
    } else {
        $rt = RtRw::where("id", Auth::user()->id_rt_rw)->get();
    }

    $admin = \App\Models\Admin::find($id);

    return view("admin.ubah", compact("admin", "rt"));
});

Route::post("/admin/post-ubah/{id}", function (Request $request, $id) {
    $password = null;

    $admin = \App\Models\Admin::find($id);

    if (!$request->password) {
        $password = $admin->password;
    } else {
        $password = Hash::make($request->password);
    }
    $admin->update([
        "nama" => $request->nama,
        "email" => $request->email,
        "password" => $password,
        "level" => $request->level,
        "id_rt_rw" => $request->rt,
    ]);

    if ($admin) {
        return redirect("/admin/tampil")->with("message", "Berhasil mengubah!");
    } else {
        return redirect("/admin/tampil")->withErrors("error", "Gagal!");
    }
});

Route::get("/admin/get-hapus/{id}", function ($id) {
    \App\Models\Admin::find($id)->delete();

    return redirect("/admin/tampil");
});
