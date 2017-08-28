
@extends('schedules.show')

@section('calendar')

 @parent

    <h3>Schedule</h3>
    <br>
    <ul class="nav nav-tabs">
    @php ($i = 1)
    @foreach($daterange as $date)
        @if($i == 1)
            <li class="active"><a data-toggle="tab" href="#{{$date->format("l")}}">{{$date->format("l")}}</a></li>
        @else
            <li><a data-toggle="tab" href="#{{$date->format("l")}}">{{$date->format("l")}}</a></li>
        @endif
        @php ($i ++)
    @endforeach

    </ul>
    <div class="tab-content">
    @php ($i = 1)
        @foreach($daterange as $date)
            @if($i == 1)
                <div id="{{$date->format("l")}}" class="tab-pane fade in active">
                    <h4>{{$date->format("l F jS")}}</h4>
                    <p>This will be the individual game blocks</p>
                </div>
            @else
                <div id="{{$date->format("l")}}" class="tab-pane fade">
                    <h4>{{$date->format("l F jS")}}</h4>
                    <p>This will be the individual game blocks</p>
                </div>
            @endif
        @php ($i ++)
        @endforeach
    </div>
@endsection