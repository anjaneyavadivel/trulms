<?php $this->load->view('admin/sidebar')?>
<!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
<!--/ RIGHTBAR Content -->
</div>

<section id="content">
  <div class="page page-forms-validate">
    <div class="pageheader">
      <h2>Employee</h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="<?= base_url()?>employee">Employee</a> </li>
          <li> <a href="javascript::">View Employee</a> </li>
        </ul>
      </div>
    </div>
    
    <!-- row -->
    <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>
    <div class="row"> 
      <!-- col -->
      <div class="col-md-3">

                                <!-- tile -->
                                <section class="tile tile-simple">

                                    <!-- tile widget -->
                                    <div class="tile-widget p-30 text-center">

                                        <div class="thumb thumb-xl">
                                           
                                            <?php $img_url=base_url()."uploads/photo/".$v->photo;
											if (@getimagesize($img_url))
											{
												?>
												 <img class="img-circle" src="<?=$img_url?>" alt="profile photo">
												 <?php
											}
											else
											{
												?>
												 <img class="img-circle" src="<?=base_url()?>uploads/photo/no_image.jpg" alt="profile photo">
												<?php 
											}
											?>
                                        </div>
                                        <h4 class="mb-0"><strong><?=$v->empname?></strong></h4>
                                        <span class="text-muted"><?php if(isset($desig) && $desig->num_rows()>0)
                                                            foreach($desig->result() as $dep)
                                                            {
                                                                if($v->designation==$dep->desigID){?><?=$dep->name?>
                                                                <?php }
                                                            }
                                                            ?></span>
                                        

                                    </div>
                                    <!-- /tile widget -->

                                    <!-- tile body -->
                                    
                                    <!-- /tile body -->

                                </section>
                                <!-- /tile -->

                                <!-- tile -->
                                <section class="tile tile-simple">

                                    <!-- tile header -->
                                    <div class="tile-header">
                                        <h1 class="custom-font"><strong>My</strong> Profile</h1>
                                    </div>
                                    <!-- /tile header -->

                                    <!-- tile body -->
                                    <div class="tile-body">

                                        <ul class="list-unstyled">

                                            <li>
                                                <div class="row">
                                                    
                                                    <div class="col-md-12">
                                                        <div class="progress progress-striped not-rounded">
                                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                                100%
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /tile body -->
                                </section>
                                <!-- /tile -->
                            </div>
      <div class="col-md-9"> 
        <?php $this->load->view('admin/msg')?>
        <!-- tile -->
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header --> 
          <div class="tile-header dvd bg-greensea dvd-btm">
                                    <h1 class="custom-font"><strong>View Employee</strong> </h1>
                                    <?php $pagealterpermission = pagealterpermission('department', $alterPermission = '');
									 if(selfAllowed($pagealterpermission, 'selfEditAllowed', $v->createby) && checkpageaccess('employee',1,'modify')){?>
                                    <ul class="controls">
                                        
                                        <li><a href="<?= base_url()?>edit_employee/<?=$this->uri->segment(2)?>" title="Edit Employee" role="button" tabindex="0" >Edit  <i class="fa fa-pencil-square-o"></i></a></li>
                                    </ul>
                                     <?php }?>
                                </div>
          <!-- tile body -->
          <div class="tile-body">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="name">Emp Code  : </label>
                <label  ><?=$v->empCode?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Name  :  </label>
                <label ><?=$v->empname?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Branch: </label>
               <label  >
                <?php if(isset($branch) && $branch->num_rows()>0)
				foreach($branch->result() as $dep)
				{
					?>
                   <?php if($v->branchID==$dep->branchID){?> <?=$dep->name?><?php }?>
                    <?php
				}
				?>
                </label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Date Of Birth	  : </label>
                                <label  ><?=date('m-d-Y',strtotime($v->dob))?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            
            <div class="row">
            
            <div class="form-group col-md-3">
                <label for="name">Gender  :  	</label>
                 <label > <?php if($v->sex==1){?> Male<?php }?>
                     <?php if($v->sex==2){?> Fe-Male<?php }?>
                       <?php if($v->sex==3){?> Others<?php }?></label>
                    
                
                  <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Father name  : </label>
                <label ><?=$v->fathername?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">qualification  : </label>
                <label  ><?=$v->qualification?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Department  : </label>
                <label  >
                <?php if(isset($dept) && $dept->num_rows()>0)
				foreach($dept->result() as $dep)
				{
					?>
                   <?php if($v->deptid==$dep->deptID){?> <?=$dep->department?><?php }?>
                    <?php
				}
				?>
                </label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Designation  :  </label>
                
                <label >
                <?php if(isset($desig) && $desig->num_rows()>0)
				foreach($desig->result() as $dep)
				{
					?>
                   <?php if($v->designation==$dep->desigID){?> 	<?=$dep->name?><?php }?>
                    <?php
				}
				?>
                </option>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Employee type  : </label>
              
                <label>
                <?php if(isset($etype) && $etype->num_rows()>0)
				foreach($etype->result() as $dep)
				{
					?>
                    <?php if($v->employeetype==$dep->employetypeID){?> <?=$dep->typename?><?php }?>
                    <?php
				}
				?>
               </label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">Mobile Number  : </label>
                <label ><?=$v->mobile?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Emergency Contact Person  : </label>
                <label ><?=$v->emergencycontactperson?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Emergency Contact  : </label>
                <label><?=$v->emergencycontact?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Mail office  : </label>
                <label ><?=$v->mailoffice?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Mail Personal  : </label>
                <label ><?=$v->mailpersonal?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Address Line 1  : </label>
                <label><?=$v->addressline1?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address Line 2   : </label>
                <label ><?=$v->addressline2?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">City  : </label>
                <label ><?=$v->city?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">State  : </label>
                <label ><?=$v->state?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Country  : </label>
                <label ><?=$v->country?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Joining Date  : </label>
               <label ><?=date('m-d-Y',strtotime($v->joiningdate))?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <?php 
														 
														  $id	=	$v->reportingto;
		$roled		=	$this->Commonsql_model->select('tblemprolemap',array('dbentrystateID >'=>STATEID,'active'=>1));
		$emplyoee_id=	array();
		if($roled->num_rows()>0)
		{
			foreach($roled->result() as $rr)
			{
				$emplyoee_id[]	=	$rr->empID;
			}
		}
		$emp_role=0;
		if(!empty($emplyoee_id))
		{
			$emplyoee	=	$this->Commonsql_model->where_in('tblemployee', array('branchID'=>$this->session->userdata('SESS_userBranchID'),'dbentrystateID >'=>STATEID,'active'=>1),'empID,empname', 'empID', $emplyoee_id);
			if($emplyoee->num_rows()>0)
					{
						foreach($emplyoee->result() as $emp)
						{
							 if($v->reportingto==$emp->empID)
							 {
								 $emp_role=$emp->empID;
							 }
						}
					}
		}
														  
  ?>
              
               <div class="form-group col-md-3">
                <label for="name">Reporting to (ROLE) : </label>
                <label ><?php if(isset($role) && $role->num_rows()>0)
				foreach($role->result() as $roles)
				{
					?>
                   <?php if($roles->roleID==$emp_role){ echo $roles->roleName;}?></option>
                    <?php
				}
				?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
               <div class="form-group col-md-3">
                <label for="name">Reporting to  : </label>
                <label ><?php
				if(!empty($emplyoee_id))
				{
					?>
					<?php
					if($emplyoee->num_rows()>0)
					{
						foreach($emplyoee->result() as $emp)
						{
							?>
							 <?php if($v->reportingto==$emp->empID){ echo $emp->empname;}?>
							<?php
						}
					}
				}
				?></label>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
               <div class="form-group col-md-3">
                <label for="contactemail">Remarks  : </label>
                <label ><?=$v->remarks?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              
              
            
              
            </div>
            
            <div class="row">
            
              <div class="form-group col-md-3">
              <?php $img_url=base_url()."uploads/photo/".$v->photo;
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
               
                <?php $img_url=base_url()."uploads/proof/".$v->proof1;
				if (@getimagesize($img_url))
				{
					?>
					<img src="<?=$img_url?>" height="70" width="70" />
					 <?php
				}
				else
				{
					?>
					<img src="<?=base_url()?>uploads/proof/no_image.jpg" height="70" width="70" />
					<?php 
				}
				?>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
               
                <?php $img_url=base_url()."uploads/proof/".$v->proof2;
				if (@getimagesize($img_url))
				{
					?>
					<img src="<?=$img_url?>" height="70" width="70" />
					 <?php
				}
				else
				{
					?>
					<img src="<?=base_url()?>uploads/proof/no_image.jpg" height="70" width="70" />
					<?php 
				}
				?>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              
          
              
            </div>
            <div class="row">
               <div class="form-group col-md-3">
              <?php $img_url=base_url()."uploads/photo/".$v->photo;
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
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <?php $img_url=base_url()."uploads/proof/".$v->proof1;
				if (@getimagesize($img_url))
				{
					?>
					<a href="<?=$img_url?>" target="_blank">Download Image</a>
					 <?php
				}
				else
				{
					?>
					<a href="<?=base_url()?>uploads/proof/no_image.jpg" target="_blank">Download Image</a>
					<?php 
				}
				?>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
               <?php $img_url=base_url()."uploads/proof/".$v->proof2;
				if (@getimagesize($img_url))
				{
					?>
					<a href="<?=$img_url?>" target="_blank">Download Image</a>
					 <?php
				}
				else
				{
					?>
					<a href="<?=base_url()?>uploads/proof/no_image.jpg" target="_blank">Download Image</a>
					<?php 
				}
				?>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Releaving Date  : </label>
               
                 <label ><?=date('m-d-Y',strtotime($v->releavingdate))?></label>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="tile-footer text-right bg-tr-black lter col-md-12 dvd dvd-top"> 
              <!-- SUBMIT BUTTON -->
              <!-- <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onClick="active_deactive_class('<?= base_url()?>employee','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>-->
               <a  href="<?= base_url()?>employee"  class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
             
            </div>
             </div>
            
          </div>
          <!-- /tile body --> 
          
        </section>
      </div>
      
      
      
      <?php echo form_close(); ?> 
      <!-- /col --> 
      
    </div>
    <?php }else{?>
    No Records Found
    <?php }?>
    <!-- /row --> 
    
  </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer')?>
