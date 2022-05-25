
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Powered by <a href="#"> Vortex Solutions Ltd.</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Tuskys Supermarket Ltd.</a>.</strong> All rights reserved.
      </footer>
	  
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

   
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>theme/js/app.min.js" type="text/javascript"></script>
	<!-- Slimscroll -->
    <script src="<?php echo base_url()?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url()?>plugins/fastclick/fastclick.min.js'></script>
	<!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	 <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url()?>plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	 <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url()?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	<!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	<!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url()?>plugins/chartjs/Chart.min.js" type="text/javascript"></script>
	<!-- Multiselect -->
    <script src="<?php echo base_url()?>plugins/multiselect/bootstrap-multiselect.js" type="text/javascript"></script>
	
	<!-- Page script -->
    <script type="text/javascript">
      $(function () {
    
		$("#example1").dataTable();
		
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
				function (start, end) {
					
				  var startDate = start.format('MMMM D, YYYY');
				  var endDate = end.format('MMMM D, YYYY');
				  
				  $('#report_range').append(" For "+start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				  
				  var host = $(location).attr('host');
				  var path = $(location).attr('pathname');
				  var params = {from:startDate,to:endDate};
				  
				  url = "?"+jQuery.param(params);
				  
				 $(location).attr('href',url);
				}
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
		
		$("#search_promotion").click(function(){
			
			var promo = $("#promotion").val();
			
			var params = {promo:promo};
				  
		    url = "?"+jQuery.param(params);			

		    $(location).attr('href',url);
		});
		
		$("#search_doc").click(function(){
			
			var doc = $("#doc").val();
			
			var params = {doc:doc};
				  
		    url = "?"+jQuery.param(params);			

		    $(location).attr('href',url);
		});
		
		$(".generate").click(function(e){
			
			e.preventDefault();
			var search = $(location).attr('search');
			var url = $(this).attr('href');
			
			url += search;			

			window.open(url, '_blank');
		   // $(location).attr('href',url);
			
		});
		
		
		$("#header li a").on('click', function () {
			$("#header li a").removeClass("active");
			$(this).addClass("active");
			return false;
		});
      });
    </script>
	
  </body>
</html>