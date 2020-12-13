<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Question;
use App\Models\StudentExam;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Exam\StoreExamRequest;
use App\Http\Requests\Exam\AssignStudentRequest;

class ExamController extends Controller
{
    /**
     * Display a listing of the exams.
     *
     * @return view
     */
    public function index()
    {
        $exams = Exam::latest()->simplePaginate(10);
        
        return view('exams.list', compact('exams'));
    }

    /**
     * Show the form for creating a exam.
     *
     * @return view
     */
    public function create()
    {
        $questions = Question::all();
        
        return view('exams.create', compact('questions'));
    }

    /**
     * Store a newly created exam in storage.
     *
     * @param  App\Http\Requests\Exam\StoreExamRequest  $request
     * @return void
     */
    public function store(StoreExamRequest $request)
    {        
        try {           
            
            DB::beginTransaction();
            
            Exam::addExam();

            DB::commit();

            session()->flash('success', 'Exam created successfully.');

        } catch(\Exception $e) {
            
            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('exam.list');
    }

    /**
     * Show the form for editing the specified exam.
     *
     * @param  \App\Models\Exam  $exam
     * @return view
     */
    public function edit(Exam $exam)
    {
        $questions = Question::all();
        
        return view('exams.edit', compact('questions', 'exam'));
    }

    /**
     * Update the specified exam in storage.
     *
     * @param  App\Http\Requests\Exam\StoreExamRequest  $request
     * @param  App\Models\Exam  $id
     * @return void
     */
    public function update(StoreExamRequest $request, Exam $exam)
    {
        try {           
            
            DB::beginTransaction();
            
            Exam::updateExam($exam);

            DB::commit();

            session()->flash('success', 'Exam updated successfully.');

        } catch(\Exception $e) {
            
            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('exam.list');
    }

    /**
     * Show exam wise results of students.
     *
     * @param  \App\Models\Exam  $exam
     * @return view
     */
    public function showResults(Exam $exam)
    {
        $results = StudentExam::with('exam','student.user')->where('exam_id', $exam->id)->paginate(20);

        return view('exams.results', compact('results', 'exam'));
    }

    /**
     * Show form to assign students to a specified exam
     *
     * @param  \App\Models\Exam  $exam
     * @return view
     */
    public function viewAssignStudentsToExam(Exam $exam)
    {
        $assigned_students = StudentExam::with('student.user')
                                        ->where('exam_id', $exam->id)
                                        ->get();

        $student_ids = $assigned_students->pluck('student_id')->toArray();

        $students = Student::whereNotIn('id', $student_ids)->get();  

        return view('exams.assign', compact('students', 'exam', 'assigned_students'));
    }

    /**
     * Assign a specified exam to provided students in storage.
     *
     * @param \App\Http\Requests\Exam\AssignStudentRequest $request
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function assignStudentsToExam(AssignStudentRequest $request, Exam $exam)
    {
        try {           
            
            StudentExam::assignStudents($exam);

            session()->flash('success', 'Students assigned successfully.');

        } catch(\Exception $e) {

            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('exam.assign', $exam->id);
    }
}
