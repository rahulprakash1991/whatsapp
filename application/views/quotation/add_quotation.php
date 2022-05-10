<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $qus_id = $row->qus_id;
       $subject = $row->subject;
       $gen_details = $row->general_terms;
       $grand_total = $row->grand_total;
       $com_terms =$row->commer_terms;
        $notes =$row->note;
        $bank_details= $row->bank_details;
            
    }
}
if(isset($evalue) && !empty($evalue))
{
foreach($evalue as $key =>$row)
    {   
        $item_id[$key]        =   $row->qus_pro_id;        
        $item[$key]      =   $row->item_name;
        $quantity[$key]  =   $row->quantity;
        $price_amt[$key]    =   $row->price;
        $sub_total[$key]        =   $row->sub_total;
        $discount[$key]             =   $row->discount;
        $total_amont[$key]         =   $row->total_amount;
       
        
        $trow++;
    }
}
else
{
        $category_id            =   $this->input->post('category_id');
        $pro_group_id           =   $this->input->post('pro_group_id');
        $pro_item_name          =   $this->input->post('pro_item_name');   
        $pro_item_code          =   $this->input->post('pro_item_code');   
        $pieces_per_unit        =   $this->input->post('pieces_per_unit'); 
        $unit_id                =   $this->input->post('unit_id');
        $pro_item_sell_price    =   $this->input->post('pro_item_sell_price');
        $pro_item_cost_price    =   $this->input->post('pro_item_cost_price');
        $tax_id                 =   $this->input->post('tax_id');
        $pro_item_stock         =   $this->input->post('pro_item_stock');
        $con_id                 =   $this->input->post('con_id');
        $pro_item_level         =   $this->input->post('pro_item_level');
        $pro_item_status        =   $this->input->post('pro_item_status');
}
$trow   = ($trow=='')   ? 1 : $trow;

