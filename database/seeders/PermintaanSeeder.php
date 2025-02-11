<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PermintaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permintaans')->insert([
            [
                'nama' => 'Laptop',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Aplikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Email',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
