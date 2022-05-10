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
<h1 align="center">Sales Report</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                 
	<thead>
		<tr>
			<th>S.No</th>
			<th>Invoice Number</th>
			<th>Invoice Date</th>
			<th style="width:30%;">Client Name</th>
			<th style="width:15%;" style="text-align: right;">Sales Amount<br/>(<?php echo $getCurrency;?>)</th>
			<th  style="width:15%;"style="text-align: right;">Paid Amount<br/>(<?php echo $getCurrency;?>)</th>
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
	      if($i%25 == 0)
	      {
        ?>
     <!--   </tbody>
        </table>
        <div class="break"></div>
		<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                 
		<thead>
			<tr>
				<th>S.No</th>
				<th>Invoice Number</th>
				<th>Invoice Date</th>
				<th>Customer Name</th>
				<th style="text-align: right;">Sales Amount(<?php echo $getCurrency;?>)</th>
				<th style="text-align: right;">Paid Amount(<?php echo $getCurrency;?>)</th>
			</tr>
		</thead>
		<tbody>-->
		<?php
			}
		}
		$i = 1;
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