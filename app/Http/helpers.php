<?php
use App\Schedule;


function getEveryDate($id){
    $schedule = Schedule::findOrFail($id);
    $start = new Carbon($schedule->start);
    $end = new Carbon($schedule->end);
    $everydate = generateDateRange($start, $end);
    return $everydate;
}

function generateDateRange(Carbon\Carbon $start_date, Carbon\Carbon $end_date)
{
    $dates = [];

    for($date = $start_date; $date->lte($end_date); $date->addDay()) {
        $dates[] = $date->format('Y-m-d H:i:s');
    }

    return $dates;
}
?>