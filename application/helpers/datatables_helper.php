<?php 
function get_buttons_new($id = '', $url = '', $user_id = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
	
	$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>';
	
	if($user_id){
		$html .=' &nbsp;<a href="'.  base_url(). $url.'operation/'.$id.'/acl" title="User access"><i  style="color:#009688;" class="glyphicon glyphicon-check"></i></a>';
	}
	$html.='</span>';
    return $html;
}
function client_rep($id = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';
 
	
	$html .='<a href="#" onclick="addrepModal('.$id.')" title="View" class="label label-success" style="text-align:center;"><i  class="glyphicon glyphicon-th-list"></i></a>';
	
	
	$html.='</span>';
    return $html;
}
function assign_As_vendor( $id='', $status='')
{

	$ci =& get_instance();
    $html='<span class="actions">';
    if($status == 0)
    {
    	
    	$html .='<a href="javascript:void(0);" onclick="AssignSupplier('.$id.','.$status.')" title="assign" class="label label-success">Assigned AS Supplier</a> ';
    	 
    }
 	else
    {
    	$html .='<a href="javascript:void(0);" title="assign" class="label label-danger">Supplier</a> ';
    	// $html .='<a href="" title="assign" class="label label-danger">Supplier</a> ';
    	 
    }	
	$html.='</span>';
    	return $html;

     
}
function assign_As_Client( $id='', $status='')
{

	$ci =& get_instance();
    $html='<span class="actions">';
    if($status == 0)
    {
    	
    	$html .='<a href="javascript:void(0);" onclick="AssignClient('.$id.','.$status.')" title="assign" class="label label-success">Assigned AS Client</a> ';
    	 
    }
 	else
    {
    	$html .='<a href="javascript:void(0);" title="assign" class="label label-danger">Client</a> ';
    	// $html .='<a href="" title="assign" class="label label-danger">Supplier</a> ';
    	 
    }	
	$html.='</span>';
    	return $html;

     
}
function get_buttons_newco($id = '', $url = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
	
	$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>&nbsp;';
	
	$html .='&nbsp;<a href="'.  base_url(). $url.'printCO/'.$id.'" title="Print CO" target="_blank" ><i class="glyphicon glyphicon-print"></i></a> &nbsp;';
	$html.='</span>';
    return $html;
}
function get_buttons_newvender($id = '', $url = '', $user_id = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url(). $url.'operationVender/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
	
	$html .='<a href="'.  base_url(). $url.'deletevender/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>';
	
	if($user_id){
		$html .=' &nbsp;<a href="'.  base_url(). $url.'operation/'.$id.'/acl" title="User access"><i  style="color:#009688;" class="glyphicon glyphicon-check"></i></a>';
	}
	$html.='</span>';
    return $html;
}
function get_payment_status($status2 = '')
{
	if($status2==1)
	{
		return'<span class="label label-success"> Completed </span>';
	}
	else
	{
		return'<span class="label label-warning"> Pending </span>';
	}

}

function get_symbol($symbol = '')
{
	return "<i class='".$symbol."'></i>";

}

function get_buttons($id = '', $url = '', $rec_status = '')
{

    $ci= & get_instance();
    $html='<span class="actions">';    
    if($rec_status == 0)
    {
    	 $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit PO"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';
    }
    if($rec_status != 2)
    {	
		$html .='<a href="'.  base_url(). $url.'receive/'.$id.'" title="Receive PO"><i class="glyphicon glyphicon-transfer"></i></a>&nbsp;&nbsp;';
	}
	$html .='<a href="'.  base_url(). $url.'viewpodetails/'.$id.'"title="View PO" ><i  class="glyphicon glyphicon-th-list"></i></a>&nbsp;&nbsp;';
	if($rec_status == 0)
    {	
		$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete PO"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;';
    }          
		$html .='<a href="'.  base_url(). $url.'printPo/'.$id.'" title="Print PO" target="_blank" ><i class="glyphicon glyphicon-print"></i></a> &nbsp;';
		$html .='<a href="javascript:void(0);" title="Mail PO" onclick="conformmail('.$id.')" ><i class="glyphicon glyphicon-envelope"></i></a> &nbsp;';
		// $html .='<a href="'.  base_url(). $url.'Revision/'.$id.'" title="Revision"><i class="fa fa-history"></i></a>&nbsp;&nbsp;';

	$html.='</span>';
    return $html;
}

