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
    $client_name            = $row->client_name; 
    $address       = $row->address;
    $client_street = $row->client_street;
    $client_city = $row->client_city;
    $vendor_state = $row->client_state;
    $client_zip = $row->client_zip;
    $client_area = $row->client_area;
    $client_mobile = $row->client_mobile; 
    $fax_no = $row->fax_no;
    $client_country = $row->client_country;
    $land_line_no  = $row->land_line_no;
    
  }
  
  foreach($value->result() as $row)
  {
    $sal_id = $row->sal_id;
    $sal_order = $row->sal_order;
    $sal_order_date = $row->sal_order_date;
    $refference = $row->refference;
    $payment_term1 = $row->payment_term;
    $sal_client_rep = $row->sal_client_rep;
    $sal_sub_total = $row->sal_sub_total;
    $sal_tax_amount = $row->sal_tax_amount;
    $sal_grand_total = $row->sal_grand_total;
    $general_terms = $row->sal_general_terms;
    
    $sal_discount = $row->sal_discount;
    $sal_currency = $row->sal_currency;
    $invoice_bank = $row->sal_bank;
    $sal_created_on = $row->sal_created_on;
    $sal_invoice_status = $row->sal_invoice_status;

    $Qrdate = date('Y-m-d', strtotime($sal_created_on));
    $d=strtotime($sal_created_on);
    $Qr_time = date("H:i",strtotime($sal_created_on));
    $sal_no1         = explode('/',$sal_order);
    $ele2 = array();
    foreach($sal_no1 as $data) 
    {
        $ele2[] = $data ;
    }
    $sal_no =  implode('-', $ele2);
   
   $revnum = $row->qus_rev;
  }
   $rev_padd_num = str_pad($revnum, 2, "0", STR_PAD_LEFT);
  $Y= date('Y');
  $y=date('y');
  $getCurrency=$this->pre->getCurrencyQuotation($sal_currency);
  $getCurrencyName=$this->pre->getCurrencyQuotationName($sal_currency);
  $getCurrencyfraction=$this->pre->getCurrencyQuotationFraction($sal_currency);
  $payment_term=$this->pre->getpayment_term($payment_term1 );
  $delivery_data=$this->pre->getdelivery_data($delivery );
  $client_rep_designation_id=$this->pre->getclient_rep_designation_id_inv($sal_client_rep );
  $client_rep_name=$this->pre->getclient_rep_name($sal_client_rep );
  $client_rep_title_id=$this->pre->getclient_rep_title_id_inv($sal_client_rep );
  $client_rep_title=$this->pre->getclient_rep_title($client_rep_title_id );
  $client_rep_designation=$this->pre->getvendor_rep_designation($client_rep_designation_id );
  $client_rep_contact_num=$this->pre->getclientrep_contact_num_inv($sal_client_rep );
  $client_rep_email=$this->pre->getclientrep_email_inv($sal_client_rep );
  $client_rep_alternative_num=$this->pre->getclientrep_contact_num1_inv($sal_client_rep );
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
 .oval {
  height: 50px;
  width: 100px;
  background-color: #555;
  border-radius: 20%;
}
</style>

