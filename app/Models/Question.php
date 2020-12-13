<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function tags()
    {
        return $this->hasMany(QuestionTag::class);
    }

    public static function addQuestion() 
    {
        $question = Question::create([
            'question'          => request('question'),
            'description'       => request('description'),
            'option1'           => request('option1'),
            'option2'           => request('option2'),
            'option3'           => request('option3'),
            'option4'           => request('option4'),
            'correct_option'    => request('correct_option'),
            'marks'             => request('marks'),
            'created_by'        => auth()->user()->id,
            'updated_by'        => auth()->user()->id
        ]);

        if (is_null($question)) {
            throw new \Exception('Question creation failed.');
        }

        QuestionTag::addTagsToQuestion($question);

        return $question;
    }

    public static function updateQuestion($question) 
    {
        $question->question         = request('question');
        $question->description      = request('description');
        $question->option1          = request('option1');
        $question->option2          = request('option2');
        $question->option3          = request('option3');
        $question->option4          = request('option4');
        $question->correct_option   = request('correct_option');
        $question->marks            = request('marks');
        $question->updated_by       = auth()->user()->id;

        $question->save();

        QuestionTag::addTagsToQuestion($question);

        return $question;
    }
}
