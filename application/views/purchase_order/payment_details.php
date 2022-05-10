<?php
	foreach($value as $row1)
	{
		$total_cost_price 		 =	$row->total_cost_price;
		$total_selling_price 	 =	$row->total_selling_price;
			    
	}

	foreach($value1->result() as $row)
	{			

		$po_id					=	$row->po_id;
	  	$po_no 			        =	$row->po_no;
	  	$order_date 		    =	$row->order_date;
		$vendor_id 		        =	$row->vendor; 
		$ref_no 		        =	$row->ref_no;      
		$del_date 		        =	$row->del_date;
		$ship_pref_id 	        =	$row->ship_pref_id;   
		$sub_total 				=	$row->cost_price;
		$cost_price1 			=	$row->cost_price;
		$selling_price1         =	$row->selling_price;
		$total_cost_price1 		=	$row->total_cost_price;
		$total_selling_price 	=	$row->total_selling_price;
		$terms 					=	$row->terms;   
		$del_addr 				=	$row->del_addr;
		$con_phone 				=	$row->vendor_mobile;
		$con_company_name1		=	$row->vendor_name;
		$con_email	 			=	$row->vendor_email;
		$contact_city			=	$row->address;
		$con_first_name			=	$row->con_first_name;
		$notes 					=	$row->notes;
		$po_status 				=	$row->po_status;	
	    $po_created_by 			=	$row->po_created_by;			    
		$po_created_on 			=	$row->po_created_on;
		$rec_status 			= 	$row->rec_status;			    
	}

  	foreach($podetails as $row)
  	{
      	$rec_po_id           = $row->rec_po_id; 
      	$po_id1              = $row->rec_po_id;
 	 	$receive_number      = $row->receive_number; 
      	//$vendor_id           = $row->vendor_id;    
      	$con_company_name    = $row->con_company_name;
		$adv_amt 			 = $row->adv_amt; 
      	$bill_no1            = $row->bill_no1;
      	$quantity            = $row->quantity;
      	$product             = $row->product;
      	$unit                = $row->unit;
      	$total               = $row->total;
      	$recd_qty 			 = $row->recd_qty;
      	$pay_status 		 = $row->pay_status;
      
 	}
	
	$date = strtotime("+".$row->del_date." days", strtotime($row->order_date));

	foreach($payment_detail as $row)
	{	
	  	$po_id 				=	$row->po_id;
		$vendor_id 			=	$row->vendor_id; 
		$transaction_no 	=	$row->transaction_no;      
		$transaction_date 	=	$row->transaction_date;
		$bank_name 			=	$row->bank_nam;    
		$paid_amt 			=	$row->paid_amt; 
		$mode 				=	$row->mode;   
	}
	
	foreach ($tax_type as $key => $value)
	{
		$total_tax_amt[$value] = $total_tax_amts[$key];
	}
$getCurrency=$this->pre->getCurrencynew();
    ?>

