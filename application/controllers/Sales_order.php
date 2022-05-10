<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->library('email'); 
		$this->load->model('Prefs','pre',TRUE);
		$this->load->model('Sal_common_model','sal_common',TRUE);
		$this->load->model('Proforma_model','proforma',TRUE);
		$this->load->model('common_model','common',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);
		$this->load->library('Ciqrcode');
	}

	public function text()
	{
		echo $this->sal_common->getInvoiceNo();
	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'sales_order/add';
	        $msg['form_toptittle']	=	'Invoice Management';
        	$msg['datatable_url']	=	'sales_order/datatable';
        	$msg['list_tittle']		=	'Invoice list';
        	//$msg['back_url']='masters/Maincontacts/add';
        	//$msg['back_urlstatus']='1';
        	$msg['organization_detail']    =   $this->common->getCompanyProfiles('1');
        	$msg['drop_menu_client']	=	$this->mdropdown->drop_menu_client();
        	$msg['drop_menu_payment_terms'] = $this->mdropdown->drop_menu_payment_terms();
			$msg['drop_menu_customer']		=	$this->mdropdown->drop_menu_customer();
			$msg['drop_menu_item']			=	$this->mdropdown->drop_menu_item();
			$msg['drop_menu_tax1']			=	$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
			$msg['drop_menu_ship_pref']		=	$this->mdropdown->drop_menu_ship_pref();
			$msg['drop_menu_unit']			=	$this->mdropdown->drop_menu_unit();
			$msg['drop_menu_accountheads']	=	$this->mdropdown->drop_menu_accountheads();
			// $msg['sal_order']				=	$this->sal_common->getInvoiceDraftNo();
			$msg['drop_menu_tax_item'] = $this->mdropdown->drop_menu_invoice_tax_item();


			$inv_prifix = $this->sal_common->getInvoiceDraftprefix();
			$inv_num =$this->sal_common->getInvoiceDraftnumber();
			$inv_draf_sufix = $this->sal_common->getInvoiceDraftsuffix();
			$Inv_padd_num = str_pad($inv_num, 4, "0", STR_PAD_LEFT);
			$msg['sal_order'] = $inv_prifix.$Inv_padd_num.$inv_draf_sufix;


			$msg['drop_menu_bank']	=	$this->mdropdown->drop_menu_bank();
			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model; 
 			$sessionArr						=	$this->session->all_userdata();
			
 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Invoice Management',
								'content'   =>$this->load->view('sales_order/viewform',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function manage()
	{
		if($this->require_min_level(1))
        {
        	$from_date =   $this->input->post('from_date');
        	$from_date1 = date("Y-m-d", strtotime($from_date));
        	$to_date  = $this->input->post('to_date');
        	$to_date1 = date("Y-m-d", strtotime($to_date));
			$msg['vendor_id']  =$this->input->post('vendor_id');
			$msg['payment_status']  =$this->input->post('payment_status');
			$msg['inv_status']      =$this->input->post('inv_status');	
			$msg['form_url']		=	'Sales_order/add';
	        $msg['form_tittle']		=	'Invoice Management';
	        $msg['form_toptittle']	=	'Invoice Management';
        	$msg['list_tittle']		=	'Invoice list';

			if($this->input->post('searchFilter')=='1')
        	{
        		if($msg['payment_status']=='' && $msg['inv_status']!='' && $msg['vendor_id']!='' )
        		{
        			$msg['datatable_url']	=	'Sales_order/datatable_nopaymentstatus/'.$from_date1.'/'.$to_date1.'/'.$msg['vendor_id'].'/'.$msg['inv_status'];
        		}
        		else if($msg['inv_status']=='' && $msg['payment_status']!='' && $msg['vendor_id']!='' )
        		{
        			$msg['datatable_url']	=	'Sales_order/datatable_no_invoicestatus/'.$from_date1.'/'.$to_date1.'/'.$msg['vendor_id'].'/'.$msg['payment_status'];
        		}
        		else if($msg['vendor_id']=='' && $msg['payment_status']!='' && $msg['inv_status']!='' )
        		{
        			
        			$msg['datatable_url']	=	'Sales_order/datatable_no_vendor_id/'.$from_date1.'/'.$to_date1.'/'.$msg['payment_status'].'/'.$msg['inv_status'];
        		}
        		else if($msg['vendor_id']=='' && $msg['payment_status'] =='' && $msg['inv_status']!='' )
        		{
        			
        			$msg['datatable_url']	=	'Sales_order/datatable_no_vendor_id_no_payment/'.$from_date1.'/'.$to_date1.'/'.$msg['inv_status'];
        		}
        		else if($msg['vendor_id']=='' && $msg['payment_status']!='' && $msg['inv_status']=='' )
        		{
        			
        			$msg['datatable_url']	=	'Sales_order/datatable_no_vendor_id_no_invoice_status/'.$from_date1.'/'.$to_date1.'/'.$msg['payment_status'];
        		}
        		else if($msg['vendor_id']=='' && $msg['payment_status']=='' && $msg['inv_status']=='' )
        		{
        			
        			$msg['datatable_url']	=	'Sales_order/datatable_from_and_to/'.$from_date1.'/'.$to_date1;
        		}
        		else
        		{
        			$msg['datatable_url']	=	'Sales_order/datatable/'.$from_date1.'/'.$to_date1.'/'.$msg['vendor_id'].'/'.$msg['payment_status'].'/'.$msg['inv_status'];
        		}
        	}
        	else
        	{
        		$msg['datatable_url']	=	'Sales_order/datatableall';
        	}

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation', 'Invoice Number', 'Invoice Date', 'Client Name', 'Sales Amount', 'Paid Amount', 'Payment Status', 'Invoice Status', 'Created By', 'Created On'); 
			$msg['drop_menu_customer']		=	$this->mdropdown->drop_menu_client();
			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model; 

 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Invoice Management',
								'content'   =>$this->load->view('sales_order/viewlist',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatableall()
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
    function datatable_nopaymentstatus($from_date1, $to_date1, $vendor_id, $inv_status)
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('sal_order_date <=', $to_date1);
		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('sal_company_name =', $vendor_id);
		}
		if($inv_status=='1')
   		{
			$this->datatables->where('b.sal_invoice_status =','1');
		}
		if($inv_status=='0')
   		{
			$this->datatables->where('b.sal_invoice_status =','0');
		}
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
     function datatable_no_invoicestatus($from_date1, $to_date1, $vendor_id, $payment_status1)
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('sal_order_date <=', $to_date1);
		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('sal_company_name =', $vendor_id);
		}
		if($payment_status1 == '1')
   		{
   			
			$this->datatables->where('b.payment_status = ','1');
		}
		if($payment_status1 == '0')
   		{
   			
			$this->datatables->where('b.payment_status = ','0');
		}
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
    function datatable_no_vendor_id($from_date1, $to_date1, $payment_status1,$inv_status)
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('sal_order_date <=', $to_date1);
		}
		if($payment_status1 == '1')
   		{
   			
			$this->datatables->where('b.payment_status = ','1');
		}
		if($payment_status1 == '0')
   		{
   			
			$this->datatables->where('b.payment_status = ','0');
		}
			if($inv_status=='1')
   		{
			$this->datatables->where('b.sal_invoice_status =','1');
		}
		if($inv_status=='0')
   		{
			$this->datatables->where('b.sal_invoice_status =','0');
		}
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
     function datatable_no_vendor_id_no_payment($from_date1, $to_date1,$inv_status)
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('sal_order_date <=', $to_date1);
		}
		
		if($inv_status=='1')
   		{
			$this->datatables->where('b.sal_invoice_status =','1');
		}
		if($inv_status=='0')
   		{
			$this->datatables->where('b.sal_invoice_status =','0');
		}
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
     function datatable_no_vendor_id_no_invoice_status($from_date1, $to_date1, $payment_status1)
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('sal_order_date <=', $to_date1);
		}
		if($payment_status1 == '1')
   		{
   			
			$this->datatables->where('b.payment_status = ','1');
		}
		if($payment_status1 == '0')
   		{
   			
			$this->datatables->where('b.payment_status = ','0');
		}
		
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
    function datatable_from_and_to($from_date1, $to_date1)
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('sal_order_date <=', $to_date1);
		}
		
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
     function datatable($from_date1, $to_date1, $vendor_id, $payment_status1, $inv_status)
    {
		$this->datatables->select('b.sal_id, b.sal_order, b.sal_order_date, q.client_name, b.sal_grand_total, b.paid_amount, b.payment_status, b.sal_invoice_status, u.username, b.sal_created_on, v.dev_name, b.sal_person, b.sal_delivery_date');
		$this->datatables->from('sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
		$this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('sal_order_date <=', $to_date1);
		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('sal_company_name =', $vendor_id);
		}
		if($payment_status1 == '1')
   		{
   			
			$this->datatables->where('b.payment_status = ','1');
		}
		if($payment_status1 == '0')
   		{
   			
			$this->datatables->where('b.payment_status = ','0');
		}
		if($inv_status=='1')
   		{
			$this->datatables->where('b.sal_invoice_status =','1');
		}
		if($inv_status=='0')
   		{
			$this->datatables->where('b.sal_invoice_status =','0');
		}
		$this->datatables->group_by('b.sal_id');
		$this->db->order_by('b.sal_id','DESC');
		$this->datatables->edit_column('b.sal_id', '$1', "get_buttons_new1('b.sal_id', 'Sales_order/', 'b.sal_invoice_status')");
		$this->datatables->edit_column('b.payment_status', '$1', 'get_payment_status(b.payment_status)');
		$this->datatables->edit_column('b.sal_order_date', '$1', 'get_dateformat(b.sal_order_date)');
		$this->datatables->edit_column('b.sal_delivery_date', '$1', 'get_date_timeformat(b.sal_delivery_date)');
		$this->datatables->edit_column('b.sal_created_on', '$1', "get_date_timeformat('b.sal_created_on')");
		$this->datatables->edit_column('b.sal_invoice_status', '$1', 'get_status1("b.sal_invoice_status")');
		
		echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{	
			if(isset($_POST['draft']))
			{

				$sal_company_name		=	$this->input->post('client_name');
				$company_abb		=	$this->input->post('company_abb');

				$this->form_validation->set_rules('client_name', 'Client  Name', 'required');
			
								
				if($this->form_validation->run() == TRUE) 
				{
					if($this->input->post('inv_id')!='')
					{
				
						
						$sal_order_date		=	($this->input->post('client_date')!='') ? date('Y-m-d', strtotime($this->input->post('client_date'))) : date('Y-m-d');
						$value_array 	= array(
													'sal_company_name'			=>  $sal_company_name,
													'sal_client_rep' =>($this->input->post('client_rep')!='') ? ($this->input->post('client_rep')) : '',
												
													'sal_order_date'			=> $sal_order_date,
													'sal_sub_total' =>$this->input->post('sub_t'),
													'sal_tax_amount' => $this->input->post('vat_amount'),
													'sal_discount' => $this->input->post('dis_amount'),
													'sal_grand_total'			=>	$this->input->post('total'),
													'sal_invoice_status'		=>	'0',
													'status'					=> '1',
													'sal_currency' => $this->input->post('client_curency'),
													'sal_general_terms' => $this->input->post('remarks'),
													'remarks' => ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'sal_bank' =>($this->input->post('client_bank')!='') ? ($this->input->post('client_bank')) : '',
													'payment_term' => $this->input->post('payment_term'),
													'sal_created_by'			=>  $this->auth_user_id
												// 	'sal_created_on'  			=>  date('Y-m-d H:i:s')
						);	

						
							$s_idd = $this->input->post('inv_id');
							$num = $this->sal_common->find_sale_oredr_draft_number($s_idd);
							$value_array['sal_order'] = $num;
					

						$where_array	=	array('sal_id'=>$this->input->post('inv_id'));
						$resultupdate	=	$this->sal_common->common_edit1('sales_order',$value_array,$where_array);
						if($resultupdate)
						{
							$where		=	array('sal_id'=> $this->input->post("inv_id"));
							$result		=	$this->sal_common->common_delete('sales_order_item',$where);

							$item_Arr				    =	$this->input->post('item');
							$discountArr				    =	$this->input->post('discount');
							$vat_amountArr				=	$this->input->post('vat_per1');
							$qtyArr			= 	$this->input->post('qty');
							$unit_priceArr		= 	$this->input->post('unit_price');
							$total_amontArr	        =	$this->input->post('total_amont');
							$vat_AmotArr = $this->input->post('vat_amount1');
							$discout_amount = $this->input->post('discount_amount');
							foreach($item_Arr as $key => $val)
							{
								if($item_Arr[$key]!='')
								{
									$value_array1 = array
														(									
															'sal_id'		=>	$this->input->post('inv_id'),
															'item_description'	=>	$item_Arr[$key],
															'discount'	=>	$discountArr[$key],
															//'unit'			=>	$this->input->post('unit')[$key],
															'vat_per'		=>	$vat_amountArr[$key],
															'qty'		=>	$qtyArr[$key],
															'unit_price'     => $unit_priceArr[$key],
															'vat_amount1' => $vat_AmotArr[$key],
															'total_amount'		=> $total_amontArr[$key],
															'dis_amt' =>$discout_amount[$key],	
														);
									$this->sal_common->common_insert('sales_order_item',$value_array1);
								}

							}			
								
						}
					}
					else
					{
				
						$inv_prifix = $this->sal_common->getInvoiceDraftprefix();
						$inv_num =$this->sal_common->getInvoiceDraftnumber();
						$inv_sufix = $this->sal_common->getInvoiceDraftsuffix();
						$inv_order_no1 = str_pad($inv_num, 4, "0", STR_PAD_LEFT);
						$inv_order_no = $inv_prifix.$inv_order_no1.$inv_sufix;

						$sal_order_date		=	($this->input->post('client_date')!='') ? date('Y-m-d', strtotime($this->input->post('client_date'))) : date('Y-m-d');
						$value_array 	= array(
													'sal_company_name'			=>  $sal_company_name,
													'sal_client_rep' =>($this->input->post('client_rep')!='') ? ($this->input->post('client_rep')) : '',
												
													'sal_order_date'			=> $sal_order_date,
													'sal_order'  => $inv_order_no,
													'sal_sub_total' =>$this->input->post('sub_t'),
													'sal_tax_amount' => $this->input->post('vat_amount'),
													'sal_discount' => $this->input->post('dis_amount'),
													'sal_grand_total'			=>	$this->input->post('total'),
													'sal_invoice_status'		=>	'0',
													'status'					=> '1',
													'remarks' => ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'sal_bank' =>($this->input->post('client_bank')!='') ? ($this->input->post('client_bank')) : '',
													'sal_currency' => $this->input->post('client_curency'),
													'sal_general_terms' => $this->input->post('remarks'),
													'payment_term' => $this->input->post('payment_term'),
													'sal_created_by'			=>  $this->auth_user_id,
													'sal_created_on'  			=>  date('Y-m-d H:i:s')
						);	
	
						$sal_id= $this->sal_common->common_insert('sales_order',$value_array);
					
					

						if($sal_id)
						{	
							   $this->sal_common->set_pref_no('tbl_preferences', 'inv_number_draft');
							$item_Arr				    =	$this->input->post('item');
							$discountArr				    =	$this->input->post('discount');
							$vat_amountArr				=	$this->input->post('vat_per1');
							$qtyArr			= 	$this->input->post('qty');
							$unit_priceArr		= 	$this->input->post('unit_price');
							$total_amontArr	        =	$this->input->post('total_amont');
							$vat_AmotArr = $this->input->post('vat_amount1');
							$discout_amount = $this->input->post('discount_amount');
							foreach($item_Arr as $key => $val)
							{
								if($item_Arr[$key]!='')
								{
									$value_array1 = array
														(									
															'sal_id'		=>	$sal_id,
															'item_description'	=>	$item_Arr[$key],
															'discount'	=>	$discountArr[$key],
															//'unit'			=>	$this->input->post('unit')[$key],
															'vat_per'		=>	$vat_amountArr[$key],
															'qty'		=>	$qtyArr[$key],
															'unit_price'     => $unit_priceArr[$key],
															'vat_amount1' => $vat_AmotArr[$key],
															'total_amount'		=> $total_amontArr[$key],
															'dis_amt' =>$discout_amount[$key],
															
														);
									$this->sal_common->common_insert('sales_order_item',$value_array1);
								}

							}
						
							
							
						}
					}

					

				}
			}
			// Save As Invoice
			if(isset($_POST['saveinvoice']))
			{

				$sal_company_name		=	$this->input->post('client_name');
				$company_abb		=	$this->input->post('company_abb');

				$sal_reference			=	$this->input->post('sal_reference');
				
				$sal_order_date			=	$this->input->post('sal_order_date');
				$this->form_validation->set_rules('client_name', 'Client  Name', 'required');
						
				if($this->form_validation->run() == TRUE) 
				{
					if($this->input->post('inv_id')!='')
					{
				
						$inv_prifix = $this->sal_common->getInvoiceprefix();
						$inv_num =$this->sal_common->getInvoicenumber();
						$inv_sufix = $this->sal_common->getInvoicesuffix();
						$inv_order_no1 = str_pad($inv_num, 4, "0", STR_PAD_LEFT);
						$inv_order_no = $inv_prifix.$inv_order_no1.$inv_sufix;


						$sal_order_date		=	($this->input->post('client_date')!='') ? date('Y-m-d', strtotime($this->input->post('client_date'))) : date('Y-m-d');
						
						$value_array 	= array(
													'sal_company_name'			=>  $sal_company_name,
													'sal_client_rep' =>($this->input->post('client_rep')!='') ? ($this->input->post('client_rep')) : '',
												
													'sal_order_date'			=> $sal_order_date,
													'sal_order'  => $inv_order_no,
													'sal_sub_total' =>$this->input->post('sub_t'),
													'sal_tax_amount' => $this->input->post('vat_amount'),
													'sal_discount' => $this->input->post('dis_amount'),
													'sal_grand_total'			=>	$this->input->post('total'),
													'sal_invoice_status'		=>	'1',
													'status'					=> '1',
													'remarks' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',
													'sal_bank' =>($this->input->post('client_bank')!='') ? ($this->input->post('client_bank')) : '',
													'sal_currency' => $this->input->post('client_curency'),
													'sal_general_terms' => $this->input->post('remarks'),
													'payment_term' => $this->input->post('payment_term'),
													'sal_created_by'			=>  $this->auth_user_id
												// 	'sal_created_on'  			=>  date('Y-m-d H:i:s')
						);	
							
					
						$where_array	=	array('sal_id'=>$this->input->post('inv_id'));
						$resultupdate	=	$this->sal_common->common_edit1('sales_order',$value_array,$where_array);
						if($resultupdate)
						{
							$this->sal_common->set_pref_no('tbl_preferences', 'inv_number');
							$where		=	array('sal_id'=> $this->input->post("inv_id"));
							$result		=	$this->sal_common->common_delete('sales_order_item',$where);
							$item_Arr				    =	$this->input->post('item');
							$discountArr				    =	$this->input->post('discount');
							$vat_amountArr				=	$this->input->post('vat_per1');
							$qtyArr			= 	$this->input->post('qty');
							$unit_priceArr		= 	$this->input->post('unit_price');
							$total_amontArr	        =	$this->input->post('total_amont');
							$vat_AmotArr = $this->input->post('vat_amount1');
							$discout_amount = $this->input->post('discount_amount');

							foreach($item_Arr as $key => $val)
							{
								if($item_Arr[$key]!='')
								{
									$value_array1 = array
														(									
															'sal_id'		=>	$this->input->post('inv_id'),
															'item_description'	=>	$item_Arr[$key],
															'discount'	=>	$discountArr[$key],
															//'unit'			=>	$this->input->post('unit')[$key],
															'vat_per'		=>	$vat_amountArr[$key],
															'qty'		=>	$qtyArr[$key],
															'unit_price'     => $unit_priceArr[$key],
															'vat_amount1' => $vat_AmotArr[$key],
															'total_amount'		=> $total_amontArr[$key],
															'dis_amt' =>$discout_amount[$key],	
														);
									$this->sal_common->common_insert('sales_order_item',$value_array1);
								}

							}
						
								
						}
					}
					else
					{

						$inv_prifix = $this->sal_common->getInvoiceprefix();
						$inv_num =$this->sal_common->getInvoicenumber();
						$inv_sufix = $this->sal_common->getInvoicesuffix();
						$inv_order_no1 = str_pad($inv_num, 4, "0", STR_PAD_LEFT);
						$inv_order_no = $inv_prifix.$inv_order_no1.$inv_sufix;
						$sal_order_date		=	($this->input->post('client_date')!='') ? date('Y-m-d', strtotime($this->input->post('client_date'))) : date('Y-m-d');
						$value_array 	= array(
													'sal_company_name'			=>  $sal_company_name,
													'sal_client_rep' =>($this->input->post('client_rep')!='') ? ($this->input->post('client_rep')) : '',
												
													'sal_order_date'			=> $sal_order_date,
													'sal_order'  => $inv_order_no,
													'sal_sub_total' =>$this->input->post('sub_t'),
													'sal_tax_amount' => $this->input->post('vat_amount'),
													'sal_discount' => $this->input->post('dis_amount'),
													'sal_grand_total'			=>	$this->input->post('total'),
													'sal_invoice_status'		=>	'1',
													'status'					=> '1',
													'remarks' => ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'sal_bank' =>($this->input->post('client_bank')!='') ? ($this->input->post('client_bank')) : '',
													'sal_currency' => $this->input->post('client_curency'),
													'sal_general_terms' => $this->input->post('remarks'),
													'payment_term' => $this->input->post('payment_term'),
													'sal_created_by'			=>  $this->auth_user_id,
													'sal_created_on'  			=>  date('Y-m-d H:i:s')
						);	
	
						$sal_id= $this->sal_common->common_insert('sales_order',$value_array);
					
					

						if($sal_id)
						{	

							 $this->sal_common->set_pref_no('tbl_preferences', 'inv_number');
							$item_Arr				    =	$this->input->post('item');
							$discountArr				    =	$this->input->post('discount');
							$vat_amountArr				=	$this->input->post('vat_per1');
							$qtyArr			= 	$this->input->post('qty');
							$unit_priceArr		= 	$this->input->post('unit_price');
							$total_amontArr	        =	$this->input->post('total_amont');
							$vat_AmotArr = $this->input->post('vat_amount1');
							$discout_amount = $this->input->post('discount_amount');
							foreach($item_Arr as $key => $val)
							{
								if($item_Arr[$key]!='')
								{
									$value_array1 = array
														(									
															'sal_id'		=>	$sal_id,
															'item_description'	=>	$item_Arr[$key],
															'discount'	=>	$discountArr[$key],
															//'unit'			=>	$this->input->post('unit')[$key],
															'vat_per'		=>	$vat_amountArr[$key],
															'qty'		=>	$qtyArr[$key],
															'unit_price'     => $unit_priceArr[$key],
															'vat_amount1' => $vat_AmotArr[$key],
															'total_amount'		=> $total_amontArr[$key],
															'dis_amt' =>$discout_amount[$key],
															
														);
									$this->sal_common->common_insert('sales_order_item',$value_array1);
								}

							}
					}
				}
			}
		}

			if($sal_id)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Sales_order/manage'));
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Sales_order/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}

		}
	}

	public function customAlpha( $str = '' ) 
	{
	    if ( !preg_match('/^[A-Za-z0-9 .,\-]+$/i',$str) )
	    {
	        return false;
	    }
	}

	public function operation( $id = '' )
	{
			
		$where_array=array('sal_id'=>$id);
		$data['value']=$this->sal_common->get_fulldata('sales_order',$where_array);
		
		$data['evalue']=$this->sal_common->get_data_product1($id);
		$data['drop_menu_client_rep']			=	$this->sal_common->drop_menu_client_rep();
			$data['drop_menu_currency'] 	= $this->sal_common->drop_menu_client_Currency();
	
		$this->index($data);
	}

	public function ProformaIntoInvoice( $id = '' )
	{
		$where_array=array('pro_id'=>$id);
		$data['pro_id']=$id;
		$data['value']=$this->common->get_fulldata('proforma_invoice',$where_array);
		foreach($data['value']->result() as $row)
		{
			$data['customer_id']=$row->pro_company_name; 
		}
		$data['evalue']=$this->proforma->get_data_product($id);
		$this->index($data);
	} 
	
	public function menu_terms()
	{
			$res = $this->sal_common->menu_terms($this->input->get('payment_terms_id'));
			$res= implode('|',$res);
			echo $res;	
	}

	public function deleteproduct()
	{
		// $res = $this->sal_common->common_delete('sales_order_list',array('po_pdt_id' => $this->input->get('pro_item_id') ));
		$res = $this->common->common_delete('sales_order_item',array('sal_item_id' => $this->input->get('prid') ));
	}

	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
			$value_array=array(
								'status'		     =>	0,
								'sal_created_by'	 => $this->auth_user_id,
								'sal_created_on'     => date('Y-m-d H:i:s'),
							  );
			$where_array=array(
								'sal_id' =>$id
							  );
			$result=$this->sal_common->common_edit('sales_order',$value_array,$where_array);
			
			if($result)
			{
				$this->session->set_userdata('successMsg', 'Deleted Successfully...');
				redirect(base_url('sales_order/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
		}
	}

	public function getPartNoContent()
	{
		$msg['i']						=	$this->input->get('i');
		
		$msg['organization_detail']    =   $this->common->getCompanyProfiles('1');
		$msg['drop_menu_tax_item'] = $this->mdropdown->drop_menu_invoice_tax_item();	
		echo $this->load->view('sales_order/view_form_new_item',$msg,TRUE);
	}


	public function scanBarcodeItemDetail()
	{

		$barcode		=	$this->input->get('barcode');
		$itemDetails 	= 	$this->common->getBarcodeItemDetails($barcode);
		echo json_encode($itemDetails);
	}

	public function getProductPriceDetails()
	{
			$res = $this->sal_common->get_data($this->input->get('pro_item_id'));
			$res= implode('|',$res);
			echo $res;	 
	}

	// public function loadaddress()
	// {
	// 		$Customer_id 		= $this->input->get('con_id');
	// 		$drop_menu_address 	= $this->sal_common->drop_menu_client_rep($Customer_id);
	// 		echo form_dropdown('sal_client_rep', $drop_menu_address, set_value('sal_client_rep', (isset($sal_client_rep)) ? $sal_client_rep : ''), $attrib);
	// }
	public function loadaddress()
	{
			$Customer_id 		= $this->input->get('con_id');
			// $drop_menu_address 	= $this->sal_common->drop_menu_vendor_rep($Customer_id);
			$drop_menu_address 	= $this->sal_common->drop_menu_client_rep($Customer_id);
			echo form_dropdown('client_rep', $drop_menu_address, set_value('client_rep', (isset($inv_client_rep)) ? $inv_client_rep : ''), $attrib);
	}
	public function getClientCurrency()
	{
			$client_id 		= $this->input->get('con_id');
			$currency_id	= $this->sal_common->find_client_currency_id($client_id);
				$drop_menu_currency 	= $this->sal_common->drop_menu_client_Currency($currency_id);
			echo form_dropdown('client_curency', $drop_menu_currency, set_value('client_curency', (isset($client_curency)) ? $client_curency : ''), $attrib);
	}
	public function printSalesorder( $id='' )
	{

		// $organization_detail    =   $this->common->getCompanyProfiles('1');	
		// foreach($organization_detail->result() as $row) 
		// {
		// 	$company_abb 	=	$row->c_org_abb;
			
		// }
		
		// $data['spvalue']=$this->sal_common->get_data_product($id);
		// $bank_id				   =	$this->sal_common->get_bank_id($id);
		// $where_array	=	array('sal_id'=>$id);
		// $data['value']	=	$this->sal_common->get_fulldata('sales_order',$where_array);

		// $data['organization_detail']	=	$this->common->getCompanyProfiles('1');
		// $company_detail					=	$this->sal_common->get_company_detail($id);
		
		// $where_array2					=	array(
		// 											'id'=>$company_detail
		// 										);
		// $where_arraybank					=	array(
		// 											'bank_id'=>$bank_id
		// 										);
		// $data['bank_detail']			=	$this->sal_common->get_fulldata('tbl_bank_details',$where_arraybank);
		// $data['company_detail']			=	$this->sal_common->get_fulldata('tbl_client',$where_array2);
		// $data['tbl_preferences']		=	$this->sal_common->tbl_preferences();
		// $data['sales_order_tax']		=	$this->sal_common->sales_order_tax($id);
	
  //           $this->load->library('MyPDF1');
		// 	$pdf = new MYPDF1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// 	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// 	$pdf->SetCreator(PDF_CREATOR);
		// 	$pdf->SetTitle('InvoiceReport');
		// 	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		// 	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// 	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  //           $pdf->SetMargins(9,35,9);
		// 	$pdf->setHeaderMargin(200);
		// 	$pdf->SetFooterMargin(200);
		// 	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// 	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// 	$lg = Array();
		// 	$lg['a_meta_charset'] = 'UTF-8';
		// 	$lg['a_meta_language'] = 'fa';
		// 	$pdf->setLanguageArray($lg);
		// 	$pdf->SetFont('dejavusans', '', 10);
		// 	$pdf->AddPage();
		// 	$html=$this->load->view('sales_order/tcpdfInvoicewithoutHeader',$data, TRUE);
		// 	$pdf->writeHTML($html, true, false, true, false, '');
		// 	ob_end_clean();
		// 	$pdf->Output('InvoiceReport.pdf', 'I');
		$organization_detail    =   $this->common->getCompanyProfiles('1');	
		foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
		
		$data['spvalue']=$this->sal_common->get_data_product($id);
		
		$bank_id				   =	$this->sal_common->get_bank_id($id);
		
		$where_array	=	array('sal_id'=>$id);
		$data['value']	=	$this->sal_common->get_fulldata('sales_order',$where_array);

		$data['organization_detail']	=	$this->common->getCompanyProfiles('1');
		// $data['spvalue']				=	$this->sal_common->get_data_product($id);
		$company_detail					=	$this->sal_common->get_company_detail($id);
		
		$where_array2					=	array(
													'id'=>$company_detail
												);
		$where_arraybank					=	array(
													'bank_id'=>$bank_id
												);
		$data['bank_detail']			=	$this->sal_common->get_fulldata('tbl_bank_details',$where_arraybank);
		$data['company_detail']			=	$this->sal_common->get_fulldata('tbl_client',$where_array2);
		$data['tbl_preferences']		=	$this->sal_common->tbl_preferences();
		$data['sales_order_tax']		=	$this->sal_common->sales_order_tax($id);
		
// 			$this->load->view('sales_order/print_invoicesARAWithHeader', $data); 
		$this->load->library('MyPDF1');
		$pdf = new MYPDF1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('InvoiceReport');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// 		$pdf->SetMargins(10, PDF_MARGIN_TOP,10);
// 		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// 		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(9,35,9);
			// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	    $pdf->setHeaderMargin(200);
		$pdf->SetFooterMargin(200);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$lg = Array();
		$lg['a_meta_charset'] = 'UTF-8';
		$lg['a_meta_language'] = 'fa';
		$pdf->setLanguageArray($lg);
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		$html=$this->load->view('sales_order/invoice_print',$data, TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_end_clean();
		$pdf->Output('InvoiceReport.pdf', 'I');
	
	}
	public function printSalesorder1( $id='' )
	{

		$organization_detail    =   $this->common->getCompanyProfiles('1');	
		foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
		
		$data['spvalue']=$this->sal_common->get_data_product($id);
		
		$bank_id				   =	$this->sal_common->get_bank_id($id);
		
		$where_array	=	array('sal_id'=>$id);
		$data['value']	=	$this->sal_common->get_fulldata('sales_order',$where_array);

		$data['organization_detail']	=	$this->common->getCompanyProfiles('1');
		// $data['spvalue']				=	$this->sal_common->get_data_product($id);
		$company_detail					=	$this->sal_common->get_company_detail($id);
		
		$where_array2					=	array(
													'id'=>$company_detail
												);
		$where_arraybank					=	array(
													'bank_id'=>$bank_id
												);
		$data['bank_detail']			=	$this->sal_common->get_fulldata('tbl_bank_details',$where_arraybank);
		$data['company_detail']			=	$this->sal_common->get_fulldata('tbl_client',$where_array2);
		$data['tbl_preferences']		=	$this->sal_common->tbl_preferences();
		$data['sales_order_tax']		=	$this->sal_common->sales_order_tax($id);
		
// 			$this->load->view('sales_order/testprint', $data); 
		$this->load->library('MyPDF');
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('InvoiceReport');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(9,35,9);

	    $pdf->setHeaderMargin(200);
		$pdf->SetFooterMargin(200);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$lg = Array();
		$lg['a_meta_charset'] = 'UTF-8';
		$lg['a_meta_language'] = 'fa';
		$pdf->setLanguageArray($lg);
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		$html=$this->load->view('sales_order/invoice_print',$data, TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_end_clean();
		$pdf->Output('InvoiceReport.pdf', 'I');
	
	}
	 
	public function paymentadd( $id='' )
 	{
 		if($this->require_min_level(1))
		{
		 	if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('payment_amount', 'Payment Amount', 'required|numeric|greater_than[0]');
				$mode=$this->input->post('mode');

				if($mode=='2')
				{
					$this->form_validation->set_rules('cheque_number', 'Cheque/NEFT Number', 'required|numeric|greater_than[0]');
					$this->form_validation->set_rules('bank_name', 'Cheque/NEFT Bank Name', 'required|alpha');
				}

				$this->form_validation->set_rules('account_heads', 'Account Heads', 'required');
				$sal_id         = $this->input->post('invoice_id');

				if($this->form_validation->run()==TRUE)
				{
					$con_id 		=	$this->input->post('con_id');
					$creditamount 	=	$this->common->specific_row_value('tbl_contacts',array('con_id' =>$con_id,),'credit_amount');
					$openningamount =	$this->common->specific_row_value('tbl_contacts',array('con_id' =>$con_id),'opening_balance');

					$invoice_id     = 	$this->input->post('invoice_id');
					$sal_id         = 	$this->input->post('invoice_id');
					$totalsales     = 	$this->input->post('sal_grand_total');
					$totalpaid      = 	$this->sal_common->get_paid_amount($invoice_id);

					$payment_amount = 	$totalamount=$this->input->post('payment_amount');
					$needtopay      = 	$totalsales-$totalpaid;
					$actualpayment  = 	$creditamount+$payment_amount;

					/*

					if($openningamount!='0' || $openningamount!='')
					{
						if($actualpayment<=$openningamount)
						{
							$balanceopenningamount=$openningamount;
							$balanceactualamount=$openningamount-$actualpayment;
						}
						else
						{
							echo $balanceactualamount=$actualpayment-$openningamount;


							if($needtopay<=$balanceactualamount)
							{
								echo "hai";
								$creditbalance=$balanceactualamount-$needtopay;
								$paidamount=$totalsales;
								$status=1;
							}
							else
							{
								$paidamount=$balanceactualamount;
								$status=0;
							}
						}
					}
					else
					{
						*/
						if($needtopay<=$actualpayment)
						{
							$creditbalance=$actualpayment-$needtopay;
							$paidamount=$totalsales;
							$status=1;
						}
						else
						{
							$paidamount=$actualpayment;
							$status=0;
						}
					//}

					$value_array=array(
						'invoice_id'			=>	$this->input->post('invoice_id'),
						'amount'				=>	$paidamount,
						'date'					=>	($this->input->post('collection_date')!='') ? date('Y-m-d', strtotime($this->input->post('collection_date'))) : date('Y-m-d'),
						'transaction_date'		=>	($this->input->post('cheque_date')!='') ? date('Y-m-d', strtotime($this->input->post('cheque_date'))) : date('Y-m-d'),
						'payment_mode'			=>	$this->input->post('mode'),
						'transaction_number'	=>	$this->input->post('cheque_number'),
						'transaction_bank_name'	=>  $this->input->post('bank_name'),
						'account_heads'			=>	$this->input->post('account_heads'),
						'created_on'			=>  $this->auth_user_id,
						'created_by'  			=>  date('Y-m-d H:i:s')
				 	);

					$customer_payment	=	array(
						'sal_id'				=>	$this->input->post('invoice_id'),
						'customer_id'			=>	$con_id,
						'mode'					=>	$this->input->post('mode'),
						'collection_date'		=>	($this->input->post('collection_date')!='') ? date('Y-m-d', strtotime($this->input->post('collection_date'))) : date('Y-m-d'),
						'transaction_no'		=>	$this->input->post('cheque_number'),
						'transaction_date'		=>	($this->input->post('cheque_date')!='') ? date('Y-m-d', strtotime($this->input->post('cheque_date'))) : date('Y-m-d'),
						'paid_amt'				=>	$paidamount,					
						'bank_name'				=>	$this->input->post('bank_name'),
						
						'customer_remark' 		=>  $this->input->post('sal_order'),
						'created_on'  			=>  date('Y-m-d H:i:s')
					);
					
				 	$result 		= 	$this->sal_common->common_insert('customet_payment', $customer_payment);
					$sal_payment 	=	$this->sal_common->common_insert('sal_payment',$value_array);

					$value_array 	=	array(
												'paid_amount'		     =>	$paidamount,
												'payment_status'         => $status,
											  );
					$where_array 	=	array(
												'sal_id' =>$invoice_id,
											  );

					$this->sal_common->common_edit('sales_order',$value_array,$where_array);
					$result 	=	$this->common->common_edit1('tbl_contacts',array('credit_amount' => $creditbalance),array('con_id' =>$con_id,));

					//$this->common->common_edit1('tbl_contacts',array('opening_balance' => $balanceopenningamount),array('con_id' =>$con_id,));

					if($sal_payment)
					{
						$this->session->set_userdata('successMsg', 'Your payment added added Successfully...');
						redirect(base_url('Sales_order/paymentdetail/'.$sal_id),'refresh');
					}
				}

				$this->session->set_userdata('successMsg', 'Your payment not added successfully...');
				redirect(base_url('Sales_order/paymentdetail/'.$sal_id),'refresh');				
			}
		}
	}

 	public function paymentdetail( $id='' )
 	{

 		if($this->require_min_level(1))
        {
			$msg['value']=$this->sal_common->get_fulldata('sales_order',array('sal_id'=>$id));
			foreach($msg['value']->result() as $row)
			{
				$con_id=$row->sal_company_name;
			}

			$msg['organization_detail']=$this->sal_common->get_fulldata('tbl_org_profile',array('org_id'=>'1'));
			
			$organization_detail    =   $this->common->getCompanyProfiles('1');	
		foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
		// if($company_abb=="LCK")
		// {

				$msg['spvalue']=$this->sal_common->get_data_product($id);
		// }

		// if($company_abb=="NH")
		// {

		// 		$msg['spvalue']=$this->sal_common->get_data_product11($id);
		// }
		


		$company_detail=$this->sal_common->get_company_detail($id);
		
		$where_array2					=	array(
													'id'=>$company_detail
												);
		
		$msg['company_abb']   = $company_abb;
		$msg['payment_detail']	=	$this->sal_common->payment_detail($id);
		$msg['drop_menu_bank']	=	$this->mdropdown->drop_menu_bank();
		$msg['company_detail']	=	$this->sal_common->get_fulldata('tbl_client',$where_array2);
		$msg['tbl_preferences']	=	$this->sal_common->tbl_preferences();
		$msg['sales_order_tax']	=	$this->sal_common->sales_order_tax($id);
		$msg['credit_amount'] 	=	$this->common->specific_row_value('tbl_contacts',array('con_id' =>$con_id,),'credit_amount');
	

		$sessionArr=$this->session->all_userdata();
		$msg['form_url1']='sales_order/paymentadd/'.$id;
		$msg['notification'] = $sessionArr['successMsg'];
		$msg['drop_menu_accountheads']=$this->common->drop_menu_accountheads();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('sales_order/paymentdetail',$msg,TRUE)
			);

			
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
 	}
 	
 	function mailPo( $id = '' )
 	{
 		$id=$this->input->post('id');
		$msg['value']                  =    $this->sal_common->get_fulldata('sales_order',array('sal_id'=>$id));
		//$msg['organization_detail']    =	$this->sal_common->get_fulldata('tbl_company_profile',array('c_id'=>'1'));

		$msg['organization_detail']		=	$this->common->getCompanyProfiles('1');
		$msg['spvalue']					=	$this->sal_common->get_data_product($id);
		$company_detail 				=	$this->sal_common->get_company_detail($id);

		$where_array2 	=	array( 'con_id' => $company_detail );
		$where_array6 	=	array( 'invoice_id' => '1' );

		$msg['payment_detail']	=	$this->sal_common->payment_detail($id);
		$msg['company_detail']	=	$this->sal_common->get_fulldata('tbl_contacts',$where_array2);
		//$msg['tbl_preferences']=$this->sal_common->getInvoiceNo();
		$msg['tbl_preferences']	=	$this->sal_common->tbl_preferences();
		$msg['sales_order_tax']	=	$this->sal_common->sales_order_tax($id);

		/*
		$from_email 	= "admin@heuristicsoft.com"; 
		$to_email 		= "vinithag66@gmail.com"; 
		$to_email 		= "admin@heuristicsoft.com"; 
      
		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->email->from($from_email, 'Your Name'); 
		$this->email->to($to_email);
		$this->email->subject('Email Test'); 
        $data = 'Dear Customer,<br/>';
        		
        $body	=	$this->load->view('sales_order/print_email',$msg, TRUE);
		$this->email->message($body); 
		*/

		foreach($msg['company_detail']->result() as $row)
		{
			$con_company_name 	=	$row->con_company_name;		
			$con_address 		=	$row->con_address;	
			$con_phone 			=	$row->con_phone;	
			$con_email 			=	$row->con_email;
			$con_first_name 	= 	$row->con_first_name;
		}
		foreach($msg['organization_detail']->result() as $row)
		{
		    $c_org_name           = ucwords($row->c_org_name);
		}

		foreach($msg['value']->result() as $row)
	  	{     
			$sal_order                = $row->sal_order;
			
		}



		$this->load->library('email');
		$this->email->from($con_email,$c_org_name);
		$list = array($c_org_name);
        $this->email->to('admin@heuristicsoft.com');
		$this->email->subject('Invoice #'.$sal_order );

		$content = 'Please find below is the Invoice for the products required by us.<br/>';
		$body.= 'Dear '.$con_first_name.',<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
		$body.= $content.'<br/><br/>';
        $body.= $this->load->view('sales_order/print_email', $msg, TRUE);

		$this->email->message($body); 
		$this->email->set_mailtype("html");

		
		if($this->email->send()) 
		{
			echo 'Email sent successfully....';	
			

		}
		else
		{
			echo 'Error in sending Email....';
	

		}
 	}
 	
 	function addpaymentdetail()
 	{
		if($this->require_min_level(1))
		{
		}	
	}

	public function viewdetails()
	{

		$id = $this->input->get('pro_item_id');

		$data['details'] = $this->sal_common->get_po_details($id);	

		echo $this->load->view('sales_order/sal_detail', $data,TRUE);
	}
	public function QRcode($data,$name,$date,$time,$total,$tax,$vat_no)
    {

        $sal_order1                  = explode('-',$data);
    	$elements = array();
		foreach($sal_order1 as $data1) 
		{
    		$elements[] = $data1 ;
		}
		$dd =  implode('/', $elements);
		$name1                  = explode('-',$name);
    	$elements1 = array();
		foreach($name1 as $data2) 
		{
    		$elements1[] = $data2 ;
		}
		$name2 =  implode(' ', $elements1);
		$vat1                  = explode('-',$vat_no);
    	$elements2 = array();
		foreach($vat1 as $data3) 
		{
    		$elements2[] = $data3 ;
		}
		$vat =  implode(' ', $elements2);
		$date3 = $date.'T'.$time.":00Z";
		$dataToEncode = [[1,$name2],[2,$vat],[3,$date3],[4,$total],[5,$tax]];
		$TLV = $this->sal_common->getTLV($dataToEncode);
		$QR = base64_encode($TLV);


    	QRcode::png(
    		$QR ,
    		$outfile=false,
    		$level=QR_ECLEVEL_H,
    		$size=1,
    		$margin=2
    	);
    }
    public function language_transale()
	{

		$word = $this->input->get('data');

		
echo  $word;
}
public function GetInvoiceDraft()
{
	// $invoiceNumber 	= 	$this->sal_common->getInvoiceDraftNo();

	       $inv_prifix = $this->sal_common->getInvoiceDraftprefix();
			$inv_num =$this->sal_common->getInvoiceDraftnumber();
			$inv_draf_sufix = $this->sal_common->getInvoiceDraftsuffix();
			$Inv_padd_num = str_pad($inv_num, 4, "0", STR_PAD_LEFT);
			$invoiceNumber  = $inv_prifix.$Inv_padd_num.$inv_draf_sufix;
	echo $invoiceNumber;
}
public function get_invoice_no()
{


	$inv_prifix = $this->sal_common->getInvoiceprefix();
	$inv_num =$this->sal_common->getInvoicenumber();
	$inv_draf_sufix = $this->sal_common->getInvoicesuffix();
	$Inv_padd_num = str_pad($inv_num, 4, "0", STR_PAD_LEFT);
	$invoiceNumber  = $inv_prifix.$Inv_padd_num.$inv_draf_sufix;
	echo $invoiceNumber;
}
public function GetProformaNo()
{
	$proformaNumber 	= 	$this->sal_common->GetProformaNo();
	echo $proformaNumber;
}
public function addClientRep()
{
	$view_data['id'] 				=  $this->input->get('invoice_id');
 	echo $this->load->view('sales_order/print_modal',$view_data,TRUE);	
        
}
}