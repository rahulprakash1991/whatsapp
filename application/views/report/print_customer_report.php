<?php
$filename = 'Sales Wise'.date('d-M Y').'.xls';
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
	        <th>Category</th>
	      	<th>Group Name</th>
	      	<th>Product Name</th>
	      	<th>QTY</th>           
	      	<th style="text-align : right;">Sales Price(<?php echo $getCurrency;?>)</th>
	      	<th style="text-align : right;">Total sales Price(<?php echo $getCurrency;?>)</th>    
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
	        <td><?php echo $row->category_name; ?></td>
	        <td><?php echo $row->pro_group_name; ?></td>
	        <td><?php echo $row->pro_item_name; ?></td>
	        <?php $quantity1+=$row->quantity; ?>
	        <td ><?php echo $row->quantity; ?></td>
	        <?php $price_amt1+=$row->price_amt; ?>
	        <td align="right"><?php echo $row->price_amt; ?></td>
	        <?php $sal_amount1+=$row->sal_amount; ?>
	        <td align="right"><?php echo $row->sal_amount;  ?></td>
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
		      <td ><strong>TOTAL</strong></td>
		      <td><strong><?php echo $quantity1;?></strong></td>
		      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($price_amt1, 2); ?></strong></td>
		      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($sal_amount1, 2); ?></strong></td>
		</tr>
	       <?php }?>            									
	</tbody>
</table>