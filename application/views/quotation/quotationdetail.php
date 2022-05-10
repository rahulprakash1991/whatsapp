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
	$con_company_name           = $row->con_company_name; 
	$con_address                = $row->con_address; 
	$con_email                  = $row->con_email;    
	$con_phone                  = $row->con_phone;
	$contact_website            = $row->contact_website;
	$contact_area               = $row->contact_area;
	$contact_city               = $row->contact_city;
	$contact_state              = $row->contact_state;
	$contact_address            = $row->contact_address;
}

foreach($value->result() as $row)
{
	$quo_id       				= $row->quo_id;
	$quo_customer_address       = $row->quo_customer_address;
	$quo_date                   = $row->quo_date; 
	$quo_company_name           = $row->quo_company_name;
	$quo_reference              = $row->quo_reference; 
	$quo_order                  = $row->quo_order; 
	$quo_person                 = $row->quo_person; 
    
    $quo_customer_notes         = $row->quo_customer_notes;
	$quo_delivery_date          = $row->quo_delivery_date;
	$quo_sub_total              = $row->quo_sub_total;
	$quo_discount               = $row->quo_discount;
	$quo_invoice_status         = $row->quo_invoice_status;
	$payment_status         	= $row->payment_status;
	$quo_grand_total            = $row->quo_grand_total;
	$quo_delivery_amount        = $row->quo_delivery_amount; 
	$grand_total                = $quo_grand_total-$quo_discount+$quo_delivery_amount;
	$quo_tax_amount             = explode(',',$row->quo_tax_amount);
	$quo_tax_id                	= explode(',',$row->quo_tax_id);
	$paid_amount              	= $row->paid_amount;
	$quo_created_on             = $row->quo_created_on;
	$quo_created_by             = $row->quo_created_by;
}

$getCurrency=$this->pre->getCurrencynew();
$Y= date('Y');
$y=date('y');
?>	

<div class="page-inner">
            
    <div class="page-title">
        <div class="pull-right">         
            <a href="<?php echo base_url();?>Quotation/manage" class="btn btn-info">
                <i class="fa fa-angle-double-left"></i> Back to List
            </a>
            <div class="btn btn-danger" onclick="conformmail(<?php echo $quo_id;?>)">
                <i class="fa fa-envelope-o m-r-xs"></i>Send Quotation
            </div>
            <a href="<?php echo base_url();?>Quotation/printQuotation/<?php echo $quo_id;?>" class="btn btn-default" target="_blank">
                <i class="fa fa-print m-r-xs"></i>Print
            </a>                                         
        </div>
        <h3>Quotation</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>">Home</a></li>
                <li class="active">Quotation</li>
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
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4 text-right">
                                <h1 style="margin-top:0;"><strong>Quotation</strong> #<?php echo $quo_order;?></h1>
                                <table class="table table-striped">
                                    <tr>
                                        <td><strong>Quotation Date :</strong></td>
                                        <td><?php echo date('d/m/Y', strtotime($quo_date));?></td>
                                    </tr>
                                </table>   
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Item Details</div>
                                    <div class="panel-body">
                                        <table  class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th style="text-align:right">Price(<?php echo $getCurrency;?>)</th>
                                                <th style="text-align:right">Total(<?php echo $getCurrency;?>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            foreach($spvalue as $key => $rows)
                                            {
                                                $totalproduct	=	count($rows->pro_item_id);
                                        
                                                $pro_item_name  = $rows->pro_item_name;
                                                $pro_item_id    = $rows->pro_item_id;
                                                $unit           = $rows->unit;
                                                $price_amt      = $rows->price_amt;
                                                $quantity       = $rows->quantity;
                                                $amount         = $rows->amount;
                                                $tax_id         = $rows->tax_id;
                                                $tax_name       = $rows->tax_name;
                                                $tax_percent    = $rows->tax_percent;
                                                $available_qty  = $rows->available_qty;
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $pro_item_name;?></td>
                                                <td><?php echo $quantity;?></td>
                                                <td style="text-align:right"><?php echo $price_amt;?></td>
                                                <td style="text-align:right"><?php echo $amount;?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>        
                            </div>
                       </div>

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Customer Notes:</strong>
                                <br>
                                <?php echo $quo_customer_notes;?>
                            </div>
                            <div class="col-md-6">
                             <div class="panel panel-white">
                                <div class="text-right">
                                    <h4 class="no-m m-t-sm">Subtotal</h4>
                                    <h2 class="no-m"><?php echo $getCurrency;?> <?php echo number_format((float)$quo_sub_total, 2, '.', '');?></h2>
                                    <hr>
                                    <?php if(!empty($quo_discount)){?>
                                    <h4 class="no-m m-t-sm">Discount</h4>
                                    <h2 class="no-m"><?php echo $getCurrency;?> <?php echo number_format((float)$quo_discount, 2, '.', '');?></h2>
                                     <hr>
                                    <?php
                                    }
                                    ?>
                                    <?php foreach($quotation_tax as$key => $rows)
                                    {
                                    $quo_tax_amount     = $rows->quo_tax_amount;
                                    $tax_name      		= $rows->tax_name;

                                    ?>
                                    <?php if(!empty($quo_tax_amount)){?>
                                    <h4 class="no-m m-t-sm"><?php echo $tax_name;?></h4>
                                    <h2 class="no-m "><?php echo $getCurrency;?> <?php echo number_format((float) $quo_tax_amount, 2, '.', '');?></h2>
                                    <hr>
                                    <?php
                                    }
                                    }
                                    ?>
                                    <?php if(!empty($quo_delivery_amount)){?>
                                    <h4 class="no-m m-t-sm">Delivery Amount</h4>
                                    <h2 class="no-m"><?php echo $getCurrency;?> <?php echo number_format((float)$quo_delivery_amount, 2, '.', '');?></h2>
                                     <hr>
                                     <?php
                                    }
                                    ?>
                                     <h4 class="no-m m-t-md ">Total</h4>
                                    <h1 class="no-m text-success"><?php echo $getCurrency;?> <?php echo number_format((float)$grand_total , 2, '.', '');?></h1>
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
           
</div><!-- Page Inner -->
<script>
    function conformmail(id)
    {
        var x;
        var r=confirm("Are You Sure You Want to send a mail?!!");
        if(id!='' && r==true)
        {
              $.ajax({"url":"<?php echo site_url('Quotation/mailQuotation'); ?>",
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
</script>
