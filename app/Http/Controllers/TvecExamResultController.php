<?php

namespace App\Http\Controllers;

use App\TvecExam;
use App\TvecExamResult;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TvecExamResultController extends Controller
{
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
}
