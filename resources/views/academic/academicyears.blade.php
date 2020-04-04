@extends('layouts.master')
@section('title')
    Academic Years
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Academic Years </h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-primary" href="{{route('academics.create')}}">New</a>
        </div>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-12 table-responsive">
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Start Date</th>
                <th scope="col">Completion Date</th>
                <th scope="col">Status</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach( $academicyears as $academicyear)
              <tr>
              <th scope="row">{{$academicyear->id}}</th>
                <td>{{$academicyear->name}}</td>
                <td>{{$academicyear->start}}</td>
                <td>{{$academicyear->end}}</td>
                <td>{{$academicyear->status}}</td>
                <td>                    
                    <div class="btn-group" role="group">
                      <a type="button" class="btn btn-sm btn-secondary" href="{{ route('students.academic',['id'=>$academicyear->id]) }}">Students</a>
                        <button type="button" class="btn btn-sm btn-warning nvq-edit">Edit</button>
                        <a type="button" class="btn btn-sm btn-danger" href="{{ route('academics.delete',['id'=>$academicyear->id]) }}">Delete</a>
                    </div>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
    </div>
</div>
 
  <!-- Modal -->
  <div class="modal fade" id="nvqEditModal" tabindex="-1" role="dialog" aria-labelledby="nvqEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nvqEditModal">NVQ Level</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col">
                  <form method="post" action="">
                      <div class="form-group">
                          <label for="n_name">NVQ Level Name</label>
                          <input id="n_name" class="form-control" type="text" name="n_name">
                      </div>

                  </form>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="nvq_save" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

@include('includes.deletemodal')
  
  <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('academics.edit') }}';
  </script>
@endsection