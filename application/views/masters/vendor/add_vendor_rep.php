
  <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
<div class="modal-content" id="tt">
  <div class="modal-header">
    <h3 class="modal-title" id="exampleModalCenterTitle"><b><?php echo"Add Vendor Representative";?></b></h3>
    <button type="button" class="close" data-dismiss="modal"  id="btn" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
    <div class="modal-body">
      <span id="modalMessage"></span>
      
        <div class="row">
          <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('client_name')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Vendor Name";?><span class="text-danger">*</span></label>
               <select name="client_name" id="client_name" class="form-control" >
                    <?php foreach ($drop_menu_client as $key_id => $key_name) 
                     {?>
                        <option value="<?php echo $key_id;?>"><?php echo $key_name;?></option>

                        <?php 
                        }?>
                    </select>
              <?PHP if(form_error('client_name')){ echo '<span class="help-block">'.form_error('client_name').'</span>';} ?>
            </div>
          </div>  
            <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('title')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Title ";?><span class="text-danger">*</span></label>
               <select name="title" id="title" class="form-control" >
                    <?php foreach ($drop_menu_title as $key_id => $key_name) 
                     {?>
                        <option value="<?php echo $key_id;?>" ><?php echo $key_name;?></option>

                        <?php 
                        }?>
                    </select>
              <?PHP if(form_error('title')){ echo '<span class="help-block">'.form_error('title').'</span>';} ?>
            </div>
          </div>      
        <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('rep_name')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Representative Name ";?><span class="text-danger">*</span></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Representative Name";?>" id="rep_name" name="rep_name" value="" autocomplete="off"  >
              <?PHP if(form_error('rep_name')){ echo '<span class="help-block">'.form_error('rep_name').'</span>';} ?>
            </div>
          </div>  
               <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('email')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Email ";?><span class="text-danger">*</span></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Email";?>" id="email" name="email" value="" autocomplete="off"  >
              <?PHP if(form_error('email')){ echo '<span class="help-block">'.form_error('email').'</span>';} ?>
            </div>
          </div>  
        </div>
        <div class="row">
        
           <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('contact_num')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Contact No  ";?><span class="text-danger">*</span></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Contact No ";?>" id="contact_num" name="contact_num" value="" autocomplete="off"  >
              <?PHP if(form_error('contact_num')){ echo '<span class="help-block">'.form_error('contact_num').'</span>';} ?>
            </div>
          </div>
           <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('contact_num1')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Alternative No  ";?></label>
               <input type="text" class="form-control" placeholder="<?php echo "Enter Alternative No ";?>" id="contact_num1" name="contact_num1" value="" autocomplete="off"  >
              <?PHP if(form_error('contact_num1')){ echo '<span class="help-block">'.form_error('contact_num1').'</span>';} ?>
            </div>
          </div>
           <div class="col-sm-3 col-xs-3">
            <div class="form-group <?PHP if(form_error('designation')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1"><?php echo "Designation ";?><span class="text-danger">*</span></label>
               <!-- <input type="text" class="form-control" placeholder="<?php echo "Enter Designation";?>" id="designation" name="designation" value="" autocomplete="off"  > -->
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
       
 

        <!-- <div class="clearfix"></div>
        <div class="divider" style="margin-top: 10px; margin-bottom: 20px;"></div> -->
   

    </div>
    <div class="row">
       <div class="col-sm-4 col-xs-4">
       </div>
       <div class="col-sm-4 col-xs-4" align="center">
      <input type="hidden" name="submit" value="1">
      <input type="hidden" name="rep_id" id="rep_id" value="">
      <button type="submit" class="btn btn-primary"><?php echo "Add/Update";?></button>&nbsp;&nbsp;
      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn1"><?php echo "Close Window";?></button>
      
    </div>
     <div class="col-sm-4 col-xs-4">
     </div>
  </div>
  <br>
