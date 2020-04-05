<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;

class AjaxRequestController extends Controller
{
    public function postGetModulesbyCourse(Request $request){
        $this->validate($request,['id'=>'required']);
        $modules = Module::where('course_id',$request['id'])->orderBy('code','asc')->get();
        return response()->json(['modules' => $modules], 200);

    }
}
