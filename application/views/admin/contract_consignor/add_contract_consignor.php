<?php $this->load->view('admin/sidebar')?>
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
      <h2>Contract Consignor</h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="<?= base_url()?>contract-consignor">Contract Consignor</a> </li>
          <li> <a href="javascript::">Add Contract Consignor</a> </li>
        </ul>
      </div>
    </div>
    
    <!-- row -->
    <div class="row"> 
      <?=form_open_multipart(base_url().'add_designation',array('id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
      <!-- col -->
      <div class="col-md-12"> 
        
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
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" name="name" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Company Name <span class="required">*</span> </label>
                <input type="text" name="companyName" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Alter Contact Person </label>
                <input type="email" name="contactPer1" id="contactemail" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Contact  No-1	<span class="required">*</span> </label>
                <input type="text" name="phone1" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            
            <div class="row">
            
            <div class="form-group col-md-3">
                <label for="name">Contact  No-2 </label>
                <input type="text" name="phone1" id="name" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1 <span class="required">*</span></label>
                <input type="email" name="email1" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-2 </label>
                <input type="email" name="email2" id="contactemail"  class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">CST/LST/TIN No</label>
                <input type="text" name="name" id="name" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address 1 <span class="required">*</span> </label>
                <input type="email" name="city" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 </label>
                <input type="email" name="city" id="contactemail" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">city </label>
                <input type="email" name="city" id="contactemail"  class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">state </label>
                <input type="text" name="state" id="name" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Country </label>
                <input type="text" name="companyName" id="name" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Fax </label>
                <input type="text" name="name" id="name" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Website </label>
                <input type="text" name="website" id="name" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
            </div>
            
          </div>
          <!-- /tile body --> 
          
        </section>
      </div>
      <div class="col-md-6">
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header --> 
          <div class="tile-header dvd dvd-btm bg-greensea">
                                    <h1 class="custom-font"><strong>Contact Details</strong> </h1>
                                    
                                </div>
          <!-- tile body -->
          <div class="tile-body">
           
             
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">From </label>
                <input type="text" name="from" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">To </label>
                <input type="email" name="to" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">TruckLength [Feet] </label>
                <input type="text" name="vehicleLength" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Weight[Kgs]</label>
                <input type="email" name="vehicleCapacity" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Vehicle Type</label>
                <input type="email" name="dated" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">RoadType</label>
                <input type="text" name="signedby" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Contract Date</label>
                <input type="email" name="dated" id="contactemail" required class="form-control datepicker " data-format="L" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Contract Signed By</label>
                <input type="text" name="signedby" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="message">Special Instructions </label>
                <textarea class="form-control" rows="1" name="roadType" id="message" placeholder="Type your message" required="" data-parsley-id="2766"></textarea>
                <ul class="parsley-errors-list" id="parsley-id-2766">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="col-sm-10 control-label">Handling Charges</label>
                <div class="col-sm-1">
                  <div class="onoffswitch labeled  greensea inline-block">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch01" checked="">
                    <label class="onoffswitch-label" for="switch01"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-sm-10 control-label">State/Permit Charges</label>
                <div class="col-sm-1">
                  <div class="onoffswitch labeled  greensea inline-block">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch02" checked="">
                    <label class="onoffswitch-label" for="switch02"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="col-sm-10 control-label">Door PickUp/Delivery Charge</label>
                <div class="col-sm-2">
                  <div class="onoffswitch labeled  greensea inline-block">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch03" checked="">
                    <label class="onoffswitch-label" for="switch03"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-sm-10 control-label">To Pay Charge</label>
                <div class="col-sm-2">
                  <div class="onoffswitch labeled greensea inline-block">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch04" checked="checked">
                    <label class="onoffswitch-label" for="switch04"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="col-sm-10 control-label">CheckPost Exepense</label>
                <div class="col-sm-2">
                  <div class="onoffswitch labeled greensea inline-block">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch05" checked="">
                    <label class="onoffswitch-label" for="switch05"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label class="col-sm-10 control-label">Service Tax</label>
                <div class="col-sm-2">
                  <div class="onoffswitch labeled  greensea inline-block">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="switch06" checked="">
                    <label class="onoffswitch-label" for="switch06"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /tile body --> 
          
        </section>
        <!-- /tile --> 
        
        <!-- tile --> 
        
        <!-- /tile --> 
        
      </div>
      <div class="col-md-6">
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header --> 
          <div class="tile-header bg-greensea dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Freight Charges</strong> </h1>
                                    
                                </div>
          <!-- tile body -->
          <div class="tile-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Basic Freight </label>
                <input type="text" name="name" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Docket Charges </label>
                <input type="email" name="contactemail" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Handling Charges </label>
                <input type="text" name="name" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">State/Permit Charges </label>
                <input type="email" name="contactemail" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Pickup/Delivery Charges </label>
                <input type="email" name="contactemail" id="contactemail"required  class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">To pay Charge </label>
                <input type="text" name="name" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">CheckPost Expense </label>
                <input type="email" name="contactemail" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">COD/DOD Charges </label>
                <input type="email" name="contactemail" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
            </div>
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="name">MISC Charges </label>
                <input type="text" name="name" id="name" class="form-control" required data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Sub Total </label>
                <input type="email" name="contactemail" id="contactemail" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="name">Service Tax </label>
                <input type="text" name="name" id="name" class="form-control" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Contract Sign by </label>
                <input type="text" name="name" id="name" class="form-control" required data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
          </div>
          <!-- /tile body --> 
          
        </section>
        <!-- /tile --> 
        
        <!-- tile --> 
        
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
<?php $this->load->view('admin/footer')?>
