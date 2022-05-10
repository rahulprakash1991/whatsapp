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


?>
<h1 align="center">Purchase Report</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                 
	<thead>
		<tr>
			<th>S.No</th>
			<th>PO Number</th>
			<th>PO Date</th>
			<th style="width:30%;">Vendor Name</th>
			<th style="width:15%;" style="text-align : right;">Purchase Amount<br>(<?php echo $getCurrency;?>)</th>           
			<th style="width:15%;" style="text-align : right;">Paid Amount<br>(<?php echo $getCurrency;?>)</th>
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
			<td><?php echo $row->con_company_name; ?></td>
			<?php $totalcostprice+=$row->total_cost_price; ?>
			<td align="right"><?php echo $row->total_cost_price; ?></td>
			<?php $paidamt+=$row->paid_amt; ?>
			<td align="right"> <?php echo $row->paid_amt; ?></td>
		</tr>
		   <?php
	      if($i%20 == 0)
	      {
        ?>
    <!--    </tbody>
        </table>
        <div class="break"></div>
		<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                 
		<thead>
			<tr>
				<th>S.No</th>
				<th>PO Number</th>
				<th>PO Date</th>
				<th>Vendor Name</th>
				<th style="text-align : right;">Sales Amount(<?php echo $getCurrency;?>)</th>           
				<th style="text-align : right;">Paid Amount(<?php echo $getCurrency;?>)</th>
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
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($totalcostprice, 2); ?></strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($paidamt, 2); ?></strong></td>
		</tr>           
	<?php	
		}
	?>
	</tbody>
</table>