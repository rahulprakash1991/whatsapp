<script type="text/javascript">
//<![CDATA[

function printPage() 
{
// setTimeout(3000);
  var printContents = document.getElementById('printContent').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    setTimeout(function(){ window.print(); }, 800);
    
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
    <style type="text/css" media="print">
        @page
        {
            size: auto; /* auto is the initial value */
       /*     margin: 2mm 4mm 0mm 0mm;*/
             /* this affects the margin in the printer settings */
        }
        thead
        {
            display: table-header-group;
        }
        tfoot
        {
            display: table-footer-group;
        }
    </style>
    <style type="text/css" media="screen">
        thead
        {
            display: block;
        }
        tfoot
        {
            display: block;
        }
      </style>
<?php 
  
  
  foreach($value->result() as $row)
  {
    // $sal_customer_address       = $row->sal_customer_address;
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
    // $currency             = $row->sal_curency;
    $amount_with_out_tax = $sal_grand_total - $sal_tax_amount;

}
foreach($company_detail->result() as $row)
  {
    $con_primary            = $row->con_primary; 
    $client_company_name       = $row->client_name; 
    $client_arabic_name     = $row->client_arabic_name;
    $client_vat             = $row->vendor_no;
    $client_crno            = $row->cr_no;
    $client_address         = $row->address; 
    $client_address_arabic  = $row->address1; 
    $client_email           = $row->client_email;    
    $client_phone           = $row->client_mobile;
    $client_area            = $row->client_area;
    $client_area_arabic     = $row->client_area1;
    $client_city            = $row->client_city;
    $client_city_arabic     = $row->client_city1;
    $client_state           = $row->client_state;
    $client_state_arabic    = $row->client_state1;
    $client_zip             = $row->client_zip;
    $client_zip_arabic      = $row->client_zip1;
    $client_country         = $row->client_country;
    $client_country_arabic  = $row->client_country1;
  
    $contact_area           = $row->contact_area;
    $contact_area_arabic    = $row->contact_area1;
    $contact_city           = $row->contact_city;
    $contact_city_arabic    = $row->contact_city1;
    $contact_state          = $row->contact_state;        
    $contact_state_arabic   = $row->contact_state1;
    $contact_website        = $row->contact_website;
    $land_line_no = $row->land_line_no;
    $con_company_name1          = explode(' ',$con_company_name);
    $street = $row->client_street;
    $district = $row->client_district;
    $province =$row->client_province;
    $street_arabic = $row->street_arabic;
    $district_arabic = $row->client_district_arabic;
    $province_arabic = $row->client_province_arabic;
    $landline_no_arabic = $row->landline_no_arabic;
    $contact_no_arabic = $row->contact_no_arabic;
    $email_arabic = $row->email_arabic;
    $client_vat_arabic = $row->client_vat_arabic;
  }
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
    $c_mobile       = $row->c_mobile;
    $c_fax          = $row->c_fax;
    $c_website      = $row->c_website;    
    $c_email        = $row->c_email;
    $cur_name       = $row->cur_name;
    $cur_symbol     = $row->cur_symbol;
    $c_vat          = $row->c_cst;
    $company_abbrivation =$row->c_org_abb;
    $vat_no         = explode(' ',$c_vat);
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
foreach($credict_data->result() as $row)
  {
    $credit_no                = $row->credit_number; 
    $credit_date           = $row->credictnote_createdOn; 
    $credit_sub_total = $row->credict_sub_total;
    $credit_total = $row->credict_total;
    $credit_vat_amount =$row->credit_vat_amount;
    $sal_order1                  = explode('/',$row->credit_number);
    $Qrdate = date('Y-m-d', strtotime($credit_date));
    $d=strtotime($credit_date);
    $Qr_time = date("H:i", $d);
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

 
<div id="printContent">
        <table style="width: 100%; " >
            <thead>

    <tr style="height:150px;">
       <td colspan="10"></td>
    </tr>
  </thead>
<tbody>
  <tr>
  <td   colspan="5" style="width: 54%;text-align: left;width:55%;font-size: 18px;">
    <?php $cr_date =date('d F Y', strtotime($credit_date)); ?>
<b>CREDIT NOTE /  ملاحظات الائتمان  </b> 

<!-- <span style="font-size: 13px;"><b>Credit No  / االائتمان لا   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;<?php echo $credit_no;?></b></span><br>
<span style="font-size: 13px;"><b>Credit Date / موعد الائتمان  &nbsp;&nbsp;:&nbsp;<?php echo $cr_date;?></b></span> -->
</td> 
<td  colspan="3"style="width: 25%;text-align: right;font-size: 13px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Invoice No&nbsp; /&nbsp;رقم الفاتورة   </b></td>
<td style="width: 1%;text-align: center;font-size: 13px;" ><b>:</b></td> 
  <td colspan="2"  style="width: 20%;text-align: right;font-size: 13px;"><b><?php echo $sal_order;?></td>
</tr>
<tr>
<td colspan="3" style="font-size: 13px;width: 33%;"><b>Credit Note No  / االائتمان لا  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> </td>
<!-- <td style="width: 1%;text-align: left;font-size: 13px;"><b>:</b></td> -->
<td colspan="2" style="width: 20%;text-align: left;font-size: 12px;"><b><?php echo $credit_no;?></b></td>
<td colspan="3" style="width: 25%;text-align: right;font-size: 13px;"><b>Invoice Date / اريخ الفاتورة    </b></td>
<td style="width: 1%;text-align: center;font-size: 13px;" ><b>:</b></td>
<td colspan="2"  style="width: 20%;text-align: right;font-size: 12px;"><b><?php echo date('d F Y', strtotime($sal_created_on));?></td>
</tr>
<tr>
  <td colspan="3" style="font-size: 13px;width: 33%;"><b>Credit Note Date / موعد الائتمان   &nbsp;&nbsp;&nbsp;&nbsp;: </b></td>
<!--   <td style="width: 1%;text-align: left;font-size: 13px;"><b>:</b></td> -->
  <td colspan="2" style="width: 20%;text-align: left;font-size: 12px;"><b><?php echo $cr_date;?></b></td>
  <td colspan="3" style="width: 25%;text-align: right;font-size: 13px;"><b>VAT No / رقم ضريبة القيمة المضافة   </b></td>
  <td style="width: 1%;text-align: center;font-size: 13px;" ><b>:</b></td> 
  <td colspan="2"   style="width: 20%;text-align: right;font-size: 13px;"><b><?php echo $c_vat;?></td>
  </tr>
   <tr>
        <td colspan="10" style="width: 100%">
        <hr style="border-color: black">
      </td>
      </tr> 
  <tr>
    <td colspan="10" style="width: 100%;text-align: left;font-size: 13px;"><b> Bill To / <span style="float: right;"> :فاتورة الى   </span>     </td>
    
  </tr>
    <tr>
    <td colspan="10" style="width: 100%;text-align: left;font-size: 13px;vertical-align: top;"> <b><?php echo $client_company_name; ?> <span style="float: right"><?php echo $client_arabic_name; ?></span></b> </td>
   
  </tr>
    <?php if($client_address!='' || $client_address_arabic!=''){?>
    <tr>
     <td  colspan="10"style="width: 100%;text-align: left;font-size: 13px;vertical-align: top;"> <?php if($client_address!=''){ echo $client_address; }?><span style="float: right"><?php if($client_address_arabic!=''){echo $client_address_arabic;}?></span></td>
    
  </tr>
<?php  } if($street!='' || $street_arabic  !=''){?>
  <tr>
     <td  colspan="10"style="width: 100%;text-align: left;font-size: 13px;vertical-align: top;"> <?php if($street !=''){echo $street; }?><span style="float: right"><?php if($street_arabic  !=''){echo $street_arabic ; } ?></span></td>
    
  </tr>
<?php }?>
<?php if($client_city!='' || $client_city_arabic  !=''){?>
   <tr>
     <td  colspan="10"style="width: 100%;text-align: left;font-size: 13px;vertical-align: top;"> <?php if($client_city  !=''){echo $client_city ; }if($district  !=''){echo ",";echo " "; echo $district ; }?><span style="float: right"><?php if($client_city_arabic  !=''){echo $client_city_arabic ; } if($district_arabic  !=''){echo ","; echo " ";echo $district_arabic ; }?></span></td>
    
  </tr>
<?php } if($client_country!='' || $client_country_arabic  !=''){?>
   <tr>
     <td  colspan="10"style="width: 100%;text-align: left;font-size: 13px;vertical-align: top;"> <?php if($client_country  !=''){echo $client_country ; }?><span style="float: right"><?php if($client_country_arabic  !=''){echo $client_country_arabic ; } ?></span></td>
    
  </tr>
<?php } if($land_line_no!='' || $landline_no_arabic  !=''){?>
    <tr>
     <td  colspan="10"style="width: 100%;text-align: left;font-size: 13px;vertical-align: top;"> <?php if($land_line_no  !=''){echo $land_line_no ; }if($client_phone  !=''){echo","; echo " "; echo$client_phone ; }if($client_email     !=''){echo ","; echo " "; echo $client_email    ; }?><span style="float: right"><?php if($landline_no_arabic  !=''){echo $landline_no_arabic ; }if($contact_no_arabic  !=''){echo","; echo" "; echo $contact_no_arabic ; }if($email_arabic  !=''){echo ","; echo " "; echo $email_arabic ; } ?></span></td>
    
  </tr>
<?php }?>
    <?php if($client_vat!='' || $client_vat_arabic!=''){?>
   <tr>

    <td colspan="10" style="width: 100%;text-align: left;font-size: 13px;"><?php if($client_vat!='' ){?>Vat No : <?php echo $client_vat;?> &emsp;

    <?php } if($client_vat_arabic!=''){
$vatno_eng =  $client_vat_arabic;
$vatno_arabic = strtr($vatno_eng, ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩']);?><span style="float: right;">رقم ضريبة القيمة المضافة  : <?php echo $vatno_arabic;?>  </span>
<?php }?>
     </td>
     
  </tr>
<?php }?>
  <tr height="10px;">
  </tr>
  <!-- <tr>
   <td colspan="5" style="width: 50%;font-size: 13px;"><b>Shipper&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp; <?php echo $shipper_name;?></b> 
     </td>
     <td colspan="5" style="width: 50%;font-size: 13px;">
      <b>Consignee :</b> &nbsp; <?php echo $consignee;?>
     </td>
   </tr>
   <tr>
   <td colspan="10" style="width: 50%;text-align: left;font-size: 13px;"><b>Vendor ID :</b> &nbsp; <?php echo $vendor_id;?>
     </td>
   </tr> -->

  <tr>
  <td   style="width: 1%;text-align: center;font-size: 13px;background-color: #F0F0F0;"><b>#</b></td>
  <td colspan="3"  style="width: 40%;font-size: 13px;background-color: #F0F0F0;"><b> Description     </td>
  <td  colspan="3" style="width: 30%;font-size: 13px;background-color: #F0F0F0;text-align: right;"><b>   الوصف    </td>
  <td  style="width: 10%;font-size: 13px;text-align: center;background-color: #F0F0F0;"><b>   الكمية   Quantity   </td>
 <!--  <td  style="width: 14%;text-align: center;font-size: 13px;background-color: #F0F0F0;"><b>  رقم بيان الشحنه    <br> WB .No </td> -->
  <td  style="width: 12%;text-align: right;font-size: 13px;background-color: #F0F0F0;"><b>  سعر الوحده  <br> Unit Price</td>
  <td  style="width: 8%;text-align: right;font-size: 13px;background-color: #F0F0F0;"><b>  الكمية  <br>  Amount  </td>
  <tr>
   <?php
    $i= 1;
      $cout_data =count($evalue);
    foreach($evalue as $key =>$row)
    {   
      $totalproduct=count($rows->sal_item_id);
      $pro_item_name    = $row->item_description;
      $discriptionArabic    = $row->item_description_arabic;
      $unitArabic    = $row->unitarabic;
      $wb_numbrer     = $row->wb_no;
      $qty         = $row->qty;
      $unit_price           = $row->unit_price;
  
      $total            = $row->total;
      $cost_total_amount1   +=   $row->total;
    ?>
    <?php if($pro_item_name!=""  )
    {?>
   
    <tr style="height:2px;">
        <td   style="font-size: 12px;text-align: center;vertical-align: top;"><?php echo $i++;?></td>
         <td colspan="3"  style="font-size: 12px;vertical-align: top;"><?php echo nl2br($pro_item_name);?><?php echo "  ";?></td>
         <td colspan="3" style="font-size: 12px;vertical-align: top;text-align: right;"><?php  echo nl2br($discriptionArabic); ?></td>
        <td align="center" style="font-size: 12px;text-align: center;vertical-align: top;"><?php echo $qty;?></td>
       <!--  <td align="center" style="font-size: 12px;text-align: center;vertical-align: top;"><?php echo $wb_numbrer;?></td> -->
        <td align="right" style="font-size: 12px;text-align: right;vertical-align: top;"><?php echo number_format($unit_price, 2, '.', '');?></td>
       
        <td align="right" style="font-size: 12px;text-align: right;vertical-align: top;"><?php echo $total;?></td>
    </tr>
  <?php } else {?>
 <?php for ($j=0; $j <1 ; $j++) { ?>
      <tr style="height:10px;">
        <td style="font-size: 10px;text-align: center;"></td>
        <td style="font-size: 10px;"></td>
         <td style="font-size: 10px;"></td>
        <td align="center" style="font-size: 10px;text-align: center;"></td>
          <td align="center" style="font-size: 10px;text-align: center;"></td>

        <td align="right" style="font-size: 10px;text-align: center;"></td>
       
        <td align="right" style="font-size: 11px;text-align: center;"></td>
    </tr>
      
   <?php  }?>

  <?php }?>
    <?php
    }
    
    ?>
    <?php for ($j=0; $j <1 ; $j++) { ?>
      <tr style="height:30px;">
        <td style="font-size: 10px;text-align: center;"></td>
        <td style="font-size: 10px;"></td>
         <td style="font-size: 10px;"></td>
        <td align="center" style="font-size: 10px;text-align: center;"></td>
          <td align="center" style="font-size: 10px;text-align: center;"></td>

        <td align="right" style="font-size: 10px;text-align: center;"></td>
       
        <td align="right" style="font-size: 11px;text-align: center;"></td>
    </tr>
      
   <?php  }?>
   <tr>
        <td colspan="10" style="width: 100%">
        <hr style="border-color: black">
      </td>
      </tr>
    <tr>

    <tr>
    <td class="only_top" colspan="9" style="text-align: left;width: 80%;font-size: 12px;" ><b> Amount Without Tax&nbsp;(SAR) / &nbsp;لاجمالي بدون ضريبة القيمة المضافة  </td>

  <td  class="only_top" style="font-size: 12px;width: 20%;text-align: right;" ><b><?php echo number_format($credit_sub_total , 2, '.', '');?></td>
 
</tr>
    <tr>
    <!--<td  colspan="6" style="text-align: left;width: 80%;font-size: 12px;" ><b>VAT Amount 15% &nbsp;(SAR) / مضريبة القيمة المضافة </td>-->

  <td  colspan="9" style="text-align: left;width: 80%;font-size: 12px;" ><b>VAT Amount 15% &nbsp;(SAR)   %15 قيمة الضريبة المضاقة   </td>
  <td    style="font-size: 12px;width: 20%;text-align: right;" ><b><?php echo number_format($credit_vat_amount , 2, '.', '');?></td>
 
</tr>
 <tr>
    <td  class="only_bottom" colspan="9" style="text-align: left;width: 80%;font-size: 12px;" ><b>Total Amount&nbsp;(SAR) / &nbsp;ضريبة القيمة المضافة    </td>

  <td  class="only_bottom"  style="font-size: 12px;width: 20%;text-align: right;" ><b><?php echo number_format($credit_total  , 2, '.', '');?></b></td>
 
</tr>
 <tr>
        <td colspan="10" style="width: 100%">
        <hr style="border-color: black">
      </td>
      </tr>

<tr>
  <?php
  
$number = $sal_grand_total;
   $no = round($number);
    $decimal = round($number - ($no = floor($number)), 2) * 100;    
    $digits_length = strlen($no);    
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
        } else {
            $str [] = null;
        }  
    }
    
    $Rupees = implode(' ', array_reverse($str));
    $paise = ($decimal) ? " And " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10]). " Halala"  : '';
     $grand_amount_word  = ($Rupees ?  $Rupees : '').'Saudi Riyals' .($paise ?  $paise : '') ;
        

 ?> 
    <td  class="only_bottom" colspan="10" style="text-align: left;width: 80%;font-size: 12px;" ><b>Total Amount in Words&nbsp;(SAR):&emsp;&emsp; <?php echo $grand_amount_word;?></td>

 
 
