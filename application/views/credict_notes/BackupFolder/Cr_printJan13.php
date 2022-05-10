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
           /* margin: 2mm 4mm 0mm 0mm; */
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
    $con_company_name1          = explode(' ',$con_company_name);
    $elements1 = array();
foreach($con_company_name1 as $data) 
{
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
    $sal_tax_id                = explode(',',$row->per_sal_tax_id);
    $sal_delivery_amount        = $row->per_sal_delivery_amount;
    $grand_total                = $sal_grand_total-$sal_discount+$sal_delivery_amount;    
    $sal_created_on             = $row->sal_created_on;
    $sal_created_by             = $row->sal_created_by;
    $po_no                     = $row->po_num;
    $payment_term             = $row->payment_term;
    $remarks = $row->remarks;
    $our_ref =$row->our_ref; 
    $attain = $row->per_sal_client_rep;
    $sal_order1                  = explode('/',$row->per_sal_order);
    $Qrdate = date('Y-m-d', strtotime($sal_created_on));
    $d=strtotime($sal_created_on);
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
  // $getCurrency=$this->pre->getCurrencynew();
  $payment_ter=$this->pre->getpayment_term($payment_term );
  foreach($bank_detail->result() as $row)
  {
    $account_no            = $row->account_no; 
    $bank_name             = $row->bank_name; 
    $iban_no              = $row->ifs_code;
    $swift_code             = $row->micr_no;
    $bname  = $row->account_name;
     
  }
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
 .no-border-bottom_right1{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px #FFF!important;
  border-bottom:solid 1px #FFF!important;
  
}
 .no-border-bottom_right_left{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px #000!important;
  border-bottom:solid 1px #FFF!important;
  
}
.no-border-bottom_right_left1{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px #FFF!important;
  border-bottom:solid 1px #FFF!important;
  
}
 .no-border-bottom_left{
  border-right: solid 1px #000!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px #000!important;
  border-bottom:solid 1px #FFF!important;
  
}
.no-border-bottom_left1{
  border-right: solid 1px #000!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px #FFF!important;
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
   .no-border_right{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px #000!important;
  border-bottom:solid 1px #000!important;
  
}
.no-border_right_left{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px #000!important;
  border-bottom:solid 1px #000!important;
  
}
.no-border{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #FFF!important;
  border-top:solid 1px#FFF!important;
  border-bottom:solid 1px #FFF!important;
  
}
.all_border{
  border-right: solid 1px #000!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px#000!important;
  border-bottom:solid 1px #000!important;
  
}
.all_border_right{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px#000!important;
  border-bottom:solid 1px #000!important;
  
}
.all_border_right_andtop{
  border-right: solid 1px #FFF!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px#FFF!important;
  border-bottom:solid 1px #000!important;
  
}
.all_border_right_t{
  border-right: solid 1px #000!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px#FFF!important;
  border-bottom:solid 1px #000!important;
  
}
.all_border_right_b{
  border-right: solid 1px #000!important;
  border-left: solid 1px #000!important;
  border-top:solid 1px#000!important;
  border-bottom:solid 1px #000!important;
  
}
</style>
<div id="printContent">
<table style="width: 100%;border-color:#000;table-layout: fixed; " rules="all" border="1"  >
            <thead>
    <tr style="height:130px;">
    <td class="no-border" colspan="100"></td>
    </tr>
  </thead>
<tbody>
  <tr>
    <td class="no-border"  colspan="100" style="font-size: 22px;text-align: center;width: 100%;"><b><u> CREDIT NOTE /  ملاحظات الائتمان   </u>  </td>
  </tr>
   <tr style="height:20px;">
    <td class="no-border"  colspan="100" style="width: 100%;"></td>
    </tr>
    <tr>
    <td class="no-border"  colspan="50" style="font-size: 14px;text-align: left;width: 50%;"  ><strong>CREDIT No  : <?php echo $credit_no;?></strong></td>
    <td class="no-border"  colspan="50" style="font-size: 14px;text-align: right;width: 50%;"><strong>INVOICE No : <?php echo $sal_order;?></strong></td>
  </tr>
   <tr>
    <td class="no-border"  colspan="50" style="font-size: 14px;text-align: left;width: 50%;"  ><strong>CREDIT DATE  : <?php echo date('d/m/Y', strtotime($credit_date));?></strong></td>
    <td class="no-border"  colspan="50" style="font-size: 14px;text-align: right;width: 50%;"><strong>INVOICE DATE : <?php echo date('d/m/Y', strtotime($sal_order_date));?></strong></td>
  </tr>
   <tr style="height:10px;">
    <td class="only_bottom"  colspan="100" style="width: 100%;"></td>
    </tr>
    <tr>
    <td colspan="10" style="font-size: 12px;width: 10%;vertical-align: top;" class="no-border-bottom_right">To</td>
    <td  colspan="6" style="font-size: 12px;width: 6%;vertical-align: top;" class="no-border-bottom_right_left">:</td>
    <td  colspan="35" style="font-size: 12px;width: 35%;vertical-align: top;" class="no-border-bottom_right_left"><b><?php echo $client_company_name;?></b></td>
    <td colspan="38" style="font-size: 12px; text-align:right;width: 38%;vertical-align: top;" class="no-border-bottom_right_left"><b><?php echo $client_arabic_name;?></b></b></td>
    <td colspan="1"  style="font-size: 12px;text-align: center;width: 1%;vertical-align: top;" class="no-border-bottom_right_left">:</td>
    <td colspan="10"  style="font-size: 12px;width: 10%;vertical-align: top;text-align: right;" class="no-border-bottom_left">إلى  </td>
    
  </tr>
  <tr>
    <td colspan="10" style="font-size: 12px;width: 10%;vertical-align: top;" class="no-border-bottom_right1">Address</td>
    <td colspan="6" style="font-size: 12px;width: 6%;vertical-align: top;" class="no-border-bottom_right_left1">:</td> 
    <td colspan="35" style="font-size: 12px;width: 35%;vertical-align: top;" class="no-border-bottom_right_left1"><?php echo $client_address; echo " "; echo $client_area; echo" "; echo $client_city;echo " ";echo  $client_state ;echo " ";echo  $client_country ;echo" ";echo  $client_zip ;  ?></td>
    <td colspan="38" style="font-size: 12px; text-align:right;width: 38%;vertical-align: top;" class="no-border-bottom_right_left1"><?php echo $client_address_arabic; echo " "; echo $client_area_arabic; echo" "; echo $client_city_arabic;echo " ";echo  $client_state_arabic ;echo " ";echo  $client_country_arabic ;echo" ";echo  $client_zip_arabic ;  ?> </td>
    <td colspan="1"  style="font-size: 12px;text-align: center;width: 1%;vertical-align: top;" class="no-border-bottom_right_left1" >:</td>
    <td colspan="10" style="font-size: 12px;width: 10%;vertical-align: top;text-align: right;" class="no-border-bottom_left1">العنوان  </td>
    
  </tr>
  <tr>
    <td colspan="10"   style="font-size: 12px;width: 10%;vertical-align: top;" class="no-border-bottom_right1">Tel</td>
    <td colspan="6"  style="font-size: 12px;width: 6%;vertical-align: top;" class="no-border-bottom_right_left1">:</td>
    <td colspan="35"   style="font-size: 12px;width: 35%;vertical-align: top;" class="no-border-bottom_right_left1"><?php echo $client_phone;?></td>
    <td colspan="38"  style="font-size: 12px; text-align:right;width: 38%;vertical-align: top;"class="no-border-bottom_right_left1"><?php echo $client_phone;?></td>
    <td colspan="1"  style="font-size: 12px;text-align: center;width: 1%;vertical-align: top;" class="no-border-bottom_right_left1">:</td>
    <td colspan="10"   style="font-size: 12px;width: 10%;vertical-align: top;text-align: right;" class="no-border-bottom_left1">هاتف   </td>
    
  </tr>
   <tr>
    <td colspan="10"  style="font-size: 12px;width: 10%;vertical-align: top;" class="no-border-right_top" >VAT No</td>
    <td colspan="6"  style="font-size: 12px;width: 6%;vertical-align: top;" class="only_bottom">:</td>
    <td colspan="35"   style="font-size: 12px;width: 35%;vertical-align: top;" class="only_bottom"><?php echo $client_vat;?></td>
    <td colspan="38"  style="font-size: 12px; text-align:right;width: 38%;vertical-align: top;" class="only_bottom"><?php echo $client_vat;?></td>
    <td colspan="1"  style="font-size: 12px;text-align: center;width: 1%;vertical-align: top;" class="only_bottom">:</td>
    <td colspan="10"  style="font-size: 12px;width: 10%;vertical-align: top;text-align: right;" class="only_bottom_right">الرقم الضريبي     </td>
  </tr>
   <tr style="height:15px;">
    <td class="only_bottom"  colspan="100" style="width: 100%;"></td>
    </tr>
     <tr>
    <td colspan="33" style="font-size: 12px;text-align: center;width: 33%;"><strong>P.O. No.</strong></td>
    <td colspan="33" style="font-size: 12px;text-align: center;width: 33%;"><strong>Payment Terms:</strong></td>
    <td colspan="34" style="font-size: 12px;text-align: center;width: 34%;"><strong>Our Ref:</strong></td>

  </tr>
  <tr>
    <td colspan="33"  style="font-size: 12px;text-align: center;width: 33%;"><?php echo  $po_no ;?></td>
    <td colspan="33" style="font-size: 12px;text-align: center;width: 33%;"><?php echo  $payment_ter;?></td>
    <td colspan="34"  style="font-size: 12px;text-align: center;width: 34%;"><?php echo  $our_ref;?></td>
  </tr>
  <tr style="height:15px;">
    <td class="only_bottom"  colspan="100" style="width: 100%;"></td>
    </tr>
     <tr>
    <td rowspan="2" colspan="4" style="font-size: 10px;text-align: center;width: 2%;"><b>SR. #</b></td>
    <td rowspan="2" colspan="43" style="font-size: 10px;text-align: center;width: 43%;"><b>DESCRIPTION  الوصف   </b> </td>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> الوحده  </b></td>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> الكمية. </b></td>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> سعر الوحده  </b></td>
    <td colspan="9" style="font-size: 10px;text-align: center;width: 9%;"><b> مجموع لا شيء ضريبة  </b></td>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> ضريبة  </b>   </td>
    <td colspan="6" style="font-size: 10px;text-align: center;width: 6%;"><b> سعر الوحده  </b></td>
    <td colspan="10"style="font-size: 10px;text-align: center;width: 10%;"><b>قيمة الضريبة      </b></td>
   </tr>
    <tr>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> Unit</b> </td>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> Qty. </b></td>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> Unit Price</b> </td>
    <td colspan="9" style="font-size: 10px;text-align: center;width: 9%;"><b>  Total Excl. VAT    </b></td>
    <td colspan="7" style="font-size: 10px;text-align: center;width: 7%;"><b> VAT.%</b>   </td>
    <td colspan="6" style="font-size: 10px;text-align: center;width: 6%;"><b> VAT Amount   </b></td>
    <td colspan="10"style="font-size: 10px;text-align: center;width: 10%;"><b>Total Amount </b></td>   
   </tr>
   <?php
    $i= 1;
    $net_amout = 0;
    foreach($evalue as $key =>$row)
    {   
      $totalproduct=count($rows->sal_item_id);
      $pro_item_name    = $row->item_description;
      $discriptionArabic    = $row->item_description_arabic;
      $unitArabic    = $row->unitarabic;
      $unit     = $row->unit;
      $qty         = $row->qty;
      $unit_price           = $row->unit_price;
      $total            = $row->total_cost;
      $cost_total_amount1   +=   $row->total_cost;
      $total_ex_vat = $qty  * $unit_price;
      $vat_amount = ($total_ex_vat)*(15/100);
      $grand_total = $total_ex_vat + $vat_amount;
      $net_amout +=$grand_total;
       
    ?>
     <?php if($pro_item_name!=""  )
    {?>
    <tr style="height:1px;">
        <td colspan="4" style="font-size: 10px;text-align: center;width: 2%;"><?php echo $i++;?></td>
        <td colspan="43" style="font-size: 10px;width: 43%;"><?php echo nl2br($pro_item_name);?><br><span style="float:right;"><?php  echo nl2br( $discriptionArabic); ?></td>
        <td colspan="7" align="center" style="font-size: 10px;text-align: center;width: 7%;"><?php echo $unit;?></td>
        <td colspan="7" align="center" style="font-size: 10px;text-align: center;width: 7%;"><?php echo $qty;?></td>
        <td colspan="7" align="right" style="font-size: 10px;text-align: center;width: 7%;"><?php echo number_format($unit_price, 2, '.', '');?></td>
        <td colspan="9" align="right" style="font-size: 10px;text-align: center;width: 9%;"><?php echo number_format($total_ex_vat , 2, '.', '');?></td>
        <td colspan="7" align="right" style="font-size: 10px;text-align: center;width: 7%;"><?php echo '15';?></td>
        <td colspan="6" align="right" style="font-size: 10px;text-align: center;width: 6%;"><?php echo number_format($vat_amount, 2, '.', '');?></td>
       
        <td colspan="10" align="right" style="font-size: 10px;text-align: center;width: 10%;"><?php echo number_format($grand_total, 2, '.', '');?></td>
    </tr>
  <?php } else {?>
       <?php for ($j=0; $j <1 ; $j++) { ?>
      <tr style="height:10px;">
         <td colspan="100" class="no-border"></td>
    </tr>
     <?php  } }?>

    <?php
    }
    
    ?>
   <tr>
  <td rowspan="3" colspan="61" style="vertical-align: top;font-size: 11px;"><u><strong>Remark's</strong></u> <br><?php echo  $remarks;?></td>
  <td colspan="29" style="font-size: 11px; text-align: right;"><b>المجموع الفرعي  <br>Sub Total</b></td>
  <td colspan="10" style="font-size: 11px;text-align: center;"> <b><?php echo number_format($credit_sub_total, 2, '.', '');?></b></td>
</tr>
<tr>
  <td colspan="29" style="font-size: 11px;text-align: right;"><b>15 ضريبة القيمة المضافة  <br>Value Added Tax 15%<b></td>
  <td colspan="10" style="font-size: 11px;text-align: center;"><b> <?php echo number_format($credit_vat_amount, 2, '.', '');?></b></td>
</tr>
<tr>
  <td colspan="29" style="font-size: 11px;text-align: right;"><b>المبلغ الإجمالي مع ضريبة القيمة  <br>Total Amount With VAT</b></td>
  <td colspan="10" style="font-size: 11px;text-align: center;"><b> <?php echo number_format($credit_total, 2, '.', '');?></b></td>
</tr>
<tr>
  <?php
 $num = $credit_total;
 $num = str_replace(array(',', ''), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : '' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' and ' . $list1[$tens] . ' ' : '' );
        } elseif ($tens >= 20) {
            $tens = (int)($tens / 10);
            $tens = ' and ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } 
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = implode(' ',  $words);
    $words = preg_replace('/^\s\b(and)/', '', $words );
    $words = trim($words);
    $words = ucfirst($words);
    $words = $words ;
    $grand_amount =  $words ;

// decimal

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
    $grand_amount_word  = ($grand_amount ?  $grand_amount : '').' Saudi Riyals' .($paise ?  $paise : '') ;

 ?> 
  <td colspan="100" style="font-size: 14px;text-align: left;"><b> Amount In Words : SAR -  <?php echo $grand_amount_word;?> </b></td>
  </tr>
 <tr style="height:10px;">
    <td class="no-border"  colspan="100"></td>
    </tr>
    <tr>
      <td class="no-border" colspan="100"  style="font-size: 12px;width: 100%;"><strong>Bank Details.</strong></td>
    </tr>
    <tr style="height:1px;">
    <td class="only_bottom"  colspan="100" style="width: 100%;"></td>
    </tr>
    <tr>
    <td colspan="40" style="text-align: center;font-size: 12px;width: 40%;"><b>Name :</td>
    <td colspan="16" style="text-align: center;font-size: 12px;width: 16%"><b>A/c No. :</td>
    <td colspan="22" style="text-align: center;font-size: 12px;width: 22%"><b>(IBAN)</td>
    <td colspan="22" style="text-align: center;font-size: 12px;width: 22%"><b>Bank:</td>
     </tr>
    <tr style="height: 20px;">
    <td  colspan="40"style="font-size: 10px;text-align: center;width: 40%;"><b><?php echo $bname ;?></b></td>
    <td colspan="16"  style="font-size: 10px;text-align: center;width: 16%;"><b><?php echo $account_no;?></b></td>
    <td colspan="22" style="font-size: 10px;text-align: center;width: 22%;"><b><?php echo $iban_no;?></b></td>
    <td colspan="22" style="font-size: 10px;text-align: center;width: 22%;"><b><?php echo $bank_name;?></b></td>
  </tr> 
  <tr style="height:30px;">
    <td class="no-border"  colspan="100" style="width: 100%;"></td>
    </tr>

    <tr>
    <td colspan="40" class="no-border" style="width: 40%;"> </td>
    <td  colspan="9" class="no-border" align="left" style="width: 9%;" rowspan="4" >
     
    </td>
    <td colspan="51" class="no-border" style="width: 51%;text-align: left;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received by</td>

  </tr>
   <tr>
    <td colspan="40" class="no-border" style="width: 40%;"> </td>
    <td colspan="51" class="no-border" style="width: 51%;text-align: left;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : .............................</td>
   

  </tr>
  <tr>
    <td colspan="40" class="no-border" style="width: 40%;"><u><strong>Accounts </strong></u></td>
  
    <td colspan="51" class="no-border" style="width:51%;text-align: left;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Designation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: .............................</td>
  
  </tr>
   <tr>
    <td colspan="40" class="no-border" style="width: 40%;font-size: 11px;"><u><strong>AL RAWAE AL FANIYA CONTRACTING EST.</strong></u></td>
  
    <td colspan="51" class="no-border" style="width: 51%;text-align: left;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stamp & Signature : .............................</td>
 

  </tr>
</tbody>
  <tfoot >
     <tr height="60px">
                    <td class="no-border" colspan="100" style="width: 100%;">
           
                    </td>
                </tr>
                
            </tfoot>
        </table>

</div>

