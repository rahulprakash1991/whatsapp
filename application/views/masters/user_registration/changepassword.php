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
                                         <input type="text" class="form-control"  placeholder="Please Enter Your Name" id="username" name="username" value="<?php echo $u_name; ?>" <?php echo ($user_id1) ? 'readonly' : '';?>>
                                         <label class="error"><?php echo form_error('username'); ?></label>
                                    </div>
                                </div>
                               
                               
                                <div class="col-md-3">
                                  <!--   <div class="form-group <?PHP if(form_error('passwd')){ echo 'has-error';} ?>">
                                       <div class="input-group" id="show_hide_password">
                                        <label>New Password <span1>*</span1></label>
                                         <input type="password" class="form-control error"  placeholder="Please Enter New Password" id="passwd" name="passwd" value="">
                                        <div class="input-group-prepend" style="cursor: pointer;">
                                        <span class="input-group-text" id="eyehidden" onclick="showpassword()"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                         </div>
                                         <label class="error"><?php echo form_error('passwd'); ?></label>

                                    </div>
                                  </div>
                                  /// --> 
              <div class="form-group <?PHP if(form_error('passwd')){ echo 'has-error';} ?>">
                <label for="validationCustom01">New Password <span class="text-danger">*</span></label>

            
                <div class="input-group" id="show_hide_password">
           <input type="password" class="form-control error" onkeyup="validate1();"  placeholder="Please Enter New Password" id="passwd" name="passwd" value="">

          <div class="input-group-addon">
            <a href="javascript:void(0);" id="eyehidden" onclick="showpassword()"><i class="fa fa-eye" aria-hidden="true"></i></a>
          </div>
        </div>
                <?PHP if(form_error('passwd')){ echo form_error('passwd');} ?>
              </div>
    
                                <!--   // -->

                                </div>  

                                 <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('c_passwd')){ echo 'has-error';} ?>">
                                        <label>Conform Password <span1>*</span1></label>
                                       <div class="input-group" id="show_hide_password1">
                                      
                                         <input type="password" class="form-control error"  placeholder="Conform Password" id="c_passwd" name="c_passwd" value="">
                                         <div class="input-group-addon" >
                                      
                                         <a href="javascript:void(0);" id="eyehidden" onclick="showpassword1()"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                         </div>
                                         <label class="error"><?php echo form_error('c_passwd'); ?></label>
                                    </div>
                                </div> 
                               </div>
                                   <div class="col-md-3" >
                                    <input type="hidden" name="user_id" value="<?php echo $user_id1;?>" />
                         
                                <button style="margin-top: 22px;" type="submit" name="Submit" class="btn btn-primary"><?php echo ($user_id1!='' ? 'Update Password' : 'Create user'); ?> </button>
                                   </div>
                            </div>
                           
                              <div class="row">
                                <div class="col-md-3" >
                                </div>
                                <div class="col-md-3" >
                                  <p  id="notes" style="color: red"><b>Notes:</b></p>
                                  <p  id="num" style="color: red"> Password Minimum 8 Charactors</p>
                                  <p  id="lover" style="color: red">Password must be at least one lowercase letter</p>
                                  <p  id="upper" style="color: red"> password must be at least one uppercase letter</p>
                                  <p  id="number" style="color: red"> Password must have at least one number</p>
                                  <p  id="special" style="color: red"> Password must have at least one special character</p>
                                </div>
                                <div class="col-md-3" >
                                </div>
                                <div class="col-md-3" >
                                </div>
                              </div>

                      <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div><!-- Row -->

       

        </div>
      </div><!-- Main Wrapper -->

  
  
 <script type="text/javascript">
    function showpassword(){
      event.preventDefault();
      if($('#show_hide_password input').attr("type") == "text"){
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password #eyehidden').html('<i class="fa fa-eye" aria-hidden="true"></i>');
      }else if($('#show_hide_password input').attr("type") == "password"){
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password #eyehidden').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
      }
    }
    function showpassword1(){
      event.preventDefault();
      if($('#show_hide_password1 input').attr("type") == "text"){
        $('#show_hide_password1 input').attr('type', 'password');
        $('#show_hide_password1 #eyehidden').html('<i class="fa fa-eye" aria-hidden="true"></i>');
      }else if($('#show_hide_password1 input').attr("type") == "password"){
        $('#show_hide_password1 input').attr('type', 'text');
        $('#show_hide_password1 #eyehidden').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
      }
    }
    function validate1()
    {
              var val = $('#passwd').val();
              var len = val.length;
              
              var hasNumber = /\d/; 
              var regex_lowercase = /[a-z]/;
              var regex_uppercase = /[A-Z]/;
              var  regex_special = /[!@#$%^&*()\-_=+{};:,<.>ยง~]/;
              if(hasNumber.test(val)) 
              {
                 $('#number').css("color","green"); 
              }
              if( regex_lowercase.test(val)) 
              {
                 $('#lover').css("color","green"); 
              }
              if( regex_uppercase.test(val)) 
              {
                 $('#upper').css("color","green"); 
              }
              if( regex_special.test(val)) 
              {
                 $('#special').css("color","green"); 
              }
               if(len===8) 
              {
                 $('#num').css("color","green"); 
              }
              
              
              
              

    }
  </script>