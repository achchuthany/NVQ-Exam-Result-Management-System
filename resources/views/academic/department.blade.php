@extends('layouts.master')
@section('title')
    Add a Department
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Add a Department</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('departments')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('departments.create')}}">
            <div class="row align-items-center mt-2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="code">Department Code</label>
                        <input id="code" class="form-control" type="text" name="code" maxlength="3">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="d_name">Department Name</label>
                        <input id="d_name" class="form-control" type="text" name="d_name" maxlength="255">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection