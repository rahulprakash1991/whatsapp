<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $vendor_id      =   $row->id;
        $vendor_id_data    =   $row->vendor_id_name;        
        $vendor_id_status  =   $row->vendor_id_status;
    }
}
else
{
    $vendor_id_data    =   $this->input->post('vendor_id_data');
    $vendor_id_status  =   $this->input->post('vendor_id_status');
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
                                                <div class="form-group <?PHP if(form_error('vendor_id_data')){ echo 'has-error';} ?>">
                                                    <label>Vendor Name<span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Vendor Name" id="vendor_id_data" name="vendor_id_data" value="<?php echo $vendor_id_data; ?>">
                                                     <label class="error"><?php echo form_error('vendor_id_data'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group <?PHP if(form_error('vendor_id_status')){ echo 'has-error';} ?>">
                                                    <label>Status</label>
                                                    <select name="vendor_id_status" class="form-control">
                                                        <option value="1" <?php if($vendor_id_status=='1'){?> selected <?php }?>>Show</option>
                                                        <option value="0" <?php if($vendor_id_status=='0'){?> selected <?php }?>>Not Show</option>
                                                    </select>
                                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('vendor_id_status'); ?></label>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="text-left">                                            
                                            <input type="hidden" name="vendor_id" value="<?php echo $vendor_id;?>" />
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($vendor_id!='' ? 'Update ' : 'Create '); ?> </button>
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


    
    
 
