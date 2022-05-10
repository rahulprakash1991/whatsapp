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
    $credit_id                = $row->credict_id; 
	$credit_no                = $row->credit_number; 
    $credit_date           = $row->credictnote_createdOn; 
    $credit_balance_amount = $row->balance_amount;
    $credit_total = $row->credict_total;
    $credit_sub_total = $row->credict_sub_total;
    $credit_vat_amount = $row->credit_vat_amount;
    $credit_status = $row->credit_status;
}
foreach($valuesal->result() as $row)
  {
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
    $sal_grand_total            = $row->sal_grand_total;
    $sal_tax_amount             = $row->sal_tax_amount;
    $sal_tax_id                = explode(',',$row->sal_tax_id);
    $sal_delivery_amount        = $row->sal_delivery_amount;
    $grand_total                = $sal_grand_total+$sal_tax_amount;    
    $sal_created_on             = $row->sal_created_on;
    $sal_created_by             = $row->sal_created_by;
    $po_no                     = $row->po_num;
    $payment_term             = $row->payment_term;
    $sal_order1                  = explode('/',$row->sal_order);
    $currency             = $row->sal_curency;
    $amount_with_out_tax = $sal_grand_total - $sal_tax_amount;

}

$Y= date('Y');
$y=date('y');
$getCurrency=$this->pre->getCurrencynew();
?>	

<div class="page-inner">
            
    <div class="page-title">
        <div class="pull-right">         
            <a href="<?php echo base_url();?>Credict_notes" class="btn btn-info">
                <i class="fa fa-angle-double-left"></i> Back to List
            </a>
            <div class="btn btn-danger" onclick="conformmail(<?php echo $credit_id;?>)">
                <i class="fa fa-envelope-o m-r-xs"></i>Send Credit Note
            </div>
             <?php if($credit_status!= 1){?>
            <div class="btn btn-primary" onclick="applyInvoice(<?php echo $credit_id;?>,<?php echo $client_id;?>)">
                <i class=""></i>Apply To Invoice
            </div>
        <?php }?>
            <a href="<?php echo base_url();?>Credict_notes/printCredict_notes/<?php echo $credit_id;?>" class="btn btn-default" target="_blank">
                <i class="fa fa-print m-r-xs"></i>Print
            </a>                                         
        </div>
        <h3>Credit Note</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="index-2.html">Home</a></li>
            <!--     <li><a href="#">Extra</a></li> -->
                <li class="active">Credit Note</li>
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
                                <h1 style="margin-top:0;">Credit Note # <strong><?php echo "  "; echo $credit_no;?></strong></h1>
                                <table class="table table-striped">
                                     <tr>
                                        <td><strong>Credit Note Date :</strong></td>
                                        <td><?php echo date('d/m/Y', strtotime($credit_date));?></td>
                                    </tr>
                                     <tr>
                                        <td><strong>Invoice No  :</strong></td>
                                        <td><?php echo $sal_order;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Invoice Date :</strong></td>
                                        <td><?php echo date('d/m/Y', strtotime($sal_order_date));?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Customer Reference ID :</strong></td>
                                        <td><?php echo $client_key;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Credit Note Amount :</strong> </td>
                                        <td><?php echo $getCurrency;?> <?php echo number_format((float) $credit_total, 2, '.', '');?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Credit Not Balance Amount :</strong></td>
                                        <td><?php echo $getCurrency;?> <?php echo number_format((float)$credit_balance_amount, 2, '.', '');?></td>
                                    </tr>
                                </table>
                                <table class="table table-striped">
                                    <tr>
                                        <!-- <td><strong>Payment Status</strong>
                                        <?php 
                                            if($payment_status==1){?>
                                                <div class="label label-success" role="button">Completed</div>
                                            <?php }else {?>
                                                <div class="label label-warning" role="button">Pending</div>
                                            <?php }?>
                                        </td> -->
                                        <td><strong>Credit Note Status</strong>
                                        <?php 
                                            if($credit_balance_amount==0){?>
                                                <div class="label label-success" role="button" style="font-size: 16px;">Closed</div>
                                            <?php }else {?>
                                                <div class="label label-danger" role="button" style="font-size: 16px;">Open</div>
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
                                            ?>
                                        </tbody>
                                        </table>
                                    <?php }?>
                                        <?php if($company_abb=="NH" || $company_abb=="ARA" ){?>
                                        <table  width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">S.No</th>
                                                <th style="width: 65%;" >Item Description</th>
                                                
                                                <th style="width: 5%;text-align: center;" >Unit</th>
                                                <th style="text-align:right;width: 7%;">Quantity</th>
                                                <th style="text-align:right;width: 8%;">Unit Price</th>
                                                <th style="text-align:right;width: 10%;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i= 1;
                                            foreach($spvalue as $key =>$row)
                                            {   
                                            $totalproduct=count($rows->sal_item_id);
                                            $pro_item_name    = $row->item_description;
                                            $unit         = $row->unit;
                                            $qty           = $row->qty;
                                            $unit_price            = $row->unit_price;
                                            $total              = $row->total;
                                            
                                            
     
                                            ?>
                                            <tr>
                                                <td style="width: 5%;"><?php echo $i++;?></td>
                                                <td style="width: 65%"><?php echo $pro_item_name;?></td>
                                                <td style="width: 5%;text-align: center;"><?php echo $unit;?></td>
                                                <td style="text-align:right;width: 7%;"><?php echo $qty ?></td>
                                                <td style="text-align:right;width: 8%;"><?php echo  $unit_price;?></td> 
                                              
                                                <td style="text-align:right;width: 10%;"><?php echo $total;?></td>
                                            </tr>
                                            <?php 
                                            }
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
                                
                                ?>
                            </div>
                            
                            <div class="col-md-6">
                             <div class="panel panel-white">
                                <div class="text-right">
                                    
                                   
                                    <h4 class="no-m m-t-md ">Sub Total</h4>
                                    <h1 class="no-m text-success"><?php echo $getCurrency;?> <?php echo number_format((float)$credit_sub_total , 2, '.', '');?></h1><br>
                                     <h4 class="no-m m-t-md ">Vat Amount</h4>
                                    <h1 class="no-m text-success"><?php echo $getCurrency;?> <?php echo number_format((float)$credit_vat_amount , 2, '.', '');?></h1><br>
                                     <h4 class="no-m m-t-md ">Total</h4>
                                    <h1 class="no-m text-success"><?php echo $getCurrency;?> <?php echo number_format((float)$credit_total , 2, '.', '');?></h1>
                                     <hr>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--row-->
                     
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
    <!-- Main Wrapper -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">                       
                <div class="modal-content" id="viewajaxcontent">   
                </div>
            </div>
        </div>       
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
function applyInvoice(cr_id,client_id)
{
   $.ajax({
              type: "GET",
              url: "<?php echo site_url('Credict_notes/applyInvoice'); ?>",
              data: {credit_id:cr_id,client_id:client_id},
              dataType:"html",
              success: function(response)
              {
        
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });
}
</script>