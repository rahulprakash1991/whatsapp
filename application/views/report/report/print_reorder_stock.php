<script type="text/javascript">
//<![CDATA[
function printPage() 
{
  var printContents = document.getElementById('printContent').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
 
}

if(window.addEventListener) 
{
  window.addEventListener("load", printPage, false);
} 
else if(window.attachEvent) 
{
  window.attachEvent("onload", printPage);
}

</script>
<link href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<div id="printContent">

    <!-- invoice  Start -->
<style>
.break
 { 
    page-break-after: always !important;
  }
  @page
  {
     page-break-after:auto;
  }
  .height20
  {
    height: 20px;
  }
   body, td, th
  {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-variant: normal;
	font-weight: 400;
	line-height: 20px;
	vertical-align: top;
  }
  th
  {
    font-weight: 600;
  }
  .br_none_l
  {
    border-left:none;
  }
  .br_none_r
  {
    border-right:none;
  }
  .br_none_t
  {
    border-top:none;
  }
  .br_none_b
  {
    border-bottom:none;
  }
  .h4
  {
    font-size:16px;
  }
</style>
<?php
$getCurrency=$this->pre->getCurrencynew();
$pieces_per_unit1  = 0;
$pieces_stock1     = 0;
$reorder_level1    = 0;
$pro_item_stock1   = 0;

?>
<h1 align="center">Reorder item</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                 
	<thead>
		<tr>
			<th>S.No</th>
			<th>Catrgory</th>
			<th>Group Name</th>
			<th style="width:35%;">Product Name</th>
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
			$pieces_per_unit1 += $row->pieces_per_unit;
			$pieces_stock1    += $row->pieces_stock;
			$reorder_level1   += $row->reorder_level; 
			$pro_item_stock1  += $row->pro_item_stock;  
		?>                               
		<tr> 
			<td><?php echo $i++;?></td>
			<td><?php echo $row->category_name; ?></td>
			<td><?php echo $row->pro_group_name; ?></td>
			<td><?php echo $row->pro_item_name; ?></td>
			<td><?php echo $row->pieces_per_unit; ?></td>
			<td><?php echo $row->pieces_stock;  ?></td>
			<td><strong><?php echo $row->reorder_level;  ?></strong></td>
			<td><?php echo $row->pro_item_stock;  ?></td>
		</tr>
		   <?php
	      if($i%16 == 0)
	      {
        ?>
     <!--   </tbody>
        </table>
        <div class="break"></div>
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
		<tbody>-->
		<?php
			}
		}
		?>
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