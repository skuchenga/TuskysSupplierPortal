<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Product Sales Movement
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Product Sales Movement</li>
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
					  </div>
					  
					  <div class="col-xs-8">
						 <a class="btn btn-success pull-right generate" href="<?php echo base_url() ?>index.php/sales/generate_excel"><i class="fa fa-file-excel-o"></i>
 Excel</a>
						  <a class="btn btn-primary pull-right generate" style="margin-right: 5px;" href="<?php echo base_url() ?>index.php/sales/generate_pdf"><i class="fa fa-file-pdf-o "></i>
 PDF</a>
						  <a class="btn btn-default pull-right generate" style="margin-right: 5px;" href="<?php echo base_url() ?>index.php/sales/generate_pdf"><i class="fa fa-print"></i> Print</a>

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
					</div><!-- /.box-header -->
					<div class="box-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Branch</th>
							<th>Category</th>
							<th>Department</th>
							<th>Item Number</th>
							<th>Description</th>
							<th>Quantity</th>
							<th>Cost</th>
						  </tr>
						</thead>
						<tbody>
						
						<?php 
							if(!empty($records)){
								foreach($records as $row){
						?>
									  <tr>
										<td><?php echo $row['Name'];?></td>
										<td><?php echo $row['Category'];?></td>
										<td><?php echo $row['Product Group'];?></td>
										<td><?php echo $row['No_'];?></td>
										<td><?php echo $row['Description'];?></td>
										<td class="text-right"><?php echo number_format($row['Quantity']*-1,2);?></td>
										<td class="text-right"><?php echo number_format($row['Price'] *$row['Quantity']*-1,2);?></td>
									  </tr>
						
						<?php
								}
							}
						?>
						</tbody>
						<tfoot>
						  <tr>
							<th>Branch</th>
							<th>Category</th>
							<th>Department</th>
							<th>Item Number</th>
							<th>Description</th>
							<th>Quantity</th>
							<th>Cost</th>
						  </tr>
						</tfoot>
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->