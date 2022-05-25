<body class="lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="#">Tusker Mattresses Ltd</a>
      </div>
      <!-- User name -->
      <div class="lockscreen-name"><?php echo $this->session->flashdata('fullname');?></div>

	  <div class="help-block text-center">
        Enter the code sent to your email/phone to retrieve your session
      </div>
	  
      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
       
        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="<?php echo base_url() ?>index.php/login/authenticate_code" method="post">
		  <?php if(isset($error_message) && !empty($error_message)){
			  
			  echo "<p class='bg-danger' style='padding:10px'>".$error_message."</p>";
		  }
		  ?>
          <div class="input-group">
            <input type="text" name="auth_code" class="form-control" placeholder="Authentication Code" />
			<input type="hidden" name="user" value="<?php echo $this->session->flashdata('user');?>" />
			<?php echo form_error('username')?>
            <div class="input-group-btn">
              <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      
      <div class='text-center'>
        <a href="login.html">Or sign in as a different user</a>
      </div>
      <div class='lockscreen-footer text-center'>
        Copyright &copy; 2014-2015 <b><a href="#" class='text-black'>Tusker Mattresses Ltd</a></b><br>
        All rights reserved
      </div>
    </div><!-- /.center -->