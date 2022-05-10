<div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
                                	<div class="col-md-6">
                                    	<div class="form-group <?PHP if(form_error('item[]')){ echo 'has-error';} ?>">
			                                
                                                <!-- <input name="item[]"  class="form-control cost_amount" id="item'.$i.'" type="text" value="<?php echo $item[$i]; ?>"  placeholder="Discription"/>  -->
                                                   <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control " rows="3" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
			                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item[]'); ?></label>
			                            </div>                   
			                            <div class="form-group">
			                                <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="po_pdt_id[$i]">
		                            		</div> 			                            
									</div>

							

									<div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('quantity['.$i.']')){ echo 'has-error';} ?>">
                                            <input name="quantity[]" autocomplete="off" class="form-control quantity" id="quantity<?php echo $i;?>" type="text" value="<?php echo $quantity[$i]; ?>" on placeholder="Qty"/>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('quantity['.$i.']'); ?></label>
                                        </div>
                                    </div>
 									<div class="col-md-1">
                                        <div class="form-group">
                                        
                                            <!-- <input type="text" name="price_amt[]" autocomplete="off" class="form-control price_amt" id="price_amt<?php echo $i;?>" value="<?php echo $price_amt[$i];?>"  onchange="calculate(<?php echo $i;?>);" placeholder="Price"> -->
                                            <input type="text" name="price_amt[]" autocomplete="off" class="form-control price_amt" id="price_amt<?php echo $i;?>" value="<?php echo $price_amt[$i];?>"  onkeyup="calculate();" placeholder="Price">
                                        </div>
                                    </div>   
									
                                 <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('sub_total[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="sub_total[]" autocomplete="off" class="form-control sub_total" id="sub_total<?php echo $i;?>" type="text" value="<?php echo $sub_total1[$i]; ?>"  placeholder=" SubTotal "readonly />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sub_total[]'); ?></label>
                                        </div>
                                    </div>		

								 <div class="col-md-1">
                                        <div class="form-group">
                                            <!-- <input name="discount[]"  class="form-control discount" onkeyup="calculate1(<?php echo $i;?>);" id="discount<?php echo $i;?>" type="text" value="<?php echo $discount[$i]; ?>"placeholder="Discount"  /> --> 
                                            <input name="discount[]"  class="form-control discount" onkeyup="calculate();" id="discount<?php echo $i;?>" type="text" value="<?php echo $discount[$i]; ?>"placeholder="Discount"  />
                                        </div>
                                    </div>
                                    
								     <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control cost_amount" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 
                                        </div>
                                    </div>
                                    
									
                                    
									<div class="col-md-1"> 
									
										 <div class="col-md-1">
                                                <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($item_id[$i]!='') ? ','.$item_id[$i] : '';?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
									</div>
                                    
								</div>