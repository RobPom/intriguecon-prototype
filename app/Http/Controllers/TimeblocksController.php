<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Timeblock;
use DateTime;
use Carbon;

class TimeblocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   $schedule = Schedule::findOrFail($id);      
        $startdate =  new Carbon($schedule->start);
        $end = new Carbon($schedule->end);
        $allsessions = $schedule->timeblocks->sortBy("start");
       
        $everydate = generateDateRange($startdate, $end);
        $startdate =  new Carbon($schedule->start);
        $form_defaults = array(
            "startdate"=> $startdate->format('Y-m-d'), 
            "starttime"=>$startdate->format('H:i:s'), 
            "endtime"=>$end->format('H:i:s')
        );
        return view('timeblocks.create')->with('schedule', $schedule)->with('form_defaults', $form_defaults)->with('everydate', $everydate)->with('allsessions', $allsessions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        
        $start =  $request->input('date'). " " .$request->input('start');
        $end =  $request->input('date'). " " .$request->input('end');
        $id = $request->input('schedule_id');
        //create event
        $timeblock = new Timeblock;
        $timeblock->name = $request->input('name');
        $timeblock->schedule_id = $request->input('scheduleid');
        $timeblock->start = $start;
        $timeblock->end = $end;
       $timeblock->save();

       $schedule = Schedule::findOrFail($timeblock->schedule_id);
       $start = new Carbon($schedule->start);
       $end = new Carbon($schedule->end);
       $everydate = generateDateRange($start, $end);
       $allsessions = $schedule->timeblocks->sortBy("start");

       return redirect('calendars/'. $schedule->id . "/modify")->with('schedule', $schedule)->with('everydate', $everydate)->with('allsessions', $allsessions)->with('success', 'game session created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        $start = new Carbon($schedule->start);
        $end = new Carbon($schedule->end);
        $everydate = generateDateRange($start, $end);
        $allsessions = $schedule->timeblocks->sortBy("start");

        return view('timeblocks.show')->with('schedule', $schedule)->with('everydate', $everydate)->with('allsessions', $allsessions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timeblock = Timeblock::findOrFail($id);
            
        $startdate = new Carbon($timeblock->start);
        $end = new Carbon($timeblock->end);

        $form_defaults = array(
            "startdate"=> $startdate->format('Y-m-d'), 
            "starttime"=>$startdate->format('H:i:s'), 
            "endtime"=>$end->format('H:i:s')
        );

        return view('timeblocks.edit')->with('timeblock', $timeblock)->with('form_defaults', $form_defaults);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $start =  $request->input('date'). " " .$request->input('start');
        $end =  $request->input('date'). " " .$request->input('end');
        //$id = $request->input('schedule_id');
        //create event
        $timeblock = Timeblock::find($id);
        $timeblock->name = $request->input('name');
        $timeblock->start = $start;
        $timeblock->end = $end;
       $timeblock->save();

       $schedule = Schedule::findOrFail($timeblock->schedule_id);
       $start = new Carbon($schedule->start);
       $end = new Carbon($schedule->end);
       $everydate = generateDateRange($start, $end);
       $allsessions = $schedule->timeblocks->sortBy("start");

       return redirect('calendars/'. $schedule->id . "/modify")->with('schedule', $schedule)->with('everydate', $everydate)->with('allsessions', $allsessions)->with('success', 'game session saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeblock = Timeblock::find($id);
        $schedule = Schedule::findOrFail($timeblock->schedule_id);
        $start = new Carbon($schedule->start);
        $end = new Carbon($schedule->end);
        $everydate = generateDateRange($start, $end);
        $allsessions = $schedule->timeblocks->sortBy("start");

        $timeblock->delete();
        return redirect('calendars/'. $schedule->id . "/modify")->with('schedule', $schedule)->with('everydate', $everydate)->with('allsessions', $allsessions)->with('success', 'Gameblock Removed');
        //return redirect(URL::previous() )->with('success', 'Event Removed');
    }
}
