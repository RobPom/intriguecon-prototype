@section('content')
<?php
foreach($everydate as $day){
    $day = new DateTime($day);
    echo "<h2>". $day->format('l') . "</h2><br>";
    echo "<ul>";
    foreach($allsessions as $session){
        $session_start = new DateTime($session->start);
        $session_end = new DateTime($session->end);
       if($session_start->format('l') === $day->format('l')){
            echo "<li>". $session->name. " - ". $session_start->format('g:ia') . " to ". $session_end->format('g:ia') ."</li><br>";
       }
    }
    echo "</ul>";
}

?>
@endsection