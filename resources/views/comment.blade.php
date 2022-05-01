@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
           <div class="card">
          
                @foreach($post->user()->get() as $user)
               
                <div class="card-header">Autor: <b>{{$user->username}}</b></div>
                @endforeach
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>{{$post->title}}</h2><br>
                        <p>{{$post->contents}}</p><br>

                        @foreach($post->tags()->get() as $tag)
                        <div style="color: green">{{$tag->tag}}</div>
                            @endforeach
                        <br>
                    <form method="POST" action="{{ route('comment.store')}}">
                        @csrf
                        @method('POST')
                        <input type="text" id="comment" name="comment" style="width: 500px"><br><br>
                        <input type="text" name="post_id" value="{{$post->id}}" hidden>
                        <input class="btn btn-success" type="submit" value="COMENTA"><br>
                        </form> 
                </div>
            
            <div class="card">
                
                @foreach ($post->comments()->get() as $comment) 
                @foreach($comment->user()->get() as $user)
                
               
                <div class="card-header"><b>{{$user->username}}</b></div>
                
                <div class="card-body">
                @php
                $comments = $post->comments()->get();
                @endphp
                <p>
                    {{$comment->comment}} 
                </p>
                @if((Auth::user()->id==$comment->user_id || Auth::user()->role_id==1))
          <form method="POST" action="{{ route('comment.destroy', $comment)}}">
            @csrf
            @method('DELETE')
            <input style="display: flex; flex-direction:row; float:right;"  class="btn btn-danger" type="submit" value="ELIMINAR"><br>
            </form> 
            @endif
            </div>
            </div>
           @endforeach
           @endforeach
        </div>
    </div>
    </div>
    </div>
@endsection