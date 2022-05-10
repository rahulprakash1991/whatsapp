<?php
// Last Updated by  Vinitha 06/08/2016 
if(isset($value) && !empty($value))
{
  foreach($value->result() as $row)
  {  
    $batchNDT_attachement_id               =  $row->batchNDT_attachement_id;
    $batchNDT_attachement_type_name        =  $row->batchNDT_attachement_type_name;
    $batchNDT_attachement_file_name        =  $row->batchNDT_attachement_file_name;   
    $batchNDT_old_attachement_file_name    =  $row->batchNDT_attachement_file_name;   
  }
}
else
{
  $batchNDT_attachement_id                  =  $this->input->post('batchNDT_attachement_id');
  $batchNDT_attachement_type_name           =  $this->input->post('batchNDT_attachement_type_name');
  $batchNDT_attachement_file_name           =  $this->input->post('batchNDT_attachement_file_name');
  $batchNDT_old_attachement_file_name       =  $this->input->post('batchNDT_old_attachement_file_name');
}
$ci =&get_instance();

?>

<div class="modal-content">
  <div class="modal-header panel-heading clearfix">
    <h4 class="modal-title" id="myLargeModalLabel">Attchment</h4>
  </div>

    <div class="modal-body">
      <span id="modalMessage"></span>
      <!-- /.start form -->
        <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
      <div class="row">
        <div class="col-sm-4 col-xs-4">

          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <div class="form-group <?PHP if(form_error('attachement_type_name')){ echo 'has-error';} ?>">
                <label for="exampleInputEmail1">Type</label>
                <input type="text" class="form-control" placeholder="Type" id="attachement_type_name" name="attachement_type_name" value="<?php echo $attachement_type_name ;?>" autocomplete="off">
               <?PHP if(form_error('attachement_type_name')){ echo '<span class="help-block">'.form_error('attachement_type_name').'</span>';} ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <div class="form-group <?PHP if(form_error('attachement_file_name')){ echo 'has-error';} ?>">
              <label for="exampleInputEmail1">File (Max. 500 MB)</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                  <input type="file" id="attachement_file_name" name="attachement_file_name" >
                  </span> 
                </div>
                <?PHP if(form_error('attachement_file_name')){ echo '<span class="help-block">'.form_error('attachement_file_name').'</span>';} ?>
              </div>
            </div>
             
          </div>
        </div>
        <div class="col-sm-1 col-xs-1"></div>
        <div class="col-sm-7 col-xs-7">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
            <h5 class="box-title m-b-0"><b>Instructions:</b></h5>
            <p class="text-muted">1. Documents can be attached here to complete your report.</p>
            <p class="text-muted">2. Each document attached must not contain more than 500 MB in file size.</p>
            <p class="text-muted">3. Click Browse to select a file and click on UPLOAD to attach. Repeat this step again to add another file</p>
            <p class="text-muted">4. The list of files that have been successfully attached will be listed in the table below.</p>
          </div>
        </div>
      </div>
        
      </div>
      <hr />
      <div class="text-center">
        <input type="hidden" name="credict_id" value="<?php echo $id;?>" />
        <input type="hidden" name="submit" value="1">

        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="submit">Save</button>
        <button type="submit" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Close Window</button>
      </div>
      <hr />
      <!-- /.end form -->
      <?php echo form_close(); ?>
    </div>
  
  <div class="row">
        <div class="col-sm-12">
          <div class="white-box">
            <h3 class="box-title m-b-0">File Upload Details</h3>
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>File Name</th>
                  <th>Type</th>
                  <th>File Size (KB)</th>
                  <th>Updated By</th>
                  <th>Updated On</th>
                </tr>
              </thead>
              <tbody id="attachDatatablevalue">
                <?php 
                if(isset($datatablevalue) && !empty($datatablevalue)){
                  $iValue = 1;
                  foreach($datatablevalue as $row){ 
                    ?>
                      <tr>
                        <td><?php echo $iValue++;?></td>
                      
                        <td>
                        <a href="<?php echo config_item('image_url').$row['attachement_file_name'];?>" target="_blank" class="cursor" title="<?php echo $row['attachement_file_name'];?>" style="color:blue">
                       </a></td>
                        <td><?php echo $row['attachement_type_name'];?></td>
                        <td><?php echo $row['attachement_file_size'];?></td>
                        <td><?php echo $row['firstname'];?></td>
                        <td><?php echo get_date_timeformat($row['attachement_updateOn']);?></td>
                      </tr>
                    <?php 
                  }
                } else{
                  ?>
                  <tr>
                    <td colspan="6" style="text-align:center"><b>No Data Available...</b></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>


      

                            
<script type="text/javascript">

      jQuery(document).ready(function() 
      {

        $("form#ajaxModelForm").submit(function()
        {
          var formdata= new FormData($(this)[0]);
           // var str = $(this).serialize();

          $.ajax(
          {
            "url":"<?php echo site_url('Credict_notes/addAttachment'); ?>",
            "type":"POST",
            data:formdata,
            async:false,
          //    data: {postdata: str},
          // dataType:"html",
            success: function(html1) 
            {
             alert(html);
            try
              {
                var data = JSON.parse(html1);
                if(data.result == "Success")
                {
                  var htmlText = '<div class="alert alert-'+data.res_type+'" successmessage">'+data.res+'</div>';
                  $('#modalMessage').html(htmlText);


                }
                if(data.result == "Success1")
                {
                  var htmlText = '<div class="alert alert-'+data.res_type+'" successmessage">'+data.res+'</div>';
                  $('#modalMessage').html(htmlText);
                  setTimeout(function(){
                window.location.reload(1);
              }, 1500);


                }
               
              }
              catch(e)
              {
                //alert(e);
                $('#attributeVIDetailsModal').html(html1);
              }
            },
         
         
           
          });
    
        });
         });

</script>