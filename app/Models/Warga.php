<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    use SoftDeletes;
    protected $table = "warga";

    protected $fillable = [
        "id",
        "no_kk",
        "nik",
        "nama_lengkap",
        "tempat_lahir",
        "tanggal_lahir",
        "jenis_kelamin",
        "agama",
        "alamat",
        "id_rt_rw",
        "pendidikan",
        "pekerjaan",
        "kewarganegaraan",
        "status_perkawinan",
        "status_dalam_keluarga",
        "nama_ayah",
        "nama_ibu",
        "keterangan",
    ];

    protected $dates = ["deleted_at"];
}
