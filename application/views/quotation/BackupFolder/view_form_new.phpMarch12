
<div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
                             <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control summernote" onkeyup="CheckClientSelect();"  rows="1" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>">
                                            </div>                                      
                                    </div>
                                <!--      <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('itemarabic['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="itemarabic<?php echo $i;?>" name="itemarabic[]" autocomplete="off" class="form-control " rows="2" style="min-height: 1px;text-align:right;"><?php echo $itemarabic[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('itemarabic['.$i.']'); ?></label>
                                        </div>                   
                                                                           
                                    </div> -->

                                   
                                  
                                  <!--   <div class="col-md-1">
                                            <div class="row">
                                            <div class="form-group">
                                          
                                                <input type="text" name="uniteng[]"  autocomplete="off" class="form-control uniteng" id="uniteng<?php echo $i;?>" value="<?php echo $uniteng[$i];?>"  placeholder="Unit">
                                            </div>
                                           
                                        </div>
                                    </div>   --> 
                                       <div class="col-md-1">
                                        
                                              <div class="form-group <?PHP if(form_error('discount[]')){ echo 'has-error';} ?>">
                                          
                                                <input type="text" name="discount[]"  autocomplete="off" class="form-control discount" id="discount<?php echo $i;?>" value="<?php echo $discount[$i];?>"  placeholder="Dicount ">

                                                <input type="hidden" name="discount_amount[]"  autocomplete="off" class="form-control discount_amount" id="discount_amount<?php echo $i;?>" value="<?php echo $discount_amount[$i];?>"  >
                                                 <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('discount[]'); ?></label>
                                            </div>
                                           
                                       
                                    </div> 
                                       <div class="col-md-1">
                                        <div class="form-group" >
                                    
                                           
                                            <select name="vat_per1[]" id="vat_per1<?php echo $i;?>" class="form-control vat_per1" >
                                             <?php foreach ($drop_menu_tax_item as $key_id => $key_name) 
                                            {?>
                                            <option value="<?php echo $key_id;?>" <?php if($key_id == $vatper[$i]){?> selected <?php }?>><?php echo $key_name;?></option>

                                            <?php 
                                                }?>
                                            </select>
                                             </div>
                                              <input type="hidden" name="vat_amount1[]"  autocomplete="off" class="form-control vat_amount1" id="vat_amount1<?php echo $i;?>" value="<?php echo $vat_amount1[$i];?>"  >
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
                                  
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                                    <div class="col-md-1"> 
                                       
                                        <span>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($sal_item_id[$i]!='') ? ','.$sal_item_id[$i] : '';?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </span> 
                                    </div>
                                </div>