<table style="width: 100%"  border="0" cellpadding="0" cellspacing="0"  >

   <tr>
     <td style="width: 80%; line-height: 30px;vertical-align: middle;text-align: left;font-size: 20px;font-family: Algerian" ><b>INVOICE</b></td>
      <td style="width: 20%;text-align: right;" rowspan="3" >
     <?php if($sal_invoice_status =='1'){?>
       <img src="<?php echo base_url('Sales_order/QRcode/'.$sal_no.'/'.$com_name.'/'. $Qrdate.'/'.$Qr_time.'/'.$sal_grand_total.'/'.$sal_tax_amount .'/'.$vat  ); ?>" alt="" style="padding-left: 60px;width: 90px;height: 90px;"> 
    <?php }?>
    </td>
     
   </tr>

     <tr>
     <td style=" width: 17%;font-size: 13px;">Invoice No</td>
     <td style=" width: 2%;font-size: 13px;"><b>:</b></td>
     <td style=" width: 61%;font-size: 13px;"><b><?php echo  $sal_order;?></b></td>
   </tr>
  
    <tr>
  
       <td style=" width: 17%;font-size: 13px;">Invoice Date</td>
       <td style=" width: 2%;font-size: 13px;"><b>:</b></td>
       <td style=" width: 61%;font-size: 13px;"><b><?php echo date('d/m/Y', strtotime($sal_order_date));?></b></td>
   </tr>
   <tr>
     <td style="height: 10px;width: 100%"></td>
   </tr>
   <tr>
     <td style="width: 50%; text-align: left;font-size: 14px;"><b>To:</b></td>
   </tr>
   <tr>
    <!-- <td style="width: 60%;font-size: 12px;text-align: left;" >
    <table style="width: 100%;" align="left">
      <tr> -->
    <td style="width: 60%;font-size: 12px;text-align: left;" ><?php if($client_name!='')?><span style="font-size: 13px;"><b><?php { echo $client_name;?></b></span><br><?php }?><?php if($address!=''){ echo $address;?><br><?php }?><?php if($client_street!=''){ echo $client_street;?><br><?php }?><?php if($client_city!=''){ echo $client_city; echo",";?><?php }?><?php if($vendor_state!=''){echo" "; echo $vendor_state; echo",";?><?php }?><?php if($client_zip!=''){echo" "; echo"Zip Code :";echo" ";echo $client_zip;echo"," ?><?php }?><?php if($client_area!=''){echo" "; echo"PO Box :";echo" ";echo $client_area; ?><?php }?><br><?php if($client_country!=''){ echo $client_country; echo".";?><br><?php }?><?php if($land_line_no!=''){echo"Landline:";echo" "; echo $land_line_no;echo",";echo" "; ?><?php }?><?php if($client_mobile!=''){echo"Mobile:";echo" "; echo $client_mobile;?><br><?php }?><?php if($fax_no!=''){echo"Fax:";echo" "; echo $fax_no;?><br><?php }?>
  </td>
<!-- </tr>
</table>
</td> -->
<td style="width: 100%;">
  <table style="width: 100%;">
    <?php if($sal_client_rep!=''){?>
    <tr>
   <td style="width: 10%;font-size: 12px;">Attn</td>
    <td style="width: 2%;font-size: 12px;">:</td>
    <td style="width: 28%;font-size: 12px;"><b><?php echo  $client_rep_title; echo" ";?><?php  echo $client_rep_name;?></b></td>
    </tr>
  <?php }?>
   <?php if( $client_rep_designation!=''){?> 
  <tr>
    <td style="width: 10%;font-size: 12px;"></td>
    <td style="width: 2%;font-size: 12px;"></td>
    <td style="width: 28%;font-size: 12px;"><?php echo $client_rep_designation;?></td>
    </tr>
  <?php }?>
   <?php if($client_rep_contact_num!=''){?>
   <tr>
  
    <td style="width: 10%;font-size: 12px;"><?php if($client_rep_contact_num!=''){?>Tel<?php }?></td>
    <td style="width: 2%;font-size: 12px;"><?php if($client_rep_contact_num!=''){?>:<?php }?></td>
    <td style="width: 28%;font-size: 12px;"><?php echo $client_rep_contact_num;?></td>
   </tr>
 <?php } ?>
<?php if($client_rep_alternative_num!=''){?>
   <tr>
  
    <td style="width: 10%;font-size: 12px;"> <?php if($client_rep_alternative_num!=''){?>Mob<?php }?></td>
    <td style="width: 2%;font-size: 12px;">  <?php if($client_rep_alternative_num!=''){?>:<?php }?></td>
    <td style="width: 28%;font-size: 12px;"><?php echo $client_rep_alternative_num?></td>
   </tr>
 <?php } ?>
  <?php if($client_rep_email!=''){?>  
   <tr>

    <td style="width: 10%;font-size: 12px;"><?php if($client_rep_email!=''){?>Email <?php }?></td>
    <td style="width: 2%;font-size: 12px;"><?php if($client_rep_email!=''){?>: <?php }?></td>
    <td style="width: 28%;font-size: 12px;"><?php echo strtolower($client_rep_email);?></td>
   </tr>
 <?php }?>
 </table>
