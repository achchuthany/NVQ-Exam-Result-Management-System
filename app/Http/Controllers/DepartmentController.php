<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Database\QueryException;
class DepartmentController extends Controller
{
    public function getDerpartmentCreate(){
        return view('academic.department');

    }
    public function getDerpartments(){

        $departments = Department::orderBy('code','asc')->paginate(10);
        return view('academic.departments',['departments' =>$departments]);
    }

    public function postCreateDepartment(Request $request){
        $this->validate($request,[
            'd_name'=>'required|max:255',
            'code'=>'required|max:3'
        ]);
        $message=$warning=null;
        $department = new Department();
        $department->name = $request['d_name'];
        $department->code = strtoupper($request['code']);
        if($department->save()){
           $message = $department->name.' successfully created';
        }else{
            $warning = 'There was an error';
        }
        return redirect()->route('departments')->with(['message'=>$message,'warning'=>$warning]);
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
        $message=$warning=null;
        $post = Department::where('id',$d_id)->first();
        if(!$post){
            $warning = " Department was not listed, Try Again!";
            return redirect()->route('departments')->with(['message'=>$message,'warning'=>$warning]);
        }
        try {
            $result = $post->delete();
            $message = $post->name." Successfully Deleted!";
        } catch (QueryException  $e) {
            $warning = $post->name." was not Deleted, Try Again!";
        }
        return redirect()->route('departments')->with(['message'=>$message,'warning'=>$warning]);
    }
}
