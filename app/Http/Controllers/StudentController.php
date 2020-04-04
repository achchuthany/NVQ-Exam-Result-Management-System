<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Batch;
use App\Course;
use App\Student;
use App\StudentEnroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    private $districts  = array('Ampara','Anuradhapura','Badulla','Batticaloa','Colombo','Galle','Gampaha','Hambantota','Jaffna','Kalutara','Kandy','Kegalle','Kilinochchi','Kurunegala','Mannar','Matale','Matara','Monaragala','Mullaitivu','Nuwara Eliya','Polonnaruwa','Puttalam','Ratnapura','Trincomalee','Vavuniya');
    private $statuses = array('Following', 'Completed','Droupout','Long Absent');
    private $modes = array('Full Time', 'Part Time','Short Time');
    private $provinces = array('Central','Eastern','North Central','North Western','Northern','Sabaragamuwa','Southern','Uva','Western');
    public function getStudents(){
        $students = Student::orderBy('reg_no','asc')->paginate(30);
        return view('student.students',['students'=>$students]);
    }
    public function getStudentsbyBatch($id){
        $batch = Batch::where('id',$id)->first();
        $students = Student::leftJoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
                    ->select('student_id as id',"reg_no","title","fullname","shortname","gender","civil_status","email","nic","date_birth","phone","address","zip","district","divisional","province","blood","emergency_name","emergency_address","emergency_phone","emergency_relationship")
                    ->where([['course_id',$batch->course_id],['academic_year_id',$batch->academic_year_id]])
                    ->paginate(30);
        return view('student.students',['students'=>$students]);
    }
    public function getStudentsbyCourse($id){
        $students = Student::leftJoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
                    ->select('student_id as id',"reg_no","title","fullname","shortname","gender","civil_status","email","nic","date_birth","phone","address","zip","district","divisional","province","blood","emergency_name","emergency_address","emergency_phone","emergency_relationship")
                    ->where('course_id',$id)
                    ->paginate(30);
        return view('student.students',['students'=>$students]);
    }
    public function getStudentsbyAcademicYear($id){
        $batch = Batch::where('id',$id)->first();
        $students = Student::leftJoin('student_enrolls', 'students.id', '=', 'student_enrolls.student_id')
                    ->select('student_id as id',"reg_no","title","fullname","shortname","gender","civil_status","email","nic","date_birth","phone","address","zip","district","divisional","province","blood","emergency_name","emergency_address","emergency_phone","emergency_relationship")
                    ->where('academic_year_id',$id)
                    ->paginate(30);
        return view('student.students',['students'=>$students]);
    }

    public function getStudentCreate(){
        $courses = Course::orderBy('name','asc')->get();
        $academicyears = AcademicYear::orderBy('name','desc')->get();

        return view('student.student',['provinces'=>$this->provinces,'statuses'=>$this->statuses,'modes'=>$this->modes,'districts'=>$this->districts,'courses'=>$courses,'academicyears'=>$academicyears]);
    }

    public function postCreateStudent(Request $request){
        $this->validate($request,[
            'reg_no'=>'required|unique:students',
            'fullname'=>'required',
            'shortname'=>'required',
            'gender'=>'required',
            'email'=>'required|unique:students',
            'nic'=>'required|unique:students',
            'date_birth'=>'required',
            'phone'=>'required',
            'academic_year_id'=>'required',
            'course_id'=>'required',
            'course_mode'=>'required',
            'enroll_date'=>'required',
            'status'=>'required'
            ]);
        $Course = Course::find($request['course_id']);
        if(!$Course){
            return null;
        }
        $AcademicYear = AcademicYear::find($request['academic_year_id']);
        if(!$AcademicYear){
            return null;
        }
        $student = new Student();
        $student->fullname = $request['fullname'];
        $student->reg_no = $request['reg_no'];
        $student->shortname = $request['shortname'];
        $student->gender = $request['gender'];
        $student->email = $request['email'];
        $student->nic = $request['nic'];
        $student->date_birth = $request['date_birth'];
        $student->phone = $request['phone'];
        $message = 'There was an error';
        if($student->save()){
            $enroll = new StudentEnroll();
            $enroll->academic_year_id = $request['academic_year_id'];
            $enroll->course_id = $request['course_id'];
            $enroll->course_mode = $request['course_mode'];
            $enroll->enroll_date = $request['enroll_date'];
            $enroll->status = $request['status'];
            $enroll->student_id = $student->id;
            $enroll->save();
           $message = 'Student  successfully created';
        }
        return redirect()->route('students')->with(['message'=>$message]);
    }
}
