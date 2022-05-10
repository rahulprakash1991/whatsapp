<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $expenses_id=$row->expenses_id;
        $expenses=$row->expenses;  
        $expenses_status=$row->expenses_status;      
              
    }
}
else
{
        $payment_mode=$this->input->post('expenses');
        $pay_status=$this->input->post('expenses_status');

     
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
                                        <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('expenses')){ echo 'has-error';} ?>">
                                                    <label>Other Expenses<span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Expenses" id="expenses" name="expenses" value="<?php echo $expenses; ?>">
                                                     <label class="error"><?php echo form_error('expenses'); ?></label>
                                                </div>
                                            </div>                                      
                                           <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('expenses_status')){ echo 'has-error';} ?>">
                                                    <label>Status</label>
                                                    <select name="expenses_status" class="form-control">
                                                        <option value="1" <?php if($expenses_status=='1'){?> selected <?php }?>>Show</option>
                                                        <option value="0" <?php if($expenses_status=='0'){?> selected <?php }?>>Not Show</option>
                                                    </select>
                                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('expenses_status'); ?></label>
                                                </div>
                                            </div>                                            
                                        </div>                                      

                                        <div class="text-center">                                            
                                            <input type="hidden" autocomplete="off" name="expenses_id" value="<?php echo $expenses_id;?>" />
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($expenses_terms_id!='' ? 'Update Expenses' : 'Create Expenses'); ?> </button>
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


    
    
 
