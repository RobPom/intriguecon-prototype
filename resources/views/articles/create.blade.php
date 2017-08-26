@extends('layouts.app')

@section('content')
    <h1>New Article</h1>
    {!! Form::open(['action' => 'ArticlesController@store' , 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::Label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter a title for the article'])}}
        </div>
        <div class="form-group">
            {{Form::Label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection