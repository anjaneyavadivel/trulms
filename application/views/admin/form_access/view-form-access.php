<div class="row"> 
    <?= form_open_multipart(base_url() . '#', array('id' => 'form4', 'name' => 'form4', 'role' => 'form', 'novalidate' => '')); ?>
    <!-- col -->
    <?php $this->load->view('admin/msg') ?>
    <div class="col-md-12">

        <section class="tile"> 

            <!-- tile header --> 
            <!-- /tile header --> 
            <div class="tile-header dvd dvd-btm bg-greensea">
                <h1 class="custom-font"><strong>View <?= $pageTitle ?> Setup</strong> </h1>

            </div>
            <!-- tile body -->
            <div class="tile-body">

 <?php if(isset($pageroleaccessmap) && $pageroleaccessmap->num_rows()>0){ $v=$pageroleaccessmap->row();?>
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="pageID">Form Name <span class="required">*</span></label>
                        <select name="pageID" id="pageID" tabindex="3" disabled="" class="form-control chosen-select">
                            <option value=""></option>
                            <?php
                            if (isset($pages) && $pages->num_rows() > 0) {
                                foreach ($pages->result() AS $page) {
                                    ?>
                                    <option value="<?= $page->pageID ?>" <?php if($v->pageID==$page->pageID){echo 'selected';}?>><?= ucwords($page->menuCaption); ?></option>
                                    <?php
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="roleID">Role Name <span class="required">*</span></label>
                        <select name="roleID" id="roleID" tabindex="3" disabled class="form-control chosen-select">
                            <option value=""></option>
                            <?php
                            if (isset($role) && $role->num_rows() > 0) {
                                foreach ($role->result() AS $rol) {
                                    ?>
                                    <option value="<?= $rol->roleID ?>" <?php if($v->roleID==$rol->roleID){echo 'selected';}?>><?= ucwords($rol->roleName); ?></option>
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
                                       value="1" disabled <?php if($v->createEnabled==1){echo 'checked';}?>><i></i> Create Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="viewEnabled" 
                                       data-parsley-trigger="change"
                                       value="1" disabled <?php if($v->viewEnabled==1){echo 'checked';}?>><i></i> View Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="modifyEnabled" 
                                       data-parsley-trigger="change"
                                       value="1" disabled <?php if($v->modifyEnabled==1){echo 'checked';}?>><i></i> Modify Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="approveEnabled" 
                                       data-parsley-trigger="change"
                                       value="1" disabled="" <?php if($v->approveEnabled==1){echo 'checked';}?>><i></i> Approve Permission
                            </label>

                        </div>
                        <div class="col-sm-2">

                            <label class="checkbox checkbox-custom-alt">
                                <input type="checkbox" name="deleteEnabled" 
                                       data-parsley-trigger="change"
                                       value="1" disabled="" <?php if($v->deleteEnabled==1){echo 'checked';}?>><i></i> Delete Permission
                            </label>

                        </div>
                    </div>

                </div>
<?php }?>
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
