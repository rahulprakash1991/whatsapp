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
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"><?PHP echo $form_tittle; ?></h4>
                                </div>
                                <div class="panel-body">
                                    <?php echo form_open_multipart($form_url); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('mob_no')){ echo 'has-error';} ?>">
                                                    <label>Enter Your Mobile <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Your Mobile" id="mob_no" name="mob_no" value="<?php echo $mob_no; ?>">
                                                     <label class="error"><?php echo form_error('mob_no'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group <?PHP if(form_error('msg')){ echo 'has-error';} ?>">
                                                    <label>Message <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Entermsg" id="msg" name="msg" value="<?php echo $msg; ?>">
                                                     <label class="error"><?php echo form_error('msg'); ?></label>
                                                </div>
                                            </div>
                                           
                                             
                                        </div>
                                      
                                   
                                      
                                        <div class="text-left">    
                                            
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($bank_id!='' ? 'Update' : 'Create '); ?> </button>
                                             <a href="<?php echo base_url()?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a> 
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->

                    <!-- /page container -->
                   
                 

                </div><!-- Main Wrapper -->


    
    
 
