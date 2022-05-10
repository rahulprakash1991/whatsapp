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
<h1 align="center">Product Stock Report</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
  <thead>
    <tr>
      <th>S.No</th>
      <th style="7%;">Catrgory</th>
      <th style="width:35%;">Product Name</th>
      <th>Stock</th>
      <th style="text-align: right;">Cost Price<br />(<?php echo $getCurrency;?>)</th>
      <th style="text-align: right;">Stock Value<br />(<?php echo $getCurrency;?>)</th>
      <th style="text-align: right;">Selling Price <br />(<?php echo $getCurrency;?>)</th>
      <th style="text-align: right;">Actual Selling Price(<?php echo $getCurrency;?>)</th>
    </tr>
  </thead>

  <tbody>
    <?php
    $i = 1;
    foreach($values as $row)
    {
      $pro_item_stock1+=$row->pro_item_stock;
      $pro_item_cost_price1+=$row->pro_item_cost_price;
      $pro_item_stock2+=$row->pro_item_cost_price*$row->pro_item_stock; 
      $pro_item_sell_price1+=$row->pro_item_sell_price; 
    ?>                               
    <tr> 
      <td><?php echo $i++;?></td>
      <td><?php echo $row->category_name; ?></td>
      <td><?php echo $row->pro_item_name; ?></td>
      <td style="text-align: center;"><?php echo $row->pro_item_stock;  ?></td>
      <td align="right"><?php echo $row->pro_item_cost_price;  ?></td>
      <td align="right"><strong><?php echo number_format($row->pro_item_cost_price*$row->pro_item_stock, 2) ;  ?></strong></td>
      <td align="right"><?php echo $row->pro_item_sell_price;  ?></td>
      <?php $pro_item_sell_price2+=$row->pro_item_sell_price*$row->pro_item_stock;  ?>
      <td align="right"><strong><?php echo number_format($row->pro_item_sell_price*$row->pro_item_stock, 2);  ?><strong></td>
    </tr>
    <?php
      if($i%28 == 0)
      {
        ?>
        <!--    </tbody>
        </table>
        <div class="break"></div>
      <table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
        <thead>
          <tr>
            <th>S.No</th>
            <th style="7%;">Catrgory</th>
            <th style="width:35%;">Product Name</th>
            <th>Stock</th>
            <th style="text-align: right;">Cost Price<br />(<?php echo $getCurrency;?>)</th>
            <th style="text-align: right;">Stock Value<br />(<?php echo $getCurrency;?>)</th>
            <th style="text-align: right;">Selling Price <br />(<?php echo $getCurrency;?>)</th>
             <th style="text-align: right;">Actual Selling Price(<?php echo $getCurrency;?>)</th>

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
      <td><strong>TOTAL</strong></td>
      <td align="center"><strong><?php echo $pro_item_stock1;  ?></strong></td>
      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_cost_price1, 2);?></strong></td>
      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_stock2, 2);?></strong></td>
      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_sell_price1, 2);?></strong></td>
      <td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($pro_item_sell_price2, 2);?></strong></td>
    </tr>
  </tbody>
</table>
</div>
