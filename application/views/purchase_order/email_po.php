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
	$con_phone            = $row->con_phone;
	$con_email            = $row->con_email;
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



	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="format-detection" content="telephone=no" /> <!-- disable auto telephone linking in iOS -->
		<title>Respmail is a response HTML email designed to work on all major email platforms and smartphones</title>
		<style type="text/css">
			/* RESET STYLES */
			html { background-color:#E1E1E1; margin:0; padding:0; }
			body, #bodyTable, #bodyCell, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;font-family:Helvetica, Arial, "Lucida Grande", sans-serif;}
			table{border-collapse:collapse;}
			table[id=bodyTable] {width:100%!important;margin:auto;max-width:500px!important;color:#7A7A7A;font-weight:normal;}
			img, a img{border:0; outline:none; text-decoration:none;height:auto; line-height:100%;}
			a {text-decoration:none !important;border-bottom: 1px solid;}
			h1, h2, h3, h4, h5, h6{color:#302d2d; font-weight:normal; font-family:Helvetica; font-size:15px; line-height:125%; text-align:Left; letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;}
			/* CLIENT-SPECIFIC STYLES */
			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail/Outlook.com to display emails at full width. */
			/*.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;} */
			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font,  .ExternalClass div{line-height:100%;} 

			/* Force Hotmail/Outlook.com to display line heights normally. */
			/*table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} */
			table{mso-table-lspace:0pt; mso-table-rspace:0pt;} 

			/* Remove spacing between tables in Outlook 2007 and up. */
			#outlook a{padding:0;} /* Force Outlook 2007 and up to provide a "view in browser" message. */
			img{-ms-interpolation-mode: bicubic;display:block;outline:none; text-decoration:none;} /* Force IE to smoothly render resized images. */
			/*body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;}*/
			body, table, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; font-weight:normal!important;}
			 /* Prevent Windows- and Webkit-based mobile platforms from changing declared text sizes. */
			.ExternalClass td[class="ecxflexibleContainerBox"] h3 {padding-top: 10px !important;} /* Force hotmail to push 2-grid sub headers down */
			/* /\/\/\/\/\/\/\/\/ TEMPLATE STYLES /\/\/\/\/\/\/\/\/ */
			/* ========== Page Styles ========== */
			h1{display:block;font-size:26px;font-style:normal;font-weight:normal;line-height:100%;}
			h2{display:block;font-size:20px;font-style:normal;font-weight:normal;line-height:120%;}
			h3{display:block;font-size:15px;font-style:normal;font-weight:bold;line-height:110%;}
			h4{display:block;font-size:18px;font-style:italic;font-weight:normal;line-height:100%;}
			.flexibleImage{height:auto;}
			.linkRemoveBorder{border-bottom:0 !important;}
			table[class=flexibleContainerCellDivider] {padding-bottom:0 !important;padding-top:0 !important;}
			body, #bodyTable{background-color:#E1E1E1;}
			#emailHeader{background-color:#E1E1E1;}
			#emailBody{background-color:#FFFFFF;}
			#emailFooter{background-color:#E1E1E1;}
			.nestedContainer{background-color:#F8F8F8; border:1px solid #CCCCCC;}
			.emailButton{background-color:#205478; border-collapse:separate;}
			.buttonContent{color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;}
			.buttonContent a{color:#FFFFFF; display:block; text-decoration:none!important; border:0!important;}
			.emailCalendar{background-color:#FFFFFF; border:1px solid #CCCCCC;}
			.emailCalendarMonth{background-color:#205478; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; padding-top:10px; padding-bottom:10px; text-align:center;}
			.emailCalendarDay{color:#205478; font-family:Helvetica, Arial, sans-serif; font-size:60px; font-weight:bold; line-height:100%; padding-top:20px; padding-bottom:20px; text-align:center;}
			.imageContentText {margin-top: 10px;line-height:0;}
			.imageContentText a {line-height:0;}
			#invisibleIntroduction {display:none !important;} /* Removing the introduction text from the view */
			/*FRAMEWORK HACKS & OVERRIDES */
			span[class=ios-color-hack] a {color:#275100!important;text-decoration:none!important;} /* Remove all link colors in IOS (below are duplicates based on the color preference) */
			span[class=ios-color-hack2] a {color:#e1e1e1!important;text-decoration:none!important;}
			span[class=ios-color-hack3] a {color:#8B8B8B!important;text-decoration:none!important;}
			/* A nice and clean way to target phone numbers you want clickable and avoid a mobile phone from linking other numbers that look like, but are not phone numbers.  Use these two blocks of code to "unstyle" any numbers that may be linked.  The second block gives you a class to apply with a span tag to the numbers you would like linked and styled.
			Inspired by Campaign Monitor's article on using phone numbers in email: http://www.campaignmonitor.com/blog/post/3571/using-phone-numbers-in-html-email/.
			*/
			.a[href^="tel"], a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:none!important;cursor:default!important;}
			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {text-decoration:none!important;color:#606060!important;pointer-events:auto!important;cursor:default!important;}
			/* MOBILE STYLES */
			@media only screen and (max-width: 480px){
				/*////// CLIENT-SPECIFIC STYLES //////*/
				body{width:100% !important; min-width:100% !important;} /* Force iOS Mail to render the email at full width. */
				/* FRAMEWORK STYLES */
				/*
				CSS selectors are written in attribute
				selector format to prevent Yahoo Mail
				from rendering media query styles on
				desktop.
				*/
				/*td[class="textContent"], td[class="flexibleContainerCell"] { width: 100%; padding-left: 10px !important; padding-right: 10px !important; }*/
				table[id="emailHeader"],
				table[id="emailBody"],
				table[id="emailFooter"],
				table[class="flexibleContainer"],
				td[class="flexibleContainerCell"] {width:100% !important;}
				td[class="flexibleContainerBox"], td[class="flexibleContainerBox"] table {display: block;width: 100%;text-align: left;}
				/*
				The following style rule makes any
				image classed with 'flexibleImage'
				fluid when the query activates.
				Make sure you add an inline max-width
				to those images to prevent them
				from blowing out.
				*/
				td[class="imageContent"] img {height:auto !important; width:100% !important; max-width:100% !important; }
				img[class="flexibleImage"]{height:auto !important; width:100% !important;max-width:100% !important;}
				img[class="flexibleImageSmall"]{height:auto !important; width:auto !important;}
				/*
				Create top space for every second element in a block
				*/
				table[class="flexibleContainerBoxNext"]{padding-top: 10px !important;}
				/*
				Make buttons in the email span the
				full width of their container, allowing
				for left- or right-handed ease of use.
				*/
				table[class="emailButton"]{width:100% !important;}
				td[class="buttonContent"]{padding:0 !important;}
				td[class="buttonContent"] a{padding:15px !important;}
			}
			/*  CONDITIONS FOR ANDROID DEVICES ONLY
			*   http://developer.android.com/guide/webapps/targeting.html
			*   http://pugetworks.com/2011/04/css-media-queries-for-targeting-different-mobile-devices/ ;
			=====================================================*/
			@media only screen and (-webkit-device-pixel-ratio:.75){
				/* Put CSS for low density (ldpi) Android layouts in here */
			}
			@media only screen and (-webkit-device-pixel-ratio:1){
				/* Put CSS for medium density (mdpi) Android layouts in here */
			}
			@media only screen and (-webkit-device-pixel-ratio:1.5){
				/* Put CSS for high density (hdpi) Android layouts in here */
			}
			/* end Android targeting */
			/* CONDITIONS FOR IOS DEVICES ONLY
			=====================================================*/
			@media only screen and (min-device-width : 320px) and (max-device-width:568px) {
			}
			/* end IOS targeting */

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
    border-color: #f0f0f0;
  }
  .br_none_b
  {
    border-bottom:none;
  }
  .h4
  {
    font-size:16px;
  }

     td
  {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	font-style: normal;
	font-variant: normal;
	font-weight: 400;
	line-height: 20px;
	vertical-align: top;
  }

  .im {
    color: #fff;
}
.fa {
  display: inline-block;
  font: normal normal normal 14px/1 FontAwesome;
  font-size: inherit;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  transform: translate(0, 0);
}
		</style>
		<!--
			Outlook Conditional CSS
			These two style blocks target Outlook 2007 & 2010 specifically, forcing
			columns into a single vertical stack as on mobile clients. This is
			primarily done to avoid the 'page break bug' and is optional.
			More information here:
			http://templates.mailchimp.com/development/css/outlook-conditional-css
		-->
		<!--[if mso 12]>
			<style type="text/css">
				.flexibleContainer{display:block !important; width:100% !important;}
			</style>
		<![endif]-->
		<!--[if mso 14]>
			<style type="text/css">
				.flexibleContainer{display:block !important; width:100% !important;}
			</style>
		<![endif]-->

	</head>
	<body bgcolor="#E1E1E1" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">

		<!-- CENTER THE EMAIL // -->
		<!--
		1.  The center tag should normally put all the
			content in the middle of the email page.
			I added "table-layout: fixed;" style to force
			yahoomail which by default put the content left.
		2.  For hotmail and yahoomail, the contents of
			the email starts from this center, so we try to
			apply necessary styling e.g. background-color.
		-->
		<center style="background-color:#E1E1E1;">


			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;">
				<tr>
					<td align="center" valign="top" id="bodyCell">

						<!-- EMAIL HEADER // -->
						<!--
							The table "emailBody" is the email's container.
							Its width can be set to 100% for a color band
							that spans the width of the page.
						-->


						<!-- // END -->

						<!-- EMAIL BODY // -->
						<!--
							The table "emailBody" is the email's container.
							Its width can be set to 100% for a color band
							that spans the width of the page.
						-->
						<table bgcolor="#FFFFFF"  border="0" cellpadding="0" cellspacing="0" width="800" id="emailBody" style="background-color: #f0f0f0;    margin-top: -20px;">

							<!-- MODULE ROW // -->
							<!--
								To move or duplicate any of the design patterns
								in this email, simply move or copy the entire
								MODULE ROW section for each content block.
							-->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<!--
										The centering table keeps the content
										tables centered in the emailBody table,
										in case its width is set to 100%.
									-->





									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;" bgcolor="#47001A">
										<tr>
											<td  valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<!--
													The flexible container has a set width
													that gets overridden by the media query.
													Most content tables within can then be
													given 100% widths.
												-->


												<table border="0" cellpadding="0" cellspacing="0" style="width: 94%;margin: 0px 3px;"class="flexibleContainer">
													<tr>
														<td  align="center" valign="top" style="width: 29%;">

															<!-- CONTENT TABLE // -->
															<!--
															The content table is the first element
																that's entirely separate from the structural
																framework of the email.
															-->

															<table border="0" cellpadding="0"  cellspacing="0" width="100%">
															  	<tr>
															  	  	<td valign="left" width="200"><img src="<?php echo base_url().$c_logo;?>" height="50" style="padding: 20px 15px 0px 0px;"/></td>
															      	<td class="br_none_r" valign="middle" style="color:#FFFFFF;">
															          <h2 style="margin-bottom:0;padding-top:20px;color:#FFFFFF;"><?php echo strtoupper($c_org_name);?></h2>
															          <?php echo $c_street;?><br /> <?php echo ($c_area!='') ? $c_area.'<br />' : '';?>
															          <?php echo $c_city;?>, <br /><?php echo $c_state;?> <?php echo $c_pincode;?> <br />
																	  <?php echo $c_country;?><br />
															      	</td>
															      	<td valign="right" valign="top" style="color:#FFFFFF;">
															      	  <?php echo (trim($c_mobile) != '') ? '<br /><br /><strong>Mobile</strong>: '.$c_mobile : '';?>
															          <?php echo (trim($c_phone) != '') ? '<br /><strong>Phone</strong>: '.$c_phone : '';?>
															          
															          <?php echo (trim($c_fax) != '') ? '<br /><strong>Skype</strong> : '.$c_fax : '';?>
															          <?php echo (trim($c_website) != '') ? '<br /><strong>Website</strong> : '.$c_website : '';?>
															      	</td>
															    </tr>
															</table>
															<hr />

															<h1 valign="left" style="text-center: center;color:#FFFFFF;">PURCHASE ORDER</h1>
															
															<!-- // CONTENT TABLE -->

														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // MODULE ROW -->


							<!-- MODULE ROW // -->
							<!--  The "mc:hideable" is a feature for MailChimp which allows
								you to disable certain row. It works perfectly for our row structure.
								http://kb.mailchimp.com/article/template-language-creating-editable-content-areas/
							-->
							<tr mc:hideable>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->


												<table border="0" cellpadding="0" cellspacing="0"  class="flexibleContainer" style="margin: 20px 0px 0px 0px; width: 98%;background: #f0f0f0;">
													<tr>
														<td valign="top" class="flexibleContainerCell">

															<!-- CONTENT TABLE // -->

															<table cellspacing="5" cellpadding="5" border="1" rules="all" style="width: 94%;">
															    <tr>
															        <td colspan="3" rowspan="3" class="br_none_l" style="width:33%">
															           <strong>To : </strong></br>
															              <h3 style="margin:0;"><?php echo $con_primary;?></h3>
															              <?php echo $con_company_name;?></br>
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
															              <h3 style="margin:0;"><?php echo $con_company_name;?></h3>
															              <?php echo $contact_address;?><br>
															              <?php echo ($contact_area!='') ? $contact_area.'<br />' : '';?>
															              <?php echo $contact_city;?><br/>
															              <?php echo $contact_state.' '.$contact_zip;?>
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


															
															<!-- // CONTENT TABLE -->

														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // MODULE ROW -->

							<!-- MODULE ROW // -->
							<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F8F8F8" style="background-color: #f0f0f0;">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<table border="0" cellpadding="0" cellspacing="0" style="margin-top: -1px; padding:0px 0px 0px 0px;width: 98%;" class="flexibleContainer">
													<tr>
														<td valign="top" class="flexibleContainerCell">
															<table border="0" cellspacing="0"  style="    margin-top: -1px; padding:0px 0px 0px 0px;width: 94%;">
																<tr>
																	<td align="center" valign="top">

																		<table style="width: 100%;" cellspacing="5" cellpadding="5" border="1" rules="all">
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
																		    foreach($poproduct as $key =>$row)
																		    {   
																				$pro_item_id              =   $row->pro_item_id;
																				$pro_item_name            =   $row->pro_item_name;
																				$unit_name                =   $row->unit_name;
																				$pieces_per_unit          =   $row->pieces_per_unit;
																				$selling_price            =   $row->selling_price;
																				$quantity                 =   $row->quantity;
																				$recd_qty                 =   $row->recd_qty;
																				$price_amt                =   $row->price_amt;
																				$pdt_tax_amt              =   $row->pdt_tax_amt;
																				$amount                   =   $row->amount; 
																				$pro_item_name            =   $row->pro_item_name;
																				$cost_price               =   $row->cost_price;
																				$cost_tax_amount          =   $row->cost_tax_amount;
																				$selling_tax_amount       =   $row->selling_tax_amount;
																				$selling_total_amount     =   $row->selling_total_amount;
																				$selling_total_amount1   +=   $row->selling_total_amount;
																				$cost_total_amount        =   $row->cost_total_amount;
																				$cost_total_amount1      +=   $row->cost_total_amount;
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
																		        <td class="br_none_t br_none_b" style="border-bottom-color: #f0f0f0;"></td>
																		        <td class="br_none_t br_none_b"style="border-bottom-color: #f0f0f0;"></td>
																		        <td class="br_none_t br_none_b"style="border-bottom-color: #f0f0f0;"></td>
																		        <td class="br_none_t br_none_b"style="border-bottom-color: #f0f0f0;"></td>
																		        <td class="br_none_t br_none_b"style="border-bottom-color: #f0f0f0;"></td>
																		        <td class="br_none_t br_none_b"style="border-bottom-color: #f0f0f0;"></td>
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
																		        	<strong><?php echo $getCurrency;?> <?php echo number_format($row->cost_tax, 2, '.', '');?></strong>
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

																		

																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									</table>
									<!-- // CENTERING TABLE -->
								</td>
							</tr>
							<!-- // MODULE ROW -->


							<!-- MODULE ROW // -->

						</table>
						<!-- // END -->

						<!-- EMAIL FOOTER // -->
						<!--
							The table "emailBody" is the email's container.
							Its width can be set to 100% for a color band
							that spans the width of the page.
						-->
						<table bgcolor="#E1E1E1" border="0" cellpadding="0" cellspacing="0" width="500" id="emailFooter">

							<!-- FOOTER ROW // -->
							<!--
								To move or duplicate any of the design patterns
								in this email, simply move or copy the entire
								MODULE ROW section for each content block.
							-->
							<!--<tr>
								<td align="center" valign="top">
									<!-- CENTERING TABLE // -->
									<!--<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td align="center" valign="top">
												<!-- FLEXIBLE CONTAINER // -->
												<!--<table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
													<tr>
														<td align="center" valign="top" width="500" class="flexibleContainerCell">
															<table border="0" cellpadding="30" cellspacing="0" width="100%">
																<tr>
																	<td valign="top" bgcolor="#E1E1E1">

																		<div style="font-family:Helvetica,Arial,sans-serif;font-size:13px;color:#828282;text-align:center;line-height:120%;">
																			<div>Copyright &#169; 2014 <a href="http://www.charlesmudy.com/respmail/" target="_blank" style="text-decoration:none;color:#828282;"><span style="color:#828282;">Respmail</span></a>. All&nbsp;rights&nbsp;reserved.</div>
																			<div>If you do not want to recieve emails from us, you can <a href="#" target="_blank" style="text-decoration:none;color:#828282;"><span style="color:#828282;">unsubscribe</span></a>.</div>
																		</div>

																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>-->
												<!-- // FLEXIBLE CONTAINER -->
											</td>
										</tr>
									<!--</table>-->
									<!-- // CENTERING TABLE -->
								</td>
							</tr>

						</table>
						<!-- // END -->

					</td>
				</tr>
			</table>
		</center>
	</body>
</html>

<?php //exit();?>