
            <?php $this->load->view('admin/sidebar')?>
                <!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
                <!--/ RIGHTBAR Content -->
            </div>
            <!--/ CONTROLS Content -->
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
                
            <section id="content">

                <div class="page page-tables-datatables">

                    <div class="pageheader">

                        <h2>Payment Mode </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                 <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="#">Payment Mode</a>
                                </li>
                               
                            </ul>

                        </div>

                    </div>

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">

<?php $this->load->view('admin/msg')?>
                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea  dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Payment Mode</strong> Master</h1>
                                     <?php if(checkpageaccess('payment_mode',1,'create')){?>
                                    <ul class="controls">
                                        
                                        <li><a href="<?= base_url()?>add_payment_mode" title="Add Payment Mode" role="button" tabindex="0" >Add New  <i class="fa fa-plus"></i></a></li>
                                    </ul>
                                     <?php }?>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-custom" id="basic-usage">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mode</th>
                                                <th>Description</th>
                                                <th>State</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->


                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                
            </section>
            <!--/ CONTENT -->

        </div>
        <!--/ Application Content -->


<?php $this->load->view('admin/footer')?>


