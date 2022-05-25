<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sales Data Analysis
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sales Data Analysis</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		  
		  <div class="row" style="margin-top:40px;">
			<div class="col-xs-12">
				<!-- solid sales graph -->
				  <div class="box box-solid bg-teal-gradient">
					<div class="box-header ui-sortable-handle" style="cursor: move;">
					  <i class="fa fa-th"></i>
					  <h3 class="box-title">Sales Graph for current year and previous year</h3>
					 
					</div>
					<div class="box-body border-radius-none">
					  
						<div class="chart">
							<canvas id="lineChart" height="250" ></canvas>
							
							
						</div>
						
						<div id="legendDiv">
							<h4>Legend</h4>
						</div>
					</div>
				 </div><!-- /.box-body -->
				
			</div><!-- /.box -->
		  </div>
		  
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <script>
		$(document).ready(function(){
			var previous = [];
			var current = [];
			var d = new Date();
			var n = d.getFullYear();
			var previous_label = n-1;
			var current_label = n;
			
			$.ajax({
				   type:"POST",
					url: "<?php echo base_url()?>/index.php/dashboard/get_records",
				success:function(data){
					
					var obj = $.parseJSON(data);
					
					$.each(obj.previous,function(key,value){
						previous.push(value.Sale);
						//previous_label = value.cYEAR;
					})
					
					$.each(obj.current,function(key,value){
						current.push(value.Sale);
						//current_label = value.pYEAR;
					})
					
					var areaChartData = {
					  labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
					  datasets: [
						{
						  label: "Previous Year - "+previous_label,
						  fillColor: "rgba(210, 214, 222, 1)",
						  strokeColor: "rgba(210, 214, 222, 1)",
						  pointColor: "rgba(210, 214, 222, 1)",
						  pointStrokeColor: "#c1c7d1",
						  pointHighlightFill: "#fff",
						  pointHighlightStroke: "rgba(220,220,220,1)",
						  data: previous
						},
						{
						  label: "Current Year - "+current_label,
						  fillColor: "rgba(60,141,188,0.9)",
						  strokeColor: "rgba(60,141,188,0.8)",
						  pointColor: "#3b8bba",
						  pointStrokeColor: "rgba(60,141,188,1)",
						  pointHighlightFill: "#fff",
						  pointHighlightStroke: "rgba(60,141,188,1)",
						  data: current
						}
					  ]
					};
					
					var areaChartOptions = {
					  //Boolean - If we should show the scale at all
					  showScale: true,
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
					  //Boolean - Whether the line is curved between points
					  bezierCurve: true,
					  //Number - Tension of the bezier curve between points
					  bezierCurveTension: 0.3,
					  //Boolean - Whether to show a dot for each point
					  pointDot: true,
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
					  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li style=\"color:<%=datasets[i].pointColor%>;font-size:18px;font-weight:700;\"><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
					  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
					  maintainAspectRatio: false,
					  //Boolean - whether to make the chart responsive to window resizing
					  responsive: true
					};

					
					 //-------------
					//- LINE CHART -
					//--------------
					var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
					
					var lineChartOptions = areaChartOptions;
					lineChartOptions.datasetFill = false;
					//lineChart.Line(areaChartData, lineChartOptions);
					var lineChart = new Chart(lineChartCanvas).Line(areaChartData, lineChartOptions);

				    //var chart = new Chart(ctx).Line(data, ctxOptions);

					document.getElementById("legendDiv").innerHTML = lineChart.generateLegend();
					
				}
			})
		})
	  </script>
	  