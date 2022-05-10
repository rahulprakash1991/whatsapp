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
    $address[$key]      = $row->client_address;
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
          <div class="col-md-12">                  
            <span id="partProductData">
              <head><h3>Add delivery/Shipping address</h3></head>
            <!--   <hr> -->
                <?php 
                $is=1;
                for($i=0; $i < $trow; $i++)
                {
                ?>
                <div class="row allrowvalues" id="rowssids_<?php echo $i;?>">
                  <div class="col-md-3">
                    <div class="form-group <?PHP if(form_error('address')){ echo 'has-error';} ?>">
                      <textarea  autocomplete="off" name="address[]" class="form-control address" autocomplete="off" rows="4" id="address<?php echo $i;?>"><?php echo $address[$i];?></textarea>
                      <label class="error"><?php echo form_error('address'); ?></label>
                    </div>
                  </div>  
                  <div class="col-md-2">
                    <div class="form-group">
                      <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?>)" class="btn btn-danger btn-xs"  title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
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
            </script>