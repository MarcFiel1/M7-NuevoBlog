@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('search') }}" method="GET">
        <div style="display:flex; flex-direction:row;" >
            <input class="form-control" type="text" name="search">
            <button type="submit" class="btn btn-primary">Buscar</button> 
        </div>
    </form>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="GET" action="{{ route('posts.store')}}">
                        @csrf
                        <label>Titulo:</label><br>
                        <input type="text" id="title" name="title" style="width: 500px"><br><br>
                        <textarea id="contents" name="contents" cols="60" rows="5"></textarea><br>
                        <label>Tag:</label><br>
                        <input type="text" id="tags" name="tags" style="width: 200px"><br><br>
                        <input class="btn btn-primary" type="submit" value="Post" ><br>
                        </form> 
                </div>
            </div>
        </div>
    </div>
    <div class="p-2">
        
        @foreach ($posts->sortBy('id',SORT_REGULAR,true) as $post)    
    
        <br><br>

        <?php
        $users = $post->user()->get();
        ?>
        <div style="display:flex; flex-direction:row; float:right; font-size:15px">
        @foreach($users as $usuario)
        <b>{{$usuario->username}}</b>
        </div>
        @endforeach
        

        <div>
            <h3>{{$post->title}}</h3>
            {{$post->contents}}
            <br><br>
            <div style="color:rgba(4, 185, 49, 0.969); font-size:15px">
            @foreach($post->tags()->get() as $tag)
            {{$tag->tag}}
            @endforeach
            </div>
        </div>
        <div>
            <br>
            <a class="btn btn-info" style="margin:0px 0px 5px 0px;" href="{{ route('comment', $post) }}">Añadir comments</a>  
        </div> 
        @if (Auth::user()->id==$post->user_id)
        <div style="display: flex; flex-direction:row; float:right; border-bottom:grey 1px solid";>
            <a class="btn btn-primary" style="margin:0px 2px 5px 500px" href="{{ route('posts.edit', $post->id) }}">Edit</a> 
        @endif
            @if((Auth::user()->role_id==1 ||Auth::user()->id==$post->user_id))
        <form method="POST" action="{{route('posts.destroy', $post)}}">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" style="margin:0px 2px 5px 2px; float:right; border-bottom:grey 1px solid" value="Delete">
       </form>
        </div>
        
        @endif
        <br><h2><a>
             
        </a><br></h2>
        @endforeach
    
    </div>
</div>
@endsection