@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>View Student - {{$student->fullname}}</b>
                    <span class="card-header-side-button"><a href="{{route('student.list')}}" class="btn btn-primary btn-sm">View Students</a></span>
                    <span class="card-header-side-button"><a href="{{route('student.create')}}" class="btn btn-primary btn-sm">Add Student</a></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <form method="POST" action="{{ route('student.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $student->firstname }}" required readonly>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $student->lastname }}" required readonly>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $student->user->email }}" required readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div> -->
                    </form>

                    <label><b>Exams: </b></label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Exam Title</th>
                                <th>Started At</th>
                                <th>Submitted At</th>                                
                                <th>Marks Obtained</th>
                                <th>Total Marks</th>
                                <th>Result</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @if(empty($student->exams))
                                <tr style="text-align: center;">
                                    <td colspan="6">{{$student->firstname}} don't have any exam assigned.</td>
                                </tr>
                            @else
                                @foreach($student->exams as $exam)
                                    <tr>
                                        <td>{{$exam->exam->exam_title}}</td>
                                        <td>{{$exam->started_datetime}}</td>
                                        <td>{{$exam->submitted_datetime}}</td>                                        
                                        <td>{{$exam->marks_obtained ?? '--'}}</td>
                                        <td>{{$exam->exam->total_marks}}</td>
                                        <td>
                                            @if(is_null($exam->marks_obtained))
                                                --
                                            @elseif($exam->marks_obtained >= $exam->exam->passing_marks)
                                                <label class="badge badge-success">Pass</label>
                                            @else
                                                <label class="badge badge-danger">Fail</label>
                                            @endif
                                        </td>                                 
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
