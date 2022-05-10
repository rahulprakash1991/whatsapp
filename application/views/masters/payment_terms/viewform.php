<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $payment_terms_id=$row->payment_terms_id;
        $payment_terms=$row->payment_terms;  
        $payment_no_days=$row->payment_no_days;      
        $payment_status=$row->payment_status;      
              
    }
}
else
{
        $payment_terms=$this->input->post('payment_terms');
        $payment_no_days=$this->input->post('payment_no_days');
        $payment_status=$this->input->post('payment_status');

     
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
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"><?PHP echo $form_tittle; ?></h4>
                                </div>
                                <div class="panel-body">
                                    <?php echo form_open_multipart($form_url); ?>
                                        <div class="row">
                                        <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('payment_terms')){ echo 'has-error';} ?>">
                                                        <label>Payment Terms<span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Payment Terms" id="payment_terms" name="payment_terms" value="<?php echo $payment_terms; ?>">
                                                     <label class="error"><?php echo form_error('payment_terms'); ?></label>
                                               
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-2">
                                                <div class="form-group <?PHP if(form_error('payment_no_days')){ echo 'has-error';} ?>">
                                                    <label>No Of Days</label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter No Of Days" id="payment_no_days" name="payment_no_days" value="<?php echo $payment_no_days; ?>">
                                                     <label class="error"><?php echo form_error('payment_no_days'); ?></label>
                                                </div>
                                            </div>
                                           <div class="col-md-2">
                                                <div class="form-group <?PHP if(form_error('payment_status')){ echo 'has-error';} ?>">
                                                    <label>Status</label>
                                                    <select name="payment_status" class="form-control">
                                                        <option value="1" <?php if($payment_status=='1'){?> selected <?php }?>>Show</option>
                                                        <option value="0" <?php if($payment_status=='0'){?> selected <?php }?>>Not Show</option>
                                                    </select>
                                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('payment_status'); ?></label>
                                                </div>
                                            </div>                                            
                                        </div>                                      

                                        <div class="text-left">                                            
                                            <input type="hidden" autocomplete="off" name="payment_terms_id" value="<?php echo $payment_terms_id;?>" />
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($payment_terms_id!='' ? 'Update ' : 'Create '); ?> </button>
                                             <a href="<?php echo base_url()?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a> 
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->


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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"><?PHP echo $list_tittle; ?></h4>
                                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
                                        <?php 
                                            echo $this->table->generate(); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->

                </div><!-- Main Wrapper -->


    
    
 
