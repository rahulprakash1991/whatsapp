
<?php
		$pro_group_id						= 	$this->input->post('pro_group_id');
		$pro_item_id						= 	$this->input->post('pro_item_id');
		$from_date						    = 	$this->input->post('from_date');
		$to_date						    = 	$this->input->post('to_date');
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
	<?php $getCurrency=$this->pre->getCurrencynew();?>
		<div id="main-wrapper">
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="row">
							<form  method="POST" action="<?php echo base_url();?>ProductReport/vendor_report"> 
							<!-- 	<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('from_date')){ echo 'has-error';} ?>">
										<label>From Date </label>
											<input type="text" class="form-control date-picker" placeholder="From Date" autocomplete="off" value="<?php echo $from_date; ?>" name="from_date" id="from_date" style="background-color:#fff"  >
										<label class="error"><?php echo form_error('from_date'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>To Date </label>
											<input type="text" class="form-control date-picker" placeholder="To Date" autocomplete="off" value="<?php echo $to_date; ?>" name="to_date" id="to_date" style="background-color:#fff"  >
										<label class="error"><?php echo form_error('to_date'); ?></label>
									</div>
								</div> -->
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Vendor</label>
											<?php 
											$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" "';
											echo form_dropdown('vendor_id', $drop_menu_vendor, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
											?>
										<label class="error"><?php echo form_error('vendor_id'); ?></label>
									</div>
								</div>
							<!-- 	<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>Category </label>
										    <select name="category_id" id="category_id" class="form-control" onChange="loadcategory(this.value)">
                                            <?php foreach ($drop_menu_category as $key_id => $key_name) 
                                            {?>
                                            <option value="<?php echo $key_id;?>" <?php if($key_id == $category_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                            <?php 
                                            }?>
                                            </select>

										<label class="error"><?php echo form_error('to_date'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>group</label>
											<select name="pro_group_id" id="pro_group_id" class="form-control" onChange="loadaddress(this.value)">
                                            <?php foreach ($drop_menu_product as $key_id => $key_name) 
                                            {?>
                                            <option value="<?php echo $key_id;?>" <?php if($key_id == $pro_group_id){?> selected <?php }?>><?php echo $key_name;?></option>
											<?php 
                                            }?>
                                            </select>										
                                            <label class="error"><?php echo form_error('to_date'); ?></label>
									</div>
								</div> -->

						<!-- 	<div class="col-md-3">
								<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
									<label>Product<span1></span1></label>
										<?php 
										$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="pro_item_id"';
										echo form_dropdown('pro_item_id', $drop_menu_productitem, set_value('pro_item_id', (isset($pro_item_id)) ? $pro_item_id : ''), $attrib);
										?>
									<label class="error"><?php echo form_error('vendor_id'); ?></label>
								</div>
							</div> -->
								<div class="col-md-3">
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
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="row">
								<div class="panel-body" >
								<a href="<?php base_url();?>export_excel_vendor_report" target="_blank"  class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Export To Excel</a>
									<a href="<?php base_url();?>export_excel_vendor_report/print" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
									<table class="table table-striped" >                  
									<thead>
									<tr><h1> <?PHP  echo $from_date;?> <?php if(!empty($from_date)){echo "[to]";} ?> <?PHP echo $to_date;?></h1></tr>	                                           
										<tr>
											<th>S.No</th>
											<th style="width:10%;">PO Number</th>
											<th style="width:10%;">PO Date</th>
											<!-- <th style="width:10%;">Category</th>
											<th>Group Name</th> -->
											<th>Product Name</th>
											<th style="text-align : right;">QTY</th>           
											<th style="text-align : right;">Price<br>(<?php echo $getCurrency;?>)</th>
											<th style="text-align : right;">Sub Total<br>(<?php echo $getCurrency;?>)</th>
											<th style="text-align : right;">Discount<br>(%)</th>
											<th style="text-align : right;">Total Price<br>(<?php echo $getCurrency;?>)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach($productreport as $row)
										{
     
										?>                               
										<tr> 
    	

											<td><?php echo $i++;?></td>
											<td><?php echo $row->po_no; ?></td>
											<td><?php echo date('d-M-Y', strtotime($row->order_date)); ?></td>
										<!-- 	<td><?php echo $row->category_name; ?></td>
											<td><?php echo $row->pro_group_name; ?></td> -->
											<td><?php echo $row->item_name; ?></td>
											<?php $quantity1+=$row->quantity; ?>
											<td align="right"><?php echo $row->quantity; ?></td>
											<?php $selling_price1+=$row->price; ?>
											<td align="right"><?php echo $row->price; ?></td>
											<?php $cost_price1+=$row->sub_total; ?>
											<td align="right"><?php echo $row->sub_total;  ?></td>
											<?php $selling_total_amount1+=$row->discount; ?>
											<td align="right"><?php echo $row->discount;  ?></td>
											<?php $cost_total_amount1+=$row->total_amount; ?>
											<td align="right"><?php echo $row->total_amount;  ?></td>
										</tr>
										<?php
										}
									if(!empty($productreport))
									{
										?>
										<tr> 
    	
											<!-- <td></td>
											<td></td> -->
											<td></td>
											<td></td>
											<td></td>
											<td>TOTAL</td>
											<td align="right"><strong><?php echo $quantity1; ?></strong></td>
											<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($selling_price1, 2); ?></strong></td>
											<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($cost_price1, 2); ?></strong></td>
											<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($selling_total_amount1, 2); ?></strong></td>
											<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($cost_total_amount1, 2); ?></strong></td>
										</tr>
									   <?php }?>                									
									</tbody>
			
									</table>
									
								</div>
							</div>
						</div>   
					</div>                 	
				</div>	
			</div>
			
		</form>
	</div>
</div>	
	<script type="text/javascript">
			$(document).ready(function()
						{

						});
		function loadcategory(category_id)
		{
			
			$.ajax({
				type: "GET",
				url: "<?php echo site_url('ProductReport/loadaddress'); ?>", 
				data: { 

					category_id:category_id,
				
				},
				dataType:"html",
				success: function(html)
				{	
					
					
					 $("#pro_item_id").trigger(html);
					
				},
			});
		}
		function loadaddress(pro_item_id)
		{

			var category_id=$('#category_id').val();
			$.ajax({
				type: "GET",
				url: "<?php echo site_url('ProductReport/loadaddress'); ?>", 
				data: { 

					'category_id':category_id,
					'pro_item_id':pro_item_id
				},
				dataType:"html",
				success: function(html)
				{	
					
					$('#pro_item_id').html(html);
					
				},
			});
		}
</script>