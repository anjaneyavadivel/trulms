
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
                        <div class="col-md-4 insert_forms add_forms">
<?php $this->load->view('admin/msg')?>
                            <!-- tile -->
                            
                            <!-- /tile -->


                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea  dvd dvd-btm">
                                    <h1 class="custom-font"><strong>ADD</strong> Employee Types</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">


                                   
                                     <?=form_open_multipart(base_url().'add_employee_types',array('class'=>'form-horizontal','id'=>'add_employee_types','role'=>'form'));?>

                                        <div class="form-group">
                                            <label class="control-label">Employee Types Name</label>
                                           
                                                <input type="text" name="typename" class="form-control" placeholder="Employee Types Name" required>
                                            
                                        </div>

                                       

                                        <div class="form-group">
                                            <label class="control-label">Employee Types Description</label>
                                            
                                                <input type="text" name="description" class="form-control" placeholder="Employee Types Description">
                                           
                                        </div>

                                       <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                                    <!-- SUBMIT BUTTON -->
                                   <!-- <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>employee_types','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>-->
                                    <a  href="<?= base_url()?>employee_types"  class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
                                   <input type="submit" class="btn bg-greensea" id="add_form" value="Add Employee Types" >
                                   
                                   <a  href="javascript::" data-toggle="modal" data-target="#form-submit" id="form_submiting" data-options="splash-2 splash-ef-11" role="button" tabindex="0"  class="btn btn-greensea" style="display:none">Submit</a>
                                    <input type="submit" class="btn btn-default" id="new_button" onclick="form_submit('add_employee_types')" value="Submit" style="display:none" >
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