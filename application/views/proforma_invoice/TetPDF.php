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
    foreach($vat_no as $data) 
    {
        $elements2[] = $data ;
    }
    $name          = explode(' ',$c_org_name);
    $elements3 = array();
    foreach($name as $data3) 
    {
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
  
    $client_email           = $row->client_email;    
    $client_phone           = $row->client_mobile;
    
    $client_city            = $row->client_city;
    $client_city_arabic     = $row->client_city1;
    $client_state           = $row->client_state;
    $client_state_arabic    = $row->client_state1;

    $contact_area           = $row->contact_area;
    $contact_area_arabic    = $row->contact_area1;
    $contact_city           = $row->contact_city;
    $contact_city_arabic    = $row->contact_city1;
    $contact_state          = $row->contact_state;        
    $contact_state_arabic   = $row->contact_state1;
    $contact_website        = $row->contact_website;

    $client_address         = $row->address; 
    $client_address_arabic  = $row->address1; 
    $client_street = $row->client_street;
    $street_arabic  = $row->street_arabic;
    $client_district = $row->client_district;
    $client_district_arabic = $row->client_district_arabic;
    $client_province = $row->client_province;
    $client_province_arabic = $row->client_province_arabic;
    $client_zip             = $row->client_zip;
    $client_zip_arabic      = $row->client_zip1;
    $client_area            = $row->client_area;
    $client_area_arabic     = $row->client_area1;
    $client_country         = $row->client_country;
    $client_country_arabic  = $row->client_country1;
    $client_vat_arabic      = $row->client_vat_arabic;
    $contact_no_arabic = $row->contact_no_arabic;
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
    $sal_customer_address       = $row->per_sal_customer_address;
    $sal_order_date             = $row->per_sal_order_date; 
    $sal_company_name           = $row->per_sal_company_name;
    $sal_reference              = $row->per_sal_reference; 
    $sal_order                  = $row->per_sal_order; 
    $sal_person                 = $row->per_sal_person;    
    $sal_delivery_date          = $row->per_sal_delivery_date;
    $sal_customer_notes         = $row->per_sal_customer_notes;  
    $sal_sub_total              = $row->per_sal_sub_total;
    $sal_discount               = $row->per_sal_discount;
    $sal_grand_total            = $row->per_sal_grand_total;
    $sal_tax_amount             = $row->per_sal_tax_amount;
    $sal_tax_id                = explode(',',$row->per_sal_tax_id);
    $sal_delivery_amount        = $row->per_sal_delivery_amount;
    $grand_total                = $sal_grand_total-$sal_discount+$sal_delivery_amount;    
    $sal_created_on             = $row->per_sal_created_on;
    $sal_created_by             = $row->per_sal_created_by;
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
    foreach($sal_order1 as $data) 
    {
    //do something
    $elements[] = $data ;
    }
    $dd =  implode('-', $elements);
  }
  
  $Y= date('Y');
  $y=date('y');
  $getCurrency=$this->pre->getCurrencynew();
  $payment_ter=$this->pre->getpayment_term($payment_term );
  foreach($bank_detail->result() as $row)
  {
    $account_no            = $row->account_no; 
    $bank_name             = $row->bank_name; 
    $iban_no              = $row->ifs_code;
    $swift_code             = $row->micr_no;
    $bname  = $row->account_name;
     
  }

?>
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
  border-bottom:solid 2px #red!important;
  
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

