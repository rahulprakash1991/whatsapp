<?php
$filename = 'Sales Report'.date('d-M Y').'.xls';
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
			<th>Invoice Number</th>
			<th>Invoice Date</th>
			<th>Client Name</th>
			<th style="text-align: right;">Sales Amount(<?php echo $getCurrency;?>)</th>
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
			<td><?php echo $row->sal_order; ?></td>
			<td><?php echo date('d-M-Y', strtotime($row->sal_order_date)); ?></td>
			<td><?php echo $row->client_name; ?></td>
			<?php $totalgrandtotal+=$row->sal_grand_total; ?>
			<td align="right"><?php echo $row->sal_grand_total; ?></td>
			<?php $totalpaidamount+=$row->paid_amount; ?>
			<td align="right"><?php echo $row->paid_amount; ?></td>
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
			<td align="right"><strong>TOTAL</strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($totalgrandtotal, 2); ?></strong></td>
			<td align="right"><strong> <?php echo $getCurrency;?> <?php echo number_format($totalpaidamount, 2); ?></strong></td>
		</tr>
		<?php 
			}
		?>
	</tbody>
</table>