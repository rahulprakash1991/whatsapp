<?php
if(isset($value) && !empty($value))
{

    foreach($value->result() as $row)
    {
        $id            =   $row->id;
        $vendor_name   =   $row->vendor_name;  
        $vendor_ab      =   $row->vendor_abb;
        $email          =   $row->vendor_email;
        $contact_no      =   $row->vendor_mobile;
        $address1         =   $row->address;
        $cr_no           =   $row->cr_no;
        $vendor_no       =   $row->vendor_no;     
        $landline_no    =   $row->land_line_no;      
        $fax            =   $row->fax_no;      
        $website        =   $row->vendor_website; 
        $vendor_key        =   $row->vendor_key; 
        $logo = $row->vendor_logo; 
        $area = $row->vendor_area; 
        $city = $row->vendor_city; 
        $state = $row->vendor_state; 
        $zip = $row->vendor_zip; 
        $country = $row->vendor_country; 
        $vendor_arabic_name = $row->vendor_arabic_name;  
        $vendor_ab_arabic = $row->vendor_ab_arabic; 
        $address11 =$row->address1;
        $po_box_arabic = $row->vendor_area1; 
        $city_arabic = $row->vendor_city1; 
        $state_arabic = $row->vendor_state1; 
        $zip_arabic = $row->vendor_zip1; 
        $country_arabic= $row->vendor_country1; 
        $street = $row->vendor_street;
        $district = $row->vendor_district;
        $province =$row->vendor_province;
        $landline_no1 = $row->landline_no1;
        $cr_no_arabic = $row->cr_no_arabic;
        $street_arabic = $row->street_arabic;
        $district_arabic = $row->vendor_district_arabic;
        $province_arabic = $row->vendor_province_arabic;
        $landline_no_arabic = $row->landline_no_arabic;
        $landline_no1_arabic =$row->landline_no1_arabic;
        $fax_arabic = $row->fax_arabic;
        $contact_no_arabic = $row->contact_no_arabic;
        $email_arabic = $row->email_arabic;
        $website_arabic = $row->website_arabic;
        $vendor_vat_arabic = $row->vendor_vat_arabic;
        $vendor_bank = $row->vendor_bank;

       
        // print_r($client_arabic_name);die;

       
             
    }
foreach($evalue as $key =>$row)
  {
    $scontact_address_id[$key] = $row->id;
    $scr_no[$key]= $row->vendor_cr_no;
    $svendor_no[$key] = $row->vendor_vat_no;
    $saddress1[$key]      = $row->vendor_address;
    $sstreet[$key] = $row->vendor_street;
    $sarea[$key]      = $row->area;
    $scity[$key]      = $row->city;
    $sdistrict[$key] = $row->district;
    $sprovince[$key]      = $row->state;
    $szip[$key]      = $row->post_code;
    $scountry[$key]      = $row->country;
    $slandline_no[$key]      = $row->phone;
    $slandline_no1[$key] = $row->phone1;
    $scontact_no[$key]      = $row->mobile;
    $semail[$key]      = $row->email;
    $sfax[$key]      = $row->fax;
    $swebsite[$key]      = $row->website;
    $svendor_vat_arabic[$key] = $row->vendor_vat_no_arabic;
    $scr_no_arabic[$key]  =$row->vendor_cr_no_arabic;
    $saddress11[$key]      = $row->vendor_address_arabic;
    $sstreet_arabic[$key] = $row->vendor_street_arabic;
    $spo_box_arabic[$key]      = $row->area_arabic;
    $sdistrict_arabic[$key] = $row->district_arabic;
    $scity_arabic[$key]      = $row->city_arabic;
    $sprovince_arabic[$key]      = $row->state_arabic;
    $szip_arabic[$key]      = $row->post_code_arabic;
    $scountry_arabic[$key]      = $row->country_arabic;
    $slandline_no_arabic[$key]      = $row->phone_arabic;
    $slandline_no1_arabic[$key]      = $row->phone1_arabic;
    $scontact_no_arabic[$key]      = $row->mobile_arabic;
    $semail_arabic[$key]      = $row->email_arabic;
    $sfax_arabic[$key]      = $row->fax_arabic;
    $swebsite_arabic[$key]      = $row->website_arabic;
              

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
 $trow1 = ($trow1=='') ? 1 : $trow1;

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
                                       <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('vendor_name')){ echo 'has-error';} ?>">

                                                <label><?php echo " Vendor Name";?><span1>*</span1></label>

                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo "Vendor Name (English)";?>" id="vendor_name" name="vendor_name" value="<?php echo $vendor_name; ?>" required>
                                                
                                                <label class="error"><?php echo form_error('vendor_name'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            
                                              <div class="form-group <?PHP if(form_error('vendor_ab')){ echo 'has-error';} ?>">
                                                <label><?php echo "Vendor Abbrevation";?><span1>*</span1></label>

                                                    <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo "Vendor Abbrevation";?>" id="vendor_ab" name="vendor_ab" value="<?php echo $vendor_ab; ?>"  >
                                                
                                                <label class="error"><?php echo form_error('vendor_ab'); ?></label>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row" >
                                         <div class="col-md-6" style="text-align: right;">
                                          <div class="form-group <?PHP if(form_error('vendor_arabic_name')){ echo 'has-error';} ?>">

                                                <label><?php echo "Vendor Name (Arabic)"?></label>

                                                 <input type="text" name="vendor_arabic_name" dir="rtl" class="form-control" placeholder="Vendor Name (Arabic)"  value="<?php echo $vendor_arabic_name;?>" >
                                                
                                                <label class="error"><?php echo form_error('vendor_arabic_name'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                         <div class="form-group <?PHP if(form_error('vendor_bank')){ echo 'has-error';} ?>">
                                                <label><?php echo 'Vendor Bank';?></label>
                                                <?php 
                                                            $attrib = 'class="form-control" data-live-search="true" data-width="100%" id="vendor_bank" ';
                                                         echo form_dropdown('vendor_bank', $drop_menu_bank, set_value('vendor_bank', (isset($vendor_bank)) ? $vendor_bank : ''), $attrib);
                                                          ?>
                                            
                                                 <label class="error"><?php echo form_error('vendor_bank'); ?></label>
                                            </div>
                                        </div>
                                            
                                    
                                      </div>
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
                                       <div class="row" >
                                        <div class="col-md-6">
                                           <fieldset>
                                      <legend><?php echo $this->lang->line('client_address_english')?></legend>
                                          <div class="row">
                                             <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('cr_no')){ echo 'has-error';} ?>">
                                               
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_cr_no');?>" id="cr_no" name="cr_no" value="<?php echo $cr_no; ?>">
                                                 <label class="error"><?php echo form_error('cr_no'); ?></label>
                                            </div>
                                          </div>
                                           <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('vendor_no')){ echo 'has-error';} ?>">
                                                
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_vendor_no');?>" id="vendor_no" name="vendor_no" value="<?php echo $vendor_no; ?>">
                                                 <label class="error"><?php echo form_error('vendor_no'); ?></label>
                                            </div>
                                        </div> 
                                        </div>


                                            <div class="row">

                                              <div class="col-md-12">
                                                <div class="form-group <?php if(form_error('address1')){ echo 'has-error'; }?>">
                                                   <input type="text" class="form-control" name="address1" autocomplete="off" id="address1" placeholder="Building Name/No., Apartment, Suite, Unit, Floor etc." value="<?php echo $address1;?>" >
                                                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('address1'); ?></label>
                                                </div>
                                              </div>
                                      
                                            </div>
                                                 <div class="row">
                                             <div class="col-md-12" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('street')){ echo 'has-error'; }?>">
                                                   <input type="text" class="form-control" name="street" autocomplete="off" id="street" placeholder="Street Name" value="<?php echo $street;?>" >
                                                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('street'); ?></label>
                                                </div>
                                              </div>
                                            </div>
                                               <div class="row">
                                             
                                               <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('city')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="city" autocomplete="off" id="city" placeholder="city" value="<?php echo $city;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('city'); ?></label>
                                              </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('district')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="district" autocomplete="off" id="district" placeholder="District" value="<?php echo $district;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('district'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('province')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="province" autocomplete="off" id="province" placeholder="Province" value="<?php echo $province;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('province'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('zip')){ echo 'has-error'; }?>">
              
                                                <input type="text" class="form-control" name="zip" autocomplete="off" id="zip" placeholder="Zip" value="<?php echo $zip;?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('zip'); ?></label>
                                              </div>
                                              </div>
                                               <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('area')){ echo 'has-error'; }?>">
              
                                                <input type="text" class="form-control" name="area" autocomplete="off" id="area" placeholder="PO Box" value="<?php echo $area;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('area'); ?></label>
                                             </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                            <div class="form-group <?php if(form_error('country')){ echo 'has-error'; }?>">
              
                                            <input type="text" class="form-control" name="country" autocomplete="off" id="country" placeholder="Country" value="<?php echo $country;?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('country'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                               <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('landline_no')){ echo 'has-error'; }?>">
                                               
                                                <input type="text" class="form-control" name="landline_no" autocomplete="off" id="landline_no" placeholder="Phone No1" value="<?php echo $landline_no;?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('landline_no'); ?></label>
                                              </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('landline_no1')){ echo 'has-error'; }?>">
                                               
                                                <input type="text" class="form-control" name="landline_no1" autocomplete="off" id="landline_no1" placeholder="Phone No2" value="<?php echo $landline_no1;?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('landline_no1'); ?></label>
                                              </div>
                                              </div>
                                               <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('fax')){ echo 'has-error'; }?>">
            
                                          <input type="text" class="form-control" name="fax" autocomplete="off" id="fax" placeholder="Fax" value="<?php echo $fax;?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('fax'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('contact_no')){ echo 'has-error'; }?>">
            
                                            <input type="text" class="form-control" name="contact_no" autocomplete="off" id="contact_no" placeholder="Mobile" value="<?php echo $contact_no;?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_no'); ?></label>
                                            </div>
                                              </div>
                                            <div class="col-md-4" style="margin-top: -15px;">
                                               <div class="form-group <?php if(form_error('email')){ echo 'has-error'; }?>">
              
                                            <input type="text" class="form-control" name="email" autocomplete="off" id="email" placeholder="Email" value="<?php echo $email;?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('email'); ?></label>
                                             </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('website')){ echo 'has-error'; }?>">
          
                                                <input type="text" class="form-control" name="website" autocomplete="off" id="website" placeholder="Website" value="<?php echo $website;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('website'); ?></label>
                                                </div>
                                                </div>
                                            </div>
                                      </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                        <fieldset>
                                        <legend><?php echo $this->lang->line('client_address_arabic')?></legend>
                                        <div class="row">
                                              <div class="col-md-4">
                                              </div>
                                              <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('vendor_no1')){ echo 'has-error';} ?>">
                                            
                                                 <input type="text"  dir="rtl" autocomplete="off" class="form-control"  placeholder="VAT Number (Arabic)" id="vendor_no1" name="vendor_no1" value="<?php echo $vendor_vat_arabic; ?>">
                                                 <label class="error"><?php echo form_error('vendor_no1'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('cr_no_arabic')){ echo 'has-error';} ?>">
                                               
                                                 <input type="text"   dir="rtl" autocomplete="off" class="form-control"  placeholder="CR No (Arabic)" id="cr_no_arabic" name="cr_no_arabic" value="<?php echo $cr_no_arabic; ?>">
                                                 <label class="error"><?php echo form_error('cr_no_arabic'); ?></label>
                                            </div>
                                          </div> 
                                        </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="form-group <?php if(form_error('address11')){ echo 'has-error'; }?>">
                                                  <input type="text" class="form-control " dir="rtl" name="address11" autocomplete="off" id="address11" placeholder="Building Name/No., Apartment, Suite, Unit, Floor etc (Arabic)" value="<?php echo $address11;?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('address11'); ?></label>
                                                </div>
                                                </div>
                                          
                                            </div>
                                                  <div class="row">
                                                <div class="col-md-12" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('street_arabic')){ echo 'has-error'; }?>">
                                                  <input type="text" class="form-control " dir="rtl" name="street_arabic" autocomplete="off" id="street_arabic" placeholder="Street Name (Arabic)" value="<?php echo $street_arabic;?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('street_arabic'); ?></label>
                                                </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                   <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('province_arabic')){ echo 'has-error'; }?>">
                                              <input type="text"  dir="rtl" class="form-control" name="province_arabic" autocomplete="off" id="province_arabic" placeholder="Province (Arabic)" value="<?php echo $province_arabic;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('province_arabic'); ?></label>
                                              </div>
                                              </div>
                                              
                                              <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('district_arabic')){ echo 'has-error'; }?>">
                                              <input type="text"  dir="rtl" class="form-control" name="district_arabic" autocomplete="off" id="district_arabic" placeholder="District (Arabic)" value="<?php echo $district_arabic;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('district_arabic'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('city_arabic')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control " name="city_arabic" autocomplete="off" id="city_arabic" placeholder="City (Arabic) " value="<?php echo $city_arabic;?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('city_arabic'); ?></label>
                                                </div>
                                              </div>
                                            
                                            </div>
                                            <div class="row">
                                               <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('country_arabic')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control" name="country_arabic" autocomplete="off" id="country_arabic" placeholder="Country (Arabic) " value="<?php echo $country_arabic;?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('city_arabic'); ?></label>
                                                </div>
                                                </div>
                                             
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('po_box_arabic')){ echo 'has-error'; }?>">
                                                  <input type="text"  dir="rtl" class="form-control " name="po_box_arabic" dir="rtl" autocomplete="off" id="po_box_arabic" placeholder="PO Box (Arabic) " value="<?php echo $po_box_arabic;?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('po_box_arabic'); ?></label>
                                                </div>
                                                </div>
                                                 <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('zip_arabic')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control " name="zip_arabic" autocomplete="off" id="zip_arabic" placeholder="Zip (Arabic) " value="<?php echo $zip_arabic;?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('address11'); ?></label>
                                                </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('fax_arabic')){ echo 'has-error'; }?>">
            
                                          <input type="text"  dir="rtl" class="form-control" name="fax_arabic" autocomplete="off" id="fax_arabic" placeholder="Fax (Arabic)" value="<?php echo $fax_arabic;?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('fax_arabic'); ?></label>
                                              </div>
                                              </div>
                                             
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('landline_no1_arabic')){ echo 'has-error'; }?>">
                                               
                                                <input type="text"  dir="rtl" class="form-control" name="landline_no1_arabic" autocomplete="off" id="landline_no1_arabic" placeholder="Phone No2 (Arabic)" value="<?php echo $landline_no1_arabic;?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('landline_no1_arabic'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('landline_no_arabic')){ echo 'has-error'; }?>">
                                               
                                                <input type="text"  dir="rtl" class="form-control" name="landline_no_arabic" autocomplete="off" id="landline_no_arabic" placeholder="Phone No1 (Arabic)" value="<?php echo $landline_no_arabic;?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('landline_no_arabic'); ?></label>
                                              </div>
                                              </div>
                                             
                                            </div>
                                             <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('website_arabic')){ echo 'has-error'; }?>">
          
                                                <input type="text"  dir="rtl" class="form-control" name="website_arabic" autocomplete="off" id="website_arabic" placeholder="Website (Arabic)" value="<?php echo $website_arabic;?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('website_arabic'); ?></label>
                                                </div>
                                                </div>
                                           
                                            <div class="col-md-4" style="margin-top: -15px;">
                                               <div class="form-group <?php if(form_error('email_arabic')){ echo 'has-error'; }?>">
              
                                            <input type="text"  dir="rtl" class="form-control" name="email_arabic" autocomplete="off" id="email_arabic" placeholder="Email (Arabic)" value="<?php echo $email_arabic;?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('email_arabic'); ?></label>
                                             </div>
                                                </div>
                                                     <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('contact_no_arabic')){ echo 'has-error'; }?>">
            
                                            <input type="text"  dir="rtl" class="form-control" name="contact_no_arabic" autocomplete="off" id="contact_no_arabic" placeholder="Mobile No ( Arabic )" value="<?php echo $contact_no_arabic;?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('contact_no_arabic'); ?></label>
                                            </div>
                                              </div>

                                              
                                            </div>
                                          </fieldset>
                                          </div>
                                       </div>
                  


        <div class="clearfix"></div>
                          
     
             <!--  <head><h3>Add delivery/Shipping address</h3></head> -->
            <!--   <hr> -->
             <div class="row" >
                  <div class="col-md-6">
                    <fieldset>
                    <legend><?php echo "Add delivery/Shipping address (English)";?></legend>
                  </fieldset>
                </div>
                 <div class="col-md-6">
                    <fieldset>
                    <legend><?php echo "Add delivery/Shipping address (Arabic)";?></legend>
                  </fieldset>
                </div>
              </div>
                 <div class="row">
          <div class="col-md-12">                  
            <span id="partProductData">
                <?php 
                $is=1;
                for($i=0; $i < $trow; $i++)
                {
                ?>

               
                <div class="row allrowvalues" id="rowssids_<?php echo $i;?>" col-span="2">
    


                          <div class="row" style="padding-right: 15px;padding-left: 15px"  >
                                        <div class="col-md-6">
                                           <fieldset>
                                      <!-- <legend><?php echo $this->lang->line('client_address_english')?></legend> -->
                                          <div class="row">
                                             <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('scr_no['.$i.']')){ echo 'has-error';} ?>">
                                               
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_cr_no');?>" id="scr_no<?php echo $i;?>" name="scr_no[]" value="<?php echo $scr_no[$i]; ?>">
                                                 <input type="hidden" class="form-control" name="scontact_address_id[]>" autocomplete="off" id="scontact_address_id<?php echo $i;?>" placeholder="Address" value="<?php echo $scontact_address_id[$i];?>">
                                                 <label class="error"><?php echo form_error('scr_no['.$i.']'); ?></label>
                                            </div>
                                          </div>
                                           <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('svendor_no['.$i.']')){ echo 'has-error';} ?>">
                                                
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="<?php echo $this->lang->line('client_vendor_no');?>" id="svendor_no<?php echo $i;?>" name="svendor_no[]" value="<?php echo $svendor_no[$i]; ?>">
                                                 <label class="error"><?php echo form_error('svendor_no['.$i.']'); ?></label>
                                            </div>
                                        </div> 
                                        </div>


                                            <div class="row">

                                              <div class="col-md-12">
                                                <div class="form-group <?php if(form_error('saddress1['.$i.']')){ echo 'has-error'; }?>">
                                                   <input type="text" class="form-control" name="saddress1[]" autocomplete="off" id="saddress1<?php echo $i;?>" placeholder="Building Name/No., Apartment, Suite, Unit, Floor etc." value="<?php echo $saddress1[$i];?>" >
                                                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('saddress1['.$i.']'); ?></label>
                                                </div>
                                              </div>
                                      
                                            </div>
                                                 <div class="row">
                                             <div class="col-md-12" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('sstreet['.$i.']')){ echo 'has-error'; }?>">
                                                   <input type="text" class="form-control" name="sstreet[]" autocomplete="off" id="sstreet<?php echo $i;?>" placeholder="Street Name" value="<?php echo $sstreet[$i];?>" >
                                                  <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sstreet['.$i.']'); ?></label>
                                                </div>
                                              </div>
                                            </div>
                                               <div class="row">
                                             
                                               <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('scity['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="scity[]" autocomplete="off" id="scity<?php echo $i;?>" placeholder="city" value="<?php echo $scity[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scity['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sdistrict['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="sdistrict[]" autocomplete="off" id="sdistrict<?php echo $i;?>" placeholder="District" value="<?php echo $sdistrict[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sdistrict['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sprovince['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text" class="form-control" name="sprovince[]" autocomplete="off" id="sprovince<?php echo $i;?>" placeholder="Province" value="<?php echo $sprovince[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sprovince['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('szip['.$i.']')){ echo 'has-error'; }?>">
              
                                                <input type="text" class="form-control" name="szip[]" autocomplete="off" id="szip<?php echo $i;?>" placeholder="Zip" value="<?php echo $szip[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('szip['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                               <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sarea['.$i.']')){ echo 'has-error'; }?>">
              
                                                <input type="text" class="form-control" name="sarea[]" autocomplete="off" id="sarea<?php echo $i;?>" placeholder="PO Box" value="<?php echo $sarea[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sarea['.$i.']'); ?></label>
                                             </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                            <div class="form-group <?php if(form_error('scountry['.$i.']')){ echo 'has-error'; }?>">
              
                                            <input type="text" class="form-control" name="scountry[]" autocomplete="off" id="scountry<?php echo $i;?>" placeholder="Country" value="<?php echo $scountry[$i];?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scountry['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                               <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text" class="form-control" name="slandline_no[]" autocomplete="off" id="slandline_no<?php echo $i;?>" placeholder="Phone No1" value="<?php echo $slandline_no[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no1['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text" class="form-control" name="slandline_no1[]" autocomplete="off" id="slandline_no1<?php echo $i;?>" placeholder="Phone No2" value="<?php echo $slandline_no1[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no1['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                               <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('sfax['.$i.']')){ echo 'has-error'; }?>">
            
                                          <input type="text" class="form-control" name="sfax[]" autocomplete="off" id="sfax<?php echo $i;?>" placeholder="Fax" value="<?php echo $sfax[$i];?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sfax['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('scontact_no['.$i.']')){ echo 'has-error'; }?>">
            
                                            <input type="text" class="form-control" name="scontact_no[]" autocomplete="off" id="scontact_no<?php echo $i;?><?php echo $i;?>" placeholder="Mobile" value="<?php echo $scontact_no[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scontact_no['.$i.']'); ?></label>
                                            </div>
                                              </div>
                                            <div class="col-md-4" style="margin-top: -15px;">
                                               <div class="form-group <?php if(form_error('semail['.$i.']')){ echo 'has-error'; }?>">
              
                                            <input type="text" class="form-control" name="semail[]" autocomplete="off" id="semail<?php echo $i;?>" placeholder="Email" value="<?php echo $semail[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('semail['.$i.']'); ?></label>
                                             </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('swebsite['.$i.']')){ echo 'has-error'; }?>">
          
                                                <input type="text" class="form-control" name="swebsite[]" autocomplete="off" id="swebsite<?php echo $i;?>" placeholder="Website" value="<?php echo $swebsite[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('swebsite['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                            </div>
                                      </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                        <fieldset>
                                     
                                        <div class="row">
                                              <div class="col-md-4">
                                              </div>
                                              <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('svendor_no1['.$i.']')){ echo 'has-error';} ?>">
                                            
                                                 <input type="text"  dir="rtl" autocomplete="off" class="form-control"  placeholder="VAT Number (Arabic)" id="svendor_no1<?php echo $i;?>" name="svendor_no1[]" value="<?php echo $svendor_vat_arabic[$i]; ?>">
                                                 <label class="error"><?php echo form_error('svendor_no1['.$i.']'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('scr_no_arabic['.$i.']')){ echo 'has-error';} ?>">
                                               
                                                 <input type="text"   dir="rtl" autocomplete="off" class="form-control"  placeholder="CR No (Arabic)" id="scr_no_arabic<?php echo $i;?>" name="scr_no_arabic[]" value="<?php echo $scr_no_arabic[$i]; ?>">
                                                 <label class="error"><?php echo form_error('scr_no_arabic['.$i.']'); ?></label>
                                            </div>
                                          </div> 
                                        </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="form-group <?php if(form_error('saddress11['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" class="form-control " dir="rtl" name="saddress11[]" autocomplete="off" id="saddress11<?php echo $i;?>" placeholder="Building Name/No., Apartment, Suite, Unit, Floor etc (Arabic)" value="<?php echo $saddress11[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('saddress11['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                          
                                            </div>
                                                  <div class="row">
                                                <div class="col-md-12" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('sstreet_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" class="form-control " dir="rtl" name="sstreet_arabic[]" autocomplete="off" id="sstreet_arabic<?php echo $i;?>" placeholder="Street Name (Arabic)" value="<?php echo $sstreet_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('sstreet_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                   <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sprovince_arabic['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text"  dir="rtl" class="form-control" name="sprovince_arabic[]" autocomplete="off" id="sprovince_arabic<?php echo $i;?>" placeholder="Province (Arabic)" value="<?php echo $sprovince_arabic[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sprovince_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                              
                                              <div class="col-md-4" style="margin-top: -15px;">
                                              <div class="form-group<?php if(form_error('sdistrict_arabic['.$i.']')){ echo 'has-error'; }?>">
                                              <input type="text"  dir="rtl" class="form-control" name="sdistrict_arabic[]" autocomplete="off" id="sdistrict_arabic<?php echo $i;?>" placeholder="District (Arabic)" value="<?php echo $sdistrict_arabic[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sdistrict_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('scity_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control " name="scity_arabic[]" autocomplete="off" id="scity_arabic<?php echo $i;?>" placeholder="City (Arabic) " value="<?php echo $scity_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('scity_arabic['.$i.']'); ?></label>
                                                </div>
                                              </div>
                                            
                                            </div>
                                            <div class="row">
                                               <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('scountry_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control" name="scountry_arabic[]" autocomplete="off" id="scountry_arabic<?php echo $i;?>" placeholder="Country (Arabic) " value="<?php echo $scountry_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('scountry_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                             
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('spo_box_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text"  dir="rtl" class="form-control " name="spo_box_arabic[]" dir="rtl" autocomplete="off" id="spo_box_arabic<?php echo $i;?>" placeholder="PO Box (Arabic) " value="<?php echo $spo_box_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('spo_box_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                                 <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('szip_arabic['.$i.']')){ echo 'has-error'; }?>">
                                                  <input type="text" dir="rtl" class="form-control " name="szip_arabic[]" autocomplete="off" id="szip_arabic<?php echo $i;?>" placeholder="Zip (Arabic) " value="<?php echo $szip_arabic[$i];?>" >

                                                  <label id="error" class="validation-error-label" for="location"><?php echo form_error('szip_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('sfax_arabic['.$i.']')){ echo 'has-error'; }?>">
            
                                          <input type="text"  dir="rtl" class="form-control" name="sfax_arabic[]" autocomplete="off" id="sfax_arabic<?php echo $i;?>" placeholder="Fax (Arabic)" value="<?php echo $sfax_arabic[$i];?>">
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sfax_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                             
                                              <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no1_arabic['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text"  dir="rtl" class="form-control" name="slandline_no1_arabic[]" autocomplete="off" id="slandline_no1_arabic<?php echo $i;?>" placeholder="Phone No2 (Arabic)" value="<?php echo $slandline_no1_arabic[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no1_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                <div class="form-group <?php if(form_error('slandline_no_arabic['.$i.']')){ echo 'has-error'; }?>">
                                               
                                                <input type="text"  dir="rtl" class="form-control" name="slandline_no_arabic[]" autocomplete="off" id="slandline_no_arabic<?php echo $i;?>" placeholder="Phone No1 (Arabic)" value="<?php echo $slandline_no_arabic[$i];?>">
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('slandline_no_arabic['.$i.']'); ?></label>
                                              </div>
                                              </div>
                                             
                                            </div>
                                             <div class="row">
                                                <div class="col-md-4" style="margin-top: -15px;">
                                                 <div class="form-group <?php if(form_error('swebsite_arabic['.$i.']')){ echo 'has-error'; }?>">
          
                                                <input type="text"  dir="rtl" class="form-control" name="swebsite_arabic[]" autocomplete="off" id="swebsite_arabic<?php echo $i;?>" placeholder="Website (Arabic)" value="<?php echo $swebsite_arabic[$i];?>">
                                              <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('swebsite_arabic['.$i.']'); ?></label>
                                                </div>
                                                </div>
                                           
                                            <div class="col-md-4" style="margin-top: -15px;">
                                               <div class="form-group <?php if(form_error('semail_arabic['.$i.']')){ echo 'has-error'; }?>">
              
                                            <input type="text"  dir="rtl" class="form-control" name="semail_arabic[]" autocomplete="off" id="semail_arabic<?php echo $i;?>" placeholder="Email (Arabic)" value="<?php echo $semail_arabic[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('semail_arabic['.$i.']'); ?></label>
                                             </div>
                                                </div>
                                                     <div class="col-md-4" style="margin-top: -15px;">
                                           <div class="form-group <?php if(form_error('scontact_no_arabic['.$i.']')){ echo 'has-error'; }?>">
            
                                            <input type="text"  dir="rtl" class="form-control" name="scontact_no_arabic[]" autocomplete="off" id="scontact_no_arabic<?php echo $i;?>" placeholder="Mobile No ( Arabic )" value="<?php echo $scontact_no_arabic[$i];?>" >
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('scontact_no_arabic['.$i.']'); ?></label>
                                            </div>
                                              </div>
                   </div>
                     <div class="row">

                          <div class="col-md-12" style="margin-top: -15px;" align="right">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart(<?PHP echo $i;?><?php echo ($scontact_address_id[$i]!='') ? ','.$scontact_address_id[$i] : '';?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                    </div>
                  </div> 

                                              
                                            </div>
                                          </fieldset>
                                          </div>
                                       </div>
                  


               </div>
              
               
                <?php 
                $is++; 
                } 
                ?>
            </span>                                            
          </div>
          <div class="col-md-3">
            <div class="col-md-1">
              <br>
              <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
              <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
            </div>
          </div>
      </div>
      <hr>
                                    
                                                                   

                                      <div class="text-left">                                            
                                        <input type="hidden" name="vendor_id" value="<?php echo $id;?>" />
                                        <input type="hidden" name="vendor_key" value="<?php echo $vendor_key;?>" />
                                        <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($id!='') ?  'Update': 'Create' ?> </button>
                                         <a href="<?php echo base_url().'masters/Vendor/'?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a> 
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
          "url":"<?php echo site_url('masters/Vendor/deleteshipAddress'); ?>",
          "type":"GET",
          data:{"prid":prid},
          success:function(data)
          {
            // alert("Daelted Successfully");
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