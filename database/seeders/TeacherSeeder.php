<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 teacher
        $user = User::create([
            'user_type_id'  => USER::TEACHER,
            'name'          => 'ABC Teacher',
            'email'         => 'teacher@gmail.com',
            'password'      => Hash::make('secret123')
        ]);

        Teacher::create([
            'user_id'       => $user->id,
            'firstname'     => 'Teacher Firstname',
            'lastname'      => 'Teacher Lastname',
            'created_by'    => 1,
            'updated_by'    => 1
        ]);
    }
}
