@extends('layouts.master')
@section('title')
Employees Enrolled Modules
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-md-6 col-xs-12">
    <h4 class="pt-2"> Employees Enrolled Modules <span class="badge badge-dark">{{$academic_year->name}}</span></h4>
    </div>
    <div class="col-md-6 col-xs-12">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-secondary" href="{{route('employees.enroll')}}">All</a>
        <a type="button" class="btn btn-sm btn-primary" href="{{route('employees.enroll.create')}}"><i class="fas fa-user-plus"></i> Enroll</a>
        
      </div>
      <form method="post" action="{{route('employees.search')}}">
        <div class="btn-group float-right mr-2" role="group">      
          <input type="text" name="fullname" class="form-control form-control-sm" placeholder="Full name">
          <button type="submit" class="btn btn-sm btn-secondary">Search</button>
          <input type="hidden" name="_token" value="{{Session::token()}}">      
        </div>
      </form>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-hover table-borderless bg-gradient-light rounded-lg shadow-sm">
            <thead class="bg-gradient-info">
              <tr>
                <th scope="col">EPF No.</th>
                <th scope="col">Name</th>
                <th scope="col">Enrolled Modules</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              
              @foreach( $employees as $employee)
            <tr data-did="{{$employee->id}}">
                <th scope="row">{{$employee->epf}}</th>
                <td>{{$employee->fullname}}</td>
                <td>
                    @foreach($employee->teachModulesActive($employee->id) as $module)
                    <div class="btn-group btn-group-sm" role="group">
                      <button type="button" class="btn btn-primary employee_enroll_edit">{{$module->name}}</button>
                      <a  class="btn btn-danger " href="{{route('employees.enroll.delete',['id'=>$module->id])}}"><i class="fas fa-minus-circle" ></i></a>
                    </div>

                    {{-- <span class="badge bg-gradient-white p-2" data-toggle="tooltip" data-placement="top" title="{{$module->code}}">{{$module->name}}</span><span class="bg-gradient-danger">X</span> --}}
                    @endforeach
                </td>
                <td>                    
                    <div class="btn-group" role="group">
                    <a type="button" class="btn btn-sm btn-dark" href="{{route('employee.profile',['id'=>$employee->id])}}"><i class="fas fa-user-circle"></i> Profile</a>
                    </div>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          <nav>
            <ul class="pagination pagination-sm justify-content-end">
              <li class="page-item">
                <span class="page-link">
                Showing {{$employees->firstItem()}} to {{$employees->lastItem()}} of  {{$employees->total()}} entries
                </span>
              </li>
              <p>
              {{ $employees->links() }}
              </p>
            </ul>
          </nav>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="employee_enroll_edit_modal" tabindex="-1" role="dialog" aria-labelledby="employee_enroll_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-gradient-light">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="employee_enroll_modal">Enrolled Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col">
                <form method="post" action="">
                  <div class="form-group">
                    <label for="code">Department Code</label>
                    <input id="code" class="form-control" type="text" name="code" maxlength="3">
                    </div>
                    <div class="form-group">
                        <label for="d_name">Department Name</label>
                        <input id="d_name" class="form-control" type="text" name="d_name" maxlength="255">
                    </div>

                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="department_save" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('employees.enroll.create') }}';
  </script>
@endsection