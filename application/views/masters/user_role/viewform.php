<?php
$actionIdArr = array();

if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $role_id      =   $row->role_id;
        $role_name    =   $row->role_name;
        $role_status  =   $row->role_status;
    }

    foreach($aclActions as $row)
    {
        $actionIdArr[]      =   $row->action_id;
    }    
}
else
{
    $role_id      =   $this->input->post('role_id');
    $role_name    =   $this->input->post('role_name');
    $role_status  =   $this->input->post('role_status');
    $actionIdArr  =   $this->input->post('acl_actions');
}

$aclActions = array();
foreach($getACLActions as $row){
    $aclActions[$row->category_id]['category_code']     =  $row->category_code;
    $aclActions[$row->category_id]['category_desc']     =  $row->category_desc;
    $aclActions[$row->category_id]['acl_actions'][]     =  $row;
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
                                    <div class="form-group <?PHP if(form_error('role_name')){ echo 'has-error';} ?>">
                                        <label>User Role<span1>*</span1></label>
                                         <input type="text" autocomplete="off" class="form-control"  placeholder="Enter User Role" id="role_name" name="role_name" value="<?php echo $role_name; ?>">
                                         <label class="error"><?php echo form_error('role_name'); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group <?PHP if(form_error('role_status')){ echo 'has-error';} ?>">
                                        <label>Status</label>
                                        <select name="role_status" class="form-control">
                                            <option value="1" <?php if($role_status=='1'){?> selected <?php }?>>Show</option>
                                            <option value="0" <?php if($role_status=='0'){?> selected <?php }?>>Not Show</option>
                                        </select>
                                        <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('role_status'); ?></label>
                                    </div>
                                </div>                                            
                            </div>
                            <h4>ACL Actions</h4>
                            <div class="row">
                                <?php
                                $i = 1;
                                foreach ($aclActions as $category_id => $data) {
                                   ?>
                                    <ul class="list-group col-md-4">
                                      <li class="list-group-item active" style="text-transform: capitalize;">
                                        <strong><?php echo $data['category_desc'];?></strong>
                                        <label class="pull-right"><input type="checkbox" class="checkedAll" data-category="<?php echo $data['category_code'];?>"></label>
                                      </li>
                                      <?php
                                      foreach ($data['acl_actions'] as $aclData) {
                                          ?>
                                            <li class="list-group-item">
                                                <span style="text-transform: capitalize;"><?php echo str_replace('_', ' ', $aclData->action_code);?></span>
                                                <label class="pull-right"><input name="acl_actions[]" value="<?php echo $aclData->action_id;?>" type="checkbox" class="<?php echo $data['category_code'];?>" <?php echo ( in_array($aclData->action_id, $actionIdArr) ) ? 'checked' : ''; ?>></label>
                                                <br />
                                                <small><i>(<?php echo $aclData->action_desc;?>)</i></small>
                                            </li>
                                          <?php
                                      }
                                      ?>
                                    </ul>
                                   <?php
                                   if($i % 3 == 0){ echo '<div class="clearfix"></div>';}
                                   $i++;
                                }
                                ?>
                            </div>
                            <div class="text-center">                                            
                                <input type="hidden" name="role_id" value="<?php echo $role_id;?>" />
                                <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($role_id!='' ? 'Update User Role' : 'Create User Role'); ?> </button>
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
            });

          $(".checkedAll").click(function(){
            var category = $(this).data('category');
            $('.'+category).prop("checked" , this.checked);
          });
        });
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