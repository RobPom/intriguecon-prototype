<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Timeblocks;
use App\Schedule;
use DateTime;
use DatePeriod;
use DateInterval;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Schedule::orderBy('start', 'desc')->paginate(10);
        return view('schedules.index')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.create');
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
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'game_image' => 'image|nullable|max:1999'
        ]);

        //Handle Image Upload
        if($request->hasFile('event_image')){
            $filenameWithExt = $request->file('event_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            //get just extension
            $extention = $request->file('event_image')->getClientOriginalExtension();
            //file name to stor
            $fileNameToStore = $filename.'_'.time(). '.' .$extention;
            //upload Image
            $path = $request->file('event_image')->storeAs('public/event_images', $fileNameToStore );

        } else {
             //change this to not use image if not saved
            $fileNameToStore = 'noimage.jpg';
        }


        //create event
        $schedule = new Schedule;
        $schedule->name = $request->input('name');
        $schedule->description = $request->input('description');

        //set datetime for start and end
        $schedule->start = $request->input('start');
        $schedule->end = $request->input('end');
        $schedule->created_by = auth()->user()->name;
        $schedule->edited_by = "none";
        $schedule->event_image = $fileNameToStore;
        $schedule->save();

        return redirect('/schedules/'. $schedule->id)->with('success', 'event created');
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
        
        $begin = new DateTime($schedule->start);
        $end = new DateTime($schedule->end);
        $end = $end->modify( '+1 day' ); 
        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
        return view('timeblocks.show')->with('schedule', $schedule)->with('daterange', $daterange);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Schedule::find($id);    
        return view('schedules.edit')->with('event', $event);
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
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'game_image' => 'image|nullable|max:1999'
        ]);

        //Handle Image Upload
        if($request->hasFile('event_image')){
            $filenameWithExt = $request->file('event_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            //get just extension
            $extention = $request->file('event_image')->getClientOriginalExtension();
            //file name to stor
            $fileNameToStore = $filename.'_'.time(). '.' .$extention;
            //upload Image
            $path = $request->file('event_image')->storeAs('public/event_images', $fileNameToStore );

        } else {
             //change this to not use image if not saved
            $fileNameToStore = 'noimage.jpg';
        }


        //create event
        $schedule = Schedule::find($id);
        $schedule->name = $request->input('name');
        $schedule->description = $request->input('description');

        //set datetime for start and end
        $schedule->start = $request->input('start');
        $schedule->end = $request->input('end');
        $schedule->edited_by = auth()->user()->name;
        if($request->hasFile('event_image')){
            $schedule->event_image = $fileNameToStore;
        }   
        $schedule->save();

        return redirect('/schedules/'. $schedule->id)->with('success', 'event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Schedule::find($id);
                
        if($event->event_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/event_images/' . $event->event_image);
        }
        
        $event->delete();
        return redirect('/schedules')->with('success', 'Event Removed');
    }
}
