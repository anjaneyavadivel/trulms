
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

                        <h2>Designation Approve</h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>designation">Designation</a>
                                </li>
                                <li>
                                    <a href="javascript::">Approve Designation</a>
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
                                <div class="tile-header bg-greensea  dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Designation Master</strong> </h1>
                                    
                                    <ul class="controls">
                                        
                                        <li><a href="<?= base_url()?>add_designation" title="Add Department" role="button" tabindex="0" >Add New  <i class="fa fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-custom" id="basic-usage">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
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
                        <!-- col -->
                        <div class="col-md-4 add_forms">

                            <!-- tile -->
                            
                            <!-- /tile -->


                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea  dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Edit</strong> Designation</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">


                                
 <?=form_open_multipart(base_url().'approve_designation/'.$v->desigID,array('class'=>'form-horizontal','id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
                                        <div class="form-group">
                                            <label class="control-label">Designation Name</label>
                                           
                                                <input type="text" name="name" class="form-control" placeholder="Designation Name"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->name?>">
                                           
                                        </div>
<input type="hidden" value="<?=$v->desigID?>" name="desigID" />
                                       

                                        <div class="form-group">
                                            <label class="control-label">Designation Description</label>
                                            
                                                <input type="text" name="description" class="form-control" placeholder="Designation Description"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->description?>">
                                          
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