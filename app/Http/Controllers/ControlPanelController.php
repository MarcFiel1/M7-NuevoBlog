<?php
namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class ControlPanelController extends Controller
{
    public function index()
    {
        // $user=Auth::user();

        // return view('controlpanel', ['user'=>$user]);

        if($user=Auth::user()){
            $users=User::all();
        } 
        return view('controlpanel',compact('users'));

    }
   
    
    public function edit(User $user)
    {
        $user=Auth::user();
        return view('controlpanel.edit', ['user'=>$user]);
    }

   
    public function update(Request $request, User $user)
    {
        $validateData=$request->validate([
            'username' => 'string',
            'email' => 'string'

        ]);
        $user->update($validateData);
        return redirect('/controlpanel');

    }

   
    public function destroy(User $user)
    {   
        var_dump($user);
        $user->delete();
        return redirect('/controlpanel');
    }
}