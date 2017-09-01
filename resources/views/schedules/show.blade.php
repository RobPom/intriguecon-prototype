@extends('layouts.app')

@section('content')
<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{$schedule->name}}</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%" src="/storage/event_images/{{$schedule->event_image}}"><br><br>
                </div>
                <div class="col-md-8 col-sm-8">
                    <p>{!!$schedule->description!!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                <a href="/events" class="btn btn-default">Back</a>
                </div>
                <div class="col-sm-6">
                    @if(!Auth::guest())
                        <a href="/events/{{$schedule->id}}/edit" class="btn btn-default pull-right">Edit</a>  
                        {!!Form::open(['action' => ['SchedulesController@destroy', $schedule->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    @endif
                </div>
            </div>
        </div>
    </div>
     @include('timeblocks.showinsert')
</div>
@endsection

