<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function store(Request $request, Tag $tag)
    {
        $user = Auth::user();
        $tag = new Tag();
        $tag->tag = $request->get('tag');
        $tag->save();

        return back();
    }
}

