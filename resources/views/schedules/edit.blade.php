@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>
    {!! Form::open(['action' => ['SchedulesController@update' , $event->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::Label('name', 'Event Name')}}
            {{Form::text('name', $event->name, ['class' => 'form-control', 'placeholder' => 'Enter the name of the Event'])}}
        </div>
        <div class="form-group">
            {{Form::Label('start', 'Start Date')}}
            {{Form::date('start', $event->start)}}

        </div>
        <div class="form-group">
            {{Form::Label('end', 'End Date')}}
            {{Form::date('end', $event->end)}}

        </div>
        <div class="form-group">
            {{Form::Label('description', 'Description')}}
            {{Form::textarea('description', $event->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'A longer description of the game'])}}
        </div>
        
        <div class="form-group">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <img style="width:100%" src="/storage/event_images/{{$event->event_image}}">
                </div>
                <div class="col-md-10 col-sm-10">
                    {{Form::Label('event_image', 'Change Image')}}
                    {{Form::file('event_image')}}
                </div>
            </div>
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection