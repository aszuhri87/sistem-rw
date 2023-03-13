<?php

use App\Libraries\MonthName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    try {
        $rt = Auth::user()->id_rt_rw;
        $warga_rt_res = null;
        $jimpit_res = null;
        $warga_jk_res = null;
        $warga_res = null;
        $kas_warga_res = null;
        $kas_masuk_res = null;
        $kas_keluar_res = null;

        $warga_rt = DB::table('warga')
            ->select(
                DB::raw('count(*) as jumlah, rt_rw.rt')
            )
            ->leftJoin(
                'rt_rw',
                'rt_rw.id',
                'warga.id_rt_rw'
            )
            ->whereNull('warga.deleted_at')
            ->groupBy('rt_rw.rt');

        if ($rt == null) {
            $warga_rt_res = $warga_rt->get();
        } else {
            $warga_rt_res = $warga_rt
                ->where(
                    'warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->get();
        }

        $warga_jenis_kelamin = DB::table('warga')
            ->select([
                DB::raw('count(*) as jumlah'),
                DB::raw(
                    "CASE WHEN warga.jenis_kelamin = 'L' THEN 'Laki-laki' ELSE 'Perempuan' END as jenis_kelamin"
                ),
            ])
            ->leftJoin(
                'rt_rw',
                'rt_rw.id',
                'warga.id_rt_rw'
            )
            ->whereNull('warga.deleted_at')
            ->groupBy('warga.jenis_kelamin');

        if ($rt == null) {
            $warga_jk_res = $warga_jenis_kelamin->get();
        } else {
            $warga_jk_res = $warga_jenis_kelamin
                ->where(
                    'warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->get();
        }

        $kas_masuk = \App\Models\KasWarga::select([
            \DB::raw('SUM(kas_warga.nominal) as count'),
        ])
            ->leftJoin(
                'rt_rw',
                'rt_rw.id',
                'kas_warga.id_rt_rw'
            )
            ->whereYear('kas_warga.tanggal', date('Y'))
            ->whereNull('kas_warga.deleted_at')
            ->where('kas_warga.tipe', 'masuk');

        if ($rt == null) {
            $kas_masuk_res = $kas_masuk->first()->count;
        } else {
            $kas_masuk_res = $kas_masuk
                ->where(
                    'kas_warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->first()->count;
        }

        $kas_keluar = \App\Models\KasWarga::select([
            \DB::raw('SUM(kas_warga.nominal) as count'),
        ])
            ->leftJoin(
                'rt_rw',
                'rt_rw.id',
                'kas_warga.id_rt_rw'
            )
            ->whereNull('kas_warga.deleted_at')
            ->whereYear('kas_warga.tanggal', date('Y'))
            ->where('kas_warga.tipe', 'keluar');

        if ($rt == null) {
            $kas_keluar_res = $kas_keluar->first()->count;
        } else {
            $kas_keluar_res = $kas_keluar
                ->where(
                    'kas_warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->first()->count;
        }

        $kas_warga = \App\Models\KasWarga::select(
            DB::raw('sum(kas_warga.nominal) as jumlah '),
            DB::raw(
                "DATE_FORMAT(kas_warga.tanggal,'%M') as bulan"
            )
        )
            ->whereNull('kas_warga.deleted_at')
            ->whereYear('kas_warga.tanggal', date('Y'))
            ->groupBy('bulan');

        if ($rt == null) {
            $kas_warga_res = $kas_warga->get();
        } else {
            $kas_warga_res = $kas_warga
                ->where(
                    'kas_warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->get();
        }

        $jimpit = \App\Models\Jimpitan::select([
            \DB::raw('SUM(jimpitan.nominal) as count'),
        ])
            ->leftJoin(
                'warga',
                'warga.id',
                'jimpitan.id_warga'
            )
            ->whereNull('jimpitan.deleted_at');

        if ($rt == null) {
            $jimpit_res = $jimpit->first();
        } else {
            $jimpit_res = $jimpit
                ->where(
                    'warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->first();
        }

        $warga = \App\Models\Warga::select([
            \DB::raw('count(warga.id) as count'),
        ])->whereNull('warga.deleted_at');
        if ($rt == null) {
            $warga_res = $warga->first()->count;
        } else {
            $warga_res = $warga
                ->where(
                    'warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->first()->count;
        }

        $jimpit_per_bulan = \App\Models\Jimpitan::select(
            DB::raw('sum(jimpitan.nominal) as count'),
            DB::raw('MONTHNAME(jimpitan.tanggal) as bulan')
        )
            ->leftJoin(
                'warga',
                'warga.id',
                'jimpitan.id_warga'
            )
            ->where('jimpitan.id', '!=', null)
            ->whereNull('jimpitan.deleted_at')
            ->whereYear('jimpitan.tanggal', date('Y'))
            ->groupBy(
                DB::raw('MONTHNAME(jimpitan.tanggal)'),
                'bulan'
            );

        if ($rt == null) {
            $jimpit_per_bulan->get();
        } else {
            $jimpit_per_bulan
                ->where(
                    'warga.id_rt_rw',
                    Auth::user()->id_rt_rw
                )
                ->get();
        }

        $jimpit_per_bulan_sum = \App\Models\Jimpitan::select(
            DB::raw('count(jimpitan.id) as jumlah'),
            DB::raw('MONTHNAME(jimpitan.tanggal) as bulan'),
        )
            ->leftJoin('warga', 'warga.id', 'jimpitan.id_warga')
            ->where('jimpitan.id', '!=', null)
            ->whereYear('jimpitan.tanggal', date('Y'))
            ->whereNull('jimpitan.deleted_at')
            ->groupBy(DB::raw('MONTHNAME(jimpitan.tanggal)'), 'bulan')
            ->where(
                'warga.id_rt_rw',
                Auth::user()->id_rt_rw
            )->get();

        $jimpit_data = [];
        foreach ($jimpit_per_bulan as $key => $row) {
            $jimpit_data['bulan'][] = $row['bulan'];
            $jimpit_data['count'][] = (int) $row['count'];
        }

        $jimpit_data_sum = MonthName::chart_data($jimpit_per_bulan_sum);

        $kas_bulan = MonthName::chart_data($kas_warga_res);

        return response()->json(
            [
                'status' => 'OK',
                'warga_rt' => $warga_rt_res,
                'warga_jenis_kelamin' => $warga_jk_res,
                'kas_masuk' => $kas_masuk_res,
                'kas_keluar' => $kas_keluar_res,
                'jimpitan' => $jimpit_res->count,
                'warga' => $warga_res,
                'jimpit_per_bulan' => $jimpit_data,
                'jimpit_per_bulan_sum' => $jimpit_data_sum,
                'kas_warga' => $kas_bulan,
                'message' => 'Berhasil menampilkan data',
            ],
            200
        );
    } catch (Exception $e) {
        return response()->json(
            [
                'status' => 'Internal Server Error!',
                'message' => $e->getMessage(),
            ],
            500
        );
    }
});
