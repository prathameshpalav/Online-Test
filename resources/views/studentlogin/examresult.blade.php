@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>Completed Exam - {{$exam->exam->exam_title}}</b>
                </div>

                <div class="card-body">
                    @include('alerts')
                       
                    @if($exam->marks_obtained >= $exam->exam->passing_marks)
                    <div class="alert alert-success" role="alert">
                        Congratulations! You passed <b>{{$exam->exam->exam_title}}</b> exam with <b>{{number_format(($exam->marks_obtained/$exam->exam->total_marks)*100)}}%</b>.
                    </div>
                    @else
                    <div class="alert alert-danger" role="alert">
                        Sorry! You failed.
                    </div> 
                    @endif

                    <div class="form-group row mb-0">                        
                        <div class="col-md-12">
                            <a href="{{route('my-exams')}}" class="btn btn-primary">
                                Go to My Exams
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
