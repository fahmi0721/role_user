@extends("master_lte")
@section("title-page", "Dashboard")

@section('breadcrumb')
<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
  </ol>
</section>
@endsection


@section('konten')
<div class="row">
    @php
        $icon_arr = array("fa-gg","fa-tag","fa-book");
        $bg = array("bg-orange","bg-green","bg-blue");
        $i=0;
    @endphp
    @foreach($jenis_ks as $dt_jenis_ks)
    @php
        if(count($std) > $i){
            $std_data = $std[$i];
            $nilai = $std_data->id == $dt_jenis_ks->id ? $std_data->tot : 0;
        }else{
            $nilai =0;
        }
    @endphp
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box {{ $bg[$i] }}">
            <span class="info-box-icon"><i class="fa {{ $icon_arr[$i] }}"></i></span>
            <div class="info-box-content">
                <span class="info-box-tex">{{ $dt_jenis_ks->nama_jenis_kerjasama }}</span>
                <span class="info-box-number">{{ $nilai }}</span>
                <div class="progress">
                    <div class="progress-bar" style="width: {{ $nilai }}%"></div>
                </div>
                <span class="progress-description">{{ $nilai }}% {{ $dt_jenis_ks->deskripsi }}</span>
            </div>
        </div>
    </div>
    @php $i++ @endphp
    @endforeach
</div>

