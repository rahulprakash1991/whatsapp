<?php
if(isset($value) && !empty($value))
{
	foreach($value->result() as $row)
	{
	  	$co_id 			          =	$row->co_id;
	  	$co_number				  = $row->co_no;
		$vendor_id 		          =	$row->vendor; 
		$vendor_id2 		          =	$row->vendor2; 
		$vendor_id3 		          =	$row->vendor3; 
		$vendor_id4 		          =	$row->vendor4; 
		$ref_no 		          =	$row->ref_no;      
		$order_date 		          =	$row->order_date;
			
	 //    $po_created_by 			  =	$row->po_created_by;			    
		// $po_created_on 			  =	$row->po_created_on;			    
	}

	foreach($evalue as $key =>$row)
	{	
		$co_pdt_id[$key] 		=	$row->co_pro_id;    	
		$pro_item_id[$key] 		=	$row->pro_item_id;
		$cost[$key] 	=	$row->cost;
		$cost1[$key] 	=	$row->cost1;
		$cost2[$key] 	=	$row->cost2;
		$cost3[$key] 	=	$row->cost3;
		
		
		$trow++;
	}
	

}
else
{
	$sub_total 				 = 	$this->input->post('sub_total');
	$cost_amount             = 	$this->input->post('cost_amount');
	$total_selling_tax       = 	$this->input->post('total_selling_tax');
	$selling_total           = 	$this->input->post('selling_total');
	$expense_price           = 	$this->input->post('expense_price');
	$selling_expense_total   = 	$this->input->post('selling_expense_total');
	$overall_profit          =	$this->input->post('overall_profit');
	$overall_selling_price   = 	$this->input->post('overall_selling_price');
	$overall_purchase_price  =  $this->input->post('overall_purchase_price');
	$pieces_per_unit		 = 	$this->input->post('pieces_per_unit');
	$selling_price			 = 	$this->input->post('selling_price');
	$vendor_id				 = 	$this->input->post('vendor_id');
	$order_date				 =	$this->input->post('order_date');
	$del_date				 =	$this->input->post('del_date');
	$ref_no					 =	$this->input->post('ref_no');
	$ship_pref_id			 =	$this->input->post('ship_pref_id');
	$po_status     			 = 	$this->input->post('po_status');
	$terms					 =	$this->input->post('terms');
	$del_addr				 =	$this->input->post('del_addr');
	$notes     				 = 	$this->input->post('notes');
	$po 					 =	$row->po;
	$pro_item_id			 =	$this->input->post('pro_item_id');
	$unit1 					 =	$this->input->post('unit1');
	$uom2 					 =	$this->input->post('uom2');
	$price1					 =	$this->input->post('price1');
	$unit 					 =	$this->input->post('unit');
	$quantity     			 = 	$this->input->post('quantity');
	$price_amt				 =	$this->input->post('price_amt');
	$pdt_tax_amt			 =	$this->input->post('pdt_tax_amt');
	$amount     			 = 	$this->input->post('amount');
	$tot_tax_val			 =	$this->input->post('tot_tax_val');
	$total 	     			 = 	$this->input->post('total');
	$tax_percent 			 =	$this->input->post('tax_percent');
	$tax_name 	    		 = 	$this->input->post('tax_name');
	$tax_id 	    		 = 	$this->input->post('tax_id');
	$total_tax_amt 	    	 = 	$this->input->post('total_tax_amt');
	$tax_type 	    		 = 	explode(',',$this->input->post('tax_type'));
	$total_tax_amts 		 =	explode(',',$this->input->post('total_tax_amt'));
	$trow					 =	$this->input->post('attproduct');
	$trow1					 =	$this->input->post('attproduct1');
}

$i = 1;

$trow 	= ($trow=='') 	? 1 : $trow;
$trow1 	= ($trow1=='') 	? 1 : $trow1;

