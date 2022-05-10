
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
	<form  method="POST" action="<?php echo base_url();?>So_payment/add_payment"> 
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
					  <?php $getCurrency=$this->pre->getCurrencynew();?>
						<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<div class="form-group <?PHP if(form_error('sal_company_name')){ echo 'has-error';} ?>">
									<label>Customer Name</label>
									<?php 
									$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_company_name" onChange="menu_terms(this.value)"';
									echo form_dropdown('sal_company_name', $drop_menu_customer, set_value('sal_company_name', (isset($sal_company_name)) ? $sal_company_name : ''), $attrib);
									?>
									<label class="error"><?php echo form_error('sal_company_name'); ?></label>
									</div>
								</div>
							</div>
						</div>
							<div class="row" id='po_details'>
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
			                                       	<th>SO.No</th>
			                                        <th>SO.Date</th>
			                                        <th>SO.Ref</th>
			                                        <th class="text-right">Total Amount</th>           
			                                        <th class="text-right">Paid Amount</th>
			                                      	<th class="text-right">Balance Amount</th>
			                                    </tr>
			                                </thead>
			                            	<tbody>

											<?php
						                        $totalSOAmount  =   0;
						                        $totalSOBalance =   0;
						                        $i=1;
						                        foreach($menu_terms_sales as $key =>$row)
						                        {
						                            $so_balance     =   $row->sal_grand_total - $row->paid_amount; 

						                            $totalSOAmount  +=  $row->sal_grand_total;
						                            $totalSOBalance +=  $so_balance;                                                 
						                        ?>                                                  
						                        <tr> 
						                            <td>
						                                <?php echo $i++;?>
						                                <input type="hidden" value="<?php echo $row->sal_order;?>" name="sal_order[]" />
						                            </td>
						                            <td><?php echo $row->sal_id; ?></td>
						                            <td><?php echo $row->sal_order_date; ?></td>
						                            <td ><?php echo $row->sal_reference; ?></td>
						                            <td align="right"> <?php echo $row->sal_grand_total; ?></td>
						                            <td align="right"><?php echo $row->paid_amount; ?></td>
						                            <td align="right">
						                                <input type="hidden" value="<?php echo $po_balance;?>" name="po_balance[]" />
						                                <?php echo $po_balance; ?>
						                            </td>
						                        </tr>
						                        <?php
						                        }
						                        ?>
						                        <tr> 
						                            <td colspan="4"><strong>TOTAL</strong></td>
						                            <td><?php echo $totalSOBalance;?></td>
						                            <td>&nbsp;</td>
						                            <td><?php echo $totalSOBalance; ?></td>
						                        </tr>                    									
											</tbody>
			                       		</table>
			                        </div>
			                    </div>                        	
							</div>
						</div>
					</div>   
				</div>
			</div>
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
							    		<input type="hidden" id="po_id" name="po_id1" value="<?php echo $po_id; ?>">                                   		
							    		<input type="submit" class="btn btn-primary" name="addpayment" value="Submit">
							    	</div>
							    </div>                                                                            
							</div>
						</div>
						
					</div>
				</div>
			</div>	
		</div>
	</form>
</div>
	
	

<script>
	function menu_terms(id)
	{
		
		
	
		$('#po_id').val(id);
		$.ajax({
			
			type: "GET",
			url: "<?php echo site_url('So_payment/menu_terms'); ?>", 
			data: {sal_company_name:id},
			dataType:"html",
			success: function(content)
			{	//alert(content);
				$('#po_details').html(content);
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
