@extends('layouts.app')

@section('content')
    <h1>New Event</h1>
    {!! Form::open(['action' => 'SchedulesController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::Label('name', 'Event Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter the name of the Event'])}}
        </div>
        <div class="form-group">
            {{Form::Label('start', 'Start Date')}}
            {{Form::date('start', \Carbon\Carbon::now())}}

        </div>
        <div class="form-group">
            {{Form::Label('end', 'End Date')}}
            {{Form::date('end', \Carbon\Carbon::now())}}

        </div>
        <div class="form-group">
            {{Form::Label('description', 'Description')}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'A longer description of the game'])}}
        </div>
        <div class="form-group">
            {{Form::Label('event_image', 'Upload an Image')}}
            {{Form::file('event_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection