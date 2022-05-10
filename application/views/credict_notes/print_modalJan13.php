
  <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
<div class="modal-content" id="tt" >
  <div class="modal-header">
    <h3 class="modal-title" id="exampleModalCenterTitle"><b><?php echo"Print Credit Note";?></b></h3>
    <button type="button" class="close" data-dismiss="modal"  id="btn" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form ng-app="form-example" method="post" id="ajaxModelForm" enctype="multipart/form-data" action="javascript:" ui-jp="parsley">
    <div class="modal-body">
      <span id="modalMessage"></span>
    </div>
    <div class="row">
     
       <div class="col-sm-12 col-xs-12" align="center">
      <input type="hidden" name="submit" value="1">
      <input type="hidden" name="rep_id" id="rep_id" value="">
      <a href="Credict_notes/printCredict_notes/<?php echo $id;?>" target="_blank" title="Print" class="btn btn-primary"> Print Without Header</a>
      <a href="Credict_notes/printCredict_notes1/<?php echo $id;?>" target="_blank" title="Print" class="btn btn-info">Print With Header</a>
    <!--   <button type="submit" class="btn btn-primary"><?php echo "Add/Update";?></button>&nbsp;&nbsp; -->
      <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn1"><?php echo "Close Window";?></button>
      
    </div>
    
  </div>
  <br>

  <?php echo form_close(); ?>
</div>

<script type="text/javascript">
 $("#btn").click(function(){
            $("#tt").hide();
        });
  $("#btn1").click(function(){
            $("#tt").hide();
        });

</script>
