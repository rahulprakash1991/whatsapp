
<div class="panel panel-info" id='po_details'>                		
                                 

    	<div class="panel-body" >
            <table class="table table-striped" >                  
                <thead>                                            
                    <tr>
                        <th>S.No</th>
                        <th>Vendor Name</th>
                        <th class="text-right">Balance Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                  
                     $i=1;
                        $totalPOAmount  =   0;
                        $totalPOBalance =   0;
                        foreach($menu_terms as $key =>$row)
                        {


                            $po_balance     =   $row->total_cost_price - $row->paid_amt; 
                            $po_id          =   $row->po_id;
                            $totalPOAmount  +=  $row->total_cost_price;
                            $totalPOBalance +=  $po_balance;                                                 
                        ?>                                                  
                        <tr> 
                             <td>
                                <?php echo $i++;?>
                                <input type="hidden" value="<?php echo  $po_id ;?>" name="po_id[]" />
                            </td>
                            <td><?php echo $row->con_company_name; ?></td>
                            
                            <td align="right">
                                <input type="hidden" value="<?php echo $po_balance;?>" name="po_balance[]" />
                                <?php echo number_format($po_balance,2); ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td align="right"><strong>TOTAL</strong></td>
                           <td align="right"><strong><?php echo number_format($totalPOBalance
                            +$opening_balance,2); ?></strong></td>
                        </tr>                                                   
                </tbody>
            </table>

    	</div>
    </div> 

                   	

