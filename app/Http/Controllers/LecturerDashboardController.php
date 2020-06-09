<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerDashboardController extends Controller
{
    //
    public function getIndex()
    {
        $lecturer = Auth::user();
        if (!$lecturer) {
            return null;
        }
        return view('dashboard.lecturer');
    }
}
