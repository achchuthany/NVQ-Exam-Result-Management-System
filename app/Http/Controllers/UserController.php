<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLoginIndex(){
        return view('login.login');
    }
    public function getAllUsers()
    {
        $roles = Role::get();
        $users = User::paginate(30);;
        return view('administration.users', ['users' => $users,'roles'=>$roles]);
    }
    public function postSignIn(Request $request)
    {
        $this->validate($request,['email'=>'required','password'=>'required']);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('home');
        }
        return redirect()->back()->with(['message'=>'Incorrect username or password.']);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
