<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [ 1, 'Cumi Saus Tiram', 50000, 'cumi.jpeg', 'Cumi dengan bumbu saus tiram'],
            [ 1, 'King Crab', 70000, 'kepiting.png', 'Olahan dengan Kepiting terbaik'],
            [ 1, 'Kerang Pedas', 50000, 'kerang.png', 'Kerang segar dengan saus pedas'],
            [ 1, 'Lobster Mozarella', 90000, 'loster.jpeg', 'Lobster dengan keju Mozarella'],
            [ 1, 'Udang Merah', 70000, 'udang.jpeg', 'Udang pedas enak mantap terbaik'],
            [ 1, 'Nasi Goreng Seafood', 40000, 'nasigoreng.png', 'Produk sesuai nama'],
            [ 2, 'Batagor', 10000, 'batagor.jpeg', 'Batagor khas Bandung'],
            [ 2, 'Salad', 10000, 'salad.jpeg', 'Salad dengan sayur segar'],
            [ 3, 'Puding', 15000, 'puding.jpeg', 'Puding ale-ale'],
            [ 4, 'Kopi', 10000, 'kopi.jpeg', 'Kopi jos karena ora ngopi ora jos'],
            [ 4, 'Teh', 10000, 'teh.png', 'Teh pucuk harum'],
            [ 5, 'Nasi', 5000, 'nasi.jpeg', 'Nasi putih rojolele'],
        ];

        foreach($menus as $menu){
            DB::table('menu')->insert([
                'jenis_menu_id' => $menu[0],
                'nama' => $menu[1],
                'slug' => Str::slug($menu[1]),
                'harga' => $menu[2],
                'foto' => $menu[3],
                'keterangan' => $menu[4],
                'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
            ]);
        }
    }
}