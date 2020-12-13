@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-center">
                            @if(isTeacherLogin())
                                <a class="btn btn-primary" href="{{ route('student.list') }}">Show Students</a>
                                <a class="btn btn-primary" href="{{ route('exam.list') }}">Show Exams</a>
                                <a class="btn btn-primary" href="{{ route('question.list') }}">Show Questions</a>
                            @endif

                            @if(isStudentLogin())
                                <a class="btn btn-primary" href="{{ route('my-exams') }}">Show My Exams</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
