@extends('layouts.master')
@section('title')
   Student Dashboard
@endsection
@section('content')
    <div class="card mb-3">
        <div class="card-header bg-white border-0">
            <div class="align-items-center row">
                <div class="col">
                    <h5 class="mb-0 font-weight-bolder"> Dashboard </h5>
                </div>
                <div class="col-auto">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header border-0">
                            <div class="align-items-center row">
                                <div class="col">
                                    <p class="mb-0 font-weight-lighter">Enrolled Courses</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="align-items-center row">
                                <div class="col-md-12">
                                    <div class="h1 font-weight-lighter"> {{$count_course->count}}</div>
                                </div>
                                <div class="col-auto text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header border-0">
                            <div class="align-items-center row">
                                <div class="col">
                                    <p class="mb-0 font-weight-lighter">Examinations</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="align-items-center row">
                                <div class="col-md-12">
                                    <div class="h1 font-weight-lighter">{{$count_exam->count}}
                                        <span
                                            hidden>{{$per = ($count_exam->count!=0)? round(($count_exams_pass->count/$count_exam->count)*100) : 0}}</span>
                                        <span
                                            class="font-weight-bold {{($per>=60 && $per<80)? 'text-warning':(($per<60)?'text-danger':'text-primary')}} h6"> {{$per}}% </span><span class="h6"> Pass Rate</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header border-0">
                            <div class="align-items-center row">
                                <div class="col">
                                    <p class="mb-0 font-weight-lighter">Assessments</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="align-items-center row">
                                <div class="col-md-12">
                                    <div class="h1 font-weight-lighter">TO DO</div>
                                </div>
                                <div class="col-auto text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header border-0">
                            <div class="align-items-center row">
                                <div class="col">
                                    <p class="mb-0 font-weight-lighter">Attend Sessions</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="align-items-center row">
                                <div class="col-md-12">
                                    <div class="h1 font-weight-lighter">{{$count_attendance->count}}
                                        <span
                                            hidden>{{$per =($count_attendance->count!=0)? round(($count_attendance->present/$count_attendance->count)*100) : 0}}</span>
                                        <span
                                            class="font-weight-bold {{($per>=60 && $per<80)? 'text-warning':(($per<60)?'text-danger':'text-primary')}} h6"> {{$per}}% </span><span class="h6"> Present Rate</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header  border-0">
                            <div class="align-items-center row">
                                <div class="col">
                                    <p class="mb-0 font-weight-lighter"> Attendance Overview</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="align-items-center row">
                                <div class="col-md-12">
                                    <div class="h1 font-weight-lighter"></div>
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div class="col-auto text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header  border-0">
                                    <div class="align-items-center row">
                                        <div class="col">
                                            <p class="mb-0 font-weight-lighter">Enrolled Course(s)</p>
                                        </div>
                                    </div>
                                </div>
                                @foreach($enrolls as $enroll)
                                    <div class="card-body text-center">
                                        <div class="align-items-center row">
                                            <div class="col-12">
                                                <div class="h1 font-weight-lighter">{{$enroll->status}} </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div>{{$enroll->course->name}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer border-0">
                                        <div class="row ">
                                            <div class="col">
                                                <div>{{$enroll->course_mode}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <div>{{$enroll->enroll_date}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header  border-0">
                                    <div class="align-items-center row">
                                        <div class="col">
                                            <p class="mb-0 font-weight-lighter"> TVEC Examination Overview</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="align-items-center row">
                                        <div class="col">
                                            <span
                                                hidden>{{$per = round(($enroll_exams->tvec_exam_pass/(($enroll_exams->tvec_exam_modules==0)?1:$enroll_exams->tvec_exam_modules))*100)}}</span>
                                            <div class="h1 font-weight-lighter"><span class="{{($per>=60 && $per<80)? 'text-warning':(($per<60)?'text-danger':'text-primary')}}">{{$per}}</span> <span class="text-muted h6">% Pass Rate</span>
                                            </div>
                                        </div>
                                        <div class="col-auto text-right">
                                            <div>{{$enroll_exams->tvec_exam_pass}} Pass</div>
                                            <div>{{$enroll_exams->tvec_exam_modules}} Exams</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer border-0">
            <div class="row ">
                <div class="col">

                </div>
                <div class="col-auto">
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>

        var JSONObject = JSON.parse('{{$labels}}'.replace(/&quot;/g, '"'));
        console.log(JSONObject);
        var coloR = [];

        var dynamicColors = function () {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + ",0.6)";
        };
        for (var i in JSONObject) {
            coloR.push(dynamicColors());
        }

        var labels = [1, 2];
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: JSONObject,
                datasets: [{
                    label: '% of Attendance',
                    data: {{$datas}},
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
@endsection
