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
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="row">
							<form  method="POST" action="<?php echo base_url();?>Report/purchase_report"> 
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('from_date')){ echo 'has-error';} ?>">
										<label>From Date <span1>*</span1></label>
											<input type="text" class="form-control date-picker" placeholder="Invoice Date" autocomplete="off" value="<?php echo ($from_date!='' && $from_date!='0000-00-00') ? date('m/d/Y', strtotime($from_date)) : date('m/d/Y'); ?>" name="from_date" id="from_date" style="background-color:#fff"  >
										<label class="error"><?php echo form_error('from_date'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>To Date <span1>*</span1></label>
											<input type="text" class="form-control date-picker" placeholder="Invoice Date" autocomplete="off" value="<?php echo ($to_date!='' && $to_date!='0000-00-00') ? date('m/d/Y', strtotime($to_date)) : date('m/d/Y'); ?>" name="to_date" id="to_date" style="background-color:#fff"  >
										<label class="error"><?php echo form_error('to_date'); ?></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Contacts<span1>*</span1></label>
											<?php 
											$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" onChange="menu_terms(this.value)" onclick="calculate()"';
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
							<div class="row">
								<div class="panel-body" >
									<table class="table table-striped" >                  
									<thead>
									<tr><h4> Purchase Order View List [<?PHP  echo $from_date;?>  To <?PHP echo $to_date;?>]</h4></tr>	                                           
										<tr>
											<th>S.No</th>
											<th>PO Number</th>
											<th>PO Date</th>
											<th>Vendor Name</th>
											<th>Sales Amount</th>           
											<th>Paid Amount</th>
											<th>Payment Status</th>
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
											<td><?php echo $row->con_company_name; ?></td>
											<td><?php echo $row->total_cost_price; ?></td>
											<td><?php echo $row->paid_amt; ?></td>
											<td><?php echo ($row->payment_status == 0) ? 'Pending' : 'Completed';  ?></td>
										</tr>
										<?php
										}
										?>
									                   									
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
	
