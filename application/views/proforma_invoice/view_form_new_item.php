<?php
foreach($organization_detail->result() as $row) 
        {
            $company_abb    =   $row->c_org_abb;
            
        }
        ?>
<div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
       <?php if($company_abb=="SLH"){?>
                                 
                               
                                    <div class="col-md-1">
                                        <div class="row">
                                            <div class="form-group">
                                          
                                                <input type="text" name="slno[]"  autocomplete="off" class="form-control total_no" id="slno<?php echo $i;?>" value="<?php echo $slno[$i];?>"  placeholder="Sl No">
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="item<?php echo $i;?>" name="item[]" autocomplete="off" class="form-control " rows="2" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>">
                                            </div>                                      
                                    </div>
                                     <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('itemarabic['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="itemarabic<?php echo $i;?>" name="itemarabic[]" autocomplete="off" class="form-control " rows="2" style="min-height: 1px;text-align:right;"><?php echo $itemarabic[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('itemarabic['.$i.']'); ?></label>
                                        </div>                   
                                                                           
                                    </div>

                                          <?php if($company_abb=="LCK"){?>
                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('nationality['.$i.']')){ echo 'has-error';} ?>">
                                            <input name="nationality[]" autocomplete="off" class="form-control nationality" id="nationality<?php echo $i;?>" type="text" value="<?php echo $nationality[$i]; ?>" on placeholder="Nationality"/>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('nationality['.$i.']'); ?></label>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-1">
                                        <div class="form-group">
                                      
                                            <input type="text" name="total_no[]"  autocomplete="off" class="form-control total_no" id="total_no<?php echo $i;?>" value="<?php echo $total_no[$i];?>"  placeholder="Total No">
                                        </div>
                                    </div>      

                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('t_hour[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="t_hour[]" autocomplete="off" class="form-control t_hour" id="t_hour<?php echo $i;?>" type="text" value="<?php echo $t_hour[$i]; ?>"  placeholder=" Time/Hour "  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('t_hour[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="r_hour[]"  class="form-control r_hour" onkeyup="calculate();" id="r_hour<?php echo $i;?>" type="text" value="<?php echo $r_hour[$i]; ?>" placeholder="Rate/Hour" /> 
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                                <?php } ?>
                                     <?php if($company_abb=="NH" ||$company_abb=="ARA"){?>
                                  
                                    <div class="col-md-1">
                                            <div class="row">
                                            <div class="form-group">
                                          
                                                <input type="text" name="uniteng[]"  autocomplete="off" class="form-control uniteng" id="uniteng<?php echo $i;?>" value="<?php echo $uniteng[$i];?>"  placeholder="Unit">
                                            </div>
                                           
                                        </div>
                                    </div>      

                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('qty[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="qty[]" autocomplete="off" class="form-control qty" id="qty<?php echo $i;?>" type="text" value="<?php echo $qty[$i]; ?>"  placeholder=" Qty"  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('qty[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="unit_price[]"  class="form-control unit_price" onkeyup="calculate1();" id="unit_price<?php echo $i;?>" type="text" value="<?php echo $unit_price[$i]; ?>" placeholder="Unit Price" /> 
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($company_abb=="SLH"){?>
                                 
                                    

                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('qty[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="qty[]" autocomplete="off" class="form-control qty" id="qty<?php echo $i;?>" type="text" value="<?php echo $qty[$i]; ?>"  placeholder=" Qty"  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('qty[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="unit_price[]"  class="form-control unit_price" onkeyup="calculate1();" id="unit_price<?php echo $i;?>" type="text" value="<?php echo $unit_price[$i]; ?>" placeholder="Unit Price" /> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                                <?php } ?>
                                    <div class="col-md-1"> 
                                       
                                        <span>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($sal_item_id[$i]!='') ? ','.$sal_item_id[$i] : '';?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </span> 
                                    </div>
                                </div>