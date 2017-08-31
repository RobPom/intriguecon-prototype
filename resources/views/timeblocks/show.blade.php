@extends('layouts.app')

@section('content')
<h4>Calendar for {{$schedule->name}}</h4>



<?php
use Carbon\Carbon;

foreach($everydate as $day){
    $day = new Carbon($day);
    echo "<h2>". $day->format('l') . "</h2><br>";
    echo "<ul>";
    foreach($allsessions as $session){
        $session_start = new Carbon($session->start);
        $session_end = new Carbon($session->end);

       if($session_start->format('l') == $day->format('l')){
            echo "<li>". $session->name. " - ". $session_start->format('g:ia') . " to ". $session_end->format('g:ia') ."</li><br>";

            ?>
               
                <?php
       }

       
    }
    echo "</ul>";
}


?>

@endsection