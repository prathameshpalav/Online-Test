<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function exams() 
    {
        return $this->hasMany(StudentExam::class);
    }

    public static function addStudent() 
    {
        $password = randomPassword();

        $user = User::addStudentUser($password);

        $student = Student::create([
            'user_id'       => $user->id,
            'firstname'     => request('firstname'),
            'lastname'      => request('lastname'),
            'created_by'    => auth()->user()->id,
            'updated_by'    => auth()->user()->id
        ]);

        if (is_null($student)) {
            throw new \Exception('Student creation failed.');
        }

        $student->plain_password = $password;

        return $student;
    }
}
