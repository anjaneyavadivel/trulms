<?php $this->load->view('admin/sidebar')?>
<!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
<!--/ RIGHTBAR Content -->
</div>

<section id="content">
  <div class="page page-forms-validate">
    <div class="pageheader">
      <h2>Driver</h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="<?= base_url()?>driver">Driver</a> </li>
          <li> <a href="javascript::">Update Driver</a> </li>
        </ul>
      </div>
    </div>
    <?php if(isset($view) && $view->num_rows()>0){$v=$view->row();?>
    <!-- row -->
    <div class="row"> 
      <?=form_open_multipart(base_url().'edit_driver/'.$v->driverID,array('id'=>'add_driver','role'=>'form'));?>
      <!-- col -->
      <div class="col-md-12"> 
        <?php $this->load->view('admin/msg')?>
        <!-- tile -->
        <section class="tile"> 
          <input type="hidden" name="contactID" id="contactID"  value="<?=$v->contactID?>" />
          <input type="hidden" name="driverID" id="driverID"  value="<?=$v->driverID?>" />
          <input type="hidden" name="dlImage1" id="dlImage1"  value="<?=$v->dlImage?>" />
          <!-- tile header --> 
          <!-- /tile header --> 
          <div class="tile-header dvd bg-greensea dvd-btm">
                                    <h1 class="custom-font"><strong>Driver</strong> </h1>
                                    
                                </div>
          <!-- tile body -->
          <div class="tile-body">
            <div class="row">
            
              <div class="form-group col-md-3">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name of Consignor" required=""  value="<?=$v->name?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Company Name <span class="required">*</span> </label>
                <input type="text" name="companyName" id="name" class="form-control" placeholder="Name of Company" required=""  value="<?=$v->companyName?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Contact  No-1	</label>
                <input type="text" name="phone1" id="name" class="form-control"  placeholder=" Enter Contact  No-1"  value="<?=$v->phone1?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="name">Lisense No <span class="required">*</span></label>
                <input type="text" name="dlno" id="dlno"required placeholder=" Enter Lisense" reqiired class="form-control"   value="<?=$v->dlno?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            
            <div class="row">
            
            <div class="form-group col-md-3">
                <label for="name">Contact  No-2 </label>
                <input type="text" name="phone2" id="name" class="form-control"  placeholder=" Enter Contact  No-2 "  value="<?=$v->phone2?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1 </label>
                <input type="email" name="email1" id="contactemail"  placeholder=" Enter Email ID-1"class="form-control" value="<?=$v->email1?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-2 </label>
                <input type="email" name="email2" id="contactemail"  placeholder=" Enter Email ID-2" class="form-control" value="<?=$v->email2?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Gender <span class="required">*</span> 	</label>
                 <select  name="sex" id="sex" required class="form-control" >
                <option value="">-- Select Gender --</option>
              
                    <option value="1" <?php if($v->sex==1){?> selected="selected"<?php }?>>Male</option>
                     <option value="2" <?php if($v->sex==2){?> selected="selected"<?php }?>>Fe-Male</option>
                      <option value="3" <?php if($v->sex==3){?> selected="selected"<?php }?>>Others</option>
                    
                </select>
                  <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
             
            </div>
            <div class="row">
            
              <div class="form-group col-md-3">
                <label for="contactemail">Address 1 <span class="required">*</span> </label>
                <input type="text" name="addressline1" id="contactemail" placeholder=" Enter Address 1" required class="form-control" value="<?=$v->addressline1?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 </label>
                <input type="text" name="addressline2" id="contactemail" placeholder=" Enter Address 2" class="form-control" value="<?=$v->addressline2?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">City  <span class="required">*</span></label>
                <input type="text" name="city" id="contactemail" placeholder=" Enter City" required  class="form-control" value="<?=$v->city?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">State  <span class="required">*</span></label>
                <input type="text" name="state" id="name" class="form-control"required placeholder=" Enter State"   value="<?=$v->state?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Country  <span class="required">*</span></label>
                <input type="text" name="country" id="name" class="form-control" required placeholder=" Enter Country"  value="<?=$v->country?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Fax </label>
                <input type="text" name="fax" id="name" class="form-control" placeholder=" Enter Fax"   value="<?=$v->fax?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Website </label>
                <input type="text" name="website" id="name" class="form-control" placeholder=" Enter Website"  value="<?=$v->website?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Lisence Date </label>
                <input type="text" name="dlexpirydt" id="dlexpirydt"  class="form-control datepicker "  placeholder="MM-DD-YYYY" data-format="L" value="<?=date('m-d-Y',strtotime($v->dlexpirydt))?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
              
            </div>
            <div class="row">
            
              <div class="form-group col-md-3">
                <label for="contactemail">Lisense Image </label>
                <input type="file" name="dlImage" id="dlImage"  class="form-control">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
              
              <div class="form-group col-md-3">
              
              </div>
              <div class="form-group col-md-3">
              
              </div>
              
            </div>
            <div class="row">
            
              <div class="form-group col-md-3">
              
                
                <img src="<?=base_url()?>uploads/photo/<?=$v->dlImage?>" height="70" width="70" />
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
              <div class="form-group col-md-3">
              
              </div>
              <div class="form-group col-md-3">
              
              </div>
              
            <div class="tile-footer text-right bg-tr-black lter col-md-3 dvd dvd-top"> 
              <!-- SUBMIT BUTTON -->
              <!-- <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>driver','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
 -->
   <a  href="<?= base_url()?>driver"  class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>            
   
     <input type="submit" class="btn bg-greensea" id="add_form" value="Update Driver" >
                                   
                                   <a  href="javascript::" data-toggle="modal" data-target="#form-submit" id="form_submiting" data-options="splash-2 splash-ef-11" role="button" tabindex="0"  onclick="form_action_msg(1)"  class="btn btn-greensea" style="display:none">Submit</a>
                                    <input type="submit" class="btn btn-default" id="new_button" onclick="form_submit('add_driver')" value="Submit" style="display:none" >
            </div>
             
            
               
              
              
            </div>
            
          </div>
          <!-- /tile body --> 
          
        </section>
      </div>
      
      
      
      <?php echo form_close(); ?> 
      <!-- /col --> 
      
    </div>
    <!-- /row --> 
    <?php }else{?>
    They Have No Records Found
    <?php }?>
    
  </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer')?>
