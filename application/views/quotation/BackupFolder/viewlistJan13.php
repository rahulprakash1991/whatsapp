<?php
if(isset($evalue) && !empty($evalue))
{
	foreach($value->result() as $row)
	{
		$pro_id 					=	$row->pro_id;
		$pro_company_name 			=	$row->pro_company_name; 
		$pro_customer_address 		=	$row->pro_customer_address; 
		$pro_reference_date 		=	$row->pro_reference_date; 
		$pro_despatch 				=	$row->pro_despatch;
		$pro_destination 			=	$row->pro_destination;
		$pro_terms_delivery 		=	$row->pro_terms_delivery;
		$pro_payment_terms 			=	$row->pro_payment_terms;
		$pro_credit_period 			=	$row->pro_credit_period;
		$pro_invoice_status 		=	$row->pro_invoice_status; 
		$pro_order 					=	$row->pro_order;
		$pro_order_date 			=	$row->pro_order_date;
		$pro_delivery_date 			=	$row->pro_delivery_date;
		$pro_delivery_method 		=	$row->pro_delivery_method;
		$pro_person 				=	$row->pro_person;
		$pro_reference 				=	$row->pro_reference;
		$item_id 					=	$row->item_id;    
		$sub_total 					=	$row->pro_sub_total;
		$total 						=	$row->pro_grand_total;
		$discount 					=	$row->pro_discount;
		$shipping_amount 			=	$row->pro_delivery_amount;					    
		$po_status 					=	$row->po_status;	
		$total_tax_amts				=	explode(',',$row->tax_amount);
		$tax_type					=	explode(',',$row->tax_type);
		$po_created_by 				=	$row->po_created_by;			    
		$po_created_on 				=	$row->po_created_on;			    
	}

	foreach($evalue as $key =>$row)
	{

		$pro_item_id[$key] 			=	$row->pro_item_id;
		$unit[$key] 				=	$row->unit;
		$quantity[$key] 			=	$row->quantity;
		$price_amt[$key] 			=	$row->price_amt;
		$pro_tax_percentage[$key] 	=	$row->pro_tax_percentage;
		$amount[$key] 				=	$row->amount;	
		$po_pdt_id[$key] 			=	$row->po_pdt_id;
		$tax_id[$key]				=	$row->tax_id;
		$tax_name[$key]				=	$row->tax_name;
		$tax_percent[$key]			=	$row->tax_percent;
		$available_qty[$key]		=	$row->available_qty;
		$total_tax_amt[$key]		=   $row->total_tax_amt;
		$pro_tax_percentage[$key] 	=	(( $values->tax_percent * $row->amount ) /100);

		 $trow++;		

		}	

}
else
{
		$vendor_id	    =	$this->input->post('vendor_id');
		$from_date	    =	$this->input->post('from_date');
		$to_date	    =	$this->input->post('to_date');
		$status	    =	$this->input->post('status');
}
	
	$i = 1;
	$trow = ($trow=='') ? 1 : $trow;
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
					

					<!-- /page container -->
					<script type="text/javascript">
						
						function conformmail(id)
						{

						    var x;
						    var r=confirm("Are You Sure You Want to send a mail?!!");
						    if(id!='' && r==true)
						    {
							      $.ajax({"url":"<?php echo site_url('Proforma_invoice/mailPo'); ?>",
							      "type":"POST",
							      data:{
							          "id":id
							      },

							      success:function(data)
							        {
							          alert(data);
							        }
							      
							      });
							}
						}
						
						$(document).ready(function()
						{
							var oTable = $('#example').dataTable( {
								"bProcessing": true,
							responsive: true,
								"sAjaxSource": '<?php echo base_url().$datatable_url; ?>',
										"bJQueryUI": true,
										"sPaginationType": "full_numbers",
										"iDisplayStart ":20,
										"aaSorting": [],
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
					</script>
					<script type="text/javascript">
						function addNewPart()
						{
							row = $('#attproduct').val();
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Proforma_invoice/getPartNoContent'); ?>", 
								data: {i:row},
								dataType:"html",
								success: function(html)
								{
									//alert(html);
									
									//alert(row);
									$('#partProductData').append(html);
								
									$('#pro_item_id'+row).select2();
									$('#unit'+row).select2();
								

									//calculateTotQuantity();	
									row = Number($('#attproduct').val()) + 1;	
									$('#attproduct').val( row );			
								},
							});
						}

						function loadPriceDetails(id,i)
						{
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Proforma_invoice/getProductPriceDetails'); ?>", 
								data: { pro_item_id:id},
								dataType:"html",
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
									$("#unit"+i).select2("val", result[6]);
									$('#available_qty'+i).val(result[7]);
									checkproductdetails(id,i,result[6]);
									
								},
							});
						}

						function getConfirmPart(inv,prid)
						{
							//alert(prid);
						    var x;
						    var r=confirm("You Want Delete!!");
						    if(prid!='' && r==true)
						    {
						    	
						      $.ajax({"url":"<?php echo site_url('Proforma_invoice/deleteproduct'); ?>",
						      "type":"GET",
						      data:{
						          "prid":prid
						      },

						      success:function(data)
						        {
						          //alert("Daelted Successfully");
						          $('#rowssids_'+inv+'').remove();
						          $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
						          calculate();
						        }
						      
						      });
						   
					    	}
						    else if (prid=='' && r==true)
						    {

						      $('#rowssids_'+inv+'').remove();
						      $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
						      calculate();	
						    }
						}
						function calculate()
						{
							
							
							var grandtotal = 0;
							var subtotal = 0;
							var tax = 0;
							$('.allrowvalues').each(function(i,o) 
							{
								var qty   			=	$(o).find('.quantity',this).val();									
								var available_qty   =	$(o).find('.available_qty',this).val();									
								var price 			=	$(o).find('.price_amt',this).val();
								var tax_percent 	=	$(o).find('.tax_percent',this).val();								
								var tax_id 			=	$(o).find('.tax_id',this).val();

							
								
								if(Number(available_qty)<Number(qty))								
								{
									alert('Quantity not alailable');
									$(o).find('.quantity',this).val('');
									$(o).closest('.form-group6').addClass('has-error');
								}
									


								var total 		= (Number(qty *1) * Number(price *1));
								total=parseFloat(Math.round(total* 100) / 100).toFixed(2);
								var tax_value 	= ((Number(tax_percent) * Number(total))/100);

								$(o).find('.pro_tax_percentage',this).addClass('tax_'+tax_id);

								$(o).find('.amount',this).val(total);
								$(o).find('.pro_tax_percentage',this).val(tax_value);

								//taxTotal	=	$('#total_tax_amt'+tax_id).val();								
								//$('#total_tax_amt'+tax_id).val(Number(taxTotal)+Number(tax_value));								


								grandtotal=grandtotal+Number(total);
								grandtotal1=parseFloat(Math.round(grandtotal* 100) / 100).toFixed(2);

								//tax+=Number(tax_value);	

							});

							$('#sub_total').val(grandtotal1);

							vat_list 	= 	document.getElementsByName('tax_id[]');
							var v 		=	vat_list.length;
							total_sum 	=	0;

							$(".total_tax_amt").val('0');

							for(j=0;j<v;j++)
							{
							   taxId = vat_list[j].value;

							   //alert(taxId);


							   $("#total_tax_amt"+taxId).val('0');


							       var sum=0;
							       k=0;
							     
							       $(".tax_"+taxId).each(function(index, element) 
							       {
							            sum=sum + Number($(this).val());
							            sum1=parseFloat(Math.round(sum* 100) / 100).toFixed(2);

							       });
							                
							       $("#total_tax_amt"+taxId).val(sum1);

							       total_sum+=sum;
							       
							}

							
							
							var discount=$('#discount').val();
							var shipping_amount=$('#shipping_amount').val();
							var available_qty=$('.available_qty').val();
							

							grandtotal = Number(grandtotal) - Number(discount);
							grandtotal = Number(grandtotal) + Number(total_sum);
							grandtotal = Number(grandtotal) + Number(shipping_amount);
							grandtotal=parseFloat(Math.round(grandtotal* 100) / 100).toFixed(2);
							$('#total').val(grandtotal);
						}


					</script>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
								<div class="panel-body">
								<form  method="POST" action="<?php echo base_url();?>Proforma_invoice/manage"> 
									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('from_date')){ echo 'has-error';} ?>">
											<label>From Date <span1>*</span1></label>
												<input type="text" class="form-control date-picker" placeholder="Invoice Date" autocomplete="off" value="<?php echo ($from_date!='' && $from_date!='0000-00-00') ? date('m/d/Y', strtotime($from_date)) : date('m/d/Y'); ?>" name="from_date" id="from_date" style="background-color:#fff"  >
											<label class="error"><?php echo form_error('from_date'); ?></label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
											<label>To Date <span1>*</span1></label>
												<input type="text" class="form-control date-picker" placeholder="Invoice Date" autocomplete="off" value="<?php echo ($to_date!='' && $to_date!='0000-00-00') ? date('m/d/Y', strtotime($to_date)) : date('m/d/Y'); ?>" name="to_date" id="to_date" style="background-color:#fff"  >
											<label class="error"><?php echo form_error('to_date'); ?></label>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
											<label>Contacts<span1>*</span1></label>
												<?php 
												$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" ';
												echo form_dropdown('vendor_id', $drop_menu_customer, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
												?>
											<label class="error"><?php echo form_error('vendor_id'); ?></label>
										</div>
									</div>
									<div class="col-md-2">

										<label>Status</label>
											<select name="status" id="status" class="form-control" >
												<option value="">-- Select --</option>
                                       			<option value="1"<?php if($payment_status== '1'){ echo "selected";}?>>Invoiced</option>
                                        	 	<option value="0"<?php if($payment_status== '0'){ echo "selected";}?>>Proforma </option>
                                            </select>										
                                            
									</div>
								
									<div class="col-md-1">
										<div class="form-group">
										<br>
											<input type="hidden" value="1" name="searchFilter">
											<button type="submit" name="Submit" class="btn btn-primary">Submit</button>		
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</di
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
									<h4 class="panel-title"><?PHP echo $list_tittle; ?></h4>
								</div>
								<div class="panel-body">
								   <div class="table-responsive">
										<?php 
											echo $this->table->generate(); 
										?>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Row -->

				</div>
			</div><!-- Main Wrapper -->


	
	
 