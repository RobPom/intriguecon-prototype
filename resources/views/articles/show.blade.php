@extends('layouts.app')

@section('content')

    <h1>{{$article->title}}</h1>
    <div>
        {!!$article->body!!}
   </div>
   <hr>
    <small>Written on {{$article->created_at->format('d/m/y')}} by {{$article->user->name}}</small><br>
    <hr>
    <a href="/articles" class="btn btn-default">Go back</a>

    @if(!Auth::guest())
        @if(auth::user()->id == $article->user_id)
            <a href="/articles/{{$article->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action' => ['ArticlesController@destroy', $article->id], 'method' => 'POST', 'class' => 'pull-right' ])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection