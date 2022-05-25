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
						<div class="col-xs-4">
						  <!-- Date and time range -->
						  <div class="form-group pull-left" style="margin-right: 5px;">
							<div class="input-group">
							  <button class="btn btn-default pull-right" id="category-daterange-btn">
								<i class="fa fa-calendar"></i> Select Date Range 
								<i class="fa fa-caret-down"></i>
							  </button>
							</div>
						  </div><!-- /.form group -->
						</div>
						
						<div class="col-xs-4">
						  <!-- Date and time range -->
						  <div class="form-group pull-left" style="margin-right: 5px;">
							<div class="input-group">
							  <button class="btn btn-default pull-right" id="category-daterange-btn-2">
								<i class="fa fa-calendar"></i> Select Date Range 
								<i class="fa fa-caret-down"></i>
							  </button>
							</div>
						  </div><!-- /.form group -->
						</div>
						<!--<div class="col-xs-3">
							<div class="form-group">
								<button class="btn btn-success btn-flat" id="view_category"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;View</button>
							</div>
						</div>-->
					  </div>
						
					  <div class="row">
					  
						
						<!-- Left col -->
						<section class="col-lg-6 connectedSortable ui-sortable">
						
						
								 <!-- solid sales graph -->
						  <div class="box box-solid ">
							<div class="box-header ui-sortable-handle" style="cursor: move;">
							  <i class="fa fa-th"></i>
							  <h3 class="box-title" id="current">Year</h3>
							</div>
							<div class="box-body border-radius-none">
								 <div class="chart">
									<div class="res"  style="display:none"></div>
									<div id="pie1">
									<canvas id="pieChart" height="250"></canvas>
									</div>
								 </div>
								<div id="legendDiv" style="display:none">
								<h3 class="text-muted">Your Share</h3>
									<p class="text-muted">MarketShare : <span id="sales-c"><span></p>
									<p class="text-muted">Sales : <span id="share-c"><span></p>
									<h4>Top 10 Suppliers</h4>
									<div id="legend"></div>
									
								</div>
							</div><!-- /.box-body -->
							
						  </div><!-- /.box -->

						  
						  

						</section><!-- /.Left col -->
						
						<!-- right col (We are only adding the ID to make the widgets sortable)-->
						<section class="col-lg-6 connectedSortable ui-sortable">
						  <!-- solid sales graph -->
						  <div class="box box-solid ">
							<div class="box-header ui-sortable-handle" style="cursor: move;">
							  <i class="fa fa-th"></i>
							  <h3 class="box-title" id="previous">Year</h3>
							  <div class="box-tools pull-right">
							   
							  </div>
							</div>
							<div class="box-body border-radius-none">
								 <div class="chart">
									<div class="res" style="display:none"></div>
									<div id="pie2">
									<canvas id="pieChart2" height="250"></canvas>
									</div>
									</div>
									<div id="legendDiv2" style="display:none">
									<h3 class="text-muted">Your Share</h3>
										<p class="text-muted">MarketShare : <span id="sales-p"><span></p>
										<p class="text-muted">Sales : <span id="share-p"><span></p>
										<h4>Top 10 Suppliers</h4>
										<div id="legend2"></div>
										
									</div>
								 </div>
						 
							</div><!-- /.box-body -->
							
						  </div><!-- /.box -->

						  
						</section><!-- right col -->
					  </div>
					</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <script>
		//- PIE CHART -
					//-------------
					// Get context with jQuery - using jQuery's .get() method.
					
					var refpie=0;
					var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
					var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
					//var pieChart = new Chart(pieChartCanvas);
					//var pieChart2 = new Chart(pieChartCanvas2);
					
					var pieOptions = {
					  //Boolean - Whether we should show a stroke on each segment
					  segmentShowStroke: true,
					  //String - The colour of each segment stroke
					  segmentStrokeColor: "#fff",
					  //Number - The width of each segment stroke
					  segmentStrokeWidth: 2,
					  //Number - The percentage of the chart that we cut out of the middle
					  percentageInnerCutout: 10, // This is 0 for Pie charts
					  //Number - Amount of animation steps
					  animationSteps: 100,
					  //String - Animation easing effect
					  animationEasing: "easeOutBounce",
					  //Boolean - Whether we animate the rotation of the Doughnut
					  animateRotate: true,
					  //Boolean - Whether we animate scaling the Doughnut from the centre
					  animateScale: false,
					  onAnimationComplete: function(){
						  
					  },

					  showTooltips: true,
					  //Boolean - whether to make the chart responsive to window resizing
					  responsive: true,
					  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
					  maintainAspectRatio: false,
					  //String - A legend template
					  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li style=\"color:<%=segments[i].color%>\"><span style=\"background-color:<%=segments[i].color%>\"></span><%if(segments[i].value){%><%=segments[i].value.toFixed(2)%><%}%>%</li><%}%></ul>"
					};
					
			
		$(document).ready(function(){
		

			//get_data('');
			
			//-------------
					
			$('#category-daterange-btn').daterangepicker(
                {
                   ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				  },
				  startDate: moment().subtract(29, 'days'),
				  endDate: moment()
                },
				function (start, end) {		
				
				  var startDate = start.format('MMMM D, YYYY');
				  var endDate = end.format('MMMM D, YYYY');
				 				  
				  var category = $("#category").val();
				
				  get_data(category,startDate,endDate,1);
				}
			);
			
		
		$('#category-daterange-btn-2').daterangepicker(
                {
                   ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				  },
				  startDate: moment().subtract(29, 'days'),
				  endDate: moment()
                },
				function (start, end) {
				  var startDate = start.format('MMMM D, YYYY');
				  var endDate = end.format('MMMM D, YYYY');
				 				  
				  var category = $("#category").val();
				
				  get_data(category,startDate,endDate,2);
				}
			);
			
			/*$("#view_category").click(function(){
				var category = $("#category").val();
				
				get_data(category);
			})*/
		})
		
		function get_data(cat,from,to,type){
			/* alert(cat);
			alert(from);
			alert(to);
			alert(type); */
			var previous = [];
			var current = [];
			var colors = ["#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc",
						  "#d2d6de","#111111","#dd4b39","#0073b7","#001f3f","#39cccc","#3d9970",
						  "#d81b60","#001f3f","#0073b7","#00c0ef","#67a8ce","#605ca8","#f012be","#01ff70"];
						  
			var previous_label = "";
			var current_label = "";
			
			$(".res").text("Loading.....").show();
			
			$.ajax({
				   type:"POST",
				   data:"category="+cat+"&from="+from+"&to="+to+"&type="+type,
					url: "<?php echo base_url()?>/index.php/dashboard/get_category_records",
				success:function(data){
					console.log(data);
					var obj = $.parseJSON(data);
					console.log(obj);
					var s=0;
					var y=0;
					
					$(".res").text("Processing.....").show();
					
					if(obj.previous != null){
						$.each(obj.previous,function(key,value){
							var val = parseFloat(value.MarketShare);
							var object = {};
													
							if(s <=colors.length ){
								if(value.vnumber == obj.vendor_current.vnumber)
								{
									object['color'] ='#ff0000';
									object['highlight'] = '#ff0000';
								}
								else
								{
									object['color'] = colors[s];
									object['highlight'] = colors[s];
								}
								
								
							}else{
								if(value.vnumber == obj.vendor_current.vnumber)
								{
									object['color'] = '#ff0000';
									object['highlight'] = '#ff0000';
								}
								else
								{
									object['color'] = colors[y];
									object['highlight'] = colors[y];
								}	
								y++;
							}
							
							
							object['value'] = val;
							
							if(value.vnumber == obj.vendor_previous.vnumber){
								object['label'] =obj.vendor_previous.name
							}else{
								object['label'] = parseFloat(value.MarketShare).toFixed(2);

							}
							
							previous.push(object);
							
							previous_label = value.pYEAR;
							
							s++;
						});
					}else{
						
					}
					
					
					if(obj.current != null){
						$.each(obj.current,function(key,value){
							var val =parseFloat(value.MarketShare);
							var object = {};
													
							if(s <=colors.length ){
								if(value.vnumber == obj.vendor_current.vnumber)
								{
									object['color'] ='#ff0000';
									object['highlight'] = '#ff0000';
								}
								else
								{
									object['color'] = colors[s];
									object['highlight'] = colors[s];
								}
								
								
							}else{
								if(value.vnumber == obj.vendor_current.vnumber)
								{
									object['color'] = '#ff0000';
									object['highlight'] = '#ff0000';
								}
								else
								{
									object['color'] = colors[y];
									object['highlight'] = colors[y];
								}
								
								
								y++;
							}
							
							
							object['value'] = val;
							
							if(value.vnumber == obj.vendor_current.vnumber){
								object['label'] =obj.vendor_current.name;
							}else{
								object['label'] = parseFloat(value.MarketShare).toFixed(2);

							}
							object['labelColor'] ='black',
							object['labelFontSize'] = '16'
							
							current.push(object);
							
							current_label = value.pYEAR;
							
							s++;
						});
					}else{
						
					}
					
					if(type == 1)
					{
						
						if(obj.vendor_current != null){
							showCurrent(obj.vendor_current,current,from,to)
						}else{
							
							$("#previous").text("View not available");
						}
						
						if(obj.vendor_previous != null){
							showPrevious(obj.vendor_previous,previous,from,to,type)
						}else{
							$("#previous").text("View not available");
						}
					}
					else
					{
						if(obj.vendor_previous != null){
							showPrevious(obj.vendor_previous,previous,from,to,type)
						}else{
							$("#previous").text("View not available");
						}
					}
					
					
					
					$(".res").text("Processing.....").show();
					
					
					
					
					
					$(".res").text("Done.....").hide();
					console.log()
								
				}
			})
		}
		function showCurrent(vendor,current,from,to){
			if(refpie>0)
			{
				alert('refresh');
				$('#pieChart').remove();
				$('#pie1').append('<canvas id="pieChart" height="250"></canvas>');
				pieChartCanvas = $("#pieChart").get(0).getContext("2d");
			}
			pieChartCanvas.clearRect(0, 0, pieChartCanvas.width, pieChartCanvas.height);
			$("#share-c").text(parseFloat(vendor.Sale).toFixed(2))
			$("#sales-c").text(parseFloat(vendor.MarketShare).toFixed(2)+"%")
			$("#share-c").css("color","#ff0000")
			$("#sales-c").css("color","#ff0000")
			if(current != null){
				
				
				var pieChart2 = new Chart(pieChartCanvas).Pie(current, pieOptions);
				$("#legend").html(pieChart2.generateLegend())
				$("#legendDiv").show();
				$("#current").text("Range :  "+from+" to "+to);
			}else{
				$("#current").text("Data for current year for the period selected not found");
			}	
			
		}
		
		function showPrevious(vendor,previous,from,to,type){
			
			console.log(refpie);
			if(refpie>0)
			{
				alert('refresh');
				$('#pieChart2').remove();
				$('#pie2').append('<canvas id="pieChart2" height="250"></canvas>');
				pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
			}
				
			//alert(type);
			pieChartCanvas2.clearRect(0, 0,  pieChartCanvas2.width, pieChartCanvas2.height);

			$("#share-p").text(parseFloat(vendor.Sale).toFixed(2))
			$("#sales-p").text(parseFloat(vendor.MarketShare).toFixed(2)+"%")
			$("#share-p").css("color","#ff0000")
			$("#sales-p").css("color","#ff0000")
			
			if(previous != null){
				
				var pieChart = new Chart(pieChartCanvas2).Pie(previous, pieOptions);
				//pieChart.destroy();
				//console.log(pieChart.);
				$("#legend2").html(pieChart.generateLegend())
				$("#legendDiv2").show();
				if (type==1)
				{
					$("#previous").text("Range for Previous Year");
				}
				else
				{
					$("#previous").text("Range : "+from+" to "+to);
				}
				
				
			}
			else{
				$("#previous").text("Data for previous year for the period selected not found");
			}
			refpie++;
		}
	  </script>