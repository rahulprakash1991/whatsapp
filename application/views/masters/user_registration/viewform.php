<?php
$actionIdArr = array();
if(isset($value) && !empty($value))
{
  foreach($value->result() as $row)
  {
    $user_id      = $row->user_id;
    $username     = $row->username;
    $email        = $row->email;
    $passwd       = $row->passwd;
    $auth_level   = $row->auth_level;
    $current_role = $row->auth_level;
    $old_string =$row->psname;
    $id      = $row->user_id;
    $lock  = $row->banned;
  }

  foreach($aclActions as $row)
  {
    $actionIdArr[]=   $row->action_id;
  }
  $aclRecords     = count($actionIdArr);
}
else
{
    $user_id      = $this->input->post('user_id');
    $username     = $this->input->post('username');
    $email        = $this->input->post('email');
    $passwd       = $this->input->post('passwd');
    $auth_level   = $this->input->post('auth_level');
    $aclRecords   = $this->input->post('aclRecords');
    $current_role = $this->input->post('current_role');
}

// All ACL actions list
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
                                <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('username')){ echo 'has-error';} ?>">
                                        <label>User Name <span1>*</span1></label>
                                         <input type="text" class="form-control"  placeholder="Please Enter Your Name" id="username" name="username" value="<?php echo $username; ?>" <?php echo ($user_id) ? 'readonly' : '';?>>
                                         <label class="error"><?php echo form_error('username'); ?></label>
                                    </div>
                                </div>
                                <span style="visibility: <?php echo ($acl) ? 'hidden' : 'visible'; ?>">
                                <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('email')){ echo 'has-error';} ?>">
                                        <label>Email <span1>*</span1></label>
                                         <input type="text" class="form-control error"  placeholder="Please Enter Your Email" id="email" name="email" value="<?php echo $email; ?>">
                                         <label class="error"><?php echo form_error('email'); ?></label>
                                    </div>
                                </div> 
                               <!--  <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('passwd')){ echo 'has-error';} ?>">
                                        <label>Password <span1>*</span1></label>
                                         <input type="password" class="form-control error"  placeholder="Please Enter Your Password" id="passwd" name="passwd" value="">
                                         <label class="error"><?php echo form_error('passwd'); ?></label>
                                    </div>
                                </div>  --> 
                                <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('auth_level')){ echo 'has-error';} ?>">
                                        <label>User Role<span1>*</span1></label>
                                          <select name="auth_level" id="auth_level" class="form-control">
                                          <?php foreach ($drop_menu_role as $key_id => $key_name) 
                                          {?>
                                            <option value="<?php echo $key_id;?>" <?php if($key_id == $auth_level){?> selected <?php }?>><?php echo $key_name;?></option>
                                          <?php 
                                          }?>
                                          </select>
                                          <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('auth_level'); ?></label>
                                    </div>
                                </div>
                             <!--    <?php if(($log_user_role=='10' && !empty($id)) ||($log_user_role=='9' && !empty($id))  ){?>
                                       <div class="col-md-1" style="margin-top: 23px;">
                                    <div class="form-group <?PHP if(form_error('auth_level')){ echo 'has-error';} ?>">
                                        <button type="submit" name="Submit1" class="btn btn-primary"><?php echo 'Reset Password'?> </button>
                                    </div>
                                </div>
                                  <div class="col-md-2">
                                    <div class="form-group <?PHP if(form_error('lock')){ echo 'has-error';} ?>">
                                        <label>Lock User</label>
                                          <select name="lock" id="lock" class="form-control" onchange="LockUser();">
                                          <option value="" ><?php echo '------Select------' ;?></option>
                                              <option value="0" <?php if($lock == '0'){?> selected <?php }?>><?php echo 'NO' ;?></option>
                                            <option value="1" <?php if($lock == '1'){?> selected <?php }?>><?php echo 'Yes' ;?></option>
                                        
                                         
                                          </select>
                                          <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('lock'); ?></label>
                                    </div>
                                </div>
                              <?php }?> -->
                                </span>
                            </div>
                            <?php
                            if($acl):?>
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
                          <?php endif;?>
                            <div class="text-center">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
                                <input type="hidden" name="aclRecords" value="<?php echo $aclRecords;?>">
                                <input type="hidden" name="current_role" value="<?php echo $current_role;?>">
                                <input type="hidden" id="passwd" name="passwd" value="<?php echo $auto_pass;?>">
                                <input type="hidden" id="psname" name="psname" value="<?php echo $auto_pass;?>">
                                <input type="hidden" id="old_pass" name="old_pass" value="<?php echo $passwd;?>">
                                <input type="hidden" id="old_string" name="old_string" value="<?php echo $old_string;?>">
                                <input type="hidden" name="log_user_role" id="log_user_role" value="<?php echo $log_user_role;?>" />
                                 <input type="hidden" name="alert_url" id="alert_url" value="<?php echo $alerturl;?>" />



                                <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($user_id!='' ? 'Update user' : 'Create user'); ?> </button>
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
                  'data'    : {pro_id:$('#log_user_role').val()},
                  'success' : fnCallback
                  });
                }
            } );

            $(".checkedAll").click(function(){
              var category = $(this).data('category');
              $('.'+category).prop("checked" , this.checked);
            });            
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
<script type="text/javascript">
  function LockUser(id,banned)
  {
    var url = $('#alert_url').val();

   var  user_id = id;
   // var  data = $('#lock').val();
   if(banned ==1)
   {
    var data =0;
   }
   else
   {
    var data =1;
   }
   if(data=='1')
   {
    conformboxLockuser(user_id,data);
    // alert('You want lock this user.....');
   }
   else
   {
    conformboxLockuser1(user_id,data);
    // alert('You want Unlock this user.....');
   }

    
              // $.ajax({
              //   type: "GET",
              //   url: "<?php echo site_url('masters/User_registration/BannedUser'); ?>", 
              //   data: {user_id:user_id,data:data},
              //   dataType:"html",
              //   success: function(html)
              //   {
              //        location.reload();
              //   },
              // });
  }
  function ResetPassword(id)
  {
      var  data = $('#passwd').val();
     
    $.ajax({
                type: "GET",
                url: "<?php echo site_url('masters/User_registration/AdminResetPassword'); ?>", 
                data: {user_id:id,data:data},
                dataType:"html",
                success: function(html)
                {
                   alert(html);
                     location.reload();
                },
              });
    
  }
  function conformboxLockuser(user_id,data)
        {
            if(arguments[0] != null)
            {
              if(window.confirm('Are you sure you want to Lock this User???'))
              {
                $.ajax({
                type: "GET",
                url: "<?php echo site_url('masters/User_registration/BannedUser'); ?>", 
                data: {user_id:user_id,data:data},
                dataType:"html",
                success: function(html)
                {
                     location.reload();
                },
              });
              }
              else
              {
                location.reload();
                event.cancelBubble = true;
                event.returnValue = false;
                return false;
              }
            }
            else
            {
             
              return false;
            }
            return;
        }
  function conformboxLockuser1(user_id,data)
        {
            if(arguments[0] != null)
            {
              if(window.confirm('Are you sure you want to unlock this User???'))
              {
                $.ajax({
                type: "GET",
                url: "<?php echo site_url('masters/User_registration/BannedUser'); ?>", 
                data: {user_id:user_id,data:data},
                dataType:"html",
                success: function(html)
                {
                     location.reload();
                },
              });
              }
              else
              {
                location.reload();
                event.cancelBubble = true;
                event.returnValue = false;
                return false;
              }
            }
            else
            {
              return false;
            }
            return;
        }
 
</script>
  
  
 