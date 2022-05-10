<script type="text/javascript">
//<![CDATA[
function printPage() 
{
  var printContents = document.getElementById('printContent').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
 
}

if(window.addEventListener) 
{
  window.addEventListener("load", printPage, false);
} 
else if(window.attachEvent) 
{
  window.attachEvent("onload", printPage);
}

</script>
<link href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<div id="printContent">
<?php 
	foreach($organization_detail->result() as $row)
	{
		$c_id           = $row->c_id;
		$c_logo         = $row->c_logo; 
		$c_org_name     = $row->c_org_name; 
		$c_street       = $row->c_street; 
    $c_city         = $row->c_city;
    $c_area         = $row->c_area;
		$c_state        = $row->c_state;
		$c_pincode      = $row->c_pincode;
		$c_country      = $row->c_country;
		$c_phone        = $row->c_phone;
    $c_mobile        = $row->c_mobile;
		$c_fax          = $row->c_fax;
		$c_website      = $row->c_website;    
		$c_email        = $row->c_email;
		$cur_name       = $row->cur_name;
		$cur_symbol     = $row->cur_symbol;
	}
	
	foreach($company_details->result() as $row)
	{
		$con_display_name           = $row->con_display_name; 
		$con_company_name           = $row->vendor_name; 
		$contact_address            = $row->address; 
		$contact_area               = $row->contact_area;    
		$con_phone                  = $row->vendor_mobile;
		$con_email                  = $row->vendor_email;
		$con_primary                = $row->vendor_name;
		
		$con_website                = $row->con_website;
		$contact_phone              = $row->contact_phone;
		$contact_state              = $row->contact_state;
		$contact_zip                = $row->contact_zip;
		$contact_country            = $row->contact_country;
		$contact_email              = $row->contact_email;
		$contact_website            = $row->contact_website;
		$contact_zip                = $row->contact_zip;
	}

	foreach($value1->result() as $row)
	{     
		$po_id                = $row->po_id;
		$po_no                = $row->po_no;
		$order_date           = $row->order_date;
		$vendor_id            = $row->vendor; 
		$ref_no               = $row->ref_no;      
		$del_date             = $row->del_date;
		$ship_pref_id         = $row->ship_pref_id;   
		$sub_total            = $row->cost_price;
		$cost_price1          = $row->cost_price;
		$selling_price1       = $row->selling_price;
		$total_cost_price     = $row->total_cost_price;
		$total_selling_price  = $row->total_selling_price;
		$terms                = $row->terms;   
		$del_addr             = $row->del_addr;
		// $con_phone            = $row->con_phone;
		// $con_email            = $row->con_email;
		$contact_city         = $row->contact_city;
		$con_first_name       = $row->con_first_name;
		$notes                = $row->notes;
		$po_status            = $row->po_status;  
		$po_created_by        = $row->po_created_by;          
		$po_created_on        = $row->po_created_on;
		$rec_status           = $row->rec_status;         
	}
$getCurrency=$this->pre->getCurrencynew();
$Y= date('Y');
$y=date('y');
?>
    <!-- invoice  Start -->
<style>
.break
 {
    page-break-after: auto !important;
  }
  @page
  {
     page-break-after:auto;
  }
  .height20
  {
    height: 20px;
  }
   body, td
  {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	font-style: normal;
	font-variant: normal;
	font-weight: 400;
	line-height: 20px;
	vertical-align: top;
  }
  .br_none_l
  {
    border-left:none;
  }
  .br_none_r
  {
    border-right:none;
  }
  .br_none_t
  {
    border-top:none;
  }
  .br_none_b
  {
    border-bottom:none;
  }
  .h4
  {
    font-size:16px;
  }
</style>

<table width="100%">
  <tr>
  	  <td valign="middle" width="100"><img src="<?php echo base_url().$c_logo;?>" height="50" style="padding:0 25px;"/></td>
      <td class="br_none_r">
          <h2 style="margin-bottom:0;"><?php echo strtoupper($c_org_name);?></h2>
          <?php echo $c_street;?><br /><?php echo ($c_area!='') ? $c_area.'<br />' : '';?>
          <?php echo $c_city;?>, <br /><?php echo $c_state;?> <?php echo $c_pincode;?> <br />
		  <?php echo $c_country;?><br />
      </td>
      <td align="right" valign="top">
          <?php echo (trim($c_mobile) != '') ? '<br /><strong>Mobile</strong> : '.$c_mobile : '';?>
          <?php echo (trim($c_phone) != '') ? '<br /><strong>Phone</strong>	: '.$c_phone : '';?>
          <?php echo (trim($c_fax) != '') ? '<br /><strong>Skype</strong> : '.$c_fax : '';?>
          <?php echo (trim($c_website) != '') ? '<br /><strong>Website</strong> : '.$c_website : '';?>
      </td>
  </tr>
