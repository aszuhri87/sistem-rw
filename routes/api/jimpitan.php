<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post("/jimpitan/tambah", function (Request $request) {
    try {
        $warga = \App\Models\Warga::where("no_kk", $request->no_kk)->first();
        if (!$warga) {
            return response()->json(
                [
                    "status" => "Not Found",
                    "message" => "N0 KK tidak ditemukan!",
                ],
                404
            );
        }
        $jimpitan = \App\Models\Jimpitan::create([
            "id_warga" => $warga->id,
            "nominal" => $request->nominal,
            "id_admin" => Auth::user()->id,
            "kategori" => $request->kategori,
        ]);
        if ($jimpitan) {
            return response()->json(["status" => "OK", "message" => "Berhasil menambah data"], 200);
        } else {
            return response()->json(
                [
                    "status" => "Not Found",
                    "message" => "Penambahan data gagal!",
                ],
                404
            );
        }
    } catch (Exception $e) {
        return response()->json(["status" => "Internal Server Error", "message" => "Error!"], 500);
    }
});

Route::post("/jimpitan/tampil", function (Request $request) {
    try {
        $rt = Auth::user()->id_rt_rw;
        $result = \App\Models\Jimpitan::select(["jimpitan.*", "warga.nama_lengkap"])
            ->leftJoin("warga", "warga.id", "jimpitan.id_warga")
            ->orderBy("jimpitan.created_at", "desc")
            ->whereNull("jimpitan.deleted_at")
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
                "data" => $jimpitan->paginate(10),
                "message" => "Informasi berhasil di akses!",
            ],
            200
        );
    } catch (Exception $e) {
        return response()->json(
            [
                "status" => "Internal Server Error",
                "message" => "Error!",
            ],
            500
        );
    }
});

Route::get("/jimpitan/hapus/{id}", function ($id) {
    try {
        $result = \App\Models\Jimpitan::find($id)->delete();
        return response()->json(
            ["status" => "success", "message" => "Berhasil menghapus data."],
            200
        );
    } catch (Exception $e) {
        return response()->json(["status" => "Internal Server Error", "message" => "Error!"], 500);
    }
});

Route::post("/jimpitan/ubah/{id}", function (Request $request, $id) {
    try {
        // dd($request->nominal); $jimpitan =
        \App\Models\Jimpitan::find($id)->update([
            "nominal" => $request->nominal,
            "id_admin" => Auth::id(),
            "kategori" => $request->kategori,
        ]);
        if ($jimpitan) {
            return response()->json(
                [
                    "status" => "success",
                    "message" => "Berhasil Mengubah data.",
                ],
                200
            );
        } else {
            return response()->json(
                ["status" => "Failed", "message" => "Gagal mengubah data!"],
                400
            );
        }
    } catch (Exception $e) {
        return response()->json(["status" => "Internal Server Error", "message" => "Error!"], 500);
    }
});

Route::get("/jimpitan/scan-qr", function (Request $request) {
    try {
        $decode = base64_decode($request->scan_result);
        return response()->json(["status" => "OK", "data" => $decode], 200);
    } catch (Exception $e) {
        return response()->json(["status" => "Internal Server Error"], 500);
    }
});

/**
 * @OA\Post(
 *     path="/api/jimpitan/tampil",
 *     tags={"Jimpitan"},
 *     summary="Get Jimpitan data function",
 *     description="Get all jimpitan data",
 *     operationId="s",
 *     security={{"passport": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="dari",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="ke",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="cari",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="kategori",
 *                     type="string"
 *                 ),
 *                 example={"dari": "2022-12-01", "ke": "2022-12-30", "cari": "", "kategori": "harian"}
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="default",
 *         description="successful operation"
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/jimpitan/tambah",
 *     tags={"Jimpitan"},
 *     summary="Add Jimpitan function",
 *     description="Adding Jimpitan data to sistem",
 *     security={{"passport": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="no_kk",
 *                     type="number"
 *                 ),
 *                 @OA\Property(
 *                     property="nominal",
 *                     type="number"
 *                 ),
 *                 @OA\Property(
 *                     property="kategori",
 *                     type="string"
 *                 ),
 *                 example={"no_kk": 3471072108961377, "nominal": 500, "kategori": "harian"}
 *             )
 *         )
 *     ),
 *
 *
 *     @OA\Response(
 *         response="default",
 *         description="successful operation"
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/jimpitan/ubah/{id}",
 *     tags={"Jimpitan"},
 *     summary="Update Jimpitan data function",
 *     description="Updating jimpitan data by id",
 *     security={{"passport": {}}},
 *
 *     @OA\Parameter(
 *         description="Parameter with mutliple examples",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *     ),
 *
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="nominal",
 *                     type="number"
 *                 ),
 *                 @OA\Property(
 *                     property="kategori",
 *                     type="string"
 *                 ),
 *                 example={"nominal": 500, "kategori": "harian"}
 *             )
 *         )
 *     ),
 *
 *
 *     @OA\Response(
 *         response="default",
 *         description="successful operation"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/jimpitan/hapus/{id}",
 *     tags={"Jimpitan"},
 *     summary="Delete Jimpitan data",
 *     description="Deleting Jimpitan data by id",
 *     security={{"passport": {}}},
 *
 *     @OA\Parameter(
 *         description="Parameter with mutliple examples",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *     ),
 *
 *     @OA\Response(
 *         response="default",
 *         description="successful operation"
 *     )
 * )
 *
 */

class Jimpitan extends Controller
{
}
