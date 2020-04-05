<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $districts  = array('Ampara','Anuradhapura','Badulla','Batticaloa','Colombo','Galle','Gampaha','Hambantota','Jaffna','Kalutara','Kandy','Kegalle','Kilinochchi','Kurunegala','Mannar','Matale','Matara','Monaragala','Mullaitivu','Nuwara Eliya','Polonnaruwa','Puttalam','Ratnapura','Trincomalee','Vavuniya');
    private $statuses = array('Working', 'Terminated','Resignmed','Long Absent','Study Leave');
    private $modes = array('Permanent', 'On Contract','Visiting');
    private $provinces = array('Central','Eastern','North Central','North Western','Northern','Sabaragamuwa','Southern','Uva','Western');
    private $positions = array('Director','Deputy Principal (Academics)','Deputy Principal (Industrial)','Registrar','Accountant','Head of Department','Senior Lecturer Gr-I','Senior Lecturer Gr-II','Lecturer Gr-I', 'Lecturer Gr-II', 'Instructor Gr-I', 'Instructor Gr-II', 'Instructor Gr-III' , 'Human Resource Officer', 'Management Assistant Gr-II', 'Warden' ,'Librarian' ); 
    public function getEmployees(){
        $employees = Employee::orderBy('fullname','asc')->paginate(30);
        return view('employee.employees',['employees'=>$employees]);
    }
    public function getEmployeeCreate(){
        $departments = Department::orderBy('name','asc')->get();
        return view('employee.employee',['provinces'=>$this->provinces,'statuses'=>$this->statuses,'modes'=>$this->modes,'districts'=>$this->districts,'departments'=>$departments,'positions'=>$this->positions]);
    }
    public function postSearchEmployee(Request $request){
        $this->validate($request,['fullname'=>'required']);

        $employees = Employee::where('fullname','Like','%'.$request['fullname'].'%')
                                -> orderBy('fullname','asc')->paginate(30);
        // return redirect()->route('employees')->with(['employees'=>$employees]);
        return view('employee.employees',['employees'=>$employees]);
    }
    public function postCreateEmployee(Request $request){
        $this->validate($request,[
            'department_id'=>'required',
            'fullname'=>'required',
            'shortname'=>'required',
            'gender'=>'required',
            'epf'=>'required|unique:employees',
            'email'=>'required|unique:employees',
            'nic'=>'required|unique:employees',
            'phone'=>'required',
            'position_type'=>'required',
            'date_birth'=>'required',
            'date_join'=>'required',
            'position'=>'required',
            'status'=>'required'
            ]);
        $Course = Department::find($request['department_id']);
        if(!$Course){
            return null;
        }
        $employee = new Employee();
        $employee->fullname = $request['fullname'];
        $employee->shortname = $request['shortname'];
        $employee->department_id = $request['department_id'];
        $employee->gender = $request['gender'];
        $employee->epf = $request['epf'];
        $employee->date_birth = $request['date_birth'];
        $employee->position_type = $request['position_type'];
        $employee->date_join = $request['date_join'];
        $employee->position = $request['position'];
        $employee->email = $request['email'];
        $employee->nic = $request['nic'];
        $employee->status = $request['status'];
        $employee->phone = $request['phone'];
        $message = 'There was an error';
        if($employee->save()){
           $message = 'Staffs  successfully created';
        }
        return redirect()->route('employees')->with(['message'=>$message]);
    }
}
