@extends('layouts.app')

@section('content')

    <h1>{{$location->name}}</h1>
    {{$location->street_1}} {{$location->street_2}} <br>
    {{$location->city}}, {{$location->province}} <br>
    {{$location->country}}, {{$location->postal}} <br>
   

    @if(!Auth::guest())

            <a href="/locations/{{$location->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action' => ['LocationsController@destroy', $location->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}

    @endif
@endsection