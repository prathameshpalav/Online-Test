<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\StudentExam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exam = Exam::create([
                    'exam_title'                => 'PHP Beginer',
                    'time_required_in_minutes'  => 5,            
                    'total_marks'               => 5,
                    'created_by'                => 2,
                    'updated_by'                => 2
                ]);

        $exam->questions()->attach([
            1 => [
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            2 => [
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            3 => [
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            4 => [
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            5 => [
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
        StudentExam::insert([
            'student_id'    => 1,
            'exam_id'       => $exam->id,
            'assigned_by'   => 2,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
