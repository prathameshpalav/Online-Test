<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 admin
        User::create([
            'user_type_id'  => USER::ADMIN,
            'name'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('secret123')
        ]);
    }
}
