<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            ['Rooftop #1', 2, 'rooftop.jpeg'],
            ['Rooftop #2', 2, 'rooftop2.jpeg'],
            ['VIP #1', 4, 'vip.jpeg'],
            ['VIP #2', 4, 'vip2.jpeg'],
        ];

        foreach ($tables as $table) {
            DB::table('meja')->insert([
                'status_meja_id' => 1,
                'nama' => $table[0],
                'kapasitas' => $table[1],
                'foto' => $table[2],
                'session_code' => Str::upper(Str::random(6)),
                'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
            ]);
        }
    }
}
