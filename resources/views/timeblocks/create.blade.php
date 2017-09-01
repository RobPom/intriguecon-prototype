@extends('layouts.app')

@section('content')
<?php 
$start = new Carbon($schedule->start);
$end = new Carbon($schedule->end);
//$end = 


?>
<h2><a href="/events/{{$schedule->id }}" >{{$schedule->name}}</a> - {{$start->format('F jS')}} to {{$end->format('jS')}}</h2>

{!! Form::open(['class' => 'form-inline', 'action' => ['TimeblocksController@store', $schedule->id] , 'method' => 'POST']) !!}

<div class="col-xs-12 col-sm-11 col-md-3 input-group"> 
  <input name="name" type="text col-xs-3" class="form-control " placeholder='Session Name' >
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
   {{Form::hidden('scheduleid', $schedule->id)}}
  {{Form::submit('Add', ['class' => 'btn btn-primary btn-sm'])}}
{!! Form::close() !!}

<?php
if(count($allsessions) === 0){
  echo "<h4>add a time block to the calendar.</h4>";
} else {
  echo "<table class='table'>";
      
      foreach($allsessions as $session){
          $session_start = new Carbon($session->start);
          $session_end = new Carbon($session->end);

              echo "<tr><td>". $session->name. " - ". $session_start->format('l') . " " . $session_start->format('g:ia') . " to ". $session_end->format('g:ia') ."</td>";
              ?>
              @if(!Auth::guest())
                  <td>
                      {!!Form::open(['action' => ['TimeblocksController@destroy', $session->id], 'method' => 'POST' ])!!}
                          {{Form::hidden('_method', 'DELETE')}}
                          <a href="/calendars/{{$session->id}}/edit" class="btn btn-default  btn-xs">Edit</a>
                          {{Form::submit('Delete', ['class' => 'btn btn-default  btn-xs'])}}
                      {!!Form::close()!!}
                  </td>
                @endif
                </tr>
              <?php

      }
      echo "</tr>";

   echo "</table>";
}
?>



@endsection
