<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusMejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'KOSONG',
            'AKTIF',
        ];

        foreach($statuses as $status){
            DB::table('status_meja')->insert(['nama' => $status]);
        }
    }
}
