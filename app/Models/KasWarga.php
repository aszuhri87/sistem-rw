<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KasWarga extends Model
{
    use SoftDeletes;
    protected $table = 'kas_warga';

    protected $fillable = [
        'id',
        'nominal',
        'tanggal',
        'tipe',
        'id_rt_rw',
        'kategori',
        'catatan',
    ];

    protected $dates = ['deleted_at'];
}
