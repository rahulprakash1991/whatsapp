    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myLargeModalLabel">Invoice Details</h4>
    </div>
    <div class="modal-body">       
 		<?php
 			$trow = 0;
			if(isset($details) && !empty($details))
			{	
				foreach($details as $row)
				{
				  	$po_id 				=	$row->po_id;
					$vendor_id 			=	$row->sal_company_name1;					      
					$order_date 		=	$row->sal_order_date;
					$pro_item_id 		=   $row->pro_item_id;
					$quantity 			=   $row->quantity;
					$price_amt 	 		=   $row->price_amt;
					$unit 				=   $row->unit;
					$unit_name 			=   $row->unit_name;
					$con_company_name 	= 	$row->sal_company_name1;
					$pro_item_name 	  	= 	$row->pro_item_name;
					$trow++;		    
				}
				
			}
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
													<label><strong>Vendor</strong></label>
	       			                            </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<center><label><strong>Product Name</strong></label><center>
	       			                            </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label><strong>Unit</strong></label>
	       			                            </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label><strong>Quantity</strong></label>
	       			                            </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
												<label><strong>Price</strong></label>
	       			                            </div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
												<label><strong>Date</strong></label>
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
	                                            <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>">                                    
	                                            	<div class="col-md-2">
		                                            	<div class="form-group">
							                               <?php echo $con_company_name;?>
							                            </div>                   
							                            <div class="form-group">
							                                <input type="hidden" name="po_pdt_id[]" value="<?php echo $po_pdt_id[$i];?>" id="po_pdt_id[$i]">
		   			                            		</div> 			                            
													</div>
													<div class="col-md-2">
		                                            	<div class="form-group">
							                                <?php echo $pro_item_name;?>
		   			                            		</div>	
		   			                            			
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<?php echo $unit_name;?>
			       			                            </div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<?php echo $quantity;?>
			       			                            </div>
													</div>
													<div class="col-md-2">
		                                            	<div class="form-group">
		                                            		<?php echo $price_amt;?>
		   			                            		</div>											
													</div>
												
													<div class="col-md-2">
														<div class="form-group">
															<?php echo $order_date;?>
			       			                            </div>
			       			                            
													</div>
												
												
												</div>
												<?php 
                                       			$is++; } 
                                       			?>
                                       		</span>                                       		 
		                                    </div>
                                       	
		                                     <hr style="margin: 5px 0 !important;">
                            				<div class="clearfix"></div>

        							
           						</div>                         
									<?php echo form_close(); ?>
								</div>
						</div>
					</div>
				</div><!-- Row -->

					<!-- /page container -->
				
					

				</div>
			</div><!-- Main Wrapper -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
    </div>
        
