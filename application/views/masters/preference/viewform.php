<?php
if(isset($value) && !empty($value))
{
    $prdcode_number =   $this->pref->prdcode_number;
    $prdcode_prefix =   $this->pref->prdcode_prefix;
    $po_number      =   $this->pref->po_number; 
    $po_prefix      =   $this->pref->po_prefix;      
    $po_suffix	    =	$this->pref->po_suffix;
    $po_terms	    =	$this->pref->po_terms;    
    $po_notes	    =	$this->pref->po_notes;
    $re_number	    =	$this->pref->re_number; 
    $re_prefix	    =	$this->pref->re_prefix;      
    $re_suffix	    =	$this->pref->re_suffix;
    $re_terms	    =	$this->pref->re_terms;    
    $re_notes	    =	$this->pref->re_notes;        
    $dc_number	    =	$this->pref->dc_number; 
    $dc_prefix	    =	$this->pref->dc_prefix;
    $dc_suffix	    =	$this->pref->dc_suffix;  
    $dc_terms	    =	$this->pref->dc_terms;
    $dc_notes	    =	$this->pref->dc_notes;
    $quo_number     =	$this->pref->quo_number;  
    $quo_prefix 	=	$this->pref->quo_prefix;
    $quo_suffix 	=	$this->pref->quo_suffix;
    $quo_terms	    =	$this->pref->quo_terms;  
    $quo_notes	    =	$this->pref->quo_notes;  
      $dquo_number     = $this->pref->dquo_number;  
    $dquo_prefix     =   $this->pref->dquo_prefix;
    $dquo_suffix     =   $this->pref->dquo_suffix;
    $dquo_terms      =   $this->pref->dquo_terms;  
    $dquo_notes      =   $this->pref->dquo_notes;
    $inv_number	    =	$this->pref->inv_number;  
    $inv_prefix	    =	$this->pref->inv_prefix;   
    $inv_suffix	    =	$this->pref->inv_suffix; 
    $inv_terms	    =	$this->pref->inv_terms;  
    $inv_notes	    =	$this->pref->inv_notes; 
    $pro_inv_number	=	$this->pref->pro_inv_number;  
    $pro_inv_prefix	=	$this->pref->pro_inv_prefix;  
    $pro_inv_suffix	=	$this->pref->pro_inv_suffix; 
    $pro_inv_terms	=	$this->pref->pro_inv_terms;  
    $pro_inv_notes	=	$this->pref->pro_inv_notes;
    $discounts	    =	$this->pref->discounts;  
    $add_charges	=	$this->pref->add_charges;
    $cost_number    =   $this->pref->cost_number;
    $cost_prifix    =   $this->pref->cost_prifix;
    $cost_suffix    =   $this->pref->cost_suffix;
    $cost_terms    =   $this->pref->cost_terms;
    $cost_notes    =   $this->pref->cost_notes;
    $enq_number    =   $this->pref->enq_number;
    $enq_prifix    =   $this->pref->enq_prifix;
    $enq_suffix    =   $this->pref->enq_suffix;
    $smtp_port = $this->pref->smtp_port;
    $com_email = $this->pref->com_email;
    $com_pass = $this->pref->com_pass;
    $com_ssl = $this->pref->com_ssl;
    $client_number = $this->pref->client_number;
    $client_prefix = $this->pref->client_prefix;
    $vendor_number = $this->pref->vendor_number;
    $vendor_prefix = $this->pref->vendor_prefix;
    $inv_number_draft        =   $this->pref->inv_number_draft;  
    $inv_prefix_draft     =   $this->pref->inv_prefix_draft;   
    $inv_suffix_draft     =   $this->pref->inv_suffix_draft; 
    $pro_inv_number_draft    =   $this->pref->pro_inv_number_draft;  
    $pro_inv_prefix_draft =   $this->pref->pro_inv_prefix_draft;  
    $pro_inv_suffix_draft =   $this->pref->pro_inv_suffix_draft; 
    $credit_number = $this->pref->credit_number;
    $credit_prefix = $this->pref->credit_prefix;
    $per_credit_number = $this->pref->per_credit_number;
    $per_credit_prefix = $this->pref->per_credit_prefix;
  
}
else
{
    $prdcode_number  =  $this->input->post('prdcode_number');
    $prdcode_prefix  =  $this->input->post('prdcode_prefix');
    $po_number       =  $this->input->post('po_number');
    $po_prefix       =  $this->input->post('po_prefix');
    $po_suffix	     =	$this->input->post('po_suffix');
    $po_terms	     = 	$this->input->post('po_terms');
    $po_notes	     =	$this->input->post('po_notes');
    $dc_number	     =	$this->input->post('dc_number');
    $dc_prefix	     =	$this->input->post('dc_prefix');
    $dc_suffix	     =	$this->input->post('dc_suffix');
    $dc_terms	     =	$this->input->post('dc_terms');
    $dc_notes	     =	$this->input->post('dc_notes');
    $quo_number	     =	$this->input->post('quo_number');
    $quo_prefix	     =	$this->input->post('quo_prefix');
    $quo_suffix	     =	$this->input->post('quo_suffix');
    $quo_terms	     =	$this->input->post('quo_terms');
    $quo_notes	     =	$this->input->post('quo_notes');
    $dquo_number        =  $this->input->post('dquo_number');
    $dquo_prefix      =  $this->input->post('dquo_prefix');
    $dquo_suffix      =  $this->input->post('dquo_suffix');
    $dquo_terms       =  $this->input->post('dquo_terms');
    $dquo_notes       =  $this->input->post('dquo_notes');
    $inv_number	     =	$this->input->post('inv_number');   
    $inv_prefix	     =	$this->input->post('inv_prefix');       
    $inv_suffix	     =	$this->input->post('inv_suffix');       
    $inv_terms	     =	$this->input->post('inv_terms');       
    $inv_notes	     =	$this->input->post('inv_notes');  
    $pro_inv_number	 =	$this->input->post('pro_inv_number');   
    $pro_inv_prefix	 =	$this->input->post('pro_inv_prefix');       
    $pro_inv_suffix	 =	$this->input->post('pro_inv_suffix');       
    $pro_inv_terms	 =	$this->input->post('pro_inv_terms');       
    $pro_inv_notes	 =  $this->input->post('pro_inv_notes');      
    $discounts	     =	$this->input->post('discounts');       
    $add_charges	 =	$this->input->post('add_charges');
    $cost_number    =   $this->input->post('cost_number');
    $cost_prifix    =   $this->input->post('cost_prifix');
    $cost_suffix    =   $this->input->post('cost_suffix');
    $cost_terms    =  $this->input->post('cost_terms');
    $cost_notes    =  $this->input->post('cost_notes');
    $smtp_port     =  $this->input->post('smtp_port');
    $com_email     =  $this->input->post('com_email');
    $com_pass      =  $this->input->post('com_pass');
    $com_ssl       =  $this->input->post('com_ssl');
    $client_prefix = $this->input->post('client_prefix');
    $client_number = $this->input->post('client_number');
    $vendor_number = $this->input->post('vendor_number');
    $vendor_prefix = $this->input->post('vendor_prefix');
    $inv_number_draft     =   $this->input->post('inv_number_draft');  
    $inv_prefix_draft     =   $this->input->post('inv_prefix_draft');  
    $inv_suffix_draft     =   $this->input->post('inv_suffix_draft'); 
    $pro_inv_number_draft =   $this->input->post('pro_inv_number_draft');  
    $pro_inv_prefix_draft =   $this->input->post('pro_inv_prefix_draft');  
    $pro_inv_suffix_draft =   $this->input->post('pro_inv_suffix_draft');
    $credit_number = $this->input->post('credit_number');
    $credit_prefix = $this->input->post('credit_prefix');
     $per_credit_number = $this->input->post('per_credit_number');
    $per_credit_prefix = $this->input->post('per_credit_prefix');

   
}
if(isset($value1) && !empty($value1))
{
    foreach($value1->result() as $row)
    {
        $c_id            =   $row->c_id;
        $c_logo   =   $row->c_logo;  
        $c_org_name      =   $row->c_org_name;
        $c_street          =   $row->c_street;
        $c_area      =   $row->c_area;
        $c_city         =   $row->c_city;
        $c_state           =   $row->c_state;
        $c_pincode       =   $row->c_pincode;     
        $c_country    =   $row->c_country;      
        $c_phone            =   $row->c_phone;      
        $c_mobile        =   $row->c_mobile; 
        $c_fax = $row->c_fax;
         $c_website           =   $row->c_website;
        $c_email       =   $row->c_email;     
        $c_currency    =   $row->c_currency;      
        $c_tax            =   $row->c_tax;      
        $c_cst        =   $row->c_cst;     
             
    }
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
        <?php echo form_open_multipart($form_url); ?>
     <!-- <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-success">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Company Details</h4>
                            </div>
                            <div class="panel-body">
                            <br>
                                <?php echo form_open_multipart($form_url); ?>
                                      
                                    <div class="row">                                                   
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('company_name')){ echo 'has-error';} ?>">
                                                <label>Company Name<span1>*</span1></label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Name" id="company_name" name="company_name" value="<?php echo $c_org_name; ?>">
                                                 <label class="error"><?php echo form_error('company_name'); ?></label>
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_street')){ echo 'has-error';} ?>">
                                                <label>Street</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Street" id="c_street" name="c_street" value="<?php echo $c_street; ?>">
                                                 <label class="error"><?php echo form_error('c_street'); ?></label>
                                            </div>
                                        </div> 
                                          <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_area')){ echo 'has-error';} ?>">
                                                <label>Area</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Area" id="c_area" name="c_area" value="<?php echo $c_area; ?>">
                                                 <label class="error"><?php echo form_error('c_area'); ?></label>
                                            </div>
                                        </div> 
                                    </div> 

                                    <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_city')){ echo 'has-error';} ?>">
                                                <label>City</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company City" id="c_city" name="c_city" value="<?php echo $c_city; ?>">

                                                 <label class="error"><?php echo form_error('c_city'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_state')){ echo 'has-error';} ?>">
                                                <label>State</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company State" id="c_state" name="c_state" value="<?php echo $c_state; ?>">

                                                 <label class="error"><?php echo form_error('c_pincode'); ?></label>
                                            </div>
                                        </div> 
                                             <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_pincode')){ echo 'has-error';} ?>">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Pincode" id="c_pincode" name="c_pincode" value="<?php echo $c_pincode; ?>">

                                                 <label class="error"><?php echo form_error('c_pincode'); ?></label>
                                            </div>
                                        </div>                                                                   
                                    </div>
                                        <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_country')){ echo 'has-error';} ?>">
                                                <label>Country</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Country" id="c_country" name="c_country" value="<?php echo $c_country; ?>">

                                                 <label class="error"><?php echo form_error('c_country'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_phone')){ echo 'has-error';} ?>">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Phone Number" id="c_phone" name="c_phone" value="<?php echo $c_phone; ?>">

                                                 <label class="error"><?php echo form_error('c_phone'); ?></label>
                                            </div>
                                        </div> 
                                             <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_mobile')){ echo 'has-error';} ?>">
                                                <label>Mobile<span1>*</span1></label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Mobile Number" id="c_mobile" name="c_mobile" value="<?php echo $c_mobile; ?>">

                                                 <label class="error"><?php echo form_error('c_mobile'); ?></label>
                                            </div>
                                        </div>                                                                   
                                    </div>
                                       <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_fax')){ echo 'has-error';} ?>">
                                                <label>Fax</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Fax" id="c_fax" name="c_fax" value="<?php echo $c_fax; ?>">

                                                 <label class="error"><?php echo form_error('c_fax'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_website')){ echo 'has-error';} ?>">
                                                <label>Website</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Website" id="c_website" name="c_website" value="<?php echo $c_website; ?>">

                                                 <label class="error"><?php echo form_error('c_website'); ?></label>
                                            </div>
                                        </div> 
                                             <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_email')){ echo 'has-error';} ?>">
                                                <label>Email<span1>*</span1></label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Email" id="c_email" name="c_email" value="<?php echo $c_email; ?>">

                                                 <label class="error"><?php echo form_error('c_email'); ?></label>
                                            </div>
                                        </div>                                                                   
                                    </div>
                                        <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_currency')){ echo 'has-error';} ?>">
                                                <label>Currency<span1>*</span1></label>
                                                <?php 
                                                    $attrib = 'class="bootstrap-select" data-live-search="true" data-width="100%" id="c_currency" ';
                                                    echo form_dropdown('c_currency', $drop_menu_currency, set_value('   c_currency', (isset($c_currency)) ? $c_currency : ''), $attrib);
                                                    ?>

                                                 <label class="error"><?php echo form_error('c_currency'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_tax')){ echo 'has-error';} ?>">
                                                <label>Tax</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company Tax" id="c_tax" name="c_tax" value="<?php echo $c_tax; ?>">

                                                 <label class="error"><?php echo form_error('c_tax'); ?></label>
                                            </div>
                                        </div> 
                                             <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('c_cst')){ echo 'has-error';} ?>">
                                                <label>CST</label>
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Company CST" id="c_cst" name="c_cst" value="<?php echo $c_cst; ?>">

                                                 <label class="error"><?php echo form_error('c_cst'); ?></label>
                                            </div>
                                        </div>                                                                   
                                    </div>
                                    <div class="row">
                                          <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('c_logo')){ echo 'has-error';} ?>">
                                                <label>Company Logo<span1>*</span1></label>
                                                 <input type="file" autocomplete="off" class="form-control"   id="c_logo" name="c_logo" >
                                                 <label class="error"><?php echo form_error('c_logo'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                       <?php if($c_logo!=''){?>
                                        <div class="row">
                                         
                                        <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('product_imageee')){ echo 'has-error';} ?>">
                                         <img  src="<?php echo config_item("image_url").$c_logo
                                         ; ?>" style="width: 20%;height: 15%;" class="img-fluid img-thumbnail" alt="">
                                    </div>
 
                                    </div>
                                </div>
                                <?php } ?>
                                    <div class="row">
                                          <div class="col-md-12">
                                        <div class="form-group pull-right">
                                        <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-20">
                                                <input type="hidden" name="key_id" value="<?php echo $key_id;?>" />
                                                <button type="submit" name="Submit1" class="btn btn-primary">Update Company Details</button>
                                            </div>
                                        </div>
                                    </div>
                                   </div>
                            </div>
                        </div>
                    </div> 
                </div>  -->
                <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Purchase Order</h4>
                            </div>
                            <div class="panel-body">
                            <br>
                                <?php echo form_open_multipart($form_url); ?>
                                      
                                    <div class="row">                                                   
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('po_number')){ echo 'has-error';} ?>">
                                                <label>Purchase Order Number</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Purchase Order Number" id="po_number" name="po_number" value="<?php echo $po_number; ?>">
                                                 <label class="error"><?php echo form_error('po_number'); ?></label>
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('po_prefix')){ echo 'has-error';} ?>">
                                                <label>Purchase Order Prefix</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Purchase Order Prefix" id="po_prefix" name="po_prefix" value="<?php echo $po_prefix; ?>">
                                                 <label class="error"><?php echo form_error('po_prefix'); ?></label>
                                            </div>
                                        </div> 
                                          <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('po_suffix')){ echo 'has-error';} ?>">
                                                <label>Purchase Order Suffix</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Purchase Order Suffix" id="po_suffix" name="po_suffix" value="<?php echo $po_suffix; ?>">
                                                 <label class="error"><?php echo form_error('po_suffix'); ?></label>
                                            </div>
                                        </div> 
                                    </div> 

                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('po_terms')){ echo 'has-error';} ?>">
                                                <label>Terms and Conditions</label>
                                                 <textarea id="console" name="po_terms" autocomplete="off" class="form-control summernote" rows="4"><?php echo $po_terms;?></textarea>

                                                 <label class="error"><?php echo form_error('po_terms'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('po_notes')){ echo 'has-error';} ?>">
                                                <label>Notes</label>
                                                 <textarea id="console" name="po_notes" autocomplete="off" class="form-control summernote" rows="4"><?php echo $po_notes;?></textarea>

                                                 <label class="error"><?php echo form_error('po_notes'); ?></label>
                                            </div>
                                        </div>                                                                  
                                    </div>
                            </div>
                        </div>
                    </div> 
                </div> 
                
                <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-info">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Goods Receive Note</h4>
                            </div>
                            <div class="panel-body">
                            <br>
                              
                                      
                                    <div class="row">                                                   
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('re_number')){ echo 'has-error';} ?>">
                                                <label>Receive Order Number</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Receive Order Number" id="re_number" name="re_number" value="<?php echo $re_number; ?>">
                                                 <label class="error"><?php echo form_error('re_number  '); ?></label>
                                            </div>
                                        </div> 
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('re_prefix')){ echo 'has-error';} ?>">
                                                <label>Receive Order Prefix</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Receive Order Prefix" id="re_prefix" name="re_prefix" value="<?php echo $re_prefix; ?>">
                                                 <label class="error"><?php echo form_error('re_prefix  '); ?></label>
                                            </div>
                                        </div> 
                                          <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('re_suffix')){ echo 'has-error';} ?>">
                                                <label>Receive Order Suffix</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Receive Order Suffix" id="re_suffix" name="re_suffix" value="<?php echo $re_suffix; ?>">
                                                 <label class="error"><?php echo form_error('re_suffix '); ?></label>
                                            </div>
                                        </div> 
                                    </div> 
                
                

                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('re_terms')){ echo 'has-error';} ?>">
                                                <label>Terms and Conditions</label>
                                                 <textarea id="console" name="re_terms" autocomplete="off" class="form-control summernote" rows="4"><?php echo $re_terms;?></textarea>

                                                 <label class="error"><?php echo form_error('re_terms'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('re_notes')){ echo 'has-error';} ?>">
                                                <label>Notes</label>
                                                 <textarea id="console" name="re_notes" autocomplete="off" class="form-control summernote" rows="4"><?php echo $re_notes;?></textarea>

                                                 <label class="error"><?php echo form_error('re_notes'); ?></label>
                                            </div>
                                        </div>                                                                  
                                    </div>
                            </div>
                        </div>
                    </div> 
                </div> 
              <!--   /// Companny Email -->
               <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Company email</h4>
                            </div>
                            <div class="panel-body">
                            <br>
                              
                                      
                                    <div class="row">                                                   
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('smtp_port')){ echo 'has-error';} ?>">
                                                <label> SMPT Port Number</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter SMPT Port Number" id="smtp_port" name="smtp_port" value="<?php echo $smtp_port; ?>">
                                                 <label class="error"><?php echo form_error('smtp_port  '); ?></label>
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('com_email')){ echo 'has-error';} ?>">
                                                <label>EMail ID:</label>
                                                 <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Email ID" id="com_email" name="com_email" value="<?php echo $com_email; ?>">
                                                 <label class="error"><?php echo form_error('com_email  '); ?></label>
                                            </div>
                                        </div> 
                                          <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('com_pass')){ echo 'has-error';} ?>">
                                                <label>Password:</label>
                                                 <input type="Password" class="form-control" autocomplete="off"  placeholder="Enter Email Password" id="com_pass" name="com_pass" value="<?php echo $com_pass; ?>">
                                                 <label class="error"><?php echo form_error('com_pass '); ?></label>
                                            </div>
                                        </div> 
                                             <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('com_ssl')){ echo 'has-error';} ?>">
                                                <label>SSL Enabled:</label>
                                            <select name="com_ssl" class="form-control">
                                            <option value="1" <?php if($com_ssl=='1'){?> selected <?php }?>>Yes</option>
                                            <option value="0" <?php if($com_ssl=='0'){?> selected <?php }?>>No</option>
                                        </select>
                                                 <label class="error"><?php echo form_error('com_ssl '); ?></label>
                                            </div>
                                        </div> 
                                    </div> 
                
                

                            
                            </div>
                        </div>
                    </div> 
                </div> 

               <!--  End Email -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Quotation</h4>
                            </div>                                
                            <div class="panel-body">
                                <br>
                                <div class="row">                                                 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('quo_number')){ echo 'has-error';} ?>">
                                            <label>Quotation Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Quotation Number" id="quo_number" name="quo_number" value="<?php echo $quo_number; ?>">
                                             <label class="error"><?php echo form_error('quo_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('quo_prefix')){ echo 'has-error';} ?>">
                                            <label>Quotation Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Quotation  Prefix" id="quo_prefix" name="quo_prefix" value="<?php echo $quo_prefix; ?>">
                                             <label class="error"><?php echo form_error('quo_prefix  '); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('quo_suffix')){ echo 'has-error';} ?>">
                                            <label>Quotation Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Quotation  Suffix" id="quo_suffix" name="quo_suffix" value="<?php echo $quo_suffix; ?>">
                                             <label class="error"><?php echo form_error('quo_suffix '); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('quo_terms')){ echo 'has-error';} ?>">
                                            <label>Terms and Conditions</label>
                                             <textarea id="console" name="quo_terms" autocomplete="off" class="form-control summernote" rows="4"><?php echo $quo_terms;?></textarea>

                                             <label class="error"><?php echo form_error('quo_terms'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('quo_notes')){ echo 'has-error';} ?>">
                                            <label>Notes</label>
                                             <textarea id="console" name="quo_notes" autocomplete="off" class="form-control summernote" rows="4"><?php echo $quo_notes;?></textarea>

                                             <label class="error"><?php echo form_error('quo_notes'); ?></label>
                                        </div>
                                    </div>                                                                  
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 

