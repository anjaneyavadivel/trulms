	
<?php $this->load->view('admin/sidebar')?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: 190px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
	color: #616f77;
		outline: 0;
		vertical-align: top;
		background-color: #fff;
		filter: none !important;
		-webkit-box-shadow: none;
		box-shadow: none;
		border-radius: 2px;
		border: 1px solid #dbe0e2;
		-webkit-transition: all 0.2s linear;
		-moz-transition: all 0.2s linear;
		transition: all 0.2s linear;
		width:110%
  }
  </style>

<!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
<!--/ RIGHTBAR Content -->
</div>

<section id="content">
  <div class="page page-forms-validate">
    <div class="pageheader">
      <h2>Consignor</h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="<?= base_url()?>consignor">Consignor</a> </li>
          <li> <a href="javascript::">Add Consignor</a> </li>
        </ul>
      </div>
    </div>
    
    <!-- row -->
    <div class="row"> 
      <?=form_open_multipart(base_url().'add-consignor',array('id'=>'add_vehicleowner','role'=>'form'));?>
      <!-- col -->
      <div class="col-md-12"> 
        <?php $this->load->view('admin/msg')?>
        <!-- tile -->
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header --> 
          <div class="tile-header dvd bg-greensea dvd-btm">
                                    <h1 class="custom-font"><strong>Consignor</strong> </h1>
                                    
                                </div>
          <!-- tile body -->
          <div class="tile-body">
           <div class="row">
           <div class="form-group col-md-3">
                <label for="contactemail">Name <span class="required">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder=" Enter Alter Contact Person" >
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="contactemail">Alter Contact Person </label>
                <input type="text" name="contactPer2" id="contactemail" class="form-control" placeholder=" Enter Alter Contact Person" >
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">CST/LST/TIN No</label>
                <input type="text" name="csttinno" id="name" placeholder=" Enter CST/LST/TIN No" class="form-control"  >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Company Name <span class="required">*</span> </label>
                <input type="text" name="companyName" id="companyName" class="form-control" placeholder="Name of Company" required="" >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              </div>
            
            <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Contact  No-1	</label>
                <input type="text" name="phone1" id="name" class="form-control"  placeholder=" Enter Contact  No-1" >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            <div class="form-group col-md-3">
                <label for="name">Contact  No-2 </label>
                <input type="text" name="phone2" id="name" class="form-control"  placeholder=" Enter Contact  No-2 " >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1</label>
                <input type="email" name="email1" id="contactemail"  placeholder=" Enter Email ID-1"class="form-control" >
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-2 </label>
                <input type="email" name="email2" id="contactemail"  placeholder=" Enter Email ID-2" class="form-control" >
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
             
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address 1 <span class="required">*</span> </label>
                <input type="text" name="addressline1" id="addressline1" placeholder=" Enter Address 1" required class="form-control" >
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 </label>
                <input type="text" name="addressline2" id="contactemail" placeholder=" Enter Address 2" class="form-control" >
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">City  <span class="required">*</span> </label>
                <input type="text" name="city" id="city" placeholder=" Enter City" required class="form-control" >
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">State  <span class="required">*</span></label>
                <input type="text" name="state" id="state" class="form-control"placeholder=" Enter State"  required >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Country  <span class="required">*</span></label>
                <input type="text" name="country" id="country" class="form-control" placeholder=" Enter Country" required >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Fax </label>
                <input type="text" name="fax" id="name" class="form-control" placeholder=" Enter Fax"   >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Website </label>
                <input type="text" name="website" id="name" class="form-control" placeholder=" Enter Website" >
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
              <div class="tile-footer text-right bg-tr-black lter  col-md-3 dvd dvd-top"> 
              <!-- SUBMIT BUTTON -->
              <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>consignor','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
             <input type="submit" class="btn bg-greensea" id="add_form" value="Add Consignor" >
                                   
                                   <a  href="javascript::" data-toggle="modal" data-target="#form-submit" id="form_submiting" data-options="splash-2 splash-ef-11" role="button" tabindex="0"  class="btn btn-greensea" style="display:none">Submit</a>
                                    <input type="submit" class="btn btn-default" id="new_button" onclick="form_submit('add_vehicleowner')" value="Submit" style="display:none" >
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
<div class="map_canvas"></div>
    <br>
     <div class="map_canvas1"></div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer')?>

 