<?php 
foreach($invoice_items as $key =>$row)
        {
            $item_id[$key]          = $row->credict_item_id;
            $item[$key]             =   $row->item_description;
            $itemarabic[$key]           =   $row->item_description_arabic;
            $qty[$key]          =   $row->qty;
            $unit_price[$key]   =   $row->unit_price;
            $unit[$key] = $row->uniteng;
            $total_amont[$key] =  $qty[$key] *  $unit_price[$key] ;
           
            $trow++;        
        }   
        $is=1;
        $j=1;
        for($i=0; $i < $trow; $i++)
						{
                            if($unit_price[$i]!=0){
                                    ?>
                                 <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
                                
                                    <div class="col-md-4">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                          
                                                  <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control " onkeyup="CheckClientSelect();"  rows="2" style="min-height: 1px;" readonly><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>" readonly>
                                            </div>                                      
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group <?PHP if(form_error('itemarabic['.$i.']')){ echo 'has-error';} ?>">
                                        
                                                  <textarea id="itemarabic'.$i.'" name="itemarabic[]" autocomplete="off" class="form-control " rows="2" style="min-height: 1px;text-align:right;" readonly><?php echo $itemarabic[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('itemarabic['.$i.']'); ?></label>
                                        </div>                   
                                                                           
                                    </div>
                                 <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('unit[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="unit[]" autocomplete="off" class="form-control unit" id="unit<?php echo $i;?>" type="text" value="<?php echo $unit[$i]; ?>"    placeholder=" Unit"  readonly  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('unit[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('qty[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="qty[]" autocomplete="off" class="form-control qty" id="qty<?php echo $i;?>" type="text" value="<?php echo $qty[$i]; ?>"    placeholder=" Qty" onkeyup="calculateqty();" readonly  />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('qty[]'); ?></label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="unit_price[]"  class="form-control unit_price" id="unit_price<?php echo $i;?>" type="text" value="<?php echo $unit_price[$i]; ?>" placeholder="Unit Price" readonly /> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control total_amont" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
                                        </div>
                                    </div>
                            <div class="col-md-1"> 
                                       
                                        <span>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0);" onclick="getConfirmPart(<?php echo $i;?><?php echo ($item_id[$i]!='') ? ','.$item_id[$i] : '';?>)" class="btn btn-danger btn-xs" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </span> 
                                    </div>
                             
                                </div>
                                <?php 
                                $j++;
                                $is++; 
                                } }
                                ?>