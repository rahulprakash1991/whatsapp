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
        $area = $row->client_area; 
        $city = $row->client_city; 
        $state = $row->client_state; 
        $zip = $row->client_zip; 
        $country = $row->client_country; 
        $client_arabic_name = $row->client_arabic_name;  
        $client_ab_arabic = $row->client_ab_arabic; 
        $address11 =$row->address1;
        $area1 = $row->client_area1; 
        $city1 = $row->client_city1; 
        $state1 = $row->client_state1; 
        $zip1 = $row->client_zip1; 
        $country1 = $row->client_country1; 
             
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
                                            <div class="form-group <?PHP if(form_error('client_arabic_name')){ echo 'has-error';} ?>">

                                                <label><?php echo 'ساسم   '; ?><span1>*</span1></label>

                                                 <input type="text" name="client_arabic_name" dir="rtl" class="form-control keyboardInput"  value=<?php echo htmlentities($client_arabic_name);?> >
                                                
                                                <label class="error"><?php echo form_error('client_arabic_name'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('client_ab_arabic')){ echo 'has-error';} ?>">

                                                <label><?php echo ' اختصار العميل  '; ?><span1>*</span1></label>

                                                 <input type="text" name="client_ab_arabic" dir="rtl" class="form-control keyboardInput" value=<?php echo htmlentities($client_ab_arabic);?> >
                                                
                                                <label class="error"><?php echo form_error('client_ab_arabic'); ?></label>
                                            </div>
                                        </div>
                                          
                                      </div>
                                      <div class="row">
                                          <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('vendor_no')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_vendor_no')?></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_vendor_no');?>" id="vendor_no" name="vendor_no" value="<?php echo $vendor_no; ?>">
                                                 <label class="error"><?php echo form_error('vendor_no'); ?></label>
                                            </div>
                                        </div> 
                                          <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('cr_no')){ echo 'has-error';} ?>">
                                                <label><?php echo $this->lang->line('client_cr_no')?></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_cr_no');?>" id="cr_no" name="cr_no" value="<?php echo $cr_no; ?>">
                                                 <label class="error"><?php echo form_error('cr_no'); ?></label>
                                            </div>
                                        </div>                                   
                                       
                                    </div>
                           
                                   
                                
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
            <div class="input-group <?php if(form_error('client_logo')){ echo 'has-error'; }?>">
              <div class="input-group-addon">Logo</div>
                <input type="file" class="form-control" name="client_logo" autocomplete="off" id="client_logo" placeholder="Website" value="<?php echo $client_logo;?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('website'); ?></label>
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

<br>
            <div class="row">
          <div class="col-md-3">
            <div class="form-group <?php if(form_error('address11')){ echo 'has-error'; }?>">
              <!-- <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div> -->
              <input type="text" class="form-control keyboardInput" name="address11" autocomplete="off" id="address11" placeholder="عنوان  " value="<?php echo $address11;?>" >

                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('address11'); ?></label>
            </div>
          </div>
      
          <div class="col-md-3">
            <div class="form-group <?php if(form_error('area1')){ echo 'has-error'; }?>">
              <!-- <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div> -->
              <input type="text" class="form-control  keyboardInput" name="area1" autocomplete="off" id="area" placeholder="منطقة  " value="<?php echo $area1;?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('area1'); ?></label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group <?php if(form_error('city1')){ echo 'has-error'; }?>">
             <!--  <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div> -->
              <input type="text" class="form-control  keyboardInput" name="city1" autocomplete="off" id="city1" placeholder="مدينة  " value="<?php echo $city1;?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('city1'); ?></label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group <?php if(form_error('state1')){ echo 'has-error'; }?>">
             <!--  <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div> -->
              <input type="text" class="form-control  keyboardInput" name="state1" autocomplete="off" id="state1" placeholder="ولاية  " value="<?php echo $state1;?>">
              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('state1'); ?></label>
            </div>
          </div>
        </div>
        <br />
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group<?php if(form_error('zip1')){ echo 'has-error'; }?>">
              <!-- <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div> -->
              <input type="text" class="form-control  keyboardInput" name="zip1" autocomplete="off" id="zip1" placeholder="أزيز  " value="<?php echo $zip1;?>">
               <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('zip1'); ?></label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group <?php if(form_error('country1')){ echo 'has-error'; }?>">
             
               <input type="text" class="form-control  keyboardInput" name="country1" autocomplete="off" id="country1" placeholder="الأمة  " value="<?php echo $country1;?>">
                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('country1'); ?></label>
            </div>
          </div>
             
      
          
        </div>
        <br />
        <div class="clearfix"></div>
                          
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