<div class="page-inner">
       	<div class="page-title">
       		<div class="pull-right">         
             	<a href="<?php echo base_url();?>Purchase_order/manage" class="btn btn-info">
                	<i class="fa fa-list m-r-xs"></i>View
                </a>
              	<div class="btn btn-danger" onclick="conformmail(<?php echo $po_id;?>)">
                	<i class="fa fa-envelope-o m-r-xs"></i>Send Email
                </div>
              	<a href="<?php echo base_url();?>Purchase_order/printPo/<?php echo $po_id;?>" class="btn btn-default" target="_blank">
                	<i class="fa fa-print m-r-xs"></i>Print
                </a> 
            </div>
			<h3><strong>Purchase Order Details</strong></h3>
			<div class="page-breadcrumb">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url();?>"><strong>Home</strong></a></li>
					<li class="active">Purchase Order Details</li>
				</ol>
			</div>			
		</div>
            <div id="main-wrapper">
                <div class="row">                  
                    <div class="col-md-12">                       	
                        <div class="col-md-4">
                            <div class="panel-heading clearfix">
                                <h3 class="panel-title"><u>Vendor Details</u></h3>
                            </div>
                            <div class="panel-body">
                                <p>
                                   <strong> <?php echo $con_company_name1;?></strong><br>
                                    <?php echo $contact_city;?><br>
                                    <?php echo $con_phone;?><br/>
                                    <?php echo $con_email;?>
                                </p>
                            </div>
            			</div>	                    
                        <div class="col-md-4 pull-center">
                   			<div class="panel-heading clearfix">
            					<h4 class="panel-title"></h4>
	                        </div>
	                        <div class="panel-body">
	                         	<div class="form-group">
		                           <label>	<strong>PO No# &nbsp;&nbsp;:&nbsp;</strong></label>
		                           <?php echo $po_no;?>    
	                        	</div>	                        	
	                        	<div class="form-group">
		                            <label><strong>PO Date &nbsp;:&nbsp;</strong></label>
		                         	<?php echo date("d-m-Y", strtotime($order_date));?>
	                        	</div>		                  
		                        <div class="form-group">
		                            <label><strong>Ref No &nbsp;&nbsp;&nbsp; :&nbsp;</strong></label>
		                           <?php echo $ref_no;?>    
	                        	</div>	                        
	                        	<div class="form-group">
                                <?php 
								if($del_date)
								{?>	
		                            <label><strong>Delivery Date :</strong></label>
		                         	<?php echo ($del_date) ? date("d-m-Y", strtotime($del_date)) : '';?>
                                <?php 
								}
								?>
	                        	</div>
	                        </div>
                    	</div>
                	  	
                        <div class="col-md-4">
                   			<div class="panel-heading clearfix">
            					<h4 class="panel-title"></h4>
	                        </div>
	                        <div class="panel-body">                         	
	                        
	                        	<?php if($adv_amt != 0)
	                        	{?>
	                        	<div class="form-group">
		                            <label><strong>Advance Amount :</strong></label>
		                           <?php echo $adv_amt;?>    
	                        	</div>
	                        	<?php }?>
	                        
	                        	<div class="form-group">
		                            <label><strong>Payment Status &nbsp;:&nbsp;</strong></label>
		                            <?php if($pay_status  == 0)
		                            {?>
		                            	<span class="label label-warning"> Pending </span>
		                            <?php }
		                            else
		                            	{?>
		                            	<span class="label label-success"> Completed </span>
		                            <?php }?>
	                        	</div>
	                        	<div class="form-group">
		                            <label><strong>PO Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></label>
		                             <?php if($rec_status  == 0)
		                            {
		                            	?>
		                            	<span class="label label-info"> New </span>
		                            <?php 
		                        	}
		                            elseif($rec_status == 1)
		                            	{?>
		                            	<span class="label label-warning"> Pending </span>
		                            <?php }
		                            else
		                            	{?>
		                            	<span class="label label-success"> Completed </span>

		                            <?php
		                            } 
								
									?>		                           
                        		</div>                
	                        	
	                         </div>
                    	</div>
                    </div>
                   </div>  
                 

                    
                    <div class="panel panel-info">
                    	<div class="panel-heading clearfix">
                            <h4 class="panel-title">Purchase Order Details</h4>
                        </div>
                        <div class="panel-body">
	                    	<table class="table table-striped">                             
	                            <thead>	                              
	                                <tr>                
	                                    <th>S.no</th>
	                                    <th>Item</th>
	                                   
	                                    <th>Qty</th>
	                   					<th>Unit Price(<?php echo $getCurrency;?>)</th>
	                   					 <th>Discount %</th>
										<th>Sub Total(<?php echo $getCurrency;?>)</th>
	                                   
	                                    <th>Total Cost Price(<?php echo $getCurrency;?>)</th>
	                                    
	                                </tr>
	                            </thead>
	                            <tbody>	                            	
	                               <?php
	                               $i=1;
	                              $sub_cost=0;
									  	 foreach($poproduct as $key =>$row)
										{														
											$pro_item_id 	   			=	$row->po_pdt_id;
											$pro_item_name 	  		    =	$row->item_name;
											
											$unit_price  				=	$row->price;
											$sub_total	   				=	$row->sub_total;
											$quantity		   			=	$row->quantity;
											$discount 		   			= 	$row->discount;
											$total_amount		   		=	$row->total_amount;
											$sub_cost+=$sub_total;
											
										?>									
	                                    <tr>
	                                        <td><?php echo $i++;?></td>
	                                        <td><?php echo $pro_item_name;?></td>
	                                  
	                                        <td><?php echo $quantity;?></td>
	                                        <td><?php echo $unit_price;?></td>
	                                        <td><?php echo $discount;?></td> 
	                                        <td><?php echo $sub_total;?></td> 
	                                        
	                                        <td><?php echo $total_amount;?></td>                      
	                                    </tr>
									   <?php
	                                    }
										?>
										<tr>
	                                        
	                                        <td></td>
	                                        <td></td>
	                                        <td></td>
	                                        <td></td>
	                                        <td><label><strong>Sub Total</strong></label></td>
	                                        <td><strong><?php echo $getCurrency;?> <?php echo number_format((float)$sub_cost, 2, '.', '');?></strong></td>
	                                        <td><strong><?php echo $getCurrency;?> <?php echo number_format((float)$total_cost_price1, 2, '.', '');?></strong></td>                      
	                                    </tr>
	                                    
	                                 
                                        
									
	                                      
                                        <tr>
                                        	
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                            <td><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Sales Value :</strong></<h4></td>
                                            <td><?php $salestotal= $sub_cost ;?>
                                            <strong><?php echo $getCurrency;?> <?php echo number_format((float)$salestotal, 2, '.', '');?></strong></td>
                                          	
                                        </tr>
                                        <tr>
                                        
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                            <td><h4><strong>Total Purchase Value :</strong></h4></td>
                                            <td><?php $total1=$total_cost_price1;?>
                                           <strong> <?php echo $getCurrency;?> <?php echo number_format((float)$total1, 2, '.', '');?></strong></td>
                                            
                                        </tr>
                                        <tr>
                                        	
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td><h4><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profit :</strong></	h4></td>
                                        		<?php $profit =$salestotal-$total1; ?>
                                            <td><strong><?php echo $getCurrency;?> <?php echo number_format((float)$profit, 2, '.', '');?></strong></td>	
                                        </tr>
	                            </tbody>
	                        </table>	                            	
                        </div>                        
                    </div>
                                    
                    <div class="panel panel-success">
                        <div class="panel-heading clearfix">
                            <h4 class="panel-title">Receive Purchase Order Details</h4>
                        </div>
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
                        	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Purchase_order/add_payment">  
                        		<div class="panel-body">
	                                <table class="table table-striped">       
	                                	<thead>                                           
	                                        <tr>
	                                           <th>S.No</th>
	                                            <th>Receive No</th>
	                                            <th>Receive Date</th>
	                                            
	                                            <th>Items</th>
	                                            <th>Quantity</th>
	                                            <th>Amount(<?php echo $getCurrency;?>)</th>
	                                            <th>Payment Status</th>
												<th>Barcode Print</th>
												<th>Select to Payment</th>
	                                        </tr>
	                                	</thead>
	                                    <tbody>
	                                       <?php
											$i=1;
											foreach($podetails as $key =>$row)
											{		
												$rec_po_id			=	$row->rec_po_id;
												$receive_number		= 	$row->receive_number;
												//$po_id				=	$row->po_id;	      
												//$vendor_id			=	$row->vendor_id;
												$con_company_name   = 	$row->con_company_name;
												//$po_no				=   $row->po_no;
												$receive_date		=   $row->receive_date;
												$ref_no	 			=   $row->ref_no;
												$bill_no1			=   $row->bill_no;
												$quantity			=   $row->quantity;
												$payment_status		=   $row->payment_status;
												$product			=   $row->item_name;
												$unit				= 	$row->unit;
												$total  			= 	$row->total_amount;
												$pay_status  		= 	$row->pay_status;	
												?>	
	                                            <tr>
	                                            	<td><?php echo $i++;?></td>
	                                                <td><?php echo $receive_number; ?></td>
	                                                <td><?php echo $receive_date; ?></td>
	                                               
	                                                <td><?php echo $product; ?></td>
													<td><?php echo $quantity; ?></td>
	                                                <td><?php echo $total; ?></td>
	                                                <td>
		                                             	<?php 
		                                             	echo ($pay_status == 0) ? '<span class="label label-info">Pending</span>' : '<span class="label label-success">Completed</span>';
		                                             	?>
		                                            </td> 
		                                            <td>
		                                            	<a href="<?php echo base_url();?>Purchase_order/printBarcode/<?php echo $rec_po_id;?>" target="_blank" title="Print Barcode">
													 		<i class="glyphicon glyphicon-barcode"></i>
													 	</a>
		                                            </td>	
	                                             	<td>
													 	<a data-toggle="modal" onclick="podetail(<?php echo $rec_po_id; ?>,<?php echo $po_id; ?>)" data-toggle="modal" data-target=".bs-example-modal-lg">
													 		<i class="glyphicon glyphicon-th-list"></i>
													 	</a>
														<?php if($pay_status == 0)
		                                              	{
		                                              	?>				                                             
														 	<input type="checkbox" name="ReceiveId[]" id="payment" value="<?php echo $rec_po_id; ?>" onclick="showPaymentForm()" />  
														 	<input type="hidden" name="receiveAmount[]" id="payment" value="<?php echo $total;?>">
			       			                        	<?php 
		                                              	}	
		                                             	?>											
	                                          		</td>
	                                        	</tr>
	                                        <?php
	                                        }
											?>
	                                    </tbody>
	                            	</table>	
                            	<input type="hidden" name="advance_amt" id="advance_amt" value="<?php echo $adv_amt;?>"> 
                        		</div>                
                            	<div class="panel-body" id="paymentdetails" style="display: none">
                                	<div class="form-group">
                                        <label class="col-md-2 control-label">Advance Amount :</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="advance_amt" name="adv_amt" value="<?php echo $adv_amt;?>" readonly=''>
                                             <input type="hidden" class="form-control" id="po_id" name="po_id" value="<?php echo $po_id;?>" >
                                             <input type="hidden" class="form-control" id="po_no" name="po_no" value="<?php echo $po_no;?>" >
                                             <input type="hidden" class="form-control" id="vendor_id" name="vendor_id" value="<?php echo $vendor_id;?>" >
                                        </div>
                                    </div> 
                                                              
		                                <div class="form-group">
		                                    <label class="col-md-2 control-label"> Payment Date:</label>
		                                    <div class="col-md-4">
		                                        	<input type="text" class="form-control date-picker" value="<?php echo ($date!='' && $date!='0000-00-00') ? date('m/d/Y', strtotime($date)) : date('m/d/Y'); ?>" name="date" id="date" style="background-color:#fff">	

		                                    </div>
		                                </div>  
                            		                        		
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Amount to Pay:</label>
                                        <div class="col-md-4">

                                            <input type="text" class="form-control" name="amt" id="amt" value="" readonly=''>
                                        </div>
                                    </div>  
                                     

                                    <div class="form-group">
 										<label class="col-md-2 control-label">Payment Mode :</label>
											<div class="col-md-4">			
												<?php 											
		                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" onchange="paymentmode(this.value)" id="payment_mode_id"';
											echo form_dropdown('payment_mode_id', $drop_menu_payment_mode, set_value('payment_mode_id', (isset($payment_mode_id)) ? $payment_mode_id : ''), $attrib);
											?>							
                                    	</div>
                                    </div> 
                            		<div class="form-group">
 										<label class="col-md-2 control-label">Bank Name :</label>
											<div class="col-md-4">	
												<?php 	
		                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%"  id="bank_id"';
											echo form_dropdown('bank_id', $drop_menu_bank, set_value('bank_id', (isset($bank_id)) ? $bank_id : ''), $attrib);
											?>				
                                    	</div>
                                    </div>
                            	
                                   
                                     <div class="form-group cash">
 										<label class="col-md-2 control-label" id="trans_no"></label>
											<div class="col-md-4">			
												<input type="text" class="form-control" name="voucher_number" id="voucher_number"> 						
                                    	</div>
                                    </div>			                                       
                                                               
                                    <div class="form-group cash">
 										<label class="col-md-2 control-label" id="trans_date"></label>
											<div class="col-md-4">			
												<input type="text" class="form-control date-picker" value="<?php echo ($neft_date!='' && $neft_date!='0000-00-00') ? date('m/d/Y', strtotime($neft_date)) : date('d/M/Y'); ?>" name="neft_date" id="neft_date" style="background-color:#fff">	
                                    		</div>
                                    </div>			                                      
                                    <div class="form-group">
                                    	<div class="col-md-2"></div>
                                    	<div class="col-md-4">                                    		
                                    		<input type="submit" class="btn btn-primary" name="addpayment" value="Submit">
                                    	</div>
                                    </div>                                                                            
                        		</div>
                        	</form> 
                    </div>  

            		<div class="panel panel-primary">
            			<div class="panel-heading clearfix">
                        	<h4 class="panel-title">Previous Payment Details</h4>
                   		</div>   					
                    	<div class="panel-body">
                   				<table class="table table-striped">                  
                                <thead>	                                           
                                    <tr>
                                        <th>S.No</th>
                                       	<th>Bank Name</th>
                                        <th>Transaction Number</th>
                                        <th>Transaction Date</th>
                                        <th>Payment Mode</th>           
                                        <th>Amount(<?php echo $getCurrency;?>)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            	<tbody>
                               		<?php
                               		$i=1;
								    foreach($payment_detail as $key =>$row)
									{

									    $po_id 				=	$row->po_id;
									    $con_company_name 	=	$row->con_company_name;
									    $payment_mode 		=	$row->payment_mode;
									    $bank_name 			=	$row->bank_name;
										$vendor_id 			=	$row->vendor_id; 
										$transaction_no 	=	$row->transaction_no;      
										$transaction_date 	=	$row->transaction_date;
										$bank 				=	$row->bank_nam;    
										$paid_amt 			=	$row->paid_amt; 
										$mode 				=	$row->mode;  
									?>													
                                    <tr>
                                    	<td><?php echo $i++;?></td>
                                    	<td><?php echo $bank_name; ?></td>
                                    	<td><?php echo $transaction_no; ?></td>
                                        <td> <?php echo get_dateformat($transaction_date); ?></td>
                                        <td><?php echo $payment_mode; ?></td>
                                        <td><?php echo $paid_amt; ?></td>
                                        <div class="col-md-1"> 
									

                                        
                                    </div>

                                      </td>
                                    </tr>
                                    <?php
                                    }
									?>



                            	</tbody>
                       			</table>
                    	</div>
       				</div>

                   <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">                      	
                            <div class="modal-content" id="viewajaxcontent">	 
                            </div>
                        </div>
                    </div>
			</div>
			</div>
   				</div>
				<script type="text/javascript">
						function conformmail(id)
						{
					
						    var x;
						    var r=confirm("Are You Sure You Want to send a mail?!!");
						    if(id!='' && r==true)
						    {
							      $.ajax({"url":"<?php echo site_url('Purchase_order/mailPo'); ?>",
							      "type":"POST",
							      data:{
							          "id":id
							      },

							      success:function(data)
							        {
							          alert(data);
							        }
							      
							      });
					    	}
						}

						$(document).ready(function()
						{
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
					

						
						function podetail(receive_number,po_id)
						{
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Purchase_order/receivedpo'); ?>", 
								data: { rec_po_id:receive_number,
								po_id:po_id},
								dataType:"html",
								success: function(response)
								{
								   jQuery('#viewajaxcontent').html(response);
        						   jQuery('#bs-example-modal-lg').modal('show', {
       								});
														
								},
							});
						}

						 function showPaymentForm() 
						 {
						 	var totalPayment	=	0
						 	var count 			= $("[name='ReceiveId[]']:checked").length;
						 	
						 	var advance 		= $('#advance_amt').val();

						 	if(count > 0)
						 	{
						 		receiveAmount	=	document.getElementsByName('receiveAmount[]');


								$("[name='ReceiveId[]']:checked").each(function(i) 
								{    
    								totalPayment += Number(receiveAmount[i].value);

								});

								amount = 	totalPayment-advance;

								$('#paymentdetails').css("display", "block");
								$('.cash').css('display','none');
								$('.cheque').css('display','none');
								$('.neft').css('display','none');
								$('#payment_amt').val(totalPayment.toFixed(3));
								$('#amt').val(amount.toFixed(3));




						 	}
						 	else
						 	{
								$('#paymentdetails').css("display", "none");
								
						 	}

					    }


						function paymentmode(val)
						{
							if($('#payment_mode_id').val() == 1)
							{
								$('.cash').css('display','block');
								
								$("#trans_no").html("Voucher Number");								
								$("#trans_date").html("Voucher Date");

								$('#voucher_number').val('');
								$('#paid_amount').val('');
							}
							if($('#payment_mode_id').val() == 2)
							{
								$('.cash').css('display','block');
								$("#trans_no").html("Cheque Number");
								$("#trans_date").html("Cheque Date");

							
							}
							if($('#payment_mode_id').val() == 3)
							{
								$('.cash').css('display','block');
								$("#trans_no").html("NEFT Number");
								$("#trans_date").html("NEFT Date");

							
							}

						}
						

					</script>
				</div>
			</div><!-- Main Wrapper -->
  <!-- [po_id] => 6
            [vendor_id] => 5
            [transaction_no] => 21321
            [transaction_date] => 2016-08-08
            [bank_nam] => 3
            [paid_amt] => 1200.00
            [mode] => 3
            [con_company_name] => Alphasoftz
            [bank_name] => dfdsfsdf
            [payment_mode] => Money Order-->