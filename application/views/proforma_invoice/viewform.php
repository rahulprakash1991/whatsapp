<?php
$CI = & get_instance();

if(isset($value) )
{
	
		foreach($value->result() as $row) //Proforma Invoice Data
		{
			$sal_id 					=	$row->per_sal_id;
			$sal_company_name 			=	$row->per_sal_company_name; 
			$sal_order 		=	$row->per_sal_order; 
			$sal_order_date 		=	$row->per_sal_order_date; 
			$sal_invoice_status = $row->per_sal_invoice_status;
			$po_no = $row->po_num;
			$payment_term = $row->payment_term;
			$sal_client_rep = $row->per_sal_client_rep;
			$discount = $row->per_sal_discount;
			$sub_total = $row->per_sal_sub_total;
			$grand_total = $row->per_sal_grand_total;
			$vat_amount = $row->per_sal_tax_amount;
			$remarks = $row->remarks;
			$client_bank = $row->sal_bank;
			$our_ref = $row->our_ref;

		}

		foreach($evalue as $key =>$row)
		{
			$item[$key] 			=	$row->item_description;
			$itemarabic[$key] 			=	$row->item_description_arabic;
			$nationality[$key]		= $row->nationality;
			$total_no[$key] 			=	$row->total;
			$t_hour[$key] 			=	$row->total_hour;
			$r_hour[$key] 	=	$row->rate_hour;
			$total_amont[$key] 			=	$row->total_cost;
			$uniteng[$key]		= $row->uniteng;
			$unitarabic[$key] 			=	$row->unitarabic;
			$qty[$key] 			=	$row->qty;
			$unit_price[$key] 	=	$row->unit_price;
			$slno[$key] 	=	$row->sl_no;
			$trow++;		
		}	
}
else
{	
		$sal_invoice_status = 0;
		$pro_id						= 	$this->input->post('pro_id');
		$sal_id						= 	$this->input->post('sal_id');

		$sal_reference_date			= 	$this->input->post('sal_reference_date');
		$sal_despatch				= 	$this->input->post('sal_despatch');
		$discount					= 	$this->input->post('discount');
		$sal_destination			=	$this->input->post('sal_destination');
		$sal_terms_delivery			=	$this->input->post('sal_terms_delivery');
		$sal_payment_terms			=	$this->input->post('sal_payment_terms');
		$sal_credit_period			=	$this->input->post('sal_credit_period');
		$sal_company_name			= 	$this->input->post('sal_company_name');
		$sal_customer_address		= 	$this->input->post('sal_customer_address');
		$order_date					=	$this->input->post('order_date');
		$del_date					=	$this->input->post('del_date');
		$ref_no						=	$this->input->post('ref_no');
		$ship_pref_id				=	$this->input->post('ship_pref_id');
		$po_status     				= 	$this->input->post('po_status');
		$sal_delivery_method     	= 	$this->input->post('sal_delivery_method');
		$sal_person     			= 	$this->input->post('sal_person');
		$shipping_amount     		= 	$this->input->post('shipping_amount');
		$sal_reference     			= 	$this->input->post('sal_reference');
		$pro_item_id				=	$this->input->post('pro_item_id');
		$unit1 						=	$this->input->post('unit1');
		$available_qty				= 	$this->input->post('available_qty');
		$quantity     				= 	$this->input->post('quantity');
		$price_amt					=	$this->input->post('price_amt');
		$sal_tax_percentage			=	$this->input->post('sal_tax_percentage');
		$amount     				= 	$this->input->post('amount');
		$sub_total					=	$this->input->post('sub_total');
		$tot_tax_val				=	$this->input->post('tot_tax_val');
		$total 	     				= 	$this->input->post('total');
		$tax_percent 				= 	$this->input->post('tax_percent');
		$tax_name 	  			    = 	$this->input->post('tax_name');
		$total_tax_amt 	  			= 	$this->input->post('total_tax_amt');
		$tax_id 	   				= 	$this->input->post('tax_id');
		$payment_status 	   		= 	$this->input->post('payment_status');
		$tax_type 	   				= 	explode(',',$this->input->post('tax_type'));
		$total_tax_amts				= 	explode(',',$this->input->post('total_tax_amt'));
		$trow						=	$this->input->post('attproduct');
}
	
	$i = 1;
	$trow = ($trow=='') ? 1 : $trow;

