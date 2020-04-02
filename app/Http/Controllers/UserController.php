<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getLoginIndex(){
        return view('login.login');
    }
}
