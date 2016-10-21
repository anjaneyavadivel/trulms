
        <?php $segment1= $this->uri->segment(1);
		
		if(isset($table)){
		?>
		
        
         
        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= base_url()?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?= base_url()?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url()?>assets/js/vendor/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
        <script src="<?= base_url()?>assets/js/vendor/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url()?>assets/js/vendor/datatables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
        <script src="<?= base_url()?>assets/js/vendor/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
        <script src="<?= base_url()?>assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>

        <!--/ vendor javascripts -->


        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?= base_url()?>assets/js/main.js"></script>
        <!--/ custom javascripts -->
  <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){

                //initialize basic datatable
				<?php if($segment1=='department'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/department_json',
                    "columns": [
                        { "data": "deptID" },
                        { "data": "department" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='designation'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/designation_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='role'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/role_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "roleName" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='payment_mode'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/payment_mode_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "paymentMode" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='payment_status'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/payment_status_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='employee_types'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/employee_types_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_department'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_department_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_designation'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_designation_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_role'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_role_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_payment_mode'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_payment_mode_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				
				<?php }else if($segment1=='approve_payment_status'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_payment_status_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_employee_types'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_employee_types_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
					<?php }else if($segment1=='form-master'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>form-master-json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "description" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }else{?>
						
                var table = $('#basic-usage').DataTable({
                    "ajax": 'assets/extras/datatables-basic.json',
                    "columns": [
                        { "data": "id" },
                        { "data": "firstName" },
                        { "data": "lastName" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
                    "dom": 'Rlfrtip'
                });
				<?php }?>

                $('#basic-usage tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('row_selected') ) {
                        $(this).removeClass('row_selected');
                    }
                    else {
                        table.$('tr.row_selected').removeClass('row_selected');
                        $(this).addClass('row_selected');
                    }
                });
                //*initialize basic datatable
            });
        </script>
        
      <?php }else{?>
        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?= base_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
        
          <script src="<?= base_url()?>assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/parsley/parsley.min.js"></script>
        
        <!--/ vendor javascripts -->
        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?= base_url()?>assets/js/main.js"></script>
        <!--/ custom javascripts -->
        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
            $(window).load(function(){
                $('#form4Submit').on('click', function(){
               //     $('#form4').submit();
                });
            });
        </script>
        <!--/ Page Specific Scripts -->
		<?php }?>
        
        
        
        
    </body>
</html>

      
