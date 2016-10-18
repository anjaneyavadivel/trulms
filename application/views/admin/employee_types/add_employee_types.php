
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

                <div class="page page-forms-validate">

                    <div class="pageheader">

                        <h2>Employee Types </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                
                                 <li>
                                    <a href="<?= base_url()?>employee_types">Employee Types</a>
                                </li>
                                
                                <li>
                                    <a href="javascript::">Add Employee Types</a>
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
                            
                            <!-- /tile -->


                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>ADD</strong> Employee Types</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">


                                    <form action="<?= base_url()?>manage/add_employee_types" method="post" class="form-horizontal" name="form4" role="form" id="form4" data-parsley-validate>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Employee Types Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="typename" class="form-control" placeholder="Employee Types Name"
                                                       data-parsley-trigger="change"
                                                       required>
                                            </div>
                                        </div>

                                        <hr class="line-dashed line-full" />

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Employee Types Description</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="description" class="form-control" placeholder="Employee Types Description"
                                                       data-parsley-trigger="change"
                                                       required>
                                            </div>
                                        </div>

                                       <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                                    <!-- SUBMIT BUTTON -->
                                    <input type="submit" class="btn btn-default" id="form4Submit" value="Submit" name="save">
                                </div>
                                <!-- /tile footer -->

                                    </form>

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