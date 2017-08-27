@extends('layouts.app')

@section('content')
    <h1>Games</h1>
    @if(count($games) > 0)
        @foreach($games as $game)
            <div class="well">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <img style="width:100%" src="/storage/game_images/{{$game->game_image}}">
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <h3><a href="/games/{{$game->id}}">{{$game->name}}</a></h3>
                        <h5>{{$game->tagline}}</h5>
                        <small>{{$game->short_description}}</small>
                    </div>
                </div>
            </div>
        @endforeach

        
    @else
        <p>No games found</p>
    @endif
     @if(!Auth::guest())
            <a href="/games/create" class="btn btn-primary pull-right">New Game</a>

    @endif
@endsection