<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class JimpitanExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $jimpitan = DB::table('jimpitan')
        ->select([
            'id_warga',
            DB::raw('SUM(jimpitan.nominal) as total_nominal'),
        ])
        ->whereMonth('tanggal', date('m'))
        ->groupBy('id_warga');

        $warga = DB::table('warga')->select([
            'warga.*',
            DB::raw('CASE WHEN jimpitan.total_nominal is null then 0 ELSE jimpitan.total_nominal END as nominal'),
        ])
        ->leftJoinSub($jimpitan, 'jimpitan', function ($join) {
            $join->on('warga.id', '=', 'jimpitan.id_warga');
        })
        ->orderBy('warga.nama_lengkap', 'asc')
        ->get();

        return view('jimpitan.export', [
            'laporan' => $warga,
        ]);
    }
}
