<?php

namespace App\Imports;

use App\Models\RtRw;
use App\Models\Warga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WargaImport implements ToModel, WithHeadingRow, WithColumnFormatting
{
    /**
     * @return User|null
     */
    public function model(array $row)
    {
        $rt_rw;
        $rt = RtRw::where('rt', $row['rt'])->where('rw', $row['rw'])->first();

        if (!$rt) {
            $add_rt_rw = RtRw::create([
                'rt' => $row['rt'],
                'rw' => $row['rw'],
            ]);

            $rt_rw = $add_rt_rw->id;
        } else {
            $rt_rw = $rt->id;
        }

        return new Warga([
            'no_kk' => (int) $row['no_kk'],
            'nik' => (int) $row['nik'],
            'nama_lengkap' => $row['nama_lengkap'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => date('Y-m-d', strtotime($row['tanggal_lahir'])),
            'jenis_kelamin' => $row['jenis_kelamin'],
            'agama' => $row['agama'],
            'alamat' => $row['alamat'],
            'id_rt_rw' => $rt_rw,
            'pendidikan' => $row['pendidikan'],
            'pekerjaan' => $row['pekerjaan'],
            'kewarganegaraan' => $row['kewarganegaraan'],
            'status_perkawinan' => $row['status_perkawinan'],
            'status_dalam_keluarga' => $row['status_dalam_keluarga'],
            'nama_ayah' => $row['nama_ayah'],
            'nama_ibu' => $row['nama_ibu'],
            'keterangan' => isset($row['keterangan']) ? $row['keterangan'] : '-',
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'no_kk' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
