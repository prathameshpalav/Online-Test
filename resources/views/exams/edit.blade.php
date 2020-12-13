@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Edit Exam</b>
                    <span class="card-header-side-button">
                        <a href="{{route('exam.list')}}" class="btn btn-primary btn-sm">View Exams</a>
                        <a href="{{route('exam.create')}}" class="btn btn-primary btn-sm">Add Exam</a>
                    </span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <form method="POST" action="{{ route('exam.update', $exam->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="exam-title" class="col-md-4 col-form-label text-md-right">Exam Title</label>

                            <div class="col-md-6">
                                <input id="exam-title" type="text" class="form-control @error('exam_title') is-invalid @enderror" name="exam_title" value="{{ $exam->exam_title }}" placeholder="Exam Title" required autofocus>

                                @error('exam_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description about exam if any">{{ $exam->description }}</textarea>
                        
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instructions" class="col-md-4 col-form-label text-md-right">Instructions</label>

                            <div class="col-md-6">
                                <textarea id="instructions" class="form-control @error('instructions') is-invalid @enderror" name="instructions" placeholder="Instructions for exam if any">{{ $exam->instructions }}</textarea>
                        
                                @error('instructions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time-required" class="col-md-4 col-form-label text-md-right">Time Required (in minutes)</label>

                            <div class="col-md-6">
                                <input id="time-required" type="number" class="form-control @error('time_required_in_minutes') is-invalid @enderror" name="time_required_in_minutes" value="{{$exam->time_required_in_minutes}}" required>

                                @error('time_required_in_minutes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="marks" class="col-md-4 col-form-label text-md-right">Total Marks</label>

                            <div class="col-md-6">
                                <input id="marks" type="number" class="form-control @error('total_marks') is-invalid @enderror" name="total_marks" value="{{$exam->total_marks}}" required readonly>

                                @error('total_marks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passing-marks" class="col-md-4 col-form-label text-md-right">Passing Marks</label>

                            <div class="col-md-6">
                                <input id="passing-marks" type="number" class="form-control @error('passing_marks') is-invalid @enderror" name="passing_marks" value="{{$exam->passing_marks}}" required>

                                @error('passing_marks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        @php $selected_questions = $exam->questions()->pluck('id')->toArray(); @endphp
                        <table id="questions-table" class="table table-bordered display" style="width:100%">
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
                                            <td>
                                                <input type="checkbox" name="questions[]" data-marks="{{$question->marks}}" class="question-checkbox" value="{{$question->id}}" @if($selected_questions) @if(in_array($question->id, $selected_questions)) checked @endif @endif>
                                            </td>                                        
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#questions-table').DataTable();

            calculateMarks();
            $('.question-checkbox').on('click', function() {
                calculateMarks();
            });
        });

        function calculateMarks() {
            var marks = 0;
            $('.question-checkbox').each(function(index) {
                if($(this).is(':checked')) {
                    marks += parseInt($(this).data('marks'));
                }
            });
            $('#marks').val(marks);
        }
    </script>
@endsection