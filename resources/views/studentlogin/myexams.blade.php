@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>My Exams</b>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Exam Title</th>
                                <th>Description</th>
                                <th>Time In Minutes</th>
                                <th>Marks Obtained</th>
                                <th>Total Marks</th>
                                <th>Result</th>
                                <th>Submit Date</th>
                                <th>Action</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            @if($exams->isEmpty())
                                <tr class="text-center">
                                    <td colspan="5">Exams not available.</td>
                                </tr>
                            @else
                                @foreach($exams as $exam)                                
                                    <tr>
                                        <td>{{$exam->exam->exam_title}}</td>
                                        <td>{{$exam->exam->description ?? '--'}}</td>
                                        <td>{{$exam->exam->time_required_in_minutes}}</td>
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
                                        <td>{{$exam->submitted_datetime}}</td>       
                                        <td>
                                            @if(!is_null($exam->started_at))
                                                @if(is_null($exam->submitted_at) && ($exam->started_at->diffInMinutes() > $exam->exam->time_required_in_minutes))
                                                    Exam Ended                                                    
                                                @elseif(is_null($exam->submitted_at))
                                                    <a href="{{route('exam.ongoing')}}" class="btn btn-primary btn-sm">Continue to Exam</a>
                                                @endif
                                            @elseif(is_null($exam->submitted_at))
                                                <a href="{{route('exam.start', base64_encode($exam->id))}}" class="btn btn-primary btn-sm">Start</a>
                                            @else
                                                
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>  
                    
                    <div class="text-right">
                        {!! $exams->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
