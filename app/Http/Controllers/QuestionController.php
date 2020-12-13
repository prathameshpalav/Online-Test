<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionTag;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Question\StoreQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the questions.
     *
     * @return view
     */
    public function index()
    {
        $questions = Question::latest()->simplePaginate(10);
        
        return view('questions.list', compact('questions'));
    }

    /**
     * Show the form for creating a new question.
     *
     * @return view
     */
    public function create()
    {
        $tags   = QuestionTag::allTags();
        
        return view('questions.create', compact('tags'));
    }

    /**
     * Store a newly created question in storage.
     *
     * @param  \App\Http\Requests\Question\StoreQuestionRequest  $request
     * @return void
     */
    public function store(StoreQuestionRequest $request)
    {
        try {           
            
            DB::beginTransaction();

            Question::addQuestion();

            DB::commit();

            session()->flash('success', 'Question created successfully.');

        } catch(\Exception $e) {

            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('question.list');
    }

    /**
     * Show the form for editing the specified question.
     *
     * @param  \App\Models\Question  $question
     * @return view
     */
    public function edit(Question $question)
    {
        $tags   = QuestionTag::allTags();

        return view('questions.edit', compact('question', 'tags'));
    }

    /**
     * Update the specified question in storage.
     *
     * @param  \App\Http\Requests\Question\StoreQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return void
     */
    public function update(StoreQuestionRequest $request, Question $question)
    {
        try {           
            
            DB::beginTransaction();

            Question::updateQuestion($question);

            DB::commit();

            session()->flash('success', 'Question updated successfully.');

        } catch(\Exception $e) {

            DB::rollBack();
            
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('question.list');
    }
}
