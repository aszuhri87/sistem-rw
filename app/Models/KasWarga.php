<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasWarga extends Model
{
    protected $table = 'kas_warga';

    protected $fillable = [
        'id',
        'nominal',
        'tanggal',
        'tipe',
        'rt',
        'rw',
    ];

    public $timestamps = false;
}
