<div class="row"> 
    <?= form_open_multipart(base_url() . 'add-form-access', array('id' => 'form4', 'name' => 'form4', 'role' => 'form', 'data-parsley-validate' => '')); ?>
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
                        <label for="pageID">Form Name <span class="required">*</span></label>
                        <select name="pageID" id="pageID" tabindex="3" required class="form-control chosen-select">
                            <option value=""></option>
                            <?php
                            if (isset($pages) && $pages->num_rows() > 0) {
                                foreach ($pages->result() AS $page) {
                                    ?>
                                    <option value="<?= $page->pageID ?>"><?= ucwords($page->menuCaption); ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="roleID">Role Name <span class="required">*</span></label>
                        <select name="roleID" id="roleID" tabindex="3" required class="form-control chosen-select">
                            <option value=""></option>
                            <?php
                            if (isset($role) && $role->num_rows() > 0) {
                                foreach ($role->result() AS $rol) {
                                    ?>
                                    <option value="<?= $rol->roleID ?>"><?= ucwords($rol->roleName); ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>

                </div>

                <div class="row">
                    <hr class="line-dashed line-full"/>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Access Permission</label>
                       
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="createEnabled" 
                                       data-parsley-trigger="change"
                                       value="1" checked=""><i></i> Create Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="viewEnabled" 
                                       data-parsley-trigger="change"
                                       value="1" checked=""><i></i> View Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="modifyEnabled" 
                                       data-parsley-trigger="change"
                                       value="1" checked=""><i></i> Modify Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="approveEnabled" 
                                       data-parsley-trigger="change"
                                       value="1"><i></i> Approve Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="deleteEnabled" 
                                       data-parsley-trigger="change"
                                       value="1"><i></i> Delete Permission
                            </label>

                        </div>
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
                    <span id="form4SubmitMsg"></span>
                    <!-- SUBMIT BUTTON -->
                    <a href="javascript:void(0);" class="btn btn-warning form4SubmitClose"><i class="fa fa-times-circle"></i> Close</a>
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
