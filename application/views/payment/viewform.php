
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
	<form  method="POST" action="<?php echo base_url();?>Payment/add_payment"> 
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
					
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Vendor Name <span1>*</span1></label>
										<?php 
										$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" onChange="menu_terms(this.value)" onclick="calculate()"';
										echo form_dropdown('vendor_id', $drop_menu_vendor, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
										?>
										<label class="error"><?php echo form_error('vendor_id'); ?>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
						<div class="panel-body">
							<div class="row" id='po_details'>
							<!--
								<div class="panel panel-info">                		
			                        <div class="panel-heading" role="tab" id="headingTwo2">
			                            <h4 class="panel-title">
			                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#2" aria-expanded="false" aria-controls="collapseTwo">
			                                    Payment Details
			                                </a>
			                            </h4>
			                        </div>                                 
									<div class="panel-body" >
			                   			<table class="table table-striped" >                  
			                                <thead>	                                           
			                                    <tr>
			                                        <th>S.No</th>
			                                       	<th>PO.No</th>
			                                        <th>PO.Date</th>
			                                        <th>PO.Ref</th>
			                                        <th class="text-right">Total Amount</th>           
			                                        <th class="text-right">Paid Amount</th>
			                                      	<th class="text-right">Balance Amount</th>
			                                    </tr>
			                                </thead>
			                            	<tbody>
					                               	<?php
					                               	$totalPOAmount	=	0;
					                               	$totalPOBalance	=	0;
					                               	$i=1;
												    foreach($menu_terms as $key =>$row)
													{
														$po_balance		= 	$row->total_cost_price - $row->paid_amt; 

						                               	$totalPOAmount	+=	$row->total_cost_price;
						                               	$totalPOBalance	+=	$po_balance;												 
													?>													
				                                    <tr> 
				                                    	<td>
				                                    		<?php echo $i++;?>
				                                    		<input type="hidden" value="<?php echo $row->po_id;?>" name="po_id[]" />
				                                    	</td>
				                                    	<td><?php echo $row->po_no; ?></td>
				                                    	<td><?php echo $row->order_date; ?></td>
				                                        <td><?php echo $row->ref_no; ?></td>
				                                        <td><?php echo $row->total_cost_price; ?></td>
				                                        <td><?php echo $row->paid_amt; ?></td>
				                                        <td>
				                                        	<input type="hidden" value="<?php echo $po_balance;?>" name="po_balance[]" />
				                                        	<?php echo $po_balance; ?>
				                                       	</td>
				                                 	</tr>
				                                    <?php
				                                    }
													?>
				                                    <tr> 
				                                    	<td colspan="4"><strong>TOTAL</strong></td>
				                                        <td><?php echo $totalPOAmount;?></td>
				                                        <td>&nbsp;</td>
				                                        <td><?php echo $totalPOBalance; ?></td>
				                                 	</tr>													
											</tbody>
			                       		</table>
			                        </div>
			                    </div>  
			                 -->                      	
							</div>
						</div>
					</div>   
				</div>
			<!--
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-info">
						 <div class="panel-heading" role="tab" i>
		                    <h4 class="panel-title">
		                          Payment Details
		                     </h4>
		                </div> 
						<div class="panel-body">
							<br>		
						 
							<div class="row">                         		
							    <div class="form-group">
							        <label class="col-md-2 control-label">Payment Amount:</label>
							        <div class="col-md-4">
							            <input type="text" class="form-control" name="amt" id="amt" value="">
							        </div>
							    </div>  
							</div> 
							<br>
							<div class="row">                               
							    <div class="form-group " >
						    		<label class="col-md-2 control-label">Payment Date:</label>
									<div class="col-md-4">			
										<input type="text" class="form-control date-picker" value="<?php echo ($date!='' && $date!='0000-00-00') ? $date : date('d M, Y'); ?>" name="date" id="date" style="background-color:#fff">	
						    		</div>
							    </div>

							</div>
							<br>
							<div class="row"> 
							    <div class="form-group">
										<label class="col-md-2 control-label">Payment Mode :</label>
										<div class="col-md-4">			
											<?php 											
							        	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" onchange="paymentmode(this.value)" id="payment_mode_id"';
										echo form_dropdown('payment_mode_id', $drop_menu_payment_mode, set_value('payment_mode_id', (isset($payment_mode_id)) ? $payment_mode_id : ''), $attrib);
										?>							
							    	</div>
							    </div> 
							</div>
							<br>
							<div class="row">   
							     <div class="form-group cash" style="display:none";>
										<label class="col-md-2 control-label" id="trans_no"></label>
										<div class="col-md-4">			
											<input type="text" class="form-control" name="voucher_number" id="voucher_number"> 						
							    	</div>
							    </div>
							</div>
							<br>			                                       
							<div class="row">                               
							    <div class="form-group cash" style="display:none">
										<label class="col-md-2 control-label" id="trans_date"></label>
										<div class="col-md-4">			
											<input type="text" class="form-control date-picker" value="<?php echo ($neft_date!='' && $neft_date!='0000-00-00') ? $neft_date : date('d M, Y'); ?>" name="neft_date" id="neft_date" style="background-color:#fff">	
							    		</div>
							    </div>

							</div>
							 <br>
							<div class="row">
								<div class="form-group">
										<label class="col-md-2 control-label">Bank Name :</label>
										<div class="col-md-4">	
											<?php 	
							        	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%"  id="bank_id"';
										echo form_dropdown('bank_id', $drop_menu_bank, set_value('bank_id', (isset($bank_id)) ? $bank_id : ''), $attrib);
										?>				
							    	</div>
							    </div>
							</div>
							
						
							<br>
							<div class="row"> 		                                      
							    <div class="form-group">
							    	<div class="col-md-2"></div>
							    	<div class="col-md-4"> 
							    		<input type="submit" class="btn btn-primary" name="addpayment" value="Submit">
							    	</div>
							    </div>                                                                            
							</div>
						</div>
						
					</div>
				</div>
			</div>
			-->	
		</div>
	</form>
</div>
	
	

<script>
	function menu_terms(id)
	{	
		$('#vendor_id').val(id);

		$.ajax({
			
			type: "GET",
			url: "<?php echo site_url('Payment/menu_terms'); ?>", 
			data: {vendor_id:id},
			dataType:"html",
			success: function(content)
			{	
				$('#po_details').html(content);
				$('#payment_mode_id').select2();
				$('#bank_id').select2();
				 $("#date1").datepicker();
				 $("#date2").datepicker();
				  $("#neft_date").datepicker();
			},
		});
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
