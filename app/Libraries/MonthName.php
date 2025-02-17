<?php

namespace App\Libraries;

use Carbon;

class MonthName
{
    public static function chart_data($data)
    {
        try {
            $collect = collect(
                Carbon\CarbonPeriod::create(
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

            if ($data) {
                for ($x = 0; $x < count($collect); ++$x) {
                    for ($i = 0; $i < count($data); ++$i) {
                        if ($data[$i]['bulan'] == $collect[$x]['bulan'] && $data[$i]['jumlah']) {
                            $collect[$x]['jumlah'] = $data[$i]['jumlah'];
                        } elseif ($data[$i]['bulan'] == $collect[$x]['bulan']) {
                            $collect[$x]['jumlah'] = 0;
                        }
                    }
                    $collect[$x]['bulan'] = Carbon\Carbon::parse($collect[$x]['bulan'])->translatedFormat('F');
                }
            }

            return $collect;
        } catch (Exception $e) {
            throw new Exception($e);

            return response([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
