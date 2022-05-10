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
			<th>SO Number</th>
			<th>so Date</th>
			
			<th>Product Name</th>
			
			<th>QTY</th>           
			<th>Sales Price(<?php echo $getCurrency;?>)</th>
			<th >Sub Total(<?php echo $getCurrency;?>)</th>
       		<th>Discount %</th>
			<th>Total sales Price(<?php echo $getCurrency;?>)</th>  
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
			<td><?php echo $row->sal_order; ?></td>
			<td><?php echo date('d-M-Y', strtotime($row->sal_order_date)); ?></td>
			<td><?php echo $row->pro_item_id; ?></td>
			
			
			<?php $quantity1+=$row->quantity; ?>
			<td ><?php echo $row->quantity; ?></td>
			<?php $price_amt1+=$row->price_amt; ?>
			<td ><?php echo $row->price_amt; ?></td>
			  <?php $sub_total1+=$row->sub_total; ?>
        <td ><?php echo $row->sub_total; ?></td>
			<?php $sal_amount1+=$row->total_cost; ?>
			  <td ><?php echo $row->discount; ?></td>
        <?php $discount1+=$row->discount;?>
			<td ><?php echo $row->total_cost;  ?></td>
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
    		<td ><strong><?php echo $getCurrency;?> <?php echo $price_amt1; ?></strong></td>
     		<td><strong><?php echo $getCurrency;?> <?php echo$sub_total1; ?></strong></td>
     		<td><?php echo $discount1; echo " ";echo "%"; ?></td>
    		<td ><strong><?php echo $getCurrency;?> <?php echo $sal_amount1; ?></strong></td>
		</tr>
	       <?php }?>            									
	</tbody>
</table>