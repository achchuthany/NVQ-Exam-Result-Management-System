@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="row align-items-center bg-light mx-1">
    <div class="col-md-8">
        <h4 class="pt-2"> Departments</h4>
    </div>
    <div class="col-md-4 ">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">New</button>
        </div>
    </div>
</div>
<div class="row align-items-center mt-2">
    <div class="col-md-12 table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Department Name</th>
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>                    
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    </div>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
</div>
 
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col">
                  <form method="post" action="">
                      <div class="form-group">
                          <label for="d-name">Department Name</label>
                          <input id="d-name" class="form-control" type="text" name="d-name">
                      </div>

                  </form>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

   <!-- Delete Modal -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">    
        <div class="modal-body text-center p-5">
            <h1 class="font-weight-lighter">Are you sure?</h1>
            <h3 class="font-weight-lighter">This process cannot be undone. </h3>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

  

@endsection