function get_proforma_buttons($id = '', $url = '', $status = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';


    if($status != 1)
    {
		$html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit Proforma"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';		
		$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete Proforma"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;';
		$html .='<a href="'.  base_url().'sales_order/ProformaIntoInvoice/'.$id.'" title="Convert Proforma Into Invoice"><i class="glyphicon glyphicon-transfer"></i></a>&nbsp;&nbsp;';
	}
	
	$html .='<a href="'.  base_url(). $url.'paymentdetail/'.$id.'" title="View Details"><i class="glyphicon glyphicon-th-list"></i></a> &nbsp;';
	$html .='<a href="javascript:void(0);" title="Mail Proforma" onclick="conformmail('.$id.')"><i class="glyphicon glyphicon-envelope"></i></a> &nbsp;';

	$html .='<a href="'.  base_url(). $url.'printSalesorder/'.$id.'" target="_blank" title="Print Proforma"><i class="glyphicon glyphicon-print"></i></a>&nbsp;';
	$html.='</span>';
	
    return $html;
}

function get_quotation_buttons($id = '', $url = '', $status = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';

    // if($status != 1)
    // {
		$html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit Quotation"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';		
		$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete Quotation"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;';
		$html .='<a href="#" onclick="addrepModal('.$id.')" title="Print"  style="text-align:center;"><i  class="glyphicon glyphicon-print"></i></a>';
	// }
	
	// $html .='<a href="'.  base_url(). $url.'quotationdetail/'.$id.'" title="View Quotation Details"><i class="glyphicon glyphicon-th-list"></i></a> &nbsp;';
	// $html .='<a href="javascript:void(0);" title="Mail Quotation" onclick="conformmail('.$id.')"><i class="glyphicon glyphicon-envelope"></i></a> &nbsp;';

	// $html .='<a href="'.  base_url(). $url.'printQuotation/'.$id.'" target="_blank" title="Print Quotation"><i class="glyphicon glyphicon-print"></i></a>&nbsp;';
	// $html.='</span>';
	
    return $html;
}

function get_buttons_new1($id = '', $url = '', $status = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';


    if($status != 1)
    {
		$html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
	
		$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;';
	}
	
	$html .='<a href="'.  base_url(). $url.'paymentdetail/'.$id.'" title="View Details"><i class="glyphicon glyphicon-th-list"></i></a> &nbsp;';
	$html .='<a href="javascript:void(0);"  title="Mail" onclick="conformmail('.$id.')"><i class="glyphicon glyphicon-envelope"></i></a> &nbsp;';

	// $html .='<a href="'.  base_url(). $url.'printSalesorder/'.$id.'" target="_blank" title="Print"><i class="glyphicon glyphicon-print"></i></a>&nbsp;';
	$html .='<a href="#" onclick="addrepModal('.$id.')" title="Print"  style="text-align:center;"><i  class="glyphicon glyphicon-print"></i></a>';

	$html.='</span>';
	
    return $html;
}
function get_vender_add($id,$url)
{
	$ci= & get_instance();
	$url = 'masters/Product_item/';
    $html='<span class="actions">';
$html .='<a href="'.  base_url(). $url.'addCost/'.$id.'"  title="Edit"><i class="fa fa-plus"></i></a> &nbsp;';		
 return $html;
}
function get_buttons_revision($id = '', $url = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';

		// $html .='<a href="'.  base_url(). $url.'Revision/'. $id .'" title="Edit"><i class="fa fa-history"></i></a>';	
	
 $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit PO"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';
	
	$html.='</span>';

    return $html;
}
function get_status1($status1 = '')
{
	$ci= & get_instance();

	if($status1 == 1)
	{
   		return'<span class="label label-success"> Invoiced </span>';
	}
	
	else 
	{
   		return'<span class="label label-danger"> Draft </span>';
	}
}
function get_status2($status1 = '')
{
	$ci= & get_instance();

	if($status1 == 1)
	{
   		return'<span class="label label-success"> Closed </span>';
	}
	
	else 
	{
   		return'<span class="label label-danger"> Open </span>';
	}
}

function get_proforma_status($status = '')
{
	$ci= & get_instance();

	if($status == 1)
	{
   		return'<span class="label label-success"> Invoiced </span>';
	}
	else 
	{
   		return'<span class="label label-danger"> Proforma </span>';
	}
}

