<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Batch;
use App\Course;
use App\StudentEnroll;
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
        $message = $warning = null;
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
        $isUpdate = true;
        $batch = null;
        if ($request['id']) {
            $batch = Batch::where('id', $request['id'])->first();
        }
        if (!$batch) {
            $batch = new Batch();
            $isUpdate = false;
        }    
        $batch->academic_year_id = $request['academic_year_id'];
        $batch->course_id = $request['course_id'];
        $batch->name = $request['name'];
        $warning = 'There was an error';
        if($isUpdate && Batch::where([['course_id', $request['course_id']],['academic_year_id', $request['academic_year_id']]])->first()){
            $warning = $batch->academic_year_id. ' record already exists';
        }
        else if ($isUpdate && $batch->update()) {
            $message = $batch->name . ' successfully updated';
            $warning = null;
        } else if (!$isUpdate && $batch->save()) {
            $message = $batch->name . ' successfully created';
            $warning = null;
        }
        return redirect()->route('batches')->with(['message' => $message, 'warning' => $warning]);
    }

    public function getEditBatch($id){
        $courses = Course::orderBy('name', 'asc')->get();
        $academicyears = AcademicYear::orderBy('name', 'desc')->get();
        $batch = Batch::where('id',$id)->first();
        return view('academic.batch', ['batch' => $batch, 'courses' => $courses, 'academicyears' => $academicyears]);
    }
    public function getDeleteBatch($id){
        $message = $warning = null;
        $batch = Batch::where('id',$id)->first();
        $student_enroll = StudentEnroll::where([['academic_year_id', $batch->academic_year_id],['course_id', $batch->course_id]])->first();
        if(!$student_enroll && $batch->delete()){
            $message = $batch->name . " Successfully Deleted!";
        }else{
            $warning = $batch->name . " was not Deleted, Try Again!";
        }
        return redirect()->route('batches')->with(['message' => $message, 'warning' => $warning]);
    }
}
