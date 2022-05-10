 <?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $id            =   $row->id;
        $client_id            =   $row->client_id;  
        $department_id           =   $row->department_id;  
        $mode_id          =   $row->mode_id;
        $client_rep_id          =   $row->client_rep_id;
        $reff         =   $row->enq_ref;
        $response_date        =   $row->enq_ref_date;
        $enq_note                =   $row->enq_notes;     
            
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
                                       <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('client_name')){ echo 'has-error';} ?>">

                                                <label>Client Name<span1>*</span1></label>

                                                 <!-- <input type="text" autocomplete="off" class="form-control"  placeholder="Enter client_name" id="client_name" name="client_name" value="<?php echo $client_name; ?>" required> -->
                                                  <select name="client_name" id="client_name" onChange="loadaddress(this.value)"  class="form-control" required="" >
                                                    <?php foreach ($drop_menu_client as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $client_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                                <label class="error"><?php echo form_error('client_name'); ?></label>
                                            </div>
                                        </div>
                                       <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('depatment')){ echo 'has-error';} ?>">
                                                <label>Department <span1>*</span1></label>

                                             <!--        <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Client Abbrevation" id="client_ab" name="client_ab" value="<?php echo $client_ab; ?>" required> -->
                                             <select name="depatment" id="depatment" class="form-control" required >
                                                    <?php foreach ($drop_menu_department as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $department_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                                <label class="error"><?php echo form_error('depatment'); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('mode')){ echo 'has-error';} ?>">
                                                <label>Mode</label>
                                                 
                                              
                                                  <select name="mode" id="mode" class="form-control" >
                                                    <?php foreach ($drop_menu_mode as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $mode_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                              
                                                 <label class="error"><?php echo form_error('mode'); ?></label>
                                            </div>
                                        </div>                                        
                                      
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('client_rep')){ echo 'has-error';} ?>">
                                                <label>Client Representative<span1>*</span1><span>&nbsp;&nbsp;&nbsp;&nbsp;<a data-toggle="modal" onclick="addrepModal()" data-toggle="modal" data-target=".bs-example-modal-lg" class=" glyphicon glyphicon-plus"></a></span></label>
                                              
                                                   <select name="client_rep" id="client_rep" class="form-control" required>
                                                    <?php foreach ($drop_menu_client_rep as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $client_rep_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                             
                                                 <label class="error"><?php echo form_error('reff'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('reff')){ echo 'has-error';} ?>">
                                                <label>Enquiry Reference</label>
                                                    <input type="text" autocomplete="off" class="form-control"  placeholder="Enquiry Reference" id="reff" name="reff" value="<?php echo $reff; ?>">
                                                 <label class="error"><?php echo form_error('reff'); ?></label>
                                                
                                            
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group <?PHP if(form_error('response_date')){ echo 'has-error';} ?>">
                                                <label>Expected Response Date</label>
                                                  <input type="text" class="form-control date-picker" placeholder="Response Date" autocomplete="off" value="<?php echo ($response_date!='' && $response_date!='0000-00-00') ? $response_date : date('d M, Y'); ?>" name="response_date" id="response_date" style="background-color:#fff"  >
                                                 <label class="error"><?php echo form_error('response_date'); ?></label>
                                            </div>
                                        </div>  
                                       
                                                                                      
                                        
                                    </div>
                                   <div class="row">
                                     <div class="col-md-12">
                                            <div class="form-group <?PHP if(form_error('enq_note')){ echo 'has-error';} ?>">
                                                <label>Enquiry Notes</label>
                                                 <textarea id="console" name="enq_note" autocomplete="off" class="form-control summernote" rows="1" style="min-height: 1px;" ><?php echo $enq_note;?></textarea>

                                                 <label class="error"><?php echo form_error('enq_note'); ?></label>
                                            </div>
                                        </div>
                                   </div>
                                    
                                                                   

                                    <div class="text-center">                                            
                                        <input type="hidden" name="enquiry_id" value="<?php echo $id;?>" />
                                        <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($id!='' ? 'Update Enquiry' : 'Create Enquiry'); ?> </button>
                                            <a href="<?php echo base_url().'masters/Enquiry/'?>" class="btn btn-primary">Cancel</a> 
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                </div>
            </div>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">                       
                <div class="modal-content" id="viewajaxcontent">   
                </div>
            </div>
        </div>  
        <script type="text/javascript">
          function addrepModal()
          {
     
            $.ajax({
              type: "GET",
              url: "<?php echo site_url('masters/Enquiry/addClientRep'); ?>",
              dataType:"html",
              success: function(response)
              {
                
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });
           
          }
          function loadaddress(id)
            {

              $.ajax({
                type: "GET",
                url: "<?php echo site_url('masters/Enquiry/loadaddress'); ?>", 
                data: { con_id:id},
                dataType:"html",
                success: function(html)
                { 
                  
                  $('#client_rep').html(html);
                  
                },
              });
            }
        </script>