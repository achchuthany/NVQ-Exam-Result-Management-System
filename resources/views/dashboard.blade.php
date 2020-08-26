@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card-deck">
            <div class="card border-bottom border-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Students</h5>
                            <p class="card-text h2">{{$no_students}}</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4 text-primary">
                            <i class="fas fa-user-graduate" ></i>
                            </p>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Completed </p>
                        </div>
                        <div class="col-6">
                            <p> {{$no_students_completed}} <span class="text-success">({{($no_students>0)? round(($no_students_completed/$no_students)*100):0}}%)</span></p>
                        </div>
                    </div>

                    <div class="row mt-0 pt-0">
                        <div class="col-6 mt-0 pt-0">
                            <p>Dropout</p>
                        </div>
                        <div class="col-6 mt-0 pt-0">
                            <p> {{$no_students_dropout}} <span class="text-danger">({{($no_students>0)? round(($no_students_dropout/$no_students)*100):0}}%)</span></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card border-bottom border-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Staffs</h5>
                            <p class="card-text h2">{{$no_staff}}</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4 text-primary">
                            <i class="fas fa-chalkboard-teacher" ></i>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-0 pt-0">
                        <div class="col-6 mt-0 pt-0">
                            <p>Permanent</p>
                        </div>
                        <div class="col-6 mt-0 pt-0">
                            <p> {{$no_staff_permanent}} <span class="text-primary">({{($no_staff>0)? round(($no_staff_permanent/$no_staff)*100):0}}%)</span></p>
                        </div>
                    </div>
                    <div class="row mt-0 pt-0">
                        <div class="col-6 mt-0 pt-0">
                            <p>On Contract</p>
                        </div>
                        <div class="col-6 mt-0 pt-0">
                            <p> {{$no_staff-$no_staff_permanent}} <span class="text-info">({{($no_staff>0)? round((($no_staff-$no_staff_permanent)/$no_staff)*100):0}}%)</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-bottom border-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Courses</h5>
                            <p class="card-text h2">{{$no_courses}}</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4 text-primary">
                            <i class="fas fa-graduation-cap" ></i>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-0 pt-0">
                        <div class="col-6 mt-0 pt-0">
                            <p>Active Courses</p>
                        </div>
                        <div class="col-6 mt-0 pt-0">
                            <p> {{$no_course_active}} <span class="text-success">({{($no_courses>0)? round((($no_course_active)/$no_courses)*100):0}}%)</span></p>
                        </div>
                    </div>
                    <div class="row mt-0 pt-0">
                        <div class="col-6 mt-0 pt-0">
                            <p>Inactive Courses</p>
                        </div>
                        <div class="col-6 mt-0 pt-0">
                            <p> {{$no_courses-$no_course_active}} <span class="text-danger">({{($no_courses>0)? round((($no_courses-$no_course_active)/$no_courses)*100):0}}%)</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-bottom border-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">TVEC Exams</h5>
                            <p class="card-text h2">{{$no_tvec_exam}}</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4 text-primary">
                            <i class="fas fa-book" ></i>
                            </p>
                        </div>
                    </div>
                    <div class="row mt-0 pt-0">
                        <div class="col-6 mt-0 pt-0">
                            <p>Attempts</p>
                        </div>
                        <div class="col-6 mt-0 pt-0">
                            <p> {{$no_tvec_exam_students->no_tvec_exam_students}} <span class="text-primary">({{($no_tvec_exam_students->no_tvec_exam_students>0)? round(($no_tvec_exam_students->no_tvec_exam_students/$no_tvec_exam_students->no_tvec_exam_students)*100):0}}%)</span></p>
                        </div>
                    </div>

                    <div class="row mt-0 pt-0">
                        <div class="col-6 mt-0 pt-0">
                            <p>Pass</p>
                        </div>
                        <div class="col-6 mt-0 pt-0">
                            <p> {{$no_tvec_exam_pass->no_tvec_exam_pass}} <span class="text-success">({{($no_tvec_exam_students->no_tvec_exam_students>0)? round(($no_tvec_exam_pass->no_tvec_exam_pass/$no_tvec_exam_students->no_tvec_exam_students)*100):0}}%)</span></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card-deck">
            <div class="card border-bottom border-success">
                <div class="card-header">
                    <h5 class="card-title">Number of Staffs vs Departments</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <canvas id="myChart2" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-bottom border-success">
                <div class="card-header">
                    <h5 class="card-title">Number of Students vs Academic Years</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <canvas id="myChart" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card-deck">
            <div class="card border-bottom border-success">
                <div class="card-header">
                    <h5 class="card-title">Number of Students vs Districts</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <canvas id="myChart3" ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    @if($academic_yers)
    <script>
        var JSONObject = JSON.parse('{{$academic_yers}}'.replace(/&quot;/g, '"'));
        console.log(JSONObject);
        var dynamicColors = function () {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + ",0.6)";
        };
        var coloR = [];
        for (var i in JSONObject) {
            coloR.push(dynamicColors());
        }

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: JSONObject,
                datasets: [{
                    label: "Number of Students vs Academic Year",
                    data: {{$courses}},
                    backgroundColor: coloR,
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });
    </script>
    @endif
    @if($departments)
    <script>
        var JSONObject2 = JSON.parse('{{$departments}}'.replace(/&quot;/g, '"'));
        console.log(JSONObject2);

        var coloStaff = [];
        for (var i in JSONObject2) {
            coloStaff.push(dynamicColors());
        }

        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: JSONObject2,
                datasets: [{
                    label: "Number of Staff",
                    data: {{$no_staff_count}},
                    backgroundColor: coloStaff
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });
    </script>
    @endif
    @if($districts)
    <script>
        var JSONObject3 = JSON.parse('{{$districts}}'.replace(/&quot;/g, '"'));
        console.log(JSONObject3);

        var coloDistrict = [];
        for (var i in JSONObject3) {
            coloDistrict.push(dynamicColors());
        }

        var ctx = document.getElementById('myChart3').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: JSONObject3,
                datasets: [{
                    label: "Number of Students",
                    data: {{$no_of_students_district}},
                    backgroundColor: coloDistrict
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });
    </script>
    @endif
@endsection
