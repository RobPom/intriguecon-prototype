@extends('layouts.app')

@section('content')

@include('schedules.show',['event', $event] )

<h4>This is the create timeblock section</h4>
@endsection