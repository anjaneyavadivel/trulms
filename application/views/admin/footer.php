<span  id="activedeactiveid" data-toggle="modal" data-target="#active-deactive" data-options="splash-2 splash-ef-11"></span>
<div class="modal splash fade" id="active-deactive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Confirmation!</h3>
            </div>
            <div class="modal-body">
                <p id="confirmation-msg"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-border activedeactiveconf-btn">Yes</button>
                <button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal splash fade" id="active-deactive1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title custom-font">Confirmation!</h3>
            </div>
            <div class="modal-body">
                <p id="confirmation-msg1"></p>
            </div>
            
            <div class="modal-footer" id="form_sub_enable">
                <a href="javascript::" class="btn btn-default btn-border activedeactiveconf-btn">Yes</a>
                <button class="btn btn-default btn-border activedeactiveconf-close" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<?php $segment1= $this->uri->segment(1);
		
		if(isset($table)){
		?>
		
        
         
        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= base_url()?>assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>-->
        <script src="<?= base_url()?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>
        <script src="<?= base_url()?>assets/js/jquery.cookie.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/screenfull/screenfull.min.js"></script>
  		<script src="<?= base_url()?>assets/js/vendor/daterangepicker/moment.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
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
        <script src="<?= base_url()?>assets-new/js/mainnew.js"></script>
        <script src="<?= base_url()?>assets-new/js/main.js"></script>
        <!--/ custom javascripts -->
        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <script>
                var base_path='<?= base_url()?>';
            $(window).load(function(){
                Mainnew.init();

                //initialize basic datatable
				<?php if($segment1=='department'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/department_json',
                    "columns": [
                        { "data": "deptID" },
                        { "data": "department" },
                        { "data": "description" },
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
					<?php }else if($segment1=='form-master'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>form-master-json',
                    "columns": [
                        { "data": "pageID" },
                        { "data": "parentID" },
                        { "data": "menuCaption" },
                        { "data": "url" },
                        { "data": "active" },
			{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 5] }
                    ],
                    "order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve-form-master-list'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>approve-form-master-json/<?= $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "page_modID" },
                        { "data": "createdon" },
                        { "data": "parentID" },
                        { "data": "menuCaption" },
                        { "data": "url" },
                        { "data": "createby" },
                        { "data": "active" },
			{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 7] }
                    ],
                    "order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='employee-role'){
					?>
					var table = $('#basic-usage').DataTable({
                                            "processing": true,
        "serverSide": true,
                    "ajax": '<?php echo base_url()?>employee-role-json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "empCode" },
                        { "data": "empname" },
                        { "data": "name" },
                        { "data": "department" },
                        { "data": "roleName" },
                        { "data": "active" },
			{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 7] }
                    ],
                    "order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve-employee-role'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>approve-employee-role-json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "createdon" },
                        { "data": "empCode" },
                        { "data": "empname" },
                        { "data": "name" },
                        { "data": "department" },
                        { "data": "roleName" },
                        { "data": "active" },
			{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 7] }
                    ],
                    "order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='form-access'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>form-access-json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "menuCaption" },
                        { "data": "roleName" },
                        { "data": "active" },
			{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 4] }
                    ],
                    "order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='contract-consignor'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/contract_consignor_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						{ "data": "from" },
						{ "data": "to" },
						{ "data": "length" },
						{ "data": "weight" },
						{ "data": "date" },
						{ "data": "sign" },
                        { "data": "total" },
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='employee'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/employee_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "empCode" },
						{ "data": "empname" },
						{ "data": "qualification" },
						{ "data": "deptid" },
						{ "data": "designation" },
						{ "data": "mobile" },
						{ "data": "mailoffice" },
						{ "data": "remarks" },
						{ "data": "joiningdate" },
                        { "data": "releavingdate" },
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_employee'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_employee_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "empCode" },
						{ "data": "empname" },
						{ "data": "qualification" },
						{ "data": "deptid" },
						{ "data": "designation" },
						{ "data": "mobile" },
						{ "data": "mailoffice" },
						{ "data": "remarks" },
						{ "data": "joiningdate" },
                        { "data": "releavingdate" },
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='driver'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/driver_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "addressline1" },
						{ "data": "phone1" },
						{ "data": "dlno" },
						{ "data": "dlexpirydt" },
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_driver'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_driver_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
                        { "data": "addressline1" },
						{ "data": "phone1" },
						{ "data": "dlno" },
						{ "data": "dlexpirydt" },
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve-contract-consignor'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_contract_consignor_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						{ "data": "from" },
						{ "data": "to" },
						{ "data": "length" },
						{ "data": "weight" },
						{ "data": "date" },
						{ "data": "sign" },
                        { "data": "total" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='vehicleowner'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/vehicleowner_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						{ "data": "companyName" },
						{ "data": "phone1" },
						{ "data": "state" },
                        { "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_vehicleowner'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_vehicleowner_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						{ "data": "companyName" },
						{ "data": "phone1" },
						{ "data": "state" },
                        { "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='consignor'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/consignor_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve-consignor'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_consignor_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						
						{ "data": "state" },
						{ "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='vehicleagent'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/vehicleagent_json',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						{ "data": "companyName" },
						{ "data": "phone1" },
						{ "data": "state" },
                        { "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
                    "dom": 'Rlfrtip'
                });
				<?php }else if($segment1=='approve_vehicleagent'){
					?>
					var table = $('#basic-usage').DataTable({
                    "ajax": '<?php echo base_url()?>manage/approve_vehicleagent_json/<?php echo $this->uri->segment(2)?>',
                    "columns": [
                        { "data": "ID" },
                        { "data": "name" },
						{ "data": "companyName" },
						{ "data": "phone1" },
						{ "data": "state" },
                        { "data": "active" },
						{ "data": "Action" }
                    ],
                    "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
                    ],
					"order": [[0, 'desc' ]],
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
        <?php if($segment1=='approve_employee'){
			?>
         <script>
            $(window).load(function(){
                $('#form4Submit').on('click', function(){
               //     $('#form4').submit();
                });
            });
        </script>
        <?php }?>
            <?php if($segment1=='form-access'){
			?>
        <script src="<?= base_url()?>/assets/js/vendor/parsley/parsley.min.js"></script>
        <script src="<?= base_url()?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>
         <script>
            $(window).load(function(){
                
//                    $("input[type='checkbox']").change(function() {
//                     if ($("input[type='checkbox']:checked").length){
//                         $(this).valid();
//                     }
//                 })
            });
        </script>
        <?php }?>
        
      <?php }else{?>
        <!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>-->

        <script src="<?= base_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
        
          <script src="<?= base_url()?>assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/parsley/parsley.min.js"></script>
         <script src="<?= base_url()?>assets/js/vendor/daterangepicker/moment.min.js"></script>

        <script src="<?= base_url()?>assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


        <!--/ vendor javascripts -->
        <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?= base_url()?>assets/js/main.js"></script>
        <script src="<?= base_url()?>assets-new/js/main.js"></script>
        <!--/ custom javascripts -->
        <!-- ===============================================
        ============== Page Specific Scripts ===============
        ================================================ -->
        <?php if($segment1=='add-employee-role'){
			?>
        <script src="<?= base_url()?>assets/js/vendor/chosen/chosen.jquery.min.js"></script>
        <script src="<?= base_url()?>assets-new/js/mainnew.js"></script>
         <script>
            $(window).load(function(){
               Mainnew.init();
               $("input[type='checkbox']").change(function() {
                if ($("input[type='checkbox']:checked").length){
                    $(this).valid()
                }
            })
            });
        </script>
        <?php }?>
        <script>
            $(window).load(function(){
                $('#form4Submit').on('click', function(){
                    $('#form4').submit();
                });
            });
        </script>
        <!--/ Page Specific Scripts -->
		<?php }?>
        
        
        
        
    </body>
</html>
