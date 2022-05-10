
                  

<div class="panel panel-info" id='po_details'>                		

    	<div class="panel-body" >
            <table class="table table-striped" >                  
                <thead>                                            
                    <tr>
                        <th>S.No</th>
                        <th>Customer Name</th>
                        <th class="text-right">Balance Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
           
                        $totalSOAmount  =   0;
                        $totalSOBalance =   0;
                        $i=1;
                        foreach($menu_terms_sales as $key =>$row)
                        {
                            $sal_balance     =   $row->sal_grand_total - $row->paid_amount; 

                            $totalSOAmount  +=  $row->sal_grand_total;
                            $totalSOBalance +=  $sal_balance;                                                 
                        ?>                                                  
                        <tr> 
                            <td>
                                <?php echo $i++;?>
                            </td>
                            <td><?php echo $row->con_company_name; ?></td>
                            <td align="right">
                                <input type="hidden" value="<?php echo $sal_balance;?>" name="sal_balance[]" />
                                <?php echo number_format((float)$sal_balance, 2, '.', '');?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr> 
                            <td></td>
                            <td align="right"><strong>TOTAL</strong></td>
                            <td align="right"><?php echo number_format((float)$totalSOBalance+$opening_balance, 2, '.', '');?></td>
                        </tr>                                                   
                </tbody>
            </table>

    	</div>
    </div>   
                       	

