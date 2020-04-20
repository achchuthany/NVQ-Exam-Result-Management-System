@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <div class="row">     
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Students</h5>
                            <p class="card-text h2">1522</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4">
                            <i class="fas fa-user-graduate" ></i>
                            </p>
                        </div>
                    </div>     
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">     
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Staffs</h5>
                            <p class="card-text h2">1522</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4">
                            <i class="fas fa-user-graduate" ></i>
                            </p>
                        </div>
                    </div>     
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">     
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Courses</h5>
                            <p class="card-text h2">1522</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4">
                            <i class="fas fa-user-graduate" ></i>
                            </p>
                        </div>
                    </div>     
                </div>
            </div>
            <div class="card bg-gradient">
                <div class="card-body">
                    <div class="row">     
                        <div class="col-7">
                            <h5 class="card-title text-uppercase">Exams</h5>
                            <p class="card-text h2">1522</p>
                        </div>
                        <div class="col-5">
                            <p class="display-4">
                            <i class="fas fa-user-graduate" ></i>
                            </p>
                        </div>
                    </div>     
                </div>
            </div>
        </div>   
    </div>
    <canvas id="myChart" width="400" height="400"></canvas>
</div>
@endsection
@section('script')
 <script>
var ctx = document.getElementById('myChart').getContext('2d');
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
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>   
@endsection