<?php $this->load->view('admin/sidebar')?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-ui.css">
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
      <h2>Vehicle </h2>
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?= base_url()?>"><i class="fa fa-home"></i> HOME</a> </li>
          <li> <a href="<?= base_url()?>vehicle">Vehicle </a> </li>
          <li> <a href="javascript::">Update Vehicle </a> </li>
        </ul>
      </div>
    </div>
    
    <!-- row -->
    <?php if(isset($view) && $view->num_rows()>0){
		$v=$view->row();
		?>
    <div class="row">
      <?=form_open_multipart(base_url().'edit_vehicle/'.$v->vehicleID,array('id'=>'add_vehicle','role'=>'form'));?>
      <!-- col -->
      <div class="col-md-12">
        <?php $this->load->view('admin/msg')?>
        <input type="hidden" name="ownerID" id="name" class="form-control" value="<?=$v->ownerID?>">
         <input type="hidden" name="contactID" id="contactID" class="form-control" value="<?=$v->contactID?>">
          <input type="hidden" name="vehicleID" id="vehicleID" class="form-control" value="<?=$v->vehicleID?>">
        <!-- tile -->
        <section class="tile"> 
          
          <!-- tile header --> 
          <!-- /tile header -->
          <div class="tile-header dvd bg-greensea dvd-btm">
            <h1 class="custom-font"><strong>Vehicle Owner</strong> </h1>
          </div>
          <!-- tile body -->
          <div class="tile-body">
              <div class="form-group col-md-3">
                <label for="name">Company Name <span class="required">*</span> </label>
                 <input type="text" name="companyName" id="companyName" class="form-control" placeholder=" Enter Alter Contact Person"  value="<?=$v->companyName?>">
                 <!--<select  name="companyName" id="combobox" required class="form-control"  >
                <option value="">-- Select Name --</option>
                <?php $i=0;if(isset($compa) && $compa->num_rows()>0)
				foreach($compa->result() as $vv)
				{
					?>
                    <option value="<?=$vv->contactID?>"<?php if($v->companyName==$vv->companyName){?> selected="selected"<?php }?>><?=$vv->companyName?></option>
                    <?php 
				}
				?>
               
                </select>-->
               
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
               <div id="change_content">
              <div class="form-group col-md-3">
                <label for="contactemail">Alter Contact Person </label>
                <input type="text" name="contactPer2" id="contactemail" class="form-control" placeholder=" Enter Alter Contact Person"  value="<?=$v->contactPer2?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name of Consignor" required=""  value="<?=$v->name?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Contact  No-1  </label>
                <input type="text" name="phone1" id="name" class="form-control"  placeholder=" Enter Contact  No-1"  value="<?=$v->phone1?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
           
              <div class="form-group col-md-3">
                <label for="name">Contact  No-2 </label>
                <input type="text" name="phone2" id="name" class="form-control"  placeholder=" Enter Contact  No-2 "  value="<?=$v->phone2?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Email ID-1</label>
                <input type="email" name="email1" id="contactemail" placeholder=" Enter Email ID-1"class="form-control"  value="<?=$v->email1?>">
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
                <label for="contactemail">Address 1 <span class="required">*</span> </label>
                <input type="text" name="addressline1" id="contactemail" placeholder=" Enter Address 1" required class="form-control"  value="<?=$v->addressline1?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
            <div class="row">
              <div class="form-group col-md-3">
                <label for="contactemail">Address 2 </label>
                <input type="text" name="addressline2" id="contactemail" placeholder=" Enter Address 2" class="form-control"  value="<?=$v->addressline2?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">City <span class="required">*</span>  </label>
                <input type="text" name="city" id="city" placeholder=" Enter City" required class="form-control"  value="<?=$v->city?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">State  <span class="required">*</span> </label>
                <input type="text" name="state" id="state" class="form-control"placeholder=" Enter State" required  value="<?=$v->state?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Country <span class="required">*</span>  </label>
                <input type="text" name="country" id="country" class="form-control" placeholder=" Enter Country" required  value="<?=$v->country?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Fax </label>
                <input type="text" name="fax" id="fax" class="form-control" placeholder=" Enter Fax"   value="<?=$v->fax?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="name">Website </label>
                <input type="text" name="website" id="name" class="form-control" placeholder=" Enter Website"  value="<?=$v->website?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
               </div>
               </div>
            
          </div>
           <div class="tile-header dvd bg-greensea dvd-btm">
            <h1 class="custom-font"><strong>Vehicle</strong> </h1>
          </div>
          <div class="tile-body">
            
              <div class="form-group col-md-3">
                <label for="contactemail">Vehicle number <span class="required">*</span> </label>
                <input type="text" name="vehno" id="vehno" class="form-control" required placeholder=" Enter Vehicle number" value="<?=$v->vehno?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Vehicle make </label>
                <input type="text" name="vehmake" id="vehmake" class="form-control" placeholder=" Enter Vehicle make" value="<?=$v->vehmake?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
              
              <div class="form-group col-md-3">
                <label for="name">Road permit number </label>
                <input type="text" name="roadpermitno" id="roadpermitno" class="form-control"  placeholder=" Enter Road permit number" value="<?=$v->roadpermitno?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
           
            <div class="row">
              <div class="form-group col-md-3">
                <label for="name">Validity </label>
                <input type="text" name="validity" id="validity" class="form-control datepicker "  placeholder="MM-DD-YYYY" data-format="L"  value="<?=date('m-d-Y',strtotime($v->validity))?>">
                <ul class="parsley-errors-list" id="parsley-id-8057">
                </ul>
              </div>
              <div class="form-group col-md-3">
                <label for="contactemail">Insurance policy details </label>
                <input type="text" name="insurancepolicydtls" id="insurancepolicydtls" placeholder=" Enter Insurance policy details"class="form-control" value="<?=$v->insurancepolicydtls?>">
                <ul class="parsley-errors-list" id="parsley-id-1328">
                </ul>
              </div>
               
              <div class="tile-footer text-right bg-tr-black col-md-9 lter dvd dvd-top"> 
                <!-- SUBMIT BUTTON --> 
                <!--<a  href="javascript::" data-toggle="modal" data-target="#active-deactive1" data-options="splash-2 splash-ef-11" role="button" tabindex="0" onclick="active_deactive_class('<?= base_url()?>vehicleowner','3')" class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>-->
                <a  href="<?= base_url()?>vehicleowner"  class="btn btn-warning"><i class="fa fa-hand-o-left"></i> Go Back</a>
                  <input type="submit" class="btn bg-greensea" id="add_form" value="Update Vehicle" >
                                   
                                   <a  href="javascript::" data-toggle="modal" data-target="#form-submit" id="form_submiting" data-options="splash-2 splash-ef-11" role="button" tabindex="0"  class="btn btn-greensea" style="display:none">Submit</a>
                                    <input type="submit" class="btn btn-default" id="new_button" onclick="form_submit('add_vehicle')" value="Submit" style="display:none" >
              </div>
            </div>
            </div>
          <!-- /tile body --> 
          
        </section>
      </div>
      <?php echo form_close(); ?> 
      <!-- /col --> 
      
    </div>
    <?php } else{?>
    No REcords Found;
    <?php }?>
    <!-- /row --> 
    
  </div>
</section>
<!--/ CONTENT -->

</div>
<!--/ Application Content -->
<?php $this->load->view('admin/footer')?>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
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
				url:"<?php echo base_url()?>manage/vehicle_details",
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