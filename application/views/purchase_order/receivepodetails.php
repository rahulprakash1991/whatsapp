<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myLargeModalLabel">Purchase Order Details</h4>
</div>
<div class="modal-body">       
 		<?php
 					
	foreach($evalue1 as $key =>$row)
	{	
		$con_primary	 =	$row->con_primary;

	}

	foreach($value->result() as $row)
	{
		$po_id 			          =	$row->po_id;
	  	//$po_no 			          =	$row->po_no;
	  	$order_date 		      =	$row->order_date;
		$vendor_id 		          =	$row->vendor; 
		$ref_no 		          =	$row->ref_no;      
		$del_date 		          =	$row->order_date;
		$item_id 		          =	$row->item_id;    
		$ship_pref_id 	          =	$row->ship_pref_id;   
		$sub_total 				  =	$row->cost_price;
		//$selling_price          =	$row->selling_price;
		$total_cost_price 		  =	$row->total_cost_price;
		$total_selling_price 	  =	$row->total_selling_price;
		$terms 					  =	$row->terms;   
		$del_addr 				  =	$row->del_addr;
		$notes 					  =	$row->notes;
		$po 					  =	$row->po;			    
		$po_status 				  =	$row->po_status;	
	    $po_created_by 			  =	$row->po_created_by;			    
		$po_created_on 			  =	$row->po_created_on;			    
	}
	foreach($value1->result() as $row)
	{

		$po_id 			          =	$row->po_id;
	  	$po_no 			          =	$row->po_no;
	  	$order_date 		      =	$row->order_date;
		$vendor_id 		          =	$row->vendor; 
		$ref_no 		          =	$row->ref_no;      
		$del_date 		          =	$row->order_date;
		$item_id 		          =	$row->item_id;    
		$ship_pref_id 	          =	$row->ship_pref_id;   
		$sub_total 				  =	$row->cost_price;
		//$selling_price          =	$row->selling_price;
		$total_cost_price 		  =	$row->total_cost_price;
		$total_selling_price 	  =	$row->total_selling_price;
		$terms 					  =	$row->terms;   
		$del_addr 				  =	$row->del_addr;
		$notes 					  =	$row->notes;
		$po 					  =	$row->po;			    
		$po_status 				  =	$row->po_status;	
	    $po_created_by 			  =	$row->po_created_by;			    
		$po_created_on 			  =	$row->po_created_on;			    
	}

	$getCurrency=$this->pre->getCurrencynew();
			
	?>
	<div class="page-inner">
		<div id="main-wrapper">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label><strong>Vendor Name:</strong></label>
			                        </div>
								</div>
							
								<div class="col-md-2">
									<div class="form-group">
										<label><?php echo $con_primary;?></label>
			                        </div>
								</div>	
								<div class="col-md-2">
									<div class="form-group">
										<label><strong>PO Number:</strong></label>
			                        </div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label><?php echo $po_no;?></label>
			                        </div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label><strong>PO Date:</strong></label>
			                        </div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label><?php echo $order_date;?></label>
			                        </div>
								</div>
							</div>

							<hr>
						    <div class="row">
						    		<div class="col-md-1">
										<div class="form-group text-left">
											<label><strong> S.No</strong></label>
				                        </div>
									</div>
						  			<div class="col-md-4">
										<div class="form-group text-left">
										<label><strong>Product Item</strong></label>
				                            </div>
									</div>
									<div class="col-md-1">
										<div class="form-group text-left">
										<label><strong>PCS/unit</strong></label>
				                            </div>
									</div>
									<div class="col-md-1">
										<div class="form-group text-left">
											<label><strong> Qty</strong></label>
				                        </div>
									</div>
									<div class="col-md-2">
										<div class="form-group text-left">
											<label><strong>Sellling Price(<?php echo $getCurrency;?>)</strong></label>
				                            </div>
									</div>
									<div class="col-md-1">
										<div class="form-group text-left">
										<label><strong>Cost Price(<?php echo $getCurrency;?>)</strong></label>
			                            </div>
									</div>							
									<div class="col-md-1">
										<div class="form-group text-left">
											<label><strong>Total Selling Price(<?php echo $getCurrency;?>)</strong></label>
			                            </div>
									</div>
									<div class="col-md-1">
										<div class="form-group text-left">
											<label><strong>Total Cost Price(<?php echo $getCurrency;?>)</strong></label>
			                            </div>
									</div>																			
								</div>
								<legend style="padding-top: 0px;padding-bottom:0px;"></legend>
	              			 	<div class="row">
	                            	<div class="col-md-12"> 
	                        		    <?php
	                                       	$i=1;
											      foreach($podetails as $key =>$row)
												{	

 													$pro_item_id 	   			=	$row->pro_item_id;
													$pro_item_name 	  		    =	$row->pro_item_name;
													$unit_name		  	 		=	$row->unit_name;
													$pieces_per_unit   			=	$row->pieces_per_unit;
													$selling_price	   			=	$row->selling_price;
													$quantity		   			=	$row->quantity;
													$price_amt		   			=	$row->price_amt;
													$pdt_tax_amt	   			=	$row->pdt_tax_amt;
													$amount			   			=	$row->amount;	
													$cost_price		   			=	$row->cost_price;
													$cost_tax_amount   			=	$row->cost_tax_amount;
													$selling_tax_amount			=	$row->selling_tax_amount;
													$selling_total_amount		=	$row->selling_total_amount;
													$selling_total_amount1		+=	$row->selling_total_amount;
													$cost_total_amount 			= 	$row->cost_total_amount;
													$cost_total_amount1 		+= 	$row->cost_total_amount;
													$po_tax_id					=	$row->po_tax_id;
													$cost_tax					=	$row->cost_tax;
													$selling_tax				=	$row->selling_tax;	
													$tax_name					=	$row->tax_name;

											?>												
                                    		<div class="col-md-1 text-left">
	                                        	<div class="form-group">
					                                <td><?php echo $i++;?></td>
				                            	</div>					                            			
											</div>                                                            
	                                    	<div class="col-md-4 text-left">
	                                        	<div class="form-group">
					                               <?php echo $pro_item_name;?>
					                            </div>                			                            
											</div>
											<div class="col-md-1 text-left">
	                                        	<div class="form-group">
					                                <?php echo $pieces_per_unit;?>
				                            	</div>					                            			
											</div>
											<div class="col-md-1 text-left">
	                                        	<div class="form-group">
					                                <?php echo $quantity;?>
				                            	</div>					                            			
											</div>
											<div class="col-md-2 text-left">
												<div class="form-group">
													<?php echo $selling_price;?>
	       			                            </div>
											</div>
											<div class="col-md-1">
	                                        	<div class="form-group">
					                                <?php echo $cost_price;?>
	                            				</div>					                            			
											</div>
											<div class="col-md-1">
												<div class="form-group">
													<?php echo $selling_total_amount;?>
	       			                            </div>
											</div>
											<div class="col-md-1">
												<div class="form-group">
													<?php echo $cost_total_amount;?>
	       			                            </div>
											</div>
										<?php
							            }
						            ?> 
						            <legend style="padding-top: 0px;padding-bottom:0px;"></legend>
	                                   <div class="row">                             
											<div class="col-md-10 text-right">
	                                        	<div class="form-group">
	                                        		<strong>Sub Total</strong>
				                            		</div>											
											</div>												
											<div class="col-md-1">
												<div class="form-group">
													<strong><?php echo $getCurrency;?><?php echo number_format((float)$selling_total_amount1, 2, '.', '');?></strong>
	       			                            </div>			       			                            
											</div>
											<div class="col-md-1">
												<div class="form-group">
													<strong><?php echo $getCurrency;?><?php echo number_format((float)$cost_total_amount1, 2, '.', '');?></strong>
	       			                            </div>			       			                            
											</div>										
										</div>
										<?php foreach($get_tax as $key =>$row)
												{
													$tax_name 	   			=	$row->tax_name;
													$selling_tax 	  	    =	$row->selling_tax;
													$selling_tax1 	  	    +=	$row->selling_tax;
													$cost_tax  				=	$row->cost_tax;
													$cost_tax1  			+=	$row->cost_tax;

										?>
										<div class="row">                                                           
	                                    	<div class="col-md-10 text-right">
	                                        	<div class="form-group ">
	                                        		<strong><?php echo $tax_name?></strong>
				                            	</div>	
											</div>
											<div class="col-md-1">
	                                        	<div class="form-group">
	                                        		<strong><?php echo $selling_tax;?></strong>
				                            	</div>											
											</div>												
											<div class="col-md-1">
												<div class="form-group">
													<strong><?php echo $cost_tax;?></strong>
	       			                            </div>			       			                            
											</div>										
										</div>
							  			<?php }?>

										<div class="row">                                                    
	                                    	<div class="col-md-10 text-right">
	                                        	<div class="form-group ">
	                                        		<strong>Total</strong>
				                            	</div>
											</div>
											<div class="col-md-1">
	                                        	<div class="form-group">
	                                        		<?php $selling_total_amount1+$selling_tax1;?>
	                                        		<strong><?php echo $getCurrency;?><?php echo number_format((float)$selling_total_amount1, 2, '.', '');?></strong>
				                            	</div>											
											</div>												
											<div class="col-md-1">
												<div class="form-group">
													<?php $cost_total_amount2=$cost_total_amount1+$cost_tax1;?>
													<strong><?php echo $getCurrency;?><?php echo number_format((float)$cost_total_amount2, 2, '.', '');?></strong>
	       			                            </div>			       			                            
											</div>										
										</div>
									
							
										
										<?php
										    foreach($expense as $key =>$row)
												{	
 													$po_id 	   			=	$row->po_id;
													$expenses 	  	    =	$row->expenses;
													$re_expense_amount  =	$row->re_expense_amount;
													$re_expense_amount1  +=	$row->re_expense_amount;
												?>	
										
										<div class="row"> 		
											<div class="col-md-9">
	                                        </div>
										
									                                                                      
	                                    	<div class="col-md-1 ">
	                                        	<div class="form-group ">
	                                        		<strong>Expense</strong>
				                            	</div>
											</div>	
											<div class="col-md-1">
	                                        	<div class="form-group">
	                                        		<strong><?php echo $expenses;?></strong>
				                            	</div>											
											</div>												
											<div class="col-md-1">
												<div class="form-group">
													<strong><?php echo $getCurrency;?><?php echo number_format((float)$re_expense_amount, 2, '.', '');?></strong>
	       			                            </div>			       			                            
											</div>										
										</div>
										<?php } ?>	
									
										<div class="row">                                                                        
	                                    	<div class="col-md-11 text-right">
	                                        	<div class="form-group ">
	                                        		<strong>Total Sales Value:</strong>
				                            	</div>
											</div>
											<div class="col-md-1">
	                                        	<div class="form-group">
	                                        		<?php $selling_total_amount2=$selling_total_amount1+$selling_tax1;?>
	                                        		<strong><?php echo $getCurrency;?><?php echo number_format((float)$selling_total_amount2, 2, '.', '');?></strong>
	                                 
				                            	</div>											
											</div>	
										</div>
										<div class="row">  											
											<div class="col-md-11 text-right">
												<div class="form-group ">
													<strong>Total Purchase Value:</strong>
	       			                            </div>			       			                            
											</div>
											<div class="col-md-1">
	                                        	<div class="form-group">
	                                        		<?php $total1=$cost_total_amount2 + $re_expense_amount1;?>
	                                        		<strong><?php echo $getCurrency;?><?php echo number_format((float)$total1, 2, '.', '');?></strong>
				                            	</div>											
											</div>
										</div>

										<div class="row">
											<div class="col-md-11 text-right">
												<div class="form-group">
													<strong>Profit:</strong>
	       			                            </div>			       			                            
											</div>
											<?php  $total=$selling_total_amount2-$total1;?>
											<div class="col-md-1">
	                                        	<div class="form-group">
	                                        		<strong><?php echo $getCurrency;?><?php echo number_format((float)$total, 2, '.', '');?><strong>
				                            	</div>											
											</div>

										</div>	
	                                    
	                                </div>
	                           	</div>
	                                 <hr style="margin: 5px 0 !important;">
	                				<div class="clearfix"></div>

							
							</div>                         
							<?php echo form_close(); ?>
						</div>
				</div>
			</div>
		</div>
	</div><!-- Main Wrapper -->
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
        
