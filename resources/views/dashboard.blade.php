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
                </div>
            </div>
            <div class="card border-bottom border-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Courses</h5>
                            <p class="card-text h2">1522</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4 text-primary">
                            <i class="fas fa-graduation-cap" ></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-bottom border-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">TVEC Exams</h5>
                            <p class="card-text h2">1522</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4 text-primary">
                            <i class="fas fa-book" ></i>
                            </p>
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
                    <h5 class="card-title">Students Details</h5>
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
                    <h5 class="card-title">Staff Details</h5>
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
                    <h5 class="card-title">TVEC Exam Pass Rate</h5>
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
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                datasets: [{
                    data: [86,114,106,106,107,111,133,221,783,1000],
                    label: "Africa",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    data: [282,350,411,502,635,809,947,1402,1000,1000],
                    label: "Asia",
                    borderColor: "#8e5ea2",
                    fill: false
                }, {
                    data: [168,170,178,190,203,276,408,547,675,734],
                    label: "Europe",
                    borderColor: "#3cba9f",
                    fill: false
                }, {
                    data: [40,20,10,16,24,38,74,167,508,784],
                    label: "Latin America",
                    borderColor: "#e8c3b9",
                    fill: false
                }, {
                    data: [6,3,2,2,7,26,82,172,312,433],
                    label: "North America",
                    borderColor: "#c45850",
                    fill: false
                }
                ]
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
    <script>
        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
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
    <script>
        var ctx = document.getElementById('myChart3').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
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
