<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RtRw extends Model
{
    protected $table = 'rt_rw';

    protected $fillable = [
        'id',
        'rt',
        'rw',
    ];

    public $timestamps = false;
}
