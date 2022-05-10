<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $c_org_name		=	$row->c_org_name;
        $c_logo			=	$row->c_logo;       
        $c_area			=	$row->c_area;       
        $c_city			=	$row->c_city;       
        $c_state		=	$row->c_state;       
        $c_pincode		=	$row->c_pincode;
        $c_country		=	$row->c_country;
        $c_phone		=	$row->c_phone;       
        $c_mobile		=	$row->c_mobile;       
        $c_fax			=	$row->c_fax;       
        $c_website		=	$row->c_website;       
        $c_email		=	$row->c_email;   
        $c_currency		=	$row->c_currency;   
        $c_tax			=	$row->c_tax;
        $c_cst			=	$row->c_cst;      
        $c_street		=	$row->c_street;   
    }
}
else
{
		$c_logo				=	$this->input->post('c_logo');
		$c_org_name			=	$this->input->post('c_org_name');
		$c_street			=	$this->input->post('c_street');
		$c_area				=	$this->input->post('c_area');
		$c_city				=	$this->input->post('c_city');
		$c_state			=	$this->input->post('c_state');
		$c_pincode			=	$this->input->post('c_pincode');
		$c_country			=	$this->input->post('c_country');
		$c_phone			=	$this->input->post('c_phone');
		$c_mobile			=	$this->input->post('c_mobile');
		$c_fax				=	$this->input->post('c_fax');
		$c_website			=	$this->input->post('c_website');
		$c_email			=	$this->input->post('c_email');
		$c_currency			=	$this->input->post('c_currency');
		$c_tax				=	$this->input->post('c_tax');
		$c_cst				=	$this->input->post('c_cst');
		
}
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <?php echo form_open_multipart($form_url); ?>
                        <h3>Organization Info</h3>
                        <hr>

                         <div class="col-md-12">
                            <div class="col-md-6">
                                <label>Organization Logo</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <?php
                                        if($c_logo!='')
                                        {
                                        ?>
                                            <img src="<?php echo base_url().$c_logo; ?>" style="height:50px;" />
                                        <?PHP 
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group <?PHP if(form_error('c_logo')){ echo 'has-error';} ?>">
                                            <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                                            <input class="form-control" type="file" autocomplete="off" size="75" name="c_logo"  value="<?php echo $c_logo;?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <div class="form-group <?PHP if(form_error('c_org_name')){ echo 'has-error';} ?>">
                                    <label>Organization Name</label>
                                    <input type="text" class="form-control" autocomplete="off"  placeholder="Organization Name" id="c_org_name" name="c_org_name" value="<?php echo $c_org_name; ?>">
                                    <label class="error"><?php echo form_error('c_org_name'); ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <h3>Address</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                            <label>Street</label>
                                <div class="input-group <?PHP if(form_error('c_street')){ echo 'has-error';} ?>">
                                   
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="Street" id="c_street" name="c_street" value="<?php echo $c_street; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_street'); ?></label>
                            </div>
                            <div class="col-md-3">
                              <label>Area</label>
                                <div class="input-group <?PHP if(form_error('c_area')){ echo 'has-error';} ?>">
                                  
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="Area" id="c_area" name="c_area" value="<?php echo $c_area; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_area'); ?></label>
                            </div>
                            <div class="col-md-3">
                              <label>City</label>
                                    <div class="input-group <?PHP if(form_error('c_city')){ echo 'has-error';} ?>">
                                                                        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="City" id="c_city" name="c_city" value="<?php echo $c_city; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_city'); ?></label>
                            </div>
                            <div class="col-md-3">
                            <label>State</label>
                                <div class="input-group <?PHP if(form_error('c_state')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    <input type="text" class="form-control" autocomplete="off"  placeholder="State" id="c_state" name="c_state" value="<?php echo $c_state; ?>">
                                </div>
                                <label class="error"><?php echo form_error('c_state'); ?></label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Pincode</label>
                                <div class="input-group <?PHP if(form_error('c_pincode')){ echo 'has-error';} ?>">
                                 <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <input type="text" class="form-control" autocomplete="off"  placeholder="Pincode" id="c_pincode" name="c_pincode" value="<?php echo $c_pincode; ?>">
                                </div>
                                <label class="error"><?php echo form_error('c_pincode'); ?></label>
                            </div>
                            <div class="col-md-3">
                                <label>Country</label>
                                <div class="input-group <?PHP if(form_error('c_country')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <input type="text" class="form-control" autocomplete="off"  placeholder="Country" id="c_country" name="c_country" value="<?php echo $c_country; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_country'); ?></label>
                            </div>
                        </div>
                        <h3>Contacts</h3>
                        <hr>
                        <div class="row">    
                            <div class="col-md-3">
                                <label>Phone</label>
                                <div class="input-group <?PHP if(form_error('c_phone')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                     <input type="text" class="form-control" autocomplete="off"  placeholder="Phone" id="c_phone" name="c_phone" value="<?php echo $c_phone; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_phone'); ?></label>
                            </div>
                            <div class="col-md-3">
                              <label>Mobile</label>
                                <div class="input-group <?PHP if(form_error('c_mobile')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa fa-mobile"></i></div>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="Mobile" id="c_mobile" name="c_mobile" value="<?php echo $c_mobile; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_mobile'); ?></label>
                            </div>
                            <div class="col-md-3">
                              <label>Skype</label>
                                <div class="input-group <?PHP if(form_error('c_fax')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa-fax"></i></div>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="Skype" id="c_fax" name="c_fax" value="<?php echo $c_fax; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_fax'); ?></label>
                            </div>
                            <div class="col-md-3">
                             <label>Website</label>
                                <div class="input-group <?PHP if(form_error('c_website')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa-external-link"></i></div>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Website" id="c_website" name="c_website" value="<?php echo $c_website; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_website'); ?></label>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <label>Email</label>
                                <div class="input-group <?PHP if(form_error('c_email')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type="text" class="form-control"  autocomplete="off" placeholder="Email" id="c_email" name="c_email" value="<?php echo $c_email; ?>">
                                    </div>
                                <label class="error"><?php echo form_error('c_email'); ?></label>
                        </div>
                        </div>
                        
                        <h3>Other Information</h3>
                       <hr>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group <?PHP if(form_error('c_currency')){ echo 'has-error';} ?>">
                              <label>Currency:<span1>*</span1></label>
                              <select name="c_currency" id="c_currency" class="form-control">
                              <?php foreach ($drop_menu_currency as $key_id => $key_name) 
                              {?>
                              <option value="<?php echo $key_id;?>" <?php if($key_id == $c_currency){?> selected <?php }?>><?php echo $key_name;?></option>
                
                              <?php 
                              }?>
                              </select>
                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('c_currency'); ?></label>
                            </div>
                          </div>
                            <div class="col-md-4">
                                 <label>CR No</label>
                                    <div class="input-group <?PHP if(form_error('c_tax')){ echo 'has-error';} ?>">
                                        <div class="input-group-addon"><i class="fa fa-cc-mastercard"></i></div>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="PAN No" id="c_tax" name="c_tax" value="<?php echo $c_tax; ?>">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                 <label>VAT No</label>
                                <div class="input-group <?PHP if(form_error('c_cst')){ echo 'has-error';} ?>">
                                    <div class="input-group-addon"><i class="fa fa-cc-mastercard"></i></div>
                                    <input type="text" class="form-control" autocomplete="off"  placeholder="CI / Vendor No" id="c_cst" name="c_cst" value="<?php echo $c_cst; ?>">
                                      <label class="error"><?php echo form_error('c_cst'); ?></label>
                                </div>
                            </div>
                        </div>
                     
                        <div class="text-center">
                        <button type="submit" name="Submit" class="btn btn-primary">submit</button>
                        </div>
                         </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
</div>


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
                
               <!-- Main Wrapper -->


    
    
