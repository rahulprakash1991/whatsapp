<div class="row allrowvalues"  id="rowssids_<?php echo $i;?>">
                                	<div class="col-md-5">
                                    	<div class="form-group <?PHP if(form_error('pro_item_id[]')){ echo 'has-error';} ?>">
			                                <?php 
			                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="pro_item_id'.$i.'" onChange="loadPriceDetails(this.value,'.$i.')"';
											echo form_dropdown('pro_item_id[]', $drop_menu_product_item, set_value('pro_item_id['.$i.']', (isset($pro_item_id[$i])) ? $pro_item_id[$i] : ''), $attrib);
											?>
			                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pro_item_id[]'); ?></label>
			                            </div>                   
			                            <div class="form-group">
			                                <input type="hidden" name="po_pdt_id[]" value="<?php echo $po_pdt_id[$i];?>" id="po_pdt_id[$i]">
		                            		</div> 			                            
									</div>

								<!--	<div class="col-md-1">
                                    	<div class="form-group" id="unit_id_drop<?php echo $i;?>" onChange="loadPriceDetails(this.value,<?php echo $i;?>)">
                                    		<?php 
			                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="unit'.$i.'"';
											echo form_dropdown('unit[]', $drop_menu_unit, set_value('unit['.$i.']', (isset($unit[$i])) ? $unit[$i] : ''), $attrib);
											?>
                                        	
			                            	
			                            	<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('unit[]');?></label>
		                            		</div>											
									</div>-->

									<div class="col-md-1">
										<div class="form-group <?PHP if(form_error('pieces_per_unit[]')){ echo 'has-error';} ?>">
											<input name="pieces_per_unit[]" autocomplete="off" class="form-control pieces_per_unit" id="pieces_per_unit<?php echo $i;?>" type="text" value="<?php echo $pieces_per_unit[$i]; ?>" placeholder="PCS/unit" readonly/>
											<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pieces_per_unit[]'); ?></label>
   			                            	<input name="unit[]" class="form-control unit" id="unit<?php echo $i;?>" type="hidden" size="75" required value="<?php echo $unit[$i]; ?>"/>
   			                            </div>
									</div>

									<div class="col-md-1">
										<div class="form-group <?PHP if(form_error('quantity[]')){ echo 'has-error';} ?>">
											<input name="quantity[]" autocomplete="off" class="form-control quantity" id="quantity<?php echo $i;?>" type="text" value="<?php echo $quantity[$i]; ?>" onkeyup="calculate();" onblur="calculate();" placeholder="Qty"/>
											<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('quantity[]'); ?></label>
   			                            </div>
									</div>
									
                                    <div class="col-md-1">
										<div class="form-group">
										<input name="tax_id[]" class="form-control tax_id" id="tax_id<?php echo $i;?>" type="hidden" size="75" value="<?php echo $tax_id[$i]; ?>" readonly placeholder="Tax" /> 

											<input name="tax_name[]" class="form-control tax_name" id="tax_name<?php echo $i;?>" type="hidden" size="75" readonly value="<?php echo $tax_name[$i]; ?>"/>

											<input name="tax_percent[]" class="form-control tax_percent" id="tax_percent<?php echo $i;?>" type="hidden" size="75" required readonly value="<?php echo $tax_percent[$i]; ?>"/>

											<input name="pdt_tax_amt[]" class="form-control pdt_tax_amt" id="pdt_tax_amt<?php echo $i;?>" type="hidden" value="<?php echo $pdt_tax_amt[$i]; ?>"  size="75" required readonly/>
											<input type="text" name="price_amt[]" autocomplete="off" class="form-control price_amt" id="price_amt<?php echo $i;?>" value="<?php echo $price_amt[$i];?>"  onkeyup="calculate();" placeholder="Price">
										</div>
									</div>		

									<div class="col-md-1">
										<div class="form-group <?PHP if(form_error('selling_price[]')){ echo 'has-error';} ?>">
											<input name="selling_tax[]" class="form-control selling_tax_amt" id="selling_tax_amt<?php echo $i;?>" type="hidden" value="<?php echo $selling_tax[$i]; ?>"  size="75" required readonly/>
											<input name="selling_price[]" autocomplete="off" class="form-control selling_price" id="selling_price<?php echo $i;?>" type="text" value="<?php echo $selling_price[$i]; ?>" onkeyup="calculate();" placeholder="Selling Price"/>
											<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('selling_price[]'); ?></label>
   			                            </div>
									</div>
                                    
									<div class="col-md-1">
										<div class="form-group">
											<input name="amount[]"  class="form-control amount" id="amount<?php echo $i;?>" type="text" value="<?php echo $amount[$i]; ?>" readonly  placeholder="Total Selling Price"/> 
   			                            </div>
									</div>
                                    
									<div class="col-md-1">
										<div class="form-group">
											<input name="cost_amount[]"  class="form-control cost_amount" id="cost_amount<?php echo $i;?>" type="text" value="<?php echo $cost_amount[$i]; ?>" readonly  placeholder="Total Cost Price"/> 
   			                            </div>
									</div>
                                    
									<div class="col-md-1"> 
										<span id="view">									
											<div class="col-md-1">
												<div class="form-group">
													<span id="pdt_id">
												 		<a data-toggle="modal" onclick="podetails(<?php echo $i; ?>)" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info btn-xs" title="Product Po Details"><i class="glyphicon glyphicon-th-list"></i></a>	
												 	</span>
	       			                            </div>
											</div>
										</span>
                                        &nbsp;
										<span>
											<div class="col-md-1">
												<a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
											</div>
										</span> 
									</div>
                                    
								</div>