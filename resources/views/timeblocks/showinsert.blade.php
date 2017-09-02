


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
            <?php
            if(count($sessions) > 0){
                foreach($everydate as $day){
                    $day = new Carbon($day);
                    echo "<div class='col-md-4'>";
                    echo "<div class='panel panel-default'>";
                    echo "<div class='panel-heading'><h4>". $day->format('l')."<small> ". $day->format('F jS'). "</small></h4></div>";
                    echo "<div class='panel-body'>";
                    echo "<div class='list-group'>";
                    foreach($sessions as $session){
                        $session_start = new Carbon($session->start);
                        $session_end = new Carbon($session->end);
                        if($session_start->format('l') == $day->format('l')){
                             echo "<a href='#' class='list-group-item list-group-item-action'>". $session->name. " - ". $session_start->format('g:ia') . " to ". $session_end->format('g:ia') ."</a>";
                        }
                    }
                    echo "</div></div></div></div>";
                }
            } else {
                echo "<p>Nothing is scheduled</p>";
            }
            ?>
        
    </div>
</div>
