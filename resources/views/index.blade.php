@extends('layouts.index')
@section('title')
    Online Exam Result Management System
@endsection
@section('content')
    <section id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container">
                <div class="row text-dark text-center">
                    <div class="form offset-md-2 col-md-8 offset-lg-3 col-lg-6  col-sm-12 px-5">
                        <h4 class="text-dark">Online Exam Result Management System</h4>
                        <p class="py-2 text-secondary">Welcome to the examination results publishing eService offered by SLGTI. Results of all the examinations* conducted by SLGTI are published thorough this service.</p>
                        <form method="POST" action="{{ route('indexResult') }}">
                            <div class="form-group ">
                                <div class="btn-group" role="group" aria-label="NIC">
                                    <input type="text" class="form-control " id="nic" name="nic" placeholder="Enter your NIC Number" required>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                                {{ csrf_field() }}
                            </div>
                        </form>
                        <p class="text-secondary">*only for SLGTI students</p>
                        <p><a href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> Sign In</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
