
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

                        <h2>Employee Types History</h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                
                                 <li>
                                    <a href="<?= base_url()?>employee_types">Employee Types</a>
                                </li>
                                
                                <li>
                                    <a href="javascript::">Employee Types History</a>
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
                                    <h1 class="custom-font"><strong>Employee Types Master</strong></h1>
                                    
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-custom" id="basic-usage">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Updated Date</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Updated By</th>
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
                        <!-- col -->
                        <div class="col-md-4 add_forms">
                            <!-- tile -->
                            
                            <!-- /tile -->


                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea  dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Update</strong> Employee Types</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">


                                    
 <?=form_open_multipart(base_url().'approve_employee_types/'.$v->employetypeID,array('class'=>'form-horizontal','id'=>'edit_employee_types','role'=>'form'));?>
                                        <div class="form-group">
                                            <label class="control-label">Employee Types Name</label>
                                           
                                                <input type="text" name="typename" class="form-control" placeholder="Employee Types " value="<?=$v->typename?>">
                                            
                                        </div>
<input type="hidden" value="<?=$v->employetypeID?>" name="employetypeID" id="employetypeID" />
                                      

                                        <div class="form-group">
                                            <label class="control-label">Employee Types Description</label>
                                            
                                                <input type="text" name="description" class="form-control" placeholder="Employee Types Description" value="<?=$v->description?>">
                                            
                                        </div>

                                       <!-- tile footer -->
                                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                                    <!-- SUBMIT BUTTON -->
                                    <!-- <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>employee_types','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>-->
                                    <a  href="<?= base_url()?>employee_types"  class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
                                   <input type="submit" class="btn bg-greensea" id="add_form" value="Update Employee Types" >
                                   
                                   <a  href="javascript::" data-toggle="modal" data-target="#form-submit" id="form_submiting" data-options="splash-2 splash-ef-11" role="button" tabindex="0"  onclick="form_action_msg(1)"class="btn btn-greensea" style="display:none">Submit</a>
                                    <input type="submit" class="btn btn-default" id="new_button" onclick="form_submit('edit_employee_types')" value="Submit" style="display:none" >
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