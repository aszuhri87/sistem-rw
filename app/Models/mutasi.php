<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mutasi extends Model
{
    protected $table = 'mutasi';

    protected $fillable = [
        'id',
        'nominal',
        'tanggal',
        'keterangan',

    ];

    public $timestamps = false;
}