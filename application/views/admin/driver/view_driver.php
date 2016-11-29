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
          <li> <a href="javascript::">View Driver</a> </li>
        </ul>
      </div>
    </div>
    <?php if(isset($view) && $view->num_rows()>0){$v=$view->row();?>
    <!-- row -->
    <div class="row"> 
      <?=form_open_multipart(base_url().'edit_driver/'.$v->driverID,array('id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
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
                                     <?php $pagealterpermission = pagealterpermission('driver', $alterPermission = '');
									 if(selfAllowed($pagealterpermission, 'selfEditAllowed', $v->createby) && checkpageaccess('driver',1,'modify')){?>
                                    <ul class="controls">
                                        
                                        <li><a href="<?= base_url()?>edit_driver/<?=$this->uri->segment(2)?>" title="Edit driver" role="button" tabindex="0" >Edit  <i class="fa fa-pencil-square-o"></i></a></li>
                                    </ul>
                                     <?php }?>
                                </div>
          <!-- tile body -->
          <div class="tile-body">
            <div class="row">
            
              <div class="form-group col-md-3">
                <label for="name">Name :</label>
                <label><?=$v->name?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Company Name : </label>
                <label><?=$v->companyName?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Contact  No-1	: </label>
                <label><?=$v->phone1?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="name">Lisense No :</label>
                <label><?=$v->dlno?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            
            <div class="row">
            
            <div class="form-group col-md-3">
                <label for="name">Contact  No-2 :</label>
                <label><?=$v->phone2?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1 :</label>
                <label><?=$v->email1?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-2 :</label>
                <label><?=$v->email2?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Gender  :  	</label>
                 <label > <?php if($v->sex==1){?> Male<?php }?>
                     <?php if($v->sex==2){?> Fe-Male<?php }?>
                       <?php if($v->sex==3){?> Others<?php }?></label>
                    
                
                  <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
             
            </div>
            <div class="row">
            
              <div class="form-group col-md-3">
                <label for="contactemail">Address 1 : </label>
                <label><?=$v->addressline1?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 : </label>
                <label><?=$v->addressline2?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">City : </label>
                <label><?=$v->city?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">State : </label>
                <label><?=$v->state?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Country : </label>
                <label><?=$v->country?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Fax:  </label>
                <label><?=$v->fax?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Website:  </label>
                <label><?=$v->website?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Lisence Date : </label>
                <label><?=date('m-d-Y',strtotime($v->dlexpirydt))?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
              
            </div>
            <div class="row">
            
              <div class="form-group col-md-3">
                <label for="contactemail">Lisense Image :</label>
                <?php $img_url=base_url()."uploads/photo/".$v->dlImage;
				if (@getimagesize($img_url))
				{
					?>
					<a href="<?=$img_url?>" target="_blank">Download Image</a>
					 <?php
				}
				else
				{
					?>
					<a href="<?=base_url()?>uploads/photo/no_image.jpg" target="_blank">Download Image</a>
					<?php 
				}
				?>
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
              <?php $img_url=base_url()."uploads/photo/".$v->dlImage;
				if (@getimagesize($img_url))
				{
					?>
					<img src="<?=$img_url?>" height="70" width="70" />
					 <?php
				}
				else
				{
					?>
					<img src="<?=base_url()?>uploads/photo/no_image.jpg" height="70" width="70" />
					<?php 
				}
				?>
                
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
              <div class="form-group col-md-3">
              
              </div>
              <div class="form-group col-md-3">
              
              </div>
              
            <div class="tile-footer text-right bg-tr-black lter col-md-3 dvd dvd-top"> 
              <!-- SUBMIT BUTTON -->
               <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>driver','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
             
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
