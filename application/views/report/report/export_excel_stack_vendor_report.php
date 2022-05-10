<?php
$filename = 'Cumulative-Purchase Wise'.date('d-M Y').'.xls';
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
	      	    
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		foreach($productreport as $row)
		{
			$quantity1+=$row->quantity; 
		
		?>                               
		<tr> 
			<td><?php echo $i++;?></td>
		      <td><?php echo $row->category_name; ?></td>
		      <td><?php echo $row->pro_group_name; ?></td>
		      <td><?php echo $row->pro_item_name; ?></td>
      
      <td ><?php echo $row->quantity; ?></td>
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
		</tr>
	       <?php }?>            									
	</tbody>
</table>