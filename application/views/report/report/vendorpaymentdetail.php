
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
                        <th>PO.No</th>
                        <th>PO.Date</th>
                        <th>PO.Ref</th>
                        <th class="text-right">Total Amount</th>           
                        <th class="text-right">Paid Amount</th>
                        <th class="text-right">Balance Amount</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $totalPOAmount  =   0;
                        $totalPOBalance =   0;
                        $i=1;
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
                            <td><?php echo $row->po_no; ?></td>
                            <td><?php echo $row->order_date; ?></td>
                            <td><?php echo $row->ref_no; ?></td>
                            <td align="right"><?php echo number_format($row->total_cost_price,2); ?></td>
                            <td align="right"><?php echo number_format($row->paid_amt,2); ?></td>
                            <td align="right">
                                <input type="hidden" value="<?php echo $po_balance;?>" name="po_balance[]" />
                                <?php echo number_format($po_balance,2); ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr> 
                            <td colspan="4" align="right"><strong>TOTAL</strong></td>
                            <td align="right"><strong><?php echo number_format($totalPOAmount,2);?></strong></td>
                            <td>&nbsp;</td>
                            <td align="right"><strong><?php echo number_format($totalPOBalance,2); ?></strong></td>
                        </tr>                                                   
                </tbody>
            </table>

    	</div>
    </div>                        	

