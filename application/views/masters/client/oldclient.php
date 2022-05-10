<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $id            =   $row->id;
        $client_name   =   $row->client_name;  
        $client_ab      =   $row->client_abb;
        $email          =   $row->client_email;
        $contact_no      =   $row->client_mobile;
        $address1         =   $row->address;
        $cr_no           =   $row->cr_no;
        $vendor_no       =   $row->vendor_no;     
        $landline_no    =   $row->land_line_no;      
        $fax            =   $row->fax_no;      
        $website        =   $row->client_website; 
        $client_no        =   $row->client_no; 
        $logo = $row->client_logo;    
             
    }
foreach($evalue as $key =>$row)
  {
    $contact_address[$key]      = $row->client_address;
    $contact_area[$key]      = $row->area;
    $contact_city[$key]      = $row->city;
    $contact_state[$key]      = $row->state;
    $contact_zip[$key]      = $row->post_code;
    $contact_country[$key]      = $row->country;
    $contact_phone[$key]      = $row->phone;
    $contact_mobile[$key]      = $row->mobile;
    $contact_email[$key]      = $row->email;
    $contact_fax[$key]      = $row->fax;
    $contact_website[$key]      = $row->website;
              

    $trow++;
  }
}
else
{
        $category_id            =   $this->input->post('category_id');
        $pro_group_id           =   $this->input->post('pro_group_id');
        $pro_item_name          =   $this->input->post('pro_item_name');   
        $pro_item_code          =   $this->input->post('pro_item_code');   
        $pieces_per_unit        =   $this->input->post('pieces_per_unit'); 
        $unit_id                =   $this->input->post('unit_id');
        $pro_item_sell_price    =   $this->input->post('pro_item_sell_price');
        $pro_item_cost_price    =   $this->input->post('pro_item_cost_price');
        $tax_id                 =   $this->input->post('tax_id');
        $pro_item_stock         =   $this->input->post('pro_item_stock');
        $con_id                 =   $this->input->post('con_id');
        $pro_item_level         =   $this->input->post('pro_item_level');
        $pro_item_status        =   $this->input->post('pro_item_status');
}
$trow = ($trow=='') ? 1 : $trow;

