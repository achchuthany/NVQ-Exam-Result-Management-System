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
        <a type="button" class="btn btn-sm btn-secondary" href="{{route('users')}}">All</a>
        <a type="button" class="btn btn-sm btn-primary" href="{{route('user.index')}}">New</a>     
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
              <th scope="col">Username</th>
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
              {{Auth::user()}}
              @foreach( $users as $user)
            <form method="post" action="{{route('user.roles')}}">
            <tr data-id="{{$user->id}}">
                <th scope="row">{{$user->username}}</th>
                 <td>{{$user->firstname}} </td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->email}}</td>
                @foreach($roles as $role)             
                  <td>
                    <input type="checkbox" class="form-check-input" name="{{$role->name}}" {{$role->name == 'Student' && !$user->hasRole("Student") ? 'disabled' : '' }} {{$user->hasRole("Student") ? 'disabled' : '' }} {{ $user->hasRole($role->name) ? 'checked' : '' }} {{($user->username=='admin')?'disabled':''}}>
                    <label class="form-control-label">{{$role->name}}</label>       
                </td>
                  
                @endforeach

                <td>                    
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-sm btn-primary" {{($user->username=='admin' || $user->hasRole("Student"))?'disabled':''}}>Assign Role(s)</button>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <input type="hidden" name="email" value="{{$user->email}}">
                    </div>
                </td>
              </tr>
              </form>
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