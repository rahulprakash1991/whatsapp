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
		$con_company_name           = $row->con_company_name; 
		$contact_address            = $row->contact_address; 
		$contact_area               = $row->contact_area;    
		$con_phone                  = $row->con_phone;
		$con_email                  = $row->con_email;
		$con_primary                = $row->con_primary;
		
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
		$co_id                = $row->co_id;
		$co_no                = $row->co_no;
		$order_date           = $row->order_date;
	
		$ref_no               = $row->ref_no;   
    $vender_name = $row->con_company_name;   
    $vender_name1 = $row->name1;   
    $vender_name2 = $row->name2;   
    $vender_name3 = $row->name3;  

	         
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
<h1 align="right">COSTING</h1>         

<?php if($vender_name!='' && $vender_name1=='' && $vender_name2=='' && $vender_name3==''){?>

<table width="100%"  border="1" rules="all">
  <table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        
        <td style="width: 35%">
           <strong>PO No. : </strong><?php echo $co_no;?>
        </td>
    
        <td style="width: 32%">
           <strong>PO Date : </strong><?php echo date('d/m/Y', strtotime($order_date));?>
        </td>
   
        <td style="width: 33%">
           <strong>Ref No. : </strong><?php echo $ref_no;?>
        </td>
    </tr>
</table>
<table width="100%"  border="1" rules="all">
  <tr>
        <th  width="67%">Vender Name</th>
        <th  width="33%"><?php echo $vender_name;?></th>
        
       
       
    </tr>
    </table>
    
<table width="100%"  border="1" rules="all">
  
  <tr>
        <th  width="4%">Sl.No.</th>
        <th  width="62.2%">Item Description</th>
        <th  width="34%;" >Cost(<?php echo $getCurrency;?>)</th>
       
     
    </tr>
  <?php
    $i= 1;
    foreach($poproduct as $key =>$row)
    {   
  
    $pro_item_name            =   $row->pro_item_name;
    $cost                     =   $row->cost;
    $cost1                    =   $row->cost1;
    $cost2                    =   $row->cost2;
    $cost3                    =   $row->cost3;
    
    ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $pro_item_name;?></td>
        <td style="text-align: center;"><?php echo $cost;?></td>
       
       
    </tr>
    <?php
    }
    
    for ($j=$i; $j <= 15; $j++)
    {?>
    <tr style="height:30px;">
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
        <td class="br_none_t br_none_b"></td>
      
       
    </tr>
    <?php 
    }
    ?>
    
   
    <tr>
        <td colspan="2"><strong>Terms and Conditions</strong><br /><?php echo $this->pref->po_notes;?></td>
        <td colspan="1" >
          For <strong><?php echo strtoupper($c_org_name);?></strong>
            <br />
            <br />
            <br />
            Authorized Signatory
        </td>
    </tr>
  </table>
  <?php }?>
