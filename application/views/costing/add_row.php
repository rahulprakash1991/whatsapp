<div class="row allrowvalues"  id="rowssids_<?php echo $i;?>">
                                	<div class="col-md-3">
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

							

									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('pieces_per_unit[]')){ echo 'has-error';} ?>">
											<input name="cost[]" autocomplete="off" class="form-control " id="cost<?php echo $i;?>" type="text" value="<?php echo $cost[$i]; ?>" placeholder="cost" readonly/>
											<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('cost[$i]'); ?></label>
   			                            </div>
									</div>

									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('quantity[]')){ echo 'has-error';} ?>">
										<input name="cost1[]" autocomplete="off" class="form-control " id="cost1<?php echo $i;?>" type="text" value="<?php echo $cost1[$i]; ?>"  placeholder="cost" readonly/>
   			                            </div>
									</div>
									
                                    <div class="col-md-2">
										<div class="form-group">
										
											<input type="text" name="cost2[]" autocomplete="off" class="form-control " id="cost2<?php echo $i;?>" value="<?php echo $cost2[$i];?>"   placeholder="cost" readonly/>
										</div>
									</div>		

									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('selling_price[]')){ echo 'has-error';} ?>">
											<input name="cost3[]" autocomplete="off" class="form-control" id="cost3<?php echo $i;?>" type="text" value="<?php echo $cost3[$i]; ?>"  placeholder="cost" readonly/>
   			                            </div>
									</div>
                                  
                                    
									<div class="col-md-1"> 
										
                                        &nbsp;
										<span>
											<div class="col-md-1">
												<a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
											</div>
										</span> 
									</div>
                                    
								</div>