</tr>
 <tr>
        <td colspan="10" style="width: 100%">
        <hr style="border-color: black">
      </td>
      </tr>
 

   
    <tr height="20px;">
      <td colspan="10"></td>
    </tr>
   
  <tr height="50px;">
      <td colspan="10"></td>
    </tr>
 <!--  <tr>
    <td colspan="4" style="width:40%;color: red;font-size: 13px;"><b>FOR NMCE LOGISTICS<br>AUTHORIZED SIGNATURE</td>
    <td colspan="2" style="width:20%;">
        <img src="<?php echo base_url('Sales_order/QRcode/'.$dd.'/'.$com_name.'/'. $Qrdate.'/'.$Qr_time.'/'.$grand_total.'/'.$sal_tax_amount .'/'.$vat  ); ?>" alt="" 
        style="width:100px; height:100px;">
    </td>
    <td colspan="4" style="width: 40%;font-size: 13px;" ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RECEIVED DATE<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AUTHORIZED SIGNATURE</b></td>
  </tr> -->
    <tr>
    <td colspan="4" style="width:40%;color: red;font-size: 13px;"><b>FOR NMCE LOGISTICS<br>AUTHORIZED SIGNATURE</td>
    <td colspan="3" style="width:20%;text-align: center;">
        <img src="<?php echo base_url('Sales_order/QRcode/'.$dd.'/'.$com_name.'/'. $Qrdate.'/'.$Qr_time.'/'.$credit_total.'/'.$credit_vat_amount .'/'.$vat  ); ?>" alt="" 
        style="width:100px; height:100px;" align="center">
    </td>
    <td colspan="3" style="width: 40%;font-size: 13px;" ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RECEIVED DATE<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AUTHORIZED SIGNATURE</b></td>
  </tr>
  </tbody>
  <tfoot >
    <tr height="60px">
        <td colspan="10">      
        </td>
    </tr>
  </tfoot>
  </table>

</div>

