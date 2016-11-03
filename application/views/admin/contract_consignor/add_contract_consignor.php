	
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
      <?=form_open_multipart(base_url().'add-contract-consignor',array('id'=>'form4','role'=>'form','data-parsley-validate'=>''));?>
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
           
              <div class="form-group name_class col-md-3" style="padding:0px;">
                <label for="name">Name <span class="required">*</span></label><br />
                <select  name="name" id="combobox" required class="form-control" onchange="fetch_contact_details(this.value)" >
                <option value="">-- Select Name --</option>
                <?php if(isset($view) && $view->num_rows()>0)
				foreach($view->result() as $v)
				{
					?>
                    <option value="<?=$v->contactID?>" ><?=$v->name?></option>
                    <?php 
				}
				?>
               
                </select>
               <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
                
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Alter Contact Person </label>
                <input type="text" name="contactPer2" id="contactemail" class="form-control" placeholder=" Enter Alter Contact Person" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">CST/LST/TIN No</label>
                <input type="text" name="csttinno" id="name" placeholder=" Enter CST/LST/TIN No" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div id="change_content">
              <div class="form-group col-md-3">
                <label for="name">Company Name <span class="required">*</span> </label>
                <input type="text" name="companyName" id="name" class="form-control" placeholder="Name of Company" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
            
            <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Contact  No-1	<span class="required">*</span> </label>
                <input type="text" name="phone1" id="name" class="form-control" required="" placeholder=" Enter Contact  No-1" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            <div class="form-group col-md-3">
                <label for="name">Contact  No-2 </label>
                <input type="text" name="phone2" id="name" class="form-control"  placeholder=" Enter Contact  No-2 " data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1 <span class="required">*</span></label>
                <input type="email" name="email1" id="contactemail" required placeholder=" Enter Email ID-1"class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-2 </label>
                <input type="email" name="email2" id="contactemail"  placeholder=" Enter Email ID-2" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
             
            </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address 1 <span class="required">*</span> </label>
                <input type="text" name="addressline1" id="contactemail" placeholder=" Enter Address 1" required class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 </label>
                <input type="text" name="addressline2" id="contactemail" placeholder=" Enter Address 2" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
             
              <div class="form-group col-md-3">
                <label for="contactemail">City </label>
                <input type="text" name="city" id="contactemail" placeholder=" Enter City"  class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">State </label>
                <input type="text" name="state" id="name" class="form-control"placeholder=" Enter State"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
                <div class="form-group col-md-3">
                <label for="name">Country </label>
                <input type="text" name="country" id="name" class="form-control" placeholder=" Enter Country" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              
               <div class="form-group col-md-3">
                <label for="name">Fax </label>
                <input type="text" name="fax" id="name" class="form-control" placeholder=" Enter Fax"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Website </label>
                <input type="text" name="website" id="name" class="form-control" placeholder=" Enter Website" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
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
                <input type="text" name="contractCode" id="contractCode" class="form-control" required="" placeholder=" Enter Contact Code" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">From </label>
                <input type="text" name="from" id="geocomplete" class="form-control" required="" placeholder=" Enter From"data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">To </label>
                <input type="text" name="to" id="geocomplete1" required class="form-control" placeholder=" Enter To" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">TruckLength [Feet] </label>
                <input type="text" name="vehicleLength" id="name" class="form-control" placeholder=" Enter TruckLength [Feet]" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Weight[Kgs]</label>
                <input type="text" name="vehicleCapacity" id="contactemail"  class="form-control" placeholder=" Enter Weight[Kgs]" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Vehicle Type</label>
                <input type="text" name="vehicleType" id="contactemail"  class="form-control" placeholder="Enter Vehicle Type" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Road Type</label>
                <input type="text" name="roadType" id="name" class="form-control" placeholder="Enter Road Type"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Season Type</label>
                <input type="text" name="seasonType" id="contactemail"  class="form-control" placeholder="Enter Season Type" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Misc Type</label>
                <input type="text" name="miscType" id="name" class="form-control" placeholder="Enter Misc Type"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Contract Date</label>
                <input type="text" name="dated" id="contactemail" required class="form-control datepicker "  placeholder="MM-DD-YYYY" data-format="L" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Contract Signed By</label>
                <input type="text" name="signedby" id="name" class="form-control" required="" data-parsley-id="8057" placeholder="Enter Contract Signed By">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <!--<div class="row">
              <div class="form-group col-md-12">
                <label for="message">Special Instructions </label>
                <textarea class="form-control" rows="1" name="roadType" id="message" placeholder="Type your Special Instructions" data-parsley-id="2766"></textarea>
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
                <input type="text" name="basicfreight" id="basicfreight" class="form-control tac_calculation" required="" data-parsley-id="8057" placeholder="Enter Basic Freight">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Docket Charges </label>
                <input type="text" name="docketChgs" id="docketChgs" required class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter Docket Charges ">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Handling Charges </label>
                <input type="text" name="handlingChgs" id="handlingChgs" class="form-control tac_calculation"  data-parsley-id="8057" placeholder="Enter Handling Charges">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">State/Permit Charges </label>
                <input type="text" name="statePermitChgs" id="statePermitChgs"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter State/Permit Charges">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">Pickup/Delivery Charges </label>
                <input type="text" name="pickupDeliveryChgs" id="pickupDeliveryChgs"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter Pickup/Delivery Charges">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">To pay Charge </label>
                <input type="text" name="toPayChgs" id="toPayChgs" class="form-control tac_calculation"  data-parsley-id="8057" placeholder="Enter To pay Charge">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="contactemail">CheckPost Expense </label>
                <input type="text" name="checkpostExpenses" id="checkpostExpenses"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter CheckPost Expense">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">COD/DOD Charges </label>
                <input type="text" name="coddodChgs" id="coddodChgs"  class="form-control tac_calculation" data-parsley-id="1328" placeholder="Enter COD/DOD Charges">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
            </div>
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="name">MISC Charges </label>
                <input type="text" name="MISCCharges" id="MISCCharges" class="form-control tac_calculation" data-parsley-id="8057" placeholder="Enter MISC Charges">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="contactemail">Sub Total </label>
                <input type="text" name="sub_total" id="sub_total" class="form-control" data-parsley-id="1328" placeholder="Enter Sub Total " disabled="disabled">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            </div>
            <div class="row">
              
              <div class="form-group col-md-6">
                <label for="name">Service Tax (%)</label>
                <input type="text" name="serivceTax" id="serivceTax" class="form-control tac_calculation"  data-parsley-id="8057" placeholder="Enter Service Tax">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Grand Total </label>
                <input type="text"  id="grandTotal" class="form-control" required data-parsley-id="8057" placeholder="Enter Grand Total " disabled="disabled">
                  <input type="hidden" name="grandTotal"id="grandTotals" class="form-control" required data-parsley-id="8057" placeholder="Enter Grand Total " >
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

 <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAvqzVbnAGwqxoZ3x4dunb-WSydKzd6kLA&sensor=false&amp;libraries=places"></script>

    <script src="<?= base_url(); ?>assets/js/jquery.geocomplete.js"></script>
   
    <script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas"
        });
        
        $("#search").click(function(){
          $("#geocomplete").geocomplete("find", "NYC");
        });
        
        $("#center").click(function(){
          var map = $("#geocomplete").geocomplete("map"),
            center = new google.maps.LatLng(10, 0);
          
          map.setCenter(center);
          map.setZoom(3);
        });
		
		 $("#geocomplete1").geocomplete({
          map: ".map_canvas1"
        });
        
        $("#search").click(function(){
          $("#geocomplete1").geocomplete("find", "NYC");
        });
        
        $("#center").click(function(){
          var map = $("#geocomplete1").geocomplete("map"),
            center = new google.maps.LatLng(10, 0);
          
          map.setCenter(center);
          map.setZoom(3);
        });
      });
	  $( ".tac_calculation" ).change(function() {
		  var basicfreight			=	$('#basicfreight').val();
		  var docketChgs			=	$('#docketChgs').val();
		  var handlingChgs			=	$('#handlingChgs').val();
		  
		  var statePermitChgs		=	$('#statePermitChgs').val();
		  var pickupDeliveryChgs	=	$('#pickupDeliveryChgs').val();
		  var toPayChgs				=	$('#toPayChgs').val();
		  
		  var checkpostExpenses		=	$('#checkpostExpenses').val();
		  var coddodChgs			=	$('#coddodChgs').val();
		  var MISCCharges			=	$('#MISCCharges').val();
		  
		  var serivceTax			=	$('#serivceTax').val();
		  var grand_total			=	0.00;
		  var sub_total				=	0.00;
		  var tax_total				=	0.00;
		
		  if(basicfreight!='')
		  sub_total+=parseInt(basicfreight);
		  if(docketChgs!='')
		  sub_total+=parseInt(docketChgs);
		  if(handlingChgs!='')
		  sub_total+=parseInt(handlingChgs);
		  if(statePermitChgs!='')
		  sub_total+=parseInt(statePermitChgs);
		  if(pickupDeliveryChgs!='')
		  sub_total+=parseInt(pickupDeliveryChgs);
		  if(toPayChgs!='')
		  sub_total+=parseInt(toPayChgs);
		  if(checkpostExpenses!='')
		  sub_total+=parseInt(checkpostExpenses);
		  if(coddodChgs!='')
		  sub_total+=parseInt(coddodChgs);
		  if(MISCCharges!='')
		  sub_total+=parseInt(MISCCharges);
		  if(serivceTax!='' && sub_total>0)
		  {
			  tax_total=sub_total*serivceTax/100;
		  }
		  $('#sub_total').val(sub_total);
		  $('#grandTotal').val(sub_total+tax_total);
		  $('#grandTotals').val(sub_total+tax_total);
		});
		 
    </script>

 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
			$.ajax({
				data:"name="+ui.item.value,
				type:"post",
				url:"<?php echo base_url()?>manage/contract_contact_details",
				success:function(html)
				{
					$('#change_content').html(html);
				}
			});
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 			
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        $("#combobox").append('<option value="'+value+'" selected >'+value+'</option>');
		// Remove invalid value
        //this.input
          //.val( "" )
          //.attr( "title", value + " didn't match any item" )
          //.tooltip( "open" );
        //this.element.val( "" );
       
        
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox" ).toggle();
    });
  } );

  </script>