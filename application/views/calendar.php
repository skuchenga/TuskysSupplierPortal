<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Marketing Calendar
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Marketing Calendar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
				<div class="col-xs-12">

					<div class="box box-success">
						<div class="box-body no-padding">
						  <!-- THE CALENDAR -->
						  <div id="calendar"></div>
						</div><!-- /.box-body -->
					</div><!-- /. box -->
				 
				
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	   <div class="modal fade bg-info" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="ResponseModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Event Details</h4>                       
                    </div>
                    <div class="modal-body">

                            
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="complete" >OK</button>
          
                    </div>

                </div>
            </div>
        </div>
	  
	  <script>
		$(document).ready(function(){
			var date = new Date();
			var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
				
			var url ="<?php echo base_url()?>/index.php/admin/get_events";
			var data = $("#user-form").serialize();
			
			$.ajax({
				   type:"POST",
				   data:data,
					url:url,
				success:function(data){
					//alert(data)
					
					var json = $.parseJSON(data);
					
					var events_data = [];
					
					$.each(json,function(key,value){
						
						var start = value.Startd;
						var end = value.Endd;
						var event = value.Name;
						var desc = value.Description;
						
						var startparts = start.split("-");
						var syear = startparts[0];
						var smonth = startparts[1]-1;
						var sday = startparts[2];
						
						var endparts = end.split("-");
						var eyear = endparts[0];
						var emonth = endparts[1]-1;
						var eday = endparts[2];
						
						var jsStart = new Date(syear,smonth,sday);
						var jsEnd = new Date(eyear,emonth,eday);
						
						console.log(jsStart);
						console.log(jsEnd);
						console.log(new Date(y, m, d));
						
						var obj = {}
						
						
						obj['title'] = event;
						obj['desc'] = desc;
						obj['start'] = jsStart;
						obj['end'] = jsEnd;
						obj['backgroundColor'] = "#f56954";
						obj['borderColor'] = "#f56954";
						
						events_data.push(obj)
				
					})
					
					$('#calendar').fullCalendar({
							  header: {
								left: 'prev,next today',
								center: 'title',
								right: 'month,agendaWeek,agendaDay'
							  },
							  buttonText: {
								today: 'today',
								month: 'month',
								week: 'week',
								day: 'day'
							  },
							  eventClick: function(calEvent, jsEvent, view) {

									//alert('Event Title: ' + calEvent.title +" "+ calEvent.branch);
									var msg = "<h3 class='text-muted'>"+calEvent.title+"</h3>";
									//msg += "<p class='text-muted'>Starts: "+calEvent.start+"</p>";
									//msg += "<p class='text-muted'>Ends: "+calEvent.end+"</p>";
									//msg += "<p class='text-muted'>Description</p>";
									msg += "<p class='text-muted'>"+calEvent.desc+"</p>";

									$(".modal-body").html(msg);
									
									$("#detailsModal").modal("show")
									// change the border color just for fun
									$(this).css('border-color', 'red');

							  },
							  //Random default events
							  events: events_data,
							  editable: false,
							  droppable: false, // this allows things to be dropped onto the calendar !!!
							  drop: function (date, allDay) { // this function is called when something is dropped

								// retrieve the dropped element's stored Event Object
								var originalEventObject = $(this).data('eventObject');

								// we need to copy it, so that multiple events don't have a reference to the same object
								var copiedEventObject = $.extend({}, originalEventObject);

								// assign it the date that was reported
								copiedEventObject.start = date;
								copiedEventObject.allDay = allDay;
								copiedEventObject.backgroundColor = $(this).css("background-color");
								copiedEventObject.borderColor = $(this).css("border-color");

								// render the event on the calendar
								// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
								$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

								// is the "remove after drop" checkbox checked?
								if ($('#drop-remove').is(':checked')) {
								  // if so, remove the element from the "Draggable Events" list
								  $(this).remove();
								}

							  }
							});
				}
			});
		
			/*var events_data = [
				{
				  title: 'All Day Event',
				  start: new Date(y, m, 1),
				  backgroundColor: "#f56954", //red
				  borderColor: "#f56954" //red
				},
				{
				  title: 'Long Event',
				  start: new Date(y, m, d - 5),
				  end: new Date(y, m, d - 2),
				  backgroundColor: "#f39c12", //yellow
				  borderColor: "#f39c12" //yellow
				},
				{
				  title: 'Meeting',
				  start: new Date(y, m, d, 10, 30),
				  allDay: false,
				  backgroundColor: "#0073b7", //Blue
				  borderColor: "#0073b7" //Blue
				},
				{
				  title: 'Lunch',
				  start: new Date(y, m, d, 12, 0),
				  end: new Date(y, m, d, 14, 0),
				  allDay: false,
				  backgroundColor: "#00c0ef", //Info (aqua)
				  borderColor: "#00c0ef" //Info (aqua)
				},
				{
				  title: 'Birthday Party',
				  start: new Date(y, m, d + 1, 19, 0),
				  end: new Date(y, m, d + 21, 22, 30),
				  allDay: false,
				  backgroundColor: "#00c0ef", //Success (green)
				  borderColor: "#00c0ef" //Success (green)
				},
				{
				  title: 'Click for Google',
				  start: new Date(y, m, 28),
				  end: new Date(y, m, 29),
				  url: 'http://google.com/',
				  backgroundColor: "#3c8dbc", //Primary (light-blue)
				  borderColor: "#3c8dbc" //Primary (light-blue)
				}
			  ]*/
			  
			
		})
	  </script>