@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
</ol>
</nav>
<div class="row align-items-center">
    <div class="col-md-12">
        <div class="card-group">
            <div class="card shadow-sm mr-3" >
                <div class="card-body">
                  <h5 class="card-title">Students</h5>
                  <p class="card-text display-4">1522</p>
                </div>
            </div>
            <div class="card shadow-sm mr-3">
                <div class="card-body">
                  <h5 class="card-title">Teachers</h5>
                  <p class="card-text display-4">25</p>
                </div>
            </div>
            <div class="card shadow-sm mr-3">
                <div class="card-body">
                  <h5 class="card-title">Courses</h5>
                  <p class="card-text display-4">30</p>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Staff</h5>
                  <p class="card-text display-4">36</p>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection