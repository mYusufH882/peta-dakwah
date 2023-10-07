<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'bidangdakwah',
            'nama_lengkap' => 'Bidang Dakwah PJ',
            'avatar' => '',
            'email' => 'pemudapersiscibeureum@mail.com',
            'password' => bcrypt('biddakwah')
        ]);
    }
}
