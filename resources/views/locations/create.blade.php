@extends('layouts.app')

@section('content')
    <h1>Locations</h1>

<div class="panel-group">
    <div class="panel panel-default">
    {!! Form::open(['action' => 'LocationsController@store' , 'method' => 'POST']) !!}
        <div class="panel-heading">Add a Location</div>
        <div class="panel-body">
            <div class="form-group">
                {{Form::Label('name', 'Name')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name of the venue'])}}
            </div>
            <div class="form-group">
                {{Form::Label('street_1', 'Address')}}
                {{Form::text('street_1', '', ['class' => 'form-control', 'placeholder' => 'Street Address'])}}
            </div>
            <div class="form-group">
                {{Form::text('street_2', '', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::Label('city', 'City')}}
                {{Form::text('city', 'Edmonton', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::Label('province', 'Province')}}
                {{Form::text('province', 'Alberta', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::Label('country', 'Country')}}
                {{Form::text('country', 'Canada', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::Label('postal', 'Postal Code')}}
                {{Form::text('postal', '', ['class' => 'form-control', 'placeholder' => 'A1A1A1'])}}
            </div>
        </div>
        <div class="panel-footer">{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}</div>
        {!! Form::close() !!}
    </div>
 
    
@endsection