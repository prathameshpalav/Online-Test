<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    use HasFactory;

    protected $casts = [
        'started_at' => 'datetime', 
        'submitted_at' => 'datetime'
    ];

    public function getStartedDatetimeAttrinute()
    {
        return is_null($this->started_at) ? '' : $this->started_at->format('d-m-Y h:i A');
    }

    public function getSubmittedDatetimeAttribute()
    {
        return is_null($this->submitted_at) ? '' : $this->submitted_at->format('d-m-Y h:i A');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public static function startExam($exam)
    {
        $exam->started_at = now();
        $exam->save();
    }

    public static function assignStudents($exam)
    {
        $students = request('students');

        $student_array = [];
        foreach($students as $student) {
            $student_array[] = [
                'student_id'    => $student,
                'exam_id'       => $exam->id,
                'assigned_by'   => auth()->user()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ];
        }

        StudentExam::insert($student_array);
    }
}