?>
              <div class="page-inner">
                <div class="page-title">
                    <h3><strong><?PHP echo $form_toptittle; ?></strong></h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>"><strong>Home</strong></a></li>
                            <li class="active"><?PHP echo $form_toptittle; ?></li>
                              <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js">
                              </script>
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
                                    <div class="row" >
                                       <div class="col-md-12">
                                            <div class="form-group <?PHP if(form_error('subject')){ echo 'has-error';} ?>">

                                                <label>Subject<span1>*</span1></label>

                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Subject" id="subject" name="subject" value="<?php echo $subject; ?>">
                                                  
                                                
                                                <label class="error"><?php echo form_error('subject'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group <?PHP if(form_error('general_terms')){ echo 'has-error';} ?>">
                                                <label>General Details </label>

                                           <textarea id="console" name="general_terms" autocomplete="off" class="form-control summernote" rows="1" style="min-height: 1px;" ><?php echo $gen_details;?></textarea>
                                                
                                                <label class="error"><?php echo form_error('general_terms'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12">
                                           
                                                <label>Commerical Details </label>

                                         
                                        </div>
                                    </div>
<br>
                                  
                                    <div class="row">
                                <div class="col-md-6">
                                    <label><strong>Discription</strong></label>
                                </div>
                                <!--<div class="col-md-1">
                                    <center><label><strong>Unit</strong></label></center>
                                </div>-->
                              
                                <div class="col-md-1">
                                    <center><label><strong>Qty </strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Unit Price</strong></label></center>
                                </div>
                                <div class="col-md-1">
                                    <center><label><strong>Sub Total(SAR)</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Discount %</strong></label></center>
                                </div>
                                <div class="col-md-1" >
                                    <center><label><strong>Total Amount(SAR)</strong></label></center>
                                </div>                                      
                            </div>
                                    
                                    <div class="row">                 
                                <span id="partProductData">
                                <?php 
                               
                                $is=1;
                                for($i=0; $i < $trow; $i++)
                                {
                                    
                                    ?>
                                <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>"  style="margin-left: 10px;">
                                    <div class="col-md-6">
                                        <div class="form-group <?PHP if(form_error('item['.$i.']')){ echo 'has-error';} ?>">
                                           
                                               <!--  <input name="item[]"  class="form-control cost_amount" id="item'.$i.'" type="text" value="<?php echo $item[$i]; ?>"  placeholder="Discription"/>  -->

                                                  <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control " rows="3" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('item['.$i.']'); ?></label>
                                        </div>                   
                                        <div class="form-group">
                                            <input type="hidden" name="item_id[]" value="<?php echo $item_id[$i];?>" id="item_id<?php echo$i?>">
                                            </div>                                      
                                    </div>


                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('quantity['.$i.']')){ echo 'has-error';} ?>">
                                            <input name="quantity[]" autocomplete="off" class="form-control quantity" id="quantity<?php echo $i;?>" type="text" value="<?php echo $quantity[$i]; ?>" on placeholder="Qty"/>
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('quantity['.$i.']'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                      
                                            <input type="text" name="price_amt[]"  autocomplete="off" class="form-control price_amt" id="price_amt<?php echo $i;?>" value="<?php echo $price_amt[$i];?>" onkeyup="calculate();" placeholder="Price">
                                        </div>
                                    </div>      

                                    <div class="col-md-1">
                                        <div class="form-group <?PHP if(form_error('sub_total[]')){ echo 'has-error';} ?>">
                                           
                                            <input name="sub_total[]" autocomplete="off" class="form-control sub_total" id="sub_total<?php echo $i;?>" type="text" value="<?php echo $sub_total[$i]; ?>"  placeholder=" SubTotal "readonly />
                                            <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('sub_total[]'); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="discount[]"  class="form-control discount" onkeyup="calculate();" id="discount<?php echo $i;?>" type="text" value="<?php echo $discount[$i]; ?>"placeholder="Discount"  /> 
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="total_amont[]"  class="form-control cost_amount" id="total_amont<?php echo $i;?>" type="text" value="<?php echo $total_amont[$i]; ?>" readonly  placeholder="Total "/> 

                                             
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
                                $is++; 
                                } 
                                ?>
                                </span>                                              
                        </div>
                            <div class="row">
                            <div class="col-md-10" style="text-align: right;">
                              <b> Grand Total</b>
                            </div>
                            <div class="col-md-1" style="text-align: center;">
                               <input name="grand_total"  class="form-control cost_amount" id="grand_total" type="text" value="<?php echo $grand_total; ?>" readonly  placeholder="0.00 "/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                </div>
                                <div class="col-md-2 text-right">
                                    <a onclick="addNewPart()" class="label label-danger"> Add New </a>    
                                    <input type="hidden" name="attproduct" id="attproduct" value="<?PHP echo $is-1?>" />
                                </div>
                            </div>
                        </div>  
                        <br><br>
                             <div class="row">
                                       <div class="col-md-12">
                                           
                                                <label>Commerical Terms </label>

                                         
                                        </div>
                                    </div>
                                        <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group <?PHP if(form_error('com_terms')){ echo 'has-error';} ?>">
                                               

                                           <textarea id="com_terms" name="com_terms" autocomplete="off" class="form-control summernote" rows="1" style="min-height: 1px;" ><?php echo $com_terms;?></textarea>
                                                
                                                <label class="error"><?php echo form_error('com_terms'); ?></label>
                                            </div>
                                        </div>
                                    </div>                           
                                    <br><br>
                             <div class="row">
                                       <div class="col-md-6">
                                           
                                                <label>Note </label>

                                         
                                        </div>
                                         <div class="col-md-6">
                                           
                                                <label>Bank Details </label>

                                         
                                        </div>
                                    </div>
                                        <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('notes')){ echo 'has-error';} ?>">
                                               

                                           <textarea id="notes" name="notes" autocomplete="off" class="form-control summernote" rows="1" style="min-height: 1px;" ><?php echo $notes;?></textarea>
                                                
                                                <label class="error"><?php echo form_error('notes'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group <?PHP if(form_error('bank_details')){ echo 'has-error';} ?>">
                                               

                                           <textarea id="bank_details" name="bank_details" autocomplete="off" class="form-control summernote" rows="1" style="min-height: 1px;" ><?php echo $bank_details;?></textarea>
                                                
                                                <label class="error"><?php echo form_error('bank_details'); ?></label>
                                            </div>
                                        </div>
                                    </div> 
                                     <br><br>
                            
                                     


                                    <div class="text-center">                                            
                                        <input type="hidden" name="enquiry_id" value="<?php echo $enquirey_id;?>" />
                                        <input type="hidden" name="qus_id" value="<?php echo $qus_id;?>" />
                                        <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($qus_id!='' ? 'Update Quote' : 'Create Quote'); ?> </button>
                                           <!--  <a href="<?php echo base_url().'masters/Enquiry'?>" class="btn btn-primary">Cancel</a>  -->
                                             <a href="<?php echo base_url().'masters/Enquiry/view_enquiry/'.$enquirey_id.'';?>" style="text-align: right;" class="btn btn-primary">Cancel</a>
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
                </div>
            </div>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">                       
                <div class="modal-content" id="viewajaxcontent">   
                </div>
            </div>
        </div>  
        <script type="text/javascript">
          function addrepModal()
          {
     
    
           
            $.ajax({
              type: "GET",
              url: "<?php echo site_url('masters/Enquiry/addClientRep'); ?>",
              dataType:"html",
              success: function(response)
              {
                ;
                jQuery('#viewajaxcontent').html(response);
                jQuery('.bs-example-modal-lg').modal('show', {});
                          
              },
            });
           
          }

            function getConfirmPart(inv,prid)
            {
      
                var x;
                var r=confirm("You Want Delete!!");
                if(prid!='' && r==true)
                {
                  $.ajax({"url":"<?php echo site_url('Quotation/deleteproduct'); ?>",
                  "type":"GET",
                  data:{
                      "prid":prid
                  },

                  success:function(data)
                    {
                      //alert("Daelted Successfully");
                      $('#rowssids_'+inv+'').remove();
                      $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
                      
                    }
                  
                  });
               
                }
                else if (prid=='' && r==true)
                {

                  $('#rowssids_'+inv+'').remove();
                  $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
                
                }
            }
            function addNewPart()
            {
                row = $('#attproduct').val();

                $.ajax({
                    type: "GET",
                    url: "<?php echo site_url('Quotation/getPartNoContent');?>", 
                    data: {i:row},
                    dataType:"html",
                    success: function(html)
                    {

                        $('#partProductData').append(html);
                        $('#pro_item_id'+row).select2();
                        
                        row = Number($('#attproduct').val()) + 1;   
                        $('#attproduct').val( row );                
                    },
                });
            }
            // function calculate(i)
            // {
              
            //     qty =  $('#quantity'+i+'').val();
            //     price =  $('#price_amt'+i+'').val();
            //     sub = (Number(qty))*(Number(price));
            //     grand_total = $('#grand_total').val();
            //     grand_total_amount = Number(grand_total)+Number(sub);
            //     $('#sub_total'+i+'').val(sub);
            //     $('#total_amont'+i+'').val(sub);
               

               
            // }
            //  function calculate1(i)
            // {
             
            //     dis =  $('#discount'+i+'').val();

            //     sub =  $('#sub_total'+i+'').val();
            //     disam = (Number(sub))/100;
            //     discount_amount = Number(disam*dis);
            //     grand_total = $('#grand_total').val();
        

            //     amount = Number(sub-discount_amount);
            //     grand_total_amount = Number(grand_total)+Number(amount);
            //      $('#total_amont'+i+'').val(amount);
            //      $('#grand_total').val(grand_total_amount);
            // }

            function calculate()
            {   
                    
                var grandtotal      = 0;
            
                

                $('.allrowvalues').each(function(i,o) 
                {
                    var qty                 =   $(o).find('.quantity',this).val();                          
                    var price               =   $(o).find('.price_amt',this).val();
                    var  dis                =   $(o).find('.discount',this).val();
                    var sub                 = $(o).find('.sub_total',this).val();
                    
                    if(dis!==''){

                     discount_amount = Number(sub)-(Number(sub)*(dis/100))


                     total = Number(discount_amount);
                     var subtotal               =  (Number(qty *1) * Number(price *1));
                    subtotal                   = parseFloat(subtotal).toFixed(2);
                    }
                    else
                    {
                    var total               =  (Number(qty *1) * Number(price *1));
                    total                   = parseFloat(total).toFixed(2);
                    var subtotal                =  (Number(qty *1) * Number(price *1));
                    subtotal                   = parseFloat(subtotal).toFixed(2);
                    }

                
                    $(o).find('.cost_amount',this).val(total);
                    $(o).find('.sub_total',this).val(subtotal);
                    
                    grandtotal+=Number(total);
                    

                    
                });
                grandtotal=parseFloat(grandtotal).toFixed(2);
                $('#grand_total').val(grandtotal);
                
            }


        </script>