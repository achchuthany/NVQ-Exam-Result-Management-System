<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Module;
use App\Student;
use App\StudentEnroll;
use App\TvecExam;
use App\TvecExamResult;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TvecExamResultController extends Controller
{
    private $exam_types = array('T'=>'Theory','P'=>'Practical','B'=>'Theory and Practical');
    private $exam_pass = array('P'=>'Pass','F'=>'Fail','AB'=>'Absent');
    public function postTvecExamsResultsCreate(Request $request){
        $data = array();
        $i=0;
        $tvec_exam = TvecExam::where('id',$request['tvec_exam_id'])->first();
        $number_of_students = 0;
        $number_of_students_pass = 0;

        foreach($request['results'] as $key => $value){
            $isUpdate = false;
            $exams = TvecExamResult::where([['student_id',$key],['attempt',$request['attempts'][$key]],['tvec_exam_id',$request['tvec_exam_id']]])->count();
            if($exams == 1){
                $isUpdate = true;
                $result = TvecExamResult::where([['student_id',$key],['attempt',$request['attempts'][$key]],['tvec_exam_id',$request['tvec_exam_id']]])->first();

            }else{
                $result = new TvecExamResult();
            }
            if($request['results'][$key] == 'P' && $result->result != 'P'){
                $number_of_students_pass++;
            }
            $result->student_id = $key;
            $result->attempt = $request['attempts'][$key];
            $result->result = $request['results'][$key];
            $result->tvec_exam_id = $request['tvec_exam_id'];
            if(!$isUpdate){
                $count = TvecExamResult::where([['student_id',$key],['tvec_exam_id',$request['tvec_exam_id']]])->count();
                if($count<1)
                    $number_of_students++;
                $result->save();
                $message = "Exam Results Successfully Created";
            }else{
                $result->update();
                $message = "Exam Results Successfully Updated";
            }
            $i++;
        }

        $tvec_exam->number_students += $number_of_students;
        $tvec_exam->number_pass += $number_of_students_pass;
        $tvec_exam->update();
        
        return redirect()->back()->with(['message'=>$message]);
    }

    public function getTvecExamsResultsbyBatch($id){
        return null;
    }

    public function getTvecExamsResultsbyStudentId($bid,$id){
        $batch = Batch::where('id',$bid)->first();
        $student = Student::where('id',$id)->first();
        if(!$student){
            return redirect()->route('students');
        }
        if(!$batch){
            return redirect()->route('batches');
        }
        $results = TvecExamResult::leftJoin('tvec_exams','tvec_exams.id','=','tvec_exam_results.tvec_exam_id')
                                    ->select('tvec_exam_results.id','modules.code as module_code','modules.name as module_name',
                                    'tvec_exams.academic_year_id as academic_year_id','tvec_exams.exam_type as exam_type',
                                    'tvec_exam_results.attempt as attempt','tvec_exam_results.result as result','courses.code as course_code','tvec_exams.exam_date as exam_date')
                                    ->leftJoin('modules','modules.id','=','tvec_exams.module_id')
                                    ->leftJoin('courses','courses.id','=','modules.course_id')
                                    ->where([['student_id',$id],['academic_year_id',$batch->academic_year_id],['course_id',$batch->course_id]])
                                    ->orderBy('module_id','asc')
                                    ->orderBy('exam_type','desc')
                                    ->orderBy('attempt','desc')
                                    ->get();
        //return response()->json(['results'=>$results,'student'=>$student],200);
        return view('examination.tvec_student_results',['results'=>$results,'exam_types'=>$this->exam_types,'student'=>$student,'batch'=>$batch,'exam_pass'=>$this->exam_pass]);
    }
}
