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
<h1 align="center">Outstanding Receivable</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">                    
  <thead>                                            
      <tr>
          <th>S.No</th>
          <th>Client Name</th>
          <th class="text-right">Outstanding Amount</th>
      </tr>
  </thead>
  <tbody>
      <?php                   
        $i=1;
          $total  =   0;
          foreach($menu_terms as $row)
          {
              $total   +=  $row['outstanding'];
                                                     
          ?>                                                  
          <tr> 
               <td>
                  <?php echo $i++;?>
                 
              </td>
              <td><?php echo $row['client_name']; ?></td>
              
              <td align="right">
           <?php  echo number_format($row['outstanding'],2); ?>

            
              </td>
          </tr>
          <?php
          }
          ?>
              <tr> 
               <td>
                 
                 
              </td>
              <td align="right"><strong> Total Outstanding Amount</strong></td>
              
              <td align="right">
            <strong><?php echo number_format($total,2); ?></strong>
              </td>
          </tr>                                          
  </tbody>
            </table>

</div>
