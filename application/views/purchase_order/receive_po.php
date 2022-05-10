<?php
if(isset($evalue) && !empty($evalue))
{	
	foreach($value->result() as $row)
	{
		$po_id 			          =	$row->po_id;
	  	$po_no 			          =	$row->po_no;
	  	$order_date 		      =	$row->order_date;
		$vendor_id 		          =	$row->vendor; 
		$ref_no 		          =	$row->ref_no;      
		$del_date 		          =	$row->order_date;
		$item_id 		          =	$row->item_id;    
		$ship_pref_id 	          =	$row->ship_pref_id;   
		$sub_total 				  =	$row->cost_price;
		//$selling_price          =	$row->selling_price;
		$total 					  =	$row->total_cost_price;
		$selling_price_total_tax  =	$row->total_selling_price;
		$terms 					  =	$row->terms;   
		$del_addr 				  =	$row->del_addr;
		$notes 					  =	$row->notes;
		$po 					  =	$row->po;			    
		$po_status 				  =	$row->po_status;	
	    $po_created_by 			  =	$row->po_created_by;			    
		$po_created_on 			  =	$row->po_created_on;			    
	}

	foreach($evalue as $key =>$row)
	{	
		$item_id[$key]        =   $row->po_pdt_id;        
        $item[$key]         =   $row->item_name;
        $quantity[$key]     =   $row->quantity;
        $price_amt[$key]    =   $row->price;
        $sub_total[$key]        =   $row->sub_total;
        $discount[$key]             =   $row->discount;
        $total_amont[$key]      =   $row->total_amount;
        $recd_qty[$key]   =  $row->recd_qty;

		$trow++;
	}
	foreach($evalue1 as $key =>$row)
	{	
		$con_primary	 =	$row->con_primary;
	}
	foreach($expense as $key =>$row)
	{	
		    	
		$expenses_menu_id[$key] =	$row->po_expense_id;
		$expense_price[$key] 	=	$row->po_expense_amount;
		$trow1++;
	}
}
else
{		
		$expenses_menu_id		= 	$this->input->post('expenses_menu_id');
		$cost_amount			= 	$this->input->post('cost_amount');
		$selling_tax			= 	$this->input->post('selling_tax');
		$pieces_per_unit		= 	$this->input->post('pieces_per_unit');
		$selling_price			= 	$this->input->post('selling_price');
		$po_id 					=	$this->input->post('po_id');
		$vendor_id				= 	$this->input->post('vendor_id');
		$receive_date			=	$this->input->post('receive_date');
		$del_date				=	$this->input->post('del_date');
		$ref_no					=	$this->input->post('ref_no');
		$ship_pref_id			=	$this->input->post('ship_pref_id');
		$po_status     			= 	$this->input->post('po_status');
		$terms					=	$this->input->post('terms');
		$del_addr				=	$this->input->post('del_addr');
		$notes     				= 	$this->input->post('notes');
		$bill_no				= 	$this->input->post('bill_no');
		$po_pdt_id				=	$this->input->post('po_pdt_id');
		$pro_item_id			=	$this->input->post('pro_item_id');
		$unit 					=	$this->input->post('unit');
		$quantity     			= 	$this->input->post('quantity');
		$recd_qty     			= 	$this->input->post('recd_qty');
		$rec_qty     			= 	$this->input->post('rec_qty');
		$price_amt				=	$this->input->post('price_amt');
		$pdt_tax_amt			=	$this->input->post('pdt_tax_amt');
		$amount     			= 	$this->input->post('amount');
		$sub_total				=	$this->input->post('sub_total');
		$tot_tax_val			=	$this->input->post('tot_tax_val');
		$total 	     			= 	$this->input->post('total');
		$tax_percent 			= 	$this->input->post('tax_percent');
		$tax_name 	    		= 	$this->input->post('tax_name');
		$tax_id 	    		= 	$this->input->post('tax_id');
		$tax_type 	    		= 	$this->input->post('tax_type');
		$total_tax_amts 		= 	$this->input->post('total_tax_amt');
		$trow					=	$this->input->post('attproduct');
		$trow1					=	$this->input->post('attproduct');
		
}
	
	$i 		= 1;
	$trow 	= ($trow=='') 	? 1 : $trow;
	$trow1 	= ($trow1=='') 	? 1 : $trow1;
	
	foreach ($tax_type as $key => $value)
	{
		$total_tax_amt[$value] = $total_tax_amts[$key];


	}
