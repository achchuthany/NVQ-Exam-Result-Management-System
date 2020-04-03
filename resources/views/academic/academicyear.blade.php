@extends('layouts.master')
@section('title')
Create a Academic Year
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2">Create a Academic Year</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-dark" href="{{route('academics')}}">Back</a>
        </div>
    </div>
</div>
<form method="post" action="{{route('academics.create')}}">
<div class="row align-items-center mt-2">

            <div class="form-group col-md-6">
                <label for="name">Academic Year Name</label>
                <input id="name" class="form-control" type="text" name="name" placeholder="2016/2017" pattern="[0-9]{4}/[0-9]{4}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="status">Status</label>
                <input id="status" class="form-control" type="text" name="status" required>
            </div>
            <div class="form-group col-md-6">
                <label for="start">Start Date</label>
                <input id="start" class="form-control" type="date" name="start" required>
            </div>
            <div class="form-group col-md-6">
                <label for="end">End Date</label>
                <input id="end" class="form-control" type="date" name="end" required>
            </div>
            <div class="form-group col-md-12">
               <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
              <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>

</div>
</form>
@endsection