
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

            <h2>View Employee Role Setup</h2>

            <div class="page-bar">

                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?= base_url() ?>"><i class="fa fa-home"></i> HOME</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>employee-role">Employee Role Setup</a>
                    </li>
                    <li>
                        <a href="javascript::">View Employee Role Setup</a>
                    </li>
                </ul>

            </div>

        </div>


        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <?php $this->load->view('admin/msg') ?>
            </div>
            <?php if (isset($employeeRolw) && $employeeRolw->num_rows() > 0) {
                $v = $employeeRolw->row(); ?>


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
                                                           required value="<?= $rol->roleID ?>" <?php if(in_array($rol->roleID,$emprolemap)){echo 'checked';}?> disabled=""><i></i> <?= $rol->roleName ?>
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
<?php
$this->load->view('admin/footer')?>