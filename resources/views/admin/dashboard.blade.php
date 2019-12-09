@extends('layouts.admin')

@section('content')

<div class="row row-sm mg-t-20">
    <div class="col-sm-6 col-lg-4 m-t-20">
        <div class="bg-white rounded-3 shadow-base overflow-hidden">
            <div class="p-20 d-flex align-items-center">
                <i class="fa fa-globe fs-80 lh-0 tx-primary op-0-7"></i>
                <div class="m-l-20">
                    <p class="fs-12 p-t-10 tx-medium tx-uppercase m-b-10">User Visited
                    </p>
                    <p class="fs-32 tx-dark-col m-b-10 site-status-value">{{ $total_visitor->visitor }}</p>
                </div>
            </div>                            
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 m-t-20">
        <div class="bg-white rounded-3 shadow-base overflow-hidden">
            <div class="p-20 d-flex align-items-center">
                <i class="fa fa-user-md fs-80 lh-0 tx-purple-col op-0-7"></i>
                <div class="m-l-20">
                    <p class="fs-12 p-t-10 tx-medium tx-uppercase m-b-10">Registered User
                    </p>
                    <p class="fs-32 tx-dark-col m-b-10 site-status-value">{{ count($total_user) }}</p>
                </div>
            </div>                            
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 m-t-20">
        <div class="bg-white rounded-3 shadow-base overflow-hidden">
            <div class="p-20 d-flex align-items-center">
                <i class="fa fa-bar-chart-o fs-80 lh-0 tx-teal-col op-0-7"></i>
                <div class="m-l-20">
                    <p class="fs-12 p-t-10 tx-medium tx-uppercase m-b-10">Total Posts</p>
                    <p class="fs-32 tx-dark-col m-b-10 site-status-value">{{ count($total_poster) }}</p>
                </div>
            </div>                           
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xs-12  m-t-20">
        <div class="panel panel-default chartJs">
            <div class="panel-heading">
                <div class="card-title">
                    <div class="title">Registered User</div>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="registered-user-chart" class="chart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xs-12  m-t-20">
        <div class="panel panel-default chartJs">
            <div class="panel-heading">
                <div class="card-title">
                    <div class="title">User Visited</div>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="user-visted-chart" class="chart"></canvas>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-xs-12  m-t-20">
        <div class="panel panel-default chartJs">
            <div class="panel-heading">
                <div class="card-title">
                    <div class="title">Total Posts</div>
                </div>
            </div>
            <div class="panel-body">
                <canvas id="posted-chart" class="chart"></canvas>
            </div>
        </div>
    </div>                    
</div>

<script>
$(function() {
  var key_array = <?php echo json_encode($key_array); ?>;
  var ctx, data, myLineChart, options;
  Chart.defaults.global.responsive = true;
  ctx = $('#registered-user-chart').get(0).getContext('2d');
  options = {
    scaleShowGridLines: true,
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleGridLineWidth: 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: true,
    bezierCurve: false,
    bezierCurveTension: 0.4,
    pointDot: true,
    pointDotRadius: 4,
    pointDotStrokeWidth: 1,
    pointHitDetectionRadius: 20,
    datasetStroke: true,
    datasetStrokeWidth: 2,
    datasetFill: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
  };
  data = {
    labels: key_array,
    datasets: [
      {
        label: "My First dataset",
        fillColor: "rgba(26, 188, 156,0.2)",
        strokeColor: "#1ABC9C",
        pointColor: "#1ABC9C",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "#1ABC9C",
        data: [{{implode(",",$all_user)}}]
      }
    ]
  };
  myLineChart = new Chart(ctx).Line(data, options);
});


$(function() {
  var key_array = <?php echo json_encode($key_array); ?>;
  var ctx, data, myLineChart, options;
  Chart.defaults.global.responsive = true;
  ctx = $('#user-visted-chart').get(0).getContext('2d');
  options = {
    scaleShowGridLines: true,
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleGridLineWidth: 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: true,
    bezierCurve: false,
    bezierCurveTension: 0.4,
    pointDot: true,
    pointDotRadius: 4,
    pointDotStrokeWidth: 1,
    pointHitDetectionRadius: 20,
    datasetStroke: true,
    datasetStrokeWidth: 2,
    datasetFill: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
  };
  data = {
    labels: key_array,
    datasets: [
      {
        label: "User Visited",
        fillColor: "rgba(122, 202, 246,0.4)",
        strokeColor: "#44b3f0",
        pointColor: "#44b3f0",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "#44b3f0",
        data: [{{implode(",",$all_visitor)}}]
      }
    ]
  };
  myLineChart = new Chart(ctx).Line(data, options);
});


$(function() {
   var key_array = <?php echo json_encode($key_array); ?>;
  var ctx, data, myBarChart, option_bars;
  Chart.defaults.global.responsive = true;
  ctx = $('#posted-chart').get(0).getContext('2d');
  option_bars = {
    scaleBeginAtZero: true,
    scaleShowGridLines: true,
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleGridLineWidth: 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: false,
    barShowStroke: true,
    barStrokeWidth: 1,
    barValueSpacing: 5,
    barDatasetSpacing: 3,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
  };
  data = {
    labels: key_array,
    datasets: [
      {
        label: "My First dataset",
        fillColor: "rgba(26, 188, 156,0.6)",
        strokeColor: "#1ABC9C",
        pointColor: "#1ABC9C",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "#1ABC9C",
        data: [{{implode(",",$all_poster)}}]
      }
    ]
  };
  myBarChart = new Chart(ctx).Bar(data, option_bars);
});



</script>
@endsection