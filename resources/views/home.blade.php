@extends('layouts.admin')

@section('content')
<div class="content">

<div class="animated fadeIn">
<div class="row">
<div class="col-sm-6 col-lg-3">
<div class="brand-card">
<div class="brand-card-header bg-facebook">
<i class="fa fa-users"></i>  <span style="color:white"> &nbsp; STUDENTS</span>
<div class="chart-wrapper"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas id="social-box-chart-1" height="192" style="display: block; height: 96px; width: 391px;" width="782" class="chartjs-render-monitor"></canvas>
</div>
</div>
<div class="brand-card-body">
<div>
<div class="text-value">89k</div>
<div class="text-uppercase text-muted small">Male</div>
</div>
<div>
<div class="text-value">459</div>
<div class="text-uppercase text-muted small">Female</div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-lg-3">
<div class="brand-card">
<div class="brand-card-header bg-twitter">
<i class="fa fa-users"></i>  <span style="color:white"> &nbsp; STAFF</span>
<div class="chart-wrapper"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas id="social-box-chart-2" height="192" style="display: block; height: 96px; width: 391px;" width="782" class="chartjs-render-monitor"></canvas>
</div>
</div>
<div class="brand-card-body">
<div>
<div class="text-value">973k</div>
<div class="text-uppercase text-muted small">Male</div>
</div>
<div>
<div class="text-value">1.792</div>
<div class="text-uppercase text-muted small">Female</div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-lg-3">
<div class="brand-card">
<div class="brand-card-header bg-linkedin">
<i class="fa fa-users"></i> <span style="color:white"> &nbsp; APPLICANTS</span>
<div class="chart-wrapper"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas id="social-box-chart-3" height="192" style="display: block; height: 96px; width: 391px;" width="782" class="chartjs-render-monitor"></canvas>
</div>
</div>
<div class="brand-card-body">
<div>
<div class="text-value">500+</div>
<div class="text-uppercase text-muted small">Male</div>
</div>
<div>
<div class="text-value">292</div>
<div class="text-uppercase text-muted small">Female</div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-lg-3">
<div class="brand-card">
<div class="brand-card-header bg-linkedin">
<i class="fa fa-money"></i> <span style="color:white"> &nbsp; Fees</span>
<div class="chart-wrapper"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas id="social-box-chart-4" height="192" style="display: block; height: 96px; width: 391px;" width="782" class="chartjs-render-monitor"></canvas>
</div>
</div>
<div class="brand-card-body">
<div>
<div class="text-value">894</div>
<div class="text-uppercase text-muted small">Application Fees</div>
</div>
<div>
<div class="text-value">92</div>
<div class="text-uppercase text-muted small">Student Fees</div>
</div>
</div>
</div>
</div>

</div>
<div class="row">
<div class="col-sm-6 col-md-2">
<div class="card">
<div class="card-body card card-accent-primary">
<div class="h1 text-muted text-right mb-4">
<i class="icon-people"></i>
</div>
<div class="text-value">87.500</div>
<small class="text-muted text-uppercase font-weight-bold">Ongoing Students</small>
<div class="progress progress-xs mt-3 mb-0">
<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-md-2">
<div class="card">
<div class="card-body card card-accent-primary">
<div class="h1 text-muted text-right mb-4">
<i class="icon-user-follow"></i>
</div>
<div class="text-value">385</div>
<small class="text-muted text-uppercase font-weight-bold">Completed Student</small>
<div class="progress progress-xs mt-3 mb-0">
<div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-md-2">
<div class="card">
<div class="card-body card card-accent-primary">
<div class="h1 text-muted text-right mb-4">
<i class="icon-basket-loaded"></i>
</div>
<div class="text-value">1238</div>
<small class="text-muted text-uppercase font-weight-bold">Staff</small>
<div class="progress progress-xs mt-3 mb-0">
<div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-md-2">
<div class="card">
<div class="card-body card card-accent-primary">
<div class="h1 text-muted text-right mb-4">
<i class="icon-pie-chart"></i>
</div>
<div class="text-value">28%</div>
<small class="text-muted text-uppercase font-weight-bold">Applicants</small>
<div class="progress progress-xs mt-3 mb-0">
<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-md-2">
<div class="card">
<div class="card-body card card-accent-primary">
<div class="h1 text-muted text-right mb-4">
<i class="icon-speedometer"></i>
</div>
<div class="text-value">5:34:11</div>
<small class="text-muted text-uppercase font-weight-bold">Transfered students</small>
<div class="progress progress-xs mt-3 mb-0">
<div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-md-2">
<div class="card">
<div class="card-body card card-accent-primary">
<div class="h1 text-muted text-right mb-4">
<i class="icon-speech"></i>
</div>
<div class="text-value">972</div>
<small class="text-muted text-uppercase font-weight-bold">Comments</small>
<div class="progress progress-xs mt-3 mb-0">
<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
</div>

</div>
</div>



<div class="card">
<div class="card-body card card-accent-primary">
<div class="row">
<div class="col-sm-5">
<h4 class="card-title mb-0">Student Summary</h4>
<div class="small text-muted">year 2019</div>
</div>

