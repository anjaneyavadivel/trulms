
        <?php $segment1= $this->uri->segment(1);
		
		if($segment1=='manage'){
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
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>-->

        <script src="<?= base_url(); ?>assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/jRespond/jRespond.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="<?= base_url(); ?>assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
        <!--/ vendor javascripts -->
  <!-- ============================================
        ============== Custom JavaScripts ===============
        ============================================= -->
        <script src="<?= base_url(); ?>assets/js/main.js"></script>
   

		<?php }?>
        
        
        
        
    </body>
</html>

      