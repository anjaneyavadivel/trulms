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
          <li> <a href="javascript::">Add Employee</a> </li>
        </ul>
      </div>
    </div>
    
    <!-- row -->
    <div class="row"> 
      <?=form_open_multipart(base_url().'add_employee ',array('id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
      <!-- col -->
      <div class="col-md-12"> 
        <?php $this->load->view('admin/msg')?>
        <!-- tile -->
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header --> 
          <div class="tile-header dvd bg-greensea dvd-btm">
                                    <h1 class="custom-font"><strong>Employee</strong> </h1>
                                    
                                </div>
          <!-- tile body -->
          <div class="tile-body">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="name">Emp Code <span class="required">*</span></label>
                <input type="text" name="empCode" id="empCode" class="form-control" placeholder="Enter Employee Code" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Name <span class="required">*</span> </label>
                <input type="text" name="empname" id="empname" class="form-control" placeholder="Enter Employee Name " required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Branch</label>
                               <select  name="branchID" id="branchID" required class="form-control" >
                <option value="">-- Select Branch --</option>
                <?php if(isset($branch) && $branch->num_rows()>0)
				foreach($branch->result() as $dep)
				{
					?>
                    <option value="<?=$dep->branchID?>"><?=$dep->name?></option>
                    <?php
				}
				?>
                </select>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Date Of Birth	 </label>
                                <input type="text" name="dob" id="dob"  class="form-control datepicker "  placeholder="MM-DD-YYYY" data-format="L" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            
            <div class="row">
            
            <div class="form-group col-md-3">
                <label for="name">Gender <span class="required">*</span> 	</label>
                 <select  name="sex" id="sex" required class="form-control" >
                <option value="">-- Select Gender --</option>
              
                    <option value="1">Male</option>
                     <option value="2">Fe-Male</option>
                      <option value="3">Others</option>
                    
                </select>
                  <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Father name <span class="required">*</span></label>
                <input type="text" name="fathername" id="fathername" required placeholder="Father name"class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">qualification </label>
                <input type="text" name="qualification" id="qualification"  placeholder=" Enter Qualification" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Department <span class="required">*</span></label>
                <select  name="deptid" id="deptid" required class="form-control" >
                <option value="">-- Select Department --</option>
                <?php if(isset($dept) && $dept->num_rows()>0)
				foreach($dept->result() as $dep)
				{
					?>
                    <option value="<?=$dep->deptID?>"><?=$dep->department?></option>
                    <?php
				}
				?>
                </select>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Designation <span class="required">*</span> </label>
                
                <select  name="designation" id="designation" required class="form-control" >
                <option value="">-- Select Designation --</option>
                <?php if(isset($desig) && $desig->num_rows()>0)
				foreach($desig->result() as $dep)
				{
					?>
                    <option value="<?=$dep->desigID?>"><?=$dep->name?></option>
                    <?php
				}
				?>
                </select>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Employee type <span class="required">*</span></label>
              
                <select  name="employeetype" id="employeetype" required class="form-control" >
                <option value="">-- Select Employeetype --</option>
                <?php if(isset($etype) && $etype->num_rows()>0)
				foreach($etype->result() as $dep)
				{
					?>
                    <option value="<?=$dep->employetypeID?>"><?=$dep->typename?></option>
                    <?php
				}
				?>
                </select>
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">Mobile Number <span class="required">*</span></label>
                <input type="text" name="mobile" id="mobile" placeholder=" Enter Mobile Number" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Emergency Contact Person </label>
                <input type="text" name="emergencycontactperson" id="emergencycontactperson" class="form-control"placeholder=" Enter Emergency Contact Person"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Emergency Contact </label>
                <input type="text" name="emergencycontact" id="emergencycontact" class="form-control" placeholder=" Enter Emergency Contact" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Mail office </label>
                <input type="email" name="mailoffice" id="mailoffice" class="form-control" placeholder=" Enter Mail office"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Mail Personal </label>
                <input type="email" name="mailpersonal" id="mailpersonal" class="form-control" placeholder=" Enter Mail Personal " data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Address Line 1 <span class="required">*</span></label>
                <input type="text" name="addressline1" id="addressline1" required class="form-control" placeholder=" Enter Address Line 1" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address Line 2  </label>
                <input type="text" name="addressline2" id="addressline2" placeholder=" Enter Address 2" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">City <span class="required">*</span></label>
                <input type="text" name="city" id="city" placeholder=" Enter City" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">State <span class="required">*</span></label>
                <input type="text" name="state" id="state" placeholder=" Enter State"required  class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Country <span class="required">*</span></label>
                <input type="text" name="country" id="country" class="form-control" required placeholder=" Enter Country"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Joining Date <span class="required">*</span></label>
               <input type="text" name="joiningdate" id="joiningdate" required class="form-control datepicker "  placeholder="MM-DD-YYYY" data-format="L" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Reporting to <span class="required">*</span></label>
                <input type="text" name="reportingto" id="reportingto" required class="form-control" placeholder=" Enter Reporting to"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
               <div class="form-group col-md-3">
                <label for="contactemail">Remarks </label>
                <input type="text" name="remarks" id="remarks" placeholder=" Enter Remarks" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">Releaving Date </label>
               
                 <input type="text" name="releavingdate" id="releavingdate" class="form-control datepicker "  placeholder="MM-DD-YYYY" data-format="L" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            
              
            </div>
            <div class="row">
            
              <div class="form-group col-md-3">
                <label for="name">Photo <span class="required">*</span></label>
                <input type="file" name="photo" id="photo" class="form-control" required  placeholder=" Enter Mail Personal " data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Proof 1 </label>
                <input type="file" name="proof1" id="proof1" class="form-control" placeholder=" Enter Address Line 1" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Proof 2 </label>
                <input type="file" name="proof2" id="proof2" placeholder=" Enter Proof  2" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              
              <!-- tile footer -->
            <div class="tile-footer text-right bg-tr-black lter col-md-3 dvd dvd-top"> 
              <!-- SUBMIT BUTTON -->
               <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>employee','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
              <input type="submit" class="btn btn-greensea" id="form4Submit" value="Submit" name="save">
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
    
  </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer')?>
