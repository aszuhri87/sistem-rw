<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            "nama" => "Admin",
            "email" => "admin@bibitunggul.id",
            "id_rt_rw" => null,
            "password" => \Hash::make("bu1@varx.id"),
            "level" => "admin",
        ]);

        \App\Models\Admin::create([
            "nama" => "Penjimpit",
            "email" => "penjimpit@bibitunggul.id",
            "id_rt_rw" => null,
            "password" => \Hash::make("bu2@varx.id"),
            "level" => "penjimpit",
        ]);
    }
}
