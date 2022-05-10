<script type="text/javascript">
//<![CDATA[

function printPage() 
{
// setTimeout(3000);
  var printContents = document.getElementById('printContent').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    setTimeout(function(){ window.print(); }, 600);
    
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
    $c_area         = $row->c_area; 
		$c_city         = $row->c_city;
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
		$contact_address            = $row->address;
     $con_company_name1                  = explode(' ',$con_company_name);
       $elements1 = array();
foreach($con_company_name1 as $data) {
    //do something
    $elements1[] = $data ;
}
$ven_name =  implode('-', $elements1);
// print_r($ven_name);die;
	}
	
	foreach($value->result() as $row)
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
		$grand_total                = $sal_grand_total-$sal_discount+$sal_delivery_amount;    
		$sal_created_on             = $row->sal_created_on;
		$sal_created_by             = $row->sal_created_by;
    $sal_order1                  = explode('/',$row->sal_order);
 $Qrdate = date('d-m-Y', strtotime($sal_order_date));
 // $time = time("h:i:sa", strtotime($sal_created_on  ));
 $d=strtotime($sal_created_on);
$Qr_time = date("h:i:sa", $d);
 // print_r($time);die;
    $elements = array();
foreach($sal_order1 as $data) {
    //do something
    $elements[] = $data ;
}
$dd =  implode('-', $elements);

  
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
          <?php echo ($c_city!='') ? $c_city.'<br />' : '';?><?php echo $c_state;?> <?php echo $c_pincode;?> <br />
		  <?php echo $c_country;?><br />
      </td>
      <td align="right" valign="top">
         <!--  <?php echo (trim($c_mobile) != '') ? '<br /><strong>Mobile</strong> : '.$c_mobile : '';?>
          <?php echo (trim($c_phone) != '') ? '<br /><strong>Phone</strong>	: '.$c_phone : '';?>
          <?php echo (trim($c_fax) != '') ? '<br /><strong>Skype</strong> : '.$c_fax : '';?>
          <?php echo (trim($c_website) != '') ? '<br /><strong>Website</strong> : '.$c_website : '';?><br> -->
          <img src="<?php echo base_url('Sales_order/QRcode/'.$dd.'/'.$ven_name.'/'. $Qrdate.'/'.$Qr_time.'/'.$sal_grand_total.'/'.$sal_tax_amount   ); ?>" alt="" style="padding-left: 30px;width: 150px;height: 150px;"> 
      </td>
  </tr>
</table>
<hr />
<h1 align="right">INVOICE</h1>         
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        <td colspan="3" rowspan="3" class="br_none_l" style="width:33%">
           <strong>To : </strong></br>
              <h3 style="margin:0;"><?php echo $con_company_name;?></h3>
              <!-- <?php echo $con_company_name;?></br> -->
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
              <h3 style="margin:0;"><?php echo $contact_address;?></h3>
             <!--  <?php echo $contact_address;?><br>
              <?php echo ($contact_area!='') ? $contact_area.'<br />' : '';?>
              <?php echo ($contact_city!='') ? $contact_city.'<br />' : '';?>
              <?php echo $contact_state.' '.$contact_zip;?> -->
          <?php 
          }?>
        </td>
        <td colspan="3">
           <strong>Invoice No. : </strong><h3 style="margin:0;"><?php echo $sal_order;?></h3>
        </td>
    </tr>
    <tr>
        <td colspan="3">
           <strong>Invoice Date : </strong><?php echo date('d/m/Y', strtotime($sal_order_date));?>
        </td>
    </tr>
    <tr>
        <td colspan="3">
           <strong>Ref No. : </strong><?php echo $sal_reference;?>
        </td>
    </tr>
