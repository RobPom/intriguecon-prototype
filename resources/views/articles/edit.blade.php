@extends('layouts.app')

@section('content')
    <h1>Edit Article</h1>
    {!! Form::open(['action' => ['ArticlesController@update', $article->id] , 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::Label('title', 'Title')}}
            {{Form::text('title', $article->title, ['class' => 'form-control', 'placeholder' => 'Enter a title for the article'])}}
        </div>
        <div class="form-group">
            {{Form::Label('body', 'Body')}}
            {{Form::textarea('body', $article->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection