<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 students
        $user = User::create([
            'user_type_id'  => USER::STUDENT,
            'name'          => 'ABC Student',
            'email'         => 'student@gmail.com',
            'password'      => Hash::make('secret123')
        ]);

        Student::create([
            'user_id'       => $user->id,
            'firstname'     => 'Student Firstname',
            'lastname'      => 'Student Lastname',
            'is_active'    => 1,
            'created_by'    => 1,
            'updated_by'    => 1
        ]);
    }
}
