	
<?php $this->load->view('admin/sidebar')?>

<!-- =================================================
                ================= RIGHTBAR Content ===================
                ================================================== -->
<!--/ RIGHTBAR Content -->
</div>

<section id="content">
  <div class="page page-forms-validate">
    <div class="pageheader">
      <h2>Trip Payment Update</h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="javascript::">Trip Payment Update</a> </li>
         
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
                                    <h1 class="custom-font"><strong>THC Closure Details  </strong> </h1>
                                    
                                </div>
          <!-- tile body -->
          <div class="tile-body">
           
              
               <div class="row">
              <div class="form-group col-md-3">
                <label for="name">THL No </label>
                 <select  name="name" id="name" required class="form-control"  >
                <option value="">-- Select THL --</option>
                    <option value="1" >TN 78 W 4757</option>
                </select>
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Driver Name </label>
                <input type="text" name="to" id="geocomplete1" required class="form-control" placeholder="Driver Name" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
              <div class="form-group name_class col-md-3">
                <label for="name">Truck No</label>
               <input type="text" name="to" id="geocomplete1" required class="form-control" placeholder="Truck No" data-parsley-id="1328">
               <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
                
              </div>
              <div class="form-group name_class col-md-3">
                <label for="name"> Phone No</label>
               <input type="text" name="to" id="geocomplete1" required class="form-control" placeholder="Phone No" data-parsley-id="1328">
               <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
                
              </div>
              </div>
              <div class="row">
              
               <div class="form-group col-md-3">
                <label for="contactemail">Vechile Make	</label>
                <input type="text" name="dated" id="contactemail" required class="form-control "  placeholder="Vechile Make	" data-format="L" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              	
              
              
              </div>
              
              
              
            
          </div>
          <!-- /tile body --> 
          
        </section>
      </div>
      <div class="col-md-12"> 
        
        <!-- tile -->
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header --> 
          <div class="tile-header dvd bg-greensea dvd-btm">
                                    <h1 class="custom-font"><strong>
Payment </strong> </h1>
                                    
                                </div>
          <!-- tile body -->
          <div class="tile-body">
           <div class="row">
              
              <div class="form-group col-md-3">
                <label for="contactemail">Total Lorry Hire </label>
                <input type="text" name="contactPer2" id="contactemail" class="form-control" placeholder=" Enter Total Lorry Hire" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Advance</label>
                <input type="text" name="csttinno" id="name" placeholder=" Enter Advance" class="form-control"  data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">TDS <span class="required">*</span> </label>
                <input type="text" name="companyName" id="name" class="form-control" placeholder="Enter TDS" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Balance Lorry Hire <span class="required">*</span> </label>
                <input type="text" name="companyName" id="name" class="form-control" placeholder="Enter Balance Lorry Hire" required="" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
               </div>
              
            
            <div class="row">
            <div class="form-group col-md-3">
                <label for="name">Detucted Amount(Less)	<span class="required">*</span> </label>
                <input type="text" name="phone1" id="name" class="form-control" required="" placeholder="Detucted Amount(Less)" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
            <div class="form-group col-md-3">
                <label for="name">MISC Charges ( Extra) </label>
                <input type="text" name="phone2" id="name" class="form-control"  placeholder="MISC Charges ( Extra)" data-parsley-id="8057">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
             <div class="form-group col-md-3">
                <label for="contactemail">Remarks<span class="required">*</span></label>
                <input type="email" name="email1" id="contactemail" required placeholder="Enter Remarks"class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Net Amount Payable (After Total Deductions)	 </label>
                <input type="email" name="email2" id="contactemail"  placeholder="Net Amount Payable (After Total Deductions)" class="form-control" data-parsley-id="1328">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
             
            </div>
            
           
            
          </div>
          <!-- /tile body --> 
          
        </section>
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
<div class="map_canvas"></div>
    <br>
     <div class="map_canvas1"></div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer')?>

