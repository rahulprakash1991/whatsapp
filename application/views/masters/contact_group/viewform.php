<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $cg_id      =   $row->cg_id;
        $con_type   =   $row->con_type;        
        $cg_name    =   $row->cg_name;        
        $cg_status  =   $row->cg_status;
    }
}
else
{
    $con_type   =   $this->input->post('con_type');
    $cg_name    =   $this->input->post('cg_name');
    $cg_status  =   $this->input->post('cg_status');
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
                                            <div class="col-md-2">
                                                <div class="form-group <?PHP if(form_error('con_type')){ echo 'has-error';} ?>">
                                                <label>Contact Type<span1>*</span1></label>
                                                  <div class="control-group" id="con_type">
                                                    <div class="controls">
                                                      <label>
                                                        <input type="radio" name="con_type" value="1" <?php if($con_type=='1'){?> checked <?php }?>  /> Customer
                                                      </label>
                                                      <label>
                                                        <input type="radio" name="con_type" value="0"  <?php if($con_type=='0'){?> checked <?php }?> /> Vendor
                                                      </label>
                                                    </div>
                                                  </div>
                                                  <label class="error"><?php echo form_error('con_type'); ?></label>
                                                </div>                                              
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('cg_name')){ echo 'has-error';} ?>">
                                                    <label>Contact Group<span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Contact Type" id="cg_name" name="cg_name" value="<?php echo $cg_name; ?>">
                                                     <label class="error"><?php echo form_error('cg_name'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group <?PHP if(form_error('cg_status')){ echo 'has-error';} ?>">
                                                    <label>Status</label>
                                                    <select name="cg_status" class="form-control">
                                                        <option value="1" <?php if($cg_status=='1'){?> selected <?php }?>>Show</option>
                                                        <option value="0" <?php if($cg_status=='0'){?> selected <?php }?>>Not Show</option>
                                                    </select>
                                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('cg_status'); ?></label>
                                                </div>
                                            </div>                                            
                                        </div>                                      

                                        <div class="text-center">                                            
                                            <input type="hidden" name="cg_id" value="<?php echo $cg_id;?>" />
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($cg_id!='' ? 'Update Contact Type' : 'Create Contact Type'); ?> </button>
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


    
    
 
