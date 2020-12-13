@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>Question List</b>
                    <span class="card-header-side-button"><a href="{{route('question.create')}}" class="btn btn-primary btn-sm">Add Question</a></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Question</th>
                                <th>Marks</th>
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @if($questions->isEmpty())
                                <tr class="text-center">
                                    <td colspan="5">Questions not available.</td>
                                </tr>
                            @else
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{$question->question}}</td>
                                        <td>{{$question->marks}}</td>                                        
                                        <td><a href="{{route('question.edit', $question->id)}}" class="btn btn-primary btn-sm">Edit</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>  
                    
                    <div class="text-right">
                        {!! $questions->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
