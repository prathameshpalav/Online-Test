@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Assign Students To Exam - {{$exam->exam_title}}</b>
                    <span class="card-header-side-button"><a href="{{route('exam.list')}}" class="btn btn-primary btn-sm">View Exams</a></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <form method="POST" action="{{ route('exam.assignstudents', $exam->id) }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="students" class="col-md-4 col-form-label text-md-right">Students</label>

                            <div class="col-md-6">
                                <select name="students[]" id="students" class="form-control @error('students') is-invalid @enderror" multiple="multiple">
                                    <option value="">Select Students</option>
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}">{{$student->fullname}} ({{$student->user->email}})</option>
                                    @endforeach
                                </select>

                                @error('students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Assign Students
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="form-group row mt-5">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Email</th>                         
                                </tr>
                            </thead>
                            <tbody>
                                @if($assigned_students->isEmpty())
                                    <tr class="text-center">
                                        <td colspan="5">Students not assigned.</td>
                                    </tr>
                                @else
                                    @foreach($assigned_students as $student)
                                        <tr>
                                            <td>{{$student->student->fullname}}</td>                                        
                                            <td>{{$student->student->user->email}}</td>                                        
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
</div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#students').select2({
                placeholder: 'Select Students'
            });
        });
    </script>
@endsection
