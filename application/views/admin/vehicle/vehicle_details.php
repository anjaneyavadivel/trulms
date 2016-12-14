<?php $v=$view->row();?>
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
              <div class="form-group col-md-3" style="padding:0px;">
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