<?php if($vender_name!=''&& $vender_name1!=''&& $vender_name2=='' && $vender_name3==''){?>
  <table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        
        <td style="width: 25%">
           <strong>PO No. : </strong><?php echo $co_no;?>
        </td>
    
        <td style="width: 34%">
           <strong>PO Date : </strong><?php echo date('d/m/Y', strtotime($order_date));?>
        </td>
   
        <td style="width: 41%">
           <strong>Ref No. : </strong><?php echo $ref_no;?>
        </td>
    </tr>
</table>
<table width="100%"  border="1" rules="all">
  
  <tr>
        <th  width="59%">Vender Name</th>
        <th  width="20%"><?php echo $vender_name;?></th>
        <th  width="21%"><?php echo $vender_name1;?></th>
       
       
    </tr>
    </table>
    
<table width="100%"  border="1" rules="all">
  
  <tr>
        <th  width="4%">Sl.No.</th>
        <th  width="53%">Item Description</th>
        <th  width="20%;" >Cost(<?php echo $getCurrency;?>)</th>
        <th  width="21%">Cost(<?php echo $getCurrency;?>)</th>
     
    </tr>
	<?php
    $i= 1;
    foreach($poproduct as $key =>$row)
    {   
	
		$pro_item_name            =   $row->pro_item_name;
		$cost                     =   $row->cost;
		$cost1                    =   $row->cost1;
		$cost2                    =   $row->cost2;
		$cost3                    =   $row->cost3;
		
    ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $pro_item_name;?></td>
        <td style="text-align: center;"><?php echo $cost;?></td>
        <td style="text-align: center;"><?php echo $cost1;?></td>
       
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
       
    </tr>
    <?php 
    }
    ?>
    
   
    <tr>
        <td colspan="2"><strong>Terms and Conditions</strong><br /><?php echo $this->pref->cost_terms;?></td>
        <td colspan="2" align="right">
        	For <strong><?php echo strtoupper($c_org_name);?></strong>
            <br />
            <br />
            <br />
            Authorized Signatory
        </td>
    </tr>
  </table>
  <?php }?>
  <!-- //Three Vendor -->
  <?php if($vender_name!=''&& $vender_name1!=''&& $vender_name2!='' && $vender_name3==''){?>
    <table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        
        <td style="width: 25%">
           <strong>PO No. : </strong><?php echo $co_no;?>
        </td>
    
        <td style="width: 34%">
           <strong>PO Date : </strong><?php echo date('d/m/Y', strtotime($order_date));?>
        </td>
   
        <td style="width: 41%">
           <strong>Ref No. : </strong><?php echo $ref_no;?>
        </td>
    </tr>
</table>
<table width="100%"  border="1" rules="all">
  
  <tr>
        <th  width="39%">Vender Name</th>
        <th  width="20%"><?php echo $vender_name;?></th>
        <th  width="21%"><?php echo $vender_name1;?></th>
        <th  width="21%"><?php echo $vender_name2;?></th>
       
       
    </tr>
    </table>
    
<table width="100%"  border="1" rules="all">
  
  <tr>
        <th  width="4%">Sl.No.</th>
        <th  width="32.1%">Item Description</th>
        <th  width="20.1%;" >Cost(<?php echo $getCurrency;?>)</th>
        <th  width="21%">Cost(<?php echo $getCurrency;?>)</th>
        <th  width="19.7%">Cost(<?php echo $getCurrency;?>)</th>
     
    </tr>
  <?php
    $i= 1;
    foreach($poproduct as $key =>$row)
    {   
  
    $pro_item_name            =   $row->pro_item_name;
    $cost                     =   $row->cost;
    $cost1                    =   $row->cost1;
    $cost2                    =   $row->cost2;
    $cost3                    =   $row->cost3;
    
    ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $pro_item_name;?></td>
        <td style="text-align: center;"><?php echo $cost;?></td>
        <td style="text-align: center;"><?php echo $cost1;?></td>
        <td style="text-align: center;"><?php echo $cost2;?></td>
       
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
       
    </tr>
    <?php 
    }
    ?>
    
   
    <tr>
        <td colspan="2"><strong>Terms and Conditions</strong><br /><?php echo $this->pref->po_notes;?></td>
        <td colspan="3" >
          For <strong><?php echo strtoupper($c_org_name);?></strong>
            <br />
            <br />
            <br />
            Authorized Signatory
        </td>
    </tr>
  </table>
  <?php }?>
  <!-- //Four Vendor -->
  <?php if($vender_name!=''&& $vender_name1!=''&& $vender_name2!='' && $vender_name3!=''){?>
    <table width="100%" cellspacing="5" cellpadding="5" border="1" rules="all">
    <tr>
        
        <td style="width: 25%">
           <strong>PO No. : </strong><?php echo $co_no;?>
        </td>
    
        <td style="width: 29%">
           <strong>PO Date : </strong><?php echo date('d/m/Y', strtotime($order_date));?>
        </td>
   
        <td style="width: 51%">
           <strong>Ref No. : </strong><?php echo $ref_no;?>
        </td>
    </tr>
</table>
<table width="100%"  border="1" rules="all">
  
  <tr>
        <th  width="39%">Vender Name</th>
        <th  width="15%"><?php echo $vender_name;?></th>
        <th  width="16%"><?php echo $vender_name1;?></th>
        <th  width="16%"><?php echo $vender_name2;?></th>
        <th  width="14%"><?php echo $vender_name3;?></th>
       
       
    </tr>
    </table>
    
<table width="100%"  border="1" rules="all">
  
  <tr>
        <th  width="6%">Sl.No.</th>
        <th  width="30%">Item Description</th>
        <th  width="14%;" >Cost(<?php echo $getCurrency;?>)</th>
        <th  width="15.4%">Cost(<?php echo $getCurrency;?>)</th>
        <th  width="14.7%">Cost(<?php echo $getCurrency;?>)</th>
          <th  width="13%">Cost(<?php echo $getCurrency;?>)</th>
     
    </tr>
  <?php
    $i= 1;
    foreach($poproduct as $key =>$row)
    {   
  
    $pro_item_name            =   $row->pro_item_name;
    $cost                     =   $row->cost;
    $cost1                    =   $row->cost1;
    $cost2                    =   $row->cost2;
    $cost3                    =   $row->cost3;
    
    ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $pro_item_name;?></td>
        <td style="text-align: center;"><?php echo $cost;?></td>
        <td style="text-align: center;"><?php echo $cost1;?></td>
        <td style="text-align: center;"><?php echo $cost2;?></td>
          <td style="text-align: center;"><?php echo $cost3;?></td>
       
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
        <td colspan="3"><strong>Terms and Conditions</strong><br /><?php echo $this->pref->po_notes;?></td>
        <td colspan="3" >
          For <strong><?php echo strtoupper($c_org_name);?></strong>
            <br />
            <br />
            <br />
            Authorized Signatory
        </td>
    </tr>
  </table>
  <?php }?>
</div>
