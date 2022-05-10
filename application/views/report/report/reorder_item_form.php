<?php
		$pro_group_id						= 	$this->input->post('pro_group_id');
		$pro_item_id						= 	$this->input->post('pro_item_id');
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
							<form  method="POST" action="<?php echo base_url();?>ProductReport/rendor_item"> 
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('to_date')){ echo 'has-error';} ?>">
										<label>Category </label>
										    <select name="category_id" id="category_id" class="form-control">
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
										<label>group </label>
											<select name="pro_group_id" id="pro_group_id" class="form-control">
                                            <?php foreach ($drop_menu_product as $key_id => $key_name) 
                                            {?>
                                            <option value="<?php echo $key_id;?>" <?php if($key_id == $pro_group_id){?> selected <?php }?>><?php echo $key_name;?></option>
											<?php 
                                            }?>
                                            </select>										
                                            <label class="error"><?php echo form_error('to_date'); ?></label>
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
					</div> 
				
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="row">
							<div class="row">
								<div class="panel-body" >
								<a href="<?php base_url();?>export_excel_reorder" target="_blank"  class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Export To Excel</a>
									<a href="<?php base_url();?>export_excel_reorder/print" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
									<table class="table table-striped" >                  
									<thead>
										<tr>
											<th>S.No</th>
											<th>Catrgory</th>
											<th>Group Name</th>
											<th>Product Name</th>
											<th>Pieces/unit</th>
											<th>Pieces Stock</th>
											<th>Reorder level</th>
											<th>Current Stock</th>
								
					
										
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
											<td><?php echo $row->category_name; ?></td>
											<td><?php echo $row->pro_group_name; ?></td>
											<td><?php echo $row->pro_item_name; ?></td>
											<?php $pieces_per_unit1+=$row->pieces_per_unit; ?>
											<td><?php echo $row->pieces_per_unit; ?></td>
											<?php $pieces_stock1+=$row->pieces_stock; ?>		
											<td><?php echo $row->pieces_stock;  ?></td>
											
											<?php $reorder_level1+=$row->reorder_level; ?>
											<td><strong><?php echo $row->reorder_level;  ?></strong></td>
											<?php $pro_item_stock1+=$row->pro_item_stock; ?>
											<td><button type="button" class="btn btn-danger"><?php echo $row->pro_item_stock;  ?></button></td>
									
											
										</tr>
										<?php
										}
										?>
										<tr> 
   

											<td></td>
											<td></td>
											<td></td>
											<td><strong>TOTAL</strong></td>
											<td><strong><?php echo $pieces_per_unit1;?></strong></td>
											<td><strong><?php echo $pieces_stock1;?></strong></td>

											<td><strong><?php echo $reorder_level1;?></strong></td>
											<td ><button type="button" class="btn btn-danger"><?php echo $pro_item_stock1;  ?></button></td>
										
											
											
										</tr>
									                   									
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