</td>
</tr>
    <tr>
     <td style="width: 100%;height: 10px;"></td>
   </tr>
   <?php if($sal_tax_amount=='0.00'){?>
   <tr>
    <td style="width: 7%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 20px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Item No</b></td>
    <td style="width: 1%;text-align: center;font-size: 10px;border-bottom:0.1px solid black;border-top:0.1px solid black;background-color: #F8F3EE;"><b></b></td>
    <td style="width: 51%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 20px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;"><b>Description </b></td>
    <td style="width: 10%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 20px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Qty</b></td>
    <td style="width: 10%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 20px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Unit Price (<?php echo $getCurrency;?>) </b></td>
    <td style="width: 9%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 20px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Discount (%)</b></td>
    <td style="width: 12%;text-align: right;font-size: 10px;background-color: #F8F3EE;line-height: 20px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Amount  &nbsp; (<?php echo $getCurrency;?>)&nbsp; </b></td>
   </tr>
   <?php 
    $i= 1;
   foreach($spvalue as $key =>$row)
    {
      $item             = $row->item_description;
      $itemarabic       = $row->item_description_arabic;
      $total_amont      = $row->total_amount ;
      $unit             = $row->unit;
      $qty              = $row->qty;
      $unit_price       = $row->unit_price;
      $discount       = $row->dis_amt;
      $dis_per = $row->discount;

      ?>
      <?php if($i=='1'){?>

     <tr style="height: 2px;">
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;"></td>
    <td style="width: 51%;font-size: 11px;vertical-align: middle;"></td>

    <td style="width: 10%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
     <td style="width: 9%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
   </tr>       
   <tr>
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $i;?></td>
    <td style="width: 1%;text-align: center;font-size: 11px;"></td>
    <td style="width: 51%;font-size: 11px;vertical-align: middle;"><?php echo nl2br($item);?></td>

    <td style="width: 10%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $qty;?></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $unit_price; echo" ";?>&nbsp;</td>
     <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $dis_per; echo" ";?>&nbsp;</td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo number_format($total_amont, 2, '.', '');?>&nbsp;&nbsp;  </td>
   </tr> 

  <tr style="height: 2px;">
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;border-bottom:0.1px solid black;"></td>
    <td style="width: 51%;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;"></td>

    <td style="width: 10%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
     <td style="width: 9%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
   </tr>

<?php } else {?>
     <tr style="height: 2px;">
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;"></td>
    <td style="width: 51%;font-size: 11px;vertical-align: middle;"></td>

    <td style="width: 10%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
     <td style="width: 9%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
   </tr> 
   <tr>
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $i;?></td>
    <td style="width: 1%;text-align: center;font-size: 11px;"></td>
    <td style="width: 51%;font-size: 11px;vertical-align: middle;"><?php echo nl2br($item);?></td>

    <td style="width: 10%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $qty;?></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $unit_price; echo" ";?>&nbsp;</td>
    <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $dis_per; echo" ";?>&nbsp;</td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo number_format($total_amont, 2, '.', '');?>&nbsp;&nbsp;  </td>


   </tr>

     <tr style="height: 2px;">
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;border-bottom:0.1px solid black;"></td>
    <td style="width: 51%;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;"></td>

    <td style="width: 10%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
     <td style="width: 9%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
   </tr>
<?php } ?>
   <?php $i++;} 
  }  else {?>

       <tr>
    <td style="width: 7%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 30px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Item No</b></td>
    <td style="width: 1%;text-align: center;font-size: 10px;border-bottom:0.1px solid black;border-top:0.1px solid black;background-color: #F8F3EE;"><b></b></td>
    <td style="width: 48%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 30px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;"><b>Description </b></td>
    <td style="width: 7%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 30px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Qty</b></td>
    <td style="width: 10%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 20px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Unit Price (<?php echo$getCurrency;?>) </b></td>
    <td style="width: 9%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 18px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Discount (%)</b></td>
     <td style="width: 6%;text-align: center;font-size: 10px;background-color: #F8F3EE;line-height: 18px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>VAT (%)</b></td>
    <td style="width: 12%;text-align: right;font-size: 10px;background-color: #F8F3EE;line-height: 18px;vertical-align: middle;border-bottom:0.1px solid black;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"><b>Amount&nbsp;&nbsp; <br>(<?php echo $getCurrency;?>)&nbsp;&nbsp;</b></td>
   </tr>
   <?php 
    $i= 1;
   foreach($spvalue as $key =>$row)
    {
      $item             = $row->item_description;
      $itemarabic       = $row->item_description_arabic;
      $total_amont      = $row->total_amount ;
      $unit             = $row->unit;
      $qty              = $row->qty;
      $unit_price       = $row->unit_price;
      $discount       = $row->dis_amt;
      $dis_per = $row->discount;
      $vat_per = $row->vat_per;

      ?>
      <?php if($i=='1'){?>

           <tr >
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;"></td>
    <td style="width: 48%;font-size: 11px;vertical-align: middle;"></td>

    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
     <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
      <td style="width: 6%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
   </tr>

    <tr >
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $i;?></td>
    <td style="width: 1%;text-align: center;font-size: 11px;"></td>
    <td style="width: 48%;font-size: 11px;vertical-align: middle;"><?php echo nl2br($item);?></td>

    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $qty;?></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $unit_price; echo" ";?>&nbsp;</td>
     <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $dis_per; echo" ";?>&nbsp;</td>
      <td style="width: 6%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $vat_per; echo" ";?>&nbsp;</td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo number_format($total_amont, 2, '.', '');?>&nbsp;&nbsp;  </td>
   </tr>

    <tr >
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;border-bottom:0.1px solid black;"></td>
    <td style="width: 48%;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;"></td>

    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
     <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
      <td style="width: 6%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"> </td>
   </tr>
<?php } else {?>

  <tr >
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;border-top:0.1px solid black;"></td>
    <td style="width: 48%;font-size: 11px;vertical-align: middle;border-top:0.1px solid black;"></td>

    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
       <td style="width: 6%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-top:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
   </tr>
   <tr >
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $i;?></td>
    <td style="width: 1%;text-align: center;font-size: 11px;"></td>
    <td style="width: 48%;font-size: 11px;vertical-align: middle;"><?php echo nl2br($item);?></td>

    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $qty;?></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $unit_price; echo" ";?>&nbsp;</td>
    <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $dis_per; echo" ";?>&nbsp;</td>
       <td style="width: 6%;text-align: center;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo $vat_per; echo" ";?>&nbsp;</td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-right:0.1px solid black;border-left:0.1px solid black;"><?php echo number_format($total_amont, 2, '.', '');?>&nbsp;&nbsp;  </td>
   </tr>

   <tr >
    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 1%;text-align: center;font-size: 11px;border-bottom:0.1px solid black;"></td>
    <td style="width: 48%;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;"></td>

    <td style="width: 7%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 10%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 9%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
       <td style="width: 6%;text-align: center;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
    <td style="width: 12%;text-align: right;font-size: 11px;vertical-align: middle;border-bottom:0.1px solid black;border-right:0.1px solid black;border-left:0.1px solid black;"></td>
   </tr>
<?php } ?>
   <?php $i++;}}?> 

