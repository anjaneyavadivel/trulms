
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

                        <h2>Designation </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>designation">Designation</a>
                                </li>
                                <li>
                                    <a href="javascript::">Edit Designation</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
                    <div class="row">


                      <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>


                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            
                            <!-- /tile -->
<?php $this->load->view('admin/msg')?>

                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Edit</strong> Designation</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">


                                    <form action="<?= base_url()?>edit_designation/<?=$v->desigID?>" method="post" class="form-horizontal" name="form4" role="form" id="form4" data-parsley-validate>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Designation Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control" placeholder="Designation Name"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->name?>">
                                            </div>
                                        </div>
<input type="hidden" value="<?=$v->desigID?>" name="desigID" />
                                        <hr class="line-dashed line-full" />

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Designation Description</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="description" class="form-control" placeholder="Designation Description"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->description?>">
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