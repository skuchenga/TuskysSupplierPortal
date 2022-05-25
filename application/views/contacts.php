<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Contact Us
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Contact Us</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
				<div class="col-xs-12">

				  <div class="box box-default">
					<div class="box-header with-border">
					  <div class="col-xs-4">
						<h3 class="box-title">Drop us a message</h3>
					  </div>
					  
					</div><!-- /.box-header -->
					<div class="box-body">
						<form role="form" method="post" action="<?php echo base_url()?>index.php/contacts/send_mail">
						
							
								<?php
									if(!empty($error)){
										echo '<p class="alert">'.$error.'</p>';
									}
								?>
							
							<!-- select -->
							<div class="form-group">
							  <label>Department</label>
							  <select class="form-control" name="department" id="department">
								<option>Select Department</option>
								<?php 
									if(!empty($departments)){
										foreach($departments as $row){
								?>
											<option value="<?php echo $row['Department Email'];?>"><?php echo $row['Department Name'];?></option>
											  
								<?php
										}
									}
								?>
							  </select>
							</div>
							
							<!-- text input -->
							<div class="form-group">
							  <label>Subject</label>
							  <input name="subject" id="subject" type="text" class="form-control" placeholder="Subject" required />
							</div>
							
							<!-- textarea -->
							<div class="form-group">
							  <label>Message</label>
							  <textarea name="message" id="message" class="form-control" rows="3" placeholder="Enter message here..." required /></textarea>
							</div>
							

						 
					</div><!-- /.box-body -->
					
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					 </form>
				  </div><!-- /.box -->
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->