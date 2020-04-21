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
        $message = $warning = null;
        $this->validate($request,[
            'name'=>'required|max:20',
            'start'=>'required|date',
            'end'=>'required|date',
            'status'=>'required'
            ]);
        $isUpdate = true;
        $ay = null;
        if ($request['id']) {
            $ay = AcademicYear::where('id', $request['id'])->first();
        }
        if (!$ay) {
            $ay = new AcademicYear();
            $isUpdate = false;
        }    
        $ay->name = $request['name'];
        $ay->start = $request['start'];
        $ay->end = $request['end'];
        $ay->status = $request['status'];
        $message = 'There was an error';
        if ($isUpdate && $ay->update()) {
            $message = 'Academic Year ' . $ay->name . ' successfully updated';
            $warning = null;
        } else if (!$isUpdate && $ay->save()) {
            $message = 'Academic Year ' . $ay->name . ' successfully created';
            $warning = null;
        }
        return redirect()->route('academics')->with(['message' => $message, 'warning' => $warning]);
    }

    public function getEditAcademicYear($id){
        $academic = AcademicYear::where('id',$id)->first();
        return view('academic.academicyear', ['academic'=> $academic,'status' => $this->status]);
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