<tr>
  <td style="width: 100%;height: 10px;"></td>
</tr>
 <!--   <tr>
     <td style="width: 88%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;">Sub Total&nbsp;&nbsp;</td>
     <td style="width: 12%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;"><?php echo number_format($quotation_sub_total, 2, '.', '');?> &nbsp;</td>
   </tr> -->
 <?php if($sal_discount!='0.00'){?>
    <tr>
     <td style="width: 88%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;">Total Discount Amount&nbsp;:&nbsp;</td>
     <td style="width: 12%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;"><?php echo number_format($sal_discount, 2);?> &nbsp;</td>
   </tr>
 <?php }?>
  <?php if($sal_tax_amount!='0.00'){?>
      <tr>
     <td style="width: 88%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;">Total VAT Amount&nbsp;:&nbsp;</td>
     <td style="width: 12%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;"><?php echo number_format($sal_tax_amount, 2);?> &nbsp;</td>
   </tr>
    <tr>
     <td style="width: 88%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;">Total Without VAT&nbsp;:&nbsp;</td>
     <td style="width: 12%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;"><?php $total_without_vat = $sal_grand_total - $sal_tax_amount; echo number_format($total_without_vat, 2);?> &nbsp;</td>
   </tr>
 <?php }?>
     <tr>
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
            $str [] = ($number < 20) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 100] . ' ' . $digits[$counter] . $plural;
              $str [] = ($number > 19) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
        } else {
            $str [] = null;
        }  
    }
    
    $Rupees = implode(' ', array_reverse($str));
    if($decimal<20)
    {
       $paise = ($decimal) ? " and " . ($words[$decimal - $decimal%100]) ." " .($words[$decimal%100])." ". $getCurrencyfraction  : '';
    }
    else
    {
       $paise = ($decimal) ? " and " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])." ". $getCurrencyfraction  : '';
    }
   
   if($paise=='')
   {
    $grand_amount_word  = ($grand_amount ?  $grand_amount : '')." ".$getCurrencyName ." "."Only" ;
   }
   else
   {
    $grand_amount_word  = ($grand_amount ?  $grand_amount : '')." ".$getCurrencyName .($paise ?  $paise : '')." "."Only" ;
   }
    

 ?> 
       <td style="width: 66%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;"></td>
      <td style="width: 22%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;border-bottom:2px solid black;border-top:2px solid black;"><b>Total Amount&nbsp;:&nbsp;</b></td>
     <td style="width: 12%;text-align: right;line-height: 20px;vertical-align: middle;font-size: 12px;border-bottom:2px solid black;border-top:2px solid black;background-color: #F8F3EE;"><b><?php echo number_format($sal_grand_total, 2);?></b> &nbsp;</td>
   </tr>
   <tr>
  <td style="width: 100%;height: 10px;"></td>
