@extends('layout')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <section class="col-lg-12 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Sales
                </h3>
            </div>

            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="chart tab-pane active" id="result" style="position: relative; height: 300px;">
                        @if($status == true)
                            <canvas id="result-canvas" width="400" height="300">
                            </canvas>
                        @else
                            <div class="text-center">
                                <span class="badge badge-danger"><h5>Lengkapi Perbandingan Terlebih Dahulu!</h5></span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    var ctx = document.getElementById('result-canvas').getContext('2d');
    var label = [
        @foreach($alternatif as $a)
            "{{ $a->alternatif }}",
        @endforeach
    ];
    var data = [
        @foreach($prioritasAkhir as $a)
            {{ $a }},
        @endforeach
    ]
    // console.log(label);
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: '# of Votes',
                data: data,
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
    // var barChartCanvas = $('#barChart').get(0).getContext('2d')
    // var barChartData = jQuery.extend(true, {}, areaChartData)
    // var temp0 = areaChartData.datasets[0]
    // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp1
    // barChartData.datasets[1] = temp0

    // var barChartOptions = {
    //   responsive              : true,
    //   maintainAspectRatio     : false,
    //   datasetFill             : false
    // }

    // var barChart = new Chart(barChartCanvas, {
    //   type: 'bar', 
    //   data: barChartData,
    //   options: barChartOptions
    // })
</script>
@endsection