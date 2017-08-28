@extends('layouts.app')

@section('content')

    <h1>{{$event->name}}</h1>

    <div class="row">
        <div class="col-md-4 col-sm-4">
         <img style="width:100%" src="/storage/event_images/{{$event->event_image}}"><br><br>
           
        </div>
        <div class="col-md-8 col-sm-8">
        <h4>{!! date("F jS", strtotime($event->start))!!} to {!! date("jS, Y", strtotime($event->end))!!}</h4>
            <p>{!!$event->description!!}</p>
        </div>

    </div>
    <hr>
    <div class="row">
        
    </div>
   <hr>
    <small>Added by  {{$event->created_by}} on {{$event->created_at->format('d/m/y')}}</small><br>
    @if ($event->edited_by == 'none')
        
    @else
        <small>Updated by  {{$event->edited_by}} on {{$event->updated_at->format('d/m/y')}}</small><br>
    @endif
    
    
    <hr>
    <a href="/schedules" class="btn btn-default">All Events</a>

    @if(!Auth::guest())

        <a href="/schedules/{{$event->id}}/edit" class="btn btn-default">Edit</a>
        {!!Form::open(['action' => ['SchedulesController@destroy', $event->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}

    @endif
@endsection