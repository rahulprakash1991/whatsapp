<?php
foreach($organization_detail->result() as $row)
{
	$org_name           = $row->org_name;
	$org_street         = $row->org_street; 
	$org_area           = $row->org_area; 
	$org_city           = $row->org_city; 
	$org_state          = $row->org_state;
	$org_pincode        = $row->org_pincode;
	$org_country        = $row->org_country;
	$org_phone          = $row->org_phone;
	$org_mobile         = $row->org_mobile;
	$org_fax            = $row->org_fax;
	$org_website        = $row->org_website;    
	$org_email          = $row->org_email;
	$org_created_by     = $row->org_created_by;
	$org_created_on     = $row->org_created_on;
}

foreach($company_detail->result() as $row)
{
	$con_primary                = $row->con_primary; 
	$con_company_name           = $row->client_name; 
	$con_address                = $row->con_address; 
	$con_email                  = $row->client_email;    
	$con_phone                  = $row->client_mobile;
	$contact_website            = $row->contact_website;
	$contact_area               = $row->contact_area;
	$contact_city               = $row->contact_city;
	$contact_state              = $row->contact_state;
	$contact_address            =$row->address;
    $client_key = $row->client_no;
}

foreach($value->result() as $row)
{
	$sal_id       				= $row->sal_id;
	$sal_customer_address       = $row->sal_customer_address;
	$sal_order_date             = $row->sal_order_date; 
	$sal_company_name           = $row->sal_company_name;
	$sal_reference              = $row->sal_reference; 
	$sal_order                  = $row->sal_order; 
	$sal_person                 = $row->sal_person;    
	$sal_delivery_date          = $row->sal_delivery_date;
    $sal_customer_notes         = $row->sal_customer_notes;    
	$sal_sub_total              = $row->sal_sub_total;
	$sal_discount               = $row->sal_discount;
	$sal_invoice_status         = $row->sal_invoice_status;
	$payment_status         	= $row->payment_status;
	$sal_grand_total            = $row->sal_grand_total;
	$sal_delivery_amount        = $row->sal_delivery_amount; 
	$grand_total                = $sal_grand_total-$sal_discount+$sal_delivery_amount;
	$sal_tax_amount             = $row->sal_tax_amount;
	$sal_tax_id                	= explode(',',$row->sal_tax_id);
	$paid_amount              	= $row->paid_amount;
	$sal_created_on             = $row->sal_created_on;
	$sal_created_by             = $row->sal_created_by;
}

$Y= date('Y');
$y=date('y');
$getCurrency=$this->pre->getCurrencynew();
?>	

