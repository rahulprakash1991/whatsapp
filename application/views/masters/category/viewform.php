<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $c_id=$row->c_id;
        $c_name=$row->c_name;       
        $c_siteimage=$row->c_siteimage;       
        $c_androidimage=$row->c_androidimage;       
        $c_order=$row->c_order;       
        $c_status=$row->c_status;       
        $c_indextype=$row->c_indextype;       
    }
}
else
{
        $c_id=$this->input->post('c_id');
        $c_name=$this->input->post('c_name');
        $c_siteimage=$this->input->post('c_siteimage');
        $c_androidimage=$this->input->post('c_androidimage');
        $c_status=$this->input->post('c_status');
        $c_order=$this->input->post('c_order');
        $c_indextype=$this->input->post('c_indextype');
        
}
?>
            <div class="page-inner">
                <div class="page-title">
                    <h3><?PHP echo $form_toptittle; ?></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>">Home</a></li>
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
                                                <div class="form-group <?PHP if(form_error('c_name')){ echo 'has-error';} ?>">
                                                    <label>Category Name</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Category Name" id="c_name" name="c_name" value="<?php echo $c_name; ?>">
                                                     <label class="error"><?php echo form_error('c_name'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('c_siteimage')){ echo 'has-error';} ?>">
                                                    <label>Site Image</label>
                                                    <input type="file" class="form-control" id="c_siteimage" name="c_siteimage">
                                                    <label class="error"><?php echo form_error('c_siteimage'); ?></label>
                                                     <?PHP 
                                                    if($c_siteimage!='')
                                                    {
                                                        ?>
                                                        <div class="media-right">
                                                            <a href="<?php echo config_item("image_url").$c_siteimage; ?>"><img src="<?php echo config_item("image_url").$c_siteimage; ?>" style="width: 58px; height: 58px; border-radius: 2px;" alt=""></a>
                                                        </div>
                                                        <?php 
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('c_androidimage')){ echo 'has-error';} ?>">
                                                    <label>Android Image</label>
                                                    <input type="file" class="form-control" id="c_androidimage" name="c_androidimage">
                                                    <label class="error"><?php echo form_error('c_androidimage'); ?></label>
                                                    <?PHP 
                                                    if($c_androidimage!='')
                                                    {
                                                        ?>
                                                        <div class="media-right">
                                                            <a href="<?php echo config_item("image_url").$c_androidimage; ?>"><img src="<?php echo config_item("image_url").$c_androidimage; ?>" style="width: 58px; height: 58px; border-radius: 2px;" alt=""></a>
                                                        </div>
                                                        <?php 
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('c_order')){ echo 'has-error';} ?>">
                                                    <label>Category Order</label>
                                                     <input type="text" class="form-control"  placeholder="Enter Order Value" id="c_order" name="c_order" value="<?php echo $c_order; ?>">
                                                     <label class="error"><?php echo form_error('c_order'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('c_indextype')){ echo 'has-error';} ?>">
                                                       <div class="control-group" id="toastTypeGroup">
                                                            <div class="controls">
                                                                <label>Type</label>
                                                                    <input type="radio" name="c_indextype" value="1" <?php if($c_indextype=='1'){?> checked <?php }else{?> checked<?php }?>  /> Show Index
                                                                    <input type="radio" name="c_indextype" value="0"  <?php if($c_indextype=='0'){?> checked <?php }?> /> Notshow Index
                                                            </div>
                                                        </div>
                                                     <label class="error"><?php echo form_error('pd_type'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('c_status')){ echo 'has-error';} ?>">
                                                    <label>Status</label>
                                                    <select name="c_status" class="form-control">
                                                        <option value="1" <?php if($c_status=='1'){?> selected <?php }?>>Show</option>
                                                        <option value="0" <?php if($c_status=='0'){?> selected <?php }?>>Not Show</option>
                                                    </select>
                                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('c_status'); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <input type="hidden" name="old_androidimage" value="<?php echo $c_androidimage;?>" />
                                            <input type="hidden" name="old_siteimage" value="<?php echo $c_siteimage;?>" />
                                            <input type="hidden" name="c_id" value="<?php echo $c_id;?>" />
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($c_id!='' ? 'Update Category' : 'Create Category'); ?> </button>
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
                    </div>  

                </div><!-- Main Wrapper -->


    
    
 