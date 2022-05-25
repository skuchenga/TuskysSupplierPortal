<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Remittances
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Supplier Statement</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
				<div class="col-xs-12">

				  <div class="box box-default">
					<div class="box-header with-border">
					  <div class="col-xs-4">
						<!-- Date and time range -->
						  <div class="form-group pull-left">
							<div class="input-group">
								<input type="text" name="doc" id="doc" class="form-control" placeholder="Document No" />
								<div class="input-group-btn">
								  <button class="btn btn-default" id="search_doc"><i class="fa fa-search"></i></button>
								</div>
							</div>
						  </div><!-- /.form group -->
					  </div>
					  
					  <div class="col-xs-8">
						  
						  <a class="btn btn-success pull-right" href="<?php echo base_url() ?>index.php/statement/generate_excel"><i class="fa fa-file-excel-o"></i>
 Excel</a>
						  <a class="btn btn-primary pull-right" style="margin-right: 5px;" target="_blank" href="<?php echo base_url() ?>index.php/statement/generate_pdf"><i class="fa fa-file-pdf-o "></i>
 PDF</a>
						  <a class="btn btn-default pull-right" style="margin-right: 5px;" target="_blank" href="<?php echo base_url() ?>index.php/statement/generate_pdf"><i class="fa fa-print"></i> Print</a>

						  <!-- Date and time range -->
						  <div class="form-group pull-right" style="margin-right: 5px;">
							<div class="input-group">
							  <button class="btn btn-default pull-right" id="daterange-btn">
								<i class="fa fa-calendar"></i> Date range picker
								<i class="fa fa-caret-down"></i>
							  </button>
							</div>
						  </div><!-- /.form group -->
					  </div>
					  
					   <div class="col-xs-12">
						<?php 
							if(isset($header)){
						?>
							<table id="header" class="table">
								<thead>
								  <tr>
									<th>Document No</th>
									<th><?php echo $header;?></th>
								  </tr>
								</thead>
								
							</table>
							<?php
									
								}
							?>
					  </div>
					  
					</div><!-- /.box-header -->
					<div class="box-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Posting Date</th>
							<th>External Document No</th>
							<th>Document</th>
							<th>Description</th>
							<th>Amount</th>
						  </tr>
						</thead>
						<tbody>
						
						<?php 
							if(!empty($records)){
								foreach($records as $row){
						?>
									  <tr>
										<td><?php echo $row['Posting Date'];?></td>
										<td><?php echo $row['External Document No_'];?></td>
										<td><?php echo $row['Document'];?></td>
										<td><?php echo $row['Description'];?></td>
										<td class="text-right"><?php echo number_format($row['Closed by Amount'],2);?></td>
									  </tr>
						
						<?php
								}
							}
						?>
						</tbody>
						<tfoot>
						  <tr>
							<th>Posting Date</th>
							<th>External Document No</th>
							<th>Document</th>
							<th>Description</th>
							<th>Amount</th>
						  </tr>
						</tfoot>
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->