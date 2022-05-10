<?php
if(isset($evalue) && !empty($evalue))
{
	foreach($value->result() as $row)
	{
	  	$po_id 			          =	$row->po_id;
		$vendor_id 		          =	$row->vendor; 
		$ref_no 		          =	$row->ref_no;      
		$del_date 		          =	$row->order_date;
		$item_id 		          =	$row->item_id;    
		$ship_pref_id 	          =	$row->ship_pref_id;   
		$sub_total 				  =	$row->cost_price;
		$total 					  =	$row->total_cost_price;
		$selling_price_total_tax  =	$row->total_selling_price;
		$terms 					  =	$row->terms;   
		$del_addr 				  =	$row->del_addr;
		$notes 					  =	$row->notes;
		$po 					  =	$row->po;			    
		$po_status 				  =	$row->po_status;	
	    $po_created_by 			  =	$row->po_created_by;			    
		$po_created_on 			  =	$row->po_created_on;
		$po_rev = $row->po_rev;	
		$po_number = $row->po_no;
	    
	}

	foreach($evalue as $key =>$row)
	{	
		$po_pdt_id[$key] 		=	$row->po_pdt_id;    	
		$pro_item_id[$key] 		=	$row->pro_item_id;
		$pieces_per_unit[$key] 	=	$row->pieces_per_unit;
		$selling_price[$key] 	=	$row->selling_price;
		$price_amt[$key] 	    =	$row->cost_price;
		$unit[$key] 			=	$row->unit;
		$quantity[$key] 		=	$row->quantity;
		$recd_qty[$key] 		=	$row->recd_qty;
		$pdt_tax_amt[$key] 		=	$row->cost_tax_amount;
		$selling_tax[$key] 		=	$row->selling_tax_amount;
		$amount[$key] 			=	$row->selling_total_amount;
		$cost_amount[$key] 		=	$row->cost_total_amount;
		$tax_name[$key] 	    =	$row->tax_name;
		$tax_id[$key] 	        =	$row->tax_id;
		$tax_percent[$key] 	    =	$row->tax_percent;
		
		$trow++;
	}
	foreach($expense as $key =>$row)
	{	
		$expenses_menu_id[$key] =	$row->po_expense_id;
		$expense_id[$key] 		=	$row->expense_id;
		$expense_price[$key] 	=	$row->po_expense_amount;
		$trow1++;
	}

}
else
{
	$sub_total 				 = 	$this->input->post('sub_total');
	$cost_amount             = 	$this->input->post('cost_amount');
	$total_selling_tax       = 	$this->input->post('total_selling_tax');
	$selling_total           = 	$this->input->post('selling_total');
	$expense_price           = 	$this->input->post('expense_price');
	$selling_expense_total   = 	$this->input->post('selling_expense_total');
	$overall_profit          =	$this->input->post('overall_profit');
	$overall_selling_price   = 	$this->input->post('overall_selling_price');
	$overall_purchase_price  =  $this->input->post('overall_purchase_price');
	$pieces_per_unit		 = 	$this->input->post('pieces_per_unit');
	$selling_price			 = 	$this->input->post('selling_price');
	$vendor_id				 = 	$this->input->post('vendor_id');
	$order_date				 =	$this->input->post('order_date');
	$del_date				 =	$this->input->post('del_date');
	$ref_no					 =	$this->input->post('ref_no');
	$ship_pref_id			 =	$this->input->post('ship_pref_id');
	$po_status     			 = 	$this->input->post('po_status');
	$terms					 =	$this->input->post('terms');
	$del_addr				 =	$this->input->post('del_addr');
	$notes     				 = 	$this->input->post('notes');
	$po 					 =	$row->po;
	$pro_item_id			 =	$this->input->post('pro_item_id');
	$unit1 					 =	$this->input->post('unit1');
	$uom2 					 =	$this->input->post('uom2');
	$price1					 =	$this->input->post('price1');
	$unit 					 =	$this->input->post('unit');
	$quantity     			 = 	$this->input->post('quantity');
	$price_amt				 =	$this->input->post('price_amt');
	$pdt_tax_amt			 =	$this->input->post('pdt_tax_amt');
	$amount     			 = 	$this->input->post('amount');
	$tot_tax_val			 =	$this->input->post('tot_tax_val');
	$total 	     			 = 	$this->input->post('total');
	$tax_percent 			 =	$this->input->post('tax_percent');
	$tax_name 	    		 = 	$this->input->post('tax_name');
	$tax_id 	    		 = 	$this->input->post('tax_id');
	$total_tax_amt 	    	 = 	$this->input->post('total_tax_amt');
	$tax_type 	    		 = 	explode(',',$this->input->post('tax_type'));
	$total_tax_amts 		 =	explode(',',$this->input->post('total_tax_amt'));
	$trow					 =	$this->input->post('attproduct');
	$trow1					 =	$this->input->post('attproduct1');
}

