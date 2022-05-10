<?php
$filename = 'Purchase Wise'.date('d-M Y').'.xls';
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
	      <th>Category</th>
	      <th>Group Name</th>
	      <th>Product Name</th>
	      
	      <th style="text-align : right;">QTY</th>           
	      <th style="text-align : right;">Selling Price(<?php echo $getCurrency;?>)</th>
	      <th style="text-align : right;">Cost Price(<?php echo $getCurrency;?>)</th>
	      <th style="text-align : right;">Total Selling Price(<?php echo $getCurrency;?>)</th>
	      <th style="text-align : right;">Total Cost Price(<?php echo $getCurrency;?>)</th> 
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		foreach($productreport as $row)
		{
		
		?>                               
		<tr> 
			<td><?php echo $i++;?></td>
	        <td><?php echo $row->po_no; ?></td>
	        <td><?php echo date('d-M-Y', strtotime($row->order_date)); ?></td>
	        <td><?php echo $row->category_name; ?></td>
	        <td><?php echo $row->pro_group_name; ?></td>
	        <td><?php echo $row->pro_item_name; ?></td>
	        <?php $quantity1+=$row->quantity; ?>
	        <td align="right"><?php echo $row->quantity; ?></td>
	        <?php $selling_price1+=$row->selling_price; ?>
	        <td align="right"><?php echo $row->selling_price; ?></td>
	        <?php $cost_price1+=$row->cost_price; ?>
	        <td align="right"><?php echo $row->cost_price;  ?></td>
	        <?php $selling_total_amount1+=$row->selling_total_amount; ?>
	        <td align="right"><?php echo $row->selling_total_amount;  ?></td>
	        <?php $cost_total_amount1+=$row->cost_total_amount; ?>
	        <td align="right"><?php echo $row->cost_total_amount;  ?></td>
		</tr>
		<?php
		}
		if(!empty($productreport))
		{
		?>
		<tr> 
			<td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td></td>
		      <td>TOTAL</td>
		      <td align="right"><strong><?php echo $quantity1; ?></strong></td>
		      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($selling_price1, 2); ?></strong></td>
		      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($cost_price1, 2); ?></strong></td>
		      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($selling_total_amount1, 2); ?></strong></td>
		      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($cost_total_amount1, 2); ?></strong></td>
		</tr>
	       <?php }?>            									
	</tbody>
</table>