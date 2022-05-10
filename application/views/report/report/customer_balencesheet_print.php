
<?php
$filename = 'Customer Balance Sheet'.date('d-M Y').'.xls';
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
   if(!empty($opening_balance)){

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
      foreach($customer_balance_sheet as $row)
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