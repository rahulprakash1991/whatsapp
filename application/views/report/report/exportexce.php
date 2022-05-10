<?php
$filename = 'Product Stock Report'.date('d-M Y').'.xls';
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
			<th>Catrgory</th>
			<th>Group Name</th>
			<th>Product Name</th>
			<th>Current Stock</th>
			<th style="text-align: right;">Cost Price(<?php echo $getCurrency;?>)</th>
			<th style="text-align: right;">Stock Value(<?php echo $getCurrency;?>)</th>
			<th style="text-align: right;">Selling Price(<?php echo $getCurrency;?>)</th>
			<th style="text-align: right;">Actual Selling Price(<?php echo $getCurrency;?>)</th>

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
			<td><?php echo $row->category_name; ?></td>
			<td><?php echo $row->pro_group_name; ?></td>
			<td><?php echo $row->pro_item_name; ?></td>
			<?php $pro_item_stock1+=$row->pro_item_stock; ?>				
			<?php if($row->reorder_level>$row->pro_item_stock)
			{
			?>
			<td><?php echo $row->pro_item_stock;  ?></td>
			<?php 
			}
			else
			{
			?>
			<td><?php echo $row->pro_item_stock;  ?></td>

			<?php
			}
			?>
			<?php $pro_item_cost_price1+=$row->pro_item_cost_price; ?>
			<td align="right"><?php echo $row->pro_item_cost_price;  ?></td>
			<?php $pro_item_stock2+=$row->pro_item_cost_price*$row->pro_item_stock;  ?>
			<td align="right"><strong><?php echo number_format($row->pro_item_cost_price*$row->pro_item_stock, 2) ;  ?></strong></td>
			<?php $pro_item_sell_price1+=$row->pro_item_sell_price; ?>
			<td align="right"><?php echo $row->pro_item_sell_price;  ?></td>
			<?php $pro_item_sell_price2+=$row->pro_item_sell_price*$row->pro_item_stock;  ?>
			<td align="right"><strong><?php echo number_format($row->pro_item_sell_price*$row->pro_item_stock, 2);  ?><strong></td>
		</tr>
		<?php
		}
		?>
		<tr> 
			<td></td>
			<td></td>
			<td></td>
			<td><strong>TOTAL</strong></td>
			<td ><strong><?php echo $pro_item_stock1;  ?></strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_cost_price1, 2);?></strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_stock2, 2);?></strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_sell_price1, 2);?></strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_sell_price2, 2);?></strong></td>

		</tr>
	</tbody>
</table>
	