<?php
if(isset($values) && !empty($values))
{?>
  <div class="row">
    <div class="col-sm-4 col-xs-4">
      </div>
    <div class="col-sm-4 col-xs-4">
      <p style="text-align: center;"><B>Representative Details</B></p>
    </div>
    <div class="col-sm-4 col-xs-4">
    </div>
  </div>
  <div class="row">
     <div class="col-sm-1 col-xs-1">
     </div>
    <div class="col-sm-10 col-xs-10">
     <table style="width: 100%" rules="all" border="1">
      <th style="text-align: center;background-color: gray;"><b>Name</b></th>
      <th style="text-align: center;background-color: gray;"><b>Email</b></th>
      <th style="text-align: center;background-color: gray;"><b>Contact No</b></th>
      <th style="text-align: center;background-color: gray;"><b>Designation</b></th>
      <th style="text-align: center;width: 5%;background-color: gray;"><b>Edit</b></th>
      <?php 
      foreach($values->result() as $row)
  {?>
      <tr>
        <?php $rep_id = $row->id;?>
        <td>&nbsp;<?php echo $row->rep_name ;?></td>
        <td>&nbsp;<?php echo strtolower($row->email);?></td>
        <td>&nbsp;<?php echo $row->mobile ;?></td>
        <td>&nbsp;<?php echo $row->desgination_name ;?></td>
        <td style="text-align: center;">&nbsp;<!-- <button type="button" class="btn btn-primary" style="height: 1%;" onclick="EditClient('<?php echo $rep_id;?>');" id="btn1"><?php echo "Edit";?></button> -->

          <a href="javascript:void(0);" onclick="EditClient('<?php echo $rep_id;?>');" title="Edit"><i style="color:green;" class="glyphicon glyphicon-pencil"></i></a>
          &nbsp;&nbsp;  <a href="javascript:void(0);" onclick="DeleteClientRep('<?php echo $rep_id;?>');" title="Delete"><i style="color:red;" class="glyphicon glyphicon-trash"></i></a>
        </td>

      </tr>
<?php }?>
     </table>
    </div>
    <div class="col-sm-1 col-xs-1">
     </div>
  </div>
  <br><br>  
<?php }?>
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
          url: "<?php echo site_url('masters/Vendor/addVendorRep'); ?>",
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
                     var id = $('#client_name').val();
              $.ajax({
              type: "GET",
              url: "<?php echo site_url('masters/Vendor/addVendorRep'); ?>",
              data: {vendor_id:id},
              dataType:"html",
              success: function(response)
              {
                
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },});

                }
                if(data.result == "Success1")
                {
                  var htmlText = '<div class="alert alert-'+data.res_type+'" successmessage">'+data.res+'</div>';
                  $('#modalMessage').html(htmlText);
                  $('#client_rep').html(data.datatablevalueForm);
                 
                  var id = $('#client_name').val();
                $.ajax({
              type: "GET",
              url: "<?php echo site_url('masters/Vendor/addVendorRep'); ?>",
              data: {vendor_id:id},
              dataType:"html",
              success: function(response)
              {
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });


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
function EditClient(id)
{
  
     $.ajax({
        type: "GET",
        url: "<?php echo site_url('masters/Vendor/getRepDetailsDataModal'); ?>", 
        data: {rep_id:id},
        dataType:"html",
       
        success: function(html1){
          var res = $.parseJSON(html1);
         
          //getSatipEnggNoDropDown(res.engg_no_name, res.satip_engg_no, res.satip_id);

          $('#rep_name').val(res.rep_name);
          $('#email').val(res.email);
          $('#contact_num').val(res.mobile);
          $('#designation').val(res.designation);
           $('#contact_num1').val(res.mobile1);
           $('#title').val(res.title_id);
           $('#rep_id').val(res.id);
        
  
        },
   
      });
}

function DeleteClientRep(id)
{


     $.ajax({
        type: "GET",
        url: "<?php echo site_url('masters/Vendor/DeleteVendorRep'); ?>", 
        data: {rep_id:id},
        dataType:"html",
       
        success: function(html1){
          alert('Are you sure you want to delete???');
       
              var id1 = $('#client_name').val();
              $.ajax({
              type: "GET",
              url: "<?php echo site_url('masters/Vendor/addVendorRep'); ?>",
              data: {vendor_id:id1},
              dataType:"html",
              success: function(response)
              {
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },});
         
    
  
        },
   
      });
}
</script>

