<?php
if(isset($value) && !empty($value))
{
    foreach($value->result() as $row)
    {
		$pro_item_id			=	$row->pro_item_id;
		$category_id			=	$row->category_id;  
		$pro_group_id			=	$row->pro_group_id;  
		$pro_item_name			=	$row->pro_item_name;
		$pro_item_code 			=	$row->pro_item_code;
		$price_per_unit			=	$row->price_per_unit;
		$pieces_per_unit		=	$row->pieces_per_unit;
		$unit_id				=	$row->unit_id;     
		$pro_item_sell_price	=	$row->pro_item_sell_price;      
		$pro_item_cost_price	=	$row->pro_item_cost_price;      
		$tax_id					=	$row->tax_id;     
		$pro_item_stock			=	$row->pro_item_stock; 
		$con_id					=	$row->con_id; 
		$pro_item_level			=	$row->reorder_level;  
		$pro_item_status		=	$row->pro_item_status;      
    }
}
else
{
        $category_id			=	$this->input->post('category_id');
        $pro_group_id			=	$this->input->post('pro_group_id');
        $pro_item_name			=	$this->input->post('pro_item_name');   
        $pro_item_code			=	$this->input->post('pro_item_code');   
        $pieces_per_unit		=	$this->input->post('pieces_per_unit'); 
        $unit_id				=	$this->input->post('unit_id');
        $pro_item_sell_price	=	$this->input->post('pro_item_sell_price');
        $pro_item_cost_price	=	$this->input->post('pro_item_cost_price');
        $tax_id					=	$this->input->post('tax_id');
        $pro_item_stock			=	$this->input->post('pro_item_stock');
        $con_id					=	$this->input->post('con_id');
        $pro_item_level			=	$this->input->post('pro_item_level');
        $pro_item_status		=	$this->input->post('pro_item_status');
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
                                            <div class="form-group <?PHP if(form_error('category_id')){ echo 'has-error';} ?>">
                                                <label>Category Name<span1>*</span1></label>

                                                    <select name="category_id" id="category_id" class="form-control" onchange="load_category_groups(this.value)">
                                                    <?php foreach ($drop_menu_category as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $category_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('category_id'); ?></label>
                                            </div>
                                        </div>
                                       <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_group_id')){ echo 'has-error';} ?>">
                                                <label>Manufacturer<span1>*</span1></label>

                                                    <select name="pro_group_id" id="pro_group_id" class="form-control">
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
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_code')){ echo 'has-error';} ?>">
                                                <label>Product Code<span1>*</span1></label>
                                                  <?php if(is_null($pro_item_name)){?>
                                                  <input type="text" autocomplete="off" class="form-control" placeholder="Enter Product Code" id="pro_item_code" name="pro_item_code" value="<?php echo $product_code;?>" readonly>
                                                 <?php } else { ?>
                                                  <input type="text" autocomplete="off" class="form-control" placeholder="Enter Product Name" id="pro_item_code" name="pro_item_code" value="<?php echo $pro_item_code; ?>" readonly>
                                                  <?php }?>
                                              
                                                 <label class="error"><?php echo form_error('pro_item_code'); ?></label>
                                            </div>
                                        </div>                                        
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_name')){ echo 'has-error';} ?>">
                                                <label>Product Name<span1>*</span1></label>
                                                <?php if(is_null($pro_item_name)){?>
                                                 <input type="text" autocomplete="off" ng-model = "productname" class="form-control"  placeholder="Enter Product Name" id="pro_item_name" name="pro_item_name" ng-click="">
                                                 <?php } else { ?>
                                                  <input type="text" autocomplete="off"  class="form-control"  placeholder="Enter Product Name" id="pro_item_name" name="pro_item_name" value="<?php echo $pro_item_name; ?>">
                                                  <?php }?>
                                                 <label class="error"><?php echo form_error('pro_item_name'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('unit_id')){ echo 'has-error';} ?>">
                                                <label>Unit Of Measurement<span1>*</span1></label>
                                                    <select name="unit_id" id="unit_id" class="form-control">
                                                    <?php foreach ($drop_menu_unit as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $unit_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('unit_id'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pieces_per_unit')){ echo 'has-error';} ?>">
                                                <label>Pieces Per Unit<span1>*</span1></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Pieces Per Unit" id="pieces_per_unit" name="pieces_per_unit" value="<?php echo $pieces_per_unit; ?>">
                                                 <label class="error"><?php echo form_error('pieces_per_unit'); ?></label>
                                            </div>
                                        </div>  
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_cost_price')){ echo 'has-error';} ?>">
                                                <label>Cost Price<span1>*</span1></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Cost Price" id="pro_item_cost_price" name="pro_item_cost_price" value="<?php echo $pro_item_cost_price; ?>">
                                                 <label class="error"><?php echo form_error('pro_item_cost_price'); ?></label>
                                            </div>
                                        </div>
                                                                                      
                                        <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('pro_item_sell_price')){ echo 'has-error';} ?>">
                                                <label>Selling Price<span1>*</span1></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Selling Price" id="pro_item_sell_price" name="pro_item_sell_price" value="<?php echo $pro_item_sell_price; ?>">
                                                 <label class="error"><?php echo form_error('pro_item_sell_price'); ?></label>
                                            </div>
                                        </div>  
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group <?PHP if(form_error('tax_id')){ echo 'has-error';} ?>">
                                                <label>Tax</label>
                                                    <select name="tax_id" id="tax_id" class="form-control">
                                                    <?php foreach ($drop_menu_tax as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $tax_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>
                                                    </select>
                                                
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('tax_id'); ?></label>
                                            </div>
                                        </div>
                                         <div class="col-md-2">
                                            <div class="form-group <?PHP if(form_error('pro_item_stock')){ echo 'has-error';} ?>">
                                                <label>Initial Stock<span1>*</span1></label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Initial Stock" id="pro_item_stock" name="pro_item_stock" value="<?php echo $pro_item_stock; ?>">
                                                 <label class="error"><?php echo form_error('pro_item_stock'); ?></label>
                                            </div>
                                        </div> 
                                         
                                        
                                         <div class="col-md-2">
                                            <div class="form-group <?PHP if(form_error('pro_item_level')){ echo 'has-error';} ?>">
                                                <label>Reorder Level:</label>
                                                 <input type="text" autocomplete="off" class="form-control"  placeholder="Enter Reorder Level" id="pro_item_level" name="pro_item_level" value="<?php echo $pro_item_level; ?>">
                                                 <label class="error"><?php echo form_error('pro_item_level'); ?></label>
                                            </div>
                                        </div>
                                       <div class="col-md-3">
                                            <div class="form-group <?PHP if(form_error('con_id')){ echo 'has-error';} ?>">
                                                <label>Vendor<span1>*</span1></label>
                                                    <select name="con_id" id="con_id" class="form-control">
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
                                            <div class="form-group <?PHP if(form_error('pro_item_status')){ echo 'has-error';} ?>">
                                                <label>Status</label>
                                                <select name="pro_item_status" class="form-control">
                                                    <option value="1" <?php if($pro_item_status=='1'){?> selected <?php }?>>Show</option>
                                                    <option value="0" <?php if($pro_item_status=='0'){?> selected <?php }?>>Not Show</option>
                                                </select>
                                                <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('pro_item_status'); ?></label>
                                            </div>
                                        </div>  
                                    </div>                                   

                                    <div class="text-center">                                            
                                        <input type="hidden" name="pro_item_id" value="<?php echo $pro_item_id;?>" />
                                        <button type="submit" name="Submit" class="btn btn-primary"><?php echo ($pro_item_id!='' ? 'Update Product' : 'Create Product'); ?> </button>
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
                                    'data'    : aoData,
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