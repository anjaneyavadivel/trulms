
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

                        <h2>View Department </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>department">Department</a>
                                </li>
                                <li>
                                    <a href="javascript::">View Department</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">
					
                      <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>
                      
                        <div class="col-md-4 insert_forms add_forms">

                         
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea  dvd dvd-btm">
                                    <h1 class="custom-font"><strong>View </strong> Department</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">

  

                                        <div class="form-group">
                                            <label class="control-label">Department Name</label>
                                            
                                                <input type="text" name="department" class="form-control" placeholder="Department Name"
                                                       data-parsley-trigger="change"
                                                       required value="<?= $v->department?>" disabled="disabled">
                                            
                                        </div>

                                      

                                        <div class="form-group">
                                            <label class="control-label">Department Description</label>
                                           
                                                <input type="text" name="description" class="form-control" placeholder="Department Description"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->description?>"  disabled="disabled">
                                                       
                                                       <input type="hidden" name="deptID" class="form-control" 
                                                        value="<?=$v->deptID?>" >
                                           
                                        </div>

                                       <!-- tile footer -->
                                
                                <!-- /tile footer -->

                                  

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
					<div class="row">
                        <!-- col -->
                        
                        <!-- /col -->
                    </div>
                    <!-- /row -->
                </div>
                
            </section>
            <!--/ CONTENT -->
        </div>
        <!--/ Application Content -->

  <?php $this->load->view('admin/footer')?>