foreach ($tax_type as $key => $value)
{
	$total_tax_amt[$value] = $total_tax_amts[$key];

}
foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
$getCurrency=$this->pre->getCurrencynew();
?>
<style type="text/css">
	.radio {
  margin: 0.5rem;
  input[type="radio"] {
    position: absolute;
    opacity: 0;
    + .radio-label {
      &:before {
        content: '';
        background: $color1;
        border-radius: 100%;
        border: 1px solid darken($color1, 25%);
        display: inline-block;
        width: 1.4em;
        height: 1.4em;
        position: relative;
        top: -0.2em;
        margin-right: 1em; 
        vertical-align: top;
        cursor: pointer;
        text-align: center;
        transition: all 250ms ease;
      }
    }
    &:checked {
      + .radio-label {
        &:before {
          background-color: $color2;
          box-shadow: inset 0 0 0 4px $color1;
        }
      }
    }
    &:focus {
      + .radio-label {
        &:before {
          outline: none;
          border-color: $color2;
        }
      }
    }
    &:disabled {
      + .radio-label {
        &:before {
          box-shadow: inset 0 0 0 4px $color1;
          border-color: darken($color1, 25%);
          background: darken($color1, 25%);
        }
      }
    }
    + .radio-label {
      &:empty {
        &:before {
          margin-right: 0;
        }
      }
    }
  }
}
</style>
			<div class="page-inner">
				<div class="page-title">
					<h3><?PHP echo $form_toptittle; ?></h3>
					<div class="page-breadcrumb">
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url();?>">Home</a></li>
							<li class="active"><?PHP echo $form_toptittle; ?></li>
						</ol>
					</div>
				</div>
				<div id="main-wrapper">

				<?php
				 if($notification)
					{
					?>
					<div class="alert alert-success no-border successmessage">
						<span class="text-semibold"> <?php echo $notification;?></span>
					</div>
					<?php
				}
				?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
									<h4 class="panel-title"><?PHP echo $form_tittle; ?></h4>
								</div>
								<div class="panel-body">
									<?php echo form_open_multipart($form_url); ?>
									<div class="row">
									 	<div class="col-md-5">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('sal_company_name')){ echo 'has-error';} ?>">
													<label>Client Name<span1>*</span1></label>
				                               	 	<?php
				                               	 	
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_company_name" onChange="loadaddress(this.value)"';
													echo form_dropdown('sal_company_name', $drop_menu_client, set_value('sal_company_name', (isset($sal_company_name)) ? $sal_company_name : ''), $attrib);
													?>
													 <label class="error"><?php echo form_error('sal_company_name'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                      		<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('sal_client_rep')){ echo 'has-error';} ?>">
													<label>Client Representative</label>
				                               	 	<?php 
				                               	 	$drop_menu_address 	=	$CI->sal_common->drop_menu_client_rep($sal_company_name);
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_client_rep" ';
													echo form_dropdown('sal_client_rep', $drop_menu_address, set_value('sal_client_rep', (isset($sal_client_rep)) ? $sal_client_rep : ''), $attrib);
													?>
													 <label class="error"><?php echo form_error('sal_client_rep'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                      	 		<div class="col-md-2">
			                      			
					                       		
				                        	
       			      					</div>
       			      					 <div class="col-md-2">
											
										</div>
				                     
				                    </div>
				                    <!--  Updated By Rahul 2022 -->

				                    <div class="row">
									 <div class="col-md-3">
	                                   	<div class="form-group">
	                                   		<?php if($company_abb=="NH" || $company_abb=="SLH"||$company_abb=="ARA"){?>
											 <label class="control-label">P.O. No</label>
									           <input name="po_no"  class="form-control " id="po_no" type="text" value="<?php echo $po_no; ?>" placeholder="PO No "/> 
									             <?php }?>
					       			    </div>
					       			    </div>
					       			                        
					       			   <div class="col-md-3">
	                                   	<div class="form-group">
	                                   		<?php if($company_abb=="NH" || $company_abb=="SLH"||$company_abb=="ARA"){?>
											<label class="control-label">Payment Terms</label>
									            <?php 	
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="payment_term" ';
													echo form_dropdown('payment_term', $drop_menu_payment_terms, set_value('payment_term', (isset($payment_term)) ? $payment_term : ''), $attrib);
													?>
												<?php }?>
					       			    </div>
					       			    </div>	
					       			    <div class="col-md-3">
	                                   	<div class="form-group">
	                                   		<?php if($company_abb=="ARA"){?>
											<label class="control-label">Our Ref</label>
									         <input name="our_ref"  class="form-control " id="our_ref" type="text" value="<?php echo $our_ref; ?>" placeholder="Our Ref "/> 
									         <?php }?>
					       			    </div>
					       			   </div>
					       			     <div class="col-md-3">
                                           <div class="form-group <?PHP if(form_error('client_bank')){ echo 'has-error';} ?>">
                                                <label><?php echo 'Bank';?></label>
                                                <?php 
                                                            $attrib = 'class="form-control" data-live-search="true" data-width="100%" id="client_bank" ';
                                                         echo form_dropdown('client_bank', $drop_menu_bank, set_value('client_bank', (isset($client_bank)) ? $client_bank : ''), $attrib);
                                                          ?>
                                            
                                                 <label class="error"><?php echo form_error('client_bank'); ?></label>
                                            </div>
                                        </div>
				                    </div>
				                 
									
							
									<legend style="padding-top: 0px;padding-bottom:0px;"></legend>     
									<div >
							<div class="row">
								  <?php if($company_abb=="SLH"){?>
                                <div class="col-md-1">
                                    <center><label><strong>Sl No</strong></label></center>
                                </div>
                            <?php }?>
                                <div class="col-md-3" style="padding-left: 26px;">
                                    <label><strong>Description in English</strong></label>
                                </div>
                                 <div class="col-md-3" style="padding-left: 26px;">
                                    <label><strong>Description in Arabic</strong></label>
                                </div>
                                <!--<div class="col-md-1">
                                    <center><label><strong>Unit</strong></label></center>
                                </div>-->
                              <?php if($company_abb=="LCK"){?>
                                <div class="col-md-1">
                                    <center><label><strong>Nationality</strong></label></center>
                                </div>
                         
                                <div class="col-md-1" >
                                    <center><label><strong>Total#</strong></label></center>
                                </div>
                                <div class="col-md-1">
                                    <center><label><strong>T/hrs#</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Rate/hrs</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Total#</strong></label></center>
                                </div>
                                   <?php }?>  
                                    <?php if($company_abb=="NH" || $company_abb=="ARA"){?>
                              
                         
                                <div class="col-md-1" >
                                    <center><label><strong>Unit</strong></label></center>
                                </div>
                                <div class="col-md-1">
                                    <center><label><strong>Qty</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Unit Price</strong></label></center>
                                </div>
                                <div class="col-md-2" >
                                    <center><label><strong>Total Amount</strong></label></center>
                                </div>
                                   <?php }?>   
                                   <?php if($company_abb=="SLH"){?>
                            
                                <div class="col-md-1">
                                    <center><label><strong>Qty</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Unit Price</strong></label></center>
                                </div>
                                <div class="col-md-2" >
                                    <center><label><strong>Total Amount</strong></label></center>
                                </div>
                                   <?php }?>                                      
                            </div>
						</div>

									<!-- <legend style="padding-top: 0px;padding-bottom:0px;"></legend> -->
                      			 <div class="row">                 
                        		<span id="partProductData">
                                <?php 
                                $is=1;
                                for($i=0; $i < $trow; $i++)
						        {

                                    ?>
                                 <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
                                 	   <?php if($company_abb=="SLH"){?>
                                 
                               
                                    <div class="col-md-1">
                                    	<div class="row">
	                                        <div class="form-group">
	                                      
	                                            <input type="text" name="slno[]"  autocomplete="off" class="form-control total_no" id="slno<?php echo $i;?>" value="<?php echo $slno[$i];?>"  placeholder="Sl No">
	                                        </div>
	                                    
	                                    </div>
                                    </div>
                                	<?php }?>
                                    <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control " onkeyup="CheckClientSelect();"  rows="2" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>">
                                            </div>                                      
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('itemarabic['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="itemarabic'.$i.'" name="itemarabic[]" autocomplete="off" class="form-control " rows="2" style="min-height: 1px;text-align:right;"><?php echo $itemarabic[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('itemarabic['.$i.']'); ?></label>
                                        </div>                   
                                                                           
                                    </div>

                                      <?php if($company_abb=="LCK"){?>
                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('nationality['.$i.']')){ echo 'has-error';} ?>">
                                            <input name="nationality[]" autocomplete="off" class="form-control nationality" id="nationality<?php echo $i;?>" type="text" value="<?php echo $nationality[$i]; ?>" on placeholder="Nationality"/>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('nationality['.$i.']'); ?></label>
                                        </div>
                                    </div>
                               
                                    <div class="col-md-1">
                                        <div class="form-group">
                                      
                                            <input type="text" name="total_no[]"  autocomplete="off" class="form-control total_no" id="total_no<?php echo $i;?>" value="<?php echo $total_no[$i];?>"  placeholder="Total No">
                                        </div>
                                    </div>      

                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('t_hour[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="t_hour[]" autocomplete="off" class="form-control t_hour" id="t_hour<?php echo $i;?>" type="text" value="<?php echo $t_hour[$i]; ?>"  placeholder=" Time/Hour "  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('t_hour[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="r_hour[]"  class="form-control r_hour" onkeyup="calculate();" id="r_hour<?php echo $i;?>" type="text" value="<?php echo $r_hour[$i]; ?>" placeholder="Rate/Hour" /> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 
                                             
                                        </div>
                                    </div>
                                <?php } ?>
                                 <?php if($company_abb=="NH" || $company_abb=="ARA"){?>
                                 
                               
                                    <div class="col-md-1">
                                    	<div class="row">
	                                        <div class="form-group">
	                                      
	                                            <input type="text" name="uniteng[]"  autocomplete="off" class="form-control total_no" id="uniteng<?php echo $i;?>" value="<?php echo $uniteng[$i];?>"  placeholder="Unit ">
	                                        </div>
	                                       
	                                    </div>
                                    </div>      

                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('qty[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="qty[]" autocomplete="off" class="form-control qty" id="qty<?php echo $i;?>" type="text" value="<?php echo $qty[$i]; ?>"  placeholder=" Qty"  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('qty[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="unit_price[]"  class="form-control unit_price" onkeyup="calculate1();" id="unit_price<?php echo $i;?>" type="text" value="<?php echo $unit_price[$i]; ?>" placeholder="Unit Price" /> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                                <?php } ?>
                                 <?php if($company_abb=="SLH"){?>
                                 
                                    

                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('qty[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="qty[]" autocomplete="off" class="form-control qty" id="qty<?php echo $i;?>" type="text" value="<?php echo $qty[$i]; ?>"  placeholder=" Qty"  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('qty[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="unit_price[]"  class="form-control unit_price" onkeyup="calculate1();" id="unit_price<?php echo $i;?>" type="text" value="<?php echo $unit_price[$i]; ?>" placeholder="Unit Price" /> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                                <?php } ?>
                                 
                                    <div class="col-md-1"> 
                                       
                                        <span>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($sal_item_id[$i]!='') ? ','.$sal_item_id[$i] : '';?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </span> 
                                    </div>
                                </div>
                                <?php 
                                $is++; 
                                } 
                                ?>
                                </span>                       		 
                        </div>
                                                
                        <div class="row">
                        	<div class="col-md-12">
                       			<div class="col-md-3">
                       				 <a onclick="addNewPart()" class="label label-danger" > <span style="font-size: 16px;text-align: center;width: 100%;height: 500px;vertical-align: middle;">Add New</span> </a>    
                                    <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" /><br><br>
                                </div>
                                <div class="col-md-9 text-right">
                                   
                                </div>
                            </div>
                      	</div>
	                                     <hr style="margin: 5px 0 !important;">
                        				<div class="clearfix"></div>
                        				 <div class="row">
                                   				<div class="col-md-12">
                                   					<div class="row">
                                   						<div class="col-md-8">
															<div class="col-md-12">
	                                   						
	                                   								 
	                                   			



	<div class="form-group">
	                                   								  <?php if($company_abb=="NH" || $company_abb=="SLH"||$company_abb=="ARA"){?>
																	<label class="control-label">Remarks</label>
									             						
                                                  <textarea id="remarks" name="remarks" autocomplete="off" class="form-control " rows="4" style="min-height: 1px;"><?php echo $remarks;?></textarea>
                                              <?php }?>
					       			                            </div>

					       			                            
					       			                        </div>
					       			                        
					       			                       <div class="col-md-3">
	                                   			<div class="form-group <?PHP if(form_error('sal_order')){ echo 'has-error';} ?>">
					                            		<label>Proforma Number</label>
					                           			  <input type="text" class="form-control"  placeholder="Proforma Number" autocomplete="off" id="sal_order" name="sal_order" value="<?php echo $sal_order;?>" readonly>
					                           	 		 <label class="error"><?php echo form_error('sal_order'); ?></label>
				                        		</div>
					       			                        </div>	
					       			                        <div class="col-md-3">
	                                   						
	                                   				                         				
				<div class="form-group <?PHP if(form_error('sal_order_date')){ echo 'has-error';} ?>">
												<label>Proforma Date <span1>*</span1></label>
											
												<input type="text" class="form-control " placeholder="Proforma Date" autocomplete="off" value="<?php echo ($sal_order_date!='' && $sal_order_date!='0000-00-00') ? $sal_order_date : date('m/d/Y h:i:sa'); ?>" name="sal_order_date" id="sal_order_date"   readonly >
												<label class="error"><?php echo form_error('sal_order_date'); ?></label>
											</div>
					       			                          
					       			                        </div>

					       			                       <div class="col-md-4">
	          




					       			                        </div>					       			                       
                                   						</div>
                                   						<div class="col-md-4">
				                                   			 <div class="col-md-4 text-right" >
					                                        	<!-- <label class="control-label">Sub Total(<?php echo $getCurrency;?>)</label>
 -->					                                         </div>
																	 <div class="col-md-6">
																		<!-- <div class="form-group">
									                               			 <input type="text" name="sub_total" class="form-control sub_total" value="<?php echo $sub_total; ?>" id="sub_total" readonly  >
					       			                           			 </div> -->
					       			                        		</div>
					       			                        	<div class="col-md-4 text-right" >
					                                        	<!-- <label class="control-label">Discount(<?php echo $getCurrency;?>)</label> -->
					                                            </div>
																	 <div class="col-md-6">
																		<div class="form-group">
									                               			 <!-- <input type="text" name="discount" autocomplete="off" class="form-control discount" value="<?php echo $discount; ?>" id="discount" onkeyup="calculate();" onblur="calculate();" > -->
					       			                           			 </div>
					       			                        		</div>
                                   						<!-- <?php
											           foreach ($drop_menu_tax1 as $row)
											           {						            
											            ?> 
                                   							<div class="col-md-4 text-right" >
	                                        					<label class="control-label"><?php echo $row->tax_name;?>(<?php echo $getCurrency;?>)</label>
	                                        				</div>
					                                        <div class="col-md-6">
																<div class="form-group">		
																	<input name="total_tax_amt[]" class="form-control total_tax_amt" id="total_tax_amt<?php echo $row->tax_id;?>" type="text" value="<?php echo $total_tax_amt[$row->tax_id];?>" required readonly/>
		       			                           					<input name="tax_type[]" class="form-control tax_type" id="tax_type<?php echo $row->tax_id;?>" type="hidden" size="75" value="<?php echo $row->tax_id;?>" >   
		       			                            			</div>
					       			                        </div>
											            <?php
											            }
										            ?> -->
										            <div class="col-md-4 text-right" >
	                                        					<label class="control-label">Sub Total (<?php echo $getCurrency;?>)</label>
	                                        				</div>
					                                        <div class="col-md-6">
																<div class="form-group">
									                                 <input type="text" name="sub_t" autocomplete="off" class="form-control sub_total" value="<?php echo $sub_total;?>"id="sub_t"    >
					       			                            </div>
					       			                        </div>
					       			                      
					       			                        <div class="col-md-4 text-right" >
	                                        					<label class="control-label">Vat Amount (<?php echo $getCurrency;?>)</label>
	                                        				</div>
					                                        <div class="col-md-6">
																<div class="form-group">
									                                 <input type="text" name="vat_amount" autocomplete="off" class="form-control sub_total" placeholder="0.00" value="<?php echo $vat_amount;?>"id="vat_amount"    >
					       			                            </div>
					       			                        </div>
										            		<div class="col-md-4 text-right" >
	                                        					<label class="control-label">Total (<?php echo $getCurrency;?>)</label>
	                                        				</div>
					                                        <div class="col-md-6">
																<div class="form-group">
									                                 <input type="text" name="total" class="form-control" value="<?php echo $grand_total;?>" id="total" readonly  >
					       			                            </div>
					       			                        </div>
										            </div>
                                   				</div>
                                   			</div>
                                   		</div>

                                   	<!-- 	<div class="row">
                                   		 	<div class="col-md-2">
                                   				<div class="checkbox <?PHP if(form_error('sal_invoice_status')){ echo 'has-error';} ?>">
                                   					<label>                                                  
                                                     		<span class="">	                                                      	
	                                                      		<input type="radio" name="sal_invoice_status" value="0" <?php if($sal_invoice_status=='0' || empty($sal_invoice_status)){echo "checked";}?>  onChange="GetInvoiceDraft();">
	                                                      	</span>                                          	
                                                     	Save As Draft
                                                     </label> 
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                   				<div class="checkbox <?PHP if(form_error('sal_invoice_status')){ echo 'has-error';} ?>">
                                   					<label>                                                  
                                                        <span class="">
                                                            <input type="radio" name="sal_invoice_status" value="1" <?php if($sal_invoice_status=='1' ){echo "checked";}?> onChange="GetInvoiceNo();"  >
                                                        </span>                                          	
                                                     	 Save As Invoice
                                                     </label> 
                                                </div>
                                            </div>
                                        

                                        
                                            <br />
                                        </div> -->
                                        <hr>
                                   	<div class="row">
        								<div class="text-left" style="margin-left: 25px;">
        									 <input type="hidden" name="company_abb" id="company_abb" value="<?php echo $company_abb;?>" /> 
					                      <input type="hidden" name="sal_id" id="sal_id" value="<?php echo $sal_id;?>" />  
					                      <input type="hidden" name="pro_id" id="pro_id" value="<?php echo $pro_id;?>" />  
					                      <input type="hidden" name="po_status" value="1" />      
					                      <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($sal_id!='' ? 'Update ' : 'Create '); ?> </button>
					                       <a href="<?php echo base_url().'Proforma/manage/'?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a> 
					                    </div>
					                </div>
           						</div>                         
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div><!-- Row -->

				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
				    <div class="modal-dialog modal-lg">                      	
				        <div class="modal-content" id="viewajaxcontent">	 
				        </div>
				    </div>
				</div>	
								<!-- /page container -->
				<script type="text/javascript">
					$(document).ready(function()
					{
						//  calculate();
						// calculate1();
						// cal_discont();

						$('#barcode_scan').on("keypress", function(e) {
						        if (e.keyCode == 13) {
						            
						            var barcode_scan = $('#barcode_scan').val();

									$.ajax({
										type: "GET",
										url: "<?php echo site_url('Sales_order/scanBarcodeItemDetail'); ?>",
										data: { 'barcode' : barcode_scan},
										dataType:"html",

										success: function(data)
										{
											var obj 		= JSON.parse(data);
											var pro_item_id = obj[0].pro_item_id

											//Check the barcode is already scanned or not.
											var values		= $("input[name='barcode[]']").map(function(){return $(this).val();}).get();
											var scanCount	= $.grep(values, function (elem) 
											{
												return elem === barcode_scan;
											}).length;

											if(scanCount > 0){
												alert('This item already scanned!');
											}else{

												//Check sold or not
												if(obj[0].sold == 1){
													alert("Opps! This item is already sold.");
												}
												else if(obj[0].pro_item_stock <= 0){
													alert("Out of stock! Check the inventory");
												}else{

													//Check the product id, its already selected or not
													var itemExist = 0;
													var row = $('#attproduct').val() - 1;

													$.each($("select[name='pro_item_id[]']"), function(){
													    if( $(this).val() == pro_item_id){
													    	row 	= ($(this).attr('id')).replace ( /[^\d.]/g, '' );
															itemExist 	= 1;
													    }
													});

													if(!itemExist){
														$('#pro_item_id'+row).val(pro_item_id).trigger('change');
														addNewPart();
													}

													$('#quantity'+row).val( Number( $('#quantity'+row).val() ) + 1 );
													setTimeout(function(){
													  $('#quantity'+row).trigger('onkeyup');
													}, 100);

													//Barcode data append
													var input = $( "#barcode"+row );
													if( input.val() == '' ){
														input.val( barcode_scan );
													}else{
														input.val( input.val() + ", " + barcode_scan );
													}

												}
											}

											$('#barcode_scan').val('');
										},
									});

						            return false; // prevent the button click from happening
						        }
						});							 
					});

					$(document).ready(function()
					{
						var oTable = $('#example').dataTable( {
							"bProcessing": true,
						responsive: true,
							"sAjaxSource": '<?php echo base_url().$datatable_url; ?>',
									"bJQueryUI": true,
									"sPaginationType": "full_numbers",
									"iDisplayStart ":20,
									"oLanguage": {
								"sProcessing": "<img src='<?php echo base_url(); ?>img/ajax-loader_dark.gif'>"
							},  
							"fnInitComplete": function() {
									//oTable.fnAdjustColumnSizing();
							 },
								'fnServerData': function(sSource, aoData, fnCallback)
								{
								  $.ajax
								  ({
									'dataType': 'json',
									'type'    : 'POST',
									'url'     : sSource,
									'data'    : aoData,
									'success' : fnCallback
								  });
								}
						} );
					} 
					);

			function addNewPart()
			{
				row = $('#attproduct').val();

                $.ajax({
                    type: "GET",
                    url: "<?php echo site_url('Sales_order/getPartNoContent');?>", 
                    data: {i:row},
                    dataType:"html",
                    success: function(html)
                    {

                        $('#partProductData').append(html);
                        $('#pro_item_id'+row).select2();
                        
                        row = Number($('#attproduct').val()) + 1;   
                        $('#attproduct').val( row );                
                    },
                });
			}

					function menu_terms(id)
					{

						$.ajax({

							type: "GET",
							url: "<?php echo site_url('Sales_order/menu_terms'); ?>", 
							data: { payment_terms_id:id},
							dataType:"html",
							success: function(html)
							{	
								
								result = html.split('|');
						
								
								$("#sal_credit_period").val(result[1]);
					
								
							},
						});
					}
					function loadPriceDetails(id,i)
					{
						$.ajax({
							type: "GET",
							url: "<?php echo site_url('Sales_order/getProductPriceDetails'); ?>", 
							data: { pro_item_id:id},
							dataType:"html",
							async: false,
							success: function(html)
							{	//alert(html);
								result = html.split('|');
								//$('#pro_item_id'+i).val(result[0]);
								//$('#pro_item_name'+i).val(result[1]);

								
								$('#price_amt'+i).val(result[2]);
								$('#tax_id'+i).val(result[3]);
								$('#tax_name'+i).val(result[4]);
								$('#tax_percent'+i).val(result[5]);
								$('#unit'+i).val(result[6]);
								//$("#unit"+i).select2("val", result[6]);
								$('#available_qty'+i).val(result[7]);
								checkproductdetails(id,i,result[6]);
								
							},
						});
					}

					function checkproductdetails(id,i,unitid)
					{
						var values = $("select[name='pro_item_id[]']").map(function(){return $(this).val();}).get();
						var numOccurences = $.grep(values, function (elem) 
						{
							return elem === id;
						}).length;

						if(numOccurences>1)
						{
							alert("Already you have choosen the Selected Product");
							$('#pro_item_id'+i).val('');
							$('#pro_item_id'+i).select2();
							$('#price_amt'+i).val(' ');
							$('#unit1'+i).val(' ');
							$('#tax_id'+i).val(' ');
							$('#tax_name'+i).val(' ');
							$('#tax_percent'+i).val(' ');
							$('#unit').val('');
						}
						else
						{
							//loadunit(unitid,i);	
						}
						calculate();	
					}
					function loadaddress(id)
					{
							$('#newCustomerForm').css('display', 'none');

							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/loadaddress'); ?>",
								data: { con_id:id},
								dataType:"html",
								success: function(html)
								{	
								
									$('#sal_client_rep').html(html);
								},
							});

						
					}

					function podetails(i)
					{
						var pdt_id = $('#pro_item_id'+i).val();
						var con_id = $('#sal_company_name').val();
		
						if(pdt_id > 0)
						{
						$.ajax({
							type: "GET",
							url: "<?php echo site_url('Purchase_order/viewdetails'); ?>", 
							data: { "pro_item_id":pdt_id, "con_id":con_id},
							dataType:"html",
							success: function(response)
							{
							  jQuery('#viewajaxcontent').html(response);
							  jQuery('.bs-example-modal-lg').modal('show', {});
													
							},
						});
						}else
						{
							alert("Please select item");
							jQuery('.bs-example-modal-lg').modal('toggle');
						}
					}

					function getConfirmPart(inv,prid)
					{
						
					    var x;
					    var r=confirm("You Want Delete!!");
					    if(prid!='' && r==true)
					    {
					    	
					      $.ajax({"url":"<?php echo site_url('Sales_order/deleteproduct'); ?>",
					      "type":"GET",
					      data:{
					          "prid":prid
					      },

					      success:function(data)
					        {
					          //alert("Daelted Successfully");
					          $('#rowssids_'+inv+'').remove();
					          $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
					          calculate1();
					        }
					      
					      });
					   
				    	}
					    else if (prid=='' && r==true)
					    {

					      $('#rowssids_'+inv+'').remove();
					      $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
					      calculate1();	
					    }
					}
			function calculate()
			{	
					
				var grandtotal 		= 0;
				var grandtotal1 = 0;
				var vat=0;
				var total_include_vat=0;
				var vatamount=0;
			
				

				$('.allrowvalues').each(function(i,o) 
				{
					var t_hour   		    =	$(o).find('.t_hour',this).val();							
					var t_rate 		        =	$(o).find('.r_hour',this).val();
				
			
					var total 				=  (Number(t_hour *1) * Number(t_rate *1));
					total                   = parseFloat(total).toFixed(2);
			
			
				
					$(o).find('.total_amont',this).val(total);
					
					
					grandtotal+=Number(total);
					

					
				});
				grandtotal=parseFloat(grandtotal).toFixed(2);
				vat = (Number(grandtotal)*(15/100));
				vatamount = parseFloat(vat).toFixed(2);
				total_include_vat = Number(grandtotal)+Number(vat);
				grandtotal1 =parseFloat(total_include_vat).toFixed(2);
				$('#sub_t').val(grandtotal);
				$('#vat_amount').val(vatamount);
				$('#total').val(grandtotal1);
				
			}
			function calculate1()
			{	
					
				var grandtotal 		= 0;
				var grandtotal1 = 0;
				var vat=0;
				var total_include_vat=0;
				var vatamount=0;
			
				

				$('.allrowvalues').each(function(i,o) 
				{
					var t_hour   		    =	$(o).find('.qty',this).val();							
					var t_rate 		        =	$(o).find('.unit_price',this).val();
				
			
					var total 				=  (Number(t_hour *1) * Number(t_rate *1));
					total                   = parseFloat(total).toFixed(2);
			
			
				
					$(o).find('.total_amont',this).val(total);
					
					
					grandtotal+=Number(total);
					

					
				});
				grandtotal=parseFloat(grandtotal).toFixed(2);
				vat = (Number(grandtotal)*(15/100));
				vatamount = parseFloat(vat).toFixed(2);
				total_include_vat = Number(grandtotal)+Number(vat);
				grandtotal1 =parseFloat(total_include_vat).toFixed(2);
				$('#sub_t').val(grandtotal);
				$('#vat_amount').val(vatamount);
				$('#total').val(grandtotal1);
				
			}
			function CheckClientSelect()
			{
				var client_id = $('#sal_company_name').val();
				if(client_id==='')
				{
					alert('Please Select Client Name');
				}
				
			}
			function conver_lang(data ='')
			{	
						$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/language_transale'); ?>",
								data: { data:data},
								dataType:"html",
								success: function(html)
								{	
								
									alert(html);
								},
							});



			}
			function cal_discont()
			{
				var discount = $('#discount').val();
				var total_value = $('#sub_t').val();
				var grandtotal_afterdiscount = Number(total_value)-Number(discount);
				grandtotal_discount =parseFloat(grandtotal_afterdiscount).toFixed(2);
				vat = (Number(grandtotal_discount)*(15/100));
				vatamount = parseFloat(vat).toFixed(2);
				total_include_vat = Number(grandtotal_discount)+Number(vat);
				grandtotal1 =parseFloat(total_include_vat).toFixed(2);
				$('#vat_amount').val(vatamount);
				$('#total').val(grandtotal1);
			}
			function GetInvoiceDraft()
			{
				$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/GetInvoiceDraft'); ?>",
								dataType:"html",
								success: function(html)
								{	
								
									$('#sal_order').val(html);
								},
							});
			}
			function GetProformaNo()
			{
				$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/GetProformaNo'); ?>",
								dataType:"html",
								success: function(html)
								{	
								
									$('#sal_order').val(html);
								},
							});
			}
				function GetInvoiceNo()
			{
				$.ajax({
								type: "GET",
								url: "<?php echo site_url('Sales_order/get_invoice_no'); ?>",
								dataType:"html",
								success: function(html)
								{	
								
									$('#sal_order').val(html);
								},
							});
			}

				</script>
			</div>
		</div><!-- Main Wrapper -->




