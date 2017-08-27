@extends('layouts.app')

@section('content')
    <h1>New Game</h1>
    {!! Form::open(['action' => 'GamesController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::Label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter the name of the game'])}}
        </div>
        <div class="form-group">
            {{Form::Label('tagline', 'Tagline')}}
            {{Form::text('tagline', '', ['class' => 'form-control', 'placeholder' => 'Enter a tagline for the game'])}}
        </div>
        <div class="form-group">
            {{Form::Label('short_description', 'Short Description')}}
            {{Form::textarea('short_description', '', ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'A short description of the game'])}}
        </div>
        <div class="form-group">
            {{Form::Label('description', 'Description')}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'A longer description of the game'])}}
        </div>
        <div class="form-group">
            {{Form::Label('advisory', 'Advisory')}}
            {{Form::text('advisory', '', ['class' => 'form-control', 'placeholder' => 'Enter any advisories here'])}}
        </div>
        <div class="form-group">
            {{Form::Label('min', 'Minimum Players')}}
            {{Form::number('min', '2', ['class' => 'form-control', 'min' => '1' ,'max' => '10'])}}
        </div>
        <div class="form-group">
            {{Form::Label('max', 'Maximum Players')}}
            {{Form::number('max', '8', ['class' => 'form-control', 'min' => '1' ,'max' => '10'])}}
        </div>
        <div class="form-group">
            {{Form::file('game_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection