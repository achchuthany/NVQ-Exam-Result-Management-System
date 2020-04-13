@extends('layouts.master')
@section('title')
List of Users
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-md-4 col-xs-12">
    <h4 class="pt-2"> List of Users </div>
    <div class="col-md-8 col-xs-12">
      <div class="btn-group float-right" role="group" aria-label="Basic example">
        <a type="button" class="btn btn-sm btn-secondary" href="{{route('employees')}}">All</a>
        <a type="button" class="btn btn-sm btn-primary" href="{{route('employees.create')}}">New</a>     
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
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                @foreach($roles as $role)
                    <th scope="col">{{$role->name}}</th>
                @endforeach
                <th scope="col">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody>
              
              @foreach( $users as $user)
            <tr data-id="{{$user->id}}">
                <th scope="row">{{$user->first_name}}</th>
                <td>{{$user->last_name}}</td>
                <td>{{$user->email}}</td>
                @foreach($roles as $role)
                <td>
                
                    <input type="checkbox" class="form-check-input" name="{{$role->name}}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                    <label class="form-control-label">{{$role->name}}</label>
                 
                </td>
                @endforeach

                <td>                    
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-warning department-edit">Edit</button>
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
                Showing {{$users->firstItem()}} to {{$users->lastItem()}} of  {{$users->total()}} entries
                </span>
              </li>
              <p>
              {{ $users->links() }}
              </p>
            </ul>
          </nav>
    </div>
</div>
@endsection