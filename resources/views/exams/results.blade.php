@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>Exam Results - {{$exam->exam_title}}</b> 
                    <span class="card-header-side-button"><a href="{{route('exam.list')}}" class="btn btn-primary btn-sm">View Exams</a></span>                  
                </div>

                <div class="card-body">
                    @include('alerts')

                    <div class="form-group row">
                        <div class="col-md-6">
                            <b>Exam Title : </b> {{$exam->exam_title}}<br>
                            <b>Description : </b> {{$exam->description}}<br>
                            <b>Time (in minutes) : </b> {{$exam->time_required_in_minutes}}<br>
                            <b>Total Marks : </b> {{$exam->total_marks}}<br>
                            <b>Passing Marks : </b> {{$exam->passing_marks}}<br>
                            <b>Date : </b> {{$exam->created_at->format('d-m-Y')}}<br>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Marks</th>
                                <th>Result</th>
                                <th>Submit Date</th>                                                       
                            </tr>
                        </thead>
                        <tbody>
                            @if($results->isEmpty())
                                <tr class="text-center">
                                    <td colspan="5">Results not available.</td>
                                </tr>
                            @else
                                @foreach($results as $result)
                                    <tr>
                                        <td>{{$result->student->fullname}}</td>
                                        <td>{{$result->student->user->email}}</td>
                                        <td>{{$result->marks_obtained}}</td>
                                        <td>
                                            @if(is_null($result->marks_obtained))
                                                --
                                            @elseif($result->marks_obtained >= $exam->passing_marks)
                                                <label class="badge badge-success">Pass</label>
                                            @else
                                                <label class="badge badge-danger">Fail</label>
                                            @endif
                                        </td> 
                                        <td>{{$result->submitted_datetime}}</td>                                      
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>  
                    
                    <div class="text-right">
                        {!! $results->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
