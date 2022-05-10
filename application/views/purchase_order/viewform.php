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
		$po_number          =	$row->po_no;
		$total 					  =	$row->total_cost_price;
		$selling_price_total_tax  =	$row->total_selling_price;
		$terms 					  =	$row->terms;   
		$del_addr 				  =	$row->del_addr;
		$notes 					  =	$row->notes;
		$po 					  =	$row->po;			    
		$po_status 				  =	$row->po_status;	
	    $po_created_by 			  =	$row->po_created_by;			    
		$po_created_on 			  =	$row->po_created_on;	
		$pro_customer_address = $row->delivery_address;	
		$vat_amount = $row->vat_amount;	    
	}

	foreach($evalue as $key =>$row)
	{	
		$item_id[$key] 		=	$row->po_pdt_id;    	
		$item[$key] 		=	$row->item_name;
		$quantity[$key] 	=	$row->quantity;
		$price_amt[$key] 	=	$row->price;
		$sub_total1[$key] 	    =	$row->sub_total;
		$discount[$key] 			=	$row->discount;
		$total_amont[$key] 		=	$row->total_amount;
		
		
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
	$sub_total1 				 = 	$this->input->post('sub_total');
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
	                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" onChange="loadaddress(this.value)"';
										echo form_dropdown('vendor_id', $drop_menu_vendor, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
										?>
										 <label class="error"><?php echo form_error('vendor_id'); ?>
									</label>
	                            </div>
	                      	</div>	
                      		<div class="col-md-3">
		                        <div class="form-group <?PHP if(form_error('po_no')){ echo 'has-error';} ?>">
		                            <label>PO Number</label>
		                            <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Purchase Order Number" id="po_no" name="po_no" value="<?php echo $po_number;?>">
		                            <label class="error"><?php echo form_error('po_no'); ?></label>
	                        	</div>
		      				</div> 
		      				<div class="col-md-3">
								<div class="form-group <?PHP if(form_error('order_date')){ echo 'has-error';} ?>">
									<label>PO Date</label>								
									<input type="text" autocomplete="off" class="form-control date-picker" placeholder="Order Date" value="<?php echo ($order_date!='' && $order_date!='0000-00-00') ? date('m/d/Y', strtotime($order_date)) : date('m/d/Y'); ?>" name="order_date" id="order_date" style="background-color:#fff"  >
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
                                <div class="col-md-6">
                                    <label><strong>Discription</strong></label>
                                </div>
                                <!--<div class="col-md-1">
                                    <center><label><strong>Unit</strong></label></center>
                                </div>-->
                              
                                <div class="col-md-1">
                                    <center><label><strong>Qty </strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Unit Price</strong></label></center>
                                </div>
                                <div class="col-md-1">
                                    <center><label><strong>Sub Total(SAR)</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Discount %</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Total Amount(SAR)</strong></label></center>
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
                                 <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                           
                                               <!--  <input name="item[]"  class="form-control cost_amount" id="item'.$i.'" type="text" value="<?php echo $item[$i]; ?>"  placeholder="Discription"/>  -->

                                                  <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control " rows="3" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>">
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
                                      
                                            <input type="text" name="price_amt[]"  autocomplete="off" class="form-control price_amt" id="price_amt<?php echo $i;?>" value="<?php echo $price_amt[$i];?>" onkeyup="calculate();" placeholder="Price">
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
                                            <input name="discount[]"  class="form-control discount" onkeyup="calculate();" id="discount<?php echo $i;?>" type="text" value="<?php echo $discount[$i]; ?>" placeholder="Discount" /> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control cost_amount" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                                    <div class="col-md-1"> 
                                       
                                        <span>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($item_id[$i]!='') ? ','.$item_id[$i] : '';?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
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
									<label>Delivery Address</label>
					                               	 	<?php 
					                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="pro_customer_address" ';
														echo form_dropdown('pro_customer_address', $drop_menu_address, set_value('pro_customer_address', (isset($pro_customer_address)) ? $pro_customer_address : ''), $attrib);
														?>
		                        </div>
	   			         	</div>
	       					<div class="col-md-9">
                              <!--   <div class="row">
                                    <div class="col-md-9 text-right" >
                                        <label class="control-label"><strong>Sub Total(<?php echo $getCurrency;?>)</strong></label>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="sub_total" class="form-control sub_total" value="<?php echo $sub_total; ?>" id="sub_total" readonly  >
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div> -->
                                
								<?php
                                foreach ($drop_menu_tax1 as $row)
                                {						            
                                ?> 
                                    <div class="row">	
                                        <div class="col-md-7 text-right" >
                                       <!--  <label class="control-label"><strong><?php echo $row->tax_name;?>(<?php echo $getCurrency;?>)</strong></label> -->
                                        </div>
                                        
                                        <div class="col-md-2">
                                        <div class="form-group">		
                                            <!-- <input name="total_selling_tax[]" class="form-control total_selling_tax" id="total_selling_tax<?php echo $row->tax_id;?>" type="hidden" value="<?php echo $total_selling_tax[$row->tax_id];?>" required readonly/>
                                            <input name="tax_type[]" class="form-control tax_type" id="tax_type<?php echo $row->tax_id;?>" type="hidden" size="75" value="<?php echo $row->tax_id;?>" >    -->
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                        <div class="form-group">		
                                           <!--  <input name="total_tax_amt[]" class="form-control total_tax_amt" id="total_tax_amt<?php echo $row->tax_id;?>" type="hidden" value="<?php echo $total_tax_amt[$row->tax_id];?>" required readonly/> -->
                                        </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                  <div class="row">
                                    <div class="col-md-9 text-right" >
                                        <label class="control-label"><strong>VAT 15%(<?php echo $getCurrency;?>)</strong></label>
                                    </div>
                               
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="vat_amount" class="form-control" value="<?php echo $vat_amount; ?>" id="vat_amount" readonly  >
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-9 text-right" >
                                        <label class="control-label"><strong>Total(<?php echo $getCurrency;?>)</strong></label>
                                    </div>
                                   <!--  <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="selling_price_total_tax"	class="form-control" value="<?php echo $selling_price_total_tax; ?>" id="selling_price_total_tax" readonly  >
                                        </div>
                                    </div> -->
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
											<div class="choice"><input type="radio" name="status" class="styled" <?php if($po_status 	=='1'){?> checked="checked"  <?php }?>value="1" onclick="check()"> Yes
											</div>	
										</label>
										<label class="radio-inline">
											<div class="choice"><input type="radio" name="status" class="styled" <?php if($po_status 	=='0'){?> checked="checked" <?php }?>  value="0" onclick="check()">No
											</div>															
										</label>
									</div>
								</div>
								
									
						
								<div class="col-md-2" style="<?PHP if($po_status  =='1'){?>display:block;<?php }else{?>display:none;<?php }?>" id="advance_status">
									<div class="form-group">
 										<label>Bank Name</label>
												<?php 	
		                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%"  id="bank_id"';
											echo form_dropdown('bank_id', $drop_menu_bank, set_value('bank_id', (isset($bank_id)) ? $bank_id : ''), $attrib);
											?>				
									</div>
								</div>
								<div class="col-md-2" style="<?PHP if($po_status  =='1'){?>display:block;<?php }else{?>display:none;<?php }?>" id="advance_status1">
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
				// calculate();
				
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
                        $('#attproduct').val( row );                
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
						$('#attproduct1').val( row );				
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
			
				

				$('.allrowvalues').each(function(i,o) 
				{
					var qty   		        =	$(o).find('.quantity',this).val();							
					var price 		        =	$(o).find('.price_amt',this).val();
					var  dis 				=	$(o).find('.discount',this).val();
					var sub                 = $(o).find('.sub_total',this).val();
					
					if(dis!==''){

					 discount_amount = Number(sub)-(Number(sub)*(dis/100))


					 total = Number(discount_amount);
					 var subtotal 				=  (Number(qty *1) * Number(price *1));
					subtotal                   = parseFloat(subtotal).toFixed(2);
					}
					else
					{
					var total 				=  (Number(qty *1) * Number(price *1));
					total                   = parseFloat(total).toFixed(2);
					var subtotal 				=  (Number(qty *1) * Number(price *1));
					subtotal                   = parseFloat(subtotal).toFixed(2);
					}

				
					$(o).find('.cost_amount',this).val(total);
					$(o).find('.sub_total',this).val(subtotal);
					
					grandtotal+=Number(total);
					

					
				});
				grandtotal=parseFloat(grandtotal).toFixed(2);
				vat = (Number(grandtotal)*(15/100));
				vatamount = parseFloat(vat).toFixed(2);
				total_include_vat = Number(grandtotal)+Number(vat);
				grandtotal1 =parseFloat(total_include_vat).toFixed(2);
				$('#vat_amount').val(vatamount);
				$('#total').val(grandtotal1);
				
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
			function loadaddress(id)
						{

							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Purchase_order/loadaddress'); ?>", 
								data: { con_id:id},
								dataType:"html",
								success: function(html)
								{	
									
									$('#pro_customer_address').html(html);
									
								},
							});
						}
		</script>				
	</div>				
</div><!-- Main Wrapper -->


	
	
 