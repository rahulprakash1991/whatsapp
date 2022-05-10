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
						<div class="panel-body">
							<div class="row">
							<form  method="POST" action="<?php echo base_url();?>Report/Outstanding_receivables"> 
								<div class="col-md-3">
									<div class="form-group <?PHP if(form_error('vendor_id')){ echo 'has-error';} ?>">
										<label>Client Name<span1>*</span1></label>
										<?php 
										$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="vendor_id" ';
										echo form_dropdown('vendor_id', $drop_menu_customer, set_value('vendor_id', (isset($vendor_id)) ? $vendor_id : ''), $attrib);
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
					<div class="panel panel-info" id='po_details'>                		
                                 

    	<div class="panel-body" >
            <table class="table table-striped" >  
            <a href="<?php base_url();?>outstanding_receivable_export" target="_blank"  class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Export To Excel</a>
			<a href="<?php base_url();?>outstanding_receivable_export/print" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a> 
                <thead>                                            
                    <tr>
                        <th>S.No</th>
                        <th>Client Name</th>
                        <th class="text-right">Outstanding Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                   
                     	$i=1;
                        $total  =   0;
                        foreach($menu_terms as $row)
                        {
                            $total   +=  $row['outstanding'];
                                                                   
                        ?>                                                  
                        <tr> 
                             <td>
                                <?php echo $i++;?>
                               
                            </td>
                            <td><?php echo $row['client_name']; ?></td>
                            
                            <td align="right">
                         <a href="<?php echo base_url(); ?>Report/customer_balance_sheet/<?php echo $row['sal_company_name'];?>"><?php  echo number_format($row['outstanding'],2); ?></a>

                   				
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                            <tr> 
                             <td>
                               
                               
                            </td>
                            <td align="right"><strong> Total Outstanding Amount</strong></td>
                            
                            <td align="right">
                   				<strong><?php echo number_format($total,2); ?></strong>
                            </td>
                        </tr>                                          
                </tbody>
            </table>

    	</div>
    </div> 
					
				</div>   
			</div>
			<!--
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-info">
						 <div class="panel-heading" role="tab" i>
		                    <h4 class="panel-title">
		                          Payment Details
		                     </h4>
		                </div> 
						<div class="panel-body">
							<br>		
						 
							<div class="row">                         		
							    <div class="form-group">
							        <label class="col-md-2 control-label">Payment Amount:</label>
							        <div class="col-md-4">
							            <input type="text" class="form-control" name="amt" id="amt" value="">
							        </div>
							    </div>  
							</div> 
							<br>
								<div class="row">                               
							    <div class="form-group cash">
										<label class="col-md-2 control-label" id="coll_date">Collection Date</label>
										<div class="col-md-4">			
											<input type="text" class="form-control date-picker" value="<?php echo date('d M, Y'); ?>" name="coll_date" id="coll_date" style="background-color:#fff">	
							    		</div>
							    </div>

							</div>
							<br>
							<div class="row"> 
							    <div class="form-group">
										<label class="col-md-2 control-label">Payment Mode :</label>
										<div class="col-md-4">			
											<?php 											
							        	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" onchange="paymentmode(this.value)" id="payment_mode_id"';
										echo form_dropdown('payment_mode_id', $drop_menu_payment_mode, set_value('payment_mode_id', (isset($payment_mode_id)) ? $payment_mode_id : ''), $attrib);
										?>							
							    	</div>
							    </div> 
							</div>
							<br>
							<div class="row">   
							     <div class="form-group cash" style="display:none";>
										<label class="col-md-2 control-label" id="trans_no"></label>
										<div class="col-md-4">			
											<input type="text" class="form-control" name="voucher_number" id="voucher_number"> 						
							    	</div>
							    </div>
							</div>
							<br>			                                       
							<div class="row">                               
							    <div class="form-group cash" style="display:none">
										<label class="col-md-2 control-label" id="trans_date"></label>
										<div class="col-md-4">			
											<input type="text" class="form-control date-picker" value="<?php echo ($neft_date!='' && $neft_date!='0000-00-00') ? $neft_date : date('d M, Y'); ?>" name="neft_date" id="neft_date" style="background-color:#fff">	
							    		</div>
							    </div>

							</div>
							 <br>
							 	<div class="row">                               
							    <div class="form-group cash" style="display:none">
										<label class="col-md-2 control-label" id="bank_name">Bank Name</label>
										<div class="col-md-4">			
											<input type="text" class="form-control"  value="" name="bank_name" id="bank_name">	
							    		</div>
							    </div>

							</div>
							 <br>
							<div class="row">
								<div class="form-group">
										<label class="col-md-2 control-label">Account heads  :</label>
										<div class="col-md-4">	
											<?php 	
							        	$attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%"  id="bank_id"';
										echo form_dropdown('bank_id', $drop_menu_bank, set_value('bank_id', (isset($bank_id)) ? $bank_id : ''), $attrib);
										?>				
							    	</div>
							    </div>
							</div>
							
						
							<br>
							<div class="row"> 		                                      
							    <div class="form-group">
							    	<div class="col-md-2"></div>
							    	<div class="col-md-4"> 
							    		<input type="submit" class="btn btn-primary" name="addpayment" value="Submit">
							    	</div>
							    </div>                                                                            
							</div>
						</div>
						
					</div>
				</div>
			</div>	
			-->
		</div>
	</form>
</div>
	
	

