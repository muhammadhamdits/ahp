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
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ count($alternatif) }}</h3>
                <p>Alternatif</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('alternatif.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ count($kriteria) }}</h3>
                <p>Kriteria</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('kriteria.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $best }}</h3>
                <p>Alternatif Terbaik</p>
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
    var ctx = document.getElementById('result-canvas');
    var l = [
        @foreach($alternatif as $a)
            "{{ $a->alternatif }}",
        @endforeach
    ];
    var d = [
        @foreach($prioritasAkhir as $a)
            {{ $a }},
        @endforeach
    ]
    // console.log(label);
    // console.log(data);
    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: l,
    //         datasets: [{
    //             label: '# of Votes',
    //             data: d,
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero: true
    //                 }
    //             }]
    //         }
    //     }
    // });
    // var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, d)
    // var temp0 = areaChartData.datasets[0]
    // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp1
    // barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
</script>
@endsection