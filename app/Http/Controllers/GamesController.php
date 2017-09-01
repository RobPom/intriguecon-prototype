<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Game;
use App\User;
use App\Schdule;
use App\Timeblocks;

class GamesController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['index' , 'show']]);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $games = Game::orderBy('name', 'asc')->paginate(10);
        return view('games.index')->with('games', $games);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
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
            'tagline' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'min' => 'required',
            'max' => 'required',
            'game_image' => 'image|nullable|max:1999'
        ]);

        //Handle Image Upload
        if($request->hasFile('game_image')){
            $filenameWithExt = $request->file('game_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            //get just extension
            $extention = $request->file('game_image')->getClientOriginalExtension();
            //file name to stor
            $fileNameToStore = $filename.'_'.time(). '.' .$extention;
            //upload Image
            $path = $request->file('game_image')->storeAs('public/game_images', $fileNameToStore );

        } else {
             //change this to not use image if not saved
            $fileNameToStore = 'noimage.jpg';
        }


        //create game
        $game = new Game;
        $game->name = $request->input('name');
        $game->tagline = $request->input('tagline');
        $game->short_description = $request->input('short_description');
        $game->description = $request->input('description');
        $game->advisory = $request->input('advisory');
        $game->min = $request->input('min');
        $game->max = $request->input('max');

        $game->created_by = auth()->user()->name;
        $game->edited_by = "none";
        $game->game_image = $fileNameToStore;
        $game->save();

        return redirect('/games/'. $game->id)->with('success', 'game created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $game = Game::find($id);

        $createdby = User::find($game->created_by);

        return view('games.show')->with('game', $game)->with('created_by', $createdby);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::find($id);    
        return view('games.edit')->with('game', $game);

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
            'tagline' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'min' => 'required',
            'max' => 'required',
            'game_image' => 'image|nullable|max:1999'
        ]);

        //Handle Image Upload
        if($request->hasFile('game_image')){
            $filenameWithExt = $request->file('game_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            //get just extension
            $extention = $request->file('game_image')->getClientOriginalExtension();
            //file name to stor
            $fileNameToStore = $filename.'_'.time(). '.' .$extention;
            //upload Image
            $path = $request->file('game_image')->storeAs('public/game_images', $fileNameToStore );

        } else {
             //change this to not use image if not saved
            $fileNameToStore = 'noimage.jpg';
        }

        //create game
        $game = Game::find($id);
        $game->name = $request->input('name');
        $game->tagline = $request->input('tagline');
        $game->short_description = $request->input('short_description');
        $game->description = $request->input('description');
        $game->advisory = $request->input('advisory');
        $game->min = $request->input('min');
        $game->max = $request->input('max');
        $game->edited_by = auth()->user()->name;
        if($request->hasFile('game_image')){
            $game->game_image = $fileNameToStore;
        }
        $game->game_image = $fileNameToStore;
        $game->save();

        return redirect('/games/'. $game->id)->with('success', 'game updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);
        
        if($game->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/game_images/' . $game->game_image);
        }
        
        $game->delete();
        return redirect('/games')->with('success', 'Game Removed');
    }

    
}
