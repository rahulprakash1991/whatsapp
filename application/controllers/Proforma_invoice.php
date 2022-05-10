<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proforma_invoice extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('Prefs','pre',TRUE);
		$this->load->library('email'); 
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->model('Proforma_model','proforma',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);
	}


	public function text()
	{
		echo $this->proforma->getInvoiceNo();
	}


	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']='Proforma_invoice/add';
	      
	        $msg['form_toptittle']='Proforma Invoice Management';

        	$msg['datatable_url']='Proforma_invoice/datatable';
        	$msg['list_tittle']='Proforma Invoice List';


    
			
			$msg['drop_menu_customer']       =	$this->mdropdown->drop_menu_customer();
			$msg['drop_menu_item']           =	$this->mdropdown->drop_menu_item();
			$msg['drop_menu_tax1']           =	$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_product_item']   =	$this->mdropdown->drop_menu_product_item();
			$msg['drop_menu_ship_pref']      =	$this->mdropdown->drop_menu_ship_pref();
			$msg['drop_menu_unit']           =	$this->mdropdown->drop_menu_unit();
			$msg['drop_menu_address']        =	$this->mdropdown->drop_menu_address1();
			$msg['drop_menu_accountheads']   =	$this->mdropdown->drop_menu_accountheads();
			$msg['drop_menu_terms']          =	$this->mdropdown->drop_menu_terms();
			$msg['pro_order']                =	$this->proforma->getInvoiceNo();
			$msg['notification']             =  $sessionArr['successMsg'];
 			$auth_model                      =  $this->authentication->auth_model; 
 			$sessionArr                      =	$this->session->all_userdata();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Purchase Order Management',
				'content'   =>$this->load->view('proforma_invoice/proforma_Invoiceform',$msg,TRUE)
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

			$msg['form_url']           =	'Proforma_invoice/add';
	        $msg['form_tittle']        =	'Proforma Invoice Management';
	        $msg['form_toptittle']     =	'Proforma Invoice Management';
			$msg['datatable_url']      =	'Proforma_invoice/datatable';
        	

        	$from_date =   $this->input->post('from_date');
        	$from_date1 = date("Y-m-d", strtotime($from_date));
        	$to_date  = $this->input->post('to_date');
        	$to_date1 = date("Y-m-d", strtotime($to_date));
			$vendor_id  =$this->input->post('vendor_id');
			$msg['status']      =$this->input->post('status');

			if($this->input->post('searchFilter')=='1')
        	{

        		$msg['datatable_url']	=	'Proforma_invoice/datatable/'.$from_date1.'/'.$to_date1.'/'.$vendor_id.'/'.$msg['status'];

        	}
        	else
        	{
        		$msg['datatable_url']	=	'Proforma_invoice/datatable';
        	}
        	$msg['drop_menu_customer']       =	$this->mdropdown->drop_menu_customer();
        	$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation ','Invoice Number', 'Invoice Date', 'Vendor Name', 'Sales Amount', 'Status', 'Created By', 'Created On'); 
			$sessionArr=$this->session->all_userdata();
			$msg['notification'] = $sessionArr['successMsg'];
 			$auth_model = $this->authentication->auth_model; 
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'proes Order Management',
				'content'   =>$this->load->view('proforma_invoice/viewlist',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable($from_date1 = '', $to_date1 = '', $vendor_id = '', $status = '')
    {
    	$this->datatables->select('b.pro_id, b.pro_order, b.pro_order_date, q.con_company_name, b.pro_grand_total, b.pro_invoice_status, u.username, b.pro_created_on, v.dev_name, b.pro_person, b.pro_delivery_date');
       	$this->datatables->from('proforma_invoice AS b');  
       	$this->datatables->join('tbl_contacts AS q', 'q.con_id = b.pro_company_name','left');
       	$this->datatables->join('deliver_method AS v', 'v.dev_id = b.pro_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.pro_created_by','left');
		if(!empty($from_date1))
   		{
   			$this->datatables->where('pro_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('pro_order_date <=', $to_date1);
   		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('pro_company_name =', $vendor_id);
		}
		if($status !='')
   		{
			$this->datatables->where('b.pro_invoice_status =', $status);
		}
		$this->datatables->group_by('b.pro_id');
       	$this->datatables->where('status','1');
		$this->db->order_by('b.pro_id','DESC');
     	$this->datatables->edit_column('b.pro_id', '$1', "get_proforma_buttons('b.pro_id', 'Proforma_invoice/', 'b.pro_invoice_status')");
 		$this->datatables->edit_column('b.pro_order_date', '$1', 'get_dateformat(b.pro_order_date)');
		$this->datatables->edit_column('b.pro_created_on', '$1', "get_date_timeformat('b.pro_created_on')");
		$this->datatables->edit_column('b.pro_invoice_status', '$1', 'get_proforma_status("b.pro_invoice_status")');
      	echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$pro_company_name         =		$this->input->post('pro_company_name');
				$pro_reference            =		$this->input->post('pro_reference');
				$pro_order_date           =		$this->input->post('pro_order_date');
				$pro_person               =		$this->input->post('pro_person');
				$pro_despatch             =		$this->input->post('pro_despatch');
				$pro_destination          =		$this->input->post('pro_destination');
				$pro_terms_delivery       =		$this->input->post('pro_terms_delivery');
				$pro_credit_period        =		$this->input->post('pro_credit_period');
				$pro_payment_terms        =     $this->input->post('pro_payment_terms');
				
			
				$this->form_validation->set_rules('pro_company_name', 'Customer Name', 'required');
				
				if(!empty($pro_reference))
				{
					$this->form_validation->set_rules('pro_reference', 'Reference', 'required');
				}
				if(!empty($pro_order_date))
				{
					$this->form_validation->set_rules('pro_order_date', 'proes Order Date', 'required');
				}
				if(!empty($pro_person))
				{
					$this->form_validation->set_rules('pro_person', 'proes Order', 'required|callback_customAlpha');
				}
				if(!empty($pro_despatch))
				{
					$this->form_validation->set_rules('pro_despatch', 'Despatch Thru', 'required|callback_customAlpha');
				}
				if(!empty($pro_destination))
				{
				$this->form_validation->set_rules('pro_destination', 'Destinstion', 'required|callback_customAlpha');
				}
				if(!empty($pro_terms_delivery))
				{
				$this->form_validation->set_rules('pro_terms_delivery', 'Terms of Delivery', 'required');
				}
				if(!empty($pro_credit_period))
				{
				$this->form_validation->set_rules('pro_credit_period', 'Credit Period', 'required|numeric|greater_than[0.99]');
				}
				if(!empty($pro_payment_terms))
				{
				$this->form_validation->set_rules('pro_payment_terms', 'Credit Period', 'required|callback_customAlpha');
				}
				$pro_item_idArr =	$this->input->post('pro_item_id[]');
				if(!empty($pro_item_idArr))
				{
					$quantityArr 	= 	$this->input->post('quantity');
					foreach ($this->input->post('pro_item_id') as $key => $value)
					{
						$pro_item	=	$pro_item_idArr[$key];
						$qty 		=	$quantityArr[$key];
						$CheckAvailability	=	$this->mcommon->get_pro_item1($pro_item, $qty);	
						if($CheckAvailability == 0)
						{
							$this->form_validation->set_rules('quanti', 'Check Available Quantity', 'required');
						}
					}
				}

				if($this->form_validation->run() == TRUE) 
				{		
					if($this->input->post('pro_id')!='')
					{

						$tax 			= implode(',',$this->input->post('tax_type'));
						$tax_amount 	= implode(',',$this->input->post('total_tax_amt'));
							$pro_order_date		=	($this->input->post('pro_order_date')!='') ? date('Y-m-d', strtotime($this->input->post('pro_order_date'))) : date('Y-m-d');
						$pro_next_duedate	=	'';

						if($this->input->post('pro_credit_period'))
						{
							$pro_next_duedate = date('Y-m-d', strtotime($this->input->post('pro_credit_period').' days', strtotime($pro_order_date)));
						}


						$value_array 	= array(
							'pro_company_name'			=>	$this->input->post('pro_company_name'),
							'pro_customer_address'		=>	$this->input->post('pro_customer_address'),
							'pro_order'					=>	$this->input->post('pro_order'),
							'pro_order_date'			=>	($this->input->post('pro_order_date')!='') ? date('Y-m-d', strtotime($this->input->post('pro_order_date'))) : date('Y-m-d'),
							//'pro_delivery_date'			=>	($this->input->post('pro_delivery_date')!='') ? date('Y-m-d', strtotime($this->input->post('pro_delivery_date'))) : date('Y-m-d'),
							//'pro_delivery_method'		=>	$this->input->post('pro_delivery_method'),
							'pro_person'				=>	$this->input->post('pro_person'),
							'pro_reference'				=>	$this->input->post('pro_reference'),
							'pro_sub_total'				=> 	$this->input->post('sub_total'),
							'pro_tax_id'				=> 	$tax ,
							'pro_tax_amount'			=> 	$tax_amount,
							'pro_grand_total'			=>	$this->input->post('total'),
							'pro_invoice_status'		=>	$this->input->post('pro_invoice_status'),
							'status'					=> '1',
							'pro_customer_notes'		=>	$this->input->post('terms'),
							'pro_reference_date'		=>	$this->input->post('pro_reference_date'),
							'pro_despatch'				=>	$this->input->post('pro_despatch'),
							'pro_delivery_amount'       =>  $this->input->post('shipping_amount'),
							'pro_destination'			=>	$this->input->post('pro_destination'),
							'pro_discount'              =>  $this->input->post('discount'),
							'pro_terms_delivery'		=> 	$this->input->post('pro_terms_delivery'),
							'pro_payment_terms'			=>	$this->input->post('pro_payment_terms'),
							'pro_credit_period'			=>	$this->input->post('pro_credit_period'),
							'pro_next_duedate'			=>	$pro_next_duedate,
							'pro_created_by'			=> 	$this->auth_user_id,
							'pro_created_on'  			=> 	date('Y-m-d H:i:s')
						);

						$where_array=array(
									'pro_id'=>$this->input->post('pro_id')
											);

							

						$resultupdate=$this->mcommon->common_edit1('proforma_invoice',	$value_array,	$where_array);
				

						if($resultupdate)
						{
							$where	=	array('pro_id'=> $this->input->post("pro_id"));
							$result	=	$this->mcommon->common_delete('proforma_invoice_item',	$where);
							
							foreach ($this->input->post('pro_item_id') as $key => $value)
							{
								if($this->input->post('pro_item_id')[$key]!='')
								{
									$value_array1=array
									(									
										'pro_id'		=>  $this->input->post('pro_id'),
										'pro_item_id'	=>	$this->input->post('pro_item_id')[$key],
										//'unit'		=>	$this->input->post('unit')[$key],
										'quantity'		=>	$this->input->post('quantity')[$key],
										'price_amt'		=>	$this->input->post('price_amt')[$key],
										'pro_amount'	=> 	$this->input->post('amount')[$key],
									);
									$this->mcommon->common_insert('proforma_invoice_item',$value_array1);
								}
							}
							$where=array(
											'pro_id'=> $this->input->post('pro_id')
										);
							$delete=$this->mcommon->common_delete('proforman_invoice_tax',$where);

							foreach ($this->input->post('tax_type') as $key => $value)
							{
								$value_array3=array(
								'pro_id'				    => $resultupdate,
								'pro_tax_id'				=> $this->input->post('tax_type')[$key] ,
								'pro_tax_amount'			=> $this->input->post('total_tax_amt')[$key],
								);


									$pro_tax_amount			=$this->input->post('total_tax_amt')[$key];
							
								if($pro_tax_amount!=0)
								{


										$result = $this->mcommon->common_insert('proforman_invoice_tax',$value_array3);
								}
										
							}
					
						}
					}
					else
					{

						$tax 		= implode(',',$this->input->post('tax_type'));
						$tax_amount = implode(',',$this->input->post('total_tax_amt'));

						$pro_order_date		=	($this->input->post('pro_order_date')!='') ? date('Y-m-d', strtotime($this->input->post('pro_order_date'))) : date('Y-m-d');
						$pro_next_duedate	=	'';

						if($this->input->post('pro_credit_period'))
						{
							$pro_next_duedate = date('Y-m-d', strtotime($this->input->post('pro_credit_period').' days', strtotime($pro_order_date)));
						}


						$value_array=array(
						'pro_company_name'			=>  $this->input->post('pro_company_name'),
						'pro_customer_address'		=>	$this->input->post('pro_customer_address'),
						'pro_order'					=>  $this->proforma->getInvoiceNo(),
						'pro_order_date'			=>  $pro_order_date,
						//'pro_delivery_date'			=>  ($this->input->post('pro_delivery_date')!='') ? date('Y-m-d', strtotime($this->input->post('pro_delivery_date'))) : date('Y-m-d'),
						//'pro_delivery_method'		=>  $this->input->post('pro_delivery_method'),
						'pro_person'				=>  $this->input->post('pro_person'),
						'pro_reference'				=>  $this->input->post('pro_reference'),
						'pro_sub_total'				=>  $this->input->post('sub_total'),
						'pro_tax_id'				=>  $tax ,
						'pro_tax_amount'			=>  $tax_amount,
						'pro_grand_total'			=>	$this->input->post('total'),
						'status'					=> '1',
						'pro_reference_date'		=>	$this->input->post('pro_reference_date'),
						'pro_delivery_amount'       =>  $this->input->post('shipping_amount'),
						'pro_discount'              =>  $this->input->post('discount'),
						'pro_customer_notes'		=>	$this->input->post('terms'),
						'pro_despatch'				=>	$this->input->post('pro_despatch'),
						'pro_destination'			=>	$this->input->post('pro_destination'),
						'pro_terms_delivery'		=> 	$this->input->post('pro_terms_delivery'),
						'pro_payment_terms'			=>	$this->input->post('pro_payment_terms'),
						'pro_credit_period'			=>	$this->input->post('pro_credit_period'),
						'pro_next_duedate'			=>	$pro_next_duedate,
						'pro_created_by'			=>  $this->auth_user_id,
						'pro_created_on'  			=>  date('Y-m-d H:i:s')
						);

						$pro_id= $this->mcommon->common_insert('proforma_invoice',$value_array);


						foreach ($this->input->post('tax_type') as $key => $value)
						{
							$value_array3=array(
							'pro_id'				=> $pro_id,
							'pro_tax_id'				=> $this->input->post('tax_type')[$key],
							'pro_tax_amount'			=> $this->input->post('total_tax_amt')[$key],
							
							);

							$pro_tax_amount			=$this->input->post('total_tax_amt')[$key];

							if($pro_tax_amount!=0)
							{
								$result4 = $this->mcommon->common_insert('proforman_invoice_tax',$value_array3);
							}
						}
						if($pro_id)
						{
							$s = $this->proforma->set_pref_no('tbl_preferences', 'pro_inv_number');
							foreach($this->input->post('pro_item_id') as $key => $val)
							{
								if($this->input->post('quantity')[$key]!='')
								{
									$value_array1 = 
									array(									
										'pro_id'		=>	$pro_id,
										'pro_item_id'	=>	$this->input->post('pro_item_id')[$key],
										'quantity'		=>	$this->input->post('quantity')[$key],
										'price_amt'		=>	$this->input->post('price_amt')[$key],
										'pro_amount'	=> 	$this->input->post('amount')[$key],
									);
									$value_array=$this->mcommon->common_insert('proforma_invoice_item',$value_array1);
								}
							}
						}
					}
				}
			}
			if($pro_id)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Proforma_invoice/manage'));
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Proforma_invoice/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
		}
	}

	public function customAlpha( $str = '' ) 
	{
	    if(!preg_match('/^[A-Za-z0-9 .,\-]+$/i',$str) )
	    {
	        return false;
	    }
	}
	
	public function operation( $id = '' )
	{
		$where_array=array('pro_id'=>$id);
		$data['value']=$this->mcommon->get_fulldata('proforma_invoice',$where_array);
		$data['evalue']=$this->proforma->get_data_product($id);
		$this->index($data);
	}
	
	public function deleteproduct()
	{
		$res = $this->mcommon->common_delete('proforma_invoice_item',array('pro_item_id' => $this->input->get('pro_item_id') ));
	}

	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
			$value_array=array(
								'status'		     =>	0,
								'pro_created_on'	 => $this->auth_user_id,
								'pro_created_by'     => date('Y-m-d H:i:s'),
							  );
			
			$result=$this->mcommon->common_edit('proforma_invoice',$value_array,array('pro_id' =>$id));
			if($result)
			{
				$this->session->set_userdata('successMsg', 'Deleted Successfully...');
				redirect(base_url('Proforma_invoice/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
		}
	}

	public function getPartNoContent()
	{
		$msg['i']=$this->input->get('i');
		$msg['drop_menu_product_item']  =  $this->mdropdown->drop_menu_product_item();
		$msg['drop_menu_unit']          =  $this->mdropdown->drop_menu_unit();
		$msg['drop_menu_unit1']         =  $this->mdropdown->drop_menu_unit1();
		echo $this->load->view('proforma_invoice/view_form_new',$msg,TRUE);
	}

	public function getProductPriceDetails()
	{
			$res = $this->proforma->get_data($this->input->get('pro_item_id'));
			$res= implode('|',$res);
			echo $res;	 
	}

	public function menu_terms()
	{
			$res = $this->proforma->menu_terms($this->input->get('payment_terms_id'));
			$res= implode('|',$res);
			echo $res;	 
	}

	public function loadaddress()
	{
			$Customer_id 		= $this->input->get('con_id');
			$drop_menu_address 	= $this->mcommon->drop_menu_address($Customer_id);
			echo form_dropdown('sal_customer_address', $drop_menu_address, set_value('sal_customer_address', (isset($sal_customer_address)) ? $sal_customer_address : ''), $attrib);
	}
	
	public function printSalesorder( $id = '' )
	{
		if($this->require_min_level(1))
	    {
			$msg['value']                 =		$this->mcommon->get_fulldata('proforma_invoice',array('pro_id'=>$id));
			$msg['organization_detail']   =		$this->mcommon->get_fulldata('tbl_company_profile',array('c_id'=>'1'));
			$msg['spvalue']               =		$this->proforma->get_data_product($id);
			$company_detail               =		$this->proforma->get_company_detail($id);
			$where_array2                 =		array('con_id'=>$company_detail);
			$where_array6                 =		array('invoice_id'=>'1');
			$msg['company_detail']        =		$this->mcommon->get_fulldata('tbl_contacts',$where_array2);
			$msg['tbl_preferences']       =		$this->proforma->getInvoiceNo();
			$msg['sales_order_tax']       =		$this->proforma->sales_order_tax($id);
		}
		
		$this->load->view('proforma_invoice/print_proforma_invoice', $msg); 
	}

	function mailPo( $id = '' )
 	{
 		$id=$this->input->post('id');
		$msg['value']                       =		$this->mcommon->get_fulldata('proforma_invoice',array('pro_id'=>$id));
		$msg['organization_detail']         =		$this->mcommon->get_fulldata('tbl_company_profile',array('c_id'=>'1'));
		$msg['spvalue']                     =		$this->proforma->get_data_product($id);
		$company_detail                     =		$this->proforma->get_company_detail($id);
		$msg['payment_detail']              =		$this->mcommon->payment_detail($id);
		$msg['company_detail']              =		$this->mcommon->get_fulldata('tbl_contacts',array('con_id'=>$company_detail));
		$msg['tbl_preferences']             =		$this->proforma->tbl_preferences();


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
        $body	=	$this->load->view('proforma_invoice/print_email',$msg, TRUE);
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
			$pro_order                = $row->pro_order;
			
		}

		$this->load->library('email');
		$this->email->from($con_email,$c_org_name);
		$list = array($c_org_name);
        $this->email->to('admin@heuristicsoft.com');
		$this->email->subject('Proforma Invoice #'.$pro_order );

		$data = 'Please find below is the proforma invoice for the products required by us.<br/>';
		$body.= 'Dear '.$con_first_name.',<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
		$body.= $content.'<br/><br/>';
        $body.=	$this->load->view('proforma_invoice/print_email',$msg, TRUE);

		$this->email->message($body); 

		//$this->email->message($this->load->view('purchase_order/email_po', $data, TRUE));
		if($this->email->send()) 
		{
			echo 'Email sent successfully....';	
			//redirect(base_url('Purchase_order/manage'), 'refresh');

		}
		else
		{
			echo 'Error in sending Email....';
			//redirect(base_url('Purchase_order/manage'), 'refresh');
			//print_r($this->email->print_debugger());

		}
 		//echo $this->load->view('proforma_invoice/print_email',$msg);
 	}

 	public function paymentdetail( $id = '' )
 	{
 		if($this->require_min_level(1))
        {
			$msg['value']                  =	$this->mcommon->get_fulldata('proforma_invoice',array('pro_id'=>$id));
			$msg['organization_detail']    =	$this->mcommon->get_fulldata('tbl_company_profile',array('c_id'=>'1'));
			$msg['spvalue']                =	$this->proforma->get_data_product($id);
			$company_detail                =	$this->proforma->get_company_detail($id);
			$msg['company_detail']         =	$this->mcommon->get_fulldata('tbl_contacts',array('con_id'=>$company_detail));
			$msg['tbl_preferences']        =	$this->proforma->getInvoiceNo();
			$msg['sales_order_tax']        =	$this->proforma->sales_order_tax($id);
			$sessionArr                    =	$this->session->all_userdata();
			$msg['form_url1']              =	'sales_order/paymentdetail/'.$id;
			$msg['notification']           = 	$sessionArr['successMsg'];
			$msg['drop_menu_accountheads'] =	$this->mdropdown->drop_menu_accountheads();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('proforma_invoice/paymentdetail',$msg,TRUE)
			);

			
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
 	}

 	function proformaform( $id = '' )
 	{
 		$msg['form_url']                 =		'sales_order/add';
 		$msg['drop_menu_customer']       =	     $this->mdropdown->drop_menu_customer();
		$msg['drop_menu_item']           =		$this->mdropdown->drop_menu_item();
		$msg['drop_menu_tax1']           =		$this->mdropdown->drop_menu_tax1();
		$msg['drop_menu_product_item']   =		$this->mdropdown->drop_menu_product_item();
		$msg['drop_menu_ship_pref']      =		$this->mdropdown->drop_menu_ship_pref();
		$msg['drop_menu_unit']           =		$this->mdropdown->drop_menu_unit();
		$msg['drop_menu_address']        =		$this->mdropdown->drop_menu_address1();
		$msg['drop_menu_accountheads']   =		$this->mdropdown->drop_menu_accountheads();
		$msg['drop_menu_terms']          =		$this->mdropdown->drop_menu_terms();
		$msg['pro_order']                =		$this->proforma->getInvoiceNo();
		$msg['notification']             = 		$sessionArr['successMsg'];
 		$where_array                     =		array('pro_id'=>$id);
		$msg['value']                    =		$this->mcommon->get_fulldata('proforma_invoice',$where_array);

		$msg['evalue']                   =		$this->proforma->get_data_product($id);
 		$sessionArr                      =		$this->session->all_userdata();
		$msg['form_url1']                =		'sales_order/paymentdetail/'.$id;
		$msg['notification']             = 		$sessionArr['successMsg'];

 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('proforma_invoice/profomaform',$msg,TRUE)
			);

			
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
 	}

	public function viewdetails()
	{
		$id = $this->input->get('pro_item_id');
		$data['details'] = $this->mcommon->get_po_details($id);	
		echo $this->load->view('sales_order/sal_detail', $data,TRUE);
	}
}