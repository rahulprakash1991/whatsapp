<?php
if(isset($value) && !empty($value))
{
	foreach($value->result() as $row)
	{
	  	$po_id 			=	$row->po_id;
		$vendor_id 		=	$row->vendor_id; 
		$ref_no 		=	$row->ref_no;      
		$del_date 		=	$row->del_date;
		$item_id 		=	$row->item_id;    
		$ship_pref_id 	=	$row->ship_pref_id;       
	
	}
}
else
{
		$vendor_id	    =	$this->input->post('vendor_id');
		$from_date	    =	$this->input->post('from_date');
		$to_date	    =	$this->input->post('to_date');

		$vendor_id		= 	$this->input->post('vendor_id');
		$po_no			= 	$this->input->post('po_no');
		$order_date		=	$this->input->post('order_date');
		$del_date		=	$this->input->post('del_date');
		$ref_no			=	$this->input->post('ref_no');
		$ship_pref_id	=	$this->input->post('ship_pref_id');
		$po_status     	= 	$this->input->post('po_status');
		
		$pro_item_id	=	$this->input->post('pro_item_id');
		$unit1 			=	$this->input->post('unit1');
		$quantity1     	= 	$this->input->post('quantity1');
		$price1			=	$this->input->post('Price1');
		$unit 			=	$this->input->post('unit');
		$quantity     	= 	$this->input->post('quantity');
		$price_amt		=	$this->input->post('price_amt');
		$pdt_tax_amt	=	$this->input->post('pdt_tax_amt');
		$amount     	= 	$this->input->post('amount');
		$sub_total		=	$this->input->post('sub_total');
		$tot_tax_val	=	$this->input->post('tot_tax_val');
		$total 	     	= 	$this->input->post('total');

		
	    $trow			=	$this->input->post('attproduct');
}
	
	$i = 1;
	$trow = ($trow=='') ? 1 : $trow;
?>

			<div class="page-inner">
				<div class="page-title">
					<h3><?PHP echo $form_toptittle; ?></h3>
					<div class="page-breadcrumb">
						<div class="row">
                            <div class="col-md-6">
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url();?>">Home</a></li>
							<li class="active"><?PHP echo $form_toptittle; ?></li>
						</ol>
					</div>
					   <div class="col-md-6" align="right">
                                      <a href="<?php echo base_url().'sales_order';?>" style="text-align: right;" class="btn btn-primary "><?php echo 'Add New Invoice'?></a>
                                  </div>
                              </div>
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
					              $.ajax({"url":"<?php echo site_url('Sales_order/mailPo'); ?>",
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
								url: "<?php echo site_url('Purchase_order/getPartNoContent'); ?>", 
								data: {i:row},
								dataType:"html",
								success: function(html)
								{
									alert(html);
									row = Number($('#attproduct').val()) + 1;
									$('#partProductData').append(html);
									$('#attproduct').val( row );
									$('#pro_item_id'+row).select2();
									$('#unit1'+row).select2();
									$('#unit'+row).select2();
									//calculateTotQuantity();					
								},
							});
						}

						function loadPriceDetails(id,i)
						{
							$.ajax({
								type: "GET",
								url: "<?php echo site_url('Purchase_order/getProductPriceDetails'); ?>", 
								data: { pro_item_id:id},
								dataType:"html",
								success: function(html)
								{
									result = html.split('|');
									$('#pro_item_id'+i).val(result[0]);
									$('#pro_item_name'+i).val(result[1]);
									$('#price_amt'+i).val(result[2]);
									$('#tax_id'+i).val(result[3]);
									$('#tax_name'+i).val(result[4]);
									$('#tax_percent'+i).val(result[5]);
								},
							});
						}

						function getConfirmPart(inv,prid)
						{
							alert(prid);
						    var x;
						    var r=confirm("You Want Delete!!");
						    if(prid!='' && r==true)
						    {
						    	
						      $.ajax({"url":"<?php echo site_url('Purchase_order/'); ?>",
						      "type":"GET",
						      data:{
						          "prid":prid
						      },
						      success:function(data)
						        {
						          alert("Daelted Successfully");
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
							var total = 0;
							var tax = 0;
							$('.allrowvalues').each(function(i,o) 
							{
								var qty   =	$(o).find('.quantity',this).val();									
								var price =	$(o).find('.price_amt',this).val();
								var tax_percent =	$(o).find('.tax_percent',this).val();
								
								var totalQty = (Number(qty *1) * Number(price *1));
								var pdt_tax = (Number(qty *1) * Number(tax_percent *1));

								var tax_value = ((Number(pdt_tax *1) * Number(price *1))/100);

								$(o).find('.amount',this).val(totalQty);

								$(o).find('.pdt_tax_amt',this).val(tax_value);

								total+=Number(totalQty);
								tax+=Number(tax_value);	
								grandtotal = (Number(total *1) + Number(tax *1))
								
							});
								$('#sub_total').val(total);	
								$('#tot_tax_val').val(tax);
								$('#total').val(grandtotal);
						}
					</script>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
								<div class="panel-body">
								<form  method="POST" action="<?php echo base_url();?>Sales_order/manage"> 
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
											<label>Client</label>
												<?php 
												$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" ';
												echo form_dropdown('vendor_id', $drop_menu_customer, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
												?>
											<label class="error"><?php echo form_error('vendor_id'); ?></label>
										</div>
									</div>

								<div class="col-md-2">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>Payment Status</label>
										<select name="payment_status" id="payment_status" class="form-control" >
											<option value="">-- Select --</option>
                                   			<option value="1"<?php if($payment_status== '1'){ echo "selected";}?>>Completed</option>
                                    	 	<option value="0"<?php if($payment_status== '0'){ echo "selected";}?>>Pending </option>
                                        </select>										
                                      </div>
								</div>
								<div class="col-md-2">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>Invoice Status</label>
										<select name="inv_status" id="inv_status" class="form-control" >
											<option value="">-- Select --</option>
                                       		<option value="1" <?php if($inv_status== '1'){ echo "selected";}?>>Invoiced</option>
                                        	
                                          	<option value="0" <?php if($inv_status== '0'){ echo "selected";}?>>Draft</option>
										</select>										
                                    </div>
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
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
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

 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" >                       
                <div class="modal-content" id="viewajaxcontent" style="width: 50%;vertical-align: middle;margin-top: 350px;margin-left: 400px;" align="center">   
                </div>
            </div>
        </div>
<script type="text/javascript">
          function addrepModal(id)
          {

            $.ajax({
              type: "GET",
              url: "<?php echo site_url('Sales_order/addClientRep'); ?>",
              data: {invoice_id:id},
              dataType:"html",
              success: function(response)
              {
               
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });
           
          }
      </script>
	
	
 