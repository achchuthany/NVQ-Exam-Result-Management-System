<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Database\QueryException;
class DepartmentController extends Controller 
{
    public function getDerpartments(){

        $departments = Department::orderBy('code','asc')->paginate(10);
        return view('academic.departments',['departments' =>$departments]);
    }

    public function postCreateDepartment(Request $request){
        $this->validate($request,[
            'd_name'=>'required|max:255',
            'code'=>'required|max:3'
        ]);
        $department = new Department();
        $department->name = $request['d_name'];
        $department->code = strtoupper($request['code']);
        $message = 'There was an error';
        if($department->save()){
           $message = 'Department successfully created';
        }
        return redirect()->route('departments')->with(['message'=>$message]);
    }

    public function postEditDepartment(Request $request){
            $this->validate($request,[
                'd_name'=>'required|max:255',
                'code'=>'required|max:3'
            ]);
            $department = Department::find($request['d_id']);
            $department->name = $request['d_name'];
            $department->code = strtoupper($request['code']);
            $department->update();
            return response()->json(['new_name' => $department->name,'new_code'=>$department->code], 200);
    }
    public function getDeleteDepartment($d_id){
        $post = Department::where('id',$d_id)->first();
        try {
            $result = $post->delete();
            $message = "Department Successfully Deleted!";
        } catch (QueryException  $e) {       
            $message = "Department was not Deleted, Try Again!";
        }
        return redirect()->route('departments')->with(['message'=>$message]);
    }
}
