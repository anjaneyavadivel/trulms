
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

                        <h2>View Role </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>role">Role</a>
                                </li>
                                <li>
                                    <a href="javascript::">View Role</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">

                        <!-- col -->
                        	<div class="col-md-12">
					<?php $this->load->view('admin/msg')?>
                    </div>
                       
 <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>
                        <!-- col -->
                        
                        
                        <div class="col-md-4 insert_forms add_forms">


                            <!-- tile -->
                            
                            <!-- /tile -->


                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea  dvd dvd-btm">
                                    <h1 class="custom-font"><strong>View</strong> Role</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">


                                 

                                        <div class="form-group">
                                            <label class="control-label">Role Name</label>
                                           
                                                <input type="text" name="roleName" class="form-control" placeholder="Role Name"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->roleName?>" disabled="disabled">
                                           
                                        </div>
<input type="hidden" value="<?=$v->roleID?>" name="roleID" />
                                       

                                        <div class="form-group">
                                            <label class="control-label">Role Description</label>
                                           
                                                <input type="text" name="description" class="form-control" placeholder="Role Description"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->description?>" disabled="disabled">
                                           
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




                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->

<?php $this->load->view('admin/footer')?>