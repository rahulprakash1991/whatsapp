<?php
$CI = & get_instance();

if(isset($value) )
{
	
		foreach($value->result() as $row) //Proforma Invoice Data
		{
			$quo_id 					=	$row->quo_id;
			$quotation_vendor 			=	$row->quotation_vendor; 
			$quotation_verndor_rep = $row->quotation_verndor_rep;
			$quotation_num = $row->quotation_no;
			$quotation_date = $row->quotation_date;
			$refference = $row->refference;
			$quotation_validity = $row->quotation_validity;
			$delivery = $row->delivery;
			$payment_term = $row->payment_term;
			$quotation_bank = $row->quotation_bank;
			$subject = $row->subject;
			$sub_total = $row->quotation_sub_total;
			$grand_total = $row->quotation_grand_total;
			$vat_amount = $row->quotation_tax_amount;
			$remarks = $row->general_terms;
			$co_terms = $row->co_terms;
			$deliverytearms = $row->deliverytearms;
			$support_maintenance = $row->support_maintenance;
			$installation = $row->installation;
			$qus_status = $row->qus_status;
			$dis_amount = $row->quotation_discount;
			$qus_curency = $row->qus_curency;
		

		}

		foreach($evalue as $key =>$row)
		{
			$item[$key] 			    =	$row->item_description;
			$itemarabic[$key] 			=	$row->item_description_arabic;
			$nationality[$key]		    =   $row->nationality;
			$total_no[$key] 			=	$row->total;
			$t_hour[$key] 			    =	$row->total_hour;
			$r_hour[$key] 	            =	$row->rate_hour;
			$total_amont[$key] 			=	$row->total_cost;
			$uniteng[$key]		        =   $row->unit;
			$unitarabic[$key] 			=	$row->unitarabic;
			$qty[$key] 			        =	$row->qty;
			$unit_price[$key] 	        =	$row->unit_price;
			$slno[$key] 	            =	$row->sl_no;
			$vatper[$key]  =$row->vat_per;
			$vat_amount1[$key] = $row->vat_amt;
			$discount_amount[$key] = $row->dis_amt;
			$discount[$key] = $row->dis_per;
			$trow++;		
		}	
}
else
{	
		
			$quo_id 					=	$this->input->post('quo_id');
			$quotation_vendor 			=	$this->input->post('vendor_name');
			$quotation_verndor_rep 		=   $this->input->post('vendor_rep');
			$quotation_date 			=   $this->input->post('quotation_date');
			$refference 				=   $this->input->post('reference');
			$quotation_validity 		=   $this->input->post('quotation_validity');
			$delivery 					=   $this->input->post('delivery');
			$payment_term 				=   $this->input->post('payment_term');
			$quotation_bank 			=   $this->input->post('vendor_bank');
			$subject 					=   $this->input->post('subject');
			$sub_total 					=   $this->input->post('sub_t');
			$grand_total 				=   $this->input->post('vat_amount');
			$vat_amount 				=   $this->input->post('total');
			$remarks 					=   $this->input->post('remarks');
}
	
	$i = 1;
	$trow = ($trow=='') ? 1 : $trow;

foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
// $getCurrency=$this->pre->getCurrencynew();
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
									 	<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('vendor_name')){ echo 'has-error';} ?>">
													<label>Client Name<span1>*</span1></label>
				                               	 	<?php
				                               	 	
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_name" onChange="loadaddress(this.value)"';
													echo form_dropdown('vendor_name', $drop_menu_vendor, set_value('vendor_name', (isset($quotation_vendor)) ? $quotation_vendor : ''), $attrib);
													?>
													 <label class="error"><?php echo form_error('vendor_name'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                      		<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('vendor_rep')){ echo 'has-error';} ?>">
													<label>Client Representative</label>
				                               	 	<?php 
				                               	 	// $drop_menu_address 	=	$CI->sal_common->drop_menu_vendor_rep($quotation_vendor);
				                               	 	
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_rep" ';
													echo form_dropdown('vendor_rep', $drop_menu_address, set_value('vendor_rep', (isset($quotation_verndor_rep)) ? $quotation_verndor_rep : ''), $attrib);
													?>
													 <label class="error"><?php echo form_error('vendor_rep'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                   
				                      		<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('quotation_date')){ echo 'has-error';} ?>">
													<label>Quotation Date</label>
				                               	 	 <input type="text" class="form-control date-picker" placeholder="Invoice Date" autocomplete="off" value="<?php echo ($quotation_date!='' && $quotation_date!='0000-00-00') ? date('m/d/Y', strtotime($quotation_date))  : date('m/d/Y '); ?>" name="quotation_date" id="quotation_date"   >
													 <label class="error"><?php echo form_error('quotation_date'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                      		<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('reference')){ echo 'has-error';} ?>">
													<label>Reference</label>
				                               	 	 <input name="reference"  class="form-control " id="reference" type="text" value="<?php echo $refference; ?>" placeholder="Reference " /> 
													 <label class="error"><?php echo form_error('reference'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                      	 		
				                     
				                    </div>
				                    <div class="row">
				                    	
				                      	<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('quotation_validity')){ echo 'has-error';} ?>">
													<label>Quotation Validity</label>
				                               	 	  <!--  <input type="text" class="form-control date-picker" placeholder="Response Date" autocomplete="off" value="<?php echo ($quotation_validity!='' && $quotation_validity!='0000-00-00') ? $quotation_validity : date('d M, Y'); ?>" name="quotation_validity" id="quotation_validity" style="background-color:#fff"  > -->

				                               	 	    <?php 	
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="quotation_validity" ';
													echo form_dropdown('quotation_validity', $drop_menu_quotation_validity, set_value('quotation_validity', (isset($quotation_validity)) ? $quotation_validity : ''), $attrib);
													?>
													 <label class="error"><?php echo form_error('quotation_validity'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                    
				                      	 	<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('payment_term')){ echo 'has-error';} ?>">
											<label class="control-label">Payment Terms</label>
									            <?php 	
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="payment_term" ';
													echo form_dropdown('payment_term', $drop_menu_payment_terms, set_value('payment_term', (isset($payment_term)) ? $payment_term : ''), $attrib);
													?>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                      	 <div class="col-md-3">
                                           <div class="form-group <?PHP if(form_error('vendor_bank')){ echo 'has-error';} ?>">
                                                <label><?php echo 'Bank';?></label>
                                                <?php 
                                                            $attrib = 'class="form-control" data-live-search="true" data-width="100%" id="vendor_bank" ';
                                                         echo form_dropdown('vendor_bank', $drop_menu_bank, set_value('vendor_bank', (isset($quotation_bank)) ? $quotation_bank : ''), $attrib);
                                                          ?>
                                            
                                                 <label class="error"><?php echo form_error('vendor_bank'); ?></label>
                                            </div>
                                        </div>
                                         	 <div class="col-md-3">
                                           <div class="form-group <?PHP if(form_error('qus_curency')){ echo 'has-error';} ?>">
                                                <label><?php echo 'Currency';?></label>
                                                <?php
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="qus_curency"  ';
													echo form_dropdown('qus_curency', $drop_menu_currency, set_value('qus_curency', (isset($qus_curency)) ? $qus_curency : ''), $attrib);
												?>
                                            
                                                 <label class="error"><?php echo form_error('qus_curency'); ?></label>
                                            </div>
                                        </div>
				                      </div>
				                      <div class="row">
				                      	<div class="col-md-12">
				                      	<label class="control-label">Subject</label>
									             						
                                                  <textarea id="subject" name="subject" autocomplete="off" class="form-control " rows="2" style="min-height: 1px;"><?php echo $subject;?></textarea>
				                      </div>
				                  </div>
				   
									<legend style="padding-top: 0px;padding-bottom:0px;"></legend>     
									<!-- <div class="panel panel-#b4b4b4"> -->
										<div >
							    <div class="row">
								
                                <div class="col-md-6" style="padding-left: 26px;">
                                    <label><strong>Description in English</strong></label>
                                </div>
                               <!--   <div class="col-md-4" style="padding-left: 26px;">
                                    <label><strong>Description in Arabic</strong></label>
                                </div> -->
                               <!--  <div class="col-md-1" >
                                    <center><label><strong>Unit</strong></label></center>
                                </div> -->
                                <div class="col-md-1">
                                    <center><label><strong>Dicount (%)</strong></label></center>
                                </div>
                                 <div class="col-md-1" >
                                    <center><label><strong>Vat %</strong></label></center>
                                </div>
                                <div class="col-md-1">
                                    <center><label><strong>Qty</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Unit Price</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Total Amount</strong></label></center>
                                </div>
                                                                    
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
                                 	 
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                          
                                        		<!-- elm1 -->
                                                  <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control summernote " onkeyup="CheckClientSelect();"  rows="1" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>">
                                            </div>                                      
                                    </div>
                                <!--     <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('itemarabic['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="itemarabic'.$i.'" name="itemarabic[]" autocomplete="off" class="form-control summernote " rows="2" style="min-height: 1px;text-align:right;"><?php echo $itemarabic[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('itemarabic['.$i.']'); ?></label>
                                        </div>                   
                                                                           
                                    </div> -->

                       
                             
                                    <div class="col-md-1">
                                    	
	                                          <div class="form-group <?PHP if(form_error('discount[]')){ echo 'has-error';} ?>">
	                                      
	                                            <input type="text" name="discount[]"  autocomplete="off" class="form-control discount" id="discount<?php echo $i;?>" value="<?php echo $discount[$i];?>"  placeholder="Dicount ">

	                                            <input type="hidden" name="discount_amount[]"  autocomplete="off" class="form-control discount_amount" id="discount_amount<?php echo $i;?>" value="<?php echo $discount_amount[$i];?>"  >
	                                             <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('discount[]'); ?></label>
	                                        </div>
	                                       
	                                   
                                    </div> 
                                       <div class="col-md-1">
                                    	<div class="form-group" >
									
									       
											<select name="vat_per1[]" id="vat_per1<?php echo $i;?>" class="form-control vat_per1" >
                   							 <?php foreach ($drop_menu_tax_item as $key_id => $key_name) 
                     						{?>
                        					<option value="<?php echo $key_id;?>" <?php if($key_id == $vatper[$i]){?> selected <?php }?>><?php echo $key_name;?></option>

                        					<?php 
                        						}?>
                    						</select>
					       			         </div>
					       			          <input type="hidden" name="vat_amount1[]"  autocomplete="off" class="form-control vat_amount1" id="vat_amount1<?php echo $i;?>" value="<?php echo $vat_amount1[$i];?>"  >
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
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                         
                                 
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
                                    <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" /> <br><br>
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
										<label class="control-label">Standard Terms & Conditions:</label>	
                                                  <textarea id="remarks" name="remarks" autocomplete="off" class="form-control summernote" rows="4" style="min-height: 1px;"><?php echo $remarks;?></textarea>
					       			    </div>      
					       			    </div >
					       			    <div class="col-md-4">
					       			    </div>	
					       			    <div class="col-md-4">
	                                   	</div>
					       			     <div class="col-md-4">
					       			     	
					       			     </div>					       			                       
                                   		</div>
                                   		<div class="col-md-4">
				                        <div class="col-md-4 text-right" >
					                                        
				                        </div>
																	 <div class="col-md-6">
																		
					       			                        		</div>
					       			                        
                                   				
										            <div class="col-md-4 text-right" >
	                                        					<label class="control-label">Sub Total (<?php echo $getCurrency;?>)</label>
	                                        				</div>
					                                        <div class="col-md-6">
																<div class="form-group">
									                                 <input type="text" name="sub_t" autocomplete="off" class="form-control sub_total" value="<?php echo $sub_total;?>"id="sub_t"    >
					       			                            </div>
					       			                        </div>
					       			                        	<div class="col-md-4 text-right" >
					                                        	<label class="control-label">Discount (<?php echo $getCurrency;?>)</label>
					                                            </div>
																	 <div class="col-md-6">
																		<div class="form-group">
									                               			<input type="text" name="dis_amount" autocomplete="off" class="form-control dis_amount" value="<?php echo $dis_amount;?>"id="dis_amount"    >
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
 											<div class="row" style="padding-left: 10px;padding-right: 10px;">
                                   				<div class="col-md-6">
                                   					<div class="form-group">
                                   					<label class="control-label">Commercial Terms: </label>
                                                    <textarea id="co_terms" name="co_terms" autocomplete="off" class="form-control summernote" rows="4" style="min-height: 1px;"><?php echo $co_terms;?></textarea>
                                                  </div>
                                   				</div>
                                   					<div class="col-md-6">
                                   				    <div class="form-group">
                                   					<label class="control-label">Delivery: </label>
									             						
                                                  <textarea id="deliverytearms" name="deliverytearms" autocomplete="off" class="form-control summernote " rows="4" style="min-height: 1px;"><?php echo $deliverytearms;?></textarea>
                                                  </div>
                                   				</div>
                                   			</div>
                                   			<div class="row"  style="padding-left: 10px;padding-right: 10px;">
                                   				<div class="col-md-6">
                                   					<div class="form-group">
                                   					<label class="control-label">Support & Maintenance </label>
									             						
                                                  <textarea id="elm1" name="support_maintenance" autocomplete="off" class="form-control summernote" rows="4" ><?php echo $support_maintenance;?></textarea>
                                                  </div>
                                   				</div>
                                   					<div class="col-md-6">
                                   					<div class="form-group">
                                   					<label class="control-label">Installation </label>
									             						
                                                  <textarea id="installation" name="installation" autocomplete="off" class="form-control summernote" rows="4" style="min-height: 1px;"><?php echo $installation;?></textarea>
                                              </div>
                                   				</div>
                                   			</div>
                                        <hr>
                                   	<div class="row">
        								<div class="text-center" style="margin-left: 25px;">
        									 <input type="hidden" name="company_abb" id="company_abb" value="<?php echo $company_abb;?>" /> 
					                      <input type="hidden" name="quo_id" id="quo_id" value="<?php echo $quo_id;?>" />  
					                      <input type="hidden" name="pro_id" id="pro_id" value="<?php echo $pro_id;?>" />  
					                      <input type="hidden" name="po_status" value="1" />      
					                    <!--   <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($quo_id!='' ? 'Update ' : 'Create '); ?> </button> -->
					                             <?php if($qus_status=='' || $qus_status!='1') { ?>
			                     	<button type="submit" name="draft" class="btn btn-warning"><?php echo 'Save As Draft'; ?> </button>
			                     <?php }?>
			                
					              <button type="submit" name="savequotation" class="btn btn-success"><?php if($qus_status=='1') { ?><?php echo'Update  Quotation'; ?> <?php }else {?><?php echo'Save As Quotation'; ?><?php }?></button>
					                       <a href="<?php echo base_url().'Quotation/manage/'?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a> 
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
                    url: "<?php echo site_url('Quotation/getPartNoContent');?>", 
                    data: {i:row},
                    dataType:"html",
                    success: function(html)
                    {

                        $('#partProductData').append(html);
                        $('#pro_item_id'+row).select2();
                        
                        row = Number($('#attproduct').val()) + 1;   
                        $('#attproduct').val( row ); 
                         $(".summernote").summernote();               
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
								url: "<?php echo site_url('Quotation/loadaddress'); ?>",
								data: { con_id:id},
								dataType:"html",
								success: function(html)
								{	
								
									$('#vendor_rep').html(html);
									getDeliverAddress(id);
									getClientCurrency(id);
								},
							});

						
					}
					function getDeliverAddress(id)
					{
							$('#newCustomerForm').css('display', 'none');

							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Quotation/getDeliverAddress'); ?>",
								data: { con_id:id},
								dataType:"html",
								success: function(html)
								{	
								
									$('#delivery').html(html);
									
									
								},
							});

						
					}
					function getClientCurrency(id)
					{
							$('#newCustomerForm').css('display', 'none');

							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Quotation/getClientCurrency'); ?>",
								data: { con_id:id},
								dataType:"html",
								success: function(html)
								{	
								
									$('#qus_curency').html(html);
									
									
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
					    	
					      $.ajax({"url":"<?php echo site_url('Quotation/deleteproduct'); ?>",
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
			// function calculate1()
			// {	
					
			// 	var grandtotal 		= 0;
			// 	var grandtotal1 = 0;
			// 	var vat=0;
			// 	var total_include_vat=0;
			// 	var vatamount=0;
			
				

			// 	$('.allrowvalues').each(function(i,o) 
			// 	{
			// 		var t_hour   		    =	$(o).find('.qty',this).val();							
			// 		var t_rate 		        =	$(o).find('.unit_price',this).val();
			
			// 		var total 				=  (Number(t_hour *1) * Number(t_rate *1));
			// 		total                   = parseFloat(total).toFixed(2);
			// 		$(o).find('.total_amont',this).val(total);
					
					
			// 		grandtotal+=Number(total);
					
			// 	});
			// 	grandtotal=parseFloat(grandtotal).toFixed(2);
			// 	vat = (Number(grandtotal)*(15/100));
			// 	vatamount = parseFloat(vat).toFixed(2);
			// 	total_include_vat = Number(grandtotal)+Number(vat);
			// 	grandtotal1 =parseFloat(total_include_vat).toFixed(2);
			// 	$('#sub_t').val(grandtotal);
			// 	$('#vat_amount').val(vatamount);
			// 	$('#total').val(grandtotal);
				
			// }
			function calculate1()
			{	
					
				var grandtotal 		= 0;
				var grandvattotal 		= 0;
				var grandtotal1 = 0;
				var vat=0;
				var total_include_vat=0;
				var vatamount=0;
				var grand_discount_total = 0;
				var grand_sub_total = 0;
			
				

				$('.allrowvalues').each(function(i,o) 
				{
					var t_hour   		    =	$(o).find('.qty',this).val();							
					var t_rate 		        =	$(o).find('.unit_price',this).val();
					var vat 		        =	$(o).find('.vat_per1',this).val();
					var discount 		    =	$(o).find('.discount',this).val();
					if(discount==='' || discount===0 )
					{
						
						if(vat===0)
						{
							var total 				=  (Number(t_hour *1) * Number(t_rate *1));
							total                   = parseFloat(total).toFixed(2);
							$(o).find('.total_amont',this).val(total);
							grandtotal+=Number(total);

							var vat_amout =0;
							$(o).find('.vat_amount1',this).val(vat_amout);
							grandvattotal+=Number(vat_amout);
							// grand_sub_total+= Number(total);
						}
						else
						{
								var total 				=  (Number(t_hour *1) * Number(t_rate *1));
								var vat_amout           =   (Number(total)*(vat/100));
								total_include_vat    = (Number(total *1) + Number(vat_amout *1));
								total                   = parseFloat(total_include_vat).toFixed(2);
								$(o).find('.total_amont',this).val(total);
								grandtotal+=Number(total_include_vat);

								$(o).find('.vat_amount1',this).val(vat_amout);
								grandvattotal+=Number(vat_amout);
								// grand_sub_total+= (Number(t_hour *1) * Number(t_rate *1));
						}
						var discount_amount =0;
					    $(o).find('.discount_amount',this).val(discount_amount);
							grand_discount_total+=Number(discount_amount);
					}
					else
					{
						
						if(vat===0)
						{
							var total 				= (Number(t_hour *1) * Number(t_rate *1));
							total                   = parseFloat(total).toFixed(2);
							var discount_amount     = (Number(total)*(discount/100));
							var total_after_dis     = Number(total)-Number(discount_amount);
							total_after_dis         = parseFloat(total_after_dis).toFixed(2);
							$(o).find('.total_amont',this).val(total_after_dis);
							grandtotal+=total_after_dis;

							$(o).find('.discount_amount',this).val(discount_amount);
							grand_discount_total+=Number(discount_amount);
							var vat_amout =0;
							$(o).find('.vat_amount1',this).val(vat_amout);
							grandvattotal+=Number(vat_amout);
							// grand_sub_total+= Number(total)+ Number( discount_amount);
						}
						else
						{
								var total 				=  (Number(t_hour *1) * Number(t_rate *1));
								var discount_amount          =   (Number(total)*(discount/100));
								var total_after_dis                   = Number(total)-Number(discount_amount);
								total_after_dis                   = parseFloat(total_after_dis).toFixed(2);

								var vat_amout           =   (Number(total_after_dis)*(vat/100));
								var total_include_vat    = (Number(total_after_dis *1) + Number(vat_amout *1));
								total_include_vat                   = parseFloat(total_include_vat).toFixed(2);
								$(o).find('.total_amont',this).val(total_include_vat);
								grandtotal+=Number(total_include_vat);

								$(o).find('.vat_amount1',this).val(vat_amout);
								grandvattotal+=Number(vat_amout);

								$(o).find('.discount_amount',this).val(discount_amount);
							   grand_discount_total+=Number(discount_amount);
							   // grand_sub_total+= (Number(t_hour *1) * Number(t_rate *1));
						}
					}
			
				
					
				});
				grand_sub_total = parseFloat(grand_sub_total).toFixed(2);
				grandtotal=parseFloat(grandtotal).toFixed(2);
				grand_discount_total=parseFloat(grand_discount_total).toFixed(2);
				grandvattotal=parseFloat(grandvattotal).toFixed(2);
				total_include_vat = Number(grandtotal)+Number(grandvattotal);
				grandtotal1 =parseFloat(total_include_vat).toFixed(2);
				$('#sub_t').val(grandtotal);
				$('#vat_amount').val(grandvattotal);
				$('#total').val(grandtotal);
				$('#dis_amount').val(grand_discount_total);		
			}
			function CheckClientSelect()
			{
				var client_id = $('#vendor_name').val();
				if(client_id==='')
				{
					alert('Please Select Vendor Name');
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




