
<?php
$pro_group_id	= 	$this->input->post('pro_group_id');
$pro_item_id	= 	$this->input->post('pro_item_id');
$from_date	    = 	$this->input->post('from_date');
$to_date	    = 	$this->input->post('to_date');
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
							<form  method="POST" action="<?php echo base_url();?>ProductReport/customer_report"> 
								
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Client Name</label>
											<?php 
											$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" "';
											echo form_dropdown('vendor_id', $drop_menu_vendor, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
											?>
										<label class="error"><?php echo form_error('vendor_id'); ?></label>
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
				
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">
							
							<div class="row">
								<div class="panel-body" >
									<a href="<?php base_url();?>export_excel_customer_report" target="_blank"  class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Export To Excel</a>
									<a href="<?php base_url();?>export_excel_customer_report/print" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
									<h1> <?PHP  echo $from_date;?> <?php if(!empty($from_date)){echo "[to]";} ?> <?PHP echo $to_date;?></h1>                                           
									<table class="table table-striped" >                  
										<thead>
											<tr>
												<th>S.No</th>
												<th>Invoice Number</th>
												<th>Invoice Date</th>
												
												<th>Product Name</th>
												<th>QTY</th>           
												<th style="text-align : right;">Sales Price (<?php echo $getCurrency;?>)</th>
												<th style="text-align : right;">Sub Total (<?php echo $getCurrency;?>)</th>
												<th style="text-align : right;">Discount %</th>
												<th style="text-align : right;">Total sales Price (<?php echo $getCurrency;?>)</th>
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
												<td><?php echo $row->sal_order; ?></td>
												<td><?php echo date('d-M-Y', strtotime($row->sal_order_date)); ?></td>
												
												<td><?php echo $row->pro_item_id; ?></td>
												
												<?php $quantity1+=$row->quantity; ?>
												<td ><?php echo $row->quantity; ?></td>
												<?php $price_amt1+=$row->price_amt; ?>
												<td align="right"><?php echo $row->price_amt; ?></td>
												<?php $sub_total1+=$row->sub_total; ?>
												<td align="right"><?php echo $row->sub_total; ?></td>
												<td align="right"><?php echo $row->discount; ?></td>
												<?php $discount1+=$row->discount;?>
												<?php $sal_amount1+=$row->total_cost; ?>
												<td align="right"><?php echo $row->total_cost;  ?></td>
												
											</tr>
											<?php
											}
											if(!empty($productreport))
											{
											?>
											<tr> 
	    	

												
												<td></td>
												<td></td>
												<td></td>
												<td ><strong>TOTAL</strong></td>
												<td><strong><?php echo $quantity1;?></strong></td>
												<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($price_amt1, 2); ?></strong></td>
												<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($sub_total1, 2); ?></strong></td>
												<td align="right"><?php echo $discount1; echo " ";echo "%"; ?></td>
												<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($sal_amount1, 2); ?></strong></td>
												
											</tr>
										       <?php }?>            									
										</tbody>
									</table>
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