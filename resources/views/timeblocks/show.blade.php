@extends('layouts.app')

@section('content')
<h4>Calendar for {{$schedule->name}}</h4>



<?php
use Carbon\Carbon;
$now = new DateTime();
$independence = new DateTime('7/4/1776');
$bastille = new DateTime('14-7-1789');
$future = new DateTime('2040-01-01');
$relative = new DateTime('+3 weeks 2 days');
$lastTuesday = new DateTime('last Tuesday of December 2015');
$format = 'Y-m-d';
//echo $lastTuesday->format($format);

/*
echo "<input type='date' name='start_date' value='". $now->format('Y-m-d') . "' >";
echo "<input type='time' name='start_time' value='". $now->format('H:i:s') . "' >";
echo "<input type='time' name='end_time' value='". $now->format('H:i:s') . "' >";
$testDate =  $now->format('Y-m-d');
$testTime =  $now->format('H:i:s');
$combined = $testDate . " " . $testTime;
$testDateTime = new DateTime(  $now->format('Y-m-d H:i:s')  );
echo "<br>". $testDateTime->format('l jS \of F Y h:i:s A');
echo "<br>". $combined;
$combined = new DateTime($combined);
echo "<br><br>";
var_dump($combined);
*/




foreach($everydate as $day){
    $day = new Carbon($day);
    echo "<h2>". $day->format('l') . "</h2><br>";
    echo "<ul>";
    foreach($allsessions as $session){
        $session_start = new Carbon($session->start);
        $session_end = new Carbon($session->end);

       if($session_start->format('l') == $day->format('l')){
            echo "<li>". $session->name. " - ". $session_start->format('g:ia') . " to ". $session_end->format('g:ia') ."</li><br>";
       }
    }
    echo "</ul>";
}

//print_r($allsessions);



?>

@endsection