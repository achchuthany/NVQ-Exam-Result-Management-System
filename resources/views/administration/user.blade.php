@extends('layouts.master')
@section('title')
Add a User
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-header bg-white">
        <div class="align-items-center row">
            <div class="col">
                <h5 class="mb-0 font-weight-bolder">Add a User</h5>
            </div>
            <div class="text-right col-auto">
                <a type="button" class="btn btn-sm btn-outline-primary shadow-sm" href="{{route('users')}}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
            <form method="post" action="{{route('user.create')}}">
            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" class="form-control" type="text" name="username">
                    </div>
                </div>
                 <div class="col-md-6">
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" type="text" name="password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" class="form-control" type="text" name="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="is_active"><span class="text-danger">*</span> Status</label>
                        <select class="custom-select d-block w-100" id="is_active" name="is_active" required>
                        <option disabled selected >Select Status</option>  
                         <option value ="true">Active</option> 
                        <option value ="false" >Inactive</option> 
                            
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input id="firstname" class="form-control" type="text" name="firstname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input id="lastname" class="form-control" type="text" name="lastname">
                    </div>
                </div>
                <div class="col-12">
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