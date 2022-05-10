<?php 
$from_date=$this->input->post('from_date');
$to_date=$this->input->post('to_date');
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
						<form  method="POST" action="<?php echo base_url();?>Report/purchase_report"> 
							<div class="col-md-3">
								<div class="form-group <?PHP if(form_error('from_date')){ echo 'has-error';} ?>">
									<label>From Date <span1></span1></label>
										<input type="text" class="form-control date-picker" placeholder="From Date" autocomplete="off" value="<?php echo $from_date; ?>" name="from_date" id="from_date" style="background-color:#fff"  >
									<label class="error"><?php echo form_error('from_date'); ?></label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
									<label>To Date <span1></span1></label>
										<input type="text" class="form-control date-picker" placeholder="To Date" autocomplete="off" value="<?php echo $to_date; ?>" name="to_date" id="to_date" style="background-color:#fff"  >
									<label class="error"><?php echo form_error('to_date'); ?></label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
									<label>Vendor<span1></span1></label>
										<?php 
										$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" ';
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
							<div class="row">
								<div class="panel-body" >
									<a href="<?php base_url();?>export_excel_purchase" target="_blank"  class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Export To Excel</a>

									<a href="<?php base_url();?>export_excel_purchase/print" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
									<table class="table table-striped" >                  
									<thead>
									<tr><h1> <?PHP  echo $from_date;?> <?php if(!empty($from_date)){echo "[to]";} ?> <?PHP echo $to_date;?></h1></tr>	                                           
										<tr>
											<th>S.No</th>
											<th>PO Number</th>
											<th>PO Date</th>
											<th>Vendor Name</th>
											<th style="text-align : right;">Purchase Amount(<?php echo $getCurrency;?>)</th>           
											<th style="text-align : right;">Paid Amount(<?php echo $getCurrency;?>)</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach($values as $row)
										{
     									?>                               
										<tr> 
											<td><?php echo $i++;?></td>
											<td><?php echo $row->po_no; ?></td>
											<td><?php echo date('d/m/Y', strtotime($row->order_date)); ?></td>
											<td><?php echo $row->vendor_name; ?></td>
											<?php $totalcostprice+=$row->total_cost_price; ?>
											<td align="right"><?php echo $row->total_cost_price; ?></td>
											<?php $paidamt+=$row->paid_amt; ?>
											<td align="right"> <?php echo $row->paid_amt; ?></td>
											
										</tr>
										<?php
										}
										if(!empty($values))
										{
										?>
									     <tr> 
											<td></td>
											<td></td>
											<td></td>
											<td align="right"><strong>TOTAL</strong></td>
											<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($totalcostprice, 2); ?></strong></td>
											<td align="right"><strong><?php echo $getCurrency;?> <?php echo number_format($paidamt, 2); ?></strong></td>
										
										</tr>             									
									</tbody>
									</table>
								</div>
							</div>
						</div>   
					</div>                 	
				</div>	
			</div>
			<?php
		}
			
			?>
		</form>
	</div>
</div>	
	
