<?php
$filename = 'Reorder item'.date('d-M Y').'.xls';
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
		<th>Pieces/unit</th>
		<th>Pieces Stock</th>
		<th>Reorder level</th>
		<th>Current Stock</th>
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
		<?php $pieces_per_unit1+=$row->pieces_per_unit; ?>
		<td><?php echo $row->pieces_per_unit; ?></td>
		<?php $pieces_stock1+=$row->pieces_stock; ?>		
		<td><?php echo $row->pieces_stock;  ?></td>
		<?php $reorder_level1+=$row->reorder_level; ?>
		<td><strong><?php echo $row->reorder_level;  ?></strong></td>
		<?php $pro_item_stock1+=$row->pro_item_stock; ?>
		<td><?php echo $row->pro_item_stock;  ?></td>
	</tr>
	<?php }?>
	<tr> 
		<td></td>
		<td></td>
		<td></td>
		<td><strong>TOTAL</strong></td>
		<td><strong><?php echo $pieces_per_unit1;?></strong></td>
		<td><strong><?php echo $pieces_stock1;?></strong></td>

		<td><strong><?php echo $reorder_level1;?></strong></td>
		<td ><?php echo $pro_item_stock1;  ?></td>
	</tr>
 </tbody>
</table>