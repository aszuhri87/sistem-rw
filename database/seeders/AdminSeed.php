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
            'name' => 'Admin',
            'email' => 'admin@bibitunggul.com',
            'rt' => null,
            'rw' => null,
            'password' => Hash::make('bu1@varx.id'),
            'level' => 'admin',
        ]);

        \App\Models\Admin::create([
            'name' => 'Penjimpit',
            'email' => 'penjimpit@bibitunggul.com',
            'rt' => null,
            'rw' => null,
            'password' => Hash::make('bu2@varx.id'),
            'level' => 'penjimpit',
        ]);
    }
}
