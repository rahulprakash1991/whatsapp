<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $id            =   $row->id;
        $vendor_name   =   $row->vendor_name;  
        $vendor_ab      =   $row->vendor_ab;
        $email          =   $row->vendor_email;
        $contact_no      =   $row->vendor_mobile;
        $address1         =   $row->address;
        $cr_no           =   $row->cr_no;
        $vendor_no       =   $row->vendor_no;     
        $landline_no    =   $row->land_line_no;      
        $fax            =   $row->fax_no;      
        $website        =   $row->vendor_website; 
        $logo = $row->vendor_logo;    
        $vendor_key = $row->vendor_key;
        $area = $row->vendor_area; 
        $city = $row->vendor_city; 
        $state = $row->vendor_state; 
        $zip = $row->vendor_zip; 
        $country = $row->vendor_country; 
             
    }
  foreach($evalue as $key =>$row)
  {
    $contact_address[$key]      = $row->vendor_address;
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
   foreach($idmanagement as $key =>$row)
  {
    $vendor_mana_id[$key]      = $row->vendor_management_id ;
    $vendor_manag_No[$key]      = $row->vendor_mng_no;
  
    $trow1++;
  } 
}
else
{
        $vendor_name            =   $this->input->post('vendor_name');
        $vendor_ab           =   $this->input->post('vendor_abb');
        $email          =   $this->input->post('email');   
        $contact_no          =   $this->input->post('contact_no');   
        $address        =   $this->input->post('address1'); 
        $cr_no                =   $this->input->post('cr_no');
        $vendor_no    =   $this->input->post('vendor_no');
        $landline_no    =   $this->input->post('landline_no');
        $fax                 =   $this->input->post('fax');
        $website         =   $this->input->post('website');
        $logo                 =   $this->input->post('vendor_logo');
         
   
}
 $trow = ($trow=='') ? 1 : $trow;
 $trow1 = ($trow1=='') ? 1 : $trow1;

