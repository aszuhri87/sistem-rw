<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jimpitan extends Model
{
    protected $table = 'jimpitan';

    protected $fillable = [
        'id',
        'id_warga',
        'nominal',
        'id_admin',


    ];

    public $timestamps = false;
}