@extends('layouts.app')

@section('content')

<h4>Edit Session</h4>


{!! Form::open(['class' => 'form-inline', 'action' => ['TimeblocksController@update', $timeblock->id] , 'method' => 'POST']) !!}

<div class="col-xs-12 col-sm-11 col-md-3 input-group"> 
  <input name="name" type="text col-xs-3" class="form-control " value='{{$timeblock->name}}' >
</div>

<div class="col-xs-12 col-sm-3 col-md-2  input-group mb-2 mr-sm-2 mb-sm-0">
  <div class="input-group-addon">Date</div>
  <input name="date" type="date" class="form-control mb-2 mr-sm-2 mb-sm-0 input-sm"  id="inlineFormInputGroup" value="{{$form_defaults['startdate']}}">
</div>

<div class="col-xs-12 col-sm-3 col-md-2  input-group mb-2 mr-sm-2 mb-sm-0">
  <div class="input-group-addon">Start</div>
  <input name="start" type="time" class="form-control input-sm" id="inlineFormInputGroup" value="{{$form_defaults['starttime']}}">
</div>

<div class="col-xs-12 col-sm-3 col-md-2  input-group mb-2 mr-sm-2 mb-sm-0">
  <div class="input-group-addon">End </div>
  <input name="end" type="time" class="form-control input-sm" id="inlineFormInputGroup" value="{{$form_defaults['endtime']}}">
</div>
    {{Form::hidden('_method', 'PUT')}}
  {{Form::submit('Save', ['class' => 'btn btn-primary btn-sm'])}}
{!! Form::close() !!}




@endsection
