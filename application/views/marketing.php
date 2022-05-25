<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Marketing Calendar
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Marketing Calendar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
				<div class="col-xs-12">

				  <div class="box box-default">
					<div class="box-header with-border">
					  <div class="col-xs-4">
						<h3 class="box-title"></h3>
						<button class="btn btn-flat btn-success" data-target="#event-modal" data-toggle="modal" ><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Create Event</button>
					  </div>
					  
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Name</th>
							<th>Type</th>
							<th>Description</th>
							<th>Branches</th>
							<th></th>
						  </tr>
						</thead>
						<tbody>
						
						<?php 
							if(!empty($records)){
								foreach($records as $row){
						?>
									  <tr>
										<td><?php echo $row['Start Date'];?></td>
										<td><?php echo $row['End Date'];?></td>
										<td><?php echo $row['Name'];?></td>
										<td><?php echo $row['Type'];?></td>
										<td><?php echo $row['Description'];?></td>
										<td><?php echo $row['Description'];?></td>
										<td><a href="#" class="edit-btn" id="<?php echo $row['ID'];?>" estart="<?php echo $row['Start Date'];?>" eend="<?php echo $row['End Date'];?>" 
										ename="<?php echo $row['Name'];?>" etype="<?php echo $row['Type'];?>" edesc="<?php echo $row['Description'];?>">Edit<a></td>
									  </tr>
						
						<?php
								}
							}
						?>
						</tbody>
						<tfoot>
						  <tr>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Name</th>
							<th>Type</th>
							<th>Description</th>
							<th>Branches</th>
							<th></th>
						  </tr>
						</tfoot>
					  </table>
					</div><!-- /.box-body -->
					
				  </div><!-- /.box -->
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <div class="modal modal-default" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Event Details</h4>
                  </div>
                  <div class="modal-body">
					<div class="alert" role="alert" id="error" style="display:none"></div>
					
                    <form role="form" id="event-form">
							<input type="hidden" name="action" id="action" value="0"/>
							<!-- text input -->
							<div class="form-group">
							  <label>Start Date</label>
							  <input type="text" name="start" id="start" class="form-control" placeholder="Start date"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>End Date</label>
							  <input type="text" name="end" id="end" class="form-control" placeholder="End date"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Name</label>
							  <input type="text" name="name" id="name" class="form-control" placeholder="Event name"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Type</label>
							  <input type="text" name="type" id="type" class="form-control" placeholder="Type"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Description</label>
							  <input type="text" name="description" id="description" class="form-control" placeholder="Description"/>
							</div>
							
							 <!-- Select multiple-->
							<div class="form-group">
							  <label>Select Branches</label>
							  <select multiple="multiple" class="form-control" id="branches" name="branches[]">
								<?php 
									if(!empty($branches)){
										foreach($branches as $row){
								?>
											<option value="<?php echo $row['No_'];?>"><?php echo $row['Name'];?></option>
											
								<?php
										}
									}
								?>
							  </select>
							</div>
							
							
						  </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-event">Save</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
         

	<script>
	$(document).ready(function(){
		
		 $('#branches').multiselect({
			 maxHeight: 200
		 });
		 
		$("#save-event").click(function(){
			if(validate()){
				save();
			}
		});
		
		$("#start").datepicker();
		$("#end").datepicker();
		
		$(".edit-btn").click(function(e){
			
			$("#action").val($(this).attr('id'));
			$("#start").val($(this).attr('dstart'));
			$("#end").val($(this).attr('eend'));
			$("#name").val($(this).attr('ename'));
			$("#type").val($(this).attr('etype'));
			$("#description").val($(this).attr('edesc'));
			
			$("#event-modal").modal("show")
		})
		
	})
	
	function validate(){
		
		var err = 0;
		var msg = "";
		
		$('#dept-form input[type="text"]').each(function(){
			if($.trim($(this).val()) == ''){
				err++;
			}
		});
		
		if(err > 0){
			msg +="All fields should be filled";
			$("#error").html(msg).show().addClass("alert-danger");
			return false;
		}
		else{
			$("#error").html(msg).hide().removeClass("alert-danger");
			return true;
		}
	}
	
	function save(){
		
		var url ="<?php echo base_url()?>/index.php/admin/save_event";
		var data = $("#event-form").serialize();
		//alert(data);
		$.ajax({
			   type:"POST",
			   data:data,
				url:url,
			success:function(data){
				$("#error").html(data).show().addClass("alert-success");
				
				location.reload();
				
			}
		});
		
	}
	</script>