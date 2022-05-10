<?php
$filename = 'Outstanding Payable'.date('d-M Y').'.xls';
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
                        <th>Vendor Name</th>
                        <th class="text-right">Outstanding Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                  
                     $i=1;
                        $totalPOAmount  =   0;
                        $totalPOBalance =   0;
                        foreach($menu_terms as $row)
                        {
                            $total   +=  $row['outstanding'];              
                        ?>                                                  
                              <tr> 
                             <td>
                                <?php echo $i++;?>
                               
                            </td>
                            <td><?php echo $row['vendor_name']; ?></td>
                            
                          <td align="right">
                           <?php echo number_format($row['outstanding'],2); ?>
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
                                
                                <strong> <?php echo number_format($total ,2); ?></strong> 
                            </td>
                        </tr>
                                                                     
                </tbody>
            </table>