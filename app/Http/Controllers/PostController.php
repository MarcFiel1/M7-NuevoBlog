<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if($user=Auth::user()){
        //     $posts=Post::where('user_id',$user->id)->get();
        // } else {
        //     $posts=Post::all();
        // }
        $posts= Post::all();
        return view('home',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $this->autorize('create');
        return view('posts');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $user = Auth::user();
        $post = new Post();
        $post->title = $request->get('title');
        $post->contents = $request->get('contents');
        $post->user_id = $user->id;

        $post->save();

        $tags=explode(',', $request->get('tags'));

        foreach($tags as $tag){
            $etiqueta=Tag::create(['tag'=>$tag]);
            $post->tags()->attach($etiqueta);
        }
        return back();
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
        $this->authorize('view', $post);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData=$request->validate([
            'title' => 'string|unique:posts|max:90',
            'contents' => 'string'

        ]);
        $post->update($validateData);
        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    public function search(Request $request)
    {

        $search = $request->get('search');
        $posts = Post::where('title', 'like', "%{$search}%")->get();
        return view('home', compact('posts'));
    }
}