<table style="width: 100%"  border="0" cellpadding="1" cellspacing="0"  >
   <tr style="height:700px;">
    <td  colspan="100" style="width: 100%;"></td>
    </tr>
  <tr>
    <td   colspan="100" style="font-size: 18px;text-align: center;width: 100%; "><br><b><u>PROFORMA - INVOICE /  ???????????????? ?????????????? </u></b>  </td>
  </tr>
   <tr style="height:20px;">
    <td  colspan="100" style="width: 100%;"></td>
    </tr>
   <tr>
    <td  colspan="100" style="font-size: 12px;text-align: right;width: 100%;"  ><strong>Date  : <?php echo date('d/m/Y', strtotime($sal_order_date));?></strong></td>
   
  </tr>
  <tr>
     <td   colspan="100" style="font-size: 12px;text-align: right;width: 100%;"><strong>Proforma No : <?php echo $sal_order;?></strong></td>
  </tr>
  <tr style="height:10px;">
    <td   colspan="100" style="width: 100%;"></td>
    </tr>
  <tr >
    <td colspan="10" style="font-size: 10px;width: 10%;vertical-align: middle;border-left:0.1px solid black;border-top:0.1px solid black;"  >To</td>
    <td  colspan="1" style="font-size: 10px;width: 1%;vertical-align: middle;border-top:0.1px solid black;"  >:</td>
    <td  colspan="38" style="font-size: 10px;width: 38%;vertical-align: middle;border-top:0.1px solid black;"   ><b><?php echo $client_company_name;?></b></td>
    <td colspan="40" style="font-size: 10px; text-align:right;width: 40%;vertical-align: middle;border-top:0.1px solid black;"   ><b><?php echo $client_arabic_name;?></b></td>
    <td colspan="1"  style="font-size: 10px;text-align: center;width: 1%;vertical-align: middle;border-top:0.1px solid black;"  >:</td>
    <td colspan="10"  style="font-size: 10px;width: 10%;vertical-align: middle;text-align: right;border-top:0.1px solid black;border-right:0.1px solid black;"  >??????  </td>
    
  </tr>
   <tr >
    <td colspan="10" style="font-size: 10px;width: 10%;vertical-align: top;border-left:0.1px solid black;">Address</td>
    <td colspan="1" style="font-size: 10px;width: 1%;vertical-align: top;" >:</td> 
   <!--  <td colspan="38" style="font-size: 8px;width: 38%;vertical-align: top;" ><?php echo $client_address; echo " "; echo $client_street; echo" "; echo $client_district;echo " ";echo  $client_province ;echo " ";echo  $client_zip ;echo" ";echo  $client_area ;echo" ";echo  $client_country ;  ?></td>
    <td colspan="40" style="font-size: 8px; text-align:right;width: 40%;vertical-align: top;" ><?php echo $client_address_arabic; echo " "; echo $street_arabic; echo" "; echo $client_district_arabic;echo " ";echo  $client_province_arabic ;echo " ";echo  $client_zip_arabic ;echo" ";echo  $client_area_arabic ;echo" ";echo  $client_country_arabic ;  ?> </td> -->
    <td colspan="38" style="font-size: 10px;width: 38%;vertical-align: top;" ><?php if($client_address!=''){echo $client_address;  }?><?php if($client_street!=''){ echo ","; echo " ";echo $client_street;echo ","; }?> <?php if($client_district!=''){ echo" "; echo $client_district;echo ","; }?><?php if($client_province !=''){echo " ";echo  $client_province ;echo ","; }?><?php if($client_zip!=''){ echo " "; echo"Zip Code:"; echo" ";echo  $client_zip ;echo ","; }?><?php if($client_area!=''){ echo" "; echo"PO Box:"; echo" "; echo  $client_area ;echo ","; }?><?php if( $client_country!=''){ echo" ";echo  $client_country ;echo"."; } ?></td>



    <td colspan="40" style="font-size: 10px; text-align:right;width: 40%;vertical-align: top;" ><?php  if($client_address_arabic!=''){echo $client_address_arabic; }?><?php if($street_arabic!=''){ echo ","; echo " "; echo $street_arabic; echo ",";}?><?php if($client_district_arabic!=''){ echo" "; echo $client_district_arabic;echo ",";}?><?php if($client_province_arabic!=''){ echo "  ";echo  $client_province_arabic ;echo ",";}?><?php if($client_zip_arabic!=''){echo " ";echo  $client_zip_arabic ;echo ",";}?><?php if($client_area_arabic!=''){echo"  ";echo  $client_area_arabic ;echo ",";}?><?php if($client_country_arabic!=''){echo"  ";echo  $client_country_arabic ; } ?> </td>
    <td colspan="1"  style="font-size: 10px;text-align: center;width: 1%;vertical-align: top;"  >:</td>
    <td colspan="10" style="font-size: 10px;width: 10%;vertical-align: top;text-align: right;border-right:0.1px solid black;" >??????????????  </td>
    
  </tr>
  <tr>
    <td colspan="10"   style="font-size: 10px;width: 10%;vertical-align: top;border-left:0.1px solid black;" >Tel</td>
    <td colspan="1"  style="font-size: 10px;width: 1%;vertical-align: top;" >:</td>
    <td colspan="38"   style="font-size: 10px;width: 38%;vertical-align: top;" ><?php echo $client_phone;?></td>
     <?php 
$contact_no_arabic_eng =  $contact_no_arabic;
$co_no_arabic_letter= strtr($contact_no_arabic_eng, ['??','??','??','??','??','??','??','??','??','??']);?>
    <td colspan="40"  style="font-size: 10px; text-align:right;width: 40%;vertical-align: top;"><?php if($contact_no_arabic) {echo $co_no_arabic_letter;}?></td>
    <td colspan="1"  style="font-size: 10px;text-align: center;width: 1%;vertical-align: top;" >:</td>
    <td colspan="10"   style="font-size: 10px;width: 10%;vertical-align: top;text-align: right;border-right:0.1px solid black;" >????????   </td>
    
  </tr>
   <tr>
    <td colspan="10"  style="font-size: 10px;width: 10%;vertical-align: top;border-left:0.1px solid black;border-bottom:0.1px solid black;"  >VAT No</td>
    <td colspan="1"  style="font-size: 10px;width: 1%;vertical-align: top;border-bottom:0.1px solid black;" >:</td>
    <td colspan="38"   style="font-size: 10px;width: 38%;vertical-align: top;border-bottom:0.1px solid black;" ><?php echo $client_vat;?></td>
            <?php 
$client_vat_arabic_eng =  $client_vat_arabic;
$vat_no_arabic_letter= strtr($client_vat_arabic_eng, ['??','??','??','??','??','??','??','??','??','??']);?>
    <td colspan="40"  style="font-size: 10px; text-align:right;width: 40%;vertical-align: top;border-bottom:0.1px solid black;" ><?php if($client_vat_arabic) {echo $vat_no_arabic_letter;}?></td>
    <td colspan="1"  style="font-size: 10px;text-align: center;width: 1%;vertical-align: top;border-bottom:0.1px solid black;" >:</td>
    <td colspan="10"  style="font-size: 10px;width: 10%;vertical-align: top;text-align: right;border-bottom:0.1px solid black;border-right:0.1px solid black;" >?????????? ??????????????     </td>
  </tr>
