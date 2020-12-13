<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\StudentExam;
use App\Models\StudentExamAnswer;
use App\Http\Requests\Student\SaveAnswerRequest;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the exams of logined student.
     *
     * @return view
     */
    public function index()
    {
        $exams = StudentExam::with('exam')
                            ->where('student_id', getLoginStudentId())
                            ->latest()
                            ->simplePaginate(10);
    
        return view('studentlogin.myexams', compact('exams'));
    }

    /**
     * Start specified exam for student & log start time
     *
     * @return void
     */
    public function startExam($id)
    {
        $id = base64_decode($id);

        if(empty($id)) {
            return redirect()->back();
        }

        $exam = StudentExam::find($id);

        if(is_null($exam)) {
            return redirect()->back();
        }

        StudentExam::startExam($exam);// update exam start time

        session()->put('ongoing_exam_id', $id);

        return redirect()->route('exam.ongoing');
    }

    /**
     * Handle question display for ongoing exam
     *
     * @return void
     */
    public function ongoingExam()
    {
        // on going exam
        $exam = StudentExam::with('exam')
                            ->where('id', session('ongoing_exam_id'))
                            ->first();

        // show result page if exam ended
        if($exam->started_at->diffInMinutes() > $exam->exam->time_required_in_minutes) {
            return redirect()->route('exam.myresult');
        }

        // fetch student answers for on going exam
        $student_answers = StudentExamAnswer::where('student_id', getLoginStudentId())
                                            ->where('exam_id', $exam->exam->id)
                                            ->pluck('selected_option_index', 'question_id')
                                            ->toArray();

        // fetch question
        $questions = Question::whereHas('exams', function($query) use($exam) {
                                    $query->where('exam_id', $exam->exam_id);
                                })->simplePaginate(1);

        // remaining time calculation
        $exam_duration          = $exam->exam->time_required_in_minutes;
        $exam_started_at        = $exam->started_at;
        $timelapse_in_seconds   = $exam_started_at->diffInSeconds(); // total seconds lapse
        $timelapse_in_minutes   = intval($timelapse_in_seconds / 60); // how many minutes from total seconds lapse
        $timelapse_in_seconds   = $timelapse_in_seconds - ($timelapse_in_minutes * 60);
        $minutes_remaining      = $exam_duration - $timelapse_in_minutes;
        $seconds_remaining      = 60 - $timelapse_in_seconds;

        return view('studentlogin.exampage', compact('questions', 'exam', 'student_answers', 'minutes_remaining', 'seconds_remaining'));
    }

    /**
     * Save student answer for a question in exam
     *
     * @param \App\Http\Requests\Student\SaveAnswerRequest $request
     * @return void
     */
    public function saveAnswer(SaveAnswerRequest $request)
    {
        try {

            StudentExamAnswer::saveAnswer();

        } catch(\Exception $e) {

            session()->flash('error', 'Something went wrong. Please try again.');
        }

        // if exam submitted then show result page
        if ($request->submit_exam == 1) {
            return redirect()->route('exam.myresult');
        }

        // redirect to next question page
        return redirect()->route('exam.ongoing', ['page' => request('question_number') + 1]);
    }

    /**
     * Display student exam result
     *
     * @return view
     */
    public function showExamResult()
    {
        if(empty(session('ongoing_exam_id'))) {
            return redirect()->route('my-exams');
        }

        $exam = StudentExam::with('exam')
                            ->where('id', session('ongoing_exam_id'))
                            ->first();

        return view('studentlogin.examresult', compact('exam'));
    }
}