foreach ($tax_type as $key => $value)
{
	$total_tax_amt[$value] = $total_tax_amts[$key];
}
$getCurrency=$this->pre->getCurrencynew();
?>
<div class="page-inner">
	<div class="page-title">
		<h3><strong><?PHP echo $form_toptittle; ?></strong></h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url();?>"><strong>Home</strong></a></li>
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
		<?php echo form_open_multipart($form_url); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-heading clearfix">
						<h4 class="panel-title"></h4>
					</div>
					<div class="panel-body">
					<div class="row">
						  <div class="col-md-3">
                                  <div class="form-group <?PHP if(form_error('co_number')){ echo 'has-error';} ?>">
                                      <label>Costing  Number</label>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Costing Number" id="co_number" name="co_number" value="<?php echo $co_number; ?>" readonly>
                                                 <label class="error"><?php echo form_error('co_number'); ?></label>
                                        </div>
                                     </div> 
                               <div class="col-md-4">
								<div class="form-group <?PHP if(form_error('order_date')){ echo 'has-error';} ?>">
									<label>Costing Date</label>								
									<input type="text" autocomplete="off" class="form-control date-picker" placeholder="Order Date" value="<?php echo ($order_date!='' && $order_date!='0000-00-00') ? date('m/d/Y', strtotime($order_date)) : date('m/d/Y'); ?>" name="order_date" id="order_date" style="background-color:#fff"  >
								</div>
                               	<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('order_date'); ?></label>
	                        </div>
	                        <div class="col-md-5">
		                        <div class="form-group">
		                            <label>Reference Number (If Any)</label>
		                            <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Reference Number" id="ref_no" name="ref_no" value="<?php echo $ref_no; ?>">
	                        	</div>
		      				</div>
					</div>			
						<div class="row">
							<div class="col-md-3">
	                        	<div class="form-group ">
	                        		<h3><label style="font-size: 20px">Product Name <span1>*</span1></label></h3>
	                            </div>
	                      	</div>	
						 	<div class="col-md-2">
	                        	<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
	                        		<label>Vendor Name <span1>*</span1></label>
	                               	 	<?php 
	                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id"';
										echo form_dropdown('vendor_id', $drop_menu_vendor, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
										?>
										 <label class="error"><?php echo form_error('vendor_id'); ?>
									</label>
	                            </div>
	                      	</div>	
                      		 	<div class="col-md-2">
	                        	<div class="form-group <?PHP if(form_error('vendor_id2')){ echo 'has-error';} ?>">
	                        		<label>Vendor Name <span1>*</span1></label>
	                               	 	<?php 
	                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id2"';
										echo form_dropdown('vendor_id2', $drop_menu_vendor, set_value('vendor_id2', (isset($vendor_id2)) ? $vendor_id2 : ''), $attrib);
										?>
										 <label class="error"><?php echo form_error('vendor_id2'); ?>
									</label>
	                            </div>
	                      	</div>
	                      	 	<div class="col-md-2">
	                        	<div class="form-group <?PHP if(form_error('vendor_id3')){ echo 'has-error';} ?>">
	                        		<label>Vendor Name <span1>*</span1></label>
	                               	 	<?php 
	                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id3"';
										echo form_dropdown('vendor_id3', $drop_menu_vendor, set_value('vendor_id3', (isset($vendor_id3)) ? $vendor_id3 : ''), $attrib);
										?>
										 <label class="error"><?php echo form_error('vendor_id3'); ?>
									</label>
	                            </div>
	                      	</div>
	                      	 	<div class="col-md-2">
	                        	<div class="form-group <?PHP if(form_error('vendor_id4')){ echo 'has-error';} ?>">
	                        		<label>Vendor Name <span1>*</span1></label>
	                               	 	<?php 
	                                	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id4"';
										echo form_dropdown('vendor_id4', $drop_menu_vendor, set_value('vendor_id4', (isset($vendor_id4)) ? $vendor_id4 : ''), $attrib);
										?>
										 <label class="error"><?php echo form_error('vendor_id4'); ?>
									</label>
	                            </div>
	                      	</div>
		      		     			                           
	      				</div>
						<legend style="padding-top: 0px;padding-bottom:0px;"></legend>   
						<!-- <div class="panel panel-#b4b4b4">
							<div class="row">
			                	<div class="col-md-3">
									<label><strong>Product Name</strong></label>
								</div> -->
								<!--<div class="col-md-1">
									<center><label><strong>Unit</strong></label></center>
								</div>-->
							<!-- 									
							</div>
						</div> -->
						<div class="row">                 
                        		<span id="partProductData">
                                <?php 
                                $is=1;
                                for($i=0; $i < $trow; $i++)
						        {

                                    ?>
                                <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>">
                                	<div class="col-md-3">
                                    	<div class="form-group <?PHP if(form_error('pro_item_id['.$i.']')){ echo 'has-error';} ?>">
			                                <?php 
			                                $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="pro_item_id'.$i.'" onChange="loadPriceDetails(this.value,'.$i.')"';
											echo form_dropdown('pro_item_id[]', $drop_menu_product_item, set_value('pro_item_id['.$i.']', (isset($pro_item_id[$i])) ? $pro_item_id[$i] : ''), $attrib);
											?>
			                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pro_item_id['.$i.']'); ?></label>
			                            </div>                   
			                            <div class="form-group">
			                                <input type="hidden" name="co_pdt_id[]" value="<?php echo $co_pdt_id[$i];?>" id="co_pdt_id<?php echo$i?>">
		                            		</div> 			                            
									</div>

				

									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('cost['.$i.']')){ echo 'has-error';} ?>">
											<input name="cost[]" autocomplete="off" class="form-control " id="cost<?php echo $i;?>" type="text" value="<?php echo $cost[$i]; ?>" placeholder="cost" readonly/>
											<label id="location-error" class="validation-error-label" for="location"><?php echo form_error('cost[$i]'); ?></label>
   			                        
   			                            </div>
									</div>

									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('cost1['.$i.']')){ echo 'has-error';} ?>">
											<input name="cost1[]" autocomplete="off" class="form-control " id="cost1<?php echo $i;?>" type="text" value="<?php echo $cost1[$i]; ?>"  placeholder="cost" readonly/>
											
   			                            </div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
										
											<input type="text" name="cost2[]" autocomplete="off" class="form-control " id="cost2<?php echo $i;?>" value="<?php echo $cost2[$i];?>"   placeholder="cost" readonly/>
										</div>
									</div>		

									<div class="col-md-2">
										<div class="form-group <?PHP if(form_error('cost3[]')){ echo 'has-error';} ?>">
										
											<input name="cost3[]" autocomplete="off" class="form-control" id="cost3<?php echo $i;?>" type="text" value="<?php echo $cost3[$i]; ?>"  placeholder="cost" readonly/>
											
   			                            </div>
									</div>
							
									<div class="col-md-1"> 
									
                                        &nbsp;
										<span>
											<div class="col-md-1">
												<a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($co_pdt_id[$i]!='') ? ','.$co_pdt_id[$i] : '';?>)" class="btn btn-danger btn-xs"  title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
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
                       			<div class="col-md-10">
                                </div>
                                <div class="col-md-2 text-right">
                                    <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
                                    <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
                                </div>
                            </div>
                      	</div>
                        
                        <hr style="margin: 20px 0 !important;">
                           <div class="row">
                        	  
           						<div class="col-md-6 text-right">
								  <input type="hidden" class="form-control"  placeholder="Enter Receive Purchase Order Number" id="receive_number" name="receive_number" value="<?php echo $re_number;?>">
			                    <input type="hidden" name="co_id" value="<?php echo $co_id;?>" />     
			                    <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($co_id!='' ? 'Update Costing' : 'Create Costing'); ?> </button>	
				            	</div>
                      	</div>
         
				    </div>
              	</div>
			</div>
		</div>
      
	
		<?php echo form_close(); ?>

        
        
		<script type="text/javascript">
	
			$(document).ready(function()
			{
				calculate();
				
				var oTable = $('#example').dataTable({
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
				});
			});

			function addNewPart()
			{
				row = $('#attproduct').val();
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Costing/getPartNoContent');?>", 
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
			
			function addNewpricePart()
			{
				row = $('#attproduct1').val();
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/getPartNopriceContent'); ?>", 
					data: {i:row},
					dataType:"html",
					success: function(html)
					{
						
						$('#partProductData1').append(html);
						
						$('#expenses_menu_id'+row).select2();
			
						

						row = Number($('#attproduct1').val()) + 1;	
						$('#attproduct1').val( row );				
					},
				});
			}
			
			function check()
			{
				$('input:radio[name="status"]').change(function()
				{
				    if($(this).val() == '1')
				    {
				       $('#advance_status').css('display','block');
				       $('#advance_status1').css('display','block');
				       $('#advance_status2').css('display','block');
				       $('#cash1').css('display','none');
				    }
				    else 
				    {
				    	$('#advance_status').css('display','none');
				    	$('#advance_status1').css('display','none');
				    	$('#advance_status2').css('display','none');
				   		$('#cash1').css('display','none');
				   		$('#cash2').css('display','none');
				   		$('#cash3').css('display','none');
				    }
				    
				});							
			}

			function call(val)
			{
				if(val == 1)
				{							
					$('#voucher_numbers').css('display','block');							
					$('#cash2').css('display','none');
				
				}
				else if(val == 2)
				{
					$('#cheque_numbers').css('display','block');
					$('#cheque_dates').css('display','block');
					$('#bank_names').css('display','block');

					$('#cheque_number').val('');
					$('#cheque_date').val('');
					$('#bank_name').val('');
				}
				else
				{
					$('.cash').css('display','none');
				}

			}

			function podetails(i)
			{
				var pdt_id = $('#pro_item_id'+i).val();

				if(pdt_id > 0)
				{
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/viewdetails'); ?>", 
					data: { pro_item_id:pdt_id},
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

			function loadPriceDetails(id,i)
			{
				var vender_id1 = $('#vendor_id').val();
				var vender_id2 = $('#vendor_id2').val();
				var vender_id3 = $('#vendor_id3').val();
				var vender_id4 = $('#vendor_id4').val();
				
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Costing/find_min_cost'); ?>", 
					data: {pro_item_id:id,vender_id1:vender_id1,vender_id2:vender_id2,vender_id3:vender_id3,vender_id4:vender_id4},
					dataType:"html",
					success: function(html)
					{	
						result = html.split('|');
					
						$('#pro_item_id'+i).val(id);
						//$('#pro_item_name'+i).val(result[1]);
						$('#cost'+i).val(result[0]);
						
						
						$('#cost1'+i).val(result[1]);
						$('#cost2'+i).val(result[2]);
						$('#cost3'+i).val(result[3]);
						// $('#unit').val(result[6]);
						// $('#pieces_per_unit'+i).val(parseFloat(result[7]).toFixed(2));
						// $('#selling_price'+i).val(result[8]);
						
						// checkproductdetails(id,i,result[6]);													
						
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
				
					$('#tax_id'+i).val(' ');
					$('#tax_name'+i).val(' ');
					$('#tax_percent'+i).val(' ');
					$('#unit').val('');
				}
				else
				{
					loadunit(unitid,i);	
				}
				calculate();	
			}

			function loadunit(id,i)
			{
				$.ajax({
					type: "GET",
					url: "<?php echo site_url('Purchase_order/getProductUnit'); ?>", 
					data: { "pro_unit_id":id,"i":i},
					dataType:"html",
					success: function(html)
					{	
						$('#unit_id_drop'+i).html(html);
						$('#unit'+i).select2();
						//calculate();
					},
				});
			}

			function getConfirmPart(inv,prid)
			{
		
			    var x;
			    var r=confirm("You Want Delete!!");
			  
			    if(prid!='' && r==true)
			    {
			      $.ajax({"url":"<?php echo site_url('Costing/deleteproduct'); ?>",
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
				function getConfirmPart1(inv,prid)
			{
		
			    var x;
			    var r=confirm("You Want Delete!!");
			    if(prid!='' && r==true)
			    {
			      $.ajax({"url":"<?php echo site_url('Purchase_order/deleteexpense'); ?>",
			      "type":"GET",
			      data:{
			          "prid":prid
			      },

			      success:function(data)
			        {
			          //alert("Daelted Successfully");
			          $('#rowssids1_'+inv+'').remove();
			          $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
			          calculate();
			        }
			      
			      });
			   
		    	}
			    else if (prid=='' && r==true)
			    {

			      $('#rowssids1_'+inv+'').remove();
			      $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
			      calculate();	
			    }
			}

			function calculate()
			{	
					
				var grandtotal 		= 0;
				var subtotal 		= 0;
				var tax 			= 0;
				var selling_total   = 0;
				var selling_tax 	= 0;
				var shipping_amount = 0;
				var expense_price 	= 0;
				var selling_total1 	= 0;
				var grandtotal1 	= 0;
				

				$('.allrowvalues').each(function(i,o) 
				{
					var qty   		        =	$(o).find('.quantity',this).val();							
					var price 		        =	$(o).find('.price_amt',this).val();
					var selling_price 		=	$(o).find('.selling_price',this).val();
					var tax_percent		    =	$(o).find('.tax_percent',this).val();
					var tax_id 				=	$(o).find('.tax_id',this).val();
				
					
					
					var total 				=  (Number(qty *1) * Number(price *1));
					total                   = parseFloat(total).toFixed(2);
					var selling_price 		=  (Number(qty *1) * Number(selling_price *1));
					selling_price           = parseFloat(selling_price).toFixed(2);
					var tax_value 			=  ((Number(tax_percent) * Number(total))/100);
					var selling_tax 		=  ((Number(tax_percent) * Number(selling_price))/100);
				
					$(o).find('.pdt_tax_amt',this).addClass('tax_'+tax_id);
					$(o).find('.selling_tax_amt',this).addClass('selling_tax_amt_'+tax_id);

					$(o).find('.amount',this).val(selling_price);
					$(o).find('.cost_amount',this).val(total);
					$(o).find('.pdt_tax_amt',this).val(tax_value);
					$(o).find('.selling_tax_amt',this).val(selling_tax);
					
					grandtotal+=Number(total);
					selling_total+=Number(selling_price);

					
				});
				grandtotal=parseFloat(grandtotal).toFixed(2);
				selling_total=parseFloat(selling_total).toFixed(2);
				$('#sub_total').val(grandtotal);
				$('#selling_total').val(selling_total);

				vat_list 	= 	document.getElementsByName('tax_id[]');
				var v 		=	vat_list.length;
				total_sum 	=	0;

				$(".total_tax_amt").val('0');
				
				for(j=0;j<v;j++)
				{
				   taxId = vat_list[j].value;

				   $("#total_tax_amt"+taxId).val('0');
				   $("#total_selling_tax"+taxId).val('0');

				       var sum=0;
				       var sum1=0;
				       

				       k=0;
				     
				       $(".tax_"+taxId).each(function(index, element) 
				       {
				            sum=sum + Number($(this).val());
				            sum1=parseFloat(sum).toFixed(2);
				       });

				       $(".selling_tax_amt_"+taxId).each(function(index, element) 
				       {
				            sum1= sum1 + Number($(this).val());
				            sum1=parseFloat(sum1).toFixed(2);
				       });
				    
				       $("#total_tax_amt"+taxId).val(sum);
				       $("#total_selling_tax"+taxId).val(sum1);
				     
				       grandtotal 		= parseFloat((Number(grandtotal) + Number(sum))).toFixed(2);
				       selling_total1 	= parseFloat((Number(selling_total) + Number(sum1))).toFixed(2);
				     
				     
				}
					var totalExpense = 0;
					$('.expense_price').each(function (index, element) 
					{
						totalExpense =totalExpense +  Number($(this).val());
						
					});
					totalExpense=parseFloat(Number(totalExpense)).toFixed(2);
			    grandtotal1=parseFloat(Number(grandtotal)+Number(totalExpense)).toFixed(2);
			    totalExpense1=parseFloat(Number(selling_total1)-Number(grandtotal1)).toFixed(2);
			   
				$('#total').val(grandtotal);
				$('#selling_price_total_tax').val(selling_total1);
				$('#selling_expense_total').val(totalExpense);
				$('#overall_purchase_price').val(grandtotal1);
				$('#overall_selling_price').val(selling_total1);
				$('#overall_profit').val(totalExpense1);
				
			}

			function paymentmode(val)
			{
				if($('#payment_mode_id').val() == 1)
				{
					$('#cash1').css('display','block');
					$('#cash2').css('display','block');
					$('#cash3').css('display','block');
					$("#trans_no").html("Voucher Number");								
					$("#trans_date").html("Voucher Date");
					$("#trans_amt").html("Amount");
				}
				if($('#payment_mode_id').val() == 2)
				{
					$('#cash1').css('display','block');
					$('#cash2').css('display','block');
					$('#cash3').css('display','block');
					$("#trans_no").html("Cheque Number");
					$("#trans_date").html("Cheque Date");
					$("#trans_amt").html("Amount");
				
				}
				if($('#payment_mode_id').val() == 3)
				{
					$('#cash1').css('display','block');
					$('#cash2').css('display','block');
					$('#cash3').css('display','block');
					$("#trans_no").html("NEFT Number");
					$("#trans_date").html("NEFT Date");
					$("#trans_amt").html("Amount");
				
				}
			}
		</script>				
	</div>				
</div><!-- Main Wrapper -->


	
	
 