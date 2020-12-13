<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public static function addExam() 
    {
        $exam = Exam::create([
            'exam_title'                => request('exam_title'),
            'description'               => request('description'),
            'instructions'              => request('instructions'),
            'time_required_in_minutes'  => request('time_required_in_minutes'),
            'total_marks'               => request('total_marks'),
            'passing_marks'             => request('passing_marks'),            
            'created_by'                => auth()->user()->id,
            'updated_by'                => auth()->user()->id
        ]);

        if (is_null($exam)) {
            throw new \Exception('Exam creation failed.');
        }

        Exam::addQuestionToExam($exam);

        return $exam;
    }

    public static function updateExam($exam) 
    {
        $exam->exam_title               = request('exam_title');
        $exam->description              = request('description');
        $exam->instructions             = request('instructions');
        $exam->time_required_in_minutes = request('time_required_in_minutes');
        $exam->total_marks              = request('total_marks');
        $exam->passing_marks            = request('passing_marks');
        $exam->updated_by               = auth()->user()->id;

        $exam->save();

        Exam::addQuestionToExam($exam);

        return $exam;
    }

    public static function addQuestionToExam($exam)
    {
        $questions = [];

        foreach(request('questions') as $question) {
            $questions[$question] = [
                'created_by' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $exam->questions()->sync($questions);
    }
}
