<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Departments
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Departments</li>
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
						<button class="btn btn-flat btn-success" data-target="#dept-modal" data-toggle="modal" ><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Create Department</button>
					  </div>
					  
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Department</th>
							<th>Email</th>
							<th></th>
						  </tr>
						</thead>
						<tbody>
						
						<?php 
							if(!empty($departments)){
								foreach($departments as $row){
						?>
									  <tr>
										<td><?php echo $row['Department Name'];?></td>
										<td><?php echo $row['Department Email'];?></td>
										<td><a href="#" class="edit-btn" id="<?php echo $row['Department ID'];?>" dname="<?php echo $row['Department Name'];?>" demail="<?php echo $row['Department Email'];?>">Edit</a></td>
									  </tr>
						
						<?php
								}
							}
						?>
						</tbody>
						<tfoot>
						  <tr>
							<th>Department</th>
							<th>Email</th>
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
	  
	   <div class="modal modal-default" id="dept-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Department Details</h4>
                  </div>
                  <div class="modal-body">
					<div class="alert" role="alert" id="error" style="display:none"></div>
					
                    <form role="form" id="dept-form">
							<input type="hidden" name="action" id="action" value="0"/>
							<!-- text input -->
							<div class="form-group">
							  <label>Department name</label>
							  <input type="text" name="name" id="name" class="form-control" placeholder="Department name"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Department Email</label>
							  <input type="text" name="email" id="email" class="form-control" placeholder="Email"/>
							</div>
							
							
						  </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-dept">Save</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
         

	<script>
	$(document).ready(function(){
		
		$("#save-dept").click(function(){
			if(validate()){
				save();
			}
		});
		
		$(".edit-btn").click(function(e){
			
			$("#action").val($(this).attr('id'));
			$("#name").val($(this).attr('dname'));
			$("#email").val($(this).attr('demail'));
			
			$("#dept-modal").modal("show")
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
		
		var url ="<?php echo base_url()?>/index.php/admin/save_dept";
		var data = $("#dept-form").serialize();
		
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