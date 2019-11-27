@extends('layouts.admin')

@section('content')
<div class="content">
<div class="row"> 
<example> </example>

</div>
<div class="row">
<div class="col-sm-6 col-lg-3">
<div class="card text-white bg-primary">
<div class="card-body pb-0">
<div class="btn-group float-right">
<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-settings"></i>
</button>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
<div class="text-value">9.823</div>
<div>Members online</div>
</div>
<div class="chart-wrapper mt-3 mx-3" style="height:70px;"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas class="chart chartjs-render-monitor" id="card-chart1" height="140" style="display: block; height: 70px; width: 359px;" width="718"></canvas>
<div id="card-chart1-tooltip" class="chartjs-tooltip bottom top" style="opacity: 0; left: 313.517px; top: 125.889px;"><div class="tooltip-header"><div class="tooltip-header-item">June</div></div><div class="tooltip-body"><div class="tooltip-body-item"><span class="tooltip-body-item-color" style="background-color: rgb(0, 165, 224);"></span><span class="tooltip-body-item-label">My First dataset</span><span class="tooltip-body-item-value">55</span></div></div></div></div>
</div>
</div>

<div class="col-sm-6 col-lg-3">
<div class="card text-white bg-info">
<div class="card-body pb-0">
<button class="btn btn-transparent p-0 float-right" type="button">
<i class="icon-location-pin"></i>
</button>
<div class="text-value">9.823</div>
<div>Members online</div>
</div>
<div class="chart-wrapper mt-3 mx-3" style="height:70px;"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas class="chart chartjs-render-monitor" id="card-chart2" height="140" style="display: block; height: 70px; width: 359px;" width="718"></canvas>
</div>
</div>
</div>

<div class="col-sm-6 col-lg-3">
<div class="card text-white bg-warning">
<div class="card-body pb-0">
<div class="btn-group float-right">
<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-settings"></i>
</button>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
<div class="text-value">9.823</div>
<div>Members online</div>
</div>
<div class="chart-wrapper mt-3" style="height:70px;"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas class="chart chartjs-render-monitor" id="card-chart3" height="140" style="display: block; height: 70px; width: 391px;" width="782"></canvas>
</div>
</div>
</div>

<div class="col-sm-6 col-lg-3">
<div class="card text-white bg-danger">
<div class="card-body pb-0">
<div class="btn-group float-right">
<button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-settings"></i>
</button>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
<div class="text-value">9.823</div>
<div>Members online</div>
</div>
<div class="chart-wrapper mt-3 mx-3" style="height:70px;"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
<canvas class="chart chartjs-render-monitor" id="card-chart4" height="140" style="display: block; height: 70px; width: 359px;" width="718"></canvas>
</div>
</div>
</div>
</div>



 <div class="row">
 <div class="col-md-12">
<div class="card">
<div class="card-header">
<i class="fa fa-align-justify"></i> List group
<small>with badges</small>
</div>
<div class="card-body">
<ul class="list-group">
<li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center" >
<span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <input type="checkbox" value="">
                        <span class="text">Make the theme responsive</span>
                      </span>

                  
                  <div class="tools">
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  </div>
                </li>
                <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center" >
<span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <input type="checkbox" value="">
                        <span class="text">Make the theme responsive</span>
                      </span>

                  
                  <div class="tools">
                  <small class="label label-info green"><i class="fa fa-clock-o"></i> 4 hours</small>
                  </div>
                </li><li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center" >
<span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <input type="checkbox" value="">
                        <span class="text">Make the theme responsive</span>
                      </span>

                  
                  <div class="tools">
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  </div>
                </li><li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center" >
<span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <input type="checkbox" value="">
                        <span class="text">Make the theme responsive</span>
                      </span>

                  
                  <div class="tools">
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 4 hours</small>
                  </div>
                </li>
                <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center" >
<span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <input type="checkbox" value="">
                        <span class="text">Make the theme responsive oksy</span>
                      </span>

                  
                  <div class="tools">
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 4 hours</small>
                  </div>
                </li>
                <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center" >
<span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <input type="checkbox" value="">
                        <span class="text">Make the theme responsive</span>
                      </span>

                  
                  <div class="tools">
                  <small class="label label-primary  "><i class="fa fa-clock-o"></i> 4 hours</small>
                  </div>
                </li><li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center" >
<span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        <input type="checkbox" value="">
                        <span class="text">Make the theme responsive</span>
                      </span>

                  
                  <div class="tools">
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 4 hours</small>
                  </div>
                </li>
</ul>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('scripts')

@parent

@endsection