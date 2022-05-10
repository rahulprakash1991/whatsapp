<?php 
foreach($values->result() as $row)
  {
      $id = $row->id;
      $category_id = $row->client_id;
      $title = $row->title_id;
      $rep_name                = $row->rep_name;
      $email = $row->email;
      $contact_num = $row->mobile;
      $contact_num1 = $row->mobile1;
      $designation = $row->designation;
    

  }?>
  <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
<div class="modal-content" id="tt">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo"Add Client Representative";?></h5>
    <button type="button" class="close" data-dismiss="modal"  id="btn" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
    <div class="modal-body">
      <span id="modalMessage"></span>
      
        <div class="row">
          <div class="col-sm-4 col-xs-4">
            <div class="form-group <?PHP if(form_error('client_name')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Client Name";?><span class="text-danger">*</span></label>
               <select name="client_name" id="client_name" class="form-control" >
                    <?php foreach ($drop_menu_client as $key_id => $key_name) 
                     {?>
                        <option value="<?php echo $key_id;?>" <?php if($key_id == $category_id){?> selected <?php }?>><?php echo $key_name;?></option>

                        <?php 
                        }?>
                    </select>
              <?PHP if(form_error('client_name')){ echo '<span class="help-block">'.form_error('client_name').'</span>';} ?>
            </div>
          </div>  
            <div class="col-sm-4 col-xs-4">
            <div class="form-group <?PHP if(form_error('title')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Title ";?><span class="text-danger">*</span></label>
               <select name="title" id="title" class="form-control" >
                    <?php foreach ($drop_menu_title as $key_id => $key_name) 
                     {?>
                        <option value="<?php echo $key_id;?>" <?php if($key_id == $title){?> selected <?php }?>><?php echo $key_name;?></option>

                        <?php 
                        }?>
                    </select>
              <?PHP if(form_error('title')){ echo '<span class="help-block">'.form_error('title').'</span>';} ?>
            </div>
          </div>      
        <div class="col-sm-4 col-xs-4">
            <div class="form-group <?PHP if(form_error('rep_name')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Representative Name ";?><span class="text-danger">*</span></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Representative Name";?>" id="rep_name" name="rep_name" value="<?php echo $rep_name ;?>" autocomplete="off"  >
              <?PHP if(form_error('rep_name')){ echo '<span class="help-block">'.form_error('rep_name').'</span>';} ?>
            </div>
          </div>   
        </div>
        <div class="row">
             <div class="col-sm-4 col-xs-4">
            <div class="form-group <?PHP if(form_error('email')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Email ";?><span class="text-danger">*</span></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Email";?>" id="email" name="email" value="<?php echo $email ;?>" autocomplete="off"  >
              <?PHP if(form_error('email')){ echo '<span class="help-block">'.form_error('email').'</span>';} ?>
            </div>
          </div> 
           <div class="col-sm-4 col-xs-4">
            <div class="form-group <?PHP if(form_error('contact_num')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Contact No  ";?><span class="text-danger">*</span></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Contact No ";?>" id="contact_num" name="contact_num" value="<?php echo $contact_num ;?>" autocomplete="off"  >
              <?PHP if(form_error('contact_num')){ echo '<span class="help-block">'.form_error('contact_num').'</span>';} ?>
            </div>
          </div>
           <div class="col-sm-4 col-xs-4">
            <div class="form-group <?PHP if(form_error('contact_num1')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Alternative No  ";?></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Alternative No ";?>" id="contact_num1" name="contact_num1" value="<?php echo $contact_num1 ;?>" autocomplete="off"  >
              <?PHP if(form_error('contact_num1')){ echo '<span class="help-block">'.form_error('contact_num1').'</span>';} ?>
            </div>
          </div>
        </div>
        <div class="row">
             <div class="col-sm-4 col-xs-4">
            <div class="form-group <?PHP if(form_error('designation')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Designation ";?><span class="text-danger">*</span></label>
            <!--    <input type="text" class="form-control" placeholder="<?php echo "Enter Designation";?>" id="designation" name="designation" value="<?php echo $designation ;?>" autocomplete="off"  > -->
               <select name="designation" id="designation" class="form-control" >
                    <?php foreach ($drop_menu_designation as $key_id => $key_name) 
                     {?>
                        <option value="<?php echo $key_id;?>" <?php if($key_id == $designation){?> selected <?php }?>><?php echo $key_name;?></option>

                        <?php 
                        }?>
                    </select>
              <?PHP if(form_error('designation')){ echo '<span class="help-block">'.form_error('designation').'</span>';} ?>
            </div>
          </div>
      </div>

        <div class="clearfix"></div>
        <div class="divider" style="margin-top: 10px; margin-bottom: 20px;"></div>
   

    </div>
    <div class="modal-footer">
      <input type="hidden" name="rep_id" value="<?php echo $id;?>">
      <input type="hidden" name="selectedGroupsID" value="<?php echo $selectedGroupsID;?>">
      <input type="hidden" name="count" id="count"  value="<?php echo $userID;?>">
      <input type="hidden" name="submit" value="1">

      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn1"><?php echo "Close Window";?></button>
      <button type="submit" class="btn btn-primary"><?php echo "Save";?></button>
    </div>
  <?php echo form_close(); ?>
</div>

<script type="text/javascript">
 $("#btn").click(function(){
            $("#tt").hide();
        });
  $("#btn1").click(function(){
            $("#tt").hide();
        });
jQuery(document).ready(function() 
      {
        //$('.modal .select2').select2('disable');

        // When the form is submitted
        $("#ajaxModelForm").submit(function()
        { 

          
          // 'this' refers to the current submitted form 
          var str = $(this).serialize();

          $.ajax({
          type: "POST",
          url: "<?php echo site_url('masters/Enquiry/addClientRep'); ?>",
          data: {postdata: str},
          dataType:"html",
            success: function(html1)
            {
            try
              {
                var data = JSON.parse(html1);
             
                if(data.result == "Success")
                {
                  var htmlText = '<div class="alert alert-'+data.res_type+'" successmessage">'+data.res+'</div>';
                  $('#modalMessage').html(htmlText);
                   $('#client_rep').html(data.datatablevalueForm);

                         setTimeout(function(){
                window.location.reload(1);
              }, 150);
                }
                if(data.result == "Success1")
                {
                  var htmlText = '<div class="alert alert-'+data.res_type+'" successmessage">'+data.res+'</div>';
                  $('#modalMessage').html(htmlText);
                   $('#client_rep').html(data.datatablevalueForm);
                  setTimeout(function(){
                window.location.reload(1);
              }, 150);


                }
               
              }
              catch(e)
              {
                //alert(e);
                $('#attributeVIDetailsModal').html(html1);
              }
            },
          });
          
        }); // end submit event        
    });
</script>

