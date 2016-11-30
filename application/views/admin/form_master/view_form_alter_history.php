
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

                        <h2>View Form Master</h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>form-master">Form Master</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>approve-form-master-list/<?=$pagesID?>">Form Master History</a>
                                </li>
                                <li>
                                    <a href="javascript::">View Form Master History</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

  <div class="row"> 
            <?php $this->load->view('admin/msg')?>
                     
            <!-- col -->
           
            <?php if(isset($pagealt) && $pagealt->num_rows()>0){ $v1=$pagealt->row();?>
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
                                        <label class="col-sm-10 control-label">Is Self Edit Allowed</label>
                                        <div class="col-sm-2">
                                            <div class="onoffswitch labeled greensea inline-block">
                                                <input type="checkbox" name="isSelfEditAllowed" disabled="" class="onoffswitch-checkbox" id="isSelfEditAllowed"  <?php
                                        if ($v1->isSelfEditAllowed == 1) {
                                            echo 'checked';
                                        }
                                                ?> value="1">
                                                <label class="onoffswitch-label" for="isSelfEditAllowed"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-10 control-label">Is Self Approval Allowed</label>
                                        <div class="col-sm-2">
                                            <div class="onoffswitch labeled greensea inline-block">
                                                <input type="checkbox" name="isSelfApprovalAllowed" disabled="" class="onoffswitch-checkbox" id="isSelfApprovalAllowed"  <?php
                                               if ($v1->isSelfApprovalAllowed == 1) {
                                                   echo 'checked';
                                               }
                                                ?> value="1">
                                                <label class="onoffswitch-label" for="isSelfApprovalAllowed"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-10 control-label">Is Create Approve Required</label>
                                        <div class="col-sm-1">
                                            <div class="onoffswitch labeled  greensea inline-block">
                                                <input type="checkbox" name="iscreateApproveRequired" disabled="" class="onoffswitch-checkbox" id="iscreateApproveRequired" value="1" <?php
                                               if ($v1->iscreateApproveRequired == 1) {
                                                   echo 'checked';
                                               }
                                               ?>>
                                                <label class="onoffswitch-label" for="iscreateApproveRequired"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-10 control-label">Is Modify Approve Required</label>
                                        <div class="col-sm-1">
                                            <div class="onoffswitch labeled  greensea inline-block">
                                                <input type="checkbox" name="ismodifyApproveRequired" disabled="" class="onoffswitch-checkbox" id="ismodifyApproveRequired"  <?php
                                               if ($v1->ismodifyApproveRequired == 1) {
                                                   echo 'checked';
                                               }
                                               ?> value="1">
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
                                                <input type="checkbox" name="isReportingUserApproveAllowed" disabled="" class="onoffswitch-checkbox" id="isReportingUserApproveAllowed"  <?php
                                                if ($v1->isReportingUserApproveAllowed == 1) {
                                                    echo 'checked';
                                                }
                                                ?> value="1">
                                                <label class="onoffswitch-label" for="isReportingUserApproveAllowed"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label class="col-sm-4 control-label">Default Approver Role</label>

                                        <div class="col-sm-6">
                                            <select name="defaultApproverRoleID" disabled="" class="form-control mb-10" data-parsley-trigger="change" >
                                                <option value="">Select option...</option>
        <?php
        if (isset($role) && $role->num_rows() > 0) {
            foreach ($role->result() AS $rol) {
                ?>
                                                        <option value="<?= $rol->roleID ?>" <?php
                if ($v1->defaultApproverRoleID == $rol->roleID) {
                    echo 'selected';
                }
                ?>><?= $rol->roleName ?></option>
                            <?php
                        }
                    }
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
            
        <?php }?>
            <!-- /col --> 
            <div class="col-md-12"> 

                <!-- tile --> 

                <!-- tile -->
                <section class="tile"> 

                    <!-- tile body -->
                    <div class="tile-body"> 

                        <!-- tile footer -->
                        <div class="tile-footer text-right bg-tr-black lter dvd dvd-top"> 
                            <!-- SUBMIT BUTTON -->
                            <a href="<?= base_url()?>approve-form-master-list/<?=$pagesID?>" class="btn btn-warning "><i class="fa fa-hand-o-left"></i> Go Back</a>
                       </div>
                        <!-- /tile footer --> 

                    </div>
                    <!-- /tile body --> 

                </section>
                <!-- /tile --> 

            </div>
        </div>
                      


                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->
<?php $this->load->view('admin/footer')?>