<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-titl text-center"><i class='fa fa-info text-success'></i> SIKERMA</h2>
            </div>
            <div class="box-body">
                <p class='text-justify' style='font-size:18px'>
                Sistem Informasi Kerjasama Unitama, merupakan aplikasi yang dibuat untuk memberikan kemudahan kepada mitra dan civitas akademik dilingkup universitas teknologi akba Makassar dalam penyediaan informasi yang terkait dengan kerjasama, sekaligus sebagai media bantu bagi calon mitra yang berminat membangun kerjasama dengan unitama. hal ini dapat dilakukan dengan mudah, yakni cukup klik pada link ini "Siap Jadi Mitra Unitama"
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-line-chart text-info'></i> Perkembangan Kerjasama</h2>
                <div class="box-tools pull-right">
                    <label style='width:20px;height:20px;background-color:rgba(220, 20, 60, 1)'>&nbsp;</label> MoU 
                    <label style='width:20px;height:20px;background-color:rgba(19, 100, 0,1)'>&nbsp;</label> MoA 
                    <label style='width:20px;height:20px;background-color:#F7CA18'>&nbsp;</label> Ia 
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="lineChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-tag text-success'></i> Status Kerjasama</h2>
                
            </div>
            <div class="box-body">
                <canvas id="pieChart" style="height:250px"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h2 class="box-title text-center"><i class='fa fa-bar-chart text-info'></i> Jumlah Kerjasama Berdasarkan Unit Kerja</h2>
                <div class="box-tools pull-right">
                    <label style='width:20px;height:20px;background-color:rgba(220, 20, 60, 1)'>&nbsp;</label> MoU 
                    <label style='width:20px;height:20px;background-color:rgba(19, 100, 0,1)'>&nbsp;</label> MoA 
                    <label style='width:20px;height:20px;background-color:#F7CA18'>&nbsp;</label> Ia 
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="barChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('script')
<script>
        bartdata()
        lichartdata();
        pieChartData();
        function pieChartData(){
            $.ajax({
                type	: "GET",
                dataType: "json",
                url		: "{{ url('get_pie_data') }}/",
                success	:function(data) {
                   var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                   var pieChart = new Chart(pieChartCanvas);
                   var PieData = data.data;

                   var pieOptions = {
                    //Boolean - Whether we should show a stroke on each segment
                    segmentShowStroke: true,
                    //String - The colour of each segment stroke
                    segmentStrokeColor: "#fff",
                    //Number - The width of each segment stroke
                    segmentStrokeWidth: 2,
                    //Number - The percentage of the chart that we cut out of the middle
                    percentageInnerCutout: 50, // This is 0 for Pie charts
                    //Number - Amount of animation steps
                    animationSteps: 100,
                    //String - Animation easing effect
                    animationEasing: "easeOutBounce",
                    //Boolean - Whether we animate the rotation of the Doughnut
                    animateRotate: true,
                    //Boolean - Whether we animate scaling the Doughnut from the centre
                    animateScale: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,
                    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
                    };
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    pieChart.Doughnut(PieData, pieOptions);
                    
                },
                error: function(error){
                    error_detail(error);
                }
            });
        }
        function lichartdata(){
            $.ajax({
                type	: "GET",
                dataType: "json",
                url		: "{{ url('line_data') }}/",
                success	:function(data) {
                    var areaChartData = {
                    labels: data.data.labels,
                    datasets: [
                        {
                        label: "MoU",
                        fillColor: "rgba(220, 20, 60, 1)",
                        strokeColor: "rgba(220, 20, 60, 1)",
                        pointColor: "rgba(220, 20, 60, 1)",
                        pointStrokeColor: "rgba(220, 20, 60, 1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: data.data.mou
                        },
                        {
                        label: "MoA",
                        fillColor: "rgba(19, 100, 0,1)",
                        strokeColor: "rgba(19, 100, 0,1)",
                        pointColor: "rgba(19, 100, 0,1)",
                        pointStrokeColor: "rgba(19, 100, 0,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(19, 100, 0,1)",
                        data: data.data.moa
                        },
                        {
                        label: "Ia",
                        fillColor: "#F7CA18",
                        strokeColor: "#F7CA18",
                        pointColor: "#F7CA18",
                        pointStrokeColor: "#F7CA18",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#F7CA18",
                        data: data.data.ia
                        }
                    ]
                    };
                    var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: false,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 4,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                    };

                    // //Create the line chart
                    // areaChart.Line(areaChartData, areaChartOptions);

                    //-------------
                    //- LINE CHART -
                    //--------------
                    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
                    var lineChart = new Chart(lineChartCanvas);
                    var lineChartOptions = areaChartOptions;
                    lineChartOptions.datasetFill = false;
                    lineChart.Line(areaChartData, lineChartOptions);
                },
                error: function(error){
                    error_detail(error);
                }
            });
        }

        function bartdata(){
            $.ajax({
                type	: "GET",
                dataType: "json",
                url		: "{{ url('bar_data') }}/",
                success	:function(data) {
                    console.log(data.data);
                    var areaChartData = {
                    labels: data.data.labels,
                    datasets: [
                        {
                        label: "MoU",
                        fillColor: "rgba(220, 20, 60, 1)",
                        strokeColor: "rgba(220, 20, 60, 1)",
                        pointColor: "rgba(220, 20, 60, 1)",
                        pointStrokeColor: "rgba(220, 20, 60, 1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220, 20, 60, 1)",
                        data: data.data.mou
                        },
                        {
                        label: "MoA",
                        fillColor: "rgba(19, 100, 0,1)",
                        strokeColor: "rgba(19, 100, 0,1)",
                        pointColor: "rgba(19, 100, 0,1)",
                        pointStrokeColor: "rgba(19, 100, 0,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(19, 100, 0,1)",
                        data: data.data.moa
                        },
                        {
                        label: "Ia",
                        fillColor: "#F7CA18",
                        strokeColor: "#F7CA18",
                        pointColor: "#F7CA18",
                        pointStrokeColor: "#F7CA18",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "#F7CA18",
                        data: data.data.ia
                        }
                    ]
                    };

                    var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: false,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 4,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                    };

                    var barChartCanvas = $("#barChart").get(0).getContext("2d");
                var barChart = new Chart(barChartCanvas);
                var barChartData = areaChartData;
                barChartData.datasets[1].fillColor = "#00a65a";
                barChartData.datasets[1].strokeColor = "#00a65a";
                barChartData.datasets[1].pointColor = "#00a65a";
                var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
                };

                barChartOptions.datasetFill = false;
                barChart.Bar(barChartData, barChartOptions);
                },
                error: function(error){
                    error_detail(error);
                }
            });
        }

       
</script>
@endsection