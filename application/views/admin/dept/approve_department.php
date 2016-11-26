
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

                        <h2>Department Approve </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>department">Department</a>
                                </li>
                                <li>
                                    <a href="javascript::">Department  History</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">
					<div class="col-md-12">
					<?php $this->load->view('admin/msg')?>
                    </div>
                      <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>
                      <div class="col-md-8">


                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Department History</strong></h1>
                                     <?php if(checkpageaccess('department',1,'create')){?>
                                    <ul class="controls">
                                       
				
                                        <li><a href="<?= base_url()?>add_department" title="Add Department" role="button" tabindex="0" >Add New  <i class="fa fa-plus"></i></a></li>
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
                                                <th>Department</th>
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
                        <div class="col-md-4 add_forms">

                         
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Edit </strong> Department</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">

  <?=form_open_multipart(base_url().'approve_department/'.$v->deptID,array('class'=>'form-horizontal','id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
                                   

                                        <div class="form-group">
                                            <label class="control-label">Department Name</label>
                                            
                                                <input type="text" name="department" class="form-control" placeholder="Department Name"
                                                       data-parsley-trigger="change"
                                                       required value="<?= $v->department?>">
                                            
                                        </div>

                                      

                                        <div class="form-group">
                                            <label class="control-label">Department Description</label>
                                           
                                                <input type="text" name="description" class="form-control" placeholder="Department Description"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->description?>">
                                                       
                                                       <input type="hidden" name="deptID" class="form-control" 
                                                        value="<?=$v->deptID?>">
                                           
                                        </div>

                                       <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                                    <!-- SUBMIT BUTTON -->
                                    <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>department','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
                                    <input type="submit" class="btn bg-greensea" id="form4Submit" value="Submit" name="save">
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