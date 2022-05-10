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
<h1 align="center">Vendor Balance Sheet</h1>
<h4 align="center"><?php echo date('d/M/Y H:i A');?></h4>         

<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
 <thead>                                            
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Particular</th>
                        <th style="text-align : right;">Debit(<?php echo $getCurrency; ?>)</th>
                        <th style="text-align : right;">Credit(<?php echo $getCurrency; ?>)</th>
                        <th style="text-align : right;">Balance(<?php echo $getCurrency; ?>)</th>
                    </tr>
                </thead>
                      <tbody>
                    <?php
                   $balance = 0;
                   $totalDebit   = 0;
                   $totalCredit  = 0; 
                  if($dateWiseOpeningBalance) 
                  {
                    $opening_balance=$opening_balance+$dateWiseOpeningBalance;
                    $totalDebit+=$opening_balance;
                ?>
                  <tr> 
                    <td>1</td> 
             <td></td>
             <td>Opening Balance</td>                                                
             <td align="right"><?php echo $opening_balance; ?></td>
             <td align="right">-</td>
             <td align="right"><?php echo number_format($balance=$balance+$opening_balance,2);?></td>
                     </tr>
                   <?php 
                   
                   }
                   elseif(!empty($opening_balance))
                   {
            $totalDebit+=$opening_balance;
                    ?>
                  <tr> 
                     <td>1</td> 
             <td><?php echo date('d-M-Y',strtotime($con_created_on)); ?></td>
             <td>Opening Balance</td>                                                
             <td align="right"><?php echo $opening_balance; ?></td>
             <td align="right">-</td>
             <td align="right"><?php echo number_format($balance=$balance+$opening_balance,2);?></td>
                     </tr>
                    <?php 
                    }
                   $i=1;
                        foreach($vendor_balance_sheet as $row)
                        {
                            $totalDebit+=$row['debit'];
                            $totalCredit+=$row['credit'];
            ?>
            <tr> 
              <td><?php echo $i++; ?> </td>                                                
              <td><?php echo date('d-M-Y',strtotime($row['date'])); ?></td>
              <td><?php echo $row['particular']; ?></td>
              <td align="right"><?php echo ($row['debit']=='')? "-":$row['debit']; ?></td>
              <td align="right"><?php echo ($row['credit']=='')? "-":$row['credit']; ?></td>
              <td align="right"><?php echo number_format($balance=($balance+$row['debit'])-$row['credit'],2); ?> </td>
                      </tr> 
                      <?php
                        }
                        ?>
                        <tr> 
                             <td></td>
                             <td></td>
                             <td align="right"><strong> Total</strong></td>
                             <td align="right">
                                <strong><?php echo $getCurrency; ?> <?php echo number_format($totalDebit ,2); ?></strong> 
                            </td>
                            <td align="right">
                                <strong><?php echo $getCurrency; ?> <?php echo number_format($totalCredit ,2); ?></strong> 
                            </td>
                            <td align="right">
                               <strong><?php echo $getCurrency; ?> <?php echo number_format($balance ,2); ?></strong> 

                            </td>
                        </tr>
                        
                                                                     
                </tbody>
</table>
</div>
