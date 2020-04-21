<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Batch;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BatchController extends Controller
{
    public function getBatches(){

        $batches = Batch::orderBy('academic_year_id','desc')->orderBy('name', 'desc')->paginate(20);
        return view('academic.batches',['batches' =>$batches]);
    }
    public function getBatchCreate(){
        $courses = Course::orderBy('name','asc')->get();
        $academicyears = AcademicYear::orderBy('name','desc')->get();
        return view('academic.batch',['courses'=>$courses,'academicyears'=>$academicyears]);
    }

    public function postCreateBatch(Request $request){
        $this->validate($request,[
            'academic_year_id'=>'required',
            'course_id'=>'required',
            'name'=>'required'
            ]);
        $Course = Course::find($request['course_id']);
        if(!$Course){
            return null;
        }
        $AcademicYear = AcademicYear::find($request['academic_year_id']);
        if(!$AcademicYear){
            return null;
        }
        $batch = new Batch();
        $batch->academic_year_id = $request['academic_year_id'];
        $batch->course_id = $request['course_id'];
        $batch->name = $request['name'];
        $message = 'There was an error';
        if($batch->save()){
           $message = 'Batch successfully created';
        }
        return redirect()->route('batches')->with(['message'=>$message]);
    }

    public function postEditBatch(Request $request){
        $this->validate($request,[
            'academic_year_id'=>'required',
            'course_id'=>'required',
            'name'=>'required'
            ]);
            $batch = Batch::find($request['id']);
            $batch->academic_year_id = $request['academic_year_id'];
            $batch->course_id = $request['course_id'];
            $batch->name = $request['name'];
            $batch->update();
            return response()->json(['new_name' => $batch->name], 200);
    }
    public function getDeleteBatch($id){
        $batch = Batch::where('id',$id)->first();
        try {
            $batch->delete();
            $message = "Batch Successfully Deleted!";
        } catch (QueryException  $e) {       
            $message = "Batch was not Deleted, Try Again!";
        } 
        return redirect()->route('batches')->with(['message'=>$message]);
    }
}
