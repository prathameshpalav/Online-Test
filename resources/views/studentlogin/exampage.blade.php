@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <b>Ongoing Exam - {{$exam->exam->exam_title}}</b>
                    <span id="showtime"></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <form method="POST" name="examform" id="examform" action="{{ route('exam.saveanswer') }}">
                        @csrf

                        @foreach($questions as $key => $question)
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            <input type="hidden" name="question_number" value="{{$questions->currentPage()}}">
                            @if($questions->hasMorePages())
                            <input type="hidden" name="submit_exam" value="0">
                            @else
                            <input type="hidden" name="submit_exam" value="1">
                            @endif

                            <div class="exam-question">
                                {{$questions->currentPage()}}. <b>{{$question->question}}</b>
                            </div>
                            <div class="exam-question-option">                                
                                <input type="radio" name="option" id="option1" value="1" @if(array_key_exists($question->id, $student_answers)) @if($student_answers[$question->id] == 1) checked @endif @endif> <label for="option1">{{$question->option1}}</label>
                            </div>
                            <div class="exam-question-option">
                                <input type="radio" name="option" id="option2" value="2" @if(array_key_exists($question->id, $student_answers)) @if($student_answers[$question->id] == 2) checked @endif @endif> <label for="option2">{{$question->option2}}</label>
                            </div>
                            <div class="exam-question-option">
                                <input type="radio" name="option" id="option3" value="3" @if(array_key_exists($question->id, $student_answers)) @if($student_answers[$question->id] == 3) checked @endif @endif> <label for="option3">{{$question->option3}}</label>
                            </div>
                            <div class="exam-question-option">
                                <input type="radio" name="option" id="option4" value="4" @if(array_key_exists($question->id, $student_answers)) @if($student_answers[$question->id] == 4) checked @endif @endif> <label for="option4">{{$question->option4}}</label>
                            </div>
                        @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if($questions->hasMorePages()) Submit Answer @else Submit Exam @endif
                                </button>
                            </div>
                            <div class="col-md-4" style="padding-top:6px;">                            
                                {!! $questions->links() !!}
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
    <script type="text/javascript">        

        var tim;       
        var min = '{{$minutes_remaining}}';
        var sec = '{{$seconds_remaining}}';
        var f = new Date();

        window.addEventListener("load", examTimer());

        function examTimer() {
            if (parseInt(sec) >0) {
			    document.getElementById("showtime").innerHTML = "<b>Time Remaining</b>: "+min+" Minutes ," + sec+" Seconds";
                sec = parseInt(sec) - 1;                
                tim = setTimeout("examTimer()", 1000);
            } else {

			    if (parseInt(min)==0 && parseInt(sec)==0){
			    	document.getElementById("showtime").innerHTML = "<b>Time Remaining</b>: "+min+" Minutes ," + sec+" Seconds";
                    var input = $('<input type="hidden" name="submit_exam" value="1">');
                    $('#examform').append(input);
				    document.examform.submit();
                }

                if (parseInt(sec) == 0) {				
				    document.getElementById("showtime").innerHTML = "Time Remaining :"+min+" Minutes ," + sec+" Seconds";					
                    min = parseInt(min) - 1;
					sec=59;
                    tim = setTimeout("examTimer()", 1000);
                }
            }
        }
    </script>
@endsection