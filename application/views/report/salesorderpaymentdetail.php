
<div class="panel panel-info" id='po_details'>                		
    <div class="panel-heading" role="tab" id="headingTwo2">
        <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#2" aria-expanded="false" aria-controls="collapseTwo">
                Payment Details
            </a>
        </h4>
    </div>                                 

    	<div class="panel-body" >
            <table class="table table-striped" >                  
                <thead>                                            
                    <tr>
                        <th>S.No</th>
                        <th>SO.No</th>
                        <th>SO.Date</th>
                        <th>SO.Ref</th>
                        <th class="text-right">Total Amount</th>           
                        <th class="text-right">Paid Amount</th>
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
                            $po_balance     =   $row->sal_grand_total - $row->paid_amount; 

                            $totalSOAmount  +=  $row->sal_grand_total;
                            $totalSOBalance +=  $po_balance;                                                 
                        ?>                                                  
                        <tr> 
                            <td>
                                <?php echo $i++;?>
                                <input type="hidden" value="<?php echo $row->sal_id;?>" name="sal_id[]" />
                            </td>
                            <td><?php echo $row->sal_id; ?></td>
                            <td><?php echo $row->sal_order_date; ?></td>
                            <td><?php echo $row->sal_reference; ?></td>
                            <td align="right"><?php echo $row->sal_grand_total; ?></td>
                            <td align="right"><?php echo $row->paid_amount; ?></td>
                            <td align="right">
                                <input type="hidden" value="<?php echo $po_balance;?>" name="po_balance[]" />
                                <?php echo $po_balance; ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr> 
                            <td colspan="4" align="right"><strong>TOTAL</strong></td>
                            <td align="right"><?php echo  $totalSOAmount;?></td>
                            <td align="right">&nbsp;</td>
                            <td align="right"><?php echo $totalSOBalance; ?></td>
                        </tr>                                                   
                </tbody>
            </table>

    	</div>
    </div>                        	

