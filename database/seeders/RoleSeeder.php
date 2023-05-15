<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['Owner', 'Pemilik Restaurant'],
            ['Admin', 'Mengatur master data'],
            ['Kasir', 'Menangani proses pembayaran'],
            ['Pelayan', 'Menangani pesanan customer'],
        ];

        foreach($roles as $role){
            Role::create([
                'nama' => $role[0],
                'slug' => Str::slug($role[0]),
                'keterangan' => $role[1],
            ]);
        }
    }
}
