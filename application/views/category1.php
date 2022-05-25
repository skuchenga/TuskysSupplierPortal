<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Analysis
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Analysis</a></li>
            <li class="active">Category Analysis</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
			<div class="row">
				<div class="col-xs-12">

				  <div class="box box-default">
					<div class="box-header with-border">
					  <div class="col-xs-4">
						<h3 class="box-title">Category Analysis</h3>
					  </div>
					  
					</div><!-- /.box-header -->
					<div class="box-body">
					  <div class="row">
						<div class="col-xs-3">
							<!-- select -->
							<div class="form-group">
							  <select class="form-control" id="category">
								<option value="0">Select Category</option>
								<?php 
									if(!empty($categories)){
										foreach($categories as $row){
								?>
											<option value="<?php echo $row->Code;?>"><?php echo $row->Description;?></option>
								<?php
										}
									}
								?>
							  </select>
							  
							</div>
						</div>
						<div class="col-xs-3" style="margin-right: 5px;">
							<div class="input-group">
							  <button class="btn btn-default pull-right" id="daterange-btn">
								<i class="fa fa-calendar"></i> Date range picker
								<i class="fa fa-caret-down"></i>
							  </button>
							</div>
						  </div>
						<div class="col-xs-3">
							<div class="form-group">
								<button class="btn btn-success btn-flat" id="view_category"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;View</button>
							</div>
						</div>
					  </div>
						
					  <div class="row">
					  
						
						<!-- Left col -->
						<section class="col-lg-6 connectedSortable ui-sortable">
						
						
								 <!-- solid sales graph -->
						  <div class="box box-solid bg-light-blue-gradient ">
							<div class="box-header ui-sortable-handle" style="cursor: move;">
							  <i class="fa fa-th"></i>
							  <h3 class="box-title" id="previous">Year</h3>
							</div>
							<div class="box-body border-radius-none">
								 <div class="chart">
									<div class="res"  style="display:none"></div>
									<canvas id="pieChart" height="250"></canvas>
								 </div>
								 <div id="legend"></div>
							</div><!-- /.box-body -->
							
						  </div><!-- /.box -->
						  
						  

						</section><!-- /.Left col -->
						
						<!-- right col (We are only adding the ID to make the widgets sortable)
						<section class="col-lg-6 connectedSortable ui-sortable">-->
						  <!-- solid sales graph 
						  <div class="box box-solid bg-green-gradient">
							<div class="box-header ui-sortable-handle" style="cursor: move;">
							  <i class="fa fa-th"></i>
							  <h3 class="box-title" id="current">Year</h3>
							  <div class="box-tools pull-right">
							   
							  </div>
							</div>
							<div class="box-body border-radius-none">
								 <div class="chart">
									<div class="res"  style="display:none"></div>
									<canvas id="pieChart2" height="250"></canvas>
								 </div>-->
						 
							<!--</div> /.box-body -->
							
						  <!--</div> /.box -->

						  
						<!--</section> right col -->
					  </div>
					</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <script>
		$(document).ready(function(){

			get_data('');
			
			$("#view_category").click(function(){
				var category = $("#category").val();
				
				get_data(category);
			})
		})
		
		function get_data(cat){
			
			var previous = [];
			var current = [];
			var colors = ["#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc",
						  "#d2d6de","#111111","#dd4b39","#0073b7","#001f3f","#39cccc","#3d9970",
						  "#d81b60","#001f3f","#0073b7","#00c0ef","#67a8ce","#605ca8","#f012be","#01ff70"];
						  
			var previous_label = "";
			//var current_label = "";
			
			$(".res").text("Loading.....").show();
			$.ajax({
				   type:"POST",
				   data:"category="+cat,
					url: "<?php echo base_url()?>index.php/dashboard/get_category_records",
				success:function(data){
					console.log(data);
					var obj = $.parseJSON(data);
					//console.log(obj);return;
					var s=0;
					var y=0;
					//var vend=0;
					
					vname=obj.vendor.vendorname;
					vno=obj.vendor.vendorno;
					//alert(vend);
					$.each(obj.previous,function(key,value){
						var val = Math.ceil(value.Sale);
						var obj = {};
						var vnum = value.vnumber;
						
						if(s <=colors.length ){
							if (vnum==vno)
						{
							alert(1);
						obj['color'] = "#FF0000";
						obj['highlight'] = "#FF0000";
						}
						else
						{
							obj['color'] = colors[s];
							obj['highlight'] = colors[s];
						}
							
						}else{
							if (vnum==vno)
						{
							//alert(1);
						obj['color'] = "#F0F0F0";
						obj['highlight'] = "#F0F0F0";
						}
						else
						{
							obj['color'] = colors[y];
							obj['highlight'] = colors[y];
							
							y++;
						}
						}
						
						
						obj['value'] = val;
						obj['label'] = value.MarketShare;
						
						console.log(obj);
						
						
						
						
						previous.push(obj);
						
						previous_label = vname;
						
						s++;
					});
					
					$(".res").text("Processing.....").show();
					
					/* $.each(obj.current,function(key,value){
						var val = Math.ceil(value.Sale);
						var obj = {};
												
						if(s <=colors.length ){
							
							obj['color'] = colors[s];
							obj['highlight'] = colors[s];
							
						}else{
							
							obj['color'] = colors[y];
							obj['highlight'] = colors[y];
							
							y++;
						}
						
						
						obj['value'] = val;
						obj['label'] = value.Vendor;
						
						current.push(obj);
						
						current_label = value.pYEAR;
						
						s++;
					}); */
					
					console.log(current)

					//-------------
					//- PIE CHART -
					//-------------
					// Get context with jQuery - using jQuery's .get() method.
					var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
					//var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
					var pieChart = new Chart(pieChartCanvas);
					//var pieChart2 = new Chart(pieChartCanvas2);
					
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
					  maintainAspectRatio: false,
					  multiTooltipTemplate: "<%= value %>",
					  //String - A legend template
					  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
					};
					//console.log(segments);
					//console.log(pieOptions);
					//Create pie or douhnut chart
					// You can switch between pie and douhnut using the method below.
					pieChart.Pie(previous, pieOptions);
					//pieChart2.Pie(current, pieOptions);
					//var legend = pieChart.generateLegend();
					//$('#legend').append(legend);
					$("#previous").text(previous_label);
					//$("#current").text(current_label);
					
					$(".res").text("Done.....").hide();
								
				}
			})
		}
	  </script>