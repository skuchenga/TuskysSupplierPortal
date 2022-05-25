<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Users</li>
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
						<button class="btn btn-flat btn-success" data-target="#user-modal" data-toggle="modal" ><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Create User</button>
					  </div>
					  
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Full Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Phone</th>
							<th>User Description</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						
						<?php 
							if(!empty($users)){
								foreach($users as $row){
						?>
									  <tr>
										<td><?php echo $row['Fullname'];?></td>
										<td><?php echo $row['Username'];?></td>
										<td><?php echo $row['Email'];?></td>
										<td><?php echo $row['Phone'];?></td>
										<td><?php echo $row['LevelDesc'];?></td>
										<td><a href="#" class="edit-btn" id="<?php echo $row['User ID'];?>" fname="<?php echo $row['Fullname'];?>" uname="<?php echo $row['Username'];?>" email="<?php echo $row['Email'];?>" 
										phone="<?php echo $row['Phone'];?>" pass="<?php echo $row['Password'];?>" level="<?php echo $row['Level'];?>" onclick="edit_user();">Edit</a></td>
										
									  </tr>
						
						<?php
								}
							}
						?>
						</tbody>
						<tfoot>
						  <tr>
							<th>Full Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Vendor</th>
							<th></th>
						  </tr>
						</tfoot>
					  </table>
					</div><!-- /.box-body -->
					
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				  
				  </div><!-- /.box -->
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  
            <div class="modal modal-default" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">User Details</h4>
                  </div>
                  <div class="modal-body">
					<div class="alert" role="alert" id="error" style="display:none"></div>
					
                    <form role="form" id="user-form">
							<input type="hidden" name="action" id="action" value="0"/>
							<!-- text input -->
							<div class="form-group">
							  <label>Full name</label>
							  <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full name"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Email</label>
							  <input type="text" name="email" id="email" class="form-control" placeholder="Email"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Phone</label>
							  <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Username</label>
							  <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Password</label>
							  <input type="password" name="pass" id="pass" class="form-control" placeholder="Password"/>
							</div>
							
							 <!-- radio -->
							<div class="form-group">
							  <div class="radio">
								<label>
								  <input type="radio" name="level" class="user_type" value="1">
								  Tuskys User
								</label>
							  </div>
							  <div class="radio">
								<label>
								  <input type="radio" name="level" class="user_type" value="2" checked>
								  Portal User
								</label>
							  </div>
							</div>
							
							<!-- select -->
							<div class="form-group">
							  <label>Vendor</label>
							  <select name="vendor" id="vendor" class="form-control">
								<option value="0">Select Vendor</option>
								<?php 
									if(!empty($vendors)){
										foreach($vendors as $row){
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
                    <button type="button" class="btn btn-primary" id="save-user">Save</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
         

	<script>
	$(document).ready(function(){
		
		$("#save-user").click(function(){
			if(validate()){
				save();
			}
		});
		
		$(".user_type").click(function(){
			if($(this).val() == 1){
				$("#vendor").attr("disabled",true);
			}else{
				$("#vendor").attr("disabled",false);
			}
		});
		
		$(".edit-btn").click(function(e){
			
			$("#action").val($(this).attr('id'));
			$("#fullname").val($(this).attr('fname'));
			$("#username").val($(this).attr('uname'));
			$("#phone").val($(this).attr('phone'));
			$("#email").val($(this).attr('email'));
			$("#pass").val($(this).attr('pass'));
			$("#user_type").val($(this).attr('level'));
			
			$("#user-modal").modal("show")
		})
	})
	
	function validate(){
		
		var err = 0;
		var msg = "";
		
		/*$('#user-form input[type="text"]').each(function(){
			if($.trim($(this).val()) == ''){
				err++;
			}
		});*/
		
		if($("#vendor").val() == 0 && $(".user_type").val() == 2){
			err++;
			msg +="Select Vendor";
			msg +="<br/>"
		}
		
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
		
		var url ="<?php echo base_url()?>/index.php/admin/save_user";
		var data = $("#user-form").serialize();
		
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