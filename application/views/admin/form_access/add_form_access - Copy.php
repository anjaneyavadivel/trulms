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
            <h2>Add <?= $pageTitle ?> Setup</h2>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="<?= base_url() ?>"><i class="fa fa-home"></i> HOME</a> </li>
                    <li> <a href="<?= base_url() ?>employee-role"><?= $pageTitle ?> Setup</a> </li>
                    <li> <a href="javascript::">Add <?= $pageTitle ?> Setup</a> </li>
                </ul>
            </div>
        </div>

        <!-- row -->
        <div class="row"> 
            <?= form_open_multipart(base_url() . 'add-employee-role', array('id' => 'form4', 'role' => 'form', 'data-parsley-validate' => '')); ?>
            <!-- col -->
            <?php $this->load->view('admin/msg') ?>
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
                                <select name="empID" id="empID" tabindex="3" required class="form-control chosen-select">
                                    <option value=""></option>
                                    <?php
                                    if (isset($employee) && $employee->num_rows() > 0){
                                        foreach ($employee->result() AS $emp) {
                                            ?>
                                    <option value="<?= $emp->empID ?>"><?= ucwords($emp->empCode .' / '.$emp->empname .' / '.$emp->department .' / '.$emp->name);?></option>
                                            <?php
                                    }}
                                    ?>

                                </select>
                            </div>
                            
                        </div>

                        <div class="row">
                            <hr class="line-dashed line-full"/>
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Access Role <span class="required">*</span></label>
                                 <?php
                                    if (isset($role) && $role->num_rows() > 0){
                                        foreach ($role->result() AS $rol) {
                                            ?>
                                <div class="col-sm-2">

                                    <label class="checkbox checkbox-custom-alt">
                                        <input type="checkbox" name="accessrole[]" 
                                                       data-parsley-trigger="change"
                                                       required value="<?= $rol->roleID ?>"><i></i> <?= $rol->roleName ?>
                                    </label>

                                </div>
                                <?php
                                    }}
                                    ?>
                            </div>

                        </div>

                    </div>
                    <!-- /tile body --> 

                </section>
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
                                     <a href="<?=base_url().'employee-role'?>" class="btn btn-warning "><i class="fa fa-hand-o-left"></i> Go Back</a>
                            <input type="submit" class="btn btn-greensea" id="form4Submit" value="Submit" name="save">
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
