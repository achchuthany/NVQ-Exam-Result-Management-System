@extends('layouts.master')
@section('title')
    Change Password
@endsection
@section('content')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder">Change Password</h5>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-center">
                <div class="col-md-8 col-md-offset-2">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">

                        <div class="form-group row">
                            <label for="new-password" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="uname" type="text" class="form-control"  name="uname" value="{{Auth::user()->username}}"  disabled>
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Current Password</label>

                            <div class="col-md-6">
                                <input id="current-password" type="password" class="form-control"
                                       name="current-password"
                                       required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password"
                                       required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New
                                Password</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control"
                                       name="new-password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary float-right">
                                    Change Password
                                </button>
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
