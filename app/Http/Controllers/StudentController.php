<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Student\StoreStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return view
     */
    public function index()
    {
        $students = Student::simplePaginate(10);
        
        return view('students.list', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return view
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \App\Http\Requests\Student\StoreStudentRequest  $request
     * @return void
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            DB::beginTransaction();            
            
            $student = Student::addStudent();

            DB::commit();

            session()->flash('success', 'Student created successfully. Password is <b>'.$student->plain_password.'</b>');

        } catch(\Exception $e) {

            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('student.list');
    }

    /**
     * Display the specified student.
     *
     * @param  \App\Models\Student  $student
     * @return view
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
}
