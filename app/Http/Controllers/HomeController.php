<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Role;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();

        //ddd($posts);
        if ($user->isAdmin()){
            $posts=Post::all();
        }
        else{
            $posts=Post::all();
        }
        return view('home', compact('posts'));//se cogen todos los posts del usuario para que se muestren en el home.blade
    }
}