<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Quotation Draft</h4>
                            </div>                                
                            <div class="panel-body">
                                <br>
                                <div class="row">                                                 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('dquo_number')){ echo 'has-error';} ?>">
                                            <label>Draft Quotation Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Draft Quotation Number" id="dquo_number" name="dquo_number" value="<?php echo $dquo_number; ?>">
                                             <label class="error"><?php echo form_error('dquo_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('dquo_prefix')){ echo 'has-error';} ?>">
                                            <label>Draft Quotation Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Draft Quotation  Prefix" id="dquo_prefix" name="dquo_prefix" value="<?php echo $dquo_prefix; ?>">
                                             <label class="error"><?php echo form_error('dquo_prefix  '); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('dquo_suffix')){ echo 'has-error';} ?>">
                                            <label>Draft Quotation Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Draft Quotation  Suffix" id="dquo_suffix" name="dquo_suffix" value="<?php echo $dquo_suffix; ?>">
                                             <label class="error"><?php echo form_error('dquo_suffix '); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('dquo_terms')){ echo 'has-error';} ?>">
                                            <label>Terms and Conditions</label>
                                             <textarea id="console" name="dquo_terms" autocomplete="off" class="form-control summernote" rows="4"><?php echo $dquo_terms;?></textarea>

                                             <label class="error"><?php echo form_error('dquo_terms'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('dquo_notes')){ echo 'has-error';} ?>">
                                            <label>Notes</label>
                                             <textarea id="console" name="quo_notes" autocomplete="off" class="form-control summernote" rows="4"><?php echo $dquo_notes;?></textarea>

                                             <label class="error"><?php echo form_error('dquo_notes'); ?></label>
                                        </div>
                                    </div>                                                                  
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Proforma Invoice</h4>
                            </div>
                            <div class="panel-body">
                                <br>    
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('pro_inv_number')){ echo 'has-error';} ?>">
                                            <label>Proforma Invoice Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Proforma Invoice Number" id="pro_inv_number" name="pro_inv_number" value="<?php echo $pro_inv_number; ?>">
                                             <label class="error"><?php echo form_error('pro_inv_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('pro_inv_prefix')){ echo 'has-error';} ?>">
                                            <label> Proforma Invoice Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Proforma Invoice Prefix" id="pro_inv_prefix" name="pro_inv_prefix" value="<?php echo $pro_inv_prefix; ?>">
                                             <label class="error"><?php echo form_error('pro_inv_prefix'); ?></label>
                                        </div>
                                    </div> 
                                      <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('pro_inv_suffix')){ echo 'has-error';} ?>">
                                            <label>Proforma Invoice Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Proforma Invoice  Suffix" id="pro_inv_suffix" name="pro_inv_suffix" value="<?php echo $pro_inv_suffix; ?>">
                                             <label class="error"><?php echo form_error('pro_inv_suffix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('pro_inv_terms')){ echo 'has-error';} ?>">
                                            <label>Terms and Conditions</label>
                                             <textarea id="console" name="pro_inv_terms" autocomplete="off" class="form-control summernote" rows="4"><?php echo $pro_inv_terms;?></textarea>

                                             <label class="error"><?php echo form_error('pro_inv_terms'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('pro_inv_notes')){ echo 'has-error';} ?>">
                                            <label>Notes</label>
                                             <textarea id="console" name="pro_inv_notes" autocomplete="off" class="form-control summernote" rows="4"><?php echo $pro_inv_notes;?></textarea>

                                             <label class="error"><?php echo form_error('pro_inv_notes'); ?></label>
                                        </div>
                                    </div>                                                                  
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

            <!--     // Draft performa  -->
                  <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Proforma Draft Invoice</h4>
                            </div>
                            <div class="panel-body">
                                <br>    
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('pro_inv_number_draft')){ echo 'has-error';} ?>">
                                            <label>Proforma Draft Invoice Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Proforma Draft Invoice Number" id="pro_inv_number_draft" name="pro_inv_number_draft" value="<?php echo $pro_inv_number_draft; ?>">
                                             <label class="error"><?php echo form_error('pro_inv_number_draft'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('pro_inv_prefix_draft')){ echo 'has-error';} ?>">
                                            <label> Proforma Draft Invoice Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Proforma draft Invoice  Prefix" id="pro_inv_prefix_draft" name="pro_inv_prefix_draft" value="<?php echo $pro_inv_prefix_draft; ?>">
                                             <label class="error"><?php echo form_error('pro_inv_prefix_draft'); ?></label>
                                        </div>
                                    </div> 
                                      <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('pro_inv_suffix_draft')){ echo 'has-error';} ?>">
                                            <label>Proforma Invoice Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Proforma Draft Invoice  Suffix" id="pro_inv_suffix_draft" name="pro_inv_suffix_draft" value="<?php echo $pro_inv_suffix_draft; ?>">
                                             <label class="error"><?php echo form_error('pro_inv_suffix_draft'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                         
                            </div>
                        </div>
                    </div> 
                </div>

            <!--     end -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Invoice</h4>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">                                                   
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('inv_number')){ echo 'has-error';} ?>">
                                            <label>Invoice Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Invoice Number" id="inv_number" name="inv_number" value="<?php echo $inv_number; ?>">
                                             <label class="error"><?php echo form_error('inv_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('inv_prefix')){ echo 'has-error';} ?>">
                                            <label>Invoice Prefix</label>
                                             <input type="text" class="form-control"  autocomplete="off" placeholder="Enter Invoice Prefix" id="inv_prefix" name="inv_prefix" value="<?php echo $inv_prefix; ?>">
                                             <label class="error"><?php echo form_error('inv_prefix'); ?></label>
                                        </div>
                                    </div> 
                                      <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('inv_suffix')){ echo 'has-error';} ?>">
                                            <label>Invoice Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Invoice  Suffix" id="inv_suffix" name="inv_suffix" value="<?php echo $inv_suffix; ?>">
                                             <label class="error"><?php echo form_error('inv_suffix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('inv_terms')){ echo 'has-error';} ?>">
                                            <label>Terms and Conditions</label>
                                             <textarea id="console" name="inv_terms" autocomplete="off" class="form-control summernote" rows="4"><?php echo $inv_terms;?></textarea>

                                             <label class="error"><?php echo form_error('inv_terms'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('inv_notes')){ echo 'has-error';} ?>">
                                            <label>Notes</label>
                                             <textarea id="console" name="inv_notes" autocomplete="off" class="form-control summernote" rows="4"><?php echo $inv_notes;?></textarea>

                                             <label class="error"><?php echo form_error('inv_notes'); ?></label>
                                        </div>
                                    </div>                                                                  
                                </div>
                             </div>
                        </div>
                    </div> 
                </div>

              <!--   Invoice Draft Updated Rahul 2022 jan  -->
                    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Invoice Draft</h4>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">                                                   
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('inv_number_draft')){ echo 'has-error';} ?>">
                                            <label>Invoice Draft Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Invoice Draft Number" id="inv_number_draft" name="inv_number_draft" value="<?php echo $inv_number_draft; ?>">
                                             <label class="error"><?php echo form_error('inv_number_draft'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('inv_prefix_draft')){ echo 'has-error';} ?>">
                                            <label>Invoice Draft Prefix</label>
                                             <input type="text" class="form-control"  autocomplete="off" placeholder="Enter Invoice Draft Prefix" id="inv_prefix_draft" name="inv_prefix_draft" value="<?php echo $inv_prefix_draft; ?>">
                                             <label class="error"><?php echo form_error('inv_prefix_draft'); ?></label>
                                        </div>
                                    </div> 
                                      <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('inv_suffix_draft')){ echo 'has-error';} ?>">
                                            <label>Invoice  Draft Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Invoice  Draft Suffix" id="inv_suffix_draft" name="inv_suffix_draft" value="<?php echo $inv_suffix_draft; ?>">
                                             <label class="error"><?php echo form_error('inv_suffix_draft'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                             </div>
                        </div>
                    </div> 
                </div>

<!-- // Costing -->
   
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Costing</h4>
                            </div>
                            <div class="panel-body">
                                <br>

                                <div class="row">                                                   
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('cost_number')){ echo 'has-error';} ?>">
                                            <label>Costing Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Cost Number" id="cost_number" name="cost_number" value="<?php echo $cost_number; ?>">
                                             <label class="error"><?php echo form_error('cost_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('cost_prifix')){ echo 'has-error';} ?>">
                                            <label>Costing Prefix</label>
                                             <input type="text" class="form-control"  autocomplete="off" placeholder="Enter Cost Prefix" id="cost_prifix" name="cost_prifix" value="<?php echo $cost_prifix; ?>">
                                             <label class="error"><?php echo form_error('cost_prifix'); ?></label>
                                        </div>
                                    </div> 
                                      <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('cost_suffix')){ echo 'has-error';} ?>">
                                            <label>Costing Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Cost Suffix" id="cost_suffix" name="cost_suffix" value="<?php echo $cost_suffix; ?>">
                                             <label class="error"><?php echo form_error('cost_suffix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 

                                <div class="row">
                                     
                                        <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('cost_terms')){ echo 'has-error';} ?>">
                                                <label>Terms and Conditions</label>
                                                 <textarea id="console" name="cost_terms" autocomplete="off" class="form-control summernote" rows="4"><?php echo $cost_terms;?></textarea>

                                                 <label class="error"><?php echo form_error('cost_terms'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('cost_notes')){ echo 'has-error';} ?>">
                                                <label>Notes</label>
                                                 <textarea id="console" name="cost_notes" autocomplete="off" class="form-control summernote" rows="4"><?php echo $cost_notes;?></textarea>

                                                 <label class="error"><?php echo form_error('cost_notes'); ?></label>
                                            </div>
                                        </div>

                                </div>
                             </div>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Product Code</h4>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('prdcode_number')){ echo 'has-error';} ?>">
                                            <label>Product Code Number</label>
                                             <input type="text" class="form-control" autocomplete="off" placeholder="Enter Product Code Number" id="prdcode_number" name="prdcode_number" value="<?php echo $prdcode_number; ?>">
                                             <label class="error"><?php echo form_error('prdcode_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('prdcode_prefix')){ echo 'has-error';} ?>">
                                            <label>Product Code Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Product Code Prefix" id="prdcode_prefix" name="prdcode_prefix" value="<?php echo $prdcode_prefix; ?>">
                                             <label class="error"><?php echo form_error('prdcode_prefix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div> 
             <!--    // Enquiry -->
               <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-danger">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Enquiry </h4>
                            </div>
                            <div class="panel-body">
                                <br>

                                <div class="row">                                                   
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('enq_number')){ echo 'has-error';} ?>">
                                            <label>Enquiry Number</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Enquiry Number" id="enq_number" name="enq_number" value="<?php echo $enq_number; ?>">
                                             <label class="error"><?php echo form_error('enq_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('enq_prifix')){ echo 'has-error';} ?>">
                                            <label>Enquiry Prefix</label>
                                             <input type="text" class="form-control"  autocomplete="off" placeholder="Enter Enquiry Prefix" id="enq_prifix" name="enq_prifix" value="<?php echo $enq_prifix; ?>">
                                             <label class="error"><?php echo form_error('enq_prifix'); ?></label>
                                        </div>
                                    </div> 
                                      <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('enq_suffix')){ echo 'has-error';} ?>">
                                            <label>Enquiry Suffix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Enquiry  Suffix" id="enq_suffix" name="enq_suffix" value="<?php echo $enq_suffix; ?>">
                                             <label class="error"><?php echo form_error('enq_suffix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 

                               
                             </div>
                        </div>
                    </div> 
                </div>
                  <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Client Number</h4>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('client_number')){ echo 'has-error';} ?>">
                                            <label>Client Number</label>
                                             <input type="text" class="form-control" autocomplete="off" placeholder="Enter Client Number" id="client_number" name="client_number" value="<?php echo $client_number; ?>">
                                             <label class="error"><?php echo form_error('client_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('client_prefix')){ echo 'has-error';} ?>">
                                            <label>Client Code Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Client Code Prefix" id="client_prefix" name="client_prefix" value="<?php echo $client_prefix; ?>">
                                             <label class="error"><?php echo form_error('client_prefix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-danger">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Vendor Number</h4>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('vendor_number')){ echo 'has-error';} ?>">
                                            <label>Vendor Number</label>
                                             <input type="text" class="form-control" autocomplete="off" placeholder="Enter Vendor Number" id="vendor_number" name="vendor_number" value="<?php echo $vendor_number; ?>">
                                             <label class="error"><?php echo form_error('vendor_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('vendor_prefix')){ echo 'has-error';} ?>">
                                            <label>Vendor Code Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Vendor Code Prefix" id="vendor_prefix" name="vendor_prefix" value="<?php echo $vendor_prefix; ?>">
                                             <label class="error"><?php echo form_error('vendor_prefix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div> 
                 <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-primary">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Credit Note</h4>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('credit_number')){ echo 'has-error';} ?>">
                                            <label>Credit Note</label>
                                             <input type="text" class="form-control" autocomplete="off" placeholder="Enter Credit Note Number" id="credit_number" name="credit_number" value="<?php echo $credit_number; ?>">
                                             <label class="error"><?php echo form_error('credit_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('credit_prefix')){ echo 'has-error';} ?>">
                                            <label>Credit Note Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Credit Note Prefix" id="credit_prefix" name="credit_prefix" value="<?php echo $credit_prefix; ?>">
                                             <label class="error"><?php echo form_error('credit_prefix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div>
                 <div class="row">
                    <div class="col-md-12">
                       <div class="panel panel-danger">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Proforma Credit Note</h4>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('per_credit_number')){ echo 'has-error';} ?>">
                                            <label>Proforma Credit Note</label>
                                             <input type="text" class="form-control" autocomplete="off" placeholder="Enter Proforma  Credit Note Number" id="per_credit_number" name="per_credit_number" value="<?php echo $per_credit_number; ?>">
                                             <label class="error"><?php echo form_error('per_credit_number'); ?></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('pre_credit_prefix')){ echo 'has-error';} ?>">
                                            <label>Proforma Credit Note Prefix</label>
                                             <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Proforma Credit Note Prefix" id="pre_credit_prefix" name="pre_credit_prefix" value="<?php echo $per_credit_prefix; ?>">
                                             <label class="error"><?php echo form_error('pre_credit_prefix'); ?></label>
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading clearfix">
                                 <h4 class="panel-title">Other Settings</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('discounts')){ echo 'has-error';} ?>">
                                               <div class="control-group" id="toastTypeGroup">
                                                    <div class="controls">
                                                        <label>Do you give discounts</label>
                                                            
                                                            <label>
                                                                <input type="radio" name="discounts" value="No" onclick="test(this.value)" <?php if($discounts=='No'){?> checked <?php }?>  />I dont give discounts</br>
                                                            </label>

                                                            <label>
                                                                <input type="radio" name="discounts" value="Yes"  onclick="test(this.value)" <?php if($discounts=='Yes'){?> checked <?php }?> /> At transaction level
                                                            </label>
                                                    </div>
                                                </div>
                                             <label class="error"><?php echo form_error('discounts'); ?></label>
                                        </div>                                              
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group" id="test" <?php if($discounts=='No'){?> style="display: none;" <?php }?>>
                                        <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-20">
                                                <select class="form-control m-b-sm">
                                                <option value="1">Discount before tax</option>
                                                <option value="0">Discount after tax</option>
                                                </select>                                                   
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <div class="col-md-3">
                                         <div class="form-group <?PHP if(form_error('add_charges')){ echo 'has-error';} ?>">
                                               <div class="control-group" id="toastTypeGroup">
                                                    <div class="controls">
                                                        <label>Select any additional charges you'll like to add</label>
                                                        <label>
                                                            <input type="radio" name="add_charges" autocomplete="off" value="1" <?php if($add_charges=='1'){?> checked <?php }?>  /> Shipping Charges
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="add_charges" autocomplete="off" value="2"  <?php if($add_charges=='2'){?> checked <?php }?> /> Adjustments
                                                        </label>
                                                    </div>
                                                </div>
                                             <label class="error"><?php echo form_error('add_charges'); ?></label>
                                        </div>                                             
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group pull-right">
                                        <label class="col-sm-2 control-label"></label>
                                            <div class="col-sm-20">
                                                <input type="hidden" name="key_id" value="<?php echo $key_id;?>" />
                                                <button type="submit" name="Submit" class="btn btn-primary">Update Preference</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                             </div>
                        </div>
                    </div> 
                </div>
                  <!--                   
                <div class="text-center">
                </div>    -->               
               
                <?php echo form_close(); ?>
       
    </div>
</div><!-- Row -->

        <!-- /page container -->
        <script type="text/javascript">
            function test(value)
            {
                if(value == 'Yes')
                {
                    $("#test").css("display", "block");
                }
                else
                {
                    $("#test").css("display", "none");
                }


            }
        </script>
        <script type="text/javascript">
        $(document).ready(function() 
        {
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
            });
        });
        </script>
     
    </div>
</div><!-- Main Wrapper -->