function get_contype($id = '')
{
	if($id==1)
	{
		return 'customer';
	}
	else
	{
		return 'vendor';
	}
}

function get_statusbase($status = '')
{
	$ci= & get_instance();

	if($status==1)
	{
   		return'<span class="label label-success"> Show </span>';
	}
	else 
	{
   		return'<span class="label label-danger"> Notshow </span>';
	}
}

function get_status($status = '')
{
	$ci= & get_instance();

	if($status==1)
	{
   		return'<span class="label label-warning"> Pending </span>';
	}
	else if($status==2)
	{
   		return'<span class="label label-success"> Completed </span>';
	}
	else
	{
		return'<span class="label label-info"> new </span>';
	}
}

function get_paystatus($status = '')
{
	$ci= & get_instance();

	if($status==1)
	{
   		return'<span class="label label-success"> Completed </span>';
	}
	else 
	{
   		return'<span class="label label-warning"> Pending </span>';
	}
}

function get_orderStatus($status = '', $od_id = '')
{
	switch($status)
	{
		case 'New':
		return '<a href="'.base_url().'order/Order/orderDetail/'.$od_id.'"><span class="label label-info">New</span></a>';
		break;
	
		case 'Process':
		return '<a href="'.base_url().'order/Order/orderDetail/'.$od_id.'"><span class="label label-primary">Process</span></a>';
		break;
		
		case 'Invoiced':
		return '<a href="'.base_url().'order/Order/orderDetail/'.$od_id.'"><span class="label label-warning">Invoiced</span></a>';
		break;
		
		case 'Shipped':
		return '<a href="'.base_url().'order/Order/orderDetail/'.$od_id.'"><span class="label label-inverse">Shipped</span></a>';
		break;
		
		case 'Completed':
		return '<a href="'.base_url().'order/Order/orderDetail/'.$od_id.'"><span class="label label-success">Completed</span></a>';
		break;
		
		case 'Cancelled':
		return '<a href="'.base_url().'order/Order/orderDetail/'.$od_id.'"><span class="label label-danger">Cancelled</span></a>';
		break;
	}
}

function get_paymentStatus($payment_status = '')
{
	return ($payment_status == 0) ? '<span class="label label-danger">Not Paid</span>' : '<span class="label label-success">Paid</span>';
}

function get_packingStatus($packing_status = '', $od_id = '')
{
	switch($packing_status)
	{
		case 'New':
		return '<a href="'.base_url().'order/Packing_order/orderDetail/'.$od_id.'"><span class="label label-info">New</span></a>';
		break;
	
		case 'Process':
		return '<a href="'.base_url().'order/Packing_order/orderDetail/'.$od_id.'"><span class="label label-primary">Process</span></a>';
		break;
		
		case 'Invoiced':
		return '<a href="'.base_url().'order/Packing_order/orderDetail/'.$od_id.'"><span class="label label-warning">Invoiced</span></a>';
		break;
		
		case 'Shipped':
		return '<a href="'.base_url().'order/Packing_order/orderDetail/'.$od_id.'"><span class="label label-inverse">Shipped</span></a>';
		break;
		
		case 'Completed':
		return '<a href="'.base_url().'order/Packing_order/orderDetail/'.$od_id.'"><span class="label label-success">Completed</span></a>';
		break;
		
		case 'Cancelled':
		return '<a href="'.base_url().'order/Packing_order/orderDetail/'.$od_id.'"><span class="label label-danger">Cancelled</span></a>';
		break;
		
		default:
		return '<a href="'.base_url().'order/Packing_order/orderDetail/'.$od_id.'"><span class="label label-success">'.$packing_status.'</span></a>';
		break;
	}
}

function get_statusbaseuser($status = '')
{
	$ci= & get_instance();

	if($status==0)
	{
   		return'<span class="label label-success"> Active </span>';
	}
	else 
	{
   		return'<span class="label label-danger"> In Active </span>';
	}
}

function get_dateformat($datevalue = '')
{
	return date("d/m/Y",strtotime($datevalue));
}

function get_date_timeformat($datevalue = '')
{
	if($datevalue != '0000-00-00 00:00:00')
	{
		return date("d M'Y",strtotime($datevalue)).' <br /><small style="color: #337ab7;">'.date("h:i A",strtotime($datevalue)).'</small>';
	}else
	{
		return '';
	}
}

