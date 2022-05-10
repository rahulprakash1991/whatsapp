<?php
$filename = 'Receivable Report'.date('d-M Y').'.xls';
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
			<th>Collection Date</th>
			<th>Client Name</th>
			<th>Payment Mode</th>
			<th>Bank Name</th>
			<th>Account Heads</th>
			
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
			<td><?php echo date('d-M-Y', strtotime($row->collection_date)); ?></td>
			<td><?php echo $row->client_name; ?></td>
			<td><?php echo $row->payment_mode; ?></td>
			<td><?php echo ($row->transaction_bank_name == '0')?  "-": $row->transaction_bank_name; ?></td>
			<td><?php echo $row->bank_name; ?></td>
			<td><?php echo date('d-M-Y', strtotime($row->transaction_date)); ?></td>
			<td><?php echo ($row->transaction_no == '0')?  "-": $row->transaction_no; ?></td>
			<?php $total+=$row->paid_amt; ?>
			<td align="right"><?php echo $row->paid_amt; ?></td>
		</tr>
		<?php }?>
		 <tr> 
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="right"><strong>Total</strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo  number_format($total, 2); ?></strong></td>
		</tr>
	<?php	foreach($customerpayment as $row)
		{
			?>
		<tr> 
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="right"><strong>Total Sales Amount</strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo $sales_Amount=$row->sal_grand_total; ?></strong></td>
			
		</tr>
		<?php 

			}?>

		<?php	foreach($customerpaidamount  as $row)
			{
				?>
			<tr> 
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				
			

				<?php $Outstanding_Amount=$sales_Amount-$row->paid_amt; 
				if($Outstanding_Amount>0)
				{?>
					<td align="right"><strong>Outstanding Amount </strong></td>
					<td align="right"><strong><?php echo $getCurrency;?> <?php echo  number_format($Outstanding_Amount, 2);?></strong></td>
				<?php }
				else
				{ ?>
					<td align="right"><strong>Credit Amount </strong></td>
					<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($Outstanding_Amount, 2);?></strong></td>
				
			</tr>  
			<?php 
			}
		}
				?>
	</tbody>
</table>