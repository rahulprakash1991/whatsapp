    <hr>
    <div class="row allrowvalues" id="rowssids_<?php echo $i;?>" col-span="2">
                <div class="row" >
                  <div class="col-md-6">
                    <fieldset>
                   <!--  <legend><?php echo "Add delivery/Shipping address (English)";?></legend> -->
                  <div class="row">
          <div class="col-md-4">
            <div class="form-group <?php if(form_error('contact_address['.$i.']')){ echo 'has-error'; }?>">
        
              <input type="text" class="form-control" name="contact_address[]>" autocomplete="off" id="contact_address<?php echo $i;?>" placeholder="Address" value="<?php echo $contact_address[$i];?>">
              <input type="hidden" class="form-control" name="contact_address_id[]>" autocomplete="off" id="contact_address_id<?php echo $i;?>" placeholder="Address" value="<?php echo $contact_address_id[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_address['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group <?php if(form_error('contact_area['.$i.']')){ echo 'has-error'; }?>">
             
              <input type="text" class="form-control" name="contact_area[]" autocomplete="off" id="contact_area<?php echo $i;?>" placeholder="Area" value="<?php echo $contact_area[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_area['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group <?php if(form_error('contact_city['.$i.']')){ echo 'has-error'; }?>">
             
              <input type="text" class="form-control" name="contact_city[]" autocomplete="off" id="contact_city<?php echo $i;?>" placeholder="city" value="<?php echo $contact_city[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_city['.$i.']'); ?></label>
            </div>
          </div>
         
        </div>
        <div class="row">
           <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_state['.$i.']')){ echo 'has-error'; }?>">
         
              <input type="text" class="form-control" name="contact_state[]" autocomplete="off" id="contact_state<?php echo $i;?>" placeholder="State" value="<?php echo $contact_state[$i];?>">
              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_state['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_zip['.$i.']')){ echo 'has-error'; }?>">
            
              <input type="text" class="form-control" name="contact_zip[]" autocomplete="off" id="contact_zip<?php echo $i;?>" placeholder="Zip" value="<?php echo $contact_zip[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_zip['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_country['.$i.']')){ echo 'has-error'; }?>">
           
               <input type="text" class="form-control" name="contact_country[]" autocomplete="off" id="contact_country<?php echo $i;?>" placeholder="Country" value="<?php echo $contact_country[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_country['.$i.']'); ?></label>
            </div>
          </div>
         
          
        </div>
        <div class="row">
           <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_phone['.$i.']')){ echo 'has-error'; }?>">
              
                <input type="text" class="form-control" name="contact_phone[]" autocomplete="off" id="contact_phone<?php echo $i;?>" placeholder="Phone" value="<?php echo $contact_phone[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_phone['.$i.']'); ?></label>
            </div>
          </div>
           <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_mobile['.$i.']')){ echo 'has-error'; }?>">
            
                <input type="text" class="form-control" name="contact_mobile[]" autocomplete="off" id="contact_mobile<?php echo $i;?>" placeholder="Mobile" value="<?php echo $contact_mobile[$i];?>" >
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_mobile['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_email['.$i.']')){ echo 'has-error'; }?>">
           
                <input type="text" class="form-control" name="contact_email[]" autocomplete="off" id="contact_email<?php echo $i;?>" placeholder="Email" value="<?php echo $contact_email[$i];?>">
                 <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_email['.$i.']'); ?></label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_fax['.$i.']')){ echo 'has-error'; }?>">
           
                <input type="text" class="form-control" name="contact_fax[]" autocomplete="off" id="contact_fax<?php echo $i;?>" placeholder="Fax" value="<?php echo $contact_fax[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_fax['.$i.']'); ?></label>
             </div>
           </div>
          
          <div class="col-md-4" id="website" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_website['.$i.']')){ echo 'has-error'; }?>">
             
                <input type="text" class="form-control" name="contact_website[]" autocomplete="off" id="contact_website<?php echo $i;?>" placeholder="Website" value="<?php echo $contact_website[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_website['.$i.']'); ?></label>
            </div>
          </div>
        
          <!--  <div class="col-md-2">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart(<?PHP echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div>  -->
        </div> 
      </fieldset>
    </div>
      <div class="col-md-6">
                    <fieldset>
                    <!-- <legend><?php echo "Add delivery/Shipping address (Arabic)";?></legend> -->
                  <div class="row">
                    <div class="col-md-4">
            <div class="form-group <?php if(form_error('contact_city_arabic['.$i.']')){ echo 'has-error'; }?>">
             
              <input type="text" class="form-control" name="contact_city_arabic[]" autocomplete="off" id="contact_city_arabic<?php echo $i;?>" placeholder="city (Arabic)" value="<?php echo $contact_city_arabic[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_city_arabic['.$i.']'); ?></label>
            </div>
          </div>
        
          <div class="col-md-4">
            <div class="form-group <?php if(form_error('contact_area_arabic['.$i.']')){ echo 'has-error'; }?>">
              
              <input type="text" class="form-control" name="contact_area_arabic[]" autocomplete="off" id="contact_area_arabic<?php echo $i;?>" placeholder="Area (Arabic)" value="<?php echo $contact_area_arabic[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_area_arabic['.$i.']'); ?></label>
            </div>
          </div>
            <div class="col-md-4">
            <div class="form-group <?php if(form_error('contact_address_arabic['.$i.']')){ echo 'has-error'; }?>">
             
              <input type="text" class="form-control" name="contact_address_arabic[]>" autocomplete="off" id="contact_address_arabic<?php echo $i;?>" placeholder="Address (Arabic)" value="<?php echo $contact_address_arabic[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_address_arabic['.$i.']'); ?></label>
            </div>
          </div>
          
         
        </div>
        <div class="row">
           <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_country_arabic['.$i.']')){ echo 'has-error'; }?>">
              
               <input type="text" class="form-control" name="contact_country_arabic[]" autocomplete="off" id="contact_country_arabic<?php echo $i;?>" placeholder="Country (Arabic)" value="<?php echo $contact_country_arabic[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_country_arabic['.$i.']'); ?></label>
            </div>
          </div>
        
          <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_zip_arabic['.$i.']')){ echo 'has-error'; }?>">
             
              <input type="text" class="form-control" name="contact_zip_arabic[]" autocomplete="off" id="contact_zip_arabic<?php echo $i;?>" placeholder="Zip (Arabic)" value="<?php echo $contact_zip_arabic[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_zip_arabic['.$i.']'); ?></label>
            </div>
          </div>
             <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_state_arabic['.$i.']')){ echo 'has-error'; }?>">
            
              <input type="text" class="form-control" name="contact_state_arabic[]" autocomplete="off" id="contact_state_arabic<?php echo $i;?>" placeholder="State (Arabic)" value="<?php echo $contact_state_arabic[$i];?>">
              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_state_arabic['.$i.']'); ?></label>
            </div>
          </div>
         
         
          
        </div>
        <div class="row">
           <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_email_arabic['.$i.']')){ echo 'has-error'; }?>">
              
                <input type="text" class="form-control" name="contact_email_arabic[]" autocomplete="off" id="contact_email_arabic<?php echo $i;?>" placeholder="Email (Arabic)" value="<?php echo $contact_email_arabic[$i];?>">
                 <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_email_arabic['.$i.']'); ?></label>
            </div>
          </div>
        
           <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_mobile_arabic['.$i.']')){ echo 'has-error'; }?>">
              
                <input type="text" class="form-control" name="contact_mobile_arabic[]" autocomplete="off" id="contact_mobile_arabic<?php echo $i;?>" placeholder="Mobile (Arabic)" value="<?php echo $contact_mobile_arabic[$i];?>" >
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_mobile_arabic['.$i.']'); ?></label>
            </div>
          </div>
             <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_phone_arabic['.$i.']')){ echo 'has-error'; }?>">
             
                <input type="text" class="form-control" name="contact_phone_arabic[]" autocomplete="off" id="contact_phone_arabic<?php echo $i;?>" placeholder="Phone (Arabic)" value="<?php echo $contact_phone_arabic[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_phone_arabic['.$i.']'); ?></label>
            </div>
          </div>
         
        </div>
        <div class="row">
           <div class="col-md-4" id="website" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_website_arabic['.$i.']')){ echo 'has-error'; }?>">
            
                <input type="text" class="form-control" name="contact_website_arabic[]" autocomplete="off" id="contact_website_arabic<?php echo $i;?>" placeholder="Website (Arabic)" value="<?php echo $contact_website_arabic[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_website_arabic['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-md-4" style="margin-top: -15px;">
            <div class="form-group <?php if(form_error('contact_fax_arabic['.$i.']')){ echo 'has-error'; }?>">
             
                <input type="text" class="form-control" name="contact_fax_arabic[]" autocomplete="off" id="contact_fax_arabic<?php echo $i;?>" placeholder="Fax (Arabic)" value="<?php echo $contact_fax_arabic[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_fax_arabic['.$i.']'); ?></label>
             </div>
           </div>
           <div class="col-md-2" style="margin-top: -15px;">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart(<?PHP echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div> 
        </div> 
      </fieldset>
    </div>
                </div> 
               </div>
             <hr>