?>

<div class="page-inner">
	<div class="page-title">
		<h3><?PHP echo $form_toptittle; ?></h3>
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url();?>">Home</a></li>
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
		<?php echo form_open($form_url); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading clearfix">
                            <h4 class="panel-title"></h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><h4>Vendor Name:</h4></label><?php echo $con_primary;?>
                                    </div>
                                </div>	
                                <div class="col-md-3">
                                    <label><h4>PO Number:</h4></label><?php echo $po_no;?>
                                </div> 
                                        <div class="col-md-3">
                                        <label><h4>PO Date:</h4></label><?php echo $order_date;?>							
                                </div>
                                </div>  
                                               
                            <div class="row">
                                
                                    <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('receive_number')){ echo 'has-error';} ?>">
                                        <label>Receive Number</label>
                                         <input type="text" class="form-control"  placeholder="Enter Receive Purchase Order Number" id="receive_number" name="receive_number" value="<?php echo $re_number;?>">
                                         <label class="error"><?php echo form_error('receive_number'); ?></label>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('receive_date')){ echo 'has-error';} ?>">
                                        <label>PO Receive Date</label>								
                                        <input type="text" class="form-control date-picker" placeholder="Order Date" value="<?php echo ($receive_date!='' && $receive_date!='0000-00-00') ? $receive_date : date('d M, Y'); ?>" name="receive_date" id="receive_date" style="background-color:#fff"  >
                                    </div>
                                    <label id="location-error" class="validation-error-label" for="location"><?php echo form_error('receive_date'); ?></label>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group <?PHP if(form_error('bill_no')){ echo 'has-error';} ?>">
                                        <label>Bill Number <span1>*</span1></label>
                                        <input type="text" class="form-control"  placeholder="Enter Bill Number" id="bill_no" name="bill_no" value="<?php echo $bill_no;?>">
                                        <label class="error"><?php echo form_error('bill_no'); ?></label>
                                    </div>
                                    </div>       			                           
                                </div>    	
                            <legend style="padding-top: 0px;padding-bottom:0px;"></legend>                 
                            <div class="row">
                                <div class="col-md-7">
                                    <center><label><strong>Product Item </strong></label></center>
                                </div>
                            
                                <!--	<div class="col-md-2">
                                    <div class="form-group">
                                        <center><label><strong>Unit</strong></label></center>
                                        </div>
                                </div>-->
                               
                                
                                <div class="col-md-1">
                                    <center><label><strong>Cost Price</strong></label></center>
                                </div>
                                
                              <!--   <div class="col-md-1">
                                    <center><label><strong>Sell. Price </strong></label></center>
                                </div> -->
                                
                                <div class="col-md-1">
                                    <center><label><strong>PO Quantity</strong></label></center>
                                </div>
                                
                                <div class="col-md-1">
                                    <center><label><strong>Received</strong></label></center>
                                </div>	
                                                        
                                <div class="col-md-1">
                                    <center><label><strong>Receive Qty</strong></label></center>
                                </div>
                                
                               <!--  <div class="col-md-1">
                                    <center><label><strong>Sell. Price </strong></label></center>
                                </div> -->
                                
                                <div class="col-md-1">
                                    <center><label><strong>Cost Price</strong></label></center>
                                </div>
                            </div>
                            <legend style="padding-top: 0px;padding-bottom:0px;"></legend>
                            <div class="row">
                                <div class="col-md-12">                  
                                    <span id="partProductData">
                                        <?php 
                                        $is=1;
                                        for($i=0; $i < $trow; $i++)
                                        {
                                            ?>
                                            <div class="row allrowvalues"  id="rowssids_<?php echo $i;?>">
                                                
                                                <div class="col-md-7">
                                                <textarea id="item'.$i.'" name="item[]" autocomplete="off" class="form-control " rows="3" style="min-height: 1px;"><?php echo $item[$i];?></textarea>
                                                <input type="hidden" name="po_pdt_id[]" value="<?php echo $item_id[$i];?>" id="po_pdt_id[$i]">
                                                </div> 

                                                  
                                                
                                                <div class="col-md-1">
                                                       
                                                        <input type="text" name="price_amt[]" class="form-control price_amt" id="price_amt<?php echo $i;?>" value="<?php echo $price_amt[$i];?>"  onkeyup="calculate();" placeholder="Price">
                                                </div>		
                                                                  
                                              <!--   <div class="col-md-1">
                                                    <input type="hidden" name="tax_id[]" class="tax_id" id="tax_id<?php echo $i;?>" value="<?php echo $tax_id[$i]; ?>"/> 
                                                    <input type="hidden" name="tax_name[]" class="tax_name" id="tax_name<?php echo $i;?>" value="<?php echo $tax_name[$i]; ?>"/>
                                                    <input type="hidden" name="tax_percent[]" class="tax_percent" id="tax_percent<?php echo $i;?>" value="<?php echo $tax_percent[$i]; ?>"/>
													<input type="hidden" name="selling_tax[]" class="selling_tax_amt" id="selling_tax_amt<?php echo $i;?>" value="<?php echo $selling_tax[$i]; ?>" />
                                                    <input name="selling_price[]" class="form-control selling_price" id="selling_price<?php echo $i;?>" type="text" value="<?php echo $selling_price[$i]; ?>" onkeyup="calculate();" placeholder="Selling Price"/>
                                                </div> -->

                                            	<div class="col-md-1">
                                                    <input name="quantity[]" class="form-control quantity" id="quantity<?php echo $i;?>" type="text" value="<?php echo $quantity[$i]; ?>" readonly placeholder="Qty"/>
                                            	</div>
                                                
                                                <div class="col-md-1">
                                                    <input name="recd_qty[]" class="form-control recd_qty" id="recd_qty<?php echo $i;?>" type="text" value="<?php echo $recd_qty[$i]; ?>" placeholder="Qty" readonly/>
                                                </div>
                                                
                                                <div class="col-md-1">
                                                    <input name="rec_qty[]" class="form-control rec_qty" id="rec_qty<?php echo $i;?>" type="text" value="<?php echo $rec_qty[$i]; ?>" onkeyup="check(<?php echo $i;?>)" onkeyup="calculate();" placeholder="Qty"/>
                                                </div>
                                                
                                           <!--      <div class="col-md-1">
                                                    <input name="amount[]"  class="form-control amount" id="amount<?php echo $i;?>" type="text" value="<?php echo $amount[$i]; ?>" readonly  placeholder="Amt"/> 
                                                </div> -->
                                            
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <input name="cost_amount[]"  class="form-control cost_amount" id="cost_amount<?php echo $i;?>" type="text" value="<?php echo $cost_amount[$i]; ?>" readonly  placeholder="Amt"/> 
                                                </div>
                                            </div>
                                            

                                           
                                            </div>
                                            
                                        <?php 
                                        $is++; 
										} 
                                        ?>
                                    </span>                                       		 
                                </div>
                                <div class="row">
                                </div>
                                <hr style="margin: 5px 0 !important;">
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-5">												
                                                
                                                    <div class="form-group">
                                                        <label class="control-label">Receive Notes</label>
                                                        <textarea name="notes" class="form-control" ><?php echo $notes; ?></textarea>
                                                    </div>
                                                
                                            </div>
                                            <div class="col-md-7">
                                               <!--  <div class="row">
                                                    <div class="col-md-6 text-right" >
                                                        <label class="control-label"><strong>Sub Total</strong></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                          <div class="form-group">
                                                             <input type="text" name="selling_total" class="form-control selling_total" value="<?php echo $selling_total; ?>" id="selling_total" readonly  >
                                                         </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" name="sub_total" class="form-control sub_total" value="<?php echo $sub_total; ?>" id="sub_total" readonly  >
                                                        </div>
                                                    </div>
                                                </div> -->
                                            
        
                                            
                                                <?php
                                               foreach ($drop_menu_tax1 as $row)
                                               {						            
                                                ?> 
                                                <div class="row">
                                                    <div class="col-md-6 text-right" >
                                                        <label class="control-label"><strong><?php echo $row->tax_name;?></strong></label>
                                                    </div>
                                                       <div class="col-md-3">
                                                        <div class="form-group">		
                                                            <input name="total_selling_tax[]" class="form-control total_selling_tax" id="total_selling_tax<?php echo $row->tax_id;?>" type="text" value="<?php echo $total_selling_tax[$row->tax_id];?>" required readonly/>
                                                                <input name="tax_type[]" class="form-control tax_type" id="tax_type<?php echo $row->tax_id;?>" type="hidden" size="75" value="<?php echo $row->tax_id;?>" >   
                                                            </div>
                                                    </div>
                                                     <div class="col-md-3">
                                                        <div class="form-group">		
                                                            <input name="total_tax_amt[]" class="form-control total_tax_amt" id="total_tax_amt<?php echo $row->tax_id;?>" type="text" value="<?php echo $total_tax_amt[$row->tax_id];?>" required readonly/>
                                                            </div>
                                                    </div>
                                               </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-9 text-right" >
                                                        <label class="control-label"><strong>Total</strong></label>
                                                    </div>
                                                    <!-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" name="selling_price_total_tax"	class="form-control" value="<?php echo $selling_price_total_tax; ?>" id="selling_price_total_tax" readonly  >
                                                            <input name="tax_type[]" class="form-control tax_type" id="tax_type13" type="hidden" size="75" value="13">
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" name="total" class="form-control" value="<?php echo $total; ?>" id="total" readonly  >
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div>
            </div>
            
          
            
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group ">
                                        <label class="radio-inline">
                                            <div class="choice"><span class=""><input type="radio" name="po" class="styled" value="0" checked="checked"></span>Receive PO</div> 
                                        </label>
                                        <label class="error"></label>
                                    </div>								
                                </div>
                                <div class="col-md-4 text-right">
                                  <input type="hidden" name="po_id" value="<?php echo $po_id;?>" />		
                                  <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                                 </div>
                            </div>
                        </div>                         
                    </div>
                 </div>
            </div>
		<?php echo form_close(); ?>
	</div>
</div><!-- Row -->
<!-- /page container -->
<script type="text/javascript">
	$(document).ready(function()
	{
		calculate();
	});

	function addNewpricePart()
	{
		row = $('#attproduct1').val();
		$.ajax({
			type: "GET",
			url: "<?php echo site_url('Purchase_order/getreceivepriceContent'); ?>", 
			data: {i:row},
			dataType:"html",
			success: function(html)
			{
				$('#partProductData1').append(html);
				$('#expenses_menu_id'+row).select2();
	
				row = Number($('#attproduct1').val()) + 1;	
				$('#attproduct1').val( row );				
			},
		});
	}
	function loadPriceDetails(id,i)
	{	
		$.ajax({
			type: "GET",
			url: "<?php echo site_url('Purchase_order/getProductPriceDetails'); ?>", 
			data: { pro_item_id:id},
			dataType:"html",
			success: function(html)
			{	

				result = html.split('|');

				$('#pro_item_id'+i).val(result[0]);
				$('#pro_item_name'+i).val(result[1]);
				$('#price_amt'+i).val(result[2]);
				$('#tax_id'+i).val(result[3]);
				$('#tax_name'+i).val(result[4]);
				$('#tax_percent'+i).val(result[5]);
				$('#unit').val(result[6]);
				$('#pieces_per_unit'+i).val(result[7]);
				$('#selling_price'+i).val(result[8]);
				
				calculate(i);
			},
		});
	}
	
			function getConfirmPart(inv,prid)
			{
		
			    var x;
			    var r=confirm("You Want Delete!!");
			    if(prid!='' && r==true)
			    {
			      $.ajax({"url":"<?php echo site_url('Purchase_order/deletereceiveproduct'); ?>",
			      "type":"GET",
			      data:{
			          "prid":prid
			      },

			      success:function(data)
			        {
			          //alert("Daelted Successfully");
			          $('#rowssids_'+inv+'').remove();
			          $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
			          calculate();
			        }
			      
			      });
			   
		    	}
			    else if (prid=='' && r==true)
			    {

			      $('#rowssids_'+inv+'').remove();
			      $('#attproduct').val( Number($('#attproduct').val()) - Number(1));
			      calculate();	
			    }
			}
				function getConfirmPart1(inv,prid)
			{
		
			    var x;
			    var r=confirm("You Want Delete!!");
			    if(prid!='' && r==true)
			    {
			      $.ajax({"url":"<?php echo site_url('Purchase_order/deletereceiveexpense'); ?>",
			      "type":"GET",
			      data:{
			          "prid":prid
			      },

			      success:function(data)
			        {
			          //alert("Daelted Successfully");
			          $('#rowssids1_'+inv+'').remove();
			          $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
			          calculate();
			        }
			      
			      });
			   
		    	}
			    else if (prid=='' && r==true)
			    {

			      $('#rowssids1_'+inv+'').remove();
			      $('#attproduct1').val( Number($('#attproduct1').val()) - Number(1));
			      calculate();	
			    }
			}
	
	function check(i)
	{
		var rec_qty 	= Number($('#rec_qty'+i).val());
		var recd_qty 	= Number($('#recd_qty'+i).val());
		var ord_qty 	= Number($('#quantity'+i).val());
		var pro_id 		= $('#pro_item_id'+i).val();
		var qty			= Number(rec_qty + recd_qty);

		$('#recd_qty').val(recd_qty);

		if(qty > ord_qty)
		{
			alert("Exceeds the Ordered Quantity");
			$('#rec_qty'+i).val('0');
			calculate();
		}
		else
		{
			calculate();
		}
	}
	
	function calculate()
	{	
				
		var grandtotal 		= 0;
		var subtotal 		= 0;
		var tax 			= 0;
		var selling_total   = 0;
		var selling_tax 	= 0;
		var shipping_amount = 0;
		var expense_price 	= 0;
		var selling_total1 	= 0;
		var grandtotal1 	= 0;
		

		$('.allrowvalues').each(function(i,o) 
		{
			var qty   		        =	$(o).find('.rec_qty',this).val();							
			var price 		        =	$(o).find('.price_amt',this).val();
			var selling_price 		=	$(o).find('.selling_price',this).val();
			var tax_percent		    =	$(o).find('.tax_percent',this).val();
			var tax_id 				=	$(o).find('.tax_id',this).val();
			
			
			var total 				=  (Number(qty *1) * Number(price *1));
			total= parseFloat(total).toFixed(2);
			var selling_price 		=  (Number(qty *1) * Number(selling_price *1));
			selling_price= parseFloat(selling_price).toFixed(2);
			var tax_value 			=  ((Number(tax_percent) * Number(total))/100);
			var selling_tax 		=  ((Number(tax_percent) * Number(selling_price))/100);
		
			$(o).find('.pdt_tax_amt',this).addClass('tax_'+tax_id);
			$(o).find('.selling_tax_amt',this).addClass('selling_tax_amt_'+tax_id);

			$(o).find('.amount',this).val(selling_price);
			$(o).find('.cost_amount',this).val(total);
			$(o).find('.pdt_tax_amt',this).val(tax_value);
			$(o).find('.selling_tax_amt',this).val(selling_tax);
			
			grandtotal+=Number(total);
			selling_total+=Number(selling_price);

			
		});
		grandtotal=parseFloat(grandtotal).toFixed(2);
		selling_total=parseFloat(selling_total).toFixed(2);
		$('#sub_total').val(grandtotal);
		$('#selling_total').val(selling_total);

		vat_list 	= 	document.getElementsByName('tax_id[]');
		var v 		=	vat_list.length;
		total_sum 	=	0;

		$(".total_tax_amt").val('0');
		
		for(j=0;j<v;j++)
		{
		   taxId = vat_list[j].value;

		   $("#total_tax_amt"+taxId).val('0');
		   $("#total_selling_tax"+taxId).val('0');

			   var sum=0;
			   var sum1=0;
			   

			   k=0;
			 
			   $(".tax_"+taxId).each(function(index, element) 
			   {
					sum=parseFloat(sum + Number($(this).val())).toFixed(2);
			   });

			   $(".selling_tax_amt_"+taxId).each(function(index, element) 
			   {
					sum1= parseFloat(sum1 + Number($(this).val())).toFixed(2);
			   });
			
			   $("#total_tax_amt"+taxId).val(sum);
			   $("#total_selling_tax"+taxId).val(sum1);
			 
			   grandtotal 		= parseFloat((Number(grandtotal) + Number(sum))).toFixed(2);
			   selling_total1 	= parseFloat((Number(selling_total) + Number(sum1))).toFixed(2);
			 
			 
		}

		var totalExpense = 0;
		$('.expense_price').each(function (index, element) 
		{
			totalExpense =totalExpense +  Number($(this).val());
			
		});
        totalExpense= parseFloat(totalExpense).toFixed(2);
		grandtotal1=parseFloat(Number(grandtotal)+Number(totalExpense)).toFixed(2);
		totalExpense1=parseFloat(Number(selling_total1)-Number(grandtotal1)).toFixed(2);
	   
		$('#total').val(grandtotal);
		$('#selling_price_total_tax').val(selling_total1);
		$('#selling_expense_total').val(totalExpense);
		$('#overall_purchase_price').val(grandtotal1);
		$('#overall_selling_price').val(selling_total1);
		$('#overall_profit').val(totalExpense1);
		
	}
</script>


	
	
 