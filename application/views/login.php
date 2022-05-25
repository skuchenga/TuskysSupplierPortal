  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="http://tuskys.com"><img src="<?php echo base_url()?>theme/img/logo_original.png" alt="Tuskys Logo" /></a>
      </div><!-- /.login-logo -->
	  
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
		
        <form action="<?php echo base_url() ?>index.php/login/authenticate" method="post">
		 
		  <?php if(isset($error_message) && !empty($error_message)){
			  
			  echo "<p class='bg-danger' style='padding:10px'>".$error_message."</p>";
		  }
		  ?>
		  
          <div class="form-group has-feedback">
            <input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control" placeholder="Username"/>
			<?php echo form_error('username')?>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" value="<?php echo set_value('username'); ?>" class="form-control" placeholder="Password"/>
			<?php echo form_error('password')?>
          </div>
          <div class="row">
            <div class="pull-right col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="#">I forgot my password</a><br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
	
	