<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $fillable = [
        'id',
        'nama',
        'email',
        'password',
        'rt',
        'rw',
        'level',

    ];

    public $timestamps = false;
}