
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
                    if($opening_balance!='' && $opening_balance!='0')
                    {
                        ?>
                        <tr> 
                            <td>1</td>
                            <td>Openning Balance  </td>
                            <td>---</td>
                            <td>---</td>
                            <td align="right">---</td>
                            <td align="right">---</td>
                            <td align="right">
                               
                                 <?php echo number_format((float)$opening_balance, 2, '.', '');?>
                            </td>
                        </tr>
                        <?php 
                            $i=2;
                        }
                        else
                        {
                            $i=1;
                        }

                        $totalPOAmount  =   0;
                        $totalPOBalance =   0;
                        foreach($menu_terms as $key =>$row)
                        {


                            $po_balance     =   $row->total_cost_price - $row->paid_amt; 
                            $po_id          =   $row->po_id;
                            $po_no          =   $row->po_no;
                            $totalPOAmount  +=  $row->total_cost_price;
                            $totalPOBalance +=  $po_balance;                                                 
                        ?>                                                  
                        <tr> 
                             <td>
                                <?php echo $i++;?>
                                <input type="hidden" value="<?php echo  $po_id ;?>" name="po_id[]" />
                                <input type="hidden" value="<?php echo  $po_no ;?>" name="po_no[]" />
                            </td>
                            <td><?php echo $row->po_no; ?></td>
                            <td><?php echo get_dateformat($row->order_date); ?></td>
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
                            <td align="right"><strong><?php echo number_format($totalPOBalance
                            +$opening_balance,2); ?></strong></td>
                        </tr>                                                   
                </tbody>
            </table>

    	</div>
    </div> 

    <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                         <div class="panel-heading" role="tab" i>
                            <h4 class="panel-title">
                                  Payment Details
                             </h4>
                        </div> 
                        <div class="panel-body">
                            <br>        
                         
                            <div class="row">                               
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Payment Amount:</label>
                                    <div class="col-md-4">
                                    <input type="hidden" value="<?php echo $opening_balance;?>" name="opening_balance" />
                                       <input type="hidden" autocomplete="off" class="form-control date-picker" value="<?php echo ($date!='' && $date!='0000-00-00') ? date('m/d/Y', strtotime($date)) : date('m/d/Y'); ?>" name="date" id="date2" style="background-color:#fff"  >

                                        <input type="text" class="form-control" name="amt" id="amt" autocomplete="off" value="">
                                    </div>
                                </div>  
                            </div> 
                             <br>
                            <div class="row">                               
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Payment Date:</label>
                                    <div class="col-md-4">
                                       <input type="text" autocomplete="off" class="form-control date-picker" value="<?php echo ($date!='' && $date!='0000-00-00') ? date('m/d/Y', strtotime($date)) : date('m/d/Y'); ?>" name="date" id="date1" style="background-color:#fff"  >

                                    </div>
                                </div>  
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Payment Mode :</label>
                                        <div class="col-md-4">          
                                            <?php                                           
                                        $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" onchange="paymentmode(this.value)" id="payment_mode_id"';
                                        echo form_dropdown('payment_mode_id', $drop_menu_payment_mode, set_value('payment_mode_id', (isset($payment_mode_id)) ? $payment_mode_id : ''), $attrib);
                                        ?>                          
                                    </div>
                                </div> 
                            </div>
                            <br>
                            <div class="row">   
                                 <div class="form-group cash" style="display:none";>
                                        <label class="col-md-2 control-label" id="trans_no"></label>
                                        <div class="col-md-4">          
                                            <input type="text" class="form-control" name="voucher_number" id="voucher_number">                      
                                    </div>
                                </div>
                            </div>
                            <br>                                                   
                            <div class="row">                               
                                <div class="form-group cash" style="display:none">
                                        <label class="col-md-2 control-label" id="trans_date"></label>
                                        <div class="col-md-4">

                                            <input type="text" class="form-control date-picker" value="<?php echo ($neft_date!='' && $neft_date!='0000-00-00') ? date('m/d/Y', strtotime($neft_date)) : date('d/M/Y'); ?>" name="neft_date" id="neft_date" style="background-color:#fff">    
                                        </div>
                                </div>

                            </div>
                             <br>
                            <div class="row">
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Bank Name :</label>
                                        <div class="col-md-4">  
                                            <?php   
                                        $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%"  id="bank_id"';
                                        echo form_dropdown('bank_id', $drop_menu_bank, set_value('bank_id', (isset($bank_id)) ? $bank_id : ''), $attrib);
                                        ?>              
                                    </div>
                                </div>
                            </div>
                            
                        
                            <br>
                            <div class="row">                                             
                                <div class="form-group">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4"> 
                                        <input type="submit" class="btn btn-primary" name="addpayment" value="Submit">
                                    </div>
                                </div>                                                                            
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>                         	

