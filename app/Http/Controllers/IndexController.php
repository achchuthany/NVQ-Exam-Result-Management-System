<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Student;
use App\StudentEnroll;
use App\TvecExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private $exam_types = array('T' => 'Theory', 'P' => 'Practical', 'B' => 'Theory and Practical');
    private $exam_pass = array('P' => 'Pass', 'F' => 'Fail', 'AB' => 'Absent');

    public function getIndex()
    {
        return view('index');
    }

    public function getIndexData(Request $request)
    {
        $this->validate($request, [
            'nic' => 'required|min:10|max:12',
        ]);
        $student = Student::where('nic', $request['nic'])->first();




        if (!$student) {
            return redirect()->route('index')->with(['warning'=>'Invalid NIC number. Please check your NIC number and try again.']);
        }
        $student_id = $student->id;
        $enrolls = StudentEnroll::where('student_id',$student_id)->get();

        foreach ($enrolls as $enroll) {
            $batch = Batch::where([['course_id',$enroll->course_id],['academic_year_id',$enroll->academic_year_id]])->first();
            if (!$batch) {
                return redirect()->route('index')->with(['warning'=>'Invalid Batch Name. Try again.']);
            }

            $results = TvecExamResult::leftJoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
                ->select('tvec_exam_results.id', 'modules.code as module_code', 'modules.name as module_name',
                    'tvec_exams.academic_year_id as academic_year_id', 'tvec_exams.exam_type as exam_type',
                    'tvec_exam_results.attempt as attempt', 'tvec_exam_results.result as result', 'courses.code as course_code', 'tvec_exams.exam_date as exam_date')
                ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
                ->leftJoin('courses', 'courses.id', '=', 'modules.course_id')
                ->where([['student_id', $student_id], ['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id]])
                ->orderBy('module_id', 'asc')
                ->orderBy('exam_type', 'desc')
                ->orderBy('attempt', 'desc')
                ->get();
        }
        //return response()->json(['results'=>$results,'student'=>$student],200);
        return view('examination.tvec_student_results', ['results' => $results, 'exam_types' => $this->exam_types, 'student' => $student, 'batch' => $batch, 'exam_pass' => $this->exam_pass]);
        //return view('result');
    }

}
