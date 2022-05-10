    <div class="modal-body">       
			<div class="page-inner" style="background:#FFFFFF !important;">
				<div id="main-wrapper" style="margin:0 !important;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
                            	<h4 class="modal-title" style="padding: 10px 0px 10px 20px;background: #12AFCB;color: #fff;">Last 10 Purchase Order Details</h4>
								<div class="panel-body">
                                    <div class="row" style="background: #ececec;padding: 5px 0 0 0;">
                                    <?php $getCurrency=$this->pre->getCurrencynew();?>
											<div class="col-md-2">
												<label><strong>PO No./ Date</strong></label>
											</div>										
						                	<div class="col-md-2">
                                                <label><strong>Vendor</strong></label>
											</div>
											<div class="col-md-2">
												<label><strong>Product Name</strong></label>
											</div>											
											<div class="col-md-1">
                                                <label><strong>PCS/Unit</strong></label>
											</div>
											<div class="col-md-1">
                                                <label><strong>Qty</strong></label>
											</div>
											<div class="col-md-2">
												<label><strong>Cost Price(<?php echo $getCurrency;?>)</strong></label>
											</div>
											<div class="col-md-2">
												<label><strong>Selling Price(<?php echo $getCurrency;?>)</strong></label>
											</div>
										</div>
										<legend style="padding-top: 0px;padding-bottom:0px;"></legend>
                          			 	<div class="row">
		                                	<div class="col-md-12">                  
			                                    <?php 
												foreach($details as $row)
												{
		                                            ?>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <small><?php echo $row->po_no;?></small> <br />
																<strong><?php echo date('d-M, Y', strtotime($row->receive_date));?></strong>
                                                            </div>										
                                                            <div class="col-md-2">
                                                                <?php echo $row->con_company_name;?>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <?php echo $row->pro_item_name;?>
                                                            </div>											
                                                            <div class="col-md-1">
                                                                <?php echo $row->pieces_per_unit;?>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <?php echo $row->quantity;?>
                                                            </div>
                                                            <div class="col-md-1" align="right">
                                                                <h4 style="margin-top: 0;"><?php echo $row->cost_price;?></h4>
                                                            </div>
                                                            <div class="col-md-2" align="right">
                                                                <h4 style="margin-top: 0;"><?php echo $row->selling_price;?></h4>
                                                            </div>
                                                        </div>   
                                                        <hr style="margin: 3px;"/>                                             
													<?php 
												} 
                                       			?>
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
				
    
<?php
if(!empty($sales_details))
{
	?>  

        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <h4 class="modal-title" style="padding: 10px 0px 10px 20px;background: #7a6fbe;color: #fff;">Last 10 Invoice Details</h4>
                    <div class="panel-body">
                        <div class="row" style="background: #ececec;padding: 5px 0 0 0;">
                                <div class="col-md-2">
                                    <label><strong>Invoice No./ Date</strong></label>
                                </div>										
                                <div class="col-md-2">
                                    <label><strong>Customer</strong></label>
                                </div>
                                <div class="col-md-3">
                                    <label><strong>Product Name</strong></label>
                                </div>											
                                <div class="col-md-1">
                                    <label><strong>PCS/Unit</strong></label>
                                </div>
                                <div class="col-md-1">
                                    <label><strong>Qty</strong></label>
                                </div>
                                <div class="col-md-2" align="right">
                                    <label><strong>Selling Price(<?php echo $getCurrency;?>)</strong></label>
                                </div>
                            </div>
                            <legend style="padding-top: 0px;padding-bottom:0px;"></legend>
                            <div class="row">
                                <div class="col-md-12">                  
                                    <?php 
                                    foreach($sales_details as $row)
                                    {
                                        ?>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <small><?php echo $row->sal_order;?></small> <br />
                                                    <strong><?php echo date('d-M, Y', strtotime($row->sal_order_date));?></strong>
                                                </div>										
                                                <div class="col-md-2">
                                                    <?php echo $row->con_company_name;?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php echo $row->pro_item_name;?>
                                                </div>											
                                                <div class="col-md-1">
                                                    <?php echo $row->pieces_per_unit;?>
                                                </div>
                                                <div class="col-md-1">
                                                    <?php echo $row->quantity;?>
                                                </div>
                                                <div class="col-md-2" align="right">
                                                    <h4 style="margin-top: 0;"><?php echo $row->price_amt;?></h4>
                                                </div>
                                            </div>   
                                            <hr style="margin: 3px;"/>                                             
                                        <?php 
                                    } 
                                    ?>
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
				
					
<?php
}
?>

				</div>
			</div><!-- Main Wrapper -->
    </div>    
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
        
