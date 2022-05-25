  <body class="skin-green-light sidebar-mini layout-boxed">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="tuskys.co.ke" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?php echo base_url()?>theme/img/logo_small.png" alt="Tuskys Logo" /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?php echo base_url()?>theme/img/logo_original.png" alt="Tuskys Logo" /></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- /.messages-menu -->

              <!-- Notifications Menu -->
              
              <!-- Tasks Menu -->
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo base_url()?>theme/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $fullname;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo base_url()?>theme/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $fullname;?> - <?php echo $vendor_name;?>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--<div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
                    <div class="pull-right">
                      <a href="<?php echo base_url()?>index.php/login/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel" style="height:100px;text-align:center;">
            <div class="image">
              <img src="<?php echo base_url()?>theme/img/pixel_weave.png" class="img-circle" alt="Vendor Image" />
            </div>
			
            <div class="" style="margin-top:10px;">
              <p><?php echo $vendor_name;?></p>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">REPORTS</li>
            <!-- Links to reports -->
            <li><a href="<?php echo base_url()?>index.php/dashboard"><i class='fa fa-line-chart'></i> <span>Sales Analysis</span></a></li>
			<li class=''><a href="<?php echo base_url()?>index.php/dashboard/categories"><i class='fa fa-pie-chart'></i> <span>Category Analysis</span></a></li>
            <li><a href="<?php echo base_url()?>index.php/sales"><i class='fa fa-file'></i> <span>Product Sales</span></a></li>
            <li><a href="<?php echo base_url()?>index.php/returns"><i class='fa fa-history'></i> <span>Purchase Returns</span></a></li>
			<li><a href="<?php echo base_url()?>index.php/statement"><i class='fa fa-file-text'></i> <span>Supplier Statement</span></a></li>
			<!--<li><a href="#"><i class='fa fa-list'></i> <span>Inventory</span></a></li>-->
			<li><a href="<?php echo base_url()?>index.php/promotions"><i class='fa fa-info-circle'></i> <span>Promotional Data</span></a></li>
			<li><a href="<?php echo base_url()?>index.php/calendar"><i class='fa fa-calendar'></i> <span>Marketing Calendar</span></a></li>
			<li><a href="<?php echo base_url()?>index.php/contacts"><i class='fa fa-envelope'></i> <span>Contact Us</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>