<div class="col-sm-7 d-none d-md-block">
<button class="btn btn-primary float-right" type="button">
<i class="icon-cloud-download"></i>
</button>
<div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
<label class="btn btn-outline-secondary">
<input id="option1" type="radio" name="options" autocomplete="off"> Day
</label>
<label class="btn btn-outline-secondary active">
<input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
</label>
<label class="btn btn-outline-secondary">
<input id="option3" type="radio" name="options" autocomplete="off"> Year
</label>
</div>
</div>

</div>
<div height="400">
{!! $chart->container() !!}
</div>
</div>
</div>



<div class="card">
<div class="card-body card card-accent-primary">
<div class="row">
<div class="col-sm-5">
<h4 class="card-title mb-0">Student Results</h4>
<div class="small text-muted">year 2019</div>
</div>

<div class="col-sm-7 d-none d-md-block">
<button class="btn btn-primary float-right" type="button">
<i class="icon-cloud-download"></i>
</button>
<div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
<label class="btn btn-outline-secondary">
<input id="option1" type="radio" name="options" autocomplete="off"> Day
</label>
<label class="btn btn-outline-secondary active">
<input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
</label>
<label class="btn btn-outline-secondary">
<input id="option3" type="radio" name="options" autocomplete="off"> Year
</label>
</div>
</div>
</div>
</div>
</div>
   
<div class="row">
<div class="col-lg-12">
<div class="card-body card card-accent-primary">
 <chart-component></chart-component>
<div id="container-highchart" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-lg-4">
<div class="card">
<div class="card-header bg-facebook content-center">
<svg class="c-icon c-icon-3xl text-white my-4">
<use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
</svg>
<div class="c-chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<canvas id="social-box-chart-1" height="192" style="display: block; height: 96px; width: 515px;" width="1030" class="chartjs-render-monitor"></canvas>
</div>
</div>
<div class="card-body row text-center">
<div class="col">
<div class="text-value-xl">89k</div>
<div class="text-uppercase text-muted small">friends</div>
</div>
<div class="c-vr"></div>
<div class="col">
<div class="text-value-xl">459</div>
<div class="text-uppercase text-muted small">feeds</div>
</div>
</div>
</div>
</div>

<div class="col-sm-6 col-lg-4">
<div class="card">
<div class="card-header bg-linkedin content-center">
<svg class="c-icon c-icon-3xl text-white my-4">
<use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin"></use>
</svg>
<div class="c-chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<canvas id="social-box-chart-3" height="192" style="display: block; height: 96px; width: 515px;" width="1030" class="chartjs-render-monitor"></canvas>
</div>
</div>
<div class="card-body row text-center">
<div class="col">
<div class="text-value-xl">500+</div>
<div class="text-uppercase text-muted small">contacts</div>
</div>
<div class="c-vr"></div>
<div class="col">
<div class="text-value-xl">292</div>
<div class="text-uppercase text-muted small">feeds</div>
</div>
</div>
</div>
</div>
<div class="col-sm-6 col-lg-4">
<div class="card">
<div class="card-header bg-linkedin content-center">
<svg class="c-icon c-icon-3xl text-white my-4">
<use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin"></use>
</svg>
<div class="c-chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
<canvas id="social-box-chart-3" height="192" style="display: block; height: 96px; width: 515px;" width="1030" class="chartjs-render-monitor"></canvas>
</div>
</div>
<div class="card-body row text-center">
<div class="col">
<div class="text-value-xl">500+</div>
<div class="text-uppercase text-muted small">contacts</div>
</div>
<div class="c-vr"></div>
<div class="col">
<div class="text-value-xl">292</div>
<div class="text-uppercase text-muted small">feeds</div>
</div>
</div>
</div>
</div>



</div>
</div>
</div>
@endsection
@section('scripts')
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>
{!! $chart->script() !!}
<script>

$(document).ready(function () {
var options = {

    chart: {
        renderTo: 'container-highchart',
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
    credits: {
        enabled: false
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:.1f}</b>'
    },
    plotOptions: {
        pie: {
            colors: ['#739600', '#566CCC', '#6666ab'],
            size: '100%',
            //innerSize: 100,
            depth: 45,
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Amount',
        data: []
    }]
}

$.ajax({
    type: "GET",
    url: "{{route('sample.graph')}}",
    data: {},
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    async: true,
    success: OnSuccess,
    error: OnError
});

function OnSuccess(data) {
    $.each(data.d, function (key, value) {
        options.series[0].data.push([value.Status_Color, value.Corrective_Action_ID]);
    })
    chart = new Highcharts.Chart(options);

  }
function OnError(data) {
    alert('fail');
}});
 
</script>
<script >
$(function () {
    var original_api_url = {{ $chart->id }}_api_url;

    $(".sel").change(function(){

        var year = $(this).val();

        {{ $chart->id }}_refresh(original_api_url + "?year="+year);

    });
});

</script>

@parent

@endsection