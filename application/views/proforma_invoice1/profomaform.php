<?php
if(isset($evalue) && !empty($evalue))
{
	foreach($value->result() as $row)
	{
		$pro_id 					=	$row->pro_id;
		$sal_company_name 			=	$row->pro_company_name; 
		$sal_customer_address 		=	$row->pro_customer_address; 
		$sal_reference_date 		=	$row->pro_reference_date; 
		$sal_despatch 				=	$row->pro_despatch;
		$sal_destination 			=	$row->pro_destination;
		$sal_terms_delivery 		=	$row->pro_terms_delivery;
		$sal_payment_terms 			=	$row->pro_payment_terms;
		$sal_credit_period 			=	$row->pro_credit_period;
		$sal_invoice_status 		=	$row->pro_invoice_status; 
		$sal_order 					=	$row->pro_order;
		$sal_order_date 			=	$row->pro_order_date;
		$sal_delivery_date 			=	$row->pro_delivery_date;
		$sal_delivery_method 		=	$row->pro_delivery_method;
		$sal_person 				=	$row->pro_person;
		$sal_reference 				=	$row->pro_reference;
		$item_id 					=	$row->item_id;    
		$sub_total 					=	$row->pro_sub_total;
		$total 						=	$row->pro_grand_total;
		$discount 					=	$row->pro_discount;
		$shipping_amount 			=	$row->pro_delivery_amount;					    
		$po_status 					=	$row->po_status;	
		$total_tax_amts				=	explode(',',$row->tax_amount);
		$tax_type					=	explode(',',$row->tax_type);
		$po_created_by 				=	$row->po_created_by;			    
		$po_created_on 				=	$row->po_created_on;			    
	}

	foreach($evalue as $key =>$row)
	{

		$pro_item_id[$key] 			=	$row->pro_item_id;
		$unit[$key] 				=	$row->unit;
		$quantity[$key] 			=	$row->quantity;
		$price_amt[$key] 			=	$row->price_amt;
		$sal_tax_percentage[$key] 	=	$row->sal_tax_percentage;
		$amount[$key] 				=	$row->amount;	
		$po_pdt_id[$key] 			=	$row->po_pdt_id;
		$tax_id[$key]				=	$row->tax_id;
		$tax_name[$key]				=	$row->tax_name;
		$tax_percent[$key]			=	$row->tax_percent;
		$available_qty[$key]		=	$row->available_qty;
		$total_tax_amt[$key]		=   $row->total_tax_amt;
		$sal_tax_percentage[$key] 	=	(( $values->tax_percent * $row->amount ) /100);

		 $trow++;		

		}	

}
else
{
		$sal_reference_date			= 	$this->input->post('sal_reference_date');
		$sal_despatch				= 	$this->input->post('sal_despatch');
		$discount					= 	$this->input->post('discount');
		$sal_destination			=	$this->input->post('sal_destination');
		$sal_terms_delivery			=	$this->input->post('sal_terms_delivery');
		$sal_payment_terms			=	$this->input->post('sal_payment_terms');
		$sal_credit_period			=	$this->input->post('sal_credit_period');
		$sal_company_name			= 	$this->input->post('sal_company_name');
		$sal_customer_address		= 	$this->input->post('sal_customer_address');
		$order_date					=	$this->input->post('order_date');
		$del_date					=	$this->input->post('del_date');
		$ref_no						=	$this->input->post('ref_no');
		$ship_pref_id				=	$this->input->post('ship_pref_id');
		$po_status     				= 	$this->input->post('po_status');
		$sal_delivery_method     	= 	$this->input->post('sal_delivery_method');
		$sal_person     			= 	$this->input->post('sal_person');
		$shipping_amount     		= 	$this->input->post('shipping_amount');
		$sal_reference     			= 	$this->input->post('sal_reference');
		$pro_item_id				=	$this->input->post('pro_item_id');
		$unit1 						=	$this->input->post('unit1');
		$available_qty				= 	$this->input->post('available_qty');
		$quantity     				= 	$this->input->post('quantity');
		$price_amt					=	$this->input->post('price_amt');
		$sal_tax_percentage			=	$this->input->post('sal_tax_percentage');
		$amount     				= 	$this->input->post('amount');
		$sub_total					=	$this->input->post('sub_total');
		$tot_tax_val				=	$this->input->post('tot_tax_val');
		$total 	     				= 	$this->input->post('total');
		$tax_percent 				= 	$this->input->post('tax_percent');
		$tax_name 	  			    = 	$this->input->post('tax_name');
		$total_tax_amt 	  			    = 	$this->input->post('total_tax_amt');
		$tax_id 	   				= 	$this->input->post('tax_id');
		$tax_type 	   				= 	explode(',',$this->input->post('tax_type'));
		$total_tax_amts				= 	explode(',',$this->input->post('total_tax_amt'));
		$trow						=	$this->input->post('attproduct');
}
	
	$i = 1;
	$trow = ($trow=='') ? 1 : $trow;

