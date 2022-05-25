<!-- Content Wrapper. Contains page content -->

<?php
$vendor = $this->session->userdata('vendor_no');

if(!isset($vendor)){

header('Location:http://192.168.150.4/demo');	
	
}
?>
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
							  <select class="form-control" id="chartType">
									<option value="0">Pie Chart</option>
									<option value="1">Bar graph</option>
								</select>
								<div id="divmsg" class="res"></div>
								
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
						</div>
						<!--<div class="col-xs-3">
							<div class="form-group">
								<button class="btn btn-success btn-flat" id="view_category"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;View</button>
							</div>
						</div>-->
					  </div>
					   
					  <div  id="divBargraph" style="width:100%; min-height:300px; margin-top:30px; margin-left:50px; display: none">
									 <!--<div id="x-asis" style="width: 580px; background-color:#808080; height:3px;"></div>-->
										
										<div id="divCurrentBarContent">
											
											<div id="divscalecurrent" style="width:500px; max-width:500px; display: none">
												<table cellspacing="0" cellpadding="0">
													<thead>
														<tr>
															<th colspan="10" style="background-color: gray; color: #fff; font-family: Tahoma;">
																<div id="currentRangeLabel" style=" margin-left: 10px"></div>
																<div id="yourMarketshare" style="font-size:0.8em; margin-left: 10px"></div>
															</th>
														</tr>
													</thead>
													<tr>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">0</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">10</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">20</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">30</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">40</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">50</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">60</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">70</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">80</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">90</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">100</td>

													</tr>
													<tr>
														<td style="width:50px; max-width:50px; text-align:start; vertical-align:top">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
													</tr>
													
												</table>
											</div>
											<div id="divcurrentgraph">
												
											</div>
										</div>
										 <!--Previous graph -->
											
										 <div id="divPreviousBarContent">
											<div id="divscaleprevious" style="width:500px; max-width:500px; display:none">
												<table cellspacing="0" cellpadding="0">
													<thead>
														<tr>
															<th colspan="10" style="background-color: gray; color: #fff; font-family:Tahoma;">
																	<div id="previousRangeLabel" style=" margin-left: 10px"></div>
															</th>
														</tr>
													</thead>
													<tr>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">0</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">10</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">20</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">30</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">40</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">50</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">60</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">70</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">80</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">90</td>
														<td style="width:50px; max-width:50px;border-bottom:solid; border-bottom-color:#045000; text-align:start; vertical-align:bottom">100</td>

													</tr>
													<tr>
														<td style="width:50px; max-width:50px; text-align:start; vertical-align:top">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
														<td style="width:50px; max-width:50px; text-align:initial; vertical-align:top;">|</td>
													</tr>
													
												</table>
											</div>
											<div id="divpreviousgraph">
												
											</div>
										</div>   
										  
										</div> <!--end of bar chart-->
										
					  <div id="divPieChart" style="display:none" class="row">
					  
						
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
								<div id="legendDiv"		>
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
						<section   class="col-lg-6 connectedSortable ui-sortable">
						  <!-- solid sales graph -->
						  <div  class="box box-solid ">
							<div  class="box-header ui-sortable-handle" style="cursor: move;">
							  <i  class="fa fa-th"></i>
							  <h3 class="box-title" id="previous">Year</h3>
							  <div class="box-tools pull-right">
							   
							  </div>
							</div>
							<div class="box-body border-radius-none">
								 <div class="chart">
									
								 </div>
									<div class="res"></div>
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
									<!--bar chart -->
									
						 
							</div><!-- /.box-body -->
							
						  </div><!-- /.box -->
								<!--bar graph-->
		
						  
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
						startDate: moment(),
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
							//startDate: moment().subtract(29, 'days'),
							startDate: moment(),
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
			});
				
			function get_data(cat,from,to,type){
				/* alert(cat);
				alert(from);
				alert(to);
				alert(type); */
				var divscalecurrent=document.getElementById("divscalecurrent");
				var divscaleprevious=document.getElementById("divscaleprevious");
				var canvasCurrent = document.getElementById('divcurrentgraph');
				var canvasPrevious = document.getElementById('divpreviousgraph');
				var divPieChart = document.getElementById("divPieChart");
				var divBargraph = document.getElementById("divBargraph");
				/* To do
				
				 //clear all canvases
				divscaleprevious.style.display="none";
				
				*/
				
				canvasCurrent.innerHTML="";
				canvasPrevious.innerHTML="";
				divscalecurrent.style.display="none";
				divscaleprevious.style.display="none";
				//var divCurrentBarContent = document.getElementById("divCurrentBarContent");
				//var divPreviousBarContent = document.getElementById("divPreviousBarContent");
				var iChart = $("#chartType").val();
				var previous = [];
				var current = [];
				var colors = ["#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc",
							  "#d2d6de","#111111","#dd4b39","#0073b7","#001f3f","#39cccc","#3d9970",
							  "#d81b60","#001f3f","#0073b7","#00c0ef","#67a8ce","#605ca8","#f012be","#01ff70"];
									  
				var previous_label = "";
				var current_label = "";
				//var msgBox = document.getElementById("msgBox");
				//divCurrentBarContent.style.display="none";
				//divPreviousBarContent.style.display="none";
				//msgBox.innerHTML="Loading.....";
				
				$(".res").text("Loading.....").show();
				$(".res").text("Processing.....").show();
						
				$.ajax({
					type:"POST",
					data:"category="+cat+"&from="+from+"&to="+to+"&type="+type,
					url: "<?php echo base_url()?>/index.php/dashboard/get_category_records",
								
					//process data
					success:function(data){
						console.log(data);
						var obj = $.parseJSON(data);
						console.log(obj);
						var s=0;
						var y=0;
								
						$(".res").text("Processing.....").show();
								
						if(iChart == '0') { //pie chart
							divPieChart.style.display="block";
							divBargraph.style.display="none";
							if(obj.previous != null){
									
								if (obj.vendor_current!=null)
								{
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
										
										if(value.vnumber == obj.vendor_current.vnumber){
											object['label'] =obj.vendor_current.name
										}else{
											object['label'] = (value.Name);

										}
										
										previous.push(object);
										
										previous_label = value.pYEAR;
										
										s++;
									});
								}
								else
								{
									$("#previous").text("View not available");
								}
									
							}
							else
							{
								$("#previous").text("View not available");
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
										object['label'] = (value.Name);

									}
									object['labelColor'] ='black',
									object['labelFontSize'] = '16'
										
									current.push(object);
										
									current_label = value.pYEAR;
										
									s++;
								});
							}else{
									
								$("#previous").text("View not available");
							}
								
							if(type == 1)
							{
									
								if(obj.vendor_current != null){
									showCurrent(obj.vendor_current,current,from,to)
								}else{
									alert();
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
									alert();
									$("#previous").text("View not available");
								}
							}
								
						}else{ //bar graph
							
							divPieChart.style.display="none";
							divBargraph.style.display="block";
													
							var labelDIV = null;
							var cssStyle = null;
							var barDIV = null;
							var labelDIV2 = null;
							var cssStyle2 = null;
							var barDIV2 = null;

							//if canvas is null, 
							if (canvasCurrent == null) {
								//clear canvas and return

								return false;
							}

							//if no colours defined return
							if (colors == null) {
								return false;
							}

							//Current vendor sales data
							var currentRangeLabel =document.getElementById("currentRangeLabel");
							if (obj.current != null && obj.vendor_current != null) {
								currentRangeLabel.innerHTML = from+" to "+to + " Market Share (%)";
						
								var objCurrent = obj.current;
								$(".res").text("Processing bar graph.....").show();
								for (var counter = 0; counter < objCurrent.length; counter++) {
									//create label div
									labelDIV = document.createElement("DIV");

									labelDIV.innerHTML = objCurrent[counter].Name + " | Sale: " + thousands(parseFloat(objCurrent[counter].Sale)) + " | Market Share: " + parseFloat(objCurrent[counter].MarketShare) + "%"; 

									//Create divLabel style
									labelDIV.style.color = colors[counter];
									//labelDIV.style.fontStyle = "italic";
									labelDIV.style.fontFamily="Tahoma";
									labelDIV.style.fontSize="0.8em";
									labelDIV.style.fontWeight = "bold";

									canvasCurrent.appendChild(labelDIV);

									//create bar div
									//<div style="height: 30px; width:250px; background-color: #0000ff; display: block; margin-bottom:10px;">1</div>
									var gWidth = (Math.round(parseFloat(objCurrent[counter].MarketShare))) * 5;
									var marketShare=Math.round(parseFloat(objCurrent[counter].MarketShare));
											
									barDIV = document.createElement("DIV");
									barDIV.style.height = "30px";
									barDIV.style.width = gWidth + "px";
									barDIV.style.backgroundColor = colors[counter];
									barDIV.style.display = "block";
									barDIV.style.marginBottom = "10px";
									barDIV.style.innerHTML=marketShare;


									canvasCurrent.appendChild(barDIV);
								}
								
								
								
								var yourShare = document.getElementById("yourMarketshare");
								yourShare.innerHTML="(Your Share: Sales: " + thousands(parseFloat(obj.vendor_current.Sale)) + " | Market Share: " + thousands(parseFloat(obj.vendor_current.MarketShare)) + " %)" ;
								divscalecurrent.style.display="block";
								
								
							}else{
								currentRangeLabel.innerHTML="No data available for view";
								//divscalecurrent.style.display="none";
							}
								

							//Current vendor sales data
								previousRangeLabel = document.getElementById("previousRangeLabel");
								
							if (obj.previous != null && obj.vendor_current != null) {
								var objPrevious = obj.previous;
								previousRangeLabel.innerHTML = "Previous year Market Share %";
								for (var counter = 0; counter < objPrevious.length; counter++) {
									//create label div
									labelDIV2 = document.createElement("DIV");
											
									labelDIV2.innerHTML = objPrevious[counter].Name + " | Sale: " + thousands(parseFloat(objPrevious[counter].Sale)) + " | Market Share: " + parseFloat(objPrevious[counter].MarketShare) + "%";

									//Create divLabel style
									labelDIV2.style.color = colors[counter];
									//labelDIV2.style.fontStyle = "italic";
									labelDIV2.style.fontFamily="Tahoma";
									labelDIV2.style.fontSize="0.8em";
									labelDIV2.style.fontWeight = "bold";

									canvasPrevious.appendChild(labelDIV2);

									//create bar div
									//<div style="height: 30px; width:250px; background-color: #0000ff; display: block; margin-bottom:10px;">1</div>
									gWidth = (Math.round(parseFloat(objPrevious[counter].MarketShare))) * 5;

									barDIV2 = document.createElement("DIV");
									barDIV2.style.height = "30px";
									barDIV2.style.width = gWidth + "px";
									barDIV2.style.backgroundColor = colors[counter];
									barDIV2.style.display = "block";
									barDIV2.style.marginBottom = "10px";
									
									canvasPrevious.appendChild(barDIV2);
								}
									divscaleprevious.style.display="block";
								
							}else{
									previousRangeLabel.innerHTML="No data available for view";
									//divscaleprevious.style.display="none";
									
							}
												
						} //end of bar graph
								
								
						$(".res").text("Processing.....").show();	
						$(".res").text("Done.....").hide();
						console.log()
											
					} //success
								
				})//end of JSON
			}
			
			
			function thousands(x) {
				var parts = x.toString().split(".");
				parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				return parts.join(".");
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