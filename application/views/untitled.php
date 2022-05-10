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
<h1 align="center">Payable Report</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                 
	<thead>
		<tr>
			<th>S.No</th>
			<th>Collection Date</th>
			<th>Vendor Name</th>
			<th>Payment Mode</th>
			<th>Bank Name</th>
			<th>Transaction Date</th>
			<th>Transaction Number</th>
			<th style="text-align: right;">Paid Amount(<?php echo $getCurrency;?>)</th>
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
			<td><?php echo date('d-M-Y', strtotime($row->collection_date)); ?></td>
			<td><?php echo $row->con_company_name; ?></td>
			<td><?php echo $row->payment_mode; ?></td>
			<td><?php echo ($row->transaction_bank_name == '0')?  "-": $row->transaction_bank_name; ?></td>
			<td><?php echo date('d-M-Y', strtotime($row->transaction_date)); ?></td>
			<td><?php echo ($row->transaction_no == '0')?  "-": $row->transaction_no; ?></td>
			<?php $total+=$row->paid_amt; ?>
			<td align="right"><?php echo $row->paid_amt; ?></td>
		</tr>
		   <?php
	      if($i%20 == 0)
	      {
        ?>
        </tbody>
        </table>
        <div class="break"></div>
		<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                 
		<thead>
			<tr>
				<th>S.No</th>
				<th>Collection Date</th>
				<th>Vendor Name</th>
				<th>Payment Mode</th>
				<th>Bank Name</th>
				<th>Transaction Date</th>
				<th>Transaction Number</th>
				<th style="text-align: right;">Paid Amount(<?php echo $getCurrency;?>)</th>
											
			</tr>
		</thead>
		<tbody>
		<?php
			}
		}
		?>
		
	    <tr> 
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="right"><strong>Total</strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo  number_format($total, 2); ?></strong></td>
		</tr>
	<?php	foreach($vendorpayment as $row)
		{
			?>
		<tr> 
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="right"><strong>Total Sales Amount</strong></td>
			<td align="right"><strong><?php echo $getCurrency;?> <?php echo $sales_Amount=$row->sal_grand_total; ?></strong></td>
			
		</tr>
		<?php 

			}?>

		<?php	
		foreach($vendorpaidamount  as $row)
		{
			?>
		<tr> 
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		

			<?php $Outstanding_Amount=$sales_Amount-$row->paid_amt; 
			if($Outstanding_Amount>0)
			{?>
				<td align="right"><strong>Outstanding Amount </strong></td>
				<td align="right"><strong><?php echo $getCurrency;?> <?php echo  number_format($Outstanding_Amount, 2);?></strong></td>
			<?php }
			else
			{ ?>
				<td align="right"><strong>Credit Amount </strong></td>
				<td align="right"><strong><?php echo $getCurrency;?> <?php echo abs(number_format($Outstanding_Amount, 2));?></strong></td>
			
		</tr>
		<?php 
		}
	}
			?>
	</tbody>
</table>