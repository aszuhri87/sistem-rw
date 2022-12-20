<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jimpitan extends Model
{
    use SoftDeletes;
    protected $table = 'jimpitan';

    protected $fillable = [
        'id',
        'id_warga',
        'nominal',
        'id_admin',
        'kategori',
    ];

    protected $dates = ['deleted_at'];
}
