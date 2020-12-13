@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>Student List</b>
                    <span class="card-header-side-button"><a href="{{route('student.create')}}" class="btn btn-primary btn-sm">Add Student</a></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($students->isEmpty())
                                <tr class="text-center">
                                    <td colspan="5">Students not available.</td>
                                </tr>
                            @else
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{$student->firstname}}</td>
                                        <td>{{$student->lastname}}</td>
                                        <td>{{$student->user->email}}</td>
                                        <td><a href="{{route('student.show', $student->id)}}" class="btn btn-primary btn-sm">View</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>  
                    
                    <div class="text-right">
                        {!! $students->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
