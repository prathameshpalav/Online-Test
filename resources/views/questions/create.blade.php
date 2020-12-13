@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Add Question</b>
                    <span class="card-header-side-button"><a href="{{route('question.list')}}" class="btn btn-primary btn-sm">View Quetions</a></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <form method="POST" action="{{ route('question.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">Question</label>

                            <div class="col-md-6">
                                <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" placeholder="Type question here" required autofocus>

                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description about question if any">{{ old('description') }}</textarea>
                        
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">Tags</label>

                            <div class="col-md-6">
                                <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                    <option value="">Tags</option>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag}}">{{$tag}}</option>
                                    @endforeach
                                </select>

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Option</th>
                                    <th>Correct Option</th>                                                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>
                                        <input type="text" class="form-control @error('option1') is-invalid @enderror" name="option1" value="{{old('option1')}}" placeholder="Option 1" required>
                                        @error('option1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <input type="radio" name="correct_option" value="1" @if(old('correct_option') == 1) checked @endif>
                                    </td>                                
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>
                                        <input type="text" class="form-control @error('option2') is-invalid @enderror" name="option2" value="{{old('option2')}}" placeholder="Option 2" required>
                                        @error('option2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <input type="radio" name="correct_option" value="2" @if(old('correct_option') == 2) checked @endif>
                                    </td>                                
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>
                                        <input type="text" class="form-control @error('option3') is-invalid @enderror" name="option3" value="{{old('option3')}}" placeholder="Option 3" required>
                                        @error('option3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <input type="radio" name="correct_option" value="3" @if(old('correct_option') == 3) checked @endif>
                                    </td>                                
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>
                                        <input type="text" class="form-control @error('option4') is-invalid @enderror" name="option4" value="{{old('option4')}}" placeholder="Option 4" required>
                                        @error('option4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <input type="radio" name="correct_option" value="4" @if(old('correct_option') == 4) checked @endif>
                                    </td>                                
                                </tr>
                            </tbody>
                        </table>                        

                        <div class="form-group row">                            
                            <div class="col-md-6">
                                <input type="hidden" class="form-control @error('correct_option') is-invalid @enderror">

                                @error('correct_option')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="marks" class="col-md-4 col-form-label text-md-right">Marks</label>

                            <div class="col-md-6">
                                <input id="marks" type="number" class="form-control @error('marks') is-invalid @enderror" name="marks" value="1" required readonly>

                                @error('marks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
    @include('questions.js')
@endsection