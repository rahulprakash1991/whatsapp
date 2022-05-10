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

$quantity1      = 0;
$selling_price1 = 0;
$cost_price1      = 0;
$selling_total_amount1 = 0;
$cost_total_amount1 = 0;

?>
<h1 align="center">Purchase Wise</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
  <thead>
    <tr>
      <th>S.No</th>
      <th>PO Number</th>
      <th>PO Date</th>
      <th>Product Name</th>
      <th >QTY</th>
      <th style="width:10%;" >Price<br>(<?php echo $getCurrency;?>)</th>
      <th style="width:10%;">Sub Total <br>(<?php echo $getCurrency;?>)</th>           
      <th style="width:10%;" >Discount<br>(<?php echo "%";?>)</th>
      <th style="width:10%;">Total Price<br>(<?php echo $getCurrency;?>)</th>
      
    </tr>
  </thead>

  <tbody>
    <?php
    $i = 1;
    foreach($productreport as $row)
    {
       $quantity1+=$row->quantity; 
       $selling_price1+=$row->price; 
       $cost_price1+=$row->discount; 
       $selling_total_amount1+=$row->sub_total; 
       $cost_total_amount1+=$row->total_amount; 
    ?>                               
    <tr> 
        <td><?php echo $i++;?></td>
        <td><?php echo $row->po_no; ?></td>
        <td><?php echo date('d-M-Y', strtotime($row->order_date)); ?></td>
        
        <td><?php echo $row->item_name; ?></td>
       
        <td ><?php echo $row->quantity; ?></td>
        <td><?php echo $row->price;  ?></td>
        <td ><?php echo $row->sub_total;  ?></td>
        <td ><?php echo $row->discount; ?></td>
        <td ><?php echo $row->total_amount;  ?></td>
      
        
    </tr>
    <?php
      if($i%28 == 0)
      {
        ?>
  <!--          </tbody>
        </table>
        <div class="break"></div>
      <table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
        <thead>
          <tr>
              <th>S.No</th>
              <th>PO Number</th>
              <th>PO Date</th>
              
              <th>Product Name</th>
              
              <th style="text-align : right;">QTY</th>           
              <th style="text-align : right;">Selling Price(<?php echo $getCurrency;?>)</th>
              <th style="text-align : right;">Cost Price(<?php echo $getCurrency;?>)</th>
              <th style="text-align : right;">Total Selling Price(<?php echo $getCurrency;?>)</th>
              <th style="text-align : right;">Total Cost Price(<?php echo $getCurrency;?>)</th>
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
      <td>TOTAL</td>
      <td ><strong><?php echo $quantity1; ?></strong></td>
      <td ><strong><?php echo $getCurrency;?> <?php echo $selling_price1; ?></strong></td>
      <td><strong><?php echo $getCurrency;?> <?php echo $selling_total_amount1; ?></strong></td>
      <td ><strong><?php echo $cost_price1; ?><?php echo "%";?> </strong></td>
       <td ><strong><?php echo $getCurrency;?> <?php echo $cost_total_amount1; ?></strong></td>

    </tr>
  </tbody>
</table>
</div>
