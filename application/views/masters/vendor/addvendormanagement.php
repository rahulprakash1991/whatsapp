<div class="row allrowvalues1" id="rowssids1_<?php echo $i;?>" col-span="2" style="margin-left:  3px">
                  <div class="row">
          <div class="col-sm-3">
            
              
             <!--  <input type="text" class="form-control" name="vendor_id[]>" autocomplete="off" id="vendor_id<?php echo $i;?>" placeholder="Address" value="<?php echo $vendor_id[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('vendor_id['.$i.']'); ?></label> -->

<label>Vendor ID <span1>*</span1></label>
                                             <select name="vendor_mana_id[]" id="vendor_mana_id<?php echo $i;?>" class="form-control" style="width: 100%" >
                                                    <?php foreach ($drop_menu_vendor_id_Manag as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $vendor_mana_id[$i]){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>

          </div>
            <div class="col-sm-3">
            
            <label>Vendor Number</label>
              <input type="text" class="form-control" name="vendor_manag_No[]>" autocomplete="off" id="vendor_manag_No<?php echo $i;?>" placeholder="Enter Vendor Number" value="<?php echo $vendor_manag_No[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('vendor_manag_No['.$i.']'); ?></label>
         
          </div>
          <div class="col-md-2">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart1(<?PHP echo $i;?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div> 
                  </div> 
                </div> 
            <hr>