@extends('layouts.app')

@section('content')
    <h1>Conventions</h1>
    @if(count($events) > 0)
        @foreach($events as $event)
            <div class="well">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <img style="width:100%" src="/storage/event_images/{{$event->event_image}}">
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <h3><a href="/schedules/{{$event->id}}">{{$event->name}}</a></h3>
                    </div>
                </div>
            </div>
        @endforeach

        
    @else
        <p>No Events found</p>
    @endif
     @if(!Auth::guest())
            <a href="/schedules/create" class="btn btn-primary pull-right">New Convention</a>

    @endif
@endsection