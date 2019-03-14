@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary">
                <div class="card-body pb-0">
                    <div class="btn-group float-right">
                        <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-settings"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(31px, 23px, 0px);">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    <div class="text-value">总关键字{{ $count['total'] }}</div>
                    <div>今日抓取{{ $count['today'] }}<br>昨日抓取{{ $count['yesterday'] }}</div>
                </div>
                <div class="chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas class="chart chartjs-render-monitor" id="card-chart1" height="70" width="198" style="display: block; width: 198px; height: 70px;"></canvas>
                    <div id="card-chart1-tooltip" class="chartjs-tooltip top bottom" style="opacity: 0; left: 84.538px; top: 93.2778px;"><div class="tooltip-header"><div class="tooltip-header-item">March</div></div><div class="tooltip-body"><div class="tooltip-body-item"><span class="tooltip-body-item-color" style="background-color: rgb(0, 165, 224);"></span><span class="tooltip-body-item-label">My First dataset</span><span class="tooltip-body-item-value">84</span></div></div></div></div>
            </div>
        </div>
    </div>
@endsection