?>
              <div class="page-inner">
                <div class="page-title">
                    <h3><strong><?PHP echo $form_toptittle; ?></strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>"><strong>Home</strong></a></li>
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
                                            <div class="form-group <?PHP if(form_error('vendor_name')){ echo 'has-error';} ?>">

                                                <label>Supplier Name<span1>*</span1></label>

                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Supplier name" id="vendor_name" name="vendor_name" value="<?php echo $vendor_name; ?>" required>
                                                
                                                <label class="error"><?php echo form_error('vendor_name'); ?></label>
                                            </div>
                                        </div>
                                       <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('vendor_ab')){ echo 'has-error';} ?>">
                                                <label>Supplier Abbrevation<span1>*</span1></label>

                                                    <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Supplier Abbrevation" id="vendor_ab" name="vendor_ab" value="<?php echo $vendor_ab; ?>" required>
                                                
                                                <label class="error"><?php echo form_error('vendor_ab'); ?></label>
                                            </div>
                                        </div>
                                       <!--  <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('email')){ echo 'has-error';} ?>">
                                                <label>Email ID<span1>*</span1></label>
                                                 
                                              
                                                  <input type="text" autocomplete="off" class="form-control" placeholder="Enter Client Email" id="email" name="email" value="<?php echo $email; ?>"required>
                                                
                                              
                                                 <label class="error"><?php echo form_error('email'); ?></label>
                                            </div>
                                        </div>  -->                                       
                                        <!-- <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('contact_no')){ echo 'has-error';} ?>">
                                                <label>Contact Number<span1>*</span1></label>
                                              
                                                  <input type="text" autocomplete="off"  class="form-control"  placeholder="Enter Contact No" id="contact_no" name="contact_no" value="<?php echo $contact_no; ?>" required>
                                             
                                                 <label class="error"><?php echo form_error('contact_no'); ?></label>
                                            </div>
                                        </div> -->
                                          <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('cr_no')){ echo 'has-error';} ?>">
                                                <label>CR Number</label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="CR Number" id="cr_no" name="cr_no" value="<?php echo $cr_no; ?>">
                                                 <label class="error"><?php echo form_error('cr_no'); ?></label>
                                            </div>
                                        </div>  
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('vendor_no')){ echo 'has-error';} ?>">
                                                <label>VAT Number</label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter VAT Number" id="vendor_no" name="vendor_no" value="<?php echo $vendor_no; ?>">
                                                 <label class="error"><?php echo form_error('vendor_no'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                         <div class="col-md-3" col-span="2">
                                            <div class="form-group <?PHP if(form_error('address1')){ echo 'has-error';} ?>">
                                                <label>Address<span1>*</span1></label>
                                                    <textarea id="console" name="address1"  class="form-control" autocomplete="off" class="form-control " rows="5" style="min-height: 1px;"  ><?php echo nl2br($address1);?></textarea>
                                                
                                                <label class="error"><?php echo form_error('address1'); ?></label>
                                            </div>
                                        </div>
                                       
                                                                                      
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('landline_no')){ echo 'has-error';} ?>">
                                                <label>Landline Number</label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Landline No" id="landline_no" name="landline_no" value="<?php echo $landline_no; ?>">
                                                 <label class="error"><?php echo form_error('landline_no'); ?></label>
                                            </div>
                                        </div>
                          
                                         
                                         <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('fax')){ echo 'has-error';} ?>">
                                                <label>Fax Number</label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Fax Number" id="fax" name="fax" value="<?php echo $fax; ?>">
                                                 <label class="error"><?php echo form_error('fax'); ?></label>
                                            </div>
                                        </div> 
                                         <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('website')){ echo 'has-error';} ?>">
                                                <label>Website (URL)</label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Website" id="website" name="website" value="<?php echo $website; ?>">
                                                 <label class="error"><?php echo form_error('website'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('vendor_logo')){ echo 'has-error';} ?>">
                                                <label>Supplier Logo<span1>*</span1></label>
                                                 <input type="file" autocomplete="off" class="form-control"   id="vendor_logo" name="vendor_logo" >
                                                 <label class="error"><?php echo form_error('vendor_logo'); ?></label>
                                            </div>
                                        </div>
                                         
                                    </div> -->
                                    <!--    <?php if($logo!=''){?>
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
                                <?php } ?> -->
                          <!-- // New Addrees -->
    <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('address1')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="address1" autocomplete="off" id="address1" placeholder="Address" value="<?php echo $address1;?>" required>
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('address1'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('area')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="area" autocomplete="off" id="area" placeholder="Area" value="<?php echo $area;?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('area'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('city')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="city" autocomplete="off" id="city" placeholder="city" value="<?php echo $city;?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('city'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('state')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="state" autocomplete="off" id="state" placeholder="State" value="<?php echo $state;?>">
              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('state'); ?></label>
            </div>
          </div>
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('zip')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
              <input type="text" class="form-control" name="zip" autocomplete="off" id="zip" placeholder="Zip" value="<?php echo $zip;?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('zip'); ?></label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group <?php if(form_error('country')){ echo 'has-error'; }?>">
              <div class="input-group-addon"><i class="fa fa fa-flag"></i></div>
               <input type="text" class="form-control" name="country" autocomplete="off" id="country" placeholder="Country" value="<?php echo $country;?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('country'); ?></label>
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
                <input type="text" class="form-control" name="contact_no" autocomplete="off" id="contact_no" placeholder="Mobile" value="<?php echo $contact_no;?>"required >
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
                <input type="text" class="form-control" name="email" autocomplete="off" id="email" placeholder="Email" value="<?php echo $email;?>" required>
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
            <div class="input-group <?php if(form_error('vendor_logo')){ echo 'has-error'; }?>">
              <div class="input-group-addon">Logo</div>
                <input type="file" class="form-control" name="vendor_logo" autocomplete="off" id="vendor_logo" placeholder="Website" value="<?php echo $vendor_logo;?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('vendor_logo'); ?></label>
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

                          <!-- /// -->

 <div class="row">
          <div class="col-md-12">                  
            <span id="partProductData1">
              <head><h3>Add Vendor ID </h3></head>
               <?php 
                $il=1;
                for($i=0; $i < $trow1; $i++)
                {
                ?>
                 <div class="row allrowvalues1" id="rowssids1_<?php echo $i;?>" col-span="2" style="margin-left:  3px">
                  <div class="row">
          <div class="col-sm-3" >
           
               <label>Vendor Name </label>
                    <select name="vendor_mana_id[]" id="vendor_mana_id<?php echo $i;?>" class="form-control" style="width: 100%">
                      <?php foreach ($drop_menu_vendor_id_Manag as $key_id => $key_name) 
                      {?>
                    <option value="<?php echo $key_id;?>" <?php if($key_id == $vendor_mana_id[$i]){?> selected <?php }?>><?php echo $key_name;?></option>

                      <?php 
                      }?>
                  </select>
           
          </div>
            <div class="col-sm-3">
           
              <label>Vendor Number</label>
               <input type="text" class="form-control" name="vendor_manag_No[]>" autocomplete="off" id="vendor_manag_No<?php echo $i;?>" placeholder="Enter Vendor Number" value="<?php echo $vendor_manag_No[$i];?>">
                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('vendor_manag_No['.$i.']'); ?></label>
        
          </div>
          <div class="col-md-2">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart1(<?PHP echo $i;?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div> 
                  </div> 
                </div> 
            <hr>
                <?php 
                $il++; 
                } 
                ?>



            </span>
             <div class="col-md-3">
            <div class="col-md-1">
              <a onclick="addNewPart1()" class="label label-danger"> Add New </a>    
              <input type="hidden" name="attproduct1" id="attproduct1" value="<?PHP echo $il-1?>" />
            </div>
          </div>
          </div>
        </div>

                                    
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
                <div class="row allrowvalues" id="rowssids_<?php echo $i;?>" col-span="2" style="margin-left:  3px">
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
        
           <div class="col-md-1">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart(<?PHP echo $i;?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
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
          
            <div class="col-md-1">
              <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
              <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
            </div>
         
                                        

                                    <div class="text-center">                                            
                                        <input type="hidden" name="vendor_id" value="<?php echo $id;?>" />
                                         <input type="hidden" name="vendor_key" value="<?php echo $vendor_key;?>" />
                                        <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($id!='' ? 'Update Supplier' : 'Create Supplier'); ?> </button>
                                         <a href="<?php echo base_url().'masters/Vendor/'?>" class="btn btn-primary">Cancel</a> 
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
      url: "<?php echo site_url('masters/Vendor/getPartNoContent'); ?>", 
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
          "url":"<?php echo site_url('masters/Vendor/getPartNoContent'); ?>",
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
  function addNewPart1()
  {
    row = $('#attproduct1').val();
    $.ajax({
      type: "GET",
      url: "<?php echo site_url('masters/Vendor/getPartNoContent1'); ?>", 
      data: {i:row},
      dataType:"html",
      success: function(html)
      {
        $('#partProductData1').append(html);
      
      },
    });
  }
  function getConfirmPart1(inv, prid)
  {
      var x;
      var r=confirm("You Want Delete!!");
      if(prid!='' && r==true)
      {
        $.ajax(
        {
          "url":"<?php echo site_url('masters/Vendor/getPartNoContent1'); ?>",
          "type":"GET",
          data:{"prid":prid},
          success:function(data)
          {
            //alert("Daelted Successfully");
            $('#rowssids1_'+inv+'').remove();
            $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
          }
        });
      }
      else if (prid=='' && r==true)
      {
        $('#rowssids1_'+inv+'').remove();
        $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
      }
  }
            </script>