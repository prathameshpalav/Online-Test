@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>Exam List</b>
                    <span class="card-header-side-button"><a href="{{route('exam.create')}}" class="btn btn-primary btn-sm">Add Exam</a></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Exam</th>
                                <th>Description</th>
                                <th>Time In Minutes</th>
                                <th>Total Marks</th>
                                <th>Date Created</th>
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
                                        <td>{{$exam->exam_title}}</td>
                                        <td>{{$exam->description}}</td>
                                        <td>{{$exam->time_required_in_minutes}}</td>
                                        <td>{{$exam->total_marks}}</td> 
                                        <td>{{$exam->created_at->format('d-m-Y h:i A')}}</td>         
                                        <td>
                                            <a href="{{route('exam.edit', $exam->id)}}" class="btn btn-primary btn-sm">Edit Exam</a>
                                            <a href="{{route('exam.result', $exam->id)}}" class="btn btn-primary btn-sm">Exam Results</a>
                                            <a href="{{route('exam.assign', $exam->id)}}" class="btn btn-primary btn-sm">Assign Students</a>
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
