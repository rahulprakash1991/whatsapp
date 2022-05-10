
                  

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
                        <th>Invoice Number</th>
                        <th>SO.Date</th>
                        <th>SO.Ref</th>
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
                           <input type="hidden" value="<?php echo $opening_balance;?>" name="opening_balance" />
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
                        $totalSOAmount  =   0;
                        $totalSOBalance =   0;
                        foreach($menu_terms_sales as $key =>$row)
                        {
                            $sal_balance     =   $row->sal_grand_total - $row->paid_amount; 

                            $totalSOAmount  +=  $row->sal_grand_total;
                            $totalSOBalance +=  $sal_balance;                                                 
                        ?>                                                  
                        <tr> 
                            <td>
                                <?php echo $i++;?>
                                <input type="hidden" value="<?php echo $row->sal_id;?>" name="sal_id[]" />
                                <input type="hidden" value="<?php echo $row->sal_order;?>" name="sal_order[]" />
                            </td>
                            <td><?php echo $row->sal_order; ?></td>
                            <td><?php echo get_dateformat($row->sal_order_date); ?></td>
                            <td><?php echo $row->sal_reference; ?></td>
                            <td align="right"><?php echo number_format((float)$row->sal_grand_total, 2, '.', '');?></td>
                            <td align="right"><?php echo number_format((float)$row->paid_amount, 2, '.', '');?></td>
                            <td align="right">
                                <input type="hidden" value="<?php echo $sal_balance;?>" name="sal_balance[]" />
                                <?php echo number_format((float)$sal_balance, 2, '.', '');?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr> 
                            <td colspan="4" align="right"><strong>TOTAL</strong></td>
                            <td align="right"><?php echo number_format((float)$totalSOAmount, 2, '.', '');?></td>
                            <td align="right">&nbsp;</td>
                            <td align="right"><?php echo number_format((float)$totalSOBalance+$opening_balance, 2, '.', '');?></td>
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

                                        <input type="text" class="form-control" name="amt" id="amt" value="">
                                    </div>
                                </div>  
                            </div> 
                            <br>
                              <div class="row">                               
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Collection Date:</label>
                                    <div class="col-md-4">
                                       <input type="text" autocomplete="off" class="form-control date-picker" value="<?php echo ($coll_date!='' && $coll_date!='0000-00-00') ? date('m/d/Y', strtotime($coll_date)) : date('m/d/Y'); ?>" name="coll_date" id="date" style="background-color:#fff"  >

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
                                        <input type="text" autocomplete="off" class="form-control date-picker" value="<?php echo ($neft_date!='' && $neft_date!='0000-00-00') ? date('m/d/Y', strtotime($neft_date)) : date('d/M/Y'); ?>" name="neft_date" id="neft_date" style="background-color:#fff"  >
         
                                        </div>
                                </div>

                            </div>
                             <br>
                                <div class="row">                               
                                <div class="form-group cash" style="display:none">
                                        <label class="col-md-2 control-label" id="bank_name">Bank Name</label>
                                        <div class="col-md-4">          
                                            <input type="text" class="form-control"  value="" name="bank_name" id="bank_name">  
                                        </div>
                                </div>

                            </div>
                             <br>
                            <div class="row">
                                <div class="form-group">
                                        <label class="col-md-2 control-label">Account heads  :</label>
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

