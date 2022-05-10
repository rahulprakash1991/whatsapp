<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $bank_id        =   $row->bank_id;
        $account_no     =   $row->account_no;
        $account_name   =   $row->account_name;
        $bank_name      =   $row->bank_name;
        $branch_name    =   $row->branch_name;
        $ifs_code       =   $row->ifs_code;
        $micr_no        =   $row->micr_no;
        $cur_bal        =   $row->cur_bal;
        $min_bal        =   $row->min_bal;   
        $bank_status    =   $row->bank_status;  
    }
}
else
{   
        $account_no      =   $this->input->post('account_no');
        $account_name    =   $this->input->post('account_name');
        $bank_name       =   $this->input->post('bank_name');
        $branch_name     =   $this->input->post('branch_name');
        $ifs_code        =   $this->input->post('ifs_code');
        $micr_no         =   $this->input->post('micr_no');
        $cur_bal         =   $this->input->post('cur_bal');
        $min_bal         =   $this->input->post('min_bal');
        $bank_status     =   $this->input->post('bank_status');
       
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
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('account_no')){ echo 'has-error';} ?>">
                                                    <label>Account No <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Account No" id="account_no" name="account_no" value="<?php echo $account_no; ?>">
                                                     <label class="error"><?php echo form_error('account_no'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('account_name')){ echo 'has-error';} ?>">
                                                    <label>Account Name <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Account Name" id="account_name" name="account_name" value="<?php echo $account_name; ?>">
                                                     <label class="error"><?php echo form_error('account_name'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('bank_name')){ echo 'has-error';} ?>">
                                                    <label>Bank Name <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Bank Name" id="bank_name" name="bank_name" value="<?php echo $bank_name; ?>">
                                                     <label class="error"><?php echo form_error('bank_name'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('branch_name')){ echo 'has-error';} ?>">
                                                    <label>Branch Name <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Branch Name" id="branch_name" name="branch_name" value="<?php echo $branch_name; ?>">
                                                     <label class="error"><?php echo form_error('branch_name'); ?></label>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="row">   
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('ifs_code')){ echo 'has-error';} ?>">
                                                    <label>IFS Code <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter IFS Code" id="ifs_code" name="ifs_code" value="<?php echo $ifs_code; ?>">
                                                     <label class="error"><?php echo form_error('ifs_code'); ?></label>
                                                </div>
                                            </div>                       
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('micr_no')){ echo 'has-error';} ?>">
                                                    <label>MICR <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter MICR" id="micr_no" name="micr_no" value="<?php echo $micr_no; ?>">
                                                     <label class="error"><?php echo form_error('micr_no'); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('cur_bal')){ echo 'has-error';} ?>">
                                                    <label>Current Balance <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Current Balance" id="cur_bal" name="cur_bal" value="<?php echo $cur_bal; ?>">
                                                     <label class="error"><?php echo form_error('cur_bal'); ?></label>
                                                </div>
                                            </div>
                                             <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('min_bal')){ echo 'has-error';} ?>">
                                                    <label>Minimum Balance <span1>*</span1></label>
                                                     <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Minimum Balance" id="min_bal" name="min_bal" value="<?php echo $min_bal; ?>">
                                                     <label class="error"><?php echo form_error('min_bal'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group <?PHP if(form_error('bank_status')){ echo 'has-error';} ?>">
                                                    <label>Status</label>
                                                    <select name="bank_status" class="form-control">
                                                        <option value="1" <?php if($bank_status=='1'){?> selected <?php }?>>Show</option>
                                                        <option value="0" <?php if($bank_status=='0'){?> selected <?php }?>>Not Show</option>
                                                    </select>
                                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('bank_status'); ?></label>
                                                </div>
                                            </div>                      
                                        </div>
                                      
                                        <div class="text-center">    
                                            <input type="hidden" autocomplete="off" name="bank_id" value="<?php echo $bank_id;?>" />
                                            <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($bank_id!='' ? 'Update bank details' : 'Create bank details'); ?> </button>
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


    
    
 