$i = 1;

$trow 	= ($trow=='') 	? 1 : $trow;
$trow1 	= ($trow1=='') 	? 1 : $trow1;

foreach ($tax_type as $key => $value)
{
	$total_tax_amt[$value] = $total_tax_amts[$key];
}
$getCurrency=$this->pre->getCurrencynew();
?>
<div class="page-inner">
	<div class="page-title">
		<h3><strong><?PHP echo $form_toptittle; ?></strong></h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url();?>"><strong>Home</strong></a></li>
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
		<?php echo form_open_multipart($form_url); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title"></h4>
					</div>
					<div class="panel-body">			
						<div class="row">
						 	<div class="col-md-3">
	                        	<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
	                        		<label>Vendor Name <span1>*</span1></label>
	                               	 	<?php 
	                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id"'.$rfiDisable.'';
										echo form_dropdown('vendor_id', $drop_menu_vendor, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
										?>
										 <label class="error"><?php echo form_error('vendor_id'); ?>
									</label>
	                            </div>
	                      	</div>	
                      		<div class="col-md-3">
		                        <div class="form-group <?PHP if(form_error('po_no')){ echo 'has-error';} ?>">
		                            <label>PO Number</label>
		                            <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Purchase Order Number" id="po_no" name="po_no" value="<?php echo $po_number;?>" readonly>
		                            <label class="error"><?php echo form_error('po_no'); ?></label>
	                        	</div>
		      				</div> 
		      				<div class="col-md-3">
								<div class="form-group <?PHP if(form_error('order_date')){ echo 'has-error';} ?>">
									<label>PO Date</label>								
									<input type="text" autocomplete="off" class="form-control date-picker" placeholder="Order Date" value="<?php echo ($order_date!='' && $order_date!='0000-00-00') ? date('m/d/Y', strtotime($order_date)) : date('m/d/Y'); ?>" name="order_date" id="order_date" style="background-color:#fff" <?php echo $rfiReadonly;?>>
								</div>
                               	<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('order_date'); ?></label>
	                        </div>
	                       <!-- <div class="col-md-3">
								<div class="form-group <?PHP if(form_error('del_date')){ echo 'has-error';} ?>">
									<label>Expected Delivery Days</label>
									<input type="text" autocomplete="off" class="form-control"  placeholder="Enter delivery days" id="del_date" name="del_date" value="<?php echo $del_date; ?>">
									<label class="error"><?php echo form_error('del_date'); ?></label>
								</div>				                               		
	                        </div>      			                           
						</div>
						<div class="row">-->
							<!--<div class="col-md-3">
		                            <div class="form-group">
									<label>Item Rate As</label>
	                                <?php 
	                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="item_id"';
									echo form_dropdown('item_name', $drop_menu_item, set_value('item_id', (isset($item_id)) ? $item_id : ''), $attrib);
									?>
	                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item_id'); ?></label>
	                            	</div>
	                            </div>-->
                            <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Reference Number (If Any)</label>
		                            <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Reference Number" id="ref_no" name="ref_no" value="<?php echo $ref_no; ?>">
	                        	</div>
		      				</div>
		      				<!--<div class="col-md-3">
		                        <div class="form-group">
									<label>Shipment Preference</label>
	                                <?php 
	                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="ship_pref_id"';
									echo form_dropdown('ship_pref_id', $drop_menu_ship_pref, set_value('ship_pref_id', (isset($ship_pref_id)) ? $ship_pref_id : ''), $attrib);
									?>
	                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('ship_pref_id'); ?></label>
	                            </div>
	                        </div> -->      			                           
	      				</div>
						<legend style="padding-top: 0px;padding-bottom:0px;"></legend>   
						<div class="panel panel-#b4b4b4">
							<div class="row">
			                	<div class="col-md-5">
									<label><strong>Product Name</strong></label>
								</div>
								<!--<div class="col-md-1">
									<center><label><strong>Unit</strong></label></center>
								</div>-->
								<div class="col-md-1">
                                    <center><label><strong>PCS/unit</strong></label></center>
								</div>
								<div class="col-md-1">
                                    <center><label><strong>Qty </strong></label></center>
								</div>
								<div class="col-md-1" >
                                    <center><label><strong>Cost Price(<?php echo $getCurrency;?>)</strong></label></center>
								</div>
								<div class="col-md-1">
                                    <center><label><strong>Sell. Price(<?php echo $getCurrency;?>)</strong></label></center>
								</div>
								<div class="col-md-1" >
                                    <center><label><strong>Total Selling(<?php echo $getCurrency;?>)</strong></label></center>
								</div>
								<div class="col-md-1" >
                                    <center><label><strong>Total Cost(<?php echo $getCurrency;?>)</strong></label></center>
								</div>										
							</div>
						</div>
						<div class="row">                 
                        		<span id="partProductData">
                                <?php 
                                $is=1;
                                for($i=0; $i < $trow; $i++)
						        {

                                    ?>
                                <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>">
                                	<div class="col-md-5">
                                    	<div class="form-group <?PHP if(form_error('pro_item_id['.$i.']')){ echo 'has-error';} ?>">
			                                <?php 
			                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="pro_item_id'.$i.'" onChange="loadPriceDetails(this.value,'.$i.')"';
											echo form_dropdown('pro_item_id[]', $drop_menu_product_item, set_value('pro_item_id['.$i.']', (isset($pro_item_id[$i])) ? $pro_item_id[$i] : ''), $attrib);
											?>
			                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pro_item_id['.$i.']'); ?></label>
			                            </div>                   
			                            <div class="form-group">
			                                <input type="hidden" name="po_pdt_id[]" value="<?php echo $po_pdt_id[$i];?>" id="po_pdt_id<?php echo $i;?>">
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
										<div class="form-group <?PHP if(form_error('pieces_per_unit['.$i.']')){ echo 'has-error';} ?>">
											<input name="pieces_per_unit[]" autocomplete="off" class="form-control pieces_per_unit" id="pieces_per_unit<?php echo $i;?>" type="text" value="<?php echo $pieces_per_unit[$i]; ?>" placeholder="PCS/unit" readonly/>
											<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pieces_per_unit[$i]'); ?></label>
   			                            	<input name="unit[]" class="form-control unit" id="unit<?php echo $i;?>" type="hidden" size="75" required value="<?php echo $unit[$i]; ?>"/>
   			                            </div>
									</div>

									<div class="col-md-1">
										<div class="form-group <?PHP if(form_error('quantity['.$i.']')){ echo 'has-error';} ?>">
											<input name="quantity[]" autocomplete="off" class="form-control quantity" id="quantity<?php echo $i;?>" type="text" value="<?php echo $quantity[$i]; ?>" onkeyup="calculate();" onblur="calculate();" placeholder="Qty"/>
											<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('quantity['.$i.']'); ?></label>
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
												<a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($po_pdt_id[$i]!='') ? ','.$po_pdt_id[$i] : '';?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
											</div>
										</span> 
									</div>
								</div>
								<?php 
                       			$is++; 
                       			} 
                       			?>
                       			</span>                                       		 
                        </div>
                                            
                        <div class="row">
                        	<div class="col-md-12">
                       			<div class="col-md-10">
                                </div>
                                <div class="col-md-2 text-right">
                                    <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
                                    <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
                                </div>
                            </div>
                      	</div>
                        
                        <hr style="margin: 20px 0 !important;">
                        
                		<div class="row">
	       					<div class="col-md-3">
	   							<div class="form-group">
									<label class="control-label"><strong>Delivery Address</strong></label>
	                               <textarea name="del_addr" class="form-control" ><?php echo $del_addr; ?></textarea>
		                        </div>
	   			         	</div>
	       					<div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-7 text-right" >
                                        <label class="control-label"><strong>Sub Total(<?php echo $getCurrency;?>)</strong></label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                        <input type="text" name="selling_total" class="form-control selling_total" value="<?php echo $selling_total; ?>" id="selling_total" readonly  >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="sub_total" class="form-control sub_total" value="<?php echo $sub_total; ?>" id="sub_total" readonly  >
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                
								<?php
                                foreach ($drop_menu_tax1 as $row)
                                {						            
                                ?> 
                                    <div class="row">	
                                        <div class="col-md-7 text-right" >
                                        <label class="control-label"><strong><?php echo $row->tax_name;?>(<?php echo $getCurrency;?>)</strong></label>
                                        </div>
                                        
                                        <div class="col-md-2">
                                        <div class="form-group">		
                                            <input name="total_selling_tax[]" class="form-control total_selling_tax" id="total_selling_tax<?php echo $row->tax_id;?>" type="text" value="<?php echo $total_selling_tax[$row->tax_id];?>" required readonly/>
                                            <input name="tax_type[]" class="form-control tax_type" id="tax_type<?php echo $row->tax_id;?>" type="hidden" size="75" value="<?php echo $row->tax_id;?>" >   
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                        <div class="form-group">		
                                            <input name="total_tax_amt[]" class="form-control total_tax_amt" id="total_tax_amt<?php echo $row->tax_id;?>" type="text" value="<?php echo $total_tax_amt[$row->tax_id];?>" required readonly/>
                                        </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                
                                <div class="row">
                                    <div class="col-md-7 text-right" >
                                        <label class="control-label"><strong>Total(<?php echo $getCurrency;?>)</strong></label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="selling_price_total_tax"	class="form-control" value="<?php echo $selling_price_total_tax; ?>" id="selling_price_total_tax" readonly  >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="total" class="form-control" value="<?php echo $total; ?>" id="total" readonly  >
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                
                            </div>
						</div>
				    </div>
              	</div>
			</div>
		</div>
        <div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">			
		 			<div class="panel-body"> 
      						<h3>Other Expenses</h3>
                                <div class="row">  
                                    <div class="col-md-12">  
                                        <span id="partProductData1">
                                             <?php 
                                            $it=1;
                                            for($i=0; $i < $trow1; $i++)
                                            {
                                                ?>
                                                <div class="row allrowvalues1"  id="rowssids1_<?php echo $i;?>">
                                                    <div class="col-md-12"> 
                                                        <div class="col-md-7"></div>
                                                        <div class="col-md-2">
                                                            <div class="form-group <?PHP if(form_error('expenses_menu_id[]')){ echo 'has-error';} ?>">
															<?php 
                                                            $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="expenses_menu_id'.$i.'"';
                                                            echo form_dropdown('expenses_menu_id[]', $drop_menu_expenses, set_value('expenses_menu_id['.$i.']', (isset($expenses_menu_id[$i])) ? $expenses_menu_id[$i] : ''), $attrib);
                                                            ?>
                                                            <label id="location-error" class="validation-error-label" for="location">
																<?php echo form_error('expenses_menu_id[]'); ?>
                                                            </label>
                                                            </div>                   		                            
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="form-group <?PHP if(form_error('expense_price[]')){ echo 'has-error';} ?>">
                                                                <input name="expense_price[]" autocomplete="off" class="form-control expense_price" id="expense_price<?php echo $i;?>" type="text" value="<?php echo ($expense_price[$i]) ? $expense_price[$i]: 0; ?>" placeholder="Expenses" onkeyup="calculate();" />
                                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('expense_price[]'); ?></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <span>
                                                            <a href="javascript:void(0);" onclick="getConfirmPart1(<?php echo $i;?>
                                                            <?php echo ($expense_id[$i]!='') ? ','.$expense_id[$i] : '';?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            	<?php 
                                            $it++; 
                                            } 
                                            ?>
                                        </span>                                       		 
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-11">
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <a onclick="addNewpricePart()" class="label label-danger"> Add New </a>    
                                        <input type="hidden" name="attproduct1" id="attproduct1" value="<?PHP echo $it-1?>" />
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-9 text-right" >
                                    	<strong>Total Expense(<?php echo $getCurrency;?>)</strong>
                                    </div>  
                                    <div class="col-md-2" valign="left">
                                        <div class="form-group">
                                            <input type="text" name="selling_expense_total" class="form-control selling_expense_total" value="<?php echo $selling_expense_total; ?>" id="selling_expense_total" readonly  >
                                        </div>
                                    </div>
                                </div>
						<hr>
                        <div class="col-md-12">  
	                        <div class="row">
	                       		<div class="col-md-6"></div>
	                       		<div class="col-md-2">
                        			<label class="control-label"><strong>Total Sales Value(<?php echo $getCurrency;?>):</strong></label>
	                          		<input type="text" name="overall_selling_price" class="form-control Overall_selling_price" value="<?php echo $overall_selling_price; ?>" id="overall_selling_price" readonly  >
		                       	</div>
                                
                     			<div class="col-md-2">
                        			<label class="control-label"><strong>Total Purchase Value(<?php echo $getCurrency;?>):</strong></label>
                                    <input type="text" name="overall_purchase_price" class="form-control Overall_purchase_price" value="<?php echo $overall_purchase_price; ?>" id="overall_purchase_price" readonly  >
		                       	</div>
                                
   								<div class="col-md-2">
                        			<label class="control-label"><strong>Profit(<?php echo $getCurrency;?>):</strong></label>
                           			<input type="text" name="overall_profit" class="form-control onerall_profit" value="<?php echo $overall_profit; ?>" id="overall_profit" readonly  >
		                       	</div>
	                        </div>
	                    </div>
					</div>
				</div> 
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">			
						<hr style="margin: 5px 0 !important;">
        				<div class="clearfix"></div>
        				<!--	<div class="panel-heading clearfix">
							<h4 class="panel-title">Payment Management</h4>
						</div>-->
        				<div class="panel-body">               					
							<div class="row">											
								<div class="col-md-2">
									<div class="form-group">
										<label class="display-block">Pre Payment</label>
										<label class="radio-inline">
											<div class="choice"><input type="radio" name="status" class="styled" <?php if($po_status=='1'){?> checked="checked"  <?php }?>value="1" onclick="check()"> Yes
											</div>	
										</label>
										<label class="radio-inline">
											<div class="choice"><input type="radio" name="status" class="styled" <?php if($po_status=='0'){?> checked="checked" <?php }?>  value="0" onclick="check()">No
											</div>															
										</label>
									</div>
								</div>
								
									
						
								<div class="col-md-2" style="<?PHP if($po_status =='1'){?>display:block;<?php }else{?>display:none;<?php }?>" id="advance_status">
									<div class="form-group">
 										<label>Bank Name</label>
												<?php 	
		                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%"  id="bank_id"';
											echo form_dropdown('bank_id', $drop_menu_bank, set_value('bank_id', (isset($bank_id)) ? $bank_id : ''), $attrib);
											?>				
									</div>
								</div>
								<div class="col-md-2" style="<?PHP if($po_status =='1'){?>display:block;<?php }else{?>display:none;<?php }?>" id="advance_status1">
									<div class="form-group">
										<label>Payment Mode</label><br/>
										<?php 											
		                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" onchange="paymentmode(this.value)" id="payment_mode_id"';
											echo form_dropdown('payment_mode_id', $drop_menu_payment_mode, set_value('payment_mode_id', (isset($payment_mode_id)) ? $payment_mode_id : ''), $attrib);
											?>	
		                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('mode'); ?></label>
			                            </div>
								</div>	
																	
								 <div class="col-md-2 form-group" id="cash1" style="display: none;">
											<label class="" id="trans_no"></label>
												<input type="hidden" class="form-control date-picker" value="<?php echo ($date!='' && $date!='0000-00-00') ? date('m/d/Y', strtotime($date)) : date('m/d/Y'); ?>" name="date" id="date" style="background-color:#fff">	

												<input type="text" class="form-control" name="voucher_number" id="voucher_number">     
									</div>
									<div class="col-md-2 form-group" id="cash2" style="display: none;">
 										<label class="" id="trans_date"></label>
												<input type="text" class="form-control date-picker" value="<?php echo ($neft_date!='' && $neft_date!='0000-00-00') ? date('m/d/Y', strtotime($neft_date)) : date('m/d/Y'); ?>" name="neft_date" id="neft_date" style="background-color:#fff">
									</div>
                                <div class="col-md-2 form-group" id="cash3" style="display: none;">
											<label class="" id="trans_amt"></label>
										<input type="text" class="form-control" name="amt" id="amt">     
									</div>                              
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-body">
							<div class="row">
           						<div class="col-md-8">
									<div class="form-group ">
                                        <label class="radio-inline">
											<div class="choice">
												<span class="checked">
													<input type="radio" name="po" class="styled" value="1" checked="">
												</span>Save as PO
											</div> 
                                        </label><br/>
                                        <label class="radio-inline">
											<div class="choice"><span class=""><input type="radio" name="po" class="styled" value="0"></span>Save as Receive PO</div> 
                                        </label>
						 				<label class="error"></label>
									</div>								
           						</div>
                                
           						<div class="col-md-4 text-right">
								  <input type="hidden" class="form-control"  placeholder="Enter Receive Purchase Order Number" id="receive_number" name="receive_number" value="<?php echo $re_number;?>">
			                    <input type="hidden" name="po_id" value="<?php echo $po_id;?>" />  
			                    <input type="hidden" name="po_status" value="1" />      
			                    <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($po_id!='' ? 'Update Purchase Order' : 'Create Purchase Order'); ?> </button>	
				            	</div>
                           	</div>     
               		</div>
				</div>
			</div>
		</div><!-- Row -->
		<?php echo form_close(); ?>
        
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">                      	
            <div class="modal-content" id="viewajaxcontent">	 
            </div>
        </div>
    </div>
        
        
		<script type="text/javascript">
	
			$(document).ready(function()
			{
				calculate();
				
				var oTable = $('#example').dataTable({
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
				});
			});

			function addNewPart()
			{
				row = $('#attproduct').val();
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/getPartNoContent');?>", 
					data: {i:row},
					dataType:"html",
					success: function(html)
					{
						$('#partProductData').append(html);
						$('#pro_item_id'+row).select2();
						
						row = Number($('#attproduct').val()) + 1;	
						$('#attproduct').val(row);

					},
				});
			}
			
			function addNewpricePart()
			{
				row = $('#attproduct1').val();
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/getPartNopriceContent'); ?>", 
					data: {i:row},
					dataType:"html",
					success: function(html)
					{
						
						$('#partProductData1').append(html);
						
						$('#expenses_menu_id'+row).select2();
			
						

						row = Number($('#attproduct1').val()) + 1;	
						$('#attproduct1').val(row);
										
					},
				});
			}
			
			function check()
			{
				$('input:radio[name="status"]').change(function()
				{
				    if($(this).val() == '1')
				    {
				       $('#advance_status').css('display','block');
				       $('#advance_status1').css('display','block');
				       $('#advance_status2').css('display','block');
				       $('#cash1').css('display','none');
				    }
				    else 
				    {
				    	$('#advance_status').css('display','none');
				    	$('#advance_status1').css('display','none');
				    	$('#advance_status2').css('display','none');
				   		$('#cash1').css('display','none');
				   		$('#cash2').css('display','none');
				   		$('#cash3').css('display','none');
				    }
				    
				});							
			}

			function call(val)
			{
				if(val == 1)
				{							
					$('#voucher_numbers').css('display','block');							
					$('#cash2').css('display','none');
				
				}
				else if(val == 2)
				{
					$('#cheque_numbers').css('display','block');
					$('#cheque_dates').css('display','block');
					$('#bank_names').css('display','block');

					$('#cheque_number').val('');
					$('#cheque_date').val('');
					$('#bank_name').val('');
				}
				else
				{
					$('.cash').css('display','none');
				}

			}

			function podetails(i)
			{
				var pdt_id = $('#pro_item_id'+i).val();

				if(pdt_id > 0)
				{
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/viewdetails'); ?>", 
					data: { pro_item_id:pdt_id},
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

			function loadPriceDetails(id,i)
			{
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/getProductPriceDetails'); ?>", 
					data: { pro_item_id:id},
					dataType:"html",
					success: function(html)
					{	
						result = html.split('|');
						
						$('#pro_item_id'+i).val(result[0]);
						//$('#pro_item_name'+i).val(result[1]);
						$('#price_amt'+i).val(result[2]);
						
						
						$('#tax_id'+i).val(result[3]);
						$('#tax_name'+i).val(result[4]);
						$('#tax_percent'+i).val(result[5]);
						$('#unit').val(result[6]);
						$('#pieces_per_unit'+i).val(parseFloat(result[7]).toFixed(2));
						$('#selling_price'+i).val(result[8]);
						
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

			function loadunit(id,i)
			{
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/getProductUnit'); ?>", 
					data: { "pro_unit_id":id,"i":i},
					dataType:"html",
					success: function(html)
					{	
						$('#unit_id_drop'+i).html(html);
						$('#unit'+i).select2();
						//calculate();
					},
				});
			}

			function getConfirmPart(inv,prid)
			{
		
			    var x;
			    var r=confirm("You Want Delete!!");
			    if(prid!='' && r==true)
			    {
			      $.ajax({"url":"<?php echo site_url('Purchase_order/deleteproduct'); ?>",
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
				function getConfirmPart1(inv,prid)
			{
		
			    var x;
			    var r=confirm("You Want Delete!!");
			    if(prid!='' && r==true)
			    {
			      $.ajax({"url":"<?php echo site_url('Purchase_order/deleteexpense'); ?>",
			      "type":"GET",
			      data:{
			          "prid":prid
			      },

			      success:function(data)
			        {
			          //alert("Daelted Successfully");
			          $('#rowssids1_'+inv+'').remove();
			          $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
			          calculate();
			        }
			      
			      });
			   
		    	}
			    else if (prid=='' && r==true)
			    {

			      $('#rowssids1_'+inv+'').remove();
			      $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
			      calculate();	
			    }
			}

			function calculate()
			{	
					
				var grandtotal 		= 0;
				var subtotal 		= 0;
				var tax 			= 0;
				var selling_total   = 0;
				var selling_tax 	= 0;
				var shipping_amount = 0;
				var expense_price 	= 0;
				var selling_total1 	= 0;
				var grandtotal1 	= 0;
				

				$('.allrowvalues').each(function(i,o) 
				{
					var qty   		        =	$(o).find('.quantity',this).val();							
					var price 		        =	$(o).find('.price_amt',this).val();
					var selling_price 		=	$(o).find('.selling_price',this).val();
					var tax_percent		    =	$(o).find('.tax_percent',this).val();
					var tax_id 				=	$(o).find('.tax_id',this).val();
				
					
					
					var total 				=  (Number(qty *1) * Number(price *1));
					total                   = parseFloat(total).toFixed(2);
					var selling_price 		=  (Number(qty *1) * Number(selling_price *1));
					selling_price           = parseFloat(selling_price).toFixed(2);
					var tax_value 			=  ((Number(tax_percent) * Number(total))/100);
					var selling_tax 		=  ((Number(tax_percent) * Number(selling_price))/100);
				
					$(o).find('.pdt_tax_amt',this).addClass('tax_'+tax_id);
					$(o).find('.selling_tax_amt',this).addClass('selling_tax_amt_'+tax_id);

					$(o).find('.amount',this).val(selling_price);
					$(o).find('.cost_amount',this).val(total);
					$(o).find('.pdt_tax_amt',this).val(tax_value);
					$(o).find('.selling_tax_amt',this).val(selling_tax);
					
					grandtotal+=Number(total);
					selling_total+=Number(selling_price);

					
				});
				grandtotal=parseFloat(grandtotal).toFixed(2);
				selling_total=parseFloat(selling_total).toFixed(2);
				$('#sub_total').val(grandtotal);
				$('#selling_total').val(selling_total);

				vat_list 	= 	document.getElementsByName('tax_id[]');
				var v 		=	vat_list.length;
				total_sum 	=	0;

				$(".total_tax_amt").val('0');
				
				for(j=0;j<v;j++)
				{
				   taxId = vat_list[j].value;

				   $("#total_tax_amt"+taxId).val('0');
				   $("#total_selling_tax"+taxId).val('0');

				       var sum=0;
				       var sum1=0;
				       

				       k=0;
				     
				       $(".tax_"+taxId).each(function(index, element) 
				       {
				            sum=sum + Number($(this).val());
				            sum1=parseFloat(sum).toFixed(2);
				       });

				       $(".selling_tax_amt_"+taxId).each(function(index, element) 
				       {
				            sum1= sum1 + Number($(this).val());
				            sum1=parseFloat(sum1).toFixed(2);
				       });
				    
				       $("#total_tax_amt"+taxId).val(sum);
				       $("#total_selling_tax"+taxId).val(sum1);
				     
				       grandtotal 		= parseFloat((Number(grandtotal) + Number(sum))).toFixed(2);
				       selling_total1 	= parseFloat((Number(selling_total) + Number(sum1))).toFixed(2);
				     
				     
				}
					var totalExpense = 0;
					$('.expense_price').each(function (index, element) 
					{
						totalExpense =totalExpense +  Number($(this).val());
						
					});
					totalExpense=parseFloat(Number(totalExpense)).toFixed(2);
			    grandtotal1=parseFloat(Number(grandtotal)+Number(totalExpense)).toFixed(2);
			    totalExpense1=parseFloat(Number(selling_total1)-Number(grandtotal1)).toFixed(2);
			   
				$('#total').val(grandtotal);
				$('#selling_price_total_tax').val(selling_total1);
				$('#selling_expense_total').val(totalExpense);
				$('#overall_purchase_price').val(grandtotal1);
				$('#overall_selling_price').val(selling_total1);
				$('#overall_profit').val(totalExpense1);
				
			}

			function paymentmode(val)
			{
				if($('#payment_mode_id').val() == 1)
				{
					$('#cash1').css('display','block');
					$('#cash2').css('display','block');
					$('#cash3').css('display','block');
					$("#trans_no").html("Voucher Number");								
					$("#trans_date").html("Voucher Date");
					$("#trans_amt").html("Amount");
				}
				if($('#payment_mode_id').val() == 2)
				{
					$('#cash1').css('display','block');
					$('#cash2').css('display','block');
					$('#cash3').css('display','block');
					$("#trans_no").html("Cheque Number");
					$("#trans_date").html("Cheque Date");
					$("#trans_amt").html("Amount");
				
				}
				if($('#payment_mode_id').val() == 3)
				{
					$('#cash1').css('display','block');
					$('#cash2').css('display','block');
					$('#cash3').css('display','block');
					$("#trans_no").html("NEFT Number");
					$("#trans_date").html("NEFT Date");
					$("#trans_amt").html("Amount");
				
				}
			}
		</script>				
	</div>				
</div><!-- Main Wrapper -->


	
	
 