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
      <h2>View Payment Mode</h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="<?= base_url()?>payment_mode"> Payment Mode</a> </li>
          <li> <a href="javascript::">View Payment Mode</a> </li>
        </ul>
      </div>
    </div>
    
    <!-- row -->
    <div class="row">
    
    	<div class="col-md-12">
					<?php $this->load->view('admin/msg')?>
                    </div>
      <?php if(isset($view) && $view->num_rows()>0){ $v=$view->row();?>
      
      
      <!-- col -->
      <div class="col-md-4 insert_forms add_forms">
        <?php $this->load->view('admin/msg')?>
        <!-- tile --> 
        
        <!-- /tile --> 
        
        <!-- tile -->
        <section class="tile"> 
          
          <!-- tile header -->
          <div class="tile-header bg-greensea  dvd dvd-btm">
            <h1 class="custom-font"><strong>View</strong> Payment Mode</h1>
             <?php if(checkpageaccess('payment_mode',1,'modify')){?>
                                    <ul class="controls">
                                        
                                        <li><a href="<?= base_url()?>edit_payment_mode/<?=$this->uri->segment(2)?>" title="Edit Payment Mode" role="button" tabindex="0" >Edit  <i class="fa fa-pencil-square-o"></i></a></li>
                                    </ul>
                                     <?php }?>
          </div>
          <!-- /tile header --> 
          
          <!-- tile body -->
          <div class="tile-body">
           
             
              <div class="form-group">
                <label class="control-label">Payment Mode Name</label>
                
                  <input type="text" name="paymentMode" class="form-control" placeholder="Payment Mode Name"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->paymentMode?>" disabled="disabled">
               
              </div>
              <input type="hidden" value="<?=$v->paymentModeID?>" name="paymentModeID" />
             
              <div class="form-group">
                <label class="control-label">Payment Mode Description</label>
                
                  <input type="text" name="description" class="form-control" placeholder="Payment Mode Description"
                                                       data-parsley-trigger="change"
                                                       required value="<?=$v->description?>" disabled="disabled">
               
              </div>
              
              <!-- tile footer -->
             <div class="tile-footer text-right bg-tr-black lter dvd dvd-top"> 
                <!-- SUBMIT BUTTON -->
                 <a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>payment_mode','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
              </div>
              <!-- /tile footer -->
              
          </div>
          <!-- /tile body --> 
          
        </section>
        <!-- /tile --> 
        
      </div>
      <!-- /col -->
      
      <?php } else { ?>
      No Records Found
      <?php }?>
    </div>
    <!-- /row --> 
    
  </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->

<?php $this->load->view('admin/footer')?>
