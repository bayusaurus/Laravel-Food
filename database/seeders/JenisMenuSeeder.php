<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JenisMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            'MAIN COURSE',
            'APPETIZER',
            'DESSERT',
            'DRINK',
            'OTHER'
        ];

        foreach($menus as $menu){
            DB::table('jenis_menu')->insert([
                'nama' => $menu,
                'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                ]);
        }
    }
}
