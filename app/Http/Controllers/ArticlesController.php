<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Article;

class ArticlesController extends Controller
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
        //$articles = Article::orderBy('title', 'asc')->get();
        //return Article::where('title', 'title two')->get();
        //$articles = Article::orderBy('title','desc')->take(1)->get();

        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
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
            'title' => 'required',
            'body' => 'required',
            'article_image' => 'image|nullable|max:1999'
        ]);

        //Handle Image Upload
        if($request->hasFile('article_image')){
            $filenameWithExt = $request->file('article_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            //get just extension
            $extention = $request->file('article_image')->getClientOriginalExtension();
            //file name to stor
            $fileNameToStore = $filename.'_'.time(). '.' .$extention;
            //upload Image
            $path = $request->file('article_image')->storeAs('public/article_images', $fileNameToStore );

        } else {
             //change this to not use image if not saved
            $fileNameToStore = 'noimage.jpg';
        }


        //create article
        $article = new Article;
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->user_id = auth()->user()->id;
        $article->article_image = $fileNameToStore;
        $article->save();

        return redirect('/articles')->with('success', 'article created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        //check for correct user
        if(auth()->user()->id !== $article->user_id){
            return redirect('/articles')->with('error', 'Unauthorized Page');
        }

        return view('articles.edit')->with('article', $article);
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
            'title' => 'required',
            'body' => 'required'
        ]);

        //Handle Image Upload

        if($request->hasFile('article_image')){
            $filenameWithExt = $request->file('article_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
            //get just extension
            $extention = $request->file('article_image')->getClientOriginalExtension();
            //file name to stor
            $fileNameToStore = $filename.'_'.time(). '.' .$extention;
            //upload Image
            $path = $request->file('article_image')->storeAs('public/article_images', $fileNameToStore );

        } 

        //create article
        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        if($request->hasFile('article_image')){
            $article->article_image = $fileNameToStore;
        }
        $article->save();

        return redirect('/articles')->with('success', 'article updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        //check for correct user
        if(auth()->user()->id !== $article->user_id){
            return redirect('/articles')->with('error', 'Unauthorized Page');
        }

        if($article->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/article_images/' . $article->article_image);
        }
        
        $article->delete();
        return redirect('/articles')->with('success', 'Article Removed');
    }
}
