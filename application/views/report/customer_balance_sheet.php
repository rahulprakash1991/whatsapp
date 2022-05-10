
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
			<?php $getCurrency=$this->pre->getCurrencynew();?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
					
						<div class="panel-body">
							<div class="row">
							<form  method="POST" action="<?php echo base_url();?>Report/customer_balance_sheet"> 
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('from_date')){ echo 'has-error';} ?>">
										<label>From Date</label>
											<input type="text" class="form-control date-picker" placeholder="From Date" autocomplete="off" value="<?php echo $from_date; ?>" name="from_date" id="from_date" style="background-color:#fff"  >
										<label class="error"><?php echo form_error('from_date'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>To Date</label>
											<input type="text" class="form-control date-picker" placeholder="To Date" autocomplete="off" value="<?php echo $to_date ; ?>" name="to_date" id="to_date" style="background-color:#fff"  >
										<label class="error"><?php echo form_error('to_date'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Client Name <span1>*</span1></label>
										<?php 
										$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" onChange="menu_terms(this.value)" onclick="calculate()"';
										echo form_dropdown('vendor_id', $drop_menu_customer, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
										?>
										<label class="error"><?php echo form_error('vendor_id'); ?>
										</label>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
									<br>
										<input type="hidden" value="1" name="searchFilter">
										<button type="submit" name="Submit" class="btn btn-primary">Submit</button>		
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
						
		
			
	<div class="panel panel-info" id='po_details'>                		
         <div class="panel-body" >
            <table class="table table-striped" >   
            <a href="<?php echo base_url();?>Report/customer_balance_sheet_print" target="_blank"  class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Export To Excel</a>
			<a href="<?php echo base_url();?>Report/customer_balance_sheet_print/print" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>               
                <thead>                                            
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Particular</th>
                        <th style="text-align : right;">Debit(<?php echo $getCurrency; ?>)</th>
                        <th style="text-align : right;">Credit(<?php echo $getCurrency; ?>)</th>
                        <th style="text-align : right;">Balance(<?php echo $getCurrency; ?>)</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                   $balance = 0;
                   $totalDebit   = 0;
                   $totalCredit  = 0; 
                	if($dateWiseOpeningBalance) 
                	{
                		$opening_balance=$opening_balance+$dateWiseOpeningBalance;
                		$totalDebit+=$opening_balance;
           			?>
                	<tr> 
                		<td>1</td> 
						 <td></td>
						 <td>Opening Balance</td>                                                
						 <td align="right"><?php echo $opening_balance; ?></td>
						 <td align="right">-</td>
						 <td align="right"><?php echo number_format($balance=$balance+$opening_balance,2);?></td>
                     </tr>
                   <?php 
                   
              		 }
                   elseif(!empty($opening_balance))
                   {
						$totalDebit+=$opening_balance;
                   	?>
                	<tr> 
                		 <td>1</td> 
						 <td><?php echo date('d-M-Y',strtotime($con_created_on)); ?></td>
						 <td>Opening Balance</td>                                                
						 <td align="right"><?php echo $opening_balance; ?></td>
						 <td align="right">-</td>
						 <td align="right"><?php echo number_format($balance=$balance+$opening_balance,2);?></td>
                     </tr>
                    <?php 
                  	}
	                 $i=1;
                        foreach($customer_balance_sheet as $row)
                        {
                        		$totalDebit+=$row['debit'];
                        		$totalCredit+=$row['credit'];
						?>
						<tr> 
							<td><?php echo $i++; ?> </td>                                                
							<td><?php echo date('d-M-Y',strtotime($row['date'])); ?></td>
							<td><?php echo $row['particular']; ?></td>
							<td align="right"><?php echo ($row['debit']=='')? "-":$row['debit']; ?></td>
							<td align="right"><?php echo ($row['credit']=='')? "-":$row['credit']; ?></td>
							<td align="right"><?php echo number_format($balance=($balance+$row['debit'])-$row['credit'],2); ?> </td>
	                    </tr> 
	                    <?php
                        }
                        ?>
                        <tr> 
                             <td></td>
                             <td></td>
                             <td align="right"><strong> Total</strong></td>
                             <td align="right">
                                <strong><?php echo $getCurrency; ?> <?php echo number_format($totalDebit ,2); ?></strong> 
                            </td>
                            <td align="right">
                                <strong><?php echo $getCurrency; ?> <?php echo number_format($totalCredit ,2); ?></strong> 
                            </td>
                            <td align="right">
                            	 <strong><?php echo $getCurrency; ?> <?php echo number_format($balance ,2); ?></strong> 

                            </td>
                        </tr>
                        
                                                                     
                </tbody>
            </table>

    	</div>
    </div> 
	
		</div>
	</form>
</div>
	
	

<script>
	function menu_terms(id)
	{	
		
		$('#vendor_id').val(id);

		$.ajax({
			
			type: "GET",
			url: "<?php echo site_url('Report/menu_terms'); ?>", 
			data: {vendor_id:id},
			dataType:"html",
			success: function(content)
			{	
				$('#po_details').html(content);
				$('#payment_mode_id').select2();
				$('#bank_id').select2();
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
