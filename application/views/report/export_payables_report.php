<?php
$filename = 'Payable Report'.date('d-M Y').'.xls';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");
$getCurrency=$this->pre->getCurrencynew();
?>
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">              
	<thead>
	                                           
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
		<?php }?>
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

		<?php	
		foreach($vendorpaidamount  as $row)
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
			?>
	</tbody>
</table>