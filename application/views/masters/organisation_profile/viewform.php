<?php
if(isset($value) && !empty($value))
{
	foreach($value->result() as $row)
	{
	    $org_id=$row->org_id;
		$org_logo=$row->org_logo; 
		$org_name=$row->org_name;      
		$org_street=$row->org_street;
		$org_area=$row->org_area;    
		$org_city=$row->org_city;       
		$org_state=$row->org_state; 
		$org_pincode=$row->org_pincode;  
		$org_country=$row->org_country;
		$org_phone=$row->org_phone;
		$org_mobile=$row->org_mobile;  
		$org_website =$row->org_website;
		$org_fax=$row->org_fax;
		$org_email=$row->org_email;  

		 
	}
}
else
{
		$org_logo=$this->input->post('org_logo');
		$org_name=$this->input->post('org_name');
		$org_street=$this->input->post('org_street');
		$org_area=$this->input->post('org_area');
		$org_city=$this->input->post('org_city');
		$org_state=$this->input->post('org_state');
		$org_pincode=$this->input->post('org_pincode');
		$org_country=$this->input->post('org_country');
		$org_phone=$this->input->post('org_phone');
		$org_mobile=$this->input->post('org_mobile');
		$org_website=$this->input->post('org_website');
		$org_fax=$this->input->post('org_fax');
		$org_email=$this->input->post('org_email');
				
}
?>

			<div class="page-inner">
				<div class="page-title">
					<h3><?PHP echo $form_toptittle; ?></h3>
					<div class="page-breadcrumb">
						<ol class="breadcrumb">
							<li><a href="<?php echo base_url();?>">Profile</a></li>
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
						<div class="col-md-9">
							<div class="panel panel-white">
								<div class="panel-heading clearfix">
									<h4 class="panel-title"><?PHP echo $form_tittle; ?></h4>
								</div>
								<div class="panel-body">
									<?php echo form_open_multipart($form_url); ?>
										
										<div class="row">
											<div class="col-md-2">
											<img src="<?php echo base_url().''.$org_logo;?>" width="100">
											</div>

                                            <div class="col-md-2">
                                                <div class="form-group <?PHP if(form_error('org_logo')){ echo 'has-error';} ?>">
                                                    <label>Logo:</label>
                                                    <?php echo form_open_multipart('upload/do_upload');?>
                                                     <input type="file" class="form-control"  id="org_logo" name="org_logo">
                                                     <label class="error"><?php echo form_error('org_logo	'); ?></label>
                                                </div>
                                   			</div> 
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_name')){ echo 'has-error';} ?>">
                                                    <label>Organisation Name:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Organisation Name" id="org_name" name="org_name" value="<?php echo $org_name; ?>">
                                                     <label class="error"><?php echo form_error('org_name    '); ?></label>
                                                </div>
                                            </div> 
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_street')){ echo 'has-error';} ?>">
                                                    <label>Street:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Street Name" id="org_street" name="org_street" value="<?php echo $org_street; ?>">
                                                     <label class="error"><?php echo form_error('org_street    '); ?></label>
                                                </div>
                                            </div> 
                                        </div> 

										<div class="row">
											<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_area')){ echo 'has-error';} ?>">
                                                    <label>Area:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Area Name" id="org_area" name="org_area" value="<?php echo $org_area; ?>">
                                                     <label class="error"><?php echo form_error('org_area'); ?></label>
                                                </div>
                                   			</div>
											<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_city')){ echo 'has-error';} ?>">
                                                    <label>City:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter City Name" id="org_city" name="org_city" value="<?php echo $org_city; ?>">
                                                     <label class="error"><?php echo form_error('org_city'); ?></label>
                                                </div>
                                   			</div>
                               				
                               				<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_state')){ echo 'has-error';} ?>">
                                                    <label>State:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter State Name" id="org_state" name="org_state" value="<?php echo $org_state; ?>">
                                                     <label class="error"><?php echo form_error('org_state'); ?></label>
                                                </div>
                                   			</div>                                   		
										</div>

										<div class="row">
											<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_pincode')){ echo 'has-error';} ?>">
                                                    <label>Pincode:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Pincode" id="org_pincode" name="org_pincode" value="<?php echo $org_pincode; ?>">
                                                     <label class="error"><?php echo form_error('org_pincode'); ?></label>
                                                </div>
                                   			</div>
                                   			<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_country')){ echo 'has-error';} ?>">
                                                    <label>Country:</label>
                                                     <input type="text" class="form-control error"  placeholder="Enter Country" id="org_country" name="org_country" value="<?php echo $org_country; ?>">
                                                     <label class="error"><?php echo form_error('org_country'); ?></label>
                                                </div>
                               				</div>
                                   			<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_phone')){ echo 'has-error';} ?>">
                                                    <label>Phone Number:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Phone Number" id="org_phone" name="org_phone" value="<?php echo $org_phone; ?>">
                                                     <label class="error"><?php echo form_error('org_phone'); ?></label>
                                                </div>
                                   			</div>
                               			</div>

                               			<div class="row">
                                   			<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_mobile')){ echo 'has-error';} ?>">
                                                    <label>Mobile Number:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Mobile Number" id="org_mobile" name="org_mobile" value="<?php echo $org_mobile; ?>">
                                                     <label class="error"><?php echo form_error('org_mobile'); ?></label>
                                                </div>
                                   			</div>
                                   			<div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_website')){ echo 'has-error';} ?>">
                                                    <label>Website:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Website" id="org_website" name="org_website" value="<?php echo $org_website; ?>">
                                                     <label class="error"><?php echo form_error('org_website'); ?></label>
                                                </div>
                                   			</div>
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_fax')){ echo 'has-error';} ?>">
                                                    <label>Fax:</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Website" id="org_fax" name="org_fax" value="<?php echo $org_fax; ?>">
                                                     <label class="error"><?php echo form_error('org_fax'); ?></label>
                                                </div>
                                            </div>
                                   		
                                   		</div>

                                        <div class="row">

                                   		   <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('org_email')){ echo 'has-error';} ?>">
                                                    <label>Email:</label>
                                                     <input type="text" class="form-control error"  placeholder="Enter Email" id="org_email" name="org_email" value="<?php echo $org_email; ?>">
                                                     <label class="error"><?php echo form_error('org_email'); ?></label>
                                                </div>
                                             </div>
                                        </div>                                   
                                    	

										<div class="text-center">
											<input type="hidden" name="org_id" value="<?php echo $org_id;?>" />												
											<button type="submit" name="Submit" class="btn btn-primary"><?php echo ($org_id!='1' ? 'Update Profile' : 'Update Profile'); ?> </button>
										</div>					
                                   
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div><!-- Row -->

					<!-- /page container -->
					<script type="text/javascript">
							$(document).ready(function() {
							var oTable = $('#example').dataTable( {
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
						} );
					} );
					</script>

				</div>
			</div><!-- Main Wrapper -->


	
	
 