@extends('layouts.app')

@section('content')
    <h1>Locations</h1>
    @if(count($locations) > 0)
        @foreach($locations as $location)
            <div class="">
                
            <h3><a href="/locations/{{$location->id}}">{{$location->name}}</a></h3>
            <small>{{$location->city}}, {{$location->province}}</small>

            </div>
        @endforeach

    @else
        <p>No locations found</p>
    @endif
@endsection