?>
              <div class="page-inner">
                <div class="page-title">
                    <h3><strong><?PHP echo $form_toptittle; ?></strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>"><strong><?php echo $this->lang->line('home')?></strong></a></li>
                            <li class="active"><?PHP echo $form_toptittle; ?></li>
                              <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js">
                              </script>
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
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title"><?PHP echo $form_tittle; ?></h4>
                            </div>
                            <div class="panel-body">
                                <?php echo form_open_multipart($form_url); ?>
                                    <div class="row" >
                                       <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('client_name')){ echo 'has-error';} ?>">

                                                <label><?php echo $this->lang->line('client_name')?><span1>*</span1></label>

                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_name');?>" id="client_name" name="client_name" value="<?php echo $client_name; ?>" required>
                                                
                                                <label class="error"><?php echo form_error('client_name'); ?></label>
                                            </div>
                                        </div>
                                       <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('client_ab')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_ab')?><span1>*</span1></label>

                                                    <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_ab');?>" id="client_ab" name="client_ab" value="<?php echo $client_ab; ?>" required >
                                                
                                                <label class="error"><?php echo form_error('client_ab'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('email')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('email')?><span1>*</span1></label>
                                                 
                                              
                                                  <input type="text" autocomplete="off" class="form-control" placeholder="<?php echo $this->lang->line('email');?>" id="email" name="email" value="<?php echo $email; ?>" required>
                                                
                                              
                                                 <label class="error"><?php echo form_error('email'); ?></label>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('contact_no')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_contact_no')?><span1>*</span1></label>
                                              
                                                  <input type="text" autocomplete="off"  class="form-control"  placeholder="<?php echo $this->lang->line('client_contact_no');?>" id="contact_no" name="contact_no" value="<?php echo $contact_no; ?>" required >
                                             
                                                 <label class="error"><?php echo form_error('contact_no'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-md-3" col-span="2">
                                            <div class="form-group <?PHP if(form_error('address1')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_address')?><span1>*</span1></label>
                                                    <textarea id="console" name="address1"  class="form-control" autocomplete="off" class="form-control " rows="5" style="min-height: 1px;"required  ><?php echo nl2br($address1);?></textarea>
                                                <label class="error"><?php echo form_error('address1'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('cr_no')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_cr_no')?></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_cr_no');?>" id="cr_no" name="cr_no" value="<?php echo $cr_no; ?>">
                                                 <label class="error"><?php echo form_error('cr_no'); ?></label>
                                            </div>
                                        </div>  
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('vendor_no')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_vendor_no')?></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_vendor_no');?>" id="vendor_no" name="vendor_no" value="<?php echo $vendor_no; ?>">
                                                 <label class="error"><?php echo form_error('vendor_no'); ?></label>
                                            </div>
                                        </div>
                                                                                      
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('landline_no')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_landline_no')?></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_landline_no');?>" id="landline_no" name="landline_no" value="<?php echo $landline_no; ?>">
                                                 <label class="error"><?php echo form_error('landline_no'); ?></label>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('fax')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_fax_no')?></label>
                                                <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_fax_no');?>" id="fax" name="fax" value="<?php echo $fax; ?>">
                                                <label class="error"><?php echo form_error('fax'); ?></label>
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('website')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_website')?></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_website');?>" id="website" name="website" value="<?php echo $website; ?>">
                                                 <label class="error"><?php echo form_error('website'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('client_logo')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_logo')?><span1>*</span1></label>
                                                 <input type="file" autocomplete="off" class="form-control"   id="client_logo" name="client_logo" >
                                                 <label class="error"><?php echo form_error('client_logo'); ?></label>
                                            </div>
                                        </div>
                                         
                                    </div>
                                       <?php if($logo!=''){?>
                                        <div class="row">
                                           <div class="col-md-3">
                                           </div>
                                            <div class="col-md-3">
                                            </div>
                                        <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('product_imageee')){ echo 'has-error';} ?>">
                                         <img  src="<?php echo config_item("image_url").$logo; ?>" style="width: 20%;height: 15%;" class="img-fluid img-thumbnail" alt="">
                                    </div>
 
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row">
                                  <div class="row allrowvalues" id="rowssids_<?php echo $i;?>" col-span="2">
            <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('address1')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="address1" autocomplete="off" id="address1" placeholder="Address" value="<?php echo $address1;?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('address1'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_area['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_area[]" autocomplete="off" id="contact_area<?php echo $i;?>" placeholder="Area" value="<?php echo $contact_area[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_area['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_city['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_city[]" autocomplete="off" id="contact_city<?php echo $i;?>" placeholder="city" value="<?php echo $contact_city[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_city['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_state['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_state[]" autocomplete="off" id="contact_state<?php echo $i;?>" placeholder="State" value="<?php echo $contact_state[$i];?>">
              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_state['.$i.']'); ?></label>
            </div>
          </div>
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_zip['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_zip[]" autocomplete="off" id="contact_zip<?php echo $i;?>" placeholder="Zip" value="<?php echo $contact_zip[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_zip['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_country['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-flag"></i></div>
               <input type="text" class="form-control" name="contact_country[]" autocomplete="off" id="contact_country<?php echo $i;?>" placeholder="Country" value="<?php echo $contact_country[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_country['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('landline_no')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-phone"></i></div>
                <input type="text" class="form-control" name="landline_no" autocomplete="off" id="landline_no" placeholder="Phone" value="<?php echo $landline_no;?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('landline_no'); ?></label>
            </div>
          </div>
           <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_no')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-phone"></i></div>
                <input type="text" class="form-control" name="contact_no" autocomplete="off" id="contact_no" placeholder="Mobile" value="<?php echo $contact_no;?>" >
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_no'); ?></label>
            </div>
          </div>
          
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('email')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input type="text" class="form-control" name="email" autocomplete="off" id="email" placeholder="Email" value="<?php echo $email;?>">
                 <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('email'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('fax')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-fax"></i></div>
                <input type="text" class="form-control" name="fax" autocomplete="off" id="fax" placeholder="Fax" value="<?php echo $fax;?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('fax'); ?></label>
             </div>
           </div>
          
          <div class="col-sm-3" id="website">
            <div class="input-group <?php if(form_error('website')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-external-link"></i></div>
                <input type="text" class="form-control" name="website" autocomplete="off" id="website" placeholder="Website" value="<?php echo $website;?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('website'); ?></label>
            </div>
          </div>
        
            <div class="col-md-3">
            <div class="input-group <?php if(form_error('client_logo')){ echo 'has-error'; }?>">
              <div class="input-group-addon">Logo</div>
                <input type="file" class="form-control" name="client_logo" autocomplete="off" id="client_logo" placeholder="Website" value="<?php echo $client_logo;?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('website'); ?></label>
            </div>
          </div>
        </div> 
                </div> 
                                </div>
                                 <?php if($logo!=''){?>
                                        <div class="row">
                                           <div class="col-md-3">
                                           </div>
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                        <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('product_imageee')){ echo 'has-error';} ?>">
                                         <img  src="<?php echo config_item("image_url").$logo; ?>" style="width: 20%;height: 15%;" class="img-fluid img-thumbnail" alt="">
                                    </div>
 
                                    </div>
                                </div>
                                <?php } ?>
                             <div class="row">
          <div class="col-md-12">                  
            <span id="partProductData">
              <head><h3>Add delivery/Shipping address</h3></head>
            <!--   <hr> -->
                <?php 
                $is=1;
                for($i=0; $i < $trow; $i++)
                {
                ?>

                <div class="row allrowvalues" id="rowssids_<?php echo $i;?>" col-span="2">
                  <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_address['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_address[]>" autocomplete="off" id="contact_address<?php echo $i;?>" placeholder="Address" value="<?php echo $contact_address[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_address['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_area['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_area[]" autocomplete="off" id="contact_area<?php echo $i;?>" placeholder="Area" value="<?php echo $contact_area[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_area['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_city['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_city[]" autocomplete="off" id="contact_city<?php echo $i;?>" placeholder="city" value="<?php echo $contact_city[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_city['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_state['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_state[]" autocomplete="off" id="contact_state<?php echo $i;?>" placeholder="State" value="<?php echo $contact_state[$i];?>">
              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_state['.$i.']'); ?></label>
            </div>
          </div>
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_zip['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="contact_zip[]" autocomplete="off" id="contact_zip<?php echo $i;?>" placeholder="Zip" value="<?php echo $contact_zip[$i];?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_zip['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_country['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-flag"></i></div>
               <input type="text" class="form-control" name="contact_country[]" autocomplete="off" id="contact_country<?php echo $i;?>" placeholder="Country" value="<?php echo $contact_country[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_country['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_phone['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-phone"></i></div>
                <input type="text" class="form-control" name="contact_phone[]" autocomplete="off" id="contact_phone<?php echo $i;?>" placeholder="Phone" value="<?php echo $contact_phone[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_phone['.$i.']'); ?></label>
            </div>
          </div>
           <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_mobile['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-phone"></i></div>
                <input type="text" class="form-control" name="contact_mobile[]" autocomplete="off" id="contact_mobile<?php echo $i;?>" placeholder="Mobile" value="<?php echo $contact_mobile[$i];?>" >
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_mobile['.$i.']'); ?></label>
            </div>
          </div>
          
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_email['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input type="text" class="form-control" name="contact_email[]" autocomplete="off" id="contact_email<?php echo $i;?>" placeholder="Email" value="<?php echo $contact_email[$i];?>">
                 <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_email['.$i.']'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('contact_fax['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-fax"></i></div>
                <input type="text" class="form-control" name="contact_fax[]" autocomplete="off" id="contact_fax<?php echo $i;?>" placeholder="Fax" value="<?php echo $contact_fax[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_fax['.$i.']'); ?></label>
             </div>
           </div>
          
          <div class="col-sm-3" id="website">
            <div class="input-group <?php if(form_error('contact_website['.$i.']')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-external-link"></i></div>
                <input type="text" class="form-control" name="contact_website[]" autocomplete="off" id="contact_website<?php echo $i;?>" placeholder="Website" value="<?php echo $contact_website[$i];?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_website['.$i.']'); ?></label>
            </div>
          </div>
        
           <div class="col-md-2">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart(<?PHP echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div> 
        </div> 
                </div> 
               <hr>
                <?php 
                $is++; 
                } 
                ?>
            </span>                                            
          </div>
          <div class="col-md-3">
            <div class="col-md-1">
              <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
              <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
            </div>
          </div>
      </div>
                                    
                                                                   

                                    <div class="text-center">                                            
                                        <input type="hidden" name="client_id" value="<?php echo $id;?>" />
                                        <input type="hidden" name="client_no" value="<?php echo $client_no;?>" />
                                        <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($id!='') ?  $this->lang->line('client_update') :  $this->lang->line('client_create') ?> </button>
                                         <a href="<?php echo base_url().'masters/Client/'?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a> 
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                </div>
            </div>
            <script type="text/javascript">
  function addNewPart()
  {
    row = $('#attproduct').val();
    $.ajax({
      type: "GET",
      url: "<?php echo site_url('masters/Client/getPartNoContent'); ?>", 
      data: {i:row},
      dataType:"html",
      success: function(html)
      {
        $('#partProductData').append(html);
        $('#address'+row).val();
      },
    });
  }
   function getConfirmPart(inv, prid)
  {
      var x;
      var r=confirm("You Want Delete!!");
      if(prid!='' && r==true)
      {
        $.ajax(
        {
          "url":"<?php echo site_url('masters/Client/getPartNoContent'); ?>",
          "type":"GET",
          data:{"prid":prid},
          success:function(data)
          {
            //alert("Daelted Successfully");
            $('#rowssids_'+inv+'').remove();
            $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
          }
        });
      }
      else if (prid=='' && r==true)
      {
        $('#rowssids_'+inv+'').remove();
        $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
      }
  }
</script>