function get_image_tag($url = '')
{
    $ci= & get_instance();
    if($url!='')
    {
		$html .='<a href="'.  config_item("image_url"). $url.'" target="_blank"><img src="'.config_item("image_url").$url.'" width="50" title="View Full" /></a>';
	}
	else
	{
		$html .='<a href="'.  config_item("image_url").'img/logo.png" target="_blank"><img src="'.config_item("image_url").'img/logo.png" width="50" title="View Full" /></a>';
	}
	return $html;
}
// function get_create_quote_button($qus_id = '', $url = '',$id = '' )
// {
//     $ci= & get_instance();
//     $html='<span class="actions">';
//     if($qus_id)
//     {
//     	$html .='<a href="javascript:void(0);" title="Edit"><span class="label label-success"> Quote Created </span></a> &nbsp;';	
	
//     }
//     else
//     {
//     	 $html .='<a href="'.  base_url().$url.'quotation_add/'.$id.'" title="Edit"><span class="label label-success">Create Quote</span></a> &nbsp;';
//     }
   	
	
	
// 	$html.='</span>';
//     return $html;
// }
function get_create_quote_button1($qus_id = '', $url = '',$id = '' )
{
    $ci= & get_instance();
    $html='<span class="actions">';
    
    	 $html .='<a href="'.  base_url().$url.'view_enquiry/'.$id.'" title="Edit"><span class="label label-success">View Enquiry</span></a> &nbsp;';
   
   	
	
	
	$html.='</span>';
    return $html;
}
function get_Lock_Status($id = '')
{
	// if($status2==1)
	// {
	// 	return'<span class="label label-danger"> Banned </span>';
	// }
	// else
	// {
	// 	return'<span class="label label-success"> Active </span>';
		
	// }

	$ci= & get_instance();
    $html='<span class="actions">';


    
	$html .='<a href="javascript:void(0);" class="btn btn-primary"  title="Mail" onclick="ResetPassword('.$id.')">Reset Password</a> &nbsp;';



	$html.='</span>';
	
    return $html;

}
function get_Lock_Status1($id = '',$banned ='')
{
	$ci= & get_instance();
	if($banned==1)
	{
		    $html='<span class="actions">';
	$html .='<select name="lock" id="lock" class="form-control" onchange="LockUser('.$id.','.$banned.');">
            <option value="1"> Yes</option>
             <option value="0">NO</option>
             
             </select>';
	$html.='</span>';	
    return $html;
	}
	else
	{
		    $html='<span class="actions">';
	$html .='<select name="lock" id="lock" class="form-control" onchange="LockUser('.$id.','.$banned.');">
            
             <option value="0" >NO</option>
             <option value="1"> Yes</option>
             </select>';
	$html.='</span>';	
    return $html;
	}


}
function get_Lock_user_Status($id = '')
{
	if($id==1)
	{
		return'<span class="label label-danger"> Banned </span>';
	}
	else
	{
		return'<span class="label label-success"> Active </span>';
		
	}
	}
	function get_credit_status($status2 = '')
{
	if($status2==0.00)
	{
		return'<span class="label label-success"> Closed </span>';
	}
	else
	{
		return'<span class="label label-warning"> Open </span>';
	}

}
function get_buttons_newcredict($id = '', $url = '', $status = '')
{
    $ci= & get_instance();
    $html='<span class="actions">';
    if($status != 1){
    $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
	
	$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;';
}
	$html .='<a href="'.  base_url(). $url.'paymentdetail/'.$id.'" title="View Details"><i class="glyphicon glyphicon-th-list"></i></a> &nbsp;';
	// $html .='<a href="'.  base_url(). $url.'printCredict_notes/'.$id.'" target="_blank" title="Print"><i class="glyphicon glyphicon-print"></i></a>&nbsp;';
 $html .='<a href="#" onclick="addprintModal('.$id.')" title="Print"  style="text-align:center;"><i  class="glyphicon glyphicon-print"></i></a>';

	$html.='</span>';
    return $html;
}
function get_date_format($datevalue = '')
{
	if($datevalue != '0000-00-00 00:00:00')
	{
		return date("d M'Y",strtotime($datevalue));
	}else
	{
		return '';
	}
}
function get_status_po($status = '')
{
	$ci= & get_instance();

	
   		return'<span class="label label-info"> Rev -  '.$status.' </span>';
	
}


