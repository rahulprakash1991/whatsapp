    <hr>
    <div class="row allrowvalues" id="rowssids_<?php echo $i;?>" col-span="2">
    <div class="row" style="padding-right: 15px;padding-left: 15px"  >
                                        <div class="col-md-6">
                                           <fieldset>
                                      <!-- <legend><?php echo $this->lang->line('client_address_english')?></legend> -->
                                          <div class="row">
                                             <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('scr_no['.$i.']')){ echo 'has-error';} ?>">
                                               
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_cr_no');?>" id="scr_no<?php echo $i;?>" name="scr_no[]" value="<?php echo $scr_no[$i]; ?>">
                                                 <input type="hidden" class="form-control" name="scontact_address_id[]>" autocomplete="off" id="scontact_address_id<?php echo $i;?>" placeholder="Address" value="<?php echo $scontact_address_id[$i];?>">
                                                 <label class="error"><?php echo form_error('scr_no['.$i.']'); ?></label>
                                            </div>
                                          </div>
                                           <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('svendor_no['.$i.']')){ echo 'has-error';} ?>">
                                                
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_vendor_no');?>" id="svendor_no<?php echo $i;?>" name="svendor_no[]" value="<?php echo $svendor_no[$i]; ?>">
                                                 <label class="error"><?php echo form_error('svendor_no['.$i.']'); ?></label>
                                            </div>
                                        </div> 
                                        </div>


                                            <div class="row">

                                              <div class="col-md-12">
                                                <div class="form-group <?php if(form_error('saddress1['.$i.']')){ echo 'has-error'; }?>">
                                                   <input type="text" class="form-control" name="saddress1[]" autocomplete="off" id="saddress1<?php echo $i;?>" placeholder="Building Name/No., Apartment, Suite, Unit, Floor etc." value="<?php echo $saddress1[$i];?>" >
                                                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('saddress1['.$i.']'); ?></label>
                                                </div>
                                              </div>
                                      
                                            </div>
                                                 <div class="row">
                                             <div class="col-md-12" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('sstreet['.$i.']')){ echo 'has-error'; }?>">
                                                   <input type="text" class="form-control" name="sstreet[]" autocomplete="off" id="sstreet<?php echo $i;?>" placeholder="Street Name" value="<?php echo $sstreet[$i];?>" >
                                                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sstreet['.$i.']'); ?></label>
                                                </div>
                                              </div>
                                            </div>
                                               <div class="row">
                                             
                                               <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('scity['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="scity[]" autocomplete="off" id="scity<?php echo $i;?>" placeholder="city" value="<?php echo $scity[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scity['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sdistrict['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="sdistrict[]" autocomplete="off" id="sdistrict<?php echo $i;?>" placeholder="District" value="<?php echo $sdistrict[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sdistrict['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sprovince['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="sprovince[]" autocomplete="off" id="sprovince<?php echo $i;?>" placeholder="Province" value="<?php echo $sprovince[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sprovince['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('szip['.$i.']')){ echo 'has-error'; }?>">
              
                                                <input type="text" class="form-control" name="szip[]" autocomplete="off" id="szip<?php echo $i;?>" placeholder="Zip" value="<?php echo $szip[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('szip['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                               <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sarea['.$i.']')){ echo 'has-error'; }?>">
              
                                                <input type="text" class="form-control" name="sarea[]" autocomplete="off" id="sarea<?php echo $i;?>" placeholder="PO Box" value="<?php echo $sarea[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sarea['.$i.']'); ?></label>
                                             </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                            <div class="form-group <?php if(form_error('scountry['.$i.']')){ echo 'has-error'; }?>">
              
                                            <input type="text" class="form-control" name="scountry[]" autocomplete="off" id="scountry<?php echo $i;?>" placeholder="Country" value="<?php echo $scountry[$i];?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scountry['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                               <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text" class="form-control" name="slandline_no[]" autocomplete="off" id="slandline_no<?php echo $i;?>" placeholder="Phone No1" value="<?php echo $slandline_no[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no1['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text" class="form-control" name="slandline_no1[]" autocomplete="off" id="slandline_no1<?php echo $i;?>" placeholder="Phone No2" value="<?php echo $slandline_no1[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no1['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                               <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('sfax['.$i.']')){ echo 'has-error'; }?>">
            
                                          <input type="text" class="form-control" name="sfax[]" autocomplete="off" id="sfax<?php echo $i;?>" placeholder="Fax" value="<?php echo $sfax[$i];?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sfax['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('scontact_no['.$i.']')){ echo 'has-error'; }?>">
            
                                            <input type="text" class="form-control" name="scontact_no[]" autocomplete="off" id="scontact_no<?php echo $i;?><?php echo $i;?>" placeholder="Mobile" value="<?php echo $scontact_no[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scontact_no['.$i.']'); ?></label>
                                            </div>
                                              </div>
                                            <div class="col-md-4" style="margin-top: -15px;">
                                               <div class="form-group <?php if(form_error('semail['.$i.']')){ echo 'has-error'; }?>">
              
                                            <input type="text" class="form-control" name="semail[]" autocomplete="off" id="semail<?php echo $i;?>" placeholder="Email" value="<?php echo $semail[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('semail['.$i.']'); ?></label>
                                             </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('swebsite['.$i.']')){ echo 'has-error'; }?>">
          
                                                <input type="text" class="form-control" name="swebsite[]" autocomplete="off" id="swebsite<?php echo $i;?>" placeholder="Website" value="<?php echo $swebsite[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('swebsite['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                            </div>
                                      </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                        <fieldset>
                                        <!-- <legend><?php echo $this->lang->line('client_address_arabic')?></legend> -->
                                        <div class="row">
                                              <div class="col-md-4">
                                              </div>
                                              <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('svendor_no1['.$i.']')){ echo 'has-error';} ?>">
                                            
                                                 <input type="text"  dir="rtl" autocomplete="off" class="form-control"  placeholder="VAT Number (Arabic)" id="svendor_no1<?php echo $i;?>" name="svendor_no1[]" value="<?php echo $svendor_vat_arabic[$i]; ?>">
                                                 <label class="error"><?php echo form_error('svendor_no1['.$i.']'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('scr_no_arabic['.$i.']')){ echo 'has-error';} ?>">
                                               
                                                 <input type="text"   dir="rtl" autocomplete="off" class="form-control"  placeholder="CR No (Arabic)" id="scr_no_arabic<?php echo $i;?>" name="scr_no_arabic[]" value="<?php echo $scr_no_arabic[$i]; ?>">
                                                 <label class="error"><?php echo form_error('scr_no_arabic['.$i.']'); ?></label>
                                            </div>
                                          </div> 
                                        </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="form-group <?php if(form_error('saddress11['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" class="form-control " dir="rtl" name="saddress11[]" autocomplete="off" id="saddress11<?php echo $i;?>" placeholder="Building Name/No., Apartment, Suite, Unit, Floor etc (Arabic)" value="<?php echo $saddress11[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('saddress11['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                          
                                            </div>
                                                  <div class="row">
                                                <div class="col-md-12" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('sstreet_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" class="form-control " dir="rtl" name="sstreet_arabic[]" autocomplete="off" id="sstreet_arabic<?php echo $i;?>" placeholder="Street Name (Arabic)" value="<?php echo $sstreet_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('sstreet_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                   <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sprovince_arabic['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text"  dir="rtl" class="form-control" name="sprovince_arabic[]" autocomplete="off" id="sprovince_arabic<?php echo $i;?>" placeholder="Province (Arabic)" value="<?php echo $sprovince_arabic[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sprovince_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                              
                                              <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sdistrict_arabic['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text"  dir="rtl" class="form-control" name="sdistrict_arabic[]" autocomplete="off" id="sdistrict_arabic<?php echo $i;?>" placeholder="District (Arabic)" value="<?php echo $sdistrict_arabic[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sdistrict_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('scity_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control " name="scity_arabic[]" autocomplete="off" id="scity_arabic<?php echo $i;?>" placeholder="City (Arabic) " value="<?php echo $scity_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('scity_arabic['.$i.']'); ?></label>
                                                </div>
                                              </div>
                                            
                                            </div>
                                            <div class="row">
                                               <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('scountry_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control" name="scountry_arabic[]" autocomplete="off" id="scountry_arabic<?php echo $i;?>" placeholder="Country (Arabic) " value="<?php echo $scountry_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('scountry_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                             
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('spo_box_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text"  dir="rtl" class="form-control " name="spo_box_arabic[]" dir="rtl" autocomplete="off" id="spo_box_arabic<?php echo $i;?>" placeholder="PO Box (Arabic) " value="<?php echo $spo_box_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('spo_box_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                                 <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('szip_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control " name="szip_arabic[]" autocomplete="off" id="szip_arabic<?php echo $i;?>" placeholder="Zip (Arabic) " value="<?php echo $szip_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('szip_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('sfax_arabic['.$i.']')){ echo 'has-error'; }?>">
            
                                          <input type="text"  dir="rtl" class="form-control" name="sfax_arabic[]" autocomplete="off" id="sfax_arabic<?php echo $i;?>" placeholder="Fax (Arabic)" value="<?php echo $sfax_arabic[$i];?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sfax_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                             
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no1_arabic['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text"  dir="rtl" class="form-control" name="slandline_no1_arabic[]" autocomplete="off" id="slandline_no1_arabic<?php echo $i;?>" placeholder="Phone No2 (Arabic)" value="<?php echo $slandline_no1_arabic[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no1_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no_arabic['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text"  dir="rtl" class="form-control" name="slandline_no_arabic[]" autocomplete="off" id="slandline_no_arabic<?php echo $i;?>" placeholder="Phone No1 (Arabic)" value="<?php echo $slandline_no_arabic[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                             
                                            </div>
                                             <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('swebsite_arabic['.$i.']')){ echo 'has-error'; }?>">
          
                                                <input type="text"  dir="rtl" class="form-control" name="swebsite_arabic[]" autocomplete="off" id="swebsite_arabic<?php echo $i;?>" placeholder="Website (Arabic)" value="<?php echo $swebsite_arabic[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('swebsite_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                           
                                            <div class="col-md-4" style="margin-top: -15px;">
                                               <div class="form-group <?php if(form_error('semail_arabic['.$i.']')){ echo 'has-error'; }?>">
              
                                            <input type="text"  dir="rtl" class="form-control" name="semail_arabic[]" autocomplete="off" id="semail_arabic<?php echo $i;?>" placeholder="Email (Arabic)" value="<?php echo $semail_arabic[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('semail_arabic['.$i.']'); ?></label>
                                             </div>
                                                </div>
                                                     <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('scontact_no_arabic['.$i.']')){ echo 'has-error'; }?>">
            
                                            <input type="text"  dir="rtl" class="form-control" name="scontact_no_arabic[]" autocomplete="off" id="scontact_no_arabic<?php echo $i;?>" placeholder="Mobile No ( Arabic )" value="<?php echo $scontact_no_arabic[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scontact_no_arabic['.$i.']'); ?></label>
                                            </div>
                                              </div>
                   </div>
                     <div class="row">

                          <div class="col-md-12" style="margin-top: -15px;" align="right">
                    <div class="form-group">
                     <a href="javascript:void(0);" onclick="getConfirmPart(<?PHP echo $i;?><?php echo ($scontact_address_id[$i]!='') ? ','.$scontact_address_id[$i] : '';?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div> 

                                              
                                            </div>
                                          </fieldset>
                                          </div>
                                       </div>
                  
               </div>
            