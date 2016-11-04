
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

                        <h2>Approve Employee Types </h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a>
                                </li>
                                
                                 <li>
                                    <a href="<?= base_url()?>employee_types">Employee Types</a>
                                </li>
                                
                                <li>
                                    <a href="javascript::">Approve Employee Types</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>


                    <!-- row -->
 <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>
    <div class="row"> 
      <?=form_open_multipart(base_url().'approve-contract-consignor/'.$v->consignorID,array('id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
      <!-- col -->
      <div class="col-md-12"> 
        <?php $this->load->view('admin/msg')?>
        <input type="hidden" name="consignorID" id="name" class="form-control" value="<?=$v->consignorID?>">
         <input type="hidden" name="contactID" id="contactID" class="form-control" value="<?=$v->contactID?>">
          <input type="hidden" name="contractID" id="contractID" class="form-control" value="<?=$v->contractID?>">
          <input type="hidden" name="contractVersionMapID" id="" class="form-control" value="<?=$v->contractVersionMapID?>">
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
                <input type="text" name="name" id="name" class="form-control" placeholder="Name of Consignor" required="" data-parsley-id="8057" value="<?=$v->name?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Company Name <span class="required">*</span> </label>
                <input type="text" name="companyName" id="name" class="form-control" placeholder="Name of Company" required="" data-parsley-id="8057"  value="<?=$v->companyName?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Alter Contact Person </label>
                <input type="text" name="contactPer2" id="contactemail" class="form-control" placeholder=" Enter Alter Contact Person" data-parsley-id="1328"  value="<?=$v->contactPer2?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Contact  No-1	<span class="required">*</span> </label>
                <input type="text" name="phone1" id="name" class="form-control" required="" placeholder=" Enter Contact  No-1" data-parsley-id="8057"  value="<?=$v->phone1?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            
            <div class="row">
            
            <div class="form-group col-md-3">
                <label for="name">Contact  No-2 </label>
                <input type="text" name="phone2" id="name" class="form-control"  placeholder=" Enter Contact  No-2 " data-parsley-id="8057"  value="<?=$v->phone2?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1 <span class="required">*</span></label>
                <input type="email" name="email1" id="contactemail" required placeholder=" Enter Email ID-1"class="form-control" data-parsley-id="1328"  value="<?=$v->email1?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-2 </label>
                <input type="email" name="email2" id="contactemail"  placeholder=" Enter Email ID-2" class="form-control" data-parsley-id="1328"  value="<?=$v->email2?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">CST/LST/TIN No</label>
                <input type="text" name="csttinno" id="name" placeholder=" Enter CST/LST/TIN No" class="form-control"  data-parsley-id="8057"  value="<?=$v->csttinno?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address 1 <span class="required">*</span> </label>
                <input type="text" name="addressline1" id="contactemail" placeholder=" Enter Address 1" required class="form-control" data-parsley-id="1328"  value="<?=$v->addressline1?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 </label>
                <input type="text" name="addressline2" id="contactemail" placeholder=" Enter Address 2" class="form-control" data-parsley-id="1328"  value="<?=$v->addressline2?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">City </label>
                <input type="text" name="city" id="contactemail" placeholder=" Enter City"  class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328"  value="<?=$v->city?>">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">State </label>
                <input type="text" name="state" id="name" class="form-control"placeholder=" Enter State"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057"value="<?=$v->state?>">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Country </label>
                <input type="text" name="country" id="name" class="form-control" placeholder=" Enter Country" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057"  value="<?=$v->country?>">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Fax </label>
                <input type="text" name="fax" id="name" class="form-control" placeholder=" Enter Fax"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057"  value="<?=$v->fax?>">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Website </label>
                <input type="text" name="website" id="name" class="form-control" placeholder=" Enter Website" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057"  value="<?=$v->website?>">
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
              <div class="form-group col-md-12">
                <label for="name">Contact Code </label>
                <input type="text" name="contractCode" id="contractCode" class="form-control" required="" placeholder=" Enter Contact Code" data-parsley-id="8057"  value="<?=$v->contractCode?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">From </label>
                <input type="text" name="from" id="from" class="form-control" required="" placeholder=" Enter From"data-parsley-id="8057"  value="<?=$v->from?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">To </label>
                <input type="text" name="to" id="from" required class="form-control" placeholder=" Enter To" data-parsley-id="1328"  value="<?=$v->to?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">TruckLength [Feet] </label>
                <input type="text" name="vehicleLength" id="name" class="form-control" placeholder=" Enter TruckLength [Feet]" data-parsley-id="8057"  value="<?=$v->vehicleLength?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Weight[Kgs]</label>
                <input type="text" name="vehicleCapacity" id="contactemail"  class="form-control" placeholder=" Enter Weight[Kgs]" data-parsley-id="1328"  value="<?=$v->vehicleCapacity?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Vehicle Type</label>
                <input type="text" name="vehicleType" id="contactemail"  class="form-control" placeholder="Enter Vehicle Type" data-parsley-id="1328"  value="<?=$v->vehicleType?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Road Type</label>
                <input type="text" name="roadType" id="name" class="form-control" placeholder="Enter Road Type"  data-parsley-id="8057"  value="<?=$v->roadType?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Season Type</label>
                <input type="text" name="seasonType" id="contactemail"  class="form-control" placeholder="Enter Season Type" data-parsley-id="1328"  value="<?=$v->seasonType?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Misc Type</label>
                <input type="text" name="miscType" id="name" class="form-control" placeholder="Enter Misc Type"  data-parsley-id="8057"  value="<?=$v->miscType?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Contract Date</label>
                <input type="text" name="dated" id="contactemail" required class="form-control datepicker "  placeholder="MM-DD-YYYY" data-format="L" data-parsley-id="1328"  value="<?=date('m/d/Y',strtotime($v->dated))?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Contract Signed By</label>
                <input type="text" name="signedby" id="signedby" class="form-control" required="" data-parsley-id="8057" placeholder="Enter Contract Signed By"  value="<?=$v->signedby?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <!--<div class="row">
              <div class="form-group col-md-12">
                <label for="message">Special Instructions </label>
                <textarea class="form-control" rows="1" name="roadType" id="message" placeholder="Type your Special Instructions" data-parsley-id="2766"> <?=$v->roadType?></textarea>
                <ul class="parsley-errors-list" id="parsley-id-2766">
                </ul>
              </div>
            </div>-->
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
                <input type="text" name="basicfreight" id="basicfreight" class="form-control tac_calculation" required="" data-parsley-id="8057" placeholder="Enter Basic Freight" value="<?=$v->basicfreight?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Docket Charges </label>
                <input type="text" name="docketChgs" id="docketChgs" required class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter Docket Charges " value="<?=$v->docketChgs?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Handling Charges </label>
                <input type="text" name="handlingChgs" id="handlingChgs" class="form-control tac_calculation"  data-parsley-id="8057" placeholder="Enter Handling Charges" value="<?=$v->handlingChgs?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">State/Permit Charges </label>
                <input type="text" name="statePermitChgs" id="statePermitChgs"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter State/Permit Charges" value="<?=$v->statePermitChgs?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Pickup/Delivery Charges </label>
                <input type="text" name="pickupDeliveryChgs" id="pickupDeliveryChgs"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter Pickup/Delivery Charges" value="<?=$v->pickupDeliveryChgs?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">To pay Charge </label>
                <input type="text" name="toPayChgs" id="toPayChgs" class="form-control tac_calculation"  data-parsley-id="8057" placeholder="Enter To pay Charge" value="<?=$v->toPayChgs?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">CheckPost Expense </label>
                <input type="text" name="checkpostExpenses" id="checkpostExpenses"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter CheckPost Expense" value="<?=$v->checkpostExpenses?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">COD/DOD Charges </label>
                <input type="text" name="coddodChgs" id="coddodChgs"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter COD/DOD Charges" value="<?=$v->coddodChgs?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
            </div>
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="name">MISC Charges </label>
                <input type="text" name="MISCCharges" id="MISCCharges" class="form-control tac_calculation" data-parsley-id="8057" placeholder="Enter MISC Charges" value="<?=$v->MISCCharges?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Sub Total </label>
                <input type="text" name="sub_total" id="sub_total" class="form-control" data-parsley-id="1328" placeholder="Enter Sub Total " value="<?=$v->name?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="name">Service Tax </label>
                <input type="text" name="serivceTax" id="serivceTax" class="form-control tac_calculation"  data-parsley-id="8057" placeholder="Enter Service Tax" value="<?=$v->serivceTax?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Grand Total </label>
                <input type="text"  id="grandTotal" class="form-control" required data-parsley-id="8057" placeholder="Enter Grand Total " value="<?=$v->grandTotal?>">
                 <input type="hidden" name="grandTotal" id="grandTotals" class="form-control" required data-parsley-id="8057" placeholder="Enter Grand Total " value="<?=$v->grandTotal?>">
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
      </div>
      
      <?php echo form_close(); ?> 
      <!-- /col --> 
      
    </div>
    <?php }else{?>
    No Records Found
    <?php }?>
    <!-- /row --> 
    
  </div>
  
  <div class="row">
                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header bg-greensea dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Contract Consignor</strong> Master</h1>
                                    
                                    <ul class="controls">
                                        
                                        <li><a href="<?= base_url()?>add-contract-consignor" title="Add Contract Consignor" role="button" tabindex="0" class="tile-close">Add New  <i class="fa fa-plus"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-custom" id="basic-usage">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Consioner Name</th>
                                                <th>From</th>
                                                
                                                <th>To</th>
                                                <th>Length</th>
                                                <th>Weight</th>
                                                
                                                <th>Dated</th>
                                                <th>Signed by</th>
                                                <th>Grand Total</th>
                                               
                                                <th>Status</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->


                        </div>
                        <!-- /col -->
                    </div>




                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->
<?php $this->load->view('admin/footer')?>