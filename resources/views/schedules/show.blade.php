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

    <ul class="nav nav-tabs">
            @php ($i = 1)
            @foreach($schedule->timeblocks as $timeblock)
                @if($i == 1)
                    <li class="active"><a data-toggle="tab" href="#{{date("l", strtotime($timeblock->start))}}">{{date("l", strtotime($timeblock->start))}}</a></li>
                @else
                    <li><a data-toggle="tab" href="#{{date("l", strtotime($timeblock->start))}}">{{date("l", strtotime($timeblock->start))}}</a></li>
                @endif
                @php ($i ++)   
            @endforeach  
    </ul>
    @php ($i = 1)
    <div class="tab-content">
        @foreach($schedule->timeblocks as $timeblock)
            @if($i == 1)
                <div id="{{date("l", strtotime($timeblock->start))}}" class="tab-pane fade in active">    
            @else
                <div id="{{date("l", strtotime($timeblock->start))}}" class="tab-pane fade">
            @endif
                    <h4>{{date("l F jS", strtotime($timeblock->start))}}</h4>  
                </div>
        @php ($i ++)
        @endforeach
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
    <a href="/schedules" class="btn btn-default">All Events</a>

    @if(!Auth::guest())

        <a href="/schedules/{{$schedule->id}}/edit" class="btn btn-default">Edit</a>
        {!!Form::open(['action' => ['SchedulesController@destroy', $schedule->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}

    @endif
@endsection
