<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Purchase Returns
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Purchase Returns</li>
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
						  
						  <a class="btn btn-success pull-right" href="<?php echo base_url() ?>index.php/returns/generate_excel"><i class="fa fa-file-excel-o"></i>
 Excel</a>
						  <a class="btn btn-primary pull-right" style="margin-right: 5px;" target="_blank" href="<?php echo base_url() ?>index.php/returns/generate_pdf"><i class="fa fa-file-pdf-o "></i>
 PDF</a>
						  <a class="btn btn-default pull-right" style="margin-right: 5px;" target="_blank" href="<?php echo base_url() ?>index.php/returns/generate_pdf"><i class="fa fa-print"></i> Print</a>

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
							<th>Return No</th>
							<th>Return Date</th>
							<th>Returned From</th>
							<th>Returned Item</th>
							<th>Quantity</th>
							<th>Cost</th>
							<th>Reason</th>
						  </tr>
						</thead>
						<tbody>
						
						<?php 
							if(!empty($records)){
																
								foreach($records as $row){
						?>
									  <tr>
										<td><?php echo $row['Return Order No_'];?></td>
										<td><?php echo $row['Posting Date'];?></td>
										<td><?php echo $row['Name'];?></td>
										<td><?php echo $row['Description'];?></td>
										<td class="text-right"><?php echo number_format($row['Quantity'],2);?></td>
										<td class="text-right"><?php echo number_format($row['Direct Unit Cost'],2);?></td>
										<td><?php echo $row['Return Reason Code'];?></td>
									  </tr>
						
						<?php
								}
							}
						?>
						</tbody>
						<tfoot>
						   <tr>
							<th>Return No</th>
							<th>Return Date</th>
							<th>Returned From</th>
							<th>Returned Item</th>
							<th>Quantity</th>
							<th>Cost</th>
							<th>Reason</th>
						  </tr>
						</tfoot>
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->