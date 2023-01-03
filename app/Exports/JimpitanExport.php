<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat as StyleNumberFormat;

class JimpitanExport implements FromView, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $jimpitan = DB::table("jimpitan")
            ->select(["id_warga", DB::raw("SUM(jimpitan.nominal) as total_nominal")])
            ->whereMonth("tanggal", date("m"))
            ->whereNull("deleted_at")
            ->groupBy("id_warga");

        $warga = DB::table("warga")
            ->select([
                "warga.*",
                DB::raw("CASE WHEN jimpitan.total_nominal is null then 0 ELSE jimpitan.total_nominal END as nominal"),
                DB::raw('IF(rt_rw.rt is null, "-", rt_rw.rt) as rt'),
                DB::raw('IF(rt_rw.rw is null, "-", rt_rw.rw) as rw'),
            ])
            ->leftJoin("rt_rw", "rt_rw.id", "warga.id_rt_rw")
            ->leftJoinSub($jimpitan, "jimpitan", function ($join) {
                $join->on("warga.id", "=", "jimpitan.id_warga");
            })
            ->where("warga.status_dalam_keluarga", "KEPALA KELUARGA")
            ->whereNull("warga.deleted_at")
            ->orderBy("warga.nama_lengkap", "asc")
            ->get();

        return view("jimpitan.export", [
            "laporan" => $warga,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            "C" => StyleNumberFormat::FORMAT_NUMBER,
        ];
    }
}
