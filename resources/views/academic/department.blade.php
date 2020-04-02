@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Create a Department</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('departments')}}">Back</a>
        </div>
    </div>
</div>

    
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


@endsection