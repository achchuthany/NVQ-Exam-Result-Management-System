<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
class AcademicYearController extends Controller
{
    private $status = array('1'=>'Active','2'=>'Completed','3'=>'Planning');
    public function getAcademicYears(){

        $AcademicYears = AcademicYear::orderBy('id','desc')->paginate(10);
        return view('academic.academicyears',['academicyears' =>$AcademicYears]);
    }
    public function getAcademicYearCreate(){
        return view('academic.academicyear',['status' =>$this->status]);
    }
    public function postCreateAcademicYear(Request $request){
        $this->validate($request,[
            'name'=>'required|max:20',
            'start'=>'required|date',
            'end'=>'required|date',
            'status'=>'required'
            ]);
        $ay = new AcademicYear();
        $ay->name = $request['name'];
        $ay->start = $request['start'];
        $ay->end = $request['end'];
        $ay->status = $request['status'];
        $message = 'There was an error';
        if($ay->save()){
           $message = 'Academic Year successfully created';
        }
        return redirect()->route('academics')->with(['message'=>$message]);
    }

    public function postEditAcademicYear(Request $request){
        $this->validate($request,[
            'name'=>'required|max:20',
            'start'=>'required|date',
            'end'=>'required|date',
            'status'=>'required'
            ]);

            $ay = AcademicYear::find($request['id']);
            $ay->name = $request['name'];
            $ay->start = $request['start'];
            $ay->end = $request['end'];
            $ay->status = $request['status'];
            $ay->update();
            return response()->json(['new_name' => $ay->name], 200);
    }
    public function getDeleteAcademicYear($n_id){
        $ay = AcademicYear::where('id',$n_id)->first();
        try {
            $ay->delete();
            $message = "Academic Year Successfully Deleted!";
        } catch (QueryException  $e) {       
            $message = "Academic Year was not Deleted, Try Again!";
        } 
        return redirect()->route('academics')->with(['message'=>$message]);
    }
}
