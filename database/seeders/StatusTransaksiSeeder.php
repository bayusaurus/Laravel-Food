<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'SUKSES',
            'BATAL',
        ];

        foreach ($statuses as $status) {
            DB::table('status_transaksi')->insert(['nama' => $status]);
        }
    }
}
