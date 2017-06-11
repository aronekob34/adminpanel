        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?php echo base_url(); ?>assets/js/AdminLTE/raphael-min.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>assets/js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <!--<script src="<?php echo base_url(); ?>assets/js/AdminLTE/demo.js" type="text/javascript"></script>-->
        <!-- tabs -->
		<script src="<?php echo base_url(); ?>assets/js/tabs/assets/js/responsive-tabs.min.js" type="text/javascript"></script>
        <!-- CK Editor -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        
        <!-- Krajee Bootstrap Star Rating -->
        <script src="<?php echo base_url(); ?>assets/js/rating/star-rating.js" type="text/javascript"></script>
        
        <!-- Custom Stylesheet -->
        <script src="<?php echo base_url(); ?>assets/js/be_functions.js" type="text/javascript"></script>
        
    <?php if(in_array($page, array('dashboard/superadmin', 'dashboard/admin'))) { ?>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <?php } ?>
        
	<?php if(in_array($page, array('users/users_edit', 'users/approve', 'users/suspended_users', 'requests/all', 'requests/pending', 'requests/ongoing', 'requests/finished', 'requests/cancelled', 'groups/groups_edit', 'groups/closed_groups'))) { ?>
		<script type="text/javascript">
			$('#be-table-main').dataTable({
				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": false,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": false
			});
                        $('#example1').dataTable({
				
			});
			
		</script>
	<?php } ?>
	
    <script type="text/javascript">
        if($('#intervention_date').length > 0){
            $('#intervention_date').datepicker();
        }
                if($('#example1').length > 0){

        $('#example1').dataTable({
				
			});
                        }    
    </script>
    
    <?php if (!empty($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>
    <?php endif; ?>
    </body>
</html>