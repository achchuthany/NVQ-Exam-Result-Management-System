<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Batch;
use App\Course;
use App\Module;
use App\Student;
use App\StudentEnroll;
use App\TvecExam;
use App\TvecExamResult;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TvecExamController extends Controller
{
    private $semesters = array('1'=>'Semester 1','2'=>'Semester 2');
    private $exams = array('T'=>'Theory','P'=>'Practical');
  
    public function getTvecExams(){

        $tvecexams = TvecExam::orderBy('id','desc')->paginate(20);
        return view('examination.tvec_exams',['tvecexams' =>$tvecexams,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function getTvecExamsResults($id){
        $tvecexam = TvecExam::where('id',$id)->first();
        $batch = Batch::where('id',$tvecexam->academic_year->batches[0]->id)->first();
        $students = TvecExamResult::leftJoin('students', 'students.id', '=', 'tvec_exam_results.student_id')
                    ->select('student_id as id',"reg_no","shortname","attempt","result")
                    ->distinct(['student_id','attempt'])
                    ->where([['tvec_exam_id',$id]])
                    ->orderBy('student_id','asc')
                    ->orderBy('attempt','desc')
                    ->get();
        return view('examination.tvec_exam_results',['students'=>$students,'tvecexam' =>$tvecexam,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function getTvecExamCreate(){
        $courses = Course::orderBy('name','asc')->get();
        $academicyears = AcademicYear::orderBy('name','desc')->paginate(20);
        return view('examination.tvec_exam',['academicyears'=>$academicyears,'courses' =>$courses,'semesters'=>$this->semesters,'exams'=>$this->exams]);
    }
    public function postTvecExamCreate(Request $request){
        $this->validate($request,[
            'modules'=>'required',
            'academic_year_id'=>'required',
            'exam_type' => 'required',
            'exam_date'=>'required|date',
            'exam_time'=>'required'
            ]);
        $module = Module::find($request['modules']);
        if(!$module){
            return null;
        }
        $ay = AcademicYear::find($request['academic_year_id']);
        if(!$ay){
            return null;
        }
        $te = new TvecExam();
        $te->module_id = $request['modules'];
        $te->academic_year_id = $request['academic_year_id'];
        $te->exam_type = $request['exam_type'];
        $te->exam_date = $request['exam_date'];
        $te->exam_time = $request['exam_time'];
        $message = 'There was an error';
        if($te->save()){
           $message = 'TVEC Exam successfully created';
        }
        return redirect()->route('tvec.exams')->with(['message'=>$message]);
    }
    public function getDeleteTvecExam($id){
        $post = TvecExam::where('id',$id)->first();
        try {
            $result = $post->delete();
            $message = "Module Successfully Deleted!";
        } catch (QueryException  $e) {       
            $message = "Module was not Deleted, Try Again!";
        }
        return redirect()->route('tvec.exams')->with(['message'=>$message]);
    }
}
