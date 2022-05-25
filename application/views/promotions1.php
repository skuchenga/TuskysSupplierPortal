<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Promotional Data
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Promotional Data</li>
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
								<input type="text" name="promotion" id="promotion" class="form-control" placeholder="Promotion No" />
								<div class="input-group-btn">
								  <button class="btn btn-default" id="search_promotion"><i class="fa fa-search"></i></button>
								</div>
							</div>
						  </div><!-- /.form group -->
					  </div>
					  
					  <div class="col-xs-8">
						  
						  <a class="btn btn-success pull-right generate" href="<?php echo base_url() ?>index.php/promotions/generate_excel"><i class="fa fa-file-excel-o"></i>
 Excel</a>
						  <a class="btn btn-primary pull-right generate" style="margin-right: 5px;" href="<?php echo base_url() ?>index.php/promotions/generate_pdf"><i class="fa fa-file-pdf-o "></i>
 PDF</a>
						  <a class="btn btn-default pull-right generate" style="margin-right: 5px;" href="<?php echo base_url() ?>index.php/promotions/generate_pdf"><i class="fa fa-print"></i> Print</a>

					  </div>
					  
					  <div class="col-xs-12">
						<?php 
							if(isset($promo_header)){
						?>
							<table id="promo_header" class="table">
								<thead>
								  <tr>
									<th>Group</th>
									<th>Promo No</th>
									<th>Description</th>
									<th>Status</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Days</th>
								  </tr>
								</thead>
								<tbody>
								<?php 
									foreach($promo_header as $row){
								?>
										  <tr>
											<td><?php echo $row['Price Group'];?></td>
											<td><?php echo $row['No_'];?></td>
											<td><?php echo $row['Description'];?></td>
											<td><?php echo ($row['Status'] == 0 ?  "Enabled" :  "Disabled")?></td>
											<td class="text-right"><?php echo "";?></td>
											<td class="text-right"><?php echo "";?></td>
											<td class="text-right"><?php echo "";?></td>
										  </tr>
							
								<?php
										}
									
								?>
								</tbody>
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
							<th>Code</th>
							<th>Description</th>
							<th>Price + VAT</th>
							<th>Discount Amount</th>
							<th>Offer Price + VAT</th>
						  </tr>
						</thead>
						<tbody>
						
						<?php 
							if(!empty($records)){
								foreach($records as $row){
						?>
									  <tr>
										<td><?php echo $row['No_'];?></td>
										<td><?php echo $row['Description'];?></td>
										<td class="text-right"><?php echo number_format($row['Standard Price Including VAT'],2);?></td>
										<td class="text-right"><?php echo number_format($row['Discount Amount'],2);?></td>
										<td class="text-right"><?php echo number_format($row['Offer Price Including VAT'],2);?></td>
									  </tr>
						
						<?php
								}
							}
						?>
						</tbody>
						<tfoot>
						  <tr>
							<th>Code</th>
							<th>Description</th>
							<th>Price + VAT</th>
							<th>Discount Amount</th>
							<th>Offer Price + VAT</th>
						  </tr>
						</tfoot>
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->