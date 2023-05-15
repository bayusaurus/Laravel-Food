<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [1, 'Kira Yoshikage', 'kirayoshikage@gmail.com', 'kirayoshikage.jpg'],
            [2, 'Cho Miyeon', 'chomiyeon@gmail.com', 'chomiyeon.jpeg'],
            [3, 'Ji Chang Wook', 'jichangwook@gmail.com', 'jichangwook.png'],
            [4, 'Eren Jaeger', 'erenjaeger@gmail.com', 'erenjaeger.png'],
        ];

        foreach ($users as $user) {
            User::create([
                'role_id' => $user[0],
                'unique_id' => date('mdYHis') . uniqid(),
                'nama' => $user[1],
                'email' => $user[2],
                'foto' => $user[3],
                'password' => bcrypt('password'),
                'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'email_verified_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
            ]);
        }

        $details = [
            [1, 'Bandung', '0989898989'],
            [2, 'Wonogiri', '0989898989'],
            [3, 'Yogyakarta', '0989898989'],
            [4, 'Jakarta', '0989898989'],
        ];

        foreach ($details as $detail) {
            DetailUser::create([
                'user_id' => $detail[0],
                'alamat' => $detail[1],
                'telepon' => $detail[2],
                'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Jakarta')->toDateTimeString()
            ]);
        }
    }
}
