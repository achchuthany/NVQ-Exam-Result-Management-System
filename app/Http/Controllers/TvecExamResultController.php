<?php

namespace App\Http\Controllers;

use App\TvecExamResult;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TvecExamResultController extends Controller
{
    public function postTvecExamsResultsCreate(Request $request){
        $data = array();
        $i=0;
        foreach($request['results'] as $key => $value){
            $isUpdate = false;
            $exams = TvecExamResult::where([['student_id',$key],['attempt',$request['attempts'][$key]],['tvec_exam_id',$request['tvec_exam_id']]])->count();
            if($exams == 1){
                $isUpdate = true;
                $result = TvecExamResult::where([['student_id',$key],['attempt',$request['attempts'][$key]],['tvec_exam_id',$request['tvec_exam_id']]])->first();

            }else{
                $result = new TvecExamResult();
            }

            $result->student_id = $key;
            $result->attempt = $request['attempts'][$key];
            $result->result = $request['results'][$key];
            $result->tvec_exam_id = $request['tvec_exam_id'];

            if(!$isUpdate){
                $result->save();
                $message = "Exam Results Successfully Created";
            }else{
                $result->update();
                $message = "Exam Results Successfully Updated";
            }
            $i++;
           
        }
        
        return redirect()->back()->with(['message'=>$message]);
    }
}
