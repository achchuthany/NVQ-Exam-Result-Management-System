<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        try {
            $this->validate($request, ['username' => 'required', 'password' => 'required']);
        } catch (ValidationException $e) {
        }
        $remember_me = $request->has('remember_me');

        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']],$remember_me )) {
            if(Auth::user()->hasRole('Lecturer')){
                return redirect()->route('lecturer');
            }
            else if(Auth::user()->hasRole('Student')){
                return redirect()->route('student');
            }
            return redirect()->route('home');
        }
        return redirect()->back()->with(['warning'=>'Incorrect username or password.']);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function  postAssignRoles(Request $request){
        $user = User::where('email',$request['email'])->first();
        $user->roles()->detach();

        // if($request['Student']){
        //     $user->roles()->attach(Role::where('name','Student')->first());
        // }
        if ($request['MA']) {
            $user->roles()->attach(Role::where('name', 'MA')->first());
        }
        if ($request['Lecturer']) {
            $user->roles()->attach(Role::where('name', 'Lecturer')->first());
        }
        if ($request['Head']) {
            $user->roles()->attach(Role::where('name', 'Head')->first());
        }
        if ($request['Admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        //return response()->json(['attendance' => Auth::user()->roles], 200);
        return redirect()->back();
    }
    public function getUserIndex(){
        return view('administration.user');
    }
    public function postCreateUser(Request $request){
        return response()->json(['logs' => $request], 200);
    }
    public function showChangePasswordForm(){
        return view('login.changepassword');
    }
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }
}
