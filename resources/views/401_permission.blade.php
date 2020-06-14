@extends('layouts.index')
@section('title')
    Online Exam Result Management System
@endsection
@section('content')
    <section id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container ">
                <div class="row text-dark text-center">
                    <div class="form offset-md-2 col-md-8 offset-lg-3 col-lg-6  col-sm-12 px-5">
                        <h1 class="display-2"><i class="fas fa-user-shield"></i></h1>
                      <h1 class="text-uppercase">access not granted</h1>
                        <p><a href="{{ URL::previous() }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
