@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card">
                <div class="card-header">{{ __('Panel de control') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($users as $user)
                    <form method="POST" action="{{ route('users.destroy', $user)}}">
                        @csrf
                        @method('DELETE')
                        <label>Username:</label>
                        <input type="text" id="title" name="title" style="width: 500px" value="{{$user->username}}"><br><br>
                        <label>Email:</label>
                        <input type="text" id="email" name="email" style="width: 500px" value="{{$user->email}}"><br><br>
                        <div style="display: flex; flex-direction:row; float:right; border-bottom:grey 1px solid";>
                        <input class="btn btn-danger" type="submit" style="margin:0px 2px 5px 2px" value="Delete">
                          
                        </div>
                        <br><br><br><br> <br>
                        </form>
                        
                        {{-- <div style="display: flex; flex-direction:row; float:right; border-bottom:grey 1px solid";>
                            <a class="btn btn-primary" style="margin:0px 2px 5px 500px" href="{{ route('profile') }}">Edit</a>  --}}
                        {{-- <form method="POST" action="{{route('controlpanel.destroy', $user)}}">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" style="margin:0px 2px 5px 2px" value="Delete">
                        </form> --}}
                        @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection