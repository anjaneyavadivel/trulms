<?php $this->load->view('admin/sidebar')?>
<!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
<!--/ RIGHTBAR Content -->
</div>

<section id="content">
  <div class="page page-forms-validate">
    <div class="pageheader">
      <h2>Vehicle Owner</h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="<?= base_url()?>vehicleowner">Vehicle Owner</a> </li>
          <li> <a href="javascript::">View Vehicle Owner</a> </li>
        </ul>
      </div>
    </div>
    
    <!-- row -->
    <?php if(isset($view) && $view->num_rows()>0){
		$v=$view->row();
		?>
    <div class="row">
      <!-- col -->
      <div class="col-md-12">
        <?php $this->load->view('admin/msg')?>
        <input type="hidden" name="ownerID" id="name" class="form-control" value="<?=$v->ownerID?>">
         <input type="hidden" name="contactID" id="contactID" class="form-control" value="<?=$v->contactID?>">
        <!-- tile -->
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header -->
          <div class="tile-header dvd bg-greensea dvd-btm">
            <h1 class="custom-font"><strong>Vehicle Owner</strong> </h1>
              <?php $pagealterpermission = pagealterpermission('vehicleowner', $alterPermission = '');
									 if(selfAllowed($pagealterpermission, 'selfEditAllowed', $v->createby) && checkpageaccess('vehicleowner',1,'modify')){?>
                                    <ul class="controls">
                                        
                                        <li><a href="<?= base_url()?>edit_vehicleowner/<?=$this->uri->segment(2)?>" title="Edit Vehicle Owner" role="button" tabindex="0" >Edit <i class="fa fa-pencil-square-o"></i></a></li>
                                    </ul>
                                     <?php }?>
          </div>
          <!-- tile body -->
          <div class="tile-body">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="name">Name <span class="required">*</span></label>
                <label><?=$v->name?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Alter Contact Person </label>
                <label><?=$v->contactPer2?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Company Name <span class="required">*</span> </label>
                <label><?=$v->companyName?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Contact  No-1 <span class="required">*</span> </label>
                <label><?=$v->phone1?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="name">Contact  No-2 </label>
                <label><?=$v->phone2?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1 <span class="required">*</span></label>
                <label><?=$v->email1?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-2 </label>
                <label><?=$v->email2?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Address 1 <span class="required">*</span> </label>
                <label><?=$v->addressline1?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 </label>
                <label><?=$v->addressline2?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">City </label>
                <label><?=$v->city?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">State </label>
                <label><?=$v->state?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Country </label>
                <label><?=$v->country?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Fax </label>
                <label><?=$v->fax?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Website </label>
                <label><?=$v->website?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="tile-footer text-right bg-tr-black col-md-6 lter dvd dvd-top"> 
                <!-- SUBMIT BUTTON --> 
                <!--<a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>vehicleowner','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>-->
                <a  href="<?= base_url()?>vehicleowner"  class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
              </div>
            </div>
          </div>
          <!-- /tile body --> 
          
        </section>
      </div>
      <!-- /col --> 
      
    </div>
    <?php } else{?>
    No REcords Found;
    <?php }?>
    <!-- /row --> 
    
  </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer')?>
