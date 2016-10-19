
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

                        <h2>Payment Mode</h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>payment_mode"> Payment Mode</a>
                                </li>
                                
                                <li>
                                    <a href="javascript::">Add Payment Mode</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">


                        <!-- col -->
                        <div class="col-md-4 add_forms">

<?php $this->load->view('admin/msg')?>
                            <!-- tile -->
                            
                            <!-- /tile -->


                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>ADD</strong> Payment Mode</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">


                                     <?=form_open_multipart(base_url().'add_payment_mode',array('class'=>'form-horizontal','id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>

                                        <div class="form-group">
                                            <label class="control-label">Payment Mode Name</label>
                                            
                                                <input type="text" name="paymentMode" class="form-control" placeholder="Payment Mode Name"
                                                       data-parsley-trigger="change"
                                                       required>
                                           
                                        </div>

                                    

                                        <div class="form-group">
                                            <label class="control-label">Payment Mode Description</label>
                                           
                                                <input type="text" name="description" class="form-control" placeholder="Payment Mode Description"
                                                       data-parsley-trigger="change"
                                                       required>
                                         
                                        </div>

                                       <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                                    <!-- SUBMIT BUTTON -->
                                    <input type="submit" class="btn btn-default" id="form4Submit" value="Submit" name="save">
                                </div>
                                <!-- /tile footer -->

                                   <?php echo form_close(); ?> 

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