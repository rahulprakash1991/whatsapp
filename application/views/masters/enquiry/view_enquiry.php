<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $id            =   $row->id;
        $key = $row->enq_key;

        $create_name            =   $row->username;
        $dept = $row->department_name;  
        $mode = $row->name;
        $response_date = $row->enq_ref_date;
        $rep_id = $row->rep_id;
        // print_r($rep_id);die;
        $rep_name = $row->rep_name;
        $rep_email = $row->email;
        $rep_mobile = $row->mobile;
        $rep_desig = $row->designation;
        $client_name = $row->client_name;
        $client_email = $row->client_email;
        $client_mobile = $row->client_mobile;
        $client_id =$row->client_id;
         
            
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
                      <div class="row">
                      <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>"><strong>Home</strong></a></li>
                            <li class="active"><?PHP echo $form_toptittle; ?></li>
                              <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js">
                              </script>
                        </ol>
                      </div>
                           <div class="col-md-6" align="right">
                                  <?php if($quote_id!=''){?>
                                      <a href="<?php echo base_url().'Quotation/operation/'.$quote_id.'';?>" style="text-align: right;" class="btn btn-success">View Quotation</a>
                                    <?php } else{?>
                                       <a href="<?php echo base_url().'Quotation/add_newquotation/'.$enq_id.'/'.$quote_id.'';?>" style="text-align: right;" class="btn btn-success">Create Quotation</a>
                                    <?php }?>
                                       <a href="<?php echo base_url().'masters/Enquiry';?>" style="text-align: right;" class="btn btn-success">Back</a>
                                  </div>
                    </div>
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
                                       <div class="col-md-12">
                                            <div class="form-group <?PHP if(form_error('client_name')){ echo 'has-error';} ?>">

                                                <label style="font-size: 20px;font-family: Open Sans', sans-serif;"><b>Enquiry Details</b></label><label style="font-size: 16px;font-family: Open Sans', sans-serif;">&nbsp;&nbsp;<a href="<?php echo base_url().'masters/Enquiry/operation/'.$enq_id.'';?>" title="Edit" class="btn btn-info" style="text-align: right;height: 2%" ><i class="glyphicon glyphicon-pencil"></i></a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="font-size: 16px;font-family: Open Sans', sans-serif;">
                                      <div class="col-md-4">
                                        Enquiry No#:<span style="color: green"><?php echo $key; ?></span>
                                       
                                      </div> 
                                       <div class="col-md-4">
                                        Department :  <?php echo $dept;?>
                                      </div>                                     
                                      
                                    </div>
                                    <div class="row"style="font-size: 16px;font-family: Open Sans', sans-serif;">
                                      <div class="col-md-4">
                                     
                                          Created By :<?php echo $create_name;?>
                                         
                                      </div> 
                                       <div class="col-md-4">
                                        Mode of Contact:<?php echo $mode;?>
                                      </div>                                     
                                      
                                    </div>
                                    <div class="row"style="font-size: 16px;font-family: Open Sans', sans-serif;">
                                      <div class="col-md-4">
                                       
                                      </div> 
                                       <div class="col-md-4">
                                        Excepted Response Date :<?php echo $response_date;?>
                                      </div>                                     
                                      
                                    </div>
                               
                                    <hr>

                                   
                                  <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group <?PHP if(form_error('client_name')){ echo 'has-error';} ?>">

                                                <label style="font-size: 20px;"><b>Client Information</b></label>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4" style="font-size: 16px;font-family: Open Sans', sans-serif;">
                                            
                                                <label style="font-size: 16px;font-family: Open Sans', sans-serif;" ><b>Client Details</b>&nbsp;&nbsp;<a href="<?php echo base_url().'masters/Client/operation/'.$client_id.'';?>" title="Edit" class="btn btn-info" style="text-align: right;" ><i class="glyphicon glyphicon-pencil"></i></a></label>
                                                 <br>
                                                  <?php echo  $client_name;?><br>
                                                  <?php echo  $client_mobile;?><br>
                                                  <?php echo  $client_email;?><br>
                                            
                                        </div>
                                          <div class="col-md-4" style="font-size: 16px;font-family: Open Sans', sans-serif;">
                                            
                                                <label style="font-size: 16px;font-family: Open Sans', sans-serif;"><b>Representative Details</b>&nbsp;&nbsp;<a href="#" onclick="LoadModal(<?php echo $enq_id ;echo ',';echo $rep_id;?>);" title="Edit" class="btn btn-info" style="text-align: right;" ><i class="glyphicon glyphicon-pencil"></i></a></label>       
                                                <br>
                                                <?php echo $rep_name;?><br>
                                                <?php echo $rep_desig;?><br>
                                                <?php echo $rep_mobile;?><br>
                                                <?php echo  strtolower($rep_email);?><br>
                                              
                                            
                                        </div>
                                  </div>
                                  <hr>
                              <!--     <?php if($quote_id!=''){?>
                                     <div class="row">
                                    <div class="col-md-12">
                                            
                                       <label style="font-size: 20px;font-family: Open Sans', sans-serif;"><b> Quote Details   </b></label>     
                                            
                                        </div>
                                         
                                  </div> -->
                             
                                  <!--  <div class="row" style="font-size: 16px;font-family: Open Sans', sans-serif;">
                                    <div class="col-md-12">    
                                        Quote NO #:<span style="color: green">  <?php echo $quote_key;?> </span>       
                                    </div>
                                         
                                  </div>
                            
                                   <div class="row" style="font-size: 16px;font-family: Open Sans', sans-serif;">
                                    <div class="col-md-12">    
                                        Quote Value:  <?php echo $quote_value;?>&nbsp;&nbsp;<a href="<?php echo base_url().'Quotation/quotation_add/'.$quote_id.'/'.$enq_id.'';?>" title="Edit" class="btn btn-info" style="text-align: right;"  ><i class="glyphicon glyphicon-pencil" ></i></a>     
                                    </div>
                                         
                                  </div> -->
                               <!--    <hr>
                                <?php } ?> -->
                                                                   


                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                </div>
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">                       
                <div class="modal-content" id="viewajaxcontent">   
                </div>
            </div>
        </div>
                <script type="text/javascript">
                  function LoadModal(id,val) {
               
                   $.ajax({
              type: "GET",
              url: "<?php echo site_url('masters/Enquiry/addClientRep'); ?>",
              dataType:"html",
              data: {rep_id:val},
              success: function(response)
              {
                ;
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });
                  }
                </script>
           
        