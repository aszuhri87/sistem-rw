<?php

namespace App\Libraries;

use Illuminate\Support\Facades\DB;

class MonthName
{
    public static function chart_data($data)
    {
        try {
            $map = collect(
                \Carbon\CarbonPeriod::create(
                    now()->startOfYear(),
                    now()->endOfYear()
                ))
                ->map(function ($data) {
                    $month = $data->format('F');

                    return [
                        'jumlah' => 0,
                        'bulan' => $month,
                    ];
                })
                ->keyBy('bulan')
                ->values()
                ->toArray();

            $collect = $map;

            $result = DB::transaction(function () use ($collect,$data) {
                for ($x = 0; $x < count($data); ++$x) {
                    for ($i = 0; $i < count($collect); ++$i) {
                        if ($collect[$i]['bulan'] == $data[$x]['bulan']) {
                            $collect[$i]['jumlah'] = (int) $data[$x]['jumlah'];
                        }
                    }

                    return $collect;
                }
            });

            return $result;
        } catch (Exception $e) {
            throw new Exception($e);

            return response([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
