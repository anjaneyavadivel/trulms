
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

                        <h2>Department </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>department">Department</a>
                                </li>
                                <li>
                                    <a href="javascript::">Edit Department</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">

                      <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>
                      
                        <div class="col-md-4 add_forms">

                           <?php $this->load->view('admin/msg')?>
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Edit</strong> Department</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">

  <?=form_open_multipart(base_url().'edit_department/'.$v->deptID,array('class'=>'form-horizontal','id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
                                   

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Department Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="department" class="form-control" placeholder="Department Name"
                                                       data-parsley-trigger="change"
                                                       required value="<?= $v->department?>">
                                            </div>
                                        </div>

                                        <hr class="line-dashed line-full" />

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Department Description</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="description" class="form-control" placeholder="Department Description"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->description?>">
                                                       
                                                       <input type="hidden" name="deptID" class="form-control" 
                                                        value="<?=$v->deptID?>">
                                            </div>
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

						<?php } else { ?>
                        
                        No Records Found
                        <?php }?>

                    </div>
                    <!-- /row -->
                </div>
                
            </section>
            <!--/ CONTENT -->
        </div>
        <!--/ Application Content -->

  <?php $this->load->view('admin/footer')?>