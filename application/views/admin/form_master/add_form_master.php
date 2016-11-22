<?php $this->load->view('admin/sidebar') ?>
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
            <h2>Add <?=$pageTitle?></h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="<?= base_url() ?>"><i class="fa fa-home"></i> HOME</a> </li>
                    <li> <a href="<?= base_url() ?>form-master"><?=$pageTitle?> Master</a> </li>
                    <li> <a href="javascript::">Add <?=$pageTitle?></a> </li>
                </ul>
            </div>
        </div>

        <!-- row -->
        <div class="row"> 
             <?= form_open_multipart(base_url() . 'add-form-master',array('id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
            <!-- col -->
            <?php $this->load->view('admin/msg')?>
          <div class="col-md-6">
               
                <section class="tile"> 

                    <!-- tile header --> 
                    <!-- /tile header --> 
                    <div class="tile-header dvd dvd-btm bg-greensea">
                        <h1 class="custom-font"><strong>Form Details</strong> </h1>

                    </div>
                    <!-- tile body -->
                    <div class="tile-body">


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="menuCaption">Form/Menu Name <span class="required">*</span></label>
                                <input type="text" name="menuCaption" id="menuCaption" class="form-control" required="" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="parentID">Parent Category <span class="required">*</span></label>
                                <select name="parentID" class="form-control mb-10" data-parsley-trigger="change" required="" >
                                    <option value="">Select option...</option>
                                    <option value="1">Master</option>
                                    <option value="2">Setup</option>
                                    <option value="3">Operations</option>
                                    <option value="4">Report</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="url">URL <span class="required">*</span></label>
                                <input type="text" name="url" id="url" class="form-control checkfield" data-tb="pages" data-col="url" required="" placeholder="add-form-master">
                                <span id="checkfield_msg"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="icon">Icon</label>
                                <input type="text" name="icon" id="icon" class="form-control" placeholder="fa fa-plus">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="tooltip">Tooltip</label>
                                <input type="text" name="tooltip" id="tooltip" class="form-control" >
                            </div>
                        </div>
                        
                    </div>
                    <!-- /tile body --> 

                </section>
                <!-- /tile --> 

            </div>
            <div class="col-md-6">
                <section class="tile"> 

                    <!-- tile header --> 
                    <!-- /tile header --> 
                    <div class="tile-header bg-greensea dvd dvd-btm">
                        <h1 class="custom-font"><strong>Page Alter Details</strong> </h1>

                    </div>
                    <!-- tile body -->
                    <div class="tile-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-10 control-label">Is Create Approve Required</label>
                                <div class="col-sm-1">
                                    <div class="onoffswitch labeled  greensea inline-block">
                                        <input type="checkbox" name="iscreateApproveRequired" class="onoffswitch-checkbox" id="iscreateApproveRequired" checked="" value="1">
                                        <label class="onoffswitch-label" for="iscreateApproveRequired"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-10 control-label">Is Modify Approve Required</label>
                                <div class="col-sm-1">
                                    <div class="onoffswitch labeled  greensea inline-block">
                                        <input type="checkbox" name="ismodifyApproveRequired" class="onoffswitch-checkbox" id="ismodifyApproveRequired" checked="" value="1">
                                        <label class="onoffswitch-label" for="ismodifyApproveRequired"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-10 control-label">Is Reporting User Approve Allowed</label>
                                <div class="col-sm-2">
                                    <div class="onoffswitch labeled  greensea inline-block">
                                        <input type="checkbox" name="isReportingUserApproveAllowed" class="onoffswitch-checkbox" id="isReportingUserApproveAllowed" checked="" value="1">
                                        <label class="onoffswitch-label" for="isReportingUserApproveAllowed"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-10 control-label">Is Self Edit Allowed</label>
                                <div class="col-sm-2">
                                    <div class="onoffswitch labeled greensea inline-block">
                                        <input type="checkbox" name="isSelfEditAllowed" class="onoffswitch-checkbox" id="isSelfEditAllowed" checked="checked" value="1">
                                        <label class="onoffswitch-label" for="isSelfEditAllowed"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-10 control-label">Is Self Approval Allowed</label>
                                <div class="col-sm-2">
                                    <div class="onoffswitch labeled greensea inline-block">
                                        <input type="checkbox" name="isSelfApprovalAllowed" class="onoffswitch-checkbox" id="isSelfApprovalAllowed" checked="" value="1">
                                        <label class="onoffswitch-label" for="isSelfApprovalAllowed"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="col-sm-4 control-label">Default Approver Role</label>
                                
                                <div class="col-sm-6">
                                    <select name="defaultApproverRoleID" class="form-control mb-10" data-parsley-trigger="change" >
                                    <option value="">Select option...</option>
                                     <?php
                                    if (isset($role) && $role->num_rows() > 0){
                                        foreach ($role->result() AS $rol) {
                                            ?>
                                    <option value="<?= $rol->roleID ?>"><?= $rol->roleName ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                                </div> 
                                
                            </div>
                        </div>
                    </div>
                    <!-- /tile body --> 

                </section>
                <!-- /tile --> 

                <!-- tile --> 

                <!-- /tile --> 

            </div>
            <div class="col-md-12"> 

                <!-- tile --> 

                <!-- tile -->
                <section class="tile"> 

                    <!-- tile body -->
                    <div class="tile-body"> 

                        <!-- tile footer -->
                        <div class="tile-footer text-right bg-tr-black lter dvd dvd-top"> 
                            <!-- SUBMIT BUTTON -->
                            <a href="<?=base_url().'form-master'?>" class="btn btn-warning "><i class="fa fa-hand-o-left"></i> Go Back</a>
                           <input type="submit" class="btn btn-greensea" id="form4Submit" value="Add" name="save">
                        </div>
                        <!-- /tile footer --> 

                    </div>
                    <!-- /tile body --> 

                </section>
                <!-- /tile --> 

            </div>
            <?php echo form_close(); ?> 
            <!-- /col --> 

        </div>
        <!-- /row --> 

    </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer') ?>
