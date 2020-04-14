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
        <a type="button" class="btn btn-sm btn-primary" href="{{route('employees.enroll.create')}}">Enroll</a>
        
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
        <table class="table table-hover">
            <thead>
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
                    <span class="badge badge-light p-2" data-toggle="tooltip" data-placement="top" title="{{$module->code}}">{{$module->name}}</span>
                    @endforeach
                </td>
                <td>                    
                    <div class="btn-group" role="group">
                    <a type="button" class="btn btn-sm btn-primary" href="{{route('employee.profile',['id'=>$employee->id])}}">Profile</a>
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
 
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('departments.edit') }}';
  </script>
@endsection