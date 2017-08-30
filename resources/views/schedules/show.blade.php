@extends('layouts.app')

@section('content')

    <h1>{{$schedule->name}}</h1>

    <div class="row">
        <div class="col-md-4 col-sm-4">
         <img style="width:100%" src="/storage/event_images/{{$schedule->event_image}}"><br><br>
           
        </div>
        <div class="col-md-8 col-sm-8">
        <h4>{!! date("F jS", strtotime($schedule->start))!!} to {!! date("jS, Y", strtotime($schedule->end))!!}</h4>
            <p>{!!$schedule->description!!}</p>
        </div>

    </div>
    <hr>
    <div class="row">
    <small>Added by  {{$schedule->created_by}} on {{$schedule->created_at->format('d/m/y')}}</small><br>
        @if ($schedule->edited_by == 'none')
            
        @else
            <small>Updated by  {{$schedule->edited_by}} on {{$schedule->updated_at->format('d/m/y')}}</small><br>
        @endif
    </div>
    
  
    <hr>
    <a href="/events" class="btn btn-default">All Events</a>

    @if(!Auth::guest())

        <a href="/events/{{$schedule->id}}/edit" class="btn btn-default">Edit</a>
        {!!Form::open(['action' => ['SchedulesController@destroy', $schedule->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}

    @endif

<a href="/calendars/{{$schedule->id}}/create" class="btn btn-default" > Add a calendar</a>

@endsection


