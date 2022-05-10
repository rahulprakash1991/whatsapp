        <div class="row allrowvalues" id="rowssids_<?php echo $i;?>">
													
													<div class="col-md-4">
		                                            	<div class="form-group">
							                                <?php 
							                       $attrib	= 'class="bootstrap-select" data-live-search="true" data-width="100%" id="pro_item_id'.$i.'" onChange="loadPriceDetails(this.value,'.$i.')"';

															echo form_dropdown('pro_item_id[]', $drop_menu_product_item, set_value('pro_item_id['.$i.']', (isset($pro_item_id[$i])) ? $pro_item_id[$i] : ''), $attrib);
															?>
							                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pro_item_id[]'); ?></label>
							                                 <input type="hidden" name="po_pdt_id[]" value="<?php echo $po_pdt_id[$i];?>" id="po_pdt_id[$i]">
		   			                            		</div>											
													</div>
													
													<!--<div class="col-md-2">
		                                            	<div class="form-group">
							                                <?php 
							                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="unit'.$i.'"';
															echo form_dropdown('unit[]', $drop_menu_unit, set_value('unit['.$i.']', (isset($unit[$i])) ? $unit[$i] : ''), $attrib);
															?>
							                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('unit[]'); ?></label>
		   			                            		</div>											
													</div>-->


													<div class="col-md-2">
														<div class="form-group">
															<input type="text" name="available_qty[]" autocomplete="off" class="form-control available_qty" id="available_qty<?php echo $i;?>" value="<?php echo $available_qty[$i];?>"  onkeyup="calculate();" placeholder="Price" readonly>
														<input name="unit[]" class="form-control unit" id="unit<?php echo $i;?>" type="hidden" size="75"  value="<?php echo $unit[$i]; ?>"/>

														</div>
													</div>	

																										
													<div class="col-md-2">
														<div class="form-group6" has-error>
																<input name="tax_id[]" class="form-control tax_id" id="tax_id<?php echo $i;?>" type="hidden" size="75" value="<?php echo $tax_id[$i]; ?>" readonly placeholder="Tax" /> 

																<input name="tax_name[]" class="form-control tax_name" id="tax_name<?php echo $i;?>" type="hidden" size="75" readonly value="<?php echo $tax_name[$i]; ?>"/>

																<input name="tax_percent[]" class="form-control tax_percent" id="tax_percent<?php echo $i;?>" type="hidden" size="75" required readonly value="<?php echo $tax_percent[$i]; ?>"/>

																<input name="pro_tax_percentage[]" class="form-control pro_tax_percentage" id="pro_tax_percentage<?php echo $i;?>" type="hidden" value="<?php echo $pro_tax_percentage[$i]; ?>"  size="75" required readonly/>
																
															<input name="quantity[]" class="form-control quantity" autocomplete="off" id="quantity<?php echo $i;?>" type="text" value="<?php echo $quantity[$i]; ?>" onkeyup="calculate();" onblur="calculate();" placeholder="Qty"/>
															<label class="error"><?php echo form_error("quanti"); ?></label>
			       			                            </div>
			       			                            
													</div>

													<div class="col-md-2">
														<div class="form-group">
															<input type="text" name="price_amt[]" class="form-control price_amt" autocomplete="off" id="price_amt<?php echo $i;?>" value="<?php echo $price_amt[$i];?>"  onkeyup="calculate();" placeholder="Price">
														</div>
													</div>	

													<div class="col-md-1">
														<div class="form-group">
															<input name="amount[]" class="form-control amount" autocomplete="off" id="amount<?php echo $i;?>" type="text" placeholder="Amt" value="<?php echo $amount[$i]; ?>"  /> 
			       			                            </div>
													</div>
													<div class="col-md-1"> 
														<span id="view">										
															<div class="col-md-1">
																<div class="form-group">
																	<span id="pdt_id">
																 	<a data-toggle="modal" onclick="podetails(<?php echo $i; ?>)" data-toggle="modal" data-target=".bs-example-modal-lg" class="glyphicon glyphicon-th-list"></a>	
																 	</span>
					       			                            </div>
															</div>
														</span>   
														<span>
															<a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
														</span>
			                                            
			                                        </div>	
			                                     
												</div>