foreach ($tax_type as $key => $value)
{
	$total_tax_amt[$value] = $total_tax_amts[$key];

}
$getCurrency=$this->pre->getCurrencynew();
?>
			<div class="page-inner">
				<div class="page-title">
					<h3><?PHP echo $form_toptittle; ?></h3>
					<div class="page-breadcrumb">
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url();?>">Home</a></li>
							<li class="active"><?PHP echo $form_toptittle; ?></li>
						</ol>
					</div>
				</div>
				<div id="main-wrapper">

				<?php
				 if($notification)
					{
					?>
					<div class="alert alert-success no-border successmessage">
						<span class="text-semibold"> <?php echo $notification;?></span>
					</div>
					<?php
				}
				?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
									<h4 class="panel-title"><?PHP echo $form_tittle; ?></h4>
								</div>
								<div class="panel-body">
									<?php echo form_open_multipart($form_url); ?>
										<div class="row">
										 	<div class="col-md-3">
					                        	<div class="form-group">
					                        		<div class="form-group <?PHP if(form_error('sal_company_name')){ echo 'has-error';} ?>">
														<label>Customer Name</label>
					                               	 	<?php 
					                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_company_name" onChange="loadaddress(this.value)"';
														echo form_dropdown('sal_company_name', $drop_menu_customer, set_value('sal_company_name', (isset($sal_company_name)) ? $sal_company_name : ''), $attrib);
														?>
														 <label class="error"><?php echo form_error('sal_company_name'); ?></label>
													</div>
					                                     
       			                            	</div>
					                      	</div>	
					                      	<div class="col-md-3">
					                        	<div class="form-group">
					                        		<div class="form-group <?PHP if(form_error('sal_customer_address')){ echo 'has-error';} ?>">
														<label>Delivery Address</label>
					                               	 	<?php 
					                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_customer_address" ';
														echo form_dropdown('sal_customer_address', $drop_menu_address, set_value('sal_customer_address', (isset($sal_customer_address)) ? $sal_customer_address : ''), $attrib);
														?>
														 <label class="error"><?php echo form_error('sal_customer_address'); ?></label>
													</div>
					                                     
       			                            	</div>
					                      	</div>
				                      		<div class="col-md-3">
				                      			
						                       		 <div class="form-group <?PHP if(form_error('sal_order')){ echo 'has-error';} ?>">
						                            		<label>Invoice Number</label>
						                           			  <input type="text" class="form-control"  placeholder="Invoice Number" autocomplete="off" id="sal_order" name="sal_order" value="<?php echo $sal_order;?>" readonly>
						                           	 		 <label class="error"><?php echo form_error('sal_order'); ?></label>
					                        		</div>
					                        	
           			      					</div> 
           			      					 <div class="col-md-3">
												<div class="form-group <?PHP if(form_error('sal_order_date')){ echo 'has-error';} ?>">
													<label>Invoice Date <span1>*</span1></label>
													<input type="text" class="form-control date-picker" placeholder="Invoice Date" autocomplete="off" value="<?php echo ($sal_order_date!='' && $sal_order_date!='0000-00-00') ? $sal_order_date : date('d M, Y'); ?>" name="sal_order_date" id="sal_order_date" style="background-color:#fff"  >
													<label class="error"><?php echo form_error('sal_order_date'); ?></label>
												</div>
											</div>
										</div>
										<div class="row">
											<!--<div class="col-md-3">
                                   				 <div class="form-group <?PHP if(form_error('sal_delivery_date')){ echo 'has-error';} ?>">
                                       				 <label>Due Date:</label>
                                       				  <input type="text" class="form-control date-picker" placeholder="Order Date" autocomplete="off" value="<?php echo ($sal_delivery_date!='' && $sal_delivery_date!='0000-00-00') ? $sal_delivery_date : date('d M, Y'); ?>" name="sal_delivery_date" id="sal_delivery_date" style="background-color:#fff"  >
                                        			 <label class="error"><?php echo form_error('sal_delivery_date'); ?></label>
                                    			</div>
                               				 </div>  			                           
										
	   			                            <div class="col-md-3">
	       			                            <div class="form-group">
	       			                            
	       			                            <div class="form-group <?PHP if(form_error('sal_delivery_method')){ echo 'has-error';} ?>">
													<label>Shipment Preference</label>
													 

							                                <?php 
							                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_delivery_method"';
															echo form_dropdown('sal_delivery_method', $drop_menu_ship_pref, set_value('sal_delivery_method', (isset($sal_delivery_method)) ? $sal_delivery_method : ''), $attrib);
															?>
					                      
					                                  <label class="error"><?php echo form_error('sal_delivery_method'); ?></label>
					                                  </div>
	   			                            	</div>

	   			                            </div> -->  
   			                            	 <div class="col-md-3">
                                				<div class="form-group <?PHP if(form_error('sal_person')){ echo 'has-error';} ?>">
                                   					 <label>Sales Person:</label>
                                   					  <input type="text" class="form-control"  placeholder="Sales Person" id="sal_person" autocomplete="off" name="sal_person" value="<?php echo $sal_person; ?>">
                                   					  <label class="error"><?php echo form_error('sal_person'); ?></label>
                               					 </div>
                           					 </div>
				                           <div class="col-md-3">
				                                <div class="form-group <?PHP if(form_error('sal_reference')){ echo 'has-error';} ?>">
				                                    <label>Reference Number(If Any):</label>
				                                     <input type="text" class="form-control"  placeholder="Reference" id="sal_reference" autocomplete="off" name="sal_reference" value="<?php echo $sal_reference; ?>">
				                                     <label class="error"><?php echo form_error('sal_reference'); ?></label>
				                                </div>
				                            </div>
           			      					    			                           
       			      					 
       			      					
											<div class="col-md-3">
                                   				 <div class="form-group <?PHP if(form_error('sal_reference_date')){ echo 'has-error';} ?>">
                                       				 <label>Reference Date:</label>
                                       				  <input type="text" class="form-control date-picker" placeholder="Reference Date" autocomplete="off" value="<?php echo ($sal_reference_date!='' && $sal_reference_date!='0000-00-00') ? $sal_reference_date : date('d M, Y'); ?>" name="sal_reference_date" id="sal_reference_date" style="background-color:#fff"  >
                                        			 <label class="error"><?php echo form_error('sal_reference_date'); ?></label>
                                    			</div>
                               				 </div>
                               			
                               			
 										 	 <div class="col-md-3">
				                                <div class="form-group <?PHP if(form_error('sal_despatch')){ echo 'has-error';} ?>">
				                                    <label>Despatch Through:</label>
				                                     <input type="text" class="form-control"  placeholder="Despatch Through" id="sal_despatch" autocomplete="off" name="sal_despatch" value="<?php echo $sal_despatch; ?>">
				                                     <label class="error"><?php echo form_error('sal_despatch'); ?></label>
				                                </div>
				                            </div>
				                         </div> 
				                         <div class="row">   
                               				<div class="col-md-3">
                                				<div class="form-group <?PHP if(form_error('sal_destination')){ echo 'has-error';} ?>">
                                   					 <label>Destination:</label>
                                   					  <input type="text" class="form-control"  placeholder="Destination" id="sal_destination" autocomplete="off" name="sal_destination" value="<?php echo $sal_destination; ?>">
                                   					  <label class="error"><?php echo form_error('sal_destination'); ?></label>
                               					 </div>
                           					</div>
				                           <div class="col-md-3">
				                                <div class="form-group <?PHP if(form_error('sal_terms_delivery')){ echo 'has-error';} ?>">
				                                    <label>Terms of Delivery:</label>
				                                     <input type="text" class="form-control"  placeholder="Terms of Delivery" id="sal_terms_delivery" autocomplete="off" name="sal_terms_delivery" value="<?php echo $sal_terms_delivery; ?>">
				                                     <label class="error"><?php echo form_error('sal_terms_delivery'); ?></label>
				                                </div>
				                            </div>
           			      					 <div class="col-md-3">
					                        	<div class="form-group">
					                        		<div class="form-group <?PHP if(form_error('sal_payment_terms')){ echo 'has-error';} ?>">
														<label>Payment Terms:</label>
					                               	 	<?php 
					                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_payment_terms" onChange="menu_terms(this.value)"';
														echo form_dropdown('sal_payment_terms', $drop_menu_accountheads, set_value('sal_payment_terms', (isset($sal_payment_terms)) ? $sal_payment_terms : ''), $attrib);
														?>
														 <label class="error"><?php echo form_error('sal_payment_terms'); ?></label>
													</div>
					                                     
       			                            	</div>
					                      	</div>
				                        	 <div class="row">  
	 											<div class="col-md-3">
					                                <div class="form-group <?PHP if(form_error('sal_credit_period')){ echo 'has-error';} ?>">
					                                    <label>Credit Period(days):</label>
					                                     <input type="text" class="form-control"  placeholder="Credit Period" id="sal_credit_period" autocomplete="off" name="sal_credit_period" value="<?php echo $sal_credit_period; ?>">
					                                     <label class="error"><?php echo form_error('sal_credit_period'); ?></label>
					                                </div>
					                            </div>
	           			      				</div>
           			      			 </div>  		    	  	
										<legend style="padding-top: 0px;padding-bottom:0px;"></legend>                 
										<div class="row">
						                	<div class="col-md-4">
												<div class="form-group">
													<label><strong>Sales Item </strong></label>
	       			                            </div>
											</div>
											<!--<div class="col-md-2">
												<div class="form-group">
													<label><strong>UOM</strong></label>
	       			                            </div>
											</div>-->
											<div class="col-md-2">
												<div class="form-group">
													<label><strong>Available Qty</strong></label>
	       			                            </div>
											</div>
											
											<div class="col-md-2">
												<div class="form-group">
												<label class="error"><?php echo form_error('sal'); ?></label>
													<label><strong>Qty</strong></label>
	       			                            </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label><strong>Price(<?php echo $getCurrency;?>)</strong></label>
	       			                            </div>
											</div>
										
											<div class="col-md-2">
												<div class="form-group">
													<label><strong>Amount(<?php echo $getCurrency;?>)</strong></label>
	       			                            </div>
											</div>
										</div>
										<legend style="padding-top: 0px;padding-bottom:0px;"></legend>
                          			 	<div class="row">
		                                	<div class="col-md-12">                  
		                                	<span id="partProductData">
			                                    <?php 
		                                        $is=1;
		                                        for($i=0; $i < $trow; $i++)
										        {
		                                            ?>
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
													
												<!--	<div class="col-md-2">
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

																<input name="sal_tax_percentage[]" class="form-control sal_tax_percentage" id="sal_tax_percentage<?php echo $i;?>" type="hidden" value="<?php echo $sal_tax_percentage[$i]; ?>"  size="75" required readonly/>
																
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
												<?php 
                                       			$is++; } 
                                       			?>
                                       		</span>                                       		 
		                                    </div>
		                                    
                                       		<div class="row">
		                                        <div class="col-md-10"></div>
		                                        <div class="col-md-1">
		                                            <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
		                                            <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
		                                        </div>
		                                    </div>
		                                     <hr style="margin: 5px 0 !important;">
                            				<div class="clearfix"></div>
                            				 <div class="row">
	                                   				<div class="col-md-12">
	                                   					<div class="row">
	                                   						<div class="col-md-8">
																<div class="col-md-8">
		                                   							<div class="form-group">
																		<label class="control-label">Customer Notes</label>
										                               <textarea name="terms" class="form-control" ><?php echo $this->pref1->inv_notes;?></textarea>
						       			                            </div>
						       			                        </div>
						       			                       <!-- <div class="col-md-8">
		                                   							<div class="form-group">
																		<label class="control-label">Terms & Conditions</label>
										                               <textarea name="del_addr" class="form-control" ><?php echo  $this->pref1->inv_terms;?></textarea>
						       			                            </div>
						       			                        </div>-->
						       			                       
	                                   						</div>
	                                   						<div class="col-md-4">
					                                   			 <div class="col-md-4 text-right" >
						                                        	<label class="control-label">Sub Total(<?php echo $getCurrency;?>)</label>
						                                         </div>
																		 <div class="col-md-6">
																			<div class="form-group">
										                               			 <input type="text" name="sub_total" class="form-control sub_total" value="<?php echo $sub_total; ?>" id="sub_total" readonly  >
						       			                           			 </div>
						       			                        		</div>
						       			                        	<div class="col-md-4 text-right" >
						                                        	<label class="control-label">Discount(<?php echo $getCurrency;?>)</label>
						                                            </div>
																		 <div class="col-md-6">
																			<div class="form-group">
										                               			 <input type="text" name="discount" autocomplete="off" class="form-control discount" value="<?php echo $discount; ?>" id="discount" onkeyup="calculate();" onblur="calculate();" >
						       			                           			 </div>
						       			                        		</div>
		       			                        
		                                   
	                     
	                                   						<?php
												           foreach ($drop_menu_tax1 as $row)
												           {						            
												            ?> 
	                                   							<div class="col-md-4 text-right" >
		                                        					<label class="control-label"><?php echo $row->tax_name;?>(<?php echo $getCurrency;?>)</label>
		                                        				</div>
						                                        <div class="col-md-6">
																	<div class="form-group">		
																		<input name="total_tax_amt[]" class="form-control total_tax_amt" id="total_tax_amt<?php echo $row->tax_id;?>" type="text" value="<?php echo $total_tax_amt[$row->tax_id];?>" required readonly/>
			       			                           					<input name="tax_type[]" class="form-control tax_type" id="tax_type<?php echo $row->tax_id;?>" type="hidden" size="75" value="<?php echo $row->tax_id;?>" >   
			       			                            			</div>
						       			                        </div>
												            <?php
												            }
											            ?>
											            <div class="col-md-4 text-right" >
		                                        					<label class="control-label">Shipping Amount(<?php echo $getCurrency;?>)</label>
		                                        				</div>
						                                        <div class="col-md-6">
																	<div class="form-group">
										                                 <input type="text" name="shipping_amount" autocomplete="off" class="form-control sub_total" value="<?php echo $shipping_amount; ?>"id="shipping_amount" onkeyup="calculate();" onblur="calculate();"   >
						       			                            </div>
						       			                        </div>
											            		<div class="col-md-4 text-right" >
		                                        					<label class="control-label">Total(<?php echo $getCurrency;?>)</label>
		                                        				</div>
						                                        <div class="col-md-6">
																	<div class="form-group">
										                                 <input type="text" name="total" class="form-control" value="<?php echo $total; ?>" id="total" readonly  >
						       			                            </div>
						       			                        </div>
											            </div>
	                                   				</div>
	                                   			</div>
	                                   		</div>
	                                   		 <div class="row">
	                                   		 	<div class="col-md-2">
	                                   				<div class="checkbox <?PHP if(form_error('sal_invoice_status')){ echo 'has-error';} ?>">
	                                   					<label>                                                  
	                                                     	<div class="checker">
	                                                     		<span class="">	                                                      	
		                                                      		<input type="checkbox" name="sal_invoice_status" value="0" <?php if($sal_invoice_status=='0'){echo "checked";}?> >
		                                                      	</span>                                          	
	                                                     	</div> 
	                                                     	Save As Draft
	                                                     </label> 
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
	                                   				<div class="checkbox <?PHP if(form_error('sal_invoice_status')){ echo 'has-error';} ?>">
	                                   					<label>                                                  
	                                                     	<div class="checker $sal_invoice_status">
	                                                     		<span class="">	                                                      	
																	<input type="checkbox" name="sal_invoice_status" value="1" <?php if($sal_invoice_status=='1'){echo "checked";}?> >		                                                      	</span>                                          	
	                                                     	</div> 
	                                                     	 Save As Invoice
	                                                     </label> 
                                                    </div>
                                                </div>                                              
                                            </div>
                                       	<div class="row">
	        								<div class="text-center">
						                      <input type="hidden" name="pro_id" id="pro_id" value="<?php echo $pro_id;?>" />  
						                      <input type="hidden" name="po_status" value="1" />      
						                      <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($pro_id!='' ? 'Update Invoice' : 'Create Invoice'); ?> </button>
						                    </div>
						                </div>
           						</div>                         
									<?php echo form_close(); ?>
								</div>
						</div>
					</div>
				</div><!-- Row -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">                      	
        <div class="modal-content" id="viewajaxcontent">	 
        </div>
    </div>
