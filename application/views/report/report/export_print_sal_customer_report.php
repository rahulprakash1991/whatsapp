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

$pro_item_stock1      = 0;
$pro_item_cost_price1 = 0;
$pro_item_stock2      = 0;
$pro_item_sell_price1 = 0;

?>
<h1 align="center">Sales Wise</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
  <thead>
    <tr>
      <th>S.No</th>
      <th>SO Number</th>
      <th>so Date</th>
      <th>Category</th>
     
      <th>Product Name</th>
      <th>QTY</th>           
      <th style="text-align : right;">Sales Price(<?php echo $getCurrency;?>)</th>
      <th style="text-align : right;">Total sales Value(<?php echo $getCurrency;?>)</th>
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
        <td><?php echo $row->category_name; ?></td>
        
        <td><?php echo $row->pro_item_name; ?></td>
        
        <?php $quantity1+=$row->quantity; ?>
        <td ><?php echo $row->quantity; ?></td>
        <?php $price_amt1+=$row->price_amt; ?>
        <td align="right"><?php echo $row->price_amt; ?></td>
        <?php $sal_amount1+=$row->sal_amount; ?>
        <td align="right"><?php echo $row->sal_amount;  ?></td>
    </tr>
    <?php
      if($i%28 == 0)
     {
        ?>
     <!--       </tbody>
        </table>
        <div class="break"></div>
      <table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
        <thead>
          <tr>
              <th>S.No</th>
              <th>SO Number</th>
              <th>so Date</th>
              <th>Category</th>
              <th>Group Name</th>
              <th>Product Name</th>
              
              <th>QTY</th>           
              <th style="text-align : right;">Sales Price(<?php echo $getCurrency;?>)</th>
              <th style="text-align : right;">Total sales Price(<?php echo $getCurrency;?>)</th>
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
    <td></td>
    <td ><strong>TOTAL</strong></td>
    <td><strong><?php echo $quantity1;?></strong></td>
    <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($price_amt1, 2); ?></strong></td>
    <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($sal_amount1, 2); ?></strong></td>
    </tr>
  </tbody>
</table>
</div>
