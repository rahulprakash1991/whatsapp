<div class="row allrowvalues" id="rowssids_<?php echo $i;?>">
  <div class="col-md-3">
    <div class="form-group">
     <textarea  autocomplete="off" name="address[]" class="form-control address" rows="4" id="address<?php echo $i;?>"><?php echo $address[$i];?></textarea>
    </div>
  </div>
  <div class="col-md-1">
    <div class="form-group">
      <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?>)" class="btn btn-danger btn-xs" onclick="calculate()" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
    </div>
  </div> 
</div>

                   