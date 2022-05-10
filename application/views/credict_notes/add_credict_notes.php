<?php
$CI = & get_instance();

if(isset($value) )
{
	
		foreach($value->result() as $row) //Proforma Invoice Data
		{
			$credict_id 					=	$row->credict_id;
			$client_id 			=	$row->client_id; 
			$salesorder_id 		=	$row->salesorder_id; 
			$credit_num   = $row->credit_number;
			$reason = $row->reason;
			$subject = $row->subject;
			$invoice_total = $row->invoice_total;
			
			$sub_total = $row->credict_sub_total;
			$vat_per= $row->credit_vat_per;
			$grand_total = $row->credict_total;
			$sal_curency = $row->credit_currency;
			$vat_amount = $row->credit_vat_amount;


			

		}

		foreach($evalue as $key =>$row)
		{
			$item_id[$key]			= $row->credict_item_id;
			$item[$key] 			=	$row->item_description;
			$itemarabic[$key] 			=	$row->item_description_arabic;
			$qty[$key] 			=	$row->qty;
			$unit_price[$key] 	=	$row->unit_price;
			$slno[$key] 	=	$row->sl_no;
			$total_amont[$key] =  $qty[$key] *  $unit_price[$key] ;
			$wbno[$key] = $row->wb_no;
			$unit[$key] = $row->unit;
 			$trow++;		
		}
		foreach($sal_data->result() as $row) //Proforma Invoice Data
		{
			
			$shipping_type = $row->shiping_type;
		}
}
else
{	
		$sal_invoice_status = 0;
		$pro_id						= 	$this->input->post('pro_id');
		$credict_id						= 	$this->input->post('sal_id');

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


$getCurrency=$this->pre->getCurrencynew();
?>
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
				                        		<div class="form-group <?PHP if(form_error('sal_company_name')){ echo 'has-error';} ?>">
													<label>Client Name<span1>*</span1></label>
				                               	 	<?php
				                               	 	
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_company_name" onChange="loadaddress(this.value)"';
													echo form_dropdown('sal_company_name', $drop_menu_client, set_value('sal_company_name', (isset($client_id)) ? $client_id : ''), $attrib);
													?>
													 <label class="error"><?php echo form_error('sal_company_name'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                      		<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('sal_client_rep')){ echo 'has-error';} ?>">
													<label>Invoice Number<span1>*</span1></label>
				                               	 	<?php 
				                               	 	$drop_menu_address 	=	$CI->sal_common->drop_menu_invoice_no($sal_company_name);
				                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="sal_client_rep" onChange="get_invoice_data(this.value)" ';
													echo form_dropdown('sal_client_rep', $drop_menu_address, set_value('sal_client_rep', (isset($salesorder_id)) ? $salesorder_id : ''), $attrib);
													?>
													 <label class="error"><?php echo form_error('sal_client_rep'); ?></label>
												</div>
				                                     
   			                            	</div>
				                      	</div>
				                    </div>
				                    <div class="row">
									 	<div class="col-md-3">
				                        	<div class="form-group">
				                        	<div class="form-group <?PHP if(form_error('reason')){ echo 'has-error';} ?>">
				                        	<label>Reason<span1>*</span1></label>
				                        	<select name="reason" id="reason" class="form-control" required="" >
									           <option value="" >----Select----</option>
                                                <option value="Cancellation of Services either wholly or partially" <?php if($reason=='Cancellation of Services either wholly or partially'){?> selected <?php }?>>Cancellation of Services either wholly or partially</option>
                                                <option value="Changes to VAT" <?php if($reason=='Changes to VAT'){?> selected <?php }?>>Changes to VAT </option>
                                                <option value="Changes to the value of service" <?php if($reason=='Changes to the value of service'){?> selected <?php }?>>Changes to the value of service </option>
                                                <option value="Goods or Service Refund" <?php if($reason=='Goods or Service Refund'){?> selected <?php }?>>Goods or Service Refund </option>
                                                <option value="Others" <?php if($reason=='Others'){?> selected <?php }?>>Others </option>
                                                    </select>
				                        		 <label class="error"><?php echo form_error('reason'); ?></label>
				                        	</div>
				                        	</div>
				                        </div>
				                        <div class="col-md-6">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('subject')){ echo 'has-error';} ?>">
				                        		<label>Subject<span1>*</span1></label>
				                        		<input name="subject" autocomplete="off" class="form-control " id="subject" type="text" value="<?php echo $subject; ?>"  placeholder=" Reason" required />
				                        		 <label class="error"><?php echo form_error('subject'); ?></label>
				                        	</div>
				                        	</div>
				                        </div>
				                    </div>
				                 
									
							
								<legend style="padding-top: 0px;padding-bottom:0px;"></legend>     
								<div class="panel panel-#b4b4b4">
									<?php if(isset($credict_id ) && $credict_id !=''){?>
								<div class="row" id="table_head">
								<?php } else {?>
									<div class="row" id="table_head" style="display: none;">
								<?php }?>
                              
                           
                                <div class="col-md-4">
                                    <label><strong>Description in English</strong></label>
                                </div>
                                 <div class="col-md-3">
                                    <label><strong>Description inArabic</strong></label>
                                </div>
                       
                              <div class="col-md-1">
                                    <center><label><strong>Unit</strong></label></center>
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
                                   <div class="col-md-1" >
                                    <center><label><strong></strong></label></center>
                                </div>
                                                                    
                            </div>
						</div>

                      			 <div class="row">                 
                        		<span id="partProductData" >
                        			<?php  if(isset($credict_id ) && $credict_id !=''){
                        			 $is=1;
                        			
        for($i=0; $i < $trow; $i++)
						{
						 if($unit_price[$i]!=0){
                                    ?>
                                 <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
                               
                            
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control " onkeyup="CheckClientSelect();"  rows="2" style="min-height: 1px;" readonly><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>">
                                            </div>                                      
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('itemarabic['.$i.']')){ echo 'has-error';} ?>">
                                          

                                                  <textarea id="itemarabic'.$i.'" name="itemarabic[]" autocomplete="off" class="form-control " rows="2" style="min-height: 1px;text-align:right;" readonly><?php echo $itemarabic[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('itemarabic['.$i.']'); ?></label>
                                        </div>                   
                                                                           
                                    </div>
                                <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('unit[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="unit[]" autocomplete="off" class="form-control unit" id="unit<?php echo $i;?>" type="text" value="<?php echo $unit[$i]; ?>" onkeyup="calculateqty();"   placeholder=" Unit" readonly />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('unit[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('qty[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="qty[]" autocomplete="off" class="form-control qty" id="qty<?php echo $i;?>" type="text" value="<?php echo $qty[$i]; ?>" onkeyup="calculateqty();"   placeholder=" Qty"  readonly/>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('qty[]'); ?></label>
                                        </div>
                                    </div>
                                 
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="unit_price[]"  class="form-control unit_price" id="unit_price<?php echo $i;?>" type="text" value="<?php echo $unit_price[$i]; ?>" placeholder="Unit Price" readonly /> 
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
                                                <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($item_id[$i]!='') ? ','.$item_id[$i] : '';?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </span> 
                                    </div>
                                </div>
                                <?php 
                                $is++; 
                                } }
                                }?>
                                
                            	</span>                       		 
                        	</div>
                       
	                                    <hr style="margin: 5px 0 !important;">
                        				<div class="clearfix"></div>
                        		<!-- <div class="row">
                        				 		<div class="col-md-3">
				                        	<div class="form-group">
				                        		<div class="form-group <?PHP if(form_error('cr_no')){ echo 'has-error';} ?>">
				                        		<label>Credict Note No<span1>*</span1></label>
				                        		<input name="cr_no" autocomplete="off" class="form-control " id="cr_no" type="text" value="<?php echo $credit_num; ?>"  readonly />
				                        		 <label class="error"><?php echo form_error('cr_no'); ?></label>
				                        	</div>
				                        	</div>
				                        </div>
				                    </div> -->
				                     <div class="row">
                                   				<div class="col-md-12">
                                   					<div class="row">
                                   						<div class="col-md-8">
															<div class="col-md-4">
	                                   							<div class="form-group">
	                                   								
														<label>Credict Note No<span1>*</span1></label>
				                        		<input name="cr_no" autocomplete="off" class="form-control " id="cr_no" type="text" value="<?php echo $credit_num; ?>"  readonly />
				                        		 <label class="error"><?php echo form_error('cr_no'); ?></label></label>
				                       
									                
					       			                            </div>
					       			                        </div>
					       			                        
					       			                       <div class="col-md-4">
	                                   						<div class="form-group">
	                                   								 
												
									
					       			              </div>
					       			                        </div>	
					       			                        <div class="col-md-4">
	                                   							<div class="form-group">
	                                   								
																
					       			                            </div>
					       			                        </div>

					       			                       <div class="col-md-8">
	                                   							<div class="form-group">
	                                   							
																	
                                         
					       			                            </div>
					       			                        </div>					       			                       
                                   						</div>
                                   						<div class="col-md-4">
				                                   			 <div class="col-md-4 text-right" >
					                                        	<!-- <label class="control-label">Sub Total(<?php echo $getCurrency;?>)</label>
 -->					                                         </div>
																	 <div class="col-md-6">
																		
					       			                        		</div>
					       			                        	<div class="col-md-4 text-right" >
					                                        
					                                            </div>
																	 <div class="col-md-6">
																		<div class="form-group">
									                               			
					       			                           			 </div>
					       			                        		</div>
                                   				
										            <div class="col-md-4 text-right" >
	                                        					<label class="control-label">Sub Total</label>
	                                        				</div>
					                                        <div class="col-md-6">
																<div class="form-group">
									                                 <input type="text" name="sub_t" autocomplete="off" class="form-control sub_total" value="<?php echo $sub_total;?>"id="sub_t" readonly   >
					       			                            </div>
					       			                        </div>
					       			                   
					       			                        <div class="col-md-4 text-right" style=" <?PHP if( $shipping_type=='2' ||$shipping_type==''){?>display:block;<?php }else{?>display:none;<?php }?>"   >
	                                        					<label id="vat_label" class="control-label">Vat Percentage</label>
	                                        				</div>
					                                        <div class="col-md-6" style=" <?PHP if($shipping_type=='2' ||$shipping_type==''){?>display:block;<?php }else{?>display:none;<?php }?>" >
																<div class="form-group" id="vat_data">
									                                           
													<input type="text" name="vat_per" class="form-control" value="<?php echo '15%';?>" id="vat_per" readonly  >
					       			                            </div>
					       			                        </div>
					       			                           <div class="col-md-4 text-right" style=" <?PHP if( $shipping_type=='2' ||$shipping_type==''){?>display:block;<?php }else{?>display:none;<?php }?>">
	                                        					<label class="control-label" id="vat_amount_lbl">Vat Amount</label>
	                                        				</div>
					                                        <div class="col-md-6" style=" <?PHP if( $shipping_type=='2' ||$shipping_type==''){?>display:block;<?php }else{?>display:none;<?php }?>">
															<div class="form-group" id="vat_amount_data">
									                    
																<input type="text" name="vat_amount" class="form-control" value="<?php echo $vat_amount;?>" id="vat_amount" readonly  >
					       			                            </div>
					       			                        </div> 
										            		<div class="col-md-4 text-right" >
	                                        					<label class="control-label">Total</label>
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




                        						<div class="row">
                                   		 	<div class="col-md-2">
                                   				<div class="checkbox <?PHP if(form_error('sal_invoice_status')){ echo 'has-error';} ?>">
                                   					<label>                                                  
                                                     		<span class="">	                                                      	
	                                                      		<input type="radio" name="sal_invoice_status" value="0" <?php if($sal_invoice_status=='0' || empty($sal_invoice_status)){echo "checked";}?> onChange="GetPerfomaNo();" >
	                                                      	</span>                                          	
                                                     	Save As Draft
                                                     </label> 
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                   				<div class="checkbox <?PHP if(form_error('sal_invoice_status')){ echo 'has-error';} ?>">
                                   					<label>                                                  
                                                        <span class="">
                                                            <input type="radio" name="sal_invoice_status" value="1" <?php if($sal_invoice_status=='1' ){echo "checked";}?> onChange="GetInvoiceNo();" >
                                                        </span>                                          	
                                                     	 Save As Credit Note
                                                     </label> 
                                                </div>
                                            </div>

                               
                                            <br />
                                        </div>
                                            <hr style="margin: 5px 0 !important;">
                        				<div class="clearfix"></div>
                                   	<div class="row">
        								<div class="text-left">
        									 <input type="hidden" name="company_abb" id="company_abb" value="<?php echo $company_abb;?>" /> 
					                      <input type="hidden" name="credict_id" id="credict_id" value="<?php echo $credict_id;?>" />  
					                      <input type="hidden" name="invoice_total" id="invoice_total" value="<?php echo $invoice_total;?>" />  
					                      <input type="hidden" name="po_status" value="1" />      
					                      <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($credict_id!='' ? 'Update ' : 'Create '); ?> </button>
					                         <a href="<?php echo base_url().'Credict_notes/'?>" class="btn btn-primary">Cancel</a> 
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

				

					function loadaddress(id)
					{
							$('#newCustomerForm').css('display', 'none');

							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Credict_notes/loadaddress'); ?>",
								data: { con_id:id},
								dataType:"html",
								success: function(html)
								{	
								
									$('#sal_client_rep').html(html);
								},
							});

						
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
					          de_amount  =$('#total_amont'+inv+'').val();
					          sub_amt = $('#sub_t').val();
					          total_amt = $('#total').val();
					          vat_amt = $('#vat_per').val();

					          $('#rowssids_'+inv+'').remove();
					          $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
					          calculate(de_amount,sub_amt,total_amt,vat_amt);
					        }
					      
					      });
					   
				    	}
					    else if (prid=='' && r==true)
					    {
					       de_amount  =$('#total_amont'+inv+'').val();
					       sub_amt = $('#sub_t').val();
					       total_amt = $('#total').val();
					     
					      $('#rowssids_'+inv+'').remove();
					      $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
					      calculate(de_amount,sub_amt,total_amt);
					    }
					}
	function get_invoice_data(id)
		{
	client_id = $('#sal_company_name').val();
	if(client_id==='')
	{
		alert("Please Select Client");
		exit();
	}

		$.ajax({
			type: "GET",
			url: "<?php echo site_url('Credict_notes/get_invoice_data'); ?>", 
			data: {invoice_num:id},
			dataType:"html",
			success: function(content)
			{	
			$('#table_head').show();
			$('#partProductData').html(content);
			getInvoice_Type(id);
			getInvoiceTotal(id);
			get_sub_total(id);
			// get_vat_per(id);
			get_vat_amount(id);
				
			},
		});
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
				
					

					
				});
				
				
			}
			function calculate(de_amount,sub_amt,total_amt,vat_amt)
			{
				if(vat_amt=='')
				{
				
					sub_tot =sub_amt - de_amount;
					sub_total = parseFloat(sub_tot).toFixed(2)
					$('#sub_t').val(sub_total);
					grand_tot =total_amt - de_amount;
					grand_total = parseFloat(grand_tot).toFixed(2)
					 $('#total').val(grand_total);
						
				}
				else
				{
					sub_tot =sub_amt - de_amount;
					sub_total = parseFloat(sub_tot).toFixed(2)
					grand_tot =total_amt - de_amount;

						vat = (Number(sub_total)*(15/100));
					
						vat_amount = parseFloat(vat).toFixed(2);
						total_include_vat = Number(sub_total)+Number(vat);
						grandtotal1 =parseFloat(total_include_vat).toFixed(2);
						$('#total').val(grandtotal1);
						$('#sub_t').val(sub_total);
						$('#vat_amount').val(vat_amount);
						
				}
			}
			function Find_vat_per(data='')
			{
				var total_value = $('#sub_t').val();
				vat = (Number(total_value)*(data/100));
				total_include_vat = Number(total_value)+Number(vat);
				grandtotal_include_vat =parseFloat(total_include_vat).toFixed(2);
				vat_amount = parseFloat(vat).toFixed(2);
				$('#vat_amount').val(vat_amount);
				$('#total').val(grandtotal_include_vat);
				
			}
			function GetInvoiceNo()
			{
				$.ajax({
								type: "GET",
								url: "<?php echo site_url('Credict_notes/get_credit_no'); ?>",
								dataType:"html",
								success: function(html)
								{	
								
									$('#cr_no').val(html);
								},
							});
			}
			function GetPerfomaNo()
			{
				$.ajax({
								type: "GET",
								url: "<?php echo site_url('Credict_notes/get_credit_perfoma_no'); ?>",
								dataType:"html",
								success: function(html)
								{	
								
									$('#cr_no').val(html);
								},
							});
			}
			function getInvoiceTotal(id)
			{
						$.ajax({
							type: "GET",
							url: "<?php echo site_url('Credict_notes/getInvoiceTotal'); ?>", 
							data: {invoice_num:id},
							dataType:"html",
							success: function(html)
							{	
								$('#invoice_total').val(html);
								$('#total').val(html);
				
							},
					});
			}
			// function get_vat_per(id)
			// {
			// 			$.ajax({
			// 				type: "GET",
			// 				url: "<?php echo site_url('Credict_notes/get_vat_per'); ?>", 
			// 				data: {invoice_num:id},
			// 				dataType:"html",
			// 				success: function(html)
			// 				{	
			// 					$('#vat_per').val(html);
				
			// 				},
			// 		});
			// }
			function get_vat_amount(id)
			{
						$.ajax({
							type: "GET",
							url: "<?php echo site_url('Credict_notes/get_vat_amount'); ?>", 
							data: {invoice_num:id},
							dataType:"html",
							success: function(html)
							{	
								$('#vat_amount').val(html);
				
							},
					});
			}
			function getInvoice_Type(id)
			{
						$.ajax({
							type: "GET",
							url: "<?php echo site_url('Credict_notes/getInvoice_Type'); ?>", 
							data: {invoice_num:id},
							dataType:"html",
							success: function(html)
							{	
								if(html==1)
								{
									$('#vat_label').css('display','none');
									$('#vat_data').css('display','none');
									$('#vat_amount_lbl').css('display','none');
									$('#vat_amount_data').css('display','none');
								}
								if(html==2)
								{
									$('#vat_label').css('display','block');
									$('#vat_data').css('display','block');
									$('#vat_amount_lbl').css('display','block');
									$('#vat_amount_data').css('display','block');
								}
								
				
							},
					});
			}
			function get_sub_total(id)
			{
		

						$.ajax({
							type: "GET",
							url: "<?php echo site_url('Credict_notes/getInvoice_subTotal'); ?>", 
							data: {invoice_num:id},
							dataType:"html",
							success: function(html)
							{	
								$('#sub_t').val(html);
						
				
							},
					});
			}
			function calculateqty()
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
				 vat_amt = $('#vat_per').val();

				 if(vat_amt=='')
				 {
				 	$('#sub_t').val(grandtotal);
				 	$('#total').val(grandtotal);
				 }
				 else
				 {
				 	
						vat = (Number(grandtotal)*(vat_amt/100));
						vat_amount = parseFloat(vat).toFixed(2);
						total_include_vat = Number(grandtotal)+Number(vat);
						grandtotal1 =parseFloat(total_include_vat).toFixed(2);

						$('#total').val(grandtotal1);
						$('#sub_t').val(grandtotal);
						$('#vat_amount').val(vat_amount);
						$('#vat_per').val(vat_amt);
				 }
			
				
			}
				</script>
			</div>
		</div><!-- Main Wrapper -->




