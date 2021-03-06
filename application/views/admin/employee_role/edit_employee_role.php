
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

            <h2>Update Employee Role Setup</h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?= base_url() ?>"><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>employee-role">Employee Role Setup</a>
                    </li>
                    <li>
                        <a href="javascript::">Update Employee Role Setup</a>
                    </li>
                </ul>

            </div>

        </div>


        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <?php $this->load->view('admin/msg') ?>
            </div>
            <?= form_open_multipart(base_url() . 'edit-employee-role/' . $empRoleMapID, array('id' => 'add-edit-employee-role', 'role' => 'form', 'data-parsley-validate' => '')); ?>
            <?php
            if (isset($employeeRolw) && $employeeRolw->num_rows() > 0) {
                $v = $employeeRolw->row();
                ?>


                <!-- col -->
                <div class="col-md-12">

                    <section class="tile"> 

                        <!-- tile header --> 
                        <!-- /tile header --> 
                        <div class="tile-header dvd dvd-btm bg-greensea">
                            <h1 class="custom-font"><strong><?= $pageTitle ?> Setup</strong> </h1>

                        </div>
                        <!-- tile body -->
                        <div class="tile-body">


                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="empID">Employee Code / Name / Department / Designation <span class="required">*</span></label>
                                    <select name="empID" id="empID" tabindex="3" required class="form-control " disabled="">
                                        <option value="<?= $v->empID ?>"><?= ucwords($v->empCode . ' / ' . $v->empname . ' / ' . $v->department . ' / ' . $v->name); ?></option>

                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <hr class="line-dashed line-full"/>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Access Role <span class="required">*</span></label>
                                    <?php
                                    if (isset($role) && $role->num_rows() > 0) {
                                        foreach ($role->result() AS $rol) {
                                            ?>
                                            <div class="col-sm-2">

                                                <label class="checkbox checkbox-custom-alt">
                                                    <input type="checkbox" name="accessrole[]" 
                                                           data-parsley-trigger="change"
                                                           required value="<?= $rol->roleID ?>" <?php
                                                           if (in_array($rol->roleID, $emprolemap)) {
                                                               echo 'checked';
                                                           }
                                                           ?>><i></i> <?= $rol->roleName ?>
                                                </label>

                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                            </div>

                        </div>
                        <!-- /tile body --> 

                    </section>
                    <!-- /tile --> 

                </div>
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
                   <a  href="<?= base_url() ?>employee-role" tabindex="0" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a> 
 
                                <input type="submit" class="btn bg-greensea" id="formSubmit" value="Update" >
                                <a  href="javascript::" data-toggle="modal" data-target="#form-edit-submit" id="formsubmiting" data-options="splash-2 splash-ef-11" role="button" tabindex="0"  class="btn btn-greensea" style="display:none">Submit</a>
                                <input type="submit" class="btn btn-default" id="new_button" onclick="form_submit('add-edit-employee-role')" value="Submit" style="display:none" >
                            </div>
                            <!-- /tile footer --> 

                        </div>
                        <!-- /tile body --> 

                    </section>
                    <!-- /tile --> 

                </div>
                <?php echo form_close(); ?> 
            <?php } else { ?>

                No Records Found
<?php } ?>

        </div>
        <!-- /row -->




    </div>

</section>
<!--/ CONTENT -->






</div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer') ?>