<div class="page-inner">
            
    <div class="page-title">
        <div class="pull-right">         
            <a href="<?php echo base_url();?>Sales_order/manage" class="btn btn-info">
                <i class="fa fa-angle-double-left"></i> Back to List
            </a>
            <div class="btn btn-danger" onclick="conformmail(<?php echo $sal_id;?>)">
                <i class="fa fa-envelope-o m-r-xs"></i>Send Invoice
            </div>
            <a href="<?php echo base_url();?>Sales_order/printSalesorder/<?php echo $sal_id;?>" class="btn btn-default" target="_blank">
                <i class="fa fa-print m-r-xs"></i>Print
            </a>                                         
        </div>
        <h3>Invoice</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="index-2.html">Home</a></li>
                <li><a href="#">Extra</a></li>
                <li class="active">Invoice</li>
            </ol>
        </div>
    </div>
    
    <div id="main-wrapper">
        <div class="row">
            <div class="invoice col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Buyer</div>
                                    <div class="panel-body"><br />
                                        <address>
                                            <strong><?php echo $con_company_name;?></strong></br>
                                            <?php echo $contact_address;?><br>
                                            <i class="fa fa-phone-square"></i> <?php echo $con_phone;?><br/>
                                            <i class="fa fa-envelope"></i> <?php echo $con_email;?>
                                        </address>
                                    </div>
                                </div>
                               <?php  if(!empty($sal_customer_notes))
                                { ?>
                                <div class="col-md-">
                                <strong>Customer Notes:</strong>
                                       <br>
                                        <?php echo $sal_customer_notes;?>
                                </div>
                                <?php }?>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Delivery At</div>
                                    <div class="panel-body"><br />
                                        <address>
                                        <?php 
                                        if(!empty($sal_customer_address))
                                        {
                                            echo $sal_customer_address;?><?php
                                        }
                                        else
                                        {
                                        ?>
                                            <strong><?php echo $con_company_name;?></strong></br>
                                            <?php echo $contact_address;?><br>
                                            <i class="fa fa-phone-square"></i> <?php echo $con_phone;?><br/>
                                            <i class="fa fa-envelope"></i> <?php echo $con_email;?>
                                        <?php 
                                        }?>
                                        </address>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <h1 style="margin-top:0;">INVOICE # <strong><?php echo " "; echo $sal_order;?></strong></h1>
                                <table class="table table-striped">
                                    <tr>
                                        <td><strong>Invoice Date :</strong></td>
                                        <td><?php echo date('d/m/Y', strtotime($sal_order_date));?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Client ID :</strong></td>
                                        <td><?php echo $client_key;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Paid Amount :</strong> </td>
                                        <td><?php echo $getCurrency;?> <?php echo number_format((float) $paid_amount, 2, '.', '');?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pending Amount :</strong></td>
                                        <td><?php echo $getCurrency;?> <?php echo number_format((float)$sal_grand_total-$paid_amount, 2, '.', '');?></td>
                                    </tr>
                                </table>
                                <table class="table table-striped">
                                    <tr>
                                        <td><strong>Payment Status</strong>
                                        <?php 
                                            if($payment_status==1){?>
                                                <div class="label label-success" role="button" style="font-size: 14px;">Completed</div>
                                            <?php }else {?>
                                                <div class="label label-warning" role="button" style="font-size: 14px;">Pending</div>
                                            <?php }?>
                                        </td>
                                        <td><strong>Invoice Status</strong>
                                        <?php 
                                            if($sal_invoice_status==1){?>
                                                <div class="label label-success" role="button" style="font-size: 14px;">Invoiced</div>
                                            <?php }else {?>
                                                <div class="label label-danger" role="button" style="font-size: 14px;">Draft</div>
                                            <?php }?>
                                        </td>
                                    </tr>
                                 </table>   
                            </div>
                        </div>    

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Details</div>
                                    <div class="panel-body">
                                        <?php if($company_abb=="LCK"){?>
                                        <table  class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Item Description</th>
                                                <th>Nationality</th>
                                                <th style="text-align:right">Total#</th>
                                                <th style="text-align:right">T/hrs#</th>
                                                <th style="text-align:right">Rate/hrs</th>
                                                <th style="text-align:right">Total#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i= 1;
                                            foreach($spvalue as $key =>$row)
                                            {   
                                            $totalproduct=count($rows->sal_item_id);
                                            $pro_item_name    = $row->item_description;
                                            $nationality      = $row->nationality;
                                            $total_no         = $row->total;
                                            $t_hour           = $row->total_hour;
                                            $t_rate            = $row->rate_hour;
                                            $total              = $row->total_cost;
                                            $cost_total_amount1   +=   $row->total_cost;
                                            $total_total_no  += $row->total;
                                            $total_hour +=$row->total_hour;
     
                                            ?>
                                            <?php if($pro_item_name!=''){?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $pro_item_name;?></td>
                                                <td><?php echo $nationality;?></td>
                                                <td style="text-align:right"><?php echo $total_no ?></td>
                                                <td style="text-align:right"><?php echo  $t_hour;?></td> 
                                                <td style="text-align:right"><?php echo $t_rate;?></td>
                                                <td style="text-align:right"><?php echo $total;?></td>
                                            </tr>
                                            <?php 
                                        }
                                            }
                                            ?>
                                        </tbody>
                                        </table>
                                    <?php }?>
                                        <?php if($company_abb=="NH" ||$company_abb=="ARA" ){?>
                                        <table  width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">S.No</th>
                                                <th style="width: 65%;">Item Description</th>
                                                
                                                <th style="width: 5%;text-align: center;" >Unit</th>
                                                <th style="text-align:right;width: 7%;">Quantity</th>
                                                <th style="text-align:right;width: 8%;">Unit Price</th>
                                                <th style="text-align:right;width: 10%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i= 1;
                                            foreach($spvalue as $key =>$row)
                                            {   
                                            $totalproduct=count($rows->sal_item_id);
                                            $pro_item_name    = $row->item_description;
                                            $unit         = $row->uniteng;
                                            $qty           = $row->qty;
                                            $unit_price            = $row->unit_price;
                                            $total              = $row->total_cost;
                                            
                                            
     
                                            ?>
                                             <?php if($pro_item_name!=''){?>
                                            <tr>
                                                <td style="width: 5%;"><?php echo $i++;?></td>
                                                <td style="width: 65%;" ><?php echo $pro_item_name;?></td>
                                                <td style="width: 5%;text-align: center;"><?php echo $unit;?></td>
                                                <td style="text-align:right;width: 7%;"><?php echo $qty ?></td>
                                                <td style="text-align:right;width: 8%;"><?php echo  $unit_price;?></td> 
                                              
                                                <td style="text-align:right;width: 10%;"><?php echo $total;?></td>
                                            </tr>
                                            <?php 
                                            }}
                                            ?>
                                        </tbody>
                                        </table>
                                    <?php }?>
                                      <?php if($company_abb=="SLH"){?>
                                        <table  class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th >Item Description</th>
                                                
                                      
                                                <th style="text-align:right">Quantity</th>
                                                <th style="text-align:right">Unit Price</th>
                                                <th style="text-align:right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i= 1;
                                            foreach($spvalue as $key =>$row)
                                            {   
                                            $totalproduct=count($rows->sal_item_id);
                                            $pro_item_name    = $row->item_description;
                                            // $unit         = $row->uniteng;
                                            $qty           = $row->qty;
                                            $unit_price            = $row->unit_price;
                                            $total              = $row->total_cost;
                                            
                                            
     
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td ><?php echo $pro_item_name;?></td>
                                       <!--          <td><?php echo $unit;?></td> -->
                                                <td style="text-align:right"><?php echo $qty ?></td>
                                                <td style="text-align:right"><?php echo  $unit_price;?></td> 
                                              
                                                <td style="text-align:right"><?php echo $total;?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                        </table>
                                    <?php }?>
                                    </div>
                                </div>        
                            </div>
                       </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?php 
                                if($notification!='')
                                {
                                ?>
                                    <div class="alert alert-success no-border successmessage">
                                        <span class="text-semibold"> <?php echo $notification;?></span>
                                    </div>
                                <?php
                                }
                                
                                if($payment_status==0)
                                {
                                ?>
                                    <div class="panel panel-primary" style="border:1px solid #7a6fbe !important;">
                                        <div class="panel-heading">Payment</div>
                                        <div class="panel-body"><br />
                                          <?php echo form_open($form_url1); ?>
                                          <div class="row">
                                             <div class="col-md-3">Credit Amount</div>
                                                <div class="col-md-5">
                                                  <div class="form-group">
                                                    <input type="text" name="invoice_id1" class="form-control invoice_id1" value="<?php echo $credit_amount;?>" id="invoice_id1" readonly>
                                                    <input type="hidden" name="invoice_id" class="form-control invoice_id" value="<?php echo $sal_id;?>"id="invoice_id" readonly>
                                                    <input type="hidden" name="sal_order" class="form-control sal_order" value="<?php echo $sal_order;?>"id="sal_order" readonly>
                                                  </div>
                                                </div>
                                          </div>
                                          
                                          <div class="row">
                                                <div class="col-md-3" >
                                                  <label class="control-label">Payment Amount</label>
                                                </div>
                                                <div class="col-md-5">
                                                  <div class="form-group">
                                                    <input type="hidden" class="form-control date-picker"  value="<?php echo ($collection_date!='' && $collection_date!='0000-00-00') ? date('m/d/Y', strtotime($collection_date)) : date('m/d/Y'); ?>" name="collection_date" id="collection_date" style="background-color:#fff"  >
                                                    <input type="text" name="payment_amount" autocomplete="off" class="form-control payment_amount" value="<?php echo $payment_amount; ?>"id="payment_amount" required="required">
                                                     <label class="error"><?php echo form_error('payment_amount'); ?></label>
                                                  </div>
                                                </div>
                                            
                                          </div>
                                          <div class="row">
                                                <div class="col-md-3" >
                                                  <label class="control-label">Collection Date</label>
                                                </div>
                                                <div class="col-md-5">
                                                  <div class="form-group">
                                                    <input type="text" class="form-control date-picker"  value="<?php echo ($collection_date!='' && $collection_date!='0000-00-00') ? date('m/d/Y', strtotime($collection_date)) : date('m/d/Y'); ?>" name="collection_date" id="collection_date" style="background-color:#fff"  >
                                                     <label class="error"><?php echo form_error('payment_amount'); ?></label>
                                                  </div>
                                                </div>
                                            
                                          </div>
                                          
                                        
                                          
                                          <div class="row">
                                                <div class="col-md-3 " >
                                                  <label class="control-label">Mode Of Payment</label>
                                                </div>
                                                <div class="col-md-5" >
                                                  <div class="form-group">
                                                      <select  class="form-control" name="mode" id="mode" onchange="call(this.value)" required>
                                                          <option value="">--Select Mode--</option>
                                                          <option value="1" <?php if($mode=='1'){?>selected <?php }?>>Cash</option>
                                                          <option value="2" <?php if($mode=='2'){?>selected <?php }?>>Cheque</option>
                                                          <option value="2" <?php if($mode=='3'){?>selected <?php }?>>NEFT</option>
                                                      </select>
                                                      </div>
                                                </div>
                                            
                                          </div>
                                          
                                          <div class="row" style=" <?php if( $mode=='2' && $mode=='3' && $mode!=''){?> display:block;<?php }else{?>display:none;<?php }?>" id="cheque_number">
                                                <div class="col-md-3">
                                                  <label class="control-label">Cheque/NEFT Number</label>
                                                </div>
                                                <div class="col-md-5">
                                                  <div class="form-group">
                                                    <input type="text" name="cheque_number" autocomplete="off" class="form-control cheque_number" value="<?php echo $cheque_number; ?>"id="cheque_number" >
                                                    <label class="error"><?php echo form_error('cheque_number'); ?></label>
                                                  </div>
                                                </div>
                                          </div>
                                          
                                          <div class="row" style=" <?PHP if( $mode=='2' && $mode=='3' && $mode!=''){?>display:block;<?php }else{?>display:none;<?php }?>" id="cheque_date">
                                                <div class="col-md-3">
                                                  <label class="control-label">Cheque/NEFT Date</label>
                                                </div>
                                              
                                                 <div class="col-md-5">
                                                    <input type="text" class="form-control date-picker" autocomplete="off"  value="<?php echo ($cheque_date!='' && $cheque_date!='0000-00-00') ? date('m/d/Y', strtotime($cheque_date)) : date('d/M/Y'); ?>" name="cheque_date" id="cheque_date" style="background-color:#fff"  >
                                                    <label class="error"><?php echo form_error('cheque_date'); ?></label>
                                              
                                                </div>
                                            
                                          </div>
                                          
                                          <div class="row" style=" <?PHP if( $mode=='2' && $mode=='3' && $mode!=''){?>display:block;<?php }else{?>display:none;<?php }?>" id="bank_name">
                                            <div class="col-md-3">
                                              <label class="control-label">Cheque/NEFT Bank Name</label>
                                            </div>
                                            <div class="col-md-5">
                                              <div class="form-group">
                                                <input type="text" name="bank_name" class="form-control bank_name" autocomplete="off" value="<?php echo $bank_name; ?>"id="bank_name" >
                                               <label class="error"><?php echo form_error('bank_name'); ?></label>
                                              </div>
                                            </div>
                                            
                                          </div>
                                          
                                          <div class="row">
                                            <div class="col-md-3">
                                              <label class="control-label">Account Heads</label>
                                            </div>
                                            <div class="col-md-5">
                                              <div class="form-group">
                                                <?php 
                                                  $attrib = 'class="form-control" data-live-search="true" data-width="100%" id="account_heads" ';
                                                  echo form_dropdown('account_heads', $drop_menu_bank, set_value('account_heads', (isset($account_heads)) ? $account_heads : ''), $attrib);
                                                  ?>
                                                <label class="error"><?php echo form_error('account_heads'); ?></label>
                                                </div>
                                              </div>
                                          </div>
                                          
                                          <div class="row">
                                            <div class="text-center">
                                              <input type="hidden" name="sal_id" value="<?php echo $sal_id;?>">
                                              <input type="hidden" name="sal_grand_total" value="<?php echo $sal_grand_total;?>">
                                              <input type="hidden" name="con_id" value="<?php echo $sal_company_name;?>">
                                              <button type="submit" name="Submit" class="btn btn-primary">submit</button>
                                            </div>
                                          </div>
                                          <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                <?php 
                                }
                                ?>
                            </div>
                            
                            <div class="col-md-6">
                             <div class="panel panel-white">
                                <div class="text-right">
                                    
                                   
                                      <h4 class="no-m m-t-md ">Sub Total</h4>
                                    <h1 class="no-m text-success"><?php echo $getCurrency;?> <?php echo number_format((float)$sal_sub_total , 2, '.', '');?></h1><br>
                                     <h4 class="no-m m-t-md ">Vat Amount</h4>
                                    <h1 class="no-m text-success"><?php echo $getCurrency;?> <?php echo number_format((float)$sal_tax_amount , 2, '.', '');?></h1><br>
                                     <h4 class="no-m m-t-md ">Total</h4>
                                    <h1 class="no-m text-success"><?php echo $getCurrency;?> <?php echo number_format((float)$grand_total , 2, '.', '');?></h1>
                                     <hr>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--row-->
                        
                        <div class="row">
                         <div class="col-md-12">
                          <div class="panel panel-success">
                          <div class="panel-heading">   
                          			<h2 class="panel-title">Previous Payment Details</h2></div>
                                    <div class="panel-body">
                                         <table  class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Amount(<?php echo $getCurrency;?>)</th>
                                                    <th>Collection Date</th>
                                                    <th>Transaction Date</th>
                                                    <th>Payment Mode</th>
                                                    <th>Transaction Detail</th>
                                                    <th>Bank Name</th>
                                                    <th>Account Heads</th>
                                                    <th>Posted By</th>
        
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <?php
													$i=1;
													foreach($payment_detail as $key => $row)
													{
														
														$payment_id            	= $row->payment_id; 
														$invoice_id            	= $row->invoice_id; 
														$amount                	= $row->amount; 
														$paidamount				+=$amount   ;
														$date                  	= $row->date;    
														$payment_mode          	= $row->payment_mode;
														$transaction_number    	= $row->transaction_number;
														$transaction_date      	= $row->transaction_date;
														$transaction_bank_name 	= $row->transaction_bank_name;
														$account_heads         	= $row->account_heads;
														$sal_person         	= $row->sal_person;
													?>
                                                        <tr >
                                                            <td><?php echo $i++;?></td>
                                                            <td><?php echo number_format((float) $amount, 2, '.', '') ;?></td>
                                                            <td><?php echo date('Y-m-d', strtotime($date));?></td>
                                                            <td><?php echo $transaction_date  ;?></td>
                                                            <td><?php  if($payment_mode==1){echo "cash";}else{echo "Cheque/NEFT";}   ?></td>
                                                            <td> Transaction No:<?php echo $transaction_number;?><br>
                                                            	 Transaction Bank:<?php echo $transaction_number;?>
                                                            </td>
                                                            <td><?php echo $transaction_bank_name  ;?></td>
                                                            <td><?php echo $account_heads  ;?></td>
                                                            <td><?php echo $sal_person   ;?></td>
                                                        </tr>
                                                    <?php 
													}?>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
    <!-- Main Wrapper -->
           
</div><!-- Page Inner -->

<script>

    function conformmail(id)
    {

        var x;
        var r=confirm("Are You Sure You Want to send a mail?!!");
        if(id!='' && r==true)
        {
              $.ajax({"url":"<?php echo site_url('Sales_order/mailPo'); ?>",
              "type":"POST",
              data:{
                  "id":id
              },

              success:function(data)
                {
                  alert(data);
                }
              
              });
        }
    }

function call(val)
{
	if(val == 1  )
	{
		$('#cheque_number').css('display','none');
		$('#cheque_date').css('display','none');
		$('#bank_name').css('display','none');
		$('#cheque_number').val('');
		$('#cheque_date').val('');
		$('#bank_name').val('');
	}
	if(val == 2  )
	{
		$('#cheque_number').css('display','block');
		$('#cheque_date').css('display','block');
		$('#bank_name').css('display','block');
		$('#cheque_number').val('');
		$('#cheque_date').val('');
		$('#bank_name').val('');
	}
}
</script>