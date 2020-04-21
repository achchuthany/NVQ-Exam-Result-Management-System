@extends('layouts.master')
@section('title')
    Academic Years
@endsection
@section('content')
<div class="card mb-3">
  <div class="card-header bg-white">
    <div class="align-items-center row">
      <div class="col">
        <h5 class="mb-0 font-weight-bolder">Academic Years </h5>
      </div>
      <div class="text-right col-auto">
      <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('academics.create')}}">New</a>
      </div>
    </div>
  </div>
  <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
              <tr>
                <tr>
                <th scope="col" class="pl-4">Name</th>
                <th scope="col">Start Date</th>
                <th scope="col">Completion Date</th>
                <th scope="col">Status</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
              </tr>
            </thead>
            <tbody>
               @foreach( $academicyears as $academicyear)
              <tr data-aid="{{$academicyear->id}}">
                <th class="pl-4">{{$academicyear->name}}</th>
                <td>{{date('d-M-Y', strtotime($academicyear->start))}}</td>
                <td>{{date('d-M-Y', strtotime($academicyear->end))}}</td>
                <td>
                <span class="{{($academicyear->status=='Active')? 'text-primary' : (($academicyear->status=='Planning')? 'text-dark':'text-secondary') }}"><i class="fas fa-check-circle"></i></span> {{$academicyear->status}}
                </td>
                <td> 
                  <div class="dropdown dropleft">
                  <button class="btn btn-light btn-sm shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ route('students.academic',['id'=>$academicyear->id]) }}">Students</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('academics.edit',['id'=>$academicyear->id]) }}">Edit</a>
                  <a class="dropdown-item text-danger" href="{{ route('academics.delete',['id'=>$academicyear->id]) }}">Delete</a>
                  </div>
                  </div>                   
                </td>
              </tr>
              @endforeach          
            </tbody>
          </table>
    </div>
  </div>
  <div class="card-footer bg-white">
  <div class="pt-1 no-gutters row">
    <div class="col">
     <span>{{$academicyears->firstItem()}} to {{$academicyears->lastItem()}} of  {{$academicyears->total()}}</span>
    </div>
    <div class="col-auto">
      {{ $academicyears->links() }}
    </div>
  </div>
  </div>
</div>
@endsection