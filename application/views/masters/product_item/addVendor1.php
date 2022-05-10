<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
        $id                      =   $row->id;
        $pro_item_id             =  $row->pro_id;
        $product_code            =   $row->pro_code;   
        $pro_item_name           =   $row->pro_name;
        $con_id                  =   $row->vender_id ;
        $pro_group_id            =   $row->manufacture_id;
        $pro_item_cost_price     =   $row->cost_price;
        $pro_item_sell_price     =   $row->selling_price;     
            
    }
}
else
{
        $product_code            =   $this->input->post('pro_item_code');
        $pro_item_name           =   $this->input->post('pro_item_name');
        $con_id                  =   $this->input->post('con_id');   
        $pro_group_id            =   $this->input->post('pro_group_id');   
        $pro_item_cost_price     =   $this->input->post('pro_item_cost_price'); 
        $pro_item_sell_price     =   $this->input->post('pro_item_sell_price');
        
}
$CI = &get_instance();
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
                                    <div class="row" ng-app>
                                   
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_code')){ echo 'has-error';} ?>">
                                                <label>Product Code<span1>*</span1></label>
                                                 
                                                  <input type="text" autocomplete="off" class="form-control" placeholder="Enter Product Code" id="pro_item_code" name="pro_item_code" value="<?php echo $product_code;?>"  onkeydown="return false;"
                style="caret-color: transparent !important;"                   
                required>
                      
                                              
                                                 <label class="error"><?php echo form_error('pro_item_code'); ?></label>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_name')){ echo 'has-error';} ?>">
                                                <label>Product Name<span1>*</span1></label>
                                               
                                                 
                                                  <input type="text" autocomplete="off"  class="form-control"  placeholder="Enter Product Name" id="pro_item_name" name="pro_item_name" value="<?php echo $pro_item_name; ?>" readonly>
                                                 
                                                 <label class="error"><?php echo form_error('pro_item_name'); ?></label>
                                            </div>
                                        </div>
                                          <div class="col-md-3">
                                              <div class="form-group <?PHP if(form_error('con_id')){ echo 'has-error';} ?>">
                                                <label>Vendor<span1>*</span1></label>
                                                    <select name="con_id" id="con_id" class="form-control" required>
                                                    <?php foreach ($drop_menu_vendor as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $con_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('con_id'); ?></label>
                                            </div>
                                        </div>

                                       <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_group_id')){ echo 'has-error';} ?>">
                                                <label>Manufacturer<span1>*</span1></label>

                                                    <select name="pro_group_id" id="pro_group_id" class="form-control" required>
                                                    <?php 
                                                    $drop_menu_product = $CI->Mdropdown->drop_menu_product($category_id);
                                                    foreach ($drop_menu_product as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $pro_group_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pro_group_id'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_cost_price')){ echo 'has-error';} ?>">
                                                <label>Cost Price<span1>*</span1></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Cost Price" id="pro_item_cost_price" name="pro_item_cost_price" value="<?php echo $pro_item_cost_price; ?>" required>
                                                 <label class="error"><?php echo form_error('pro_item_cost_price'); ?></label>
                                            </div>
                                        </div>
                                                                                      
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_sell_price')){ echo 'has-error';} ?>">
                                                <label>Selling Price<span1>*</span1></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Selling Price" id="pro_item_sell_price" name="pro_item_sell_price" value="<?php echo $pro_item_sell_price; ?>" required>
                                                 <label class="error"><?php echo form_error('pro_item_sell_price'); ?></label>
                                            </div>
                                        </div>  
                                    </div>
                                    
                                                                   

                                    <div class="text-center">     
                                        <input type="hidden" name="pro_vender_id" value="<?php echo $id;?>" />                                       
                                        <input type="hidden" name="pro_item_id" id="pro_item_id" value="<?php echo $pro_item_id;?>" />
                                        <button type="submit" name="Submit" class="btn btn-primary">Update</button>
                                        <!-- <button type="button" name="Submit1" class="btn btn-primary" onclick="self.close()">Close </button> -->
                                      <a href="<?php echo base_url().'masters/Product_item/addCost'?>" class="btn btn-primary">Close</a> 
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div><!-- Row -->
<!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="CompanyModal">
<div class="modal-dialog modal-lg" id="commonDetailsModal"></div>
</div> -->

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
                                    'data'    : {pro_id:$('#pro_item_id').val()},
                                    'success' : fnCallback
                                  });
                                }
                        } );
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

                </div><!-- Main Wrapper -->


    
   
 
<script type="text/javascript">
    function load_category_groups( category_id )
    {
        $.ajax({

            type: "GET",
            url: "<?php echo site_url('masters/Product_group/loadCategoryGroups'); ?>", 
            data: { category_id : category_id},
            dataType:"html",
            success: function(html)
            {
                $("#pro_group_id").html(html);
                $('#pro_group_id').select2("refresh");
            },
        });
 
</script>