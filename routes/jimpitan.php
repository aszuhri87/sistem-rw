<?php

use App\Exports\JimpitanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/jimpitan/tambah", function () {
    return view("jimpitan/tambah");
});

Route::get("/jimpitan/scan-qr", function () {
    return view("jimpitan.scanapp");
});

Route::post("/jimpitan/scan-qr", function (Request $request) {
    return redirect("jimpitan/tambah")->with("scan_result", $request->scan_result);
});

Route::post("/jimpitan/tambah", function (Request $request) {
    $warga = \App\Models\Warga::where("no_kk", $request->no_kk)->first();

    if (!$warga) {
        return redirect("jimpitan/tambah")->with("message", "NIK Tidak Ditemukan");
    }

    $jimpitan = \App\Models\Jimpitan::create([
        "id_warga" => $warga->id,
        "nominal" => $request->nominal,
        "id_admin" => Auth::user()->id,
        "kategori" => $request->kategori,
    ]);

    if ($jimpitan) {
        return redirect("jimpitan/tampil")->with("message", "Berhasil Ditambahkan!");
    } else {
        return redirect("jimpitan/tampil")->withErrors("error", "Penambahan jimpitan gagal!");
    }
});

Route::get("/jimpitan/tampil", function () {
    $rt = Auth::user()->id_rt_rw;

    $result = \DB::table("jimpitan")
        ->select(["jimpitan.*", "warga.nama_lengkap", "warga.no_kk"])
        ->leftJoin("warga", "warga.id", "jimpitan.id_warga")
        ->orderBy("jimpitan.created_at", "desc");

    $jimpitan = null;

    if ($rt == null) {
        $jimpitan = $result->paginate(10);
    } else {
        $jimpitan = $result->where("warga.id_rt_rw", Auth::user()->id_rt_rw)->paginate(10);
    }

    return view("jimpitan/tampil", [
        "jimpitan" => $jimpitan,
    ]);
});

Route::get("/jimpitan/filter", function (Request $request) {
    $rt = Auth::user()->id_rt_rw;

    $result = \App\Models\Jimpitan::select(["jimpitan.*", "warga.nama_lengkap"])
        ->leftJoin("warga", "warga.id", "jimpitan.id_warga")
        ->orderBy("jimpitan.created_at", "desc")
        ->where("jimpitan.kategori", "like", "%" . $request->kategori . "%");

    $jimpitan = null;

    if ($rt == null) {
        $jimpitan = $result;
    } else {
        $jimpitan = $result->where("warga.rt", $rt);
    }

    if ($request->cari) {
        $jimpitan->where("warga.nama_lengkap", "like", "%" . $request->cari . "%");
        $jimpitan->orWhere("jimpitan.nominal", "like", "%" . $request->cari . "%");
    }

    if ($request->ke && $request->dari) {
        $jimpitan->whereBetween("jimpitan.tanggal", [$request->dari, $request->ke]);
    }

    return response()->json(
        [
            "status" => "success",
            "data" => $jimpitan->get(),
            "message" => "Information load successfully!",
        ],
        200
    );
});

Route::get("/jimpitan/hapus/{id}", function ($id) {
    \App\Models\Jimpitan::find($id)->delete();

    return redirect("jimpitan/tampil");
});

Route::post("/jimpitan/ubah/{id}", function (Request $request, $id) {
    $jimpitan = \App\Models\Jimpitan::find($id)->update([
        "nominal" => $request->nominal,
        "id_admin" => Auth::id(),
        "kategori" => $request->kategori,
    ]);

    if ($jimpitan) {
        return redirect("/jimpitan/tampil")->with("message", "Berhasil Mengubah!");
    } else {
        return redirect("/jimpitan/tampil")->withErrors("error", "Gagal!");
    }
});

Route::get("/jimpitan/ubah/{id}", function ($id) {
    $jimpitan = \App\Models\Jimpitan::find($id);

    return view("jimpitan/ubah", compact("jimpitan"));
});

Route::get("/jimpitan/export", function () {
    return Excel::download(
        new JimpitanExport(),
        "Laporan jimpitan bulan " . date("F") . " - " . date("d-m-Y") . ".xlsx"
    );
});
