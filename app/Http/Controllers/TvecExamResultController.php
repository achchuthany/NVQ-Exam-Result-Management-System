<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Course;
use App\Module;
use App\Student;
use App\StudentEnroll;
use App\TvecExam;
use App\TvecExamResult;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class TvecExamResultController extends Controller
{
    private $exam_types = array('T' => 'Theory', 'P' => 'Practical', 'B' => 'Theory and Practical');
    private $exam_pass = array('P' => 'Pass', 'F' => 'Fail', 'AB' => 'Absent');
    private $semesters = array('1' => 'Semester 1', '2' => 'Semester 2');
    private $exams = array('T' => 'Theory', 'P' => 'Practical');
    public function postTvecExamsResultsCreate(Request $request)
    {
        $data = array();
        $i = 0;
        $tvec_exam = TvecExam::where('id', $request['tvec_exam_id'])->first();
        $number_of_students = 0;
        $number_of_students_pass = 0;

        foreach ($request['results'] as $key => $value) {

            $isUpdate = false;
            $exams = TvecExamResult::where([['student_id', $key], ['attempt', $request['attempts'][$key]], ['tvec_exam_id', $request['tvec_exam_id']]])->count();
            if ($exams == 1) {
                $isUpdate = true;
                $result = TvecExamResult::where([['student_id', $key], ['attempt', $request['attempts'][$key]], ['tvec_exam_id', $request['tvec_exam_id']]])->first();

            } else {
                $result = new TvecExamResult();
            }

            if ($request['results'][$key] == 'P' && $result->result != 'P') {
                $number_of_students_pass++;
            }
            //Sit any previews exam on this module
            $isSiteExam = TvecExamResult::leftjoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
                ->where([['student_id', $key], ['module_id', $tvec_exam->module_id], ['exam_type', $tvec_exam->exam_type]])
                ->first();
            if ($isSiteExam) {
                $academic_year_id = $isSiteExam->academic_year_id;
                $tvec_exam_id = $isSiteExam->tvec_exam_id;
            } else {
                $academic_year_id = $tvec_exam->academic_year_id;
                $tvec_exam_id = $request['tvec_exam_id'];
            }
            //Update Student Enroll Results
            $student_enroll = StudentEnroll::where([['student_id', $key], ['academic_year_id', $academic_year_id]])->first();
            $count = TvecExamResult::where([['student_id', $key], ['tvec_exam_id', $tvec_exam_id]])->count();
            if ($count == 0) {
                $student_enroll->tvec_exam_modules += 1;
            }
            if ($request['results'][$key] == 'P' && $result->result != 'P')
                $student_enroll->tvec_exam_pass += 1;
            $student_enroll->update();


            $result->student_id = $key;
            $result->attempt = $request['attempts'][$key];
            $result->result = $request['results'][$key];
            $result->tvec_exam_id = $request['tvec_exam_id'];
            if (!$isUpdate) {
                $count = TvecExamResult::where([['student_id', $key], ['tvec_exam_id', $request['tvec_exam_id']]])->count();
                if ($count < 1) {
                    $number_of_students++;
                }
                $result->save();
                $message = "Exam Results Successfully Created";
            } else {
                $result->update();
                $message = "Exam Results Successfully Updated";
            }
            $i++;
        }

        $tvec_exam->number_students += $number_of_students;
        $tvec_exam->number_pass += $number_of_students_pass;
        $tvec_exam->update();
        //return response()->json(['result' => $tvec_exam, 'student_enroll' => $isSiteExam,], 200);
        return redirect()->back()->with(['message' => $message]);
    }

    public function getTvecExamsResultsbyBatch($id)
    {
        $batch = Batch::where('id', $id)->first();
        if (!$batch) {
            return redirect()->route('batches');
        }
        $students = Student::select('students.id as id', 'students.shortname', 'students.reg_no', 'student_enrolls.tvec_exam_pass', 'student_enrolls.tvec_exam_modules')->leftjoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id]])
            ->orderBy('student_id', 'asc')
            ->get();
        $exams = TvecExam::select('modules.code as module_code', 'modules.name as module_name',
            'tvec_exams.academic_year_id as academic_year_id', 'tvec_exams.exam_type as exam_type',
            'courses.code as course_code', 'tvec_exams.exam_date as exam_date')
            ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
            ->leftJoin('courses', 'courses.id', '=', 'modules.course_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id]])
            ->orderBy('module_id', 'asc')
            ->orderBy('exam_type', 'desc')
            ->get();
        $results = [];
        foreach ($students as $student) {
            $result = TvecExamResult::select('module_id', 'tvec_exams.exam_type',
                DB::raw('max(tvec_exam_results.attempt) as attempt'),
                DB::raw('max(tvec_exam_results.result) as result'),
                DB::raw('max(modules.name) as module_name'),
                DB::raw('max(modules.code) as module_code'),
                DB::raw('max(tvec_exams.exam_date) as exam_date'))
                ->leftJoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
                ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
                ->leftJoin('academic_years', 'academic_years.id', '=', 'tvec_exams.academic_year_id')
                ->groupBy('module_id')
                ->groupBy('exam_type')
                ->orderBy('module_id', 'asc')
                ->orderBy('exam_type', 'desc')
                ->where([['student_id', $student->id], ['course_id', $batch->course_id]])
                ->get();
            $results[] = $result;
        }
        //return response()->json(['students' => $students, 'results' => $results, 'exams' => $exams,], 200);
        return view('examination.tvec_batch_results', ['students' => $students, 'exams' => $exams, 'results' => $results, 'exam_types' => $this->exam_types, 'batch' => $batch, 'exam_pass' => $this->exam_pass]);


    }
    public function getTvecExamsResultsbyBatchPass($id)
    {
        $batch = Batch::where('id', $id)->first();
        if (!$batch) {
            return redirect()->route('batches');
        }
        $students = Student::select('students.id as id', 'students.shortname', 'students.reg_no', 'student_enrolls.tvec_exam_pass', 'student_enrolls.tvec_exam_modules')
            ->leftjoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id],['student_enrolls.tvec_exam_modules','=',DB::raw('student_enrolls.tvec_exam_pass')]])
            ->orderBy('student_id', 'asc')
            ->get();
        $exams = TvecExam::select('modules.code as module_code', 'modules.name as module_name',
            'tvec_exams.academic_year_id as academic_year_id', 'tvec_exams.exam_type as exam_type',
            'courses.code as course_code', 'tvec_exams.exam_date as exam_date')
            ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
            ->leftJoin('courses', 'courses.id', '=', 'modules.course_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id]])
            ->orderBy('module_id', 'asc')
            ->orderBy('exam_type', 'desc')
            ->get();
        $results = [];
        foreach ($students as $student) {
            $result = TvecExamResult::select('module_id', 'tvec_exams.exam_type',
                DB::raw('max(tvec_exam_results.attempt) as attempt'),
                DB::raw('max(tvec_exam_results.result) as result'),
                DB::raw('max(modules.name) as module_name'),
                DB::raw('max(modules.code) as module_code'),
                DB::raw('max(tvec_exams.exam_date) as exam_date'))
                ->leftJoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
                ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
                ->leftJoin('academic_years', 'academic_years.id', '=', 'tvec_exams.academic_year_id')
                ->groupBy('module_id')
                ->groupBy('exam_type')
                ->orderBy('module_id', 'asc')
                ->orderBy('exam_type', 'desc')
                ->where([['student_id', $student->id], ['course_id', $batch->course_id]])
                ->get();
            $results[] = $result;
        }
        //return response()->json(['students' => $students, 'results' => $results, 'exams' => $exams,], 200);
        return view('examination.tvec_batch_results', ['students' => $students, 'exams' => $exams, 'results' => $results, 'exam_types' => $this->exam_types, 'batch' => $batch, 'exam_pass' => $this->exam_pass]);


    }
    public function getTvecExamsResultsbyBatchPassPDF($id)
    {
        $batch = Batch::where('id', $id)->first();
        if (!$batch) {
            return redirect()->route('batches');
        }
        $students = Student::select('students.id as id', 'students.shortname', 'students.reg_no', 'student_enrolls.tvec_exam_pass', 'student_enrolls.tvec_exam_modules')->leftjoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id],['student_enrolls.tvec_exam_modules','=',DB::raw('student_enrolls.tvec_exam_pass')]])
            ->orderBy('student_id', 'asc')
            ->get();
        $exams = TvecExam::select('modules.code as module_code', 'modules.name as module_name',
            'tvec_exams.academic_year_id as academic_year_id', 'tvec_exams.exam_type as exam_type',
            'courses.code as course_code', 'tvec_exams.exam_date as exam_date')
            ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
            ->leftJoin('courses', 'courses.id', '=', 'modules.course_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id]])
            ->orderBy('module_id', 'asc')
            ->orderBy('exam_type', 'desc')
            ->get();
        $results = [];
        foreach ($students as $student) {
            $result = TvecExamResult::select('module_id', 'tvec_exams.exam_type',
                DB::raw('max(tvec_exam_results.attempt) as attempt'),
                DB::raw('max(tvec_exam_results.result) as result'),
                DB::raw('max(modules.name) as module_name'),
                DB::raw('max(modules.code) as module_code'),
                DB::raw('max(tvec_exams.exam_date) as exam_date'))
                ->leftJoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
                ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
                ->leftJoin('academic_years', 'academic_years.id', '=', 'tvec_exams.academic_year_id')
                ->groupBy('module_id')
                ->groupBy('exam_type')
                ->orderBy('module_id', 'asc')
                ->orderBy('exam_type', 'desc')
                ->where([['student_id', $student->id], ['course_id', $batch->course_id]])
                ->get();
            $results[] = $result;
        }

        $data = ['title' => 'Academic Transcript (Passed Students List)' . $batch->name];
        $pdf = PDF::loadView('examination.tvec_batch_results_pdf', ['students' => $students, 'exams' => $exams, 'results' => $results, 'exam_types' => $this->exam_types, 'batch' => $batch, 'exam_pass' => $this->exam_pass])->setPaper('a4', 'landscape');
        return $pdf->download('TVEC-Transcript-'.$batch->name ."-".$batch->course_id. '.pdf');
        //return response()->json(['students' => $students, 'results' => $results, 'exams' => $exams,], 200);
        //return view('examination.tvec_batch_results_pdf', ['students' => $students, 'exams' => $exams, 'results' => $results, 'exam_types' => $this->exam_types, 'batch' => $batch, 'exam_pass' => $this->exam_pass]);

    }
    public function getTvecExamsResultsbyBatchPDF($id)
    {
        $batch = Batch::where('id', $id)->first();
        if (!$batch) {
            return redirect()->route('batches');
        }
        $students = Student::select('students.id as id', 'students.shortname', 'students.reg_no', 'student_enrolls.tvec_exam_pass', 'student_enrolls.tvec_exam_modules')->leftjoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id]])
            ->orderBy('student_id', 'asc')
            ->get();
        $exams = TvecExam::select('modules.code as module_code', 'modules.name as module_name',
            'tvec_exams.academic_year_id as academic_year_id', 'tvec_exams.exam_type as exam_type',
            'courses.code as course_code', 'tvec_exams.exam_date as exam_date')
            ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
            ->leftJoin('courses', 'courses.id', '=', 'modules.course_id')
            ->where([['academic_year_id', $batch->academic_year_id], ['course_id', $batch->course_id]])
            ->orderBy('module_id', 'asc')
            ->orderBy('exam_type', 'desc')
            ->get();
        $results = [];
        foreach ($students as $student) {
            $result = TvecExamResult::select('module_id', 'tvec_exams.exam_type',
                DB::raw('max(tvec_exam_results.attempt) as attempt'),
                DB::raw('max(tvec_exam_results.result) as result'),
                DB::raw('max(modules.name) as module_name'),
                DB::raw('max(modules.code) as module_code'),
                DB::raw('max(tvec_exams.exam_date) as exam_date'))
                ->leftJoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
                ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
                ->leftJoin('academic_years', 'academic_years.id', '=', 'tvec_exams.academic_year_id')
                ->groupBy('module_id')
                ->groupBy('exam_type')
                ->orderBy('module_id', 'asc')
                ->orderBy('exam_type', 'desc')
                ->where([['student_id', $student->id], ['course_id', $batch->course_id]])
                ->get();
            $results[] = $result;
        }

        $data = ['title' => 'Academic Transcript' . $batch->name];
        $pdf = PDF::loadView('examination.tvec_batch_results_pdf', ['students' => $students, 'exams' => $exams, 'results' => $results, 'exam_types' => $this->exam_types, 'batch' => $batch, 'exam_pass' => $this->exam_pass])->setPaper('a4', 'landscape');
        return $pdf->download('TVEC-Transcript-'.$batch->name ."-".$batch->course_id. '.pdf');
        //return response()->json(['students' => $students, 'results' => $results, 'exams' => $exams,], 200);
        //return view('examination.tvec_batch_results_pdf', ['students' => $students, 'exams' => $exams, 'results' => $results, 'exam_types' => $this->exam_types, 'batch' => $batch, 'exam_pass' => $this->exam_pass]);

    }

    public function getTvecExamsResultsbyStudentId($bid, $id)
    {
        $batch = Batch::where('id', $bid)->first();
        $student = Student::where('id', $id)->first();
        if (!$student) {
            return redirect()->route('students');
        }
        if (!$batch) {
            return redirect()->route('batches');
        }
        $results = TvecExamResult::select('module_id', 'tvec_exams.exam_type',
            DB::raw('max(tvec_exam_results.attempt) as attempt'),
            DB::raw('max(tvec_exam_results.result) as result'),
            DB::raw('max(modules.name) as module_name'),
            DB::raw('max(modules.code) as module_code'),
            DB::raw('max(tvec_exams.exam_date) as exam_date'))
            ->leftJoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
            ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
            ->leftJoin('academic_years', 'academic_years.id', '=', 'tvec_exams.academic_year_id')
            ->groupBy('module_id')
            ->groupBy('exam_type')
            ->orderBy('module_id', 'asc')
            ->orderBy('exam_type', 'desc')
            ->where([['student_id', $student->id], ['course_id', $batch->course_id]])
            ->get();
        //return response()->json(['results'=>$results,'student'=>$student],200);
        return view('examination.tvec_student_results', ['results' => $results, 'exam_types' => $this->exam_types, 'student' => $student, 'batch' => $batch, 'exam_pass' => $this->exam_pass]);
    }

    public function getTvecResults()
    {
        $courses = Course::orderBy('name', 'asc')->get();
        return view('examination.tvec_results', ['courses' => $courses]);
    }

    public function postTvecExamsResultsbyBatch(Request $request)
    {
        $this->validate($request, ['batch_id' => 'required']);
        $id = $request['batch_id'];
        return redirect()->route('tvec.exams.results.batch', ['id' => $id]);
    }

    public function getStudentExamsIndex()
    {
        $student_id = Auth::user()->profile_id;

        if (!$student_id) {
            return redirect()->back()->with(['warning' => 'Student ID is invalid. Try again!']);
        }

        $enrolls = StudentEnroll::where('student_id', $student_id)->get();

        $results = [];
        $batches = [];
        foreach ($enrolls as $enroll) {
            $batch = Batch::where([['course_id', $enroll->course_id], ['academic_year_id', $enroll->academic_year_id]])->first();
            if (!$batch) {
                return redirect()->back()->with(['warning' => 'Invalid Batch Name. Try again.']);
            }
            $batches[] = $batch;
            $result = TvecExamResult::select('module_id', 'tvec_exams.exam_type',
                DB::raw('max(tvec_exam_results.attempt) as attempt'),
                DB::raw('max(tvec_exam_results.result) as result'),
                DB::raw('max(modules.name) as module_name'),
                DB::raw('max(modules.code) as module_code'),
                DB::raw('max(academic_years.id) as academic_year_id'))
                ->leftJoin('tvec_exams', 'tvec_exams.id', '=', 'tvec_exam_results.tvec_exam_id')
                ->leftJoin('modules', 'modules.id', '=', 'tvec_exams.module_id')
                ->leftJoin('academic_years', 'academic_years.id', '=', 'tvec_exams.academic_year_id')
                ->groupBy('module_id')
                ->groupBy('exam_type')
                ->orderBy('module_id', 'asc')
                ->orderBy('exam_type', 'desc')
                ->where([['student_id', $student_id],['course_id', $batch->course_id]])
                ->get();
            $results[] = $result;
        }
        //return response()->json(['results'=>$results],200);
        return view('examination.student_tvec_results', ['results' => $results, 'exam_types' => $this->exam_types, 'exam_results' => $this->exam_pass,'batches'=>$batches]);

    }
    public function getLecturerTvecExamsResult($id){
        $tvecexam = TvecExam::select('tvec_exams.id as id', 'tvec_exams.module_id as module_id', 'tvec_exams.academic_year_id as academic_year_id',
            'tvec_exams.number_pass as number_pass', 'tvec_exams.number_students as number_students',
            'tvec_exams.exam_type as exam_type', 'tvec_exams.exam_date as exam_date', 'tvec_exams.exam_time as exam_time', 'modules.course_id as course_id')->where('tvec_exams.id', $id)->leftjoin('modules', 'modules.id', '=', 'tvec_exams.module_id')->first();
        $batch = Batch::where([['academic_year_id', $tvecexam->academic_year_id], ['course_id', $tvecexam->course_id]])->first();
        $students = TvecExamResult::leftJoin('students', 'students.id', '=', 'tvec_exam_results.student_id')
            ->select('student_id as id', "reg_no", "shortname", "attempt", "result")
            ->distinct(['student_id', 'attempt'])
            ->where([['tvec_exam_id', $id]])
            ->orderBy('reg_no', 'asc')
            ->orderBy('attempt', 'desc')
            ->get();
        //return response()->json(['tvecexam'=>$tvecexam,'student'=>$batch],200);
        return view('examination.tvec_exam_results_view', ['students' => $students, 'tvecexam' => $tvecexam, 'exam_pass' => $this->exam_pass, 'semesters' => $this->semesters,'exams' => $this->exams, 'batch' => $batch]);

    }
}
