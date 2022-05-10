<?php 
function get_buttons_new($id, $url,$user_id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
	
	$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>';
	
	$html.='</span>';
    return $html;
}
function get_buttons($id, $url,$rec_status)
{
	echo $status;
    $ci= & get_instance();
    $html='<span class="actions">';
    
   
       
    if($rec_status != 1)
    {
    	 $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
	$html .='<a href="'.  base_url(). $url.'receive/'.$id.'" title="Edit"><i class="glyphicon glyphicon-cloud-upload"></i></a>&nbsp;&nbsp;';
	}
	$html .='<a href="'.  base_url(). $url.'viewpodetails/'.$id.'" ><i  class="glyphicon glyphicon-th-list"></i></a>&nbsp;&nbsp;';
	if($rec_status != 1)
    {	
	$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>';
    }      
    
	
	$html.='</span>';
    return $html;
}
function get_buttons_new1($id,$url,$status)
{
    $ci= & get_instance();
    $html='<span class="actions">';

    if($status != 1)
    {
    $html .='<a href="'.  base_url(). $url.'operation/'.$id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';	
    
    

	$html .='<a href="'.  base_url(). $url.'delete/'.$id.'" onclick="conformboxdelete(this.href)" title="Delete"><i  style="color:red;" class="glyphicon glyphicon-trash"></i></a>';
	}
	$html .='<a href="'.  base_url(). $url.'paymentdetail/'.$id.'" title="Edit"><i class="glyphicon glyphicon-th-list"></i></a> &nbsp;';	
	$html .='<a href="'.  base_url(). $url.'printSalesorder/'.$id.'" target="_blank" title="Print ID Card"><i class="glyphicon glyphicon-print"></i></a>&nbsp;';
	$html.='</span>';
	
    return $html;
}

function get_payment_status($status2)
{
	if($status2==1)
	{
		return'<span class="label label-success"> Completed </span>';
	}
	else
	{
		return'<span class="label label-danger"> Pending </span>';
	}

}
function get_status1($status1)
{
	$ci= & get_instance();

	if($status1!=1)
	{
   		return'<span class="label label-warning"> Draft </span>';
	}
	else 
	{
   		
   		return'<span class="label label-info"> Approved </span>';
	}
}
function get_contype($id)
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
function get_statusbase($status)
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
function get_status($status)
{
	$ci= & get_instance();

	if($status==1)
	{
   		return'<span class="label label-success"> Completed </span>';
	}
	else 
	{
   		return'<span class="label label-info"> new </span>';
	}
}
function get_paystatus($status)
{
	$ci= & get_instance();

	if($status==1)
	{
   		return'<span class="label label-success"> Completed </span>';
	}
	else 
	{
   		return'<span class="label label-info"> Pending </span>';
	}
}


function get_orderStatus($status, $od_id)
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

function get_paymentStatus($payment_status)
{
	return ($payment_status == 0) ? '<span class="label label-danger">Not Paid</span>' : '<span class="label label-success">Paid</span>';
}

function get_packingStatus($packing_status, $od_id)
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

function get_statusbaseuser($status)
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
function get_dateformat($datevalue)
{
	return date("d M'y",strtotime($datevalue));
}
function get_date_timeformat($datevalue)
{
	if($datevalue != '0000-00-00 00:00:00')
	{
		return date("d M'y h:i A  ",strtotime($datevalue));
	}else
	{
		return '';
	}
}

function get_image_tag($url)
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


