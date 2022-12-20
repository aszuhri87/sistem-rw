<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RtRw extends Model
{
    use SoftDeletes;
    protected $table = 'rt_rw';

    protected $fillable = [
        'id',
        'rt',
        'rw',
    ];

    protected $dates = ['deleted_at'];
}
