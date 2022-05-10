     	<div class="row allrowvalues1"  id="rowssids_<?php echo $i;?>">
			                                            	<div class="col-md-12"> 
			                                            	<div class="col-md-7">
			                                            	</div>
				                                            	<div class="col-md-2">
					                                            	<div class="form-group <?PHP if(form_error('expenses_menu_id[]')){ echo 'has-error';} ?>">
										                                <?php 
										                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="expenses_menu_id'.$i.'" ';
																		echo form_dropdown('expenses_menu_id[]', $drop_menu_expenses, set_value('expenses_menu_id['.$i.']', (isset($expenses_menu_id[$i])) ? $expenses_menu_id[$i] : ''), $attrib);
																		?>
										                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('expenses_menu_id[]'); ?></label>
										                            </div>                   		                            
																</div>
																<div class="col-md-2">
																	<div class="form-group <?PHP if(form_error('expense_price[]')){ echo 'has-error';} ?>">
																		<input name="expense_price[]" autocomplete="off" class="form-control expense_price" id="expense_price<?php echo $i;?>" type="text" value="<?php echo ($expense_price[$i]) ? $expense_price[$i]: 0; ?>" placeholder="Expenses" onkeyup="calculate();" />
																		<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('expense_price[]'); ?></label>
						       			                            </div>
																</div>
																<span>
																	<a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
																</span>
															</div>
															</div>
