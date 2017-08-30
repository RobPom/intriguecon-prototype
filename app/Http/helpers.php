<?php
function generateDateRange(Carbon\Carbon $start_date, Carbon\Carbon $end_date)
{
    $dates = [];

    for($date = $start_date; $date->lte($end_date); $date->addDay()) {
        $dates[] = $date->format('Y-m-d H:i:s');
    }

    return $dates;
}
?>