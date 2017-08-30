@extends('layouts.app')

@section('content')

<h4>Create Calendar</h4>


{!! Form::open(['class' => 'form-inline', 'action' => 'TimeblocksController@store' , 'method' => 'POST']) !!}

  <label class="sr-only" for="inlineFormInput">Name</label>
  <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" value="{{$now->format('Y-m-d')}}">

  <label class="sr-only" for="inlineFormInputGroup">Username</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">Start</div>
    <input type="time" class="form-control" id="inlineFormInputGroup" value="{{$now->format('H:i:s')}}">
  </div>

  <label class="sr-only" for="inlineFormInputGroup">Username</label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">End</div>
    <input type="time" class="form-control" id="inlineFormInputGroup" value="{{$now->format('H:i:s')}}">
  </div>

  {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}




@endsection
