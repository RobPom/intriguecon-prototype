@extends('layouts.app')

@section('content')

    <h1>{{$game->name}}</h1>
    <h4>{!!$game->tagline!!}</h4>
    <div class="row">
        <div class="col-md-4 col-sm-4">
         <img style="width:100%" src="/storage/game_images/{{$game->game_image}}"><br><br>
           
        </div>
        <div class="col-md-8 col-sm-8">
            <p>{!!$game->description!!}</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <p>{!!$game->short_description!!}</p>
            <p>{!!$game->advisory!!}</p>
        </div>
        <div class="col-md-6 col-sm-12">
            <p>Seats #/#</p>
        </div>  
    </div>
   <hr>
    <small>Added by  {{$game->created_by}} on {{$game->created_at->format('d/m/y')}}</small><br>
    @if ($game->edited_by == 'none')
        
    @else
        <small>Updated by  {{$game->edited_by}} on {{$game->updated_at->format('d/m/y')}}</small><br>
    @endif
    
    
    <hr>
    <a href="/games" class="btn btn-default">Go back</a>

    @if(!Auth::guest())

        <a href="/games/{{$game->id}}/edit" class="btn btn-default">Edit</a>
        {!!Form::open(['action' => ['GamesController@destroy', $game->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}

    @endif
    <br>
    @foreach($game->timeblocks as $timeblock)
        <h4>{{$timeblock->name}}</h4>
    @endforeach
@endsection