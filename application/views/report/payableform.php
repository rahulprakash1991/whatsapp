<?php
$from_date=$this->input->post('from_date');
$to_date=$this->input->post('to_date');
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
	<?php $getCurrency=$this->pre->getCurrencynew();?>
		<div id="main-wrapper">
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="row">
							<form  method="POST" action="<?php echo base_url();?>Report/payables"> 
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
										<label>Vendor</label>
											<?php 
											$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" ';
											echo form_dropdown('vendor_id', $drop_menu_vendor, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
											?>
										<label class="error"><?php echo form_error('vendor_id'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Payment Mode</label>
											<?php 
											$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="payment_mode" ';
											echo form_dropdown('payment_mode', $drop_menu_payment_mode, set_value('payment_mode', (isset($payment_mode)) ? $payment_mode : ''), $attrib);
											?>
										<label class="error"><?php echo form_error('vendor_id'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Bank Name</label>
											<?php 
											$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="menu_bank" ';
											echo form_dropdown('menu_bank', $drop_menu_bank, set_value('menu_bank', (isset($menu_bank)) ? $menu_bank : ''), $attrib);
											?>
										<label class="error"><?php echo form_error('vendor_id'); ?></label>
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
				</div>   
		
			<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="row"> 
							
								<div class="panel-body" >
									<a href="<?php base_url();?>export_excel_payables" target="_blank"  class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Export To Excel</a>
									<a href="<?php base_url();?>export_excel_payables/print" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
									<table class="table table-striped" >                  
									<thead>
									<tr><h1><?PHP  echo $from_date;?> <?php if(!empty($from_date)){echo "[to]";} ?> <?PHP echo $to_date;?></h1></tr>	                                           
										<tr>
											<th>S.No</th>
											<th>Posted Date</th>
											<th>Vendor Name</th>
											<th>Payment Mode</th>
											<th>Bank Name</th>
											<th>Transaction Date</th>
											<th>Transaction Number</th>
											<th style="text-align: right;">Paid Amount(<?php echo $getCurrency;?>)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach($values as $row)
										{
     
										?>                               
										<tr> 
											<td><?php echo $i++;?></td>
											<td><?php echo date('d-M-Y', strtotime($row->date)); ?></td>
											<td><?php echo $row->vendor_name; ?></td>
											<td><?php echo $row->payment_mode; ?></td>
											<td><?php echo ($row->bank_name == '0')?  "-": $row->bank_name; ?></td>
											<td><?php echo date('d-M-Y', strtotime($row->transaction_date));?></td>
											<td><?php echo ($row->transaction_no == '0')?  "-": $row->transaction_no; ?></td>
											<td align="right"><?php echo $row->paid_amt; ?></td>
											<?php $total+=$row->paid_amt; ?>
										</tr>
										<?php
										}
										if(!empty($values))
										{
										?>
									    <tr> 
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td><strong>Total</strong></td>
											<td align="right"><strong ><?php echo $getCurrency;?> <?php echo  number_format($total, 2); ?></strong></td>
										</tr>
									<?php	foreach($vendorpayment as $row)
										{
											?>
										<tr> 
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td><strong>Total Purchase Amount </strong></td>
											<td align="right"><strong><?php echo $getCurrency;?> <?php echo $Purchase_Amount=$row->total_cost_price; ?></strong></td>
											
										</tr>
										<?php 

											}?>

										<?php	foreach($vendorpaidamount  as $row)
										{
											?>
										<tr> 
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										

											<?php $Outstanding_Amount=$Purchase_Amount-$row->paid_amt; 
											if($Outstanding_Amount>0)
											{?>
												<td><strong>Outstanding Amount</strong></td>
												<td align="right"><strong><?php echo $getCurrency;?> <?php echo  number_format($Outstanding_Amount, 2); ?></strong></td>
											<?php }
											else
											{ ?>
												<td><strong>Credit Amount</strong></td>
												<td align="right"><strong><?php echo $getCurrency;?> <?php echo abs($Outstanding_Amount);?></strong></td>
											
										</tr>  
										<?php 
										}
									}
											}?>
										        									
									</tbody>
			
									</table>
								</div>
							</div>
						</div>   
					</div>                 	
				</div>
		
			</div>
		</form>
	</div>
</div>	
	