</table>
<hr />
<h1 align="right">PURCHASE ORDER</h1>         
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        <td colspan="3" rowspan="3" class="br_none_l" style="width:33%">
           <strong>To : </strong></br>
              <h3 style="margin:0;"><?php echo $con_primary;?></h3>
             <!--  <?php echo $con_company_name;?></br> -->
              <?php echo $contact_address;?><br>
              <?php echo ($contact_area!='') ? $contact_area.'<br />' : '';?>
              <?php echo $con_phone;?><br/>
              <?php echo $con_email;?>    
        </td>    
        <td colspan="3" rowspan="3" style="width:33%">
          <strong>Delivery To : </strong><br>
          <?php 
          if(!empty($del_addr))
          {
          ?>
            <?php echo $del_addr;?>
            <?php
          }
          else
          {
           ?>
              <h3 style="margin:0;"><?php echo $contact_address;?><br></h3>
             <!--  <?php echo $contact_address;?><br> -->
             <!--  <?php echo ($contact_area!='') ? $contact_area.'<br />' : '';?>
              <?php echo $contact_city;?><br/>
              <?php echo $contact_state.' '.$contact_zip;?> -->
          <?php 
          }?>
        </td>
        <td colspan="3">
           <strong>PO No. : </strong><h3 style="margin:0;"><?php echo $po_no;?></h3>
        </td>
    </tr>
    <tr>
        <td colspan="3">
           <strong>PO Date : </strong><?php echo date('d/m/Y', strtotime($order_date));?>
        </td>
    </tr>
    <tr>
        <td colspan="3">
           <strong>Ref No. : </strong><?php echo $ref_no;?>
        </td>
    </tr>
</table>
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
  <tr>
        <th  width="5%">Sl.No.</th>
        <th  width="50%">Item Description</th>
        <th  width="10%">Discount %</th>
        <th  width="10%">Qty</th>
        <th  width="10%" align="right">Price(<?php echo $getCurrency;?>)</th>
        <th  width="15%" align="right">Total Price<br>(<?php echo $getCurrency;?>)</th>
    </tr>
	<?php
    $i= 1;
    foreach($poproduct as $key =>$row)
    {   
		$pro_item_id              =   $row->pro_item_id;
		$pro_item_name            =   $row->pro_item_name;
		$unit_name                =   $row->unit_name;
		$pieces_per_unit          =   $row->discount;
		$selling_price            =   $row->selling_price;
		$quantity                 =   $row->quantity;
		$recd_qty                 =   $row->recd_qty;
		$price_amt                =   $row->price;
		$pdt_tax_amt              =   $row->pdt_tax_amt;
		$amount                   =   $row->amount; 
		$pro_item_name            =   $row->pro_item_name;
		$cost_price               =   $row->price;
		$cost_tax_amount          =   $row->cost_tax_amount;
		$selling_tax_amount       =   $row->selling_tax_amount;
		$selling_total_amount     =   $row->selling_total_amount;
		$selling_total_amount1   +=   $row->selling_total_amount;
		$cost_total_amount        =   $row->total_amount;
		$cost_total_amount1      +=   $row->total_amount;
    ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $pro_item_name;?></td>
        <td align="center"><?php echo $pieces_per_unit;?></td>
        <td align="center"><?php echo $quantity;?></td>
        <td align="right"><?php echo $cost_price;?></td>
        <td align="right"><?php echo $cost_total_amount;?></td>
    </tr>
    <?php
    }
    
    for ($j=$i; $j <= 15; $j++)
    {?>
    <tr style="height:30px;">
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
    </tr>
    <?php 
    }
    ?>
    <tr>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b" align="right"><i><strong>Total</strong></i></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b" align="right">
        	<strong><?php echo $getCurrency;?> <?php echo number_format($cost_total_amount1, 2, '.', '');?></strong>
        </td>
    </tr>
	<?php  
    foreach($get_tax as $key =>$row)
    { 
      ?> 
    <tr>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b" align="right"><i><strong><?php echo $row->tax_name;?></strong></i></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b" align="right">
        	<strong><?php echo $getCurrency;?> </i><?php echo number_format($row->cost_tax, 2, '.', '');?></strong>
        </td>
    </tr>
    <?php 
    }
    ?>   
    <tr>
        <td class=""></td>
        <td class="br_none_b" align="right"><i><strong>Nett. Amount</strong></i></td>
        <td class="br_none_b"></td>
        <td class="br_none_b"></td>
        <td class="br_none_b"></td>
        <td class="br_none_b" align="right">
        	<strong><?php echo $getCurrency;?> <?php echo number_format($total_cost_price, 2, '.', '');?> </strong>
        </td>
    </tr>
    <tr>
        <td colspan="3"><strong>Terms and Conditions</strong><br /><?php echo $this->pref->po_notes;?></td>
        <td colspan="3" align="right">
        	For <strong><?php echo strtoupper($c_org_name);?></strong>
            <br />
            <br />
            <br />
            Authorized Signatory
        </td>
    </tr>
  </table>
</div>
