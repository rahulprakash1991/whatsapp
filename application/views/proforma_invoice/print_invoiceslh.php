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
    $c_vat = $row->c_cst;
    $vat_no          = explode(' ',$c_vat);
    $elements2 = array();
        foreach($vat_no as $data) {
  
        $elements2[] = $data ;
        }
    $name          = explode(' ',$c_org_name);
    $elements3 = array();
        foreach($name as $data3) {
  
        $elements3[] = $data3 ;
        }
	}
	$vat =  implode('-', $elements2);
  $com_name =  implode('-', $elements3);

	foreach($company_detail->result() as $row)
	{
		$con_primary                = $row->con_primary; 
		$con_company_name           = $row->client_name; 
		$con_address                = $row->client_address; 
		$con_email                  = $row->client_email;    
		$con_phone                  = $row->client_mobile;
		$contact_website            = $row->contact_website;
		$contact_area               = $row->contact_area;
		$contact_city               = $row->contact_city;
		$contact_state              = $row->contact_state;
		$contact_address            = $row->address;
        $contact_vat                = $row->vendor_no;
        $client_arabic_name         = $row->client_arabic_name;
        $contact_area_arabic        = $row->contact_area1;
        $contact_city_arabic        = $row->contact_city1;
        $contact_state_arabic       = $row->contact_state1;
        $contact_address_arabic     = $row->address1; 
        $contact_country            = $row->client_country;
        $contact_country_arabic     = $row->client_country1;
        $client_area                = $row->client_area;
        $client_area_arabic         = $row->client_area1;
        $client_city                = $row->client_city;
        $client_city_arabic         = $row->client_city1;
        $client_state               = $row->client_state;
        $client_state_arabic        = $row->client_state1;
        $client_zip                 = $row->client_zip;
        $client_zip_arabic          = $row->client_zip1;
        $client_country             = $row->client_country;
        $client_country_arabic      = $row->client_country1;
        $con_company_name1          = explode(' ',$con_company_name);
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
		$grand_total                = $sal_grand_total+$sal_delivery_amount;    
		$sal_created_on             = $row->sal_created_on;
		$sal_created_by             = $row->sal_created_by;
    $po_no                     = $row->po_num;
    $payment_term             = $row->payment_term;
    $sal_order1                  = explode('/',$row->sal_order);
 $Qrdate = date('d-m-Y', strtotime($sal_order_date));
 $d=strtotime($sal_created_on);
  $Qr_time = date("h:i:sa", $d);
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
    $payment_ter=$this->pre->getpayment_term($payment_term );
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
   .no-border-bottom_right{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px #000!important;
  border-bottom:solid 1px #FFF!important;
  
}
 .no-border-bottom_right_left{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px #000!important;
  border-bottom:solid 1px #FFF!important;
  
}
 .no-border-bottom_left{
  border-right: solid 1px #000!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px #000!important;
  border-bottom:solid 1px #FFF!important;
  
}
.no-border-right_top{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px #FFF!important;
  border-bottom:solid 1px #000!important;
  
}
.only_bottom{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px#FFF!important;
  border-top:solid 1px #FFF!important;
  border-bottom:solid 1px #000!important;
  
}
.only_bottom_right{
  border-right: solid 1px #000!important;
  border-left: solid 1px#FFF!important;
  border-top:solid 1px #FFF!important;
  border-bottom:solid 1px #000!important;
  
}
.only__right_left{
  border-right: solid 1px #000!important;
  border-left: solid 1px#000!important;
  border-top:solid 1px #FFF!important;
  border-bottom:solid 1px #FFF!important;
  
}
.only__right_left_bottom{
  border-right: solid 1px #000!important;
  border-left: solid 1px#000!important;
  border-top:solid 1px #FFF!important;
  border-bottom:solid 1px #000!important;
  
}
</style>

<table width="100%">
  <tr style="height:100px;">
  </tr>
</table>
<br>   
<table width="100%" border="1" rules="all"  style="border-color: black">
  <tr>
  <td style="width: 28%">Date - <strong></strong><?php echo date('d/m/Y', strtotime($sal_order_date));?></strong><br>تاريخ </td>
  <td style="width: 32%;text-align: center;"><u>Invoice </u><br>فاتورة ضريبية  </td>
  <td style="width: 32%">Inv-no. <?php echo $sal_order;?><br>رقم الفاتورة  </td>
  </tr>
    <tr>
  <td>PO No- <?php echo  $po_no ;?> </td>
  <td rowspan="2" style="vertical-align: top; font-size:14px;" ><?php echo $con_company_name;?> <br><?php echo $client_zip; echo " "; echo $contact_address; echo " "; echo $contact_area; echo" "; echo $contact_city;echo " ";echo  $contact_state ;echo ", ";echo  $contact_country ;echo" ";echo  $contact_zip ;  ?></td>
  <td rowspan="2" style="vertical-align: top; font-size:14px; text-align:right;"><?php echo $client_arabic_name;?> <br><?php echo $client_zip; echo " "; echo $contact_address_arabic; echo " "; echo $contact_area_arabic; echo" "; echo $contact_city_arabic;echo " ";echo  $contact_state_arabic ;echo " ";echo  $contact_country_arabic ;echo" ";echo  $contact_zip_arabic ;  ?></td>
  </tr>
   <tr>
  <!--<td>VAT No-  الرقمالضريبي للعميل    <br>3102 ٠٣ </td>-->
  <td> VAT No-   مالضريبي للعميل  <br><?php echo $contact_vat ;?>    </td>
  
  </tr>
  </table>     
<table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all" style="border-color: black">
   <tr>
    <td style="width: 5%;font-size: 12px;text-align: center;"><b>S/N <br>  س/ن  </b></td>
    <td  style="width: 50%;font-size: 12px;text-align: center;"><b>DESCRIPTION <br>البيان   </td>
    <td style="width: 10%;font-size: 12px;text-align: center;"><b>Qty   <br> العدد  </b></td>
    <td style="width: 10%;font-size: 12px;text-align: center;"><b>  Unit Price <br> سسعر الوحدة   </b></td>
    <td style="width: 10%;font-size: 12px;text-align: center;"><b>Total Amount <br> المبلغ الإجمالي<b></td>
   </tr>
   </table>
   <table width="100%" border="1" rules="all" style="border-color: black">
	<?php
    $i= 1;
    foreach($spvalue as $key =>$row)
    {   
      $totalproduct=count($rows->sal_item_id);
      $pro_item_name = $row->item_description;
      $discriptionArabic = $row->item_description_arabic;
      $unit = $row->uniteng;
      $qty = $row->qty;
      $unit_price = $row->unit_price;
      $sl_no1 = $row->sl_no;
      $total = $row->total_cost;
      $cost_total_amount1   +=   $row->total_cost;
      if($sl_no1==0)
      {
        $sl_no ='';
      }
      else
      {
        $sl_no=$sl_no1;
      }
    ?>
    <tr style="height:1px;">
        <td style="font-size: 11px;width: 5%;text-align: center;" class="only__right_left"><?php echo  $sl_no ;?></td>
        <td style="font-size: 11px;width: 50%;" class="only__right_left"><?php echo $pro_item_name;?> <?php echo ""; echo  $discriptionArabic ;?></td>
        <td align="center" style="font-size: 11px;width: 10%;text-align: center;" class="only__right_left"><?php echo $qty;?></td>
        <td align="right" style="font-size: 11px;width: 10%;text-align: right; padding-right:10px;" class="only__right_left"><?php echo number_format($unit_price, 2, '.', '') ;?></td>
        <td align="right" style="font-size: 13px;width: 10%;text-align: right; padding-right:10px;" class="only__right_left"><?php echo $total;?></td>
    </tr>
    <?php
    }
    
    ?>
    <?php 

    for($j=0;$j<=5;$j++){?>
      <tr style="height:20px;">
        <td style="font-size: 11px;text-align: center;" class="only__right_left"></td>
        <td style="font-size: 11px;" class="only__right_left"></td>
        <td align="center" style="font-size: 11px;text-align: center;" class="only__right_left"></td>
        <td align="right" style="font-size: 11px;text-align: center;" class="only__right_left"></td>
        <td align="right" style="font-size: 13px;text-align: center;" class="only__right_left"></td>
    </tr>
  <?php }?>
     <tr style="height:20px;">
        <td style="font-size: 11px;text-align: center;" class="only__right_left_bottom"></td>
        <td style="font-size: 11px;" class="only__right_left_bottom"></td>
        <td align="center" style="font-size: 11px;text-align: center;" class="only__right_left_bottom"></td>
        <td align="right" style="font-size: 11px;text-align: center;" class="only__right_left_bottom"></td>
        <td align="right" style="font-size: 13px;text-align: center;" class="only__right_left_bottom"></td>
    </tr>
  

<tr>
  <td rowspan="4" colspan="2" style="vertical-align: top;font-size: 11px;">
      Note - In case of paying cash or by cheque the customer must be obtain a cash receipt<br> 
  <br>
  <table width:"100%" style="font-size: 11px;">
      <tr>
        <td><strong>Account Details :- Silver hand reparing machine & Machinery EST</strong> </td>

        <td style="text-align:right; padding-right:5px;">الحساب موسسة اليد الفضىية لإصلاح الالات والمكائن </td>
      </tr>
      <tr>
          <td>Account No :02400000333908 </td>
          <td style="text-align:right; padding-right:5px;"> الحساب لا :- ٠٢٤٠٠٠٠٠٣٣٣٩٠٨ </td>
      </tr>
      <tr>
          <td>Ibn No:SA490000002400000333908</td>
          <td style="text-align:right;padding-right:5px;">:إيبان SA٤٩١٠٠٠٠٠٠٢٤٠٠٠٠٠٣٣٣٩٠٨</td>
      </tr>
  </table>
  Bank name : SNB</td>
  <td colspan="2" style="font-size: 11px;"><b>Total <br>مجموع قبل الضريبة </b></td>
  <td style="font-size: 11px;text-align: right; padding-right:10px;"> <b><?php echo number_format($cost_total_amount1, 2, '.', '');?></b></td>
</tr>
<tr>
  <td colspan="2" style="font-size: 11px;"><b>Discount <br> الخصم <b></td>
  <td style="font-size: 11px;text-align: right; padding-right:10px;"><b> <?php echo number_format($sal_discount, 2, '.', '');?></b></td>
</tr>
<tr>
  <td colspan="2" style="font-size: 11px;"><b>After Discount  <br> المجموع بعدالخصم  <b></td>
  <td style="font-size: 11px;text-align: right; padding-right:10px;"><b> <?php echo number_format(($cost_total_amount1-$sal_discount), 2, '.', '');?></b></td>
</tr>
<tr>
  <td colspan="2" style="font-size: 11px;"><b>VAT 15% <br>ضريبةالقيمةالمضافة<b></td>
  <td style="font-size: 11px;text-align: right; padding-right:10px;"><b> <?php echo number_format($sal_tax_amount, 2, '.', '');?></b></td>
</tr>
<!-- <tr>
  <td colspan="1" style="font-size: 11px;"><b> <br>Total Amount With VAT</b></td>
  <td style="font-size: 11px;"><b> <?php echo number_format($sal_grand_total, 2, '.', '');?></b></td>
</tr> -->
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
             $grand_amount_word =  $result . "Saudi Riyal  " . $points . " Halala";
          }
          else
          {
             $grand_amount_word =  $result . "Saudi Riyal  ";
          }

 ?> 
  <td colspan="2" style="font-size: 11px;"><b> TOTAL SR -     <?php echo $grand_amount_word;?></b> </td>
  <td colspan="2" style="font-size: 11px;"><b>Total Amount <br> المبلغ الإجمالي</b>  </td>
  <td style="font-size: 13px;text-align: right; padding-right:10px;"><b><?php echo number_format($sal_grand_total, 2, '.', '');?></b></td>
  </tr>
 </table>
 <table width="100%">
   <tr>
     <td style="width: 35%">Prepared By Mr. Murad Khan<br><br>
     Signature :- ..................................</td>
     <td style="width: 30%;">
       <img src="<?php echo base_url('Sales_order/QRcode/'.$dd.'/'.$com_name.'/'. $Qrdate.'/'.$Qr_time.'/'.$sal_grand_total.'/'.$sal_tax_amount .'/'.$vat  ); ?>" alt="" style="padding-left: 10px;width: 100px;height: 100px;"> 
     </td>
     <td style="width: 35%;">Received by<br><br>
     Signature :- ...................................... </td>

   </tr>
 </table>
 
 

</div>
