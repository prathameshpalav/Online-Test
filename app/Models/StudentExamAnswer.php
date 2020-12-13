<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public static function saveAnswer()
    {
        $exam = StudentExam::where('id', session('ongoing_exam_id'))
                            ->first();

        $answer = StudentExamAnswer::where('student_id', getLoginStudentId())
                                    ->where('exam_id', $exam->exam_id)
                                    ->where('question_id', request('question_id'))
                                    ->first();

        if (is_null($answer)) {
            $answer = new StudentExamAnswer();
            $answer->student_id             = getLoginStudentId();
            $answer->exam_id                = $exam->exam_id;
            $answer->question_id            = request('question_id');
            $answer->selected_option_index  = request('option');
        } else {
            $answer->selected_option_index = request('option');
        }

        $answer->save();

        if (is_null($answer)) {
            throw new \Exception('Answer saving failed.');
        }

        if(request('submit_exam') == 1) {

            $student_answers = StudentExamAnswer::with('question')
                                                    ->where('student_id', getLoginStudentId())
                                                    ->where('exam_id', $exam->exam_id)
                                                    ->get();

            $exam->submitted_at                 = now();
            $exam->no_of_questions_attempted    = $student_answers->count();            

            $exam->marks_obtained = 0;
            foreach($student_answers as $student_answer) {
                if($student_answer->selected_option_index == $student_answer->question->correct_option) {
                    $exam->marks_obtained += $student_answer->question->marks;
                }
            }

            $exam->save();
        }

        return $answer;
    }
}