</div>					<!-- /page container -->
					<script type="text/javascript">
						$(document).ready(function()
						{
							 calculate();
							 
							var oTable = $('#example').dataTable( {
								"bProcessing": true,
							responsive: true,
								"sAjaxSource": '<?php echo base_url().$datatable_url; ?>',
										"bJQueryUI": true,
										"sPaginationType": "full_numbers",
										"iDisplayStart ":20,
										"oLanguage": {
									"sProcessing": "<img src='<?php echo base_url(); ?>img/ajax-loader_dark.gif'>"
								},  
								"fnInitComplete": function() {
										//oTable.fnAdjustColumnSizing();
								 },
									'fnServerData': function(sSource, aoData, fnCallback)
									{
									  $.ajax
									  ({
										'dataType': 'json',
										'type'    : 'POST',
										'url'     : sSource,
										'data'    : aoData,
										'success' : fnCallback
									  });
									}
							} );
						} 
						);
					</script>
					<script type="text/javascript">
						function addNewPart()
						{
							row = $('#attproduct').val();
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/getPartNoContent'); ?>", 
								data: {i:row},
								dataType:"html",
								success: function(html)
								{
									//alert(html);
									
									//alert(row);
									$('#partProductData').append(html);
								
									$('#pro_item_id'+row).select2();
									//$('#unit'+row).select2();
								

									//calculateTotQuantity();	
									row = Number($('#attproduct').val()) + 1;	
									$('#attproduct').val( row );			
								},
							});
						}

						function menu_terms(id)
						{

							$.ajax({

								type: "GET",
								url: "<?php echo site_url('Sales_order/menu_terms'); ?>", 
								data: { payment_terms_id:id},
								dataType:"html",
								success: function(html)
								{	
									
									result = html.split('|');
							
									
									$("#sal_credit_period").val(result[1]);
						
									
								},
							});
						}
						function loadPriceDetails(id,i)
						{
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/getProductPriceDetails'); ?>", 
								data: { pro_item_id:id},
								dataType:"html",
								success: function(html)
								{	//alert(html);
									result = html.split('|');
									//$('#pro_item_id'+i).val(result[0]);
									//$('#pro_item_name'+i).val(result[1]);

									
									$('#price_amt'+i).val(result[2]);
									$('#tax_id'+i).val(result[3]);
									$('#tax_name'+i).val(result[4]);
									$('#tax_percent'+i).val(result[5]);
									$('#unit'+i).val(result[6]);
									//$("#unit"+i).select2("val", result[6]);
									$('#available_qty'+i).val(result[7]);
									checkproductdetails(id,i,result[6]);
									
								},
							});
						}

						function checkproductdetails(id,i,unitid)
						{
							var values = $("select[name='pro_item_id[]']").map(function(){return $(this).val();}).get();
							var numOccurences = $.grep(values, function (elem) 
							{
								return elem === id;
							}).length;

							if(numOccurences>1)
							{
								alert("Already you have choosen the Selected Product");
								$('#pro_item_id'+i).val('');
								$('#pro_item_id'+i).select2();
								$('#price_amt'+i).val(' ');
								$('#unit1'+i).val(' ');
								$('#tax_id'+i).val(' ');
								$('#tax_name'+i).val(' ');
								$('#tax_percent'+i).val(' ');
								$('#unit').val('');
							}
							else
							{
								loadunit(unitid,i);	
							}
							calculate();	
						}
						function loadaddress(id)
						{
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/loadaddress'); ?>", 
								data: { con_id:id},
								dataType:"html",
								success: function(html)
								{	
									
									$('#sal_customer_address').html(html);
									
								},
							});
						}

						function podetails(i)
						{
							var pdt_id = $('#pro_item_id'+i).val();
							var con_id = $('#sal_company_name').val();
			
							if(pdt_id > 0)
							{
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Purchase_order/viewdetails'); ?>", 
								data: { "pro_item_id":pdt_id, "con_id":con_id},
								dataType:"html",
								success: function(response)
								{
								  jQuery('#viewajaxcontent').html(response);
								  jQuery('.bs-example-modal-lg').modal('show', {});
														
								},
							});
							}else
							{
								alert("Please select item");
								jQuery('.bs-example-modal-lg').modal('toggle');
							}
						}

						function getConfirmPart(inv,prid)
						{
							//alert(prid);
						    var x;
						    var r=confirm("You Want Delete!!");
						    if(prid!='' && r==true)
						    {
						    	
						      $.ajax({"url":"<?php echo site_url('Sales_order/deleteproduct'); ?>",
						      "type":"GET",
						      data:{
						          "prid":prid
						      },

						      success:function(data)
						        {
						          //alert("Daelted Successfully");
						          $('#rowssids_'+inv+'').remove();
						          $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
						          calculate();
						        }
						      
						      });
						   
					    	}
						    else if (prid=='' && r==true)
						    {

						      $('#rowssids_'+inv+'').remove();
						      $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
						      calculate();	
						    }
						}
						function calculate()
						{
							
							
							var grandtotal = 0;
							var subtotal = 0;
							var tax = 0;
							$('.allrowvalues').each(function(i,o) 
							{
								var qty   			=	$(o).find('.quantity',this).val();									
								var available_qty   =	$(o).find('.available_qty',this).val();									
								var price 			=	$(o).find('.price_amt',this).val();
								var tax_percent 	=	$(o).find('.tax_percent',this).val();								
								var tax_id 			=	$(o).find('.tax_id',this).val();

							
								
								if(Number(available_qty)<Number(qty))								
								{
									alert('Quantity not alailable');
									$(o).find('.quantity',this).val('');
									$(o).closest('.form-group6').addClass('has-error');
								}
									


								var total 		= (Number(qty *1) * Number(price *1));
								total=parseFloat(Math.round(total* 100) / 100).toFixed(2);
								var tax_value 	= ((Number(tax_percent) * Number(total))/100);

								$(o).find('.sal_tax_percentage',this).addClass('tax_'+tax_id);

								$(o).find('.amount',this).val(total);
								$(o).find('.sal_tax_percentage',this).val(tax_value);

								//taxTotal	=	$('#total_tax_amt'+tax_id).val();								
								//$('#total_tax_amt'+tax_id).val(Number(taxTotal)+Number(tax_value));								


								grandtotal=grandtotal+Number(total);
								grandtotal1=parseFloat(Math.round(grandtotal* 100) / 100).toFixed(2);

								//tax+=Number(tax_value);	

							});

							$('#sub_total').val(grandtotal1);

							vat_list 	= 	document.getElementsByName('tax_id[]');
							var v 		=	vat_list.length;
							total_sum 	=	0;

							$(".total_tax_amt").val('0');

							for(j=0;j<v;j++)
							{
							   taxId = vat_list[j].value;

							   //alert(taxId);


							   $("#total_tax_amt"+taxId).val('0');


							       var sum=0;
							       k=0;
							     
							       $(".tax_"+taxId).each(function(index, element) 
							       {
							            sum=sum + Number($(this).val());
							            sum1=parseFloat(Math.round(sum* 100) / 100).toFixed(2);

							       });
							                
							       $("#total_tax_amt"+taxId).val(sum1);

							       total_sum+=sum;
							       
							}

							
							
							var discount=$('#discount').val();
							var shipping_amount=$('#shipping_amount').val();
							var available_qty=$('.available_qty').val();
							

							grandtotal = Number(grandtotal) - Number(discount);
							grandtotal = Number(grandtotal) + Number(total_sum);
							grandtotal = Number(grandtotal) + Number(shipping_amount);
							grandtotal=parseFloat(Math.round(grandtotal* 100) / 100).toFixed(2);
							$('#total').val(grandtotal);
						}





					</script>

					

				</div>
			</div><!-- Main Wrapper -->


	
	