</table>
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        <th  width="5%">Sl.No.</th>
        <th  width="40%">Item Description</th>
        <th  width="15%">Discount %</th>
        <th  width="15%">Qty</th>
        <th  width="10%" align="right">Price(<?php echo $getCurrency;?>)</th>
        <th  width="15%" align="right">Total Price<br>(<?php echo $getCurrency;?>)</th>
    </tr>
	<?php
    $i= 1;
    foreach($spvalue as $key =>$row)
    {   
      $totalproduct=count($rows->sal_item_id);
  
      $pro_item_name  	= $row->pro_item_id;
      $sal_item_id    	= $row->sal_item_id;
      $discount           	= $row->discount;
      $price_amt      	= $row->price_amt;
      $quantity       	= $row->quantity;
      $amount         	= $row->total_cost;
      $cost_total_amount1      +=   $row->total_cost;
	 
    ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $pro_item_name;?></td>
        <td align="center"><?php echo $discount;?></td>
        <td align="center"><?php echo $quantity;?></td>
        <td align="right"><?php echo $price_amt;?></td>
        <td align="right"><?php echo $amount;?></td>
    </tr>
    <?php
    }
    
    for ($j=$i; $j <= 15; $j++)
    {?>
    <tr style="height:20px;">
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
   
	<!-- <?php  
   
    if($sal_tax_amount > 0)
    { 
      ?> 
        <tr>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right"><i><strong>Vat Amount</strong></i></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right">
            	<strong><?php echo $getCurrency;?><?php echo number_format((float)$sal_tax_amount, 2, '.', '');?></strong>
            </td>
        </tr>
 <?php }?> -->
	<?php  
    foreach($sales_order_tax as $key =>$row)
    {
		if($row->sal_tax_amount > 0)
		{ 
		  ?> 
            <tr>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b" align="right"><i><strong><?php echo $row->tax_name;?></strong></i></td>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b"></td>
                <td class="br_none_t br_none_b" align="right">
                	<strong><?php echo $getCurrency;?><?php echo $row->sal_tax_amount;?></strong>
                </td>
            </tr>
		<?php 
		}
    }
    ?>  
	<?php 
	if($sal_delivery_amount > 0)
    {
		?>
        <tr>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right"><i><strong>Shipping Charges</strong></i></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b"></td>
            <td class="br_none_t br_none_b" align="right">
            	<strong><?php echo $getCurrency;?><?php echo number_format($sal_delivery_amount, 2, '.', '');?></strong>
            </td>
        </tr>
    <?php
    }
	?>
   <tr>
    
         <td class=""></td>
        <td class="br_none_b" colspan="2" ></td>
        <td class="br_none_b"><i><strong>Sub Total</strong></i></td>
        <td class="br_none_b"></td>
        <td class="br_none_b" align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($cost_total_amount1, 2, '.', '');?></strong></td>
    </tr>
    <tr>
       <?php
  
$number = $sal_tax_amount;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';

          if($result!='' && $point!='')
          {
             $amount_word =  $result . "Rupees  " . $points . " Paise";
          }
          elseif($result!='' && $point=='')
          {
             $amount_word =  $result . "Rupees  ";
          }
          else
          {
            $amount_word='';
          }

 ?> 
        <td class=""></td>
        <td class="br_none_b" colspan="2"><?php echo $amount_word;?></td>
        <td class="br_none_b"><i><strong>Vat Amount</strong></i></td>
        <td class="br_none_b"></td>
        <td class="br_none_b" align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($sal_tax_amount, 2, '.', '');?></strong></td>
    </tr>
    <tr>
       <?php
  
$number = $grand_total;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';

          if($point!='')
          {
             $grand_amount_word =  $result . "Rupees  " . $points . " Paise";
          }
          else
          {
             $grand_amount_word =  $result . "Rupees  ";
          }

 ?> 
        <td class=""></td>
        <td class="br_none_b" colspan="2"><?php echo $grand_amount_word;?></td>
        <td class="br_none_b"><i><strong>Grand Total</strong></i></td>
      
        <td class="br_none_b"></td>
        <td class="br_none_b" align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($grand_total, 2, '.', '');?></strong></td>
    </tr>
    <tr>
        <td colspan="3">
        <strong>Terms and Conditions</strong>
        <br />
        <?php echo $this->pref->inv_terms;?>
          <?php  if(!empty($sal_customer_notes))
          { ?>
          <hr>
           <strong>Customer Notes</strong>
           <br /><?php echo $sal_customer_notes   ;?>
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
