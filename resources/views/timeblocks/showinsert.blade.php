


<?php
use Carbon\Carbon;

$sessions = $schedule->timeblocks->sortBy("start");
$startdate =  new Carbon($schedule->start);
$end = new Carbon($schedule->end);
$everydate = generateDateRange($startdate, $end);
?>
<div class="panel panel-default">
  <div class="panel-heading">
    <div class="row">
        <div class= "col-sm-6">
            <h4>Event Calendar</h4> 
        </div>
        <div class= "col-sm-6 pull-right">
             @if(!Auth::guest())
                <a href="/calendars/{{$schedule->id}}/modify" class="btn btn-default pull-right" > Edit Calendar</a>
            @endif
        </div>
    </div>
</div>
    <div class="panel-body">
        <h4>{!! date("F jS", strtotime($schedule->start))!!} to {!! date("jS, Y", strtotime($schedule->end))!!}</h4>
        <?php
        foreach($everydate as $day){
            $day = new Carbon($day);
            echo "<h4>". $day->format('l') . "</h4><br>";
            echo "<ul>";
            foreach($sessions as $session){
                $session_start = new Carbon($session->start);
                $session_end = new Carbon($session->end);

            if($session_start->format('l') == $day->format('l')){
                    echo "<li>". $session->name. " - ". $session_start->format('g:ia') . " to ". $session_end->format('g:ia') ."</li><br>";
            
                }
                echo "</ul>";
            }
        }
        ?>
    </div>
</div>
