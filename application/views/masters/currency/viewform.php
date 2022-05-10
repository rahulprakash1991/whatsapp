<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $cur_id=$row->cur_id;
        $cur_name=$row->cur_name;  
        $cur_symbol=$row->currency;      
        $cur_status=$row->cur_status; 
        $country=$row->state;  
        $cur_iso=$row->iso_code;      
        $unit=$row->unit; 
        $basic=$row->num_to_basic; 


              
    }
}
else
{
        $cur_name=$this->input->post('cur_name');
        $cur_symbol=$this->input->post('cur_symbol');
        $cur_status=$this->input->post('cur_status');

        $country=$this->input->post('country');
        $cur_iso=$this->input->post('cur_iso');
        $unit=$this->input->post('unit');
        $basic=$this->input->post('basic');


     
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
                                                <div class="form-group <?PHP if(form_error('country')){ echo 'has-error';} ?>">
                                                    <label>Country<span1>*</span1></label>
                                                     <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Country Name" id="country" name="country" value="<?php echo $country; ?>">
                                                     <label class="error"><?php echo form_error('country'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('cur_name')){ echo 'has-error';} ?>">
                                                    <label>Currency Name<span1>*</span1></label>
                                                     <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Currency Name" id="cur_name" name="cur_name" value="<?php echo $cur_name; ?>">
                                                     <label class="error"><?php echo form_error('cur_name'); ?></label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('cur_symbol')){ echo 'has-error';} ?>">
                                                    <label>Currency Symbol<span1>*</span1></label>
                                                    
                                                      <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Currency Symbol" id="cur_symbol" name="cur_symbol" value="<?php echo $cur_symbol; ?>">
                                                     <label class="error"><?php echo form_error('cur_symbol'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('cur_iso')){ echo 'has-error';} ?>">
                                                    <label>ISO Code</label>
                                                    
                                                      <input type="text" class="form-control" autocomplete="off"  placeholder="Enter ISO Code" id="cur_iso" name="cur_iso" value="<?php echo $cur_iso; ?>">
                                                     <label class="error"><?php echo form_error('cur_iso'); ?></label>
                                                </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('unit')){ echo 'has-error';} ?>">
                                                    <label>Fractional Unit</label>
                                                    
                                                      <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Fractional Unit" id="unit" name="unit" value="<?php echo $unit; ?>">
                                                     <label class="error"><?php echo form_error('unit'); ?></label>
                                                </div>
                                            </div>
                                              <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('basic')){ echo 'has-error';} ?>">
                                                    <label>Number to Basic</label>
                                                    
                                                      <input type="text" class="form-control" autocomplete="off"  placeholder="Enter Number to Basic" id="basic" name="basic" value="<?php echo $basic; ?>">
                                                     <label class="error"><?php echo form_error('basic'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-4">
                                                <div class="form-group <?PHP if(form_error('cur_status')){ echo 'has-error';} ?>">
                                                    <label>Status</label>
                                                    <select name="cur_status" class="form-control">
                                                        <option value="1" <?php if($cur_status=='1'){?> selected <?php }?>>Show</option>
                                                        <option value="0" <?php if($cur_status=='0'){?> selected <?php }?>>Not Show</option>
                                                    </select>
                                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('cur_status'); ?></label>
                                                </div>
                                            </div>                                            
                                        </div>                                      

                                        <div class="text-left">                                            
                                            <input type="hidden" name="cur_id" value="<?php echo $cur_id;?>" />
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($cur_id!='' ? 'Update' : 'Create '); ?> </button>
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


    
    
 
