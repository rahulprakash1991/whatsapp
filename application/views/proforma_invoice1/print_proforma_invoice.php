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
    $c_mobile        = $row->c_mobile;
    $c_phone        = $row->c_phone;
		$c_fax          = $row->c_fax;
		$c_website      = $row->c_website;    
		$c_email        = $row->c_email;
		$cur_name       = $row->cur_name;
		$cur_symbol     = $row->cur_symbol;
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
		$pro_customer_address       = $row->pro_customer_address;
		$pro_order_date             = $row->pro_order_date; 
		$pro_company_name           = $row->pro_company_name;
		$pro_reference              = $row->pro_reference; 
		$pro_order                  = $row->pro_order; 
		$pro_person                 = $row->pro_person;    
		$pro_delivery_date          = $row->pro_delivery_date;
		$pro_sub_total              = $row->pro_sub_total;
    $terms                      = $row->pro_customer_notes;
		$pro_discount               = $row->pro_discount;
		$pro_grand_total            = $row->pro_grand_total;
		$pro_tax_amount             = explode(',',$row->pro_tax_amount);
		$pro_tax_id                = explode(',',$row->pro_tax_id);
		$pro_delivery_amount        = $row->pro_delivery_amount;
		$grand_total                = $pro_grand_total-$pro_discount+$pro_delivery_amount;    
		$pro_created_on             = $row->pro_created_on;
		$pro_created_by             = $row->pro_created_by;
	}
	
	$Y= date('Y');
	$y=date('y');
  $getCurrency=$this->pre->getCurrencynew();
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
<h1 align="right">PROFORMA INVOICE</h1>         
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        <td colspan="3" rowspan="3" class="br_none_l" style="width:33%">
           <strong>To : </strong></br>
              <h3 style="margin:0;"><?php echo $con_primary;?></h3>
              <?php echo $con_company_name;?></br>
              <?php echo $contact_address;?><br>
              <?php echo ($contact_area!='') ? $contact_area.'<br />' : '';?>
              <?php echo ($contact_city!='') ? $contact_city.'<br />' : '';?>
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
              <h3 style="margin:0;"><?php echo $con_company_name;?></h3>
              <?php echo $contact_address;?><br>
              <?php echo ($contact_area!='') ? $contact_area.'<br />' : '';?>
              <?php echo ($contact_city!='') ? $contact_city.'<br />' : '';?>
              <?php echo $contact_state.' '.$contact_zip;?>
          <?php 
          }?>
        </td>
        <td colspan="3">
           <strong>Invoice No. : </strong><h3 style="margin:0;"><?php echo $pro_order;?></h3>
        </td>
    </tr>
    <tr>
        <td colspan="3">
           <strong>Invoice Date : </strong><?php echo date('d/m/Y', strtotime($pro_order_date));?>
        </td>
    </tr>
    <tr>
        <td colspan="3">
           <strong>Ref No. : </strong><?php echo $pro_reference;?>
        </td>
    </tr>
</table>
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        <th  width="5%">Sl.No.</th>
        <th  width="50%">Item Description</th>
        <th  width="10%">PCS/Box</th>
        <th  width="10%">Qty</th>
        <th  width="10%" align="right">Price(<?php echo $getCurrency;?>)</th>
        <th  width="15%" align="right">Total Price<br>(<?php echo $getCurrency;?>)</th>
    </tr>
	<?php
    $i= 1;
    foreach($spvalue as $key =>$row)
    {   
      $totalproduct=count($rows->pro_item_id);
  
      $pro_item_name  	= $row->pro_item_name;
      $pro_item_id    	= $row->pro_item_id;
      $unit           	= $row->unit;
      $price_amt      	= $row->price_amt;
      $quantity       	= $row->quantity;
      $amount         	= $row->amount;
	  $pieces_per_unit 	= $row->pieces_per_unit;

    ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $pro_item_name;?></td>
        <td align="center"><?php echo $pieces_per_unit;?></td>
        <td align="center"><?php echo $quantity;?></td>
        <td align="right"><?php echo $price_amt;?></td>
        <td align="right"></i> <?php echo $amount;?></td>
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
        	<strong><?php echo $getCurrency;?></i> <?php echo $pro_sub_total ;?></strong>
        </td>
    </tr>
	<?php 
	if($pro_discount > 0)
    {
		?>
        <tr>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right"><i><strong>Discount</strong></i></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right">
            	<strong><?php echo $getCurrency;?></i> <?php echo number_format((float)$pro_discount, 2, '.', '');?></strong>
            </td>
        </tr>
    <?php
    }
	?>
	<?php  
    foreach($sales_order_tax as $key =>$row)
    {
		if($row->pro_tax_amount > 0)
		{ 
		  ?> 
            <tr>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b" align="right"><i><strong><?php echo $row->tax_name;?></strong></i></td>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b" align="right">
                	<strong><?php echo $getCurrency;?></i> <?php echo $row->pro_tax_amount;?></strong>
                </td>
            </tr>
		<?php 
		}
    }
    ?>  
	<?php 
	if($pro_delivery_amount > 0)
    {
		?>
        <tr>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right"><i><strong>Shipping Charges</strong></i></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right">
            	<strong><?php echo $getCurrency;?></i> <?php echo number_format($pro_delivery_amount, 2, '.', '');?></strong>
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
        <td class="br_none_b" align="right"><strong><?php echo $getCurrency;?></i> <?php echo number_format($grand_total, 2, '.', '');?></strong></td>
    </tr>
    <tr>
        <td colspan="3">
        <strong>Terms and Conditions</strong>
        <br /><?php echo $this->pref->inv_terms;?>
       <?php  if(!empty($terms))
        { ?>
        <hr>
         <strong>Customer Notes</strong>
         <br /><?php echo $terms   ;?>
         <?php }?>
        </td>
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