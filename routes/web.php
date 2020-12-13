<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => 'teacher'], function() {
        Route::group(['prefix' => 'students'], function () {
            Route::get('/', [App\Http\Controllers\StudentController::class, 'index'])->name('student.list');
            Route::get('create', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
            Route::post('store', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
            Route::get('{student}', [App\Http\Controllers\StudentController::class, 'show'])->name('student.show');
        });
        
        Route::group(['prefix' => 'questions'], function () {
            Route::get('/', [App\Http\Controllers\QuestionController::class, 'index'])->name('question.list');
            Route::get('create', [App\Http\Controllers\QuestionController::class, 'create'])->name('question.create');
            Route::post('store', [App\Http\Controllers\QuestionController::class, 'store'])->name('question.store');
            Route::get('{question}', [App\Http\Controllers\QuestionController::class, 'edit'])->name('question.edit');
            Route::post('{question}/update', [App\Http\Controllers\QuestionController::class, 'update'])->name('question.update');
        });
        
        Route::group(['prefix' => 'exams'], function () {
            Route::get('/', [App\Http\Controllers\ExamController::class, 'index'])->name('exam.list');
            Route::get('create', [App\Http\Controllers\ExamController::class, 'create'])->name('exam.create');
            Route::post('store', [App\Http\Controllers\ExamController::class, 'store'])->name('exam.store');
            Route::get('{exam}', [App\Http\Controllers\ExamController::class, 'edit'])->name('exam.edit');
            Route::post('{exam}/update', [App\Http\Controllers\ExamController::class, 'update'])->name('exam.update');
            Route::get('{exam}/results', [App\Http\Controllers\ExamController::class, 'showResults'])->name('exam.result');
            Route::get('{exam}/assign-students', [App\Http\Controllers\ExamController::class, 'viewAssignStudentsToExam'])->name('exam.assign');
            Route::post('{exam}/assign-students', [App\Http\Controllers\ExamController::class, 'assignStudentsToExam'])->name('exam.assignstudents');
        });
    });

    Route::group(['middleware' => 'student'], function() {
        Route::get('my-exams', [App\Http\Controllers\StudentExamController::class, 'index'])->name('my-exams');
        Route::get('start-exam/{id}', [App\Http\Controllers\StudentExamController::class, 'startExam'])->name('exam.start');
        Route::get('exam', [App\Http\Controllers\StudentExamController::class, 'ongoingExam'])->name('exam.ongoing');
        Route::post('save-answer', [App\Http\Controllers\StudentExamController::class, 'saveAnswer'])->name('exam.saveanswer');
        Route::get('my-exam-result', [App\Http\Controllers\StudentExamController::class, 'showExamResult'])->name('exam.myresult');
    });
});