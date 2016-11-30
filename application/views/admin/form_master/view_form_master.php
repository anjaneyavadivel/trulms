
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

            <h2>View Form Master</h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?= base_url() ?>"><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>form-master">Form Master</a>
                    </li>
                    <li>
                        <a href="javascript::">View Form Master</a>
                    </li>
                </ul>

            </div>

        </div>

        <div class="row"> 
            <?php $this->load->view('admin/msg') ?>
            <?php if (isset($pages) && $pages->num_rows() > 0) {
                $v = $pages->row();
                ?>
                <!-- col -->
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
                                    <input type="text" name="menuCaption" id="menuCaption" readonly="" class="form-control" required="" data-parsley-id="8057" value="<?= $v->menuCaption ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="parentID">Parent Category <span class="required">*</span></label>
                                    <select name="parentID" class="form-control mb-10" disabled="" data-parsley-trigger="change" required="" data-parsley-id="3888">
                                        <option value="">Select option...</option>
                                        <option value="1" <?php
                                                if ($v->parentID == 1) {
                                                    echo 'selected';
                                                }
                                                ?>>Master</option>
                                        <option value="2" <?php
                                        if ($v->parentID == 2) {
                                            echo 'selected';
                                        }
                                        ?>>Setup</option>
                                        <option value="3" <?php
                                        if ($v->parentID == 3) {
                                            echo 'selected';
                                        }
                                        ?>>Operations</option>
                                        <option value="4" <?php
                                        if ($v->parentID == 4) {
                                            echo 'selected';
                                        }
                                        ?>>Report</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="url">URL <span class="required">*</span></label>
                                    <input type="text" name="url" id="url" value="<?= $v->url ?>" readonly="" class="form-control checkfield" data-tb="pages" data-col="url" required="" data-parsley-id="8057" placeholder="add-form-master">
                                    <span id="checkfield_msg"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="icon">Icon</label>
                                    <input type="text" name="icon" id="icon" value="<?= $v->icon ?>" readonly="" class="form-control" data-parsley-id="1328" placeholder="fa fa-plus">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="tooltip">Tooltip</label>
                                    <input type="text" name="tooltip" id="tooltip" readonly="" value="<?= $v->tooltip ?>" class="form-control" data-parsley-id="1328">
                                </div>
                            </div>

                        </div>
                        <!-- /tile body --> 

                    </section>
                    <!-- /tile --> 

                </div>
                            <?php if (isset($pagealt) && $pagealt->num_rows() > 0) {
                                $v1 = $pagealt->row();
                                ?>
                    <div class="col-md-6">
                        <section class="tile"> 

                            <!-- tile header --> 
                            <!-- /tile header --> 
                            <div class="tile-header bg-greensea dvd dvd-btm">
                                <h1 class="custom-font"><strong>Page Alter Details</strong> </h1>
        <?php if (selfAllowed($pagealterpermission, 'selfEditAllowed', $v1->createby) && checkpageaccess('form-master', 1, 'modify')) { ?>
                                    <ul class="controls">

                                        <li><a href="<?= base_url() ?>edit-form-master/<?= $this->uri->segment(2) ?>" title="Edit <?= $pageTitle ?>" role="button" tabindex="0" >Update Form Master  <i class="fa fa-edit"></i></a></li>
                                    </ul>
                                                <?php } ?>
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

    <?php } ?>
                <!-- /col --> 
<?php } ?>
            <div class="col-md-12"> 

                <!-- tile --> 

                <!-- tile -->
                <section class="tile"> 

                    <!-- tile body -->
                    <div class="tile-body"> 

                        <!-- tile footer -->
                        <div class="tile-footer text-right bg-tr-black lter dvd dvd-top"> 
                            <!-- SUBMIT BUTTON -->
                            <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url() ?>form-master', '3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a> 
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
<?php
$this->load->view('admin/footer')?>