</table>
<table style="width: 100%"  border="0" cellpadding="4" cellspacing="0"  >

    <tr style="height:30px;">
    <td  colspan="100" style="width: 100%;"></td>
    </tr>
     <tr style="height:50px;">
    <td colspan="33" style="font-size: 10px;text-align: center;width: 33%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><strong>P.O. No.</strong></td>
    <td colspan="33" style="font-size: 10px;text-align: center;width: 33%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><strong>Payment Terms:</strong></td>
    <td colspan="34" style="font-size: 10px;text-align: center;width: 34%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><strong>Our Ref:</strong></td>

  </tr>
  <tr style="height:50px;" >
    <td colspan="33"  style="font-size: 10px;text-align: center;width: 33%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 25px;vertical-align: middle;"><b><?php echo  $po_no ;?></b></td>
    <td colspan="33" style="font-size: 10px;text-align: center;width: 33%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 25px;vertical-align: middle;"><b><?php echo  $payment_ter;?></b></td>
    <td colspan="34"  style="font-size: 10px;text-align: center;width: 34%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 25px;vertical-align: middle;"><b><?php echo  $our_ref;?></b></td>
  </tr>
    <tr style="height:15px;">
    <td  colspan="100" style="width: 100%;"></td>
    </tr>
     <tr>
    <td rowspan="2" colspan="4" style="font-size: 9px;text-align: center;width: 4%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b>SR. # </b></td>
    <td rowspan="2" colspan="41" style="font-size: 9px;text-align: center;width: 41%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b>DESCRIPTION  ??????????   </b> </td>
    <td colspan="6" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> ????????????  </b></td>
    <td colspan="6" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> ????????????. </b></td>
    <td colspan="9" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> ?????? ????????????  </b></td>
    <td colspan="9" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> ???????????? ???????????? ???????? ?????????????? </b></td>
    <td colspan="6" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> ??????????  </b>   </td>
    <td colspan="9" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> ???????? ??????????????  </b></td>
    <td colspan="10"style="font-size: 9px;text-align: center;width: 10%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b>???????? ??????????????      </b></td>
   </tr>
    <tr>
    <td colspan="6" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> Unit</b> </td>
    <td colspan="6" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> Qty. </b></td>
    <td colspan="9" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> Unit Price</b> </td>
    <td colspan="9" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b>  Total Excl. VAT    </b></td>
    <td colspan="6" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> VAT %</b>   </td>
    <td colspan="9" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b> VAT Amount   </b></td>
    <td colspan="10"style="font-size: 9px;text-align: center;width: 10%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;"><b>Total Amount </b></td>   
   </tr>
    <?php
    $i= 1;
    $net_amout = 0;
    foreach($spvalue as $key =>$row)
    {  
      $totalproduct=count($rows->sal_item_id);
      $pro_item_name    = $row->item_description;
      $discriptionArabic    = $row->item_description_arabic;
      $unitArabic    = $row->unitarabic;
      $unit     = $row->uniteng;
      $qty         = $row->qty;
      $unit_price           = $row->unit_price;
      $total            = $row->total_cost;
      $cost_total_amount1   +=   $row->total_cost;
      $total_ex_vat = $qty  * $unit_price;
      $vat_amount = ($total_ex_vat)*(15/100);
      $grand_total = $total_ex_vat + $vat_amount;
      $net_amout +=$grand_total;    
    ?>
    <tr >
        <td colspan="4" style="font-size: 9px;text-align: center;width: 4%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo $i++;?></td>
        <td colspan="41" style="font-size: 9px;width: 41%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo nl2br($pro_item_name);?><?php if($discriptionArabic!=''){?><br><span style="float:right;text-align: right;"><?php  echo nl2br( $discriptionArabic); ?></span><?php }?></td>
        <td colspan="6" align="center" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo $unit;?></td>
        <td colspan="6" align="center" style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo $qty;?></td>
        <td colspan="9" align="right" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo number_format($unit_price, 2, '.', '');?></td>
        <td colspan="9" align="right" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo number_format($total_ex_vat , 2, '.', '');?></td>
        <td colspan="6"  style="font-size: 9px;text-align: center;width: 6%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo '15';?></td>
        <td colspan="9" align="right" style="font-size: 9px;text-align: center;width: 9%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo number_format($vat_amount, 2, '.', '');?></td>
       
        <td colspan="10" align="right" style="font-size: 9px;text-align: right;width: 10%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;"><?php echo number_format($grand_total, 2, '.', '');?></td>
    </tr>
    <?php
    } ?>
   <tr style="height:0px;">
      <td colspan="100" ></td>
   </tr>
  <tr>
  <td rowspan="3" colspan="57"  style="vertical-align: top;font-size: 10px;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;width: 57%;"><u><strong>Remark's :</strong></u> <br><?php echo  $remarks;?></td>
  <td colspan="33"  style="font-size: 10px; text-align: right;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;width: 33%;vertical-align: middle;"><b> ???????????? ???????????? <br>Sub Total</b></td>
  <td colspan="10"  style="font-size: 9px;text-align: right;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;width: 10%;vertical-align: middle;"> <b><?php echo number_format($cost_total_amount1, 2, '.', '');?></b></td>
