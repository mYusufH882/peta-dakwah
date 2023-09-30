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
            'name' => 'M Yusuf Haryadi',
            'email' => 'yusuf@mail.com',
            'password' => bcrypt('biddakwah')
        ]);
    }
}
