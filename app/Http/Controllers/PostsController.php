<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::orderBy('created_at','desc')->take(5)->get();
        //$posts = DB::select('Select * from posts');
        //$posts = Post::all();
        $posts = Post::orderBy('created_at','desc')->get();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'cover_image' => 'image|nullable|max:1999'
        ]);
            //upload obrazku
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just fileName
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $filenameToStore = $filename. '_'.time().'.'.$extension;
            //upload img
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        } else {
            $filenameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Clanok bol vytvoreny');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //ochrana aby menit prispevky mohol iba autor
        if($post->user_id !== auth()->user()->id){
            return redirect('./')->with('error', 'Neopravneny pristup');
        }
        return view('posts.edit')->with('post', $post);
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

        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just fileName
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $filenameToStore = $filename. '_'.time().'.'.$extension;
            //upload img
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        } 
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if($request->hasFile('cover_image')){
            $post->cover_image = $filenameToStore;
           /* if ($request->hasFile('cover_image')) {
                Storage::delete('public/cover_images/' . $post->cover_image);
                $post->cover_image = $fileNameToStore;
            }/*/
        }
        $post->save();

        return redirect('/posts')->with('success', 'Clanok bol Upraveny!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->user_id !== auth()->user()->id){
            return redirect('./')->with('error', 'Neopravneny pristup');
        }
        if($post->cover_image != 'noimage.jpg'){
            //delete img
            Storage::delete('public/cover_image'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Clanok bol odstraneny');
    }
}