</tr>
<tr>
  <td colspan="33" style="font-size: 10px;text-align: right;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;width: 33%;vertical-align: middle;"><b>15 ?????????? ???????????? ??????????????  <br>Value Added Tax 15%</b></td>
  <td colspan="10" style="font-size: 9px;text-align: right;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;width: 10%;vertical-align: middle;"><b> <?php echo number_format($sal_tax_amount, 2, '.', '');?></b></td>
</tr>
<tr>
  <td colspan="33" style="font-size: 10px;text-align: right;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;width: 33%;vertical-align: middle;"><b>???????????? ???????????????? ???? ?????????? ????????????  <br>Total Amount With VAT</b></td>
  <td colspan="10"  style="font-size: 9px;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;width: 10%;vertical-align: middle;text-align: right;"><b> <?php echo number_format($sal_grand_total, 2, '.', '');?></b></td>
</tr>
  <?php
 
  $num = $sal_grand_total;
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
 <tr>
  <td colspan="100"   style="font-size: 10px;width: 100%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;vertical-align: middle;
    text-align:left;"><b> Amount In Words (SAR) :  <?php echo $grand_amount_word;?> </b></td>
  </tr>
<tr style="height: 10px;">
      <td  colspan="100"  ></td>
    </tr>
    <tr>
      <td  colspan="100"  style="font-size: 10px;width: 100%;vertical-align: middle;"><strong>Bank Details :</strong></td>
    </tr>
    <tr>
    <td colspan="24" style="text-align: center;font-size:10px;width: 24%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b>Name</b> </td>
    <td colspan="23" style="text-align: center;font-size: 10px;width: 23%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b>A/c No</b></td>
    <td colspan="30" style="text-align: center;font-size: 10px;width: 30%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b>IBAN</b></td>
    <td colspan="23" style="text-align: center;font-size: 10px;width: 23%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b>Bank</b></td>
     </tr>
    <tr style="height: 20px;">
    <td  colspan="24"style="font-size: 10px;text-align: center;width: 24%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b><?php echo $bname ;?></b></td>
    <td colspan="23"  style="font-size: 10px;text-align: center;width: 23%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b><?php echo $account_no;?></b></td>
    <td colspan="30" style="font-size: 10px;text-align: center;width: 30%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b><?php echo $iban_no;?></b></td>
    <td colspan="23" style="font-size: 10px;text-align: center;width: 23%;border-bottom:0.1px solid black;border-top:0.1px solid black;border-left:0.1px solid black;border-right:0.1px solid black;height: 20px;vertical-align: middle;"><b><?php echo $bank_name;?></b></td>
  </tr> 
    <tr style="height:10px;">
    <td  colspan="100" style="width: 100%;"></td>
    </tr>
    <tr>
    <td colspan="40"  style="width: 40%;"> </td>
    <td  colspan="9"  align="left" style="width: 9%;" rowspan="4" >
    <!--  <img src="<?php echo base_url('Sales_order/QRcode/'.$dd.'/'.$com_name.'/'. $Qrdate.'/'.$Qr_time.'/'.$sal_grand_total.'/'.$sal_tax_amount .'/'.$vat  ); ?>" alt="" style="padding-left: 10px;width: 120px;height: 120px;padding-right: 10px;">  -->
    </td>
    <td colspan="51"  style="width: 51%;text-align: left;font-size: 10px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received by</td>
  </tr>
   <tr>
    <td colspan="40"  style="width: 40%;"> </td>
    <td colspan="51" style="width: 51%;text-align: left;font-size: 10px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ..................................................</td>
  </tr>
  <tr>
    <td colspan="40"  style="width: 40%;font-size: 10px;"><u><strong>Accounts </strong></u></td>
    <td colspan="51"  style="width:51%;text-align: left;font-size: 10px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Designation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ..................................................</td>
  </tr>
   <tr>
    <td colspan="40"  style="width: 40%;font-size: 10px;"><u><strong>Roboua Al Taqdum Company For General Architectural Contracting</strong></u></td>
    <td colspan="51"  style="width: 51%;text-align: left;font-size: 10px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stamp & Signature : ..................................................</td>
  </tr> 
</table>