<?php
$filename = 'Purchase Report'.date('d-M Y').'.xls';
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
			<th>PO Number</th>
			<th>PO Date</th>
			<th>Vendor Name</th>
			<th style="text-align : right;">Purchase Amount(<?php echo $getCurrency;?>)</th>           
			<th style="text-align : right;">Paid Amount (<?php echo $getCurrency;?>)</th>
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
			<td><?php echo $row->po_no; ?></td>
			<td><?php echo date('d/m/Y', strtotime($row->order_date)); ?></td>
			<td><?php echo $row->vendor_name; ?></td>
			<?php $totalcostprice+=$row->total_cost_price; ?>
			<td align="right"><?php echo $row->total_cost_price; ?></td>
			<?php $paidamt+=$row->paid_amt; ?>
			<td align="right"> <?php echo $row->paid_amt; ?></td>
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
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($totalcostprice, 2); ?></strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($paidamt, 2); ?></strong></td>
		</tr>
		<?php 
			}
		?>
	</tbody>
</table>