</tr>
    <tr>
     <td style="width: 20%;text-align: left;line-height: 20px;vertical-align: middle;font-size: 12px;"><b>Amount in Words : </b></td>   
     <td style="width: 80%;text-align: left;line-height: 20px;vertical-align: middle;font-size: 12px;"><b><?php echo  $grand_amount_word;?></b></td>  
   </tr>
   <tr>
  <td style="width: 100%;height: 5px;"></td>
</tr>
<?php if($general_terms!=''){?>
   <tr>
    <td style="width: 100%;font-family: Calibri;font-size: 12px;"><b><u><i><br>Standard Terms & Conditions:</i></u></b></td>
   </tr>
    <tr>
    <td style="width: 100%;font-size: 11px;" ><?php echo $general_terms;?></td>
   </tr>
     <tr>
   <td style="width: 100%;height: 5px;"></td>
  </tr>
 <?php }?>

 
 <!--    <tr>
    <td style="width: 100%;height: 5px;"></td>
    </tr> -->
  </table>
  <?php if($invoice_bank!=''){?>
  <table >
<tr>
  <td style="width: 100%;font-size: 12px;font-family: Calibri;" ><b><u>Bank Details:</u></b></td>
</tr>
 <tr>
   <td style="width: 100%;height: 5px;"></td>
  </tr>
</table>

<table style="width: 100%;" rules="all" border="1"  >
  <?php  foreach($bank_detail->result() as $row)
    {
      $account_no               = $row->account_no;
      $account_name             = $row->account_name;
      $bank_name                = $row->bank_name ;
      $branch_name             = $row->branch_name;

      } ?>
      <tr>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center;border-radius:50px;" >Bank Name</td>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center;" >Account Name</td>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center;" >Account Number</td>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center; border-radius:50px;" >Branch</td>
      </tr>
       <tr>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center;" ><?php echo $bank_name;?></td>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center;" ><?php echo $account_name;?></td>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center;" ><?php echo $account_no;?></td>
        <td style="width: 25%;font-size: 12px;font-family: Calibri;text-align: center;" ><?php echo $branch_name;?></td>
      </tr>
</table>
<?php }?>
<table>
   <tr>
   <td style="width: 100%;height: 5px;"></td>
  </tr>
   <tr>
   <td style="width: 100%;height: 5px;"></td>
  </tr>
   <tr>
   <td style="width: 100%;height: 5px;"></td>
  </tr>
  <tr>
    <td style="width: 20%;font-size: 10px;"></td>
     <td style="width: 50%;" rowspan="4"> &nbsp; &nbsp; &nbsp;</td>
     <td style="width: 30%;font-size: 10px;"></td>
   </tr>
   <tr>
    <td style="width: 20%;font-size: 10px;border-top:2px solid black;height: 20px;"><br>Verified By:</td>
     <td style="width: 30%;font-size: 10px;height: 50px;"></td>
   </tr> 
<tr>
    <td style="width: 20%;font-size: 10px;"></td>
  
     <td style="width: 30%;font-size: 10px;"></td>

   </tr>
<tr>
    <td style="width: 20%;font-size: 10px;border-top:2px solid black;height: 20px;"><br>Approved By:</td>
  
     <td style="width: 30%;font-size: 10px;border-top:2px solid black;height: 20px;"><br>Acknowledged By:</td>

   </tr>
      <tr>
   <td style="width: 100%;height: 5px;"></td>
  </tr>
     <tr>
   <td style="width: 100%;text-align: center;">Thank you for your business</td>
  </tr>
</table>
<br>
<div  class="oval">This is your div content.</div>