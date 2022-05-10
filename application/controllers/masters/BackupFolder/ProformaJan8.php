<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proforma extends MY_Controller {

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
			$msg['form_url']		=	'Proforma/add';
	        $msg['form_toptittle']	=	'Proforma Management';
        	$msg['datatable_url']	=	'Proforma/datatable';
        	$msg['list_tittle']		=	'Proforma list';
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
			$msg['sal_order']				=	$this->sal_common->GetProformaNo();
			$msg['drop_menu_bank']	=	$this->mdropdown->drop_menu_bank();
			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model; 
 			$sessionArr						=	$this->session->all_userdata();
			
 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Invoice Management',
								'content'   =>$this->load->view('proforma_invoice/viewform',$msg,TRUE)
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
			$msg['inv_status']      =$this->input->post('inv_status');	
			$msg['form_url']		=	'Proforma/add';
	        $msg['form_tittle']		=	'Proforma Management';
	        $msg['form_toptittle']	=	'Proforma Management';
        	$msg['list_tittle']		=	'Proforma list';

			if($this->input->post('searchFilter')=='1')
        	{

        		if($msg['inv_status']=='' && $msg['vendor_id']=='' )
        		{
        				
        			$msg['datatable_url']	=	'Proforma/datatable_from_and_to/'.$from_date1.'/'.$to_date1;
        		}
        		if($msg['inv_status']!=='' && $msg['vendor_id']=='' )
        		{
        				
        			$msg['datatable_url']	=	'Proforma/datatable_no_vendor_id/'.$from_date1.'/'.$to_date1.'/'.$msg['inv_status'];
        		}
        		if($msg['inv_status']=='' && $msg['vendor_id']!='' )
        		{
        				
        			$msg['datatable_url']	=	'Proforma/datatable_no_inv_status/'.$from_date1.'/'.$to_date1.'/'.$msg['vendor_id'];
        		}
        			if($msg['inv_status']!=='' && $msg['vendor_id']!='' )
        		{
        				
        			$msg['datatable_url']	=	'Proforma/datatable_all/'.$from_date1.'/'.$to_date1.'/'.$msg['vendor_id'].'/'.$msg['inv_status'];
        		}



        
        	}
        	else
        	{
        		$msg['datatable_url']	=	'Proforma/datatable';
        	}

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation', 'Proforma Number', 'Proforma Date', 'Client Name', 'Sales Amount', 'Proforma Status', 'Created By', 'Created On'); 
			$msg['drop_menu_customer']		=	$this->mdropdown->drop_menu_client();
			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model; 

 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Proforma Management',
								'content'   =>$this->load->view('proforma_invoice/viewlist',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable($from_date1='', $to_date1='', $vendor_id='', $payment_status='', $inv_status='')
    {
		$this->datatables->select('b.per_sal_id, b.per_sal_order, b.per_sal_order_date, q.client_name, b.per_sal_grand_total,b.per_sal_invoice_status, u.username, b.per_sal_created_on, b.per_sal_delivery_date');
		$this->datatables->from('per_sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.per_sal_company_name','left');
		// $this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.per_sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('per_sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('per_sal_order_date <=', $to_date1);
		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('per_sal_company_name =', $vendor_id);
		}
		
		if($inv_status !='')
   		{
			$this->datatables->where('b.per_sal_invoice_status =', $inv_status);
		}
		$this->datatables->group_by('b.per_sal_id');
		$this->db->order_by('b.per_sal_id','DESC');
		$this->datatables->edit_column('b.per_sal_id', '$1', "get_buttons_new1('b.per_sal_id', 'Proforma/', 'b.per_sal_invoice_status')");
		
		$this->datatables->edit_column('b.per_sal_order_date', '$1', 'get_dateformat(b.per_sal_order_date)');
		$this->datatables->edit_column('b.per_sal_delivery_date', '$1', 'get_date_timeformat(b.per_sal_delivery_date)');
		$this->datatables->edit_column('b.per_sal_created_on', '$1', "get_date_timeformat('b.per_sal_created_on')");
		$this->datatables->edit_column('b.per_sal_invoice_status', '$1', 'get_status2("b.per_sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
    function datatable_no_vendor_id($from_date1, $to_date1,$status)
    {
		$this->datatables->select('b.per_sal_id, b.per_sal_order, b.per_sal_order_date, q.client_name, b.per_sal_grand_total,b.per_sal_invoice_status, u.username, b.per_sal_created_on, b.per_sal_delivery_date');
		$this->datatables->from('per_sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.per_sal_company_name','left');
		// $this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.per_sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('per_sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('per_sal_order_date <=', $to_date1);
		}
		if($status =='1')
   		{
			$this->datatables->where('b.per_sal_invoice_status =','1');
		}
		if($inv_status =='0')
   		{
			$this->datatables->where('b.per_sal_invoice_status =', '0');
		}
		
		$this->datatables->group_by('b.per_sal_id');
		$this->db->order_by('b.per_sal_id','DESC');
		$this->datatables->edit_column('b.per_sal_id', '$1', "get_buttons_new1('b.per_sal_id', 'Proforma/', 'b.per_sal_invoice_status')");
		
		$this->datatables->edit_column('b.per_sal_order_date', '$1', 'get_dateformat(b.per_sal_order_date)');
		$this->datatables->edit_column('b.per_sal_delivery_date', '$1', 'get_date_timeformat(b.per_sal_delivery_date)');
		$this->datatables->edit_column('b.per_sal_created_on', '$1', "get_date_timeformat('b.per_sal_created_on')");
		$this->datatables->edit_column('b.per_sal_invoice_status', '$1', 'get_status2("b.per_sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
    function datatable_from_and_to($from_date1, $to_date1)
    {
		$this->datatables->select('b.per_sal_id, b.per_sal_order, b.per_sal_order_date, q.client_name, b.per_sal_grand_total,b.per_sal_invoice_status, u.username, b.per_sal_created_on, b.per_sal_delivery_date');
		$this->datatables->from('per_sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.per_sal_company_name','left');
		// $this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.per_sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('per_sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('per_sal_order_date <=', $to_date1);
		}
		
		$this->datatables->group_by('b.per_sal_id');
		$this->db->order_by('b.per_sal_id','DESC');
		$this->datatables->edit_column('b.per_sal_id', '$1', "get_buttons_new1('b.per_sal_id', 'Proforma/', 'b.per_sal_invoice_status')");
		
		$this->datatables->edit_column('b.per_sal_order_date', '$1', 'get_dateformat(b.per_sal_order_date)');
		$this->datatables->edit_column('b.per_sal_delivery_date', '$1', 'get_date_timeformat(b.per_sal_delivery_date)');
		$this->datatables->edit_column('b.per_sal_created_on', '$1', "get_date_timeformat('b.per_sal_created_on')");
		$this->datatables->edit_column('b.per_sal_invoice_status', '$1', 'get_status2("b.per_sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
	function datatable_no_inv_status($from_date1, $to_date1,$vendor_id)
    {
		$this->datatables->select('b.per_sal_id, b.per_sal_order, b.per_sal_order_date, q.client_name, b.per_sal_grand_total,b.per_sal_invoice_status, u.username, b.per_sal_created_on, b.per_sal_delivery_date');
		$this->datatables->from('per_sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.per_sal_company_name','left');
		// $this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.per_sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('per_sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('per_sal_order_date <=', $to_date1);
		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('per_sal_company_name =', $vendor_id);
		}
		
		$this->datatables->group_by('b.per_sal_id');
		$this->db->order_by('b.per_sal_id','DESC');
		$this->datatables->edit_column('b.per_sal_id', '$1', "get_buttons_new1('b.per_sal_id', 'Proforma/', 'b.per_sal_invoice_status')");
		
		$this->datatables->edit_column('b.per_sal_order_date', '$1', 'get_dateformat(b.per_sal_order_date)');
		$this->datatables->edit_column('b.per_sal_delivery_date', '$1', 'get_date_timeformat(b.per_sal_delivery_date)');
		$this->datatables->edit_column('b.per_sal_created_on', '$1', "get_date_timeformat('b.per_sal_created_on')");
		$this->datatables->edit_column('b.per_sal_invoice_status', '$1', 'get_status2("b.per_sal_invoice_status")');
		
		echo $this->datatables->generate();
    }
     function datatable_all($from_date1, $to_date1,$vendor_id,$status)
    {
		$this->datatables->select('b.per_sal_id, b.per_sal_order, b.per_sal_order_date, q.client_name, b.per_sal_grand_total,b.per_sal_invoice_status, u.username, b.per_sal_created_on, b.per_sal_delivery_date');
		$this->datatables->from('per_sales_order AS b');  
		$this->datatables->join('tbl_client AS q', 'q.id = b.per_sal_company_name','left');
		// $this->datatables->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		$this->datatables->join('users AS u', 'u.user_id = b.per_sal_created_by','left');
		$this->datatables->where('status', '1');

		if(!empty($from_date1))
   		{
   			$this->datatables->where('per_sal_order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('per_sal_order_date <=', $to_date1);
		}
		if($vendor_id!='0')
		{
			$this->datatables->where('per_sal_company_name =', $vendor_id);
		}
		if($status =='1')
   		{
			$this->datatables->where('b.per_sal_invoice_status =','1');
		}
		if($inv_status =='0')
   		{
			$this->datatables->where('b.per_sal_invoice_status =', '0');
		}
		
		$this->datatables->group_by('b.per_sal_id');
		$this->db->order_by('b.per_sal_id','DESC');
		$this->datatables->edit_column('b.per_sal_id', '$1', "get_buttons_new1('b.per_sal_id', 'Proforma/', 'b.per_sal_invoice_status')");
		
		$this->datatables->edit_column('b.per_sal_order_date', '$1', 'get_dateformat(b.per_sal_order_date)');
		$this->datatables->edit_column('b.per_sal_delivery_date', '$1', 'get_date_timeformat(b.per_sal_delivery_date)');
		$this->datatables->edit_column('b.per_sal_created_on', '$1', "get_date_timeformat('b.per_sal_created_on')");
		$this->datatables->edit_column('b.per_sal_invoice_status', '$1', 'get_status2("b.per_sal_invoice_status")');
		
		echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{	
			if(isset($_POST['Submit']))
			{

				$sal_company_name		=	$this->input->post('sal_company_name');
				$company_abb		=	$this->input->post('company_abb');

				$sal_reference			=	$this->input->post('sal_reference');
				
				$sal_order_date			=	$this->input->post('sal_order_date');
				$this->form_validation->set_rules('sal_company_name', 'Client  Name', 'required');
				if(!empty($sal_reference))
				{
					$this->form_validation->set_rules('sal_reference', 'Reference', 'required');
				}
				if(!empty($sal_order_date))
				{
					$this->form_validation->set_rules('sal_order_date', 'Invoice Date', 'required');
				}
				// for ($i=0; $i < $this->input->post('attproduct'); $i++)
				// { 
					
				// 	$this->form_validation->set_rules('item['.$i.']', 'Item', 'required');
				// }
				
				if($this->form_validation->run() == TRUE) 
				{
					if($this->input->post('sal_id')!='')
					{
			
						$sal_order_date		=	($this->input->post('sal_order_date')!='') ? date('Y-m-d', strtotime($this->input->post('sal_order_date'))) : date('Y-m-d');
						$value_array 	= array(
													'per_sal_company_name'			=>  $sal_company_name,
													'per_sal_client_rep' =>($this->input->post('sal_client_rep')!='') ? ($this->input->post('sal_client_rep')) : '',
												
													'per_sal_order'					=> 	$this->input->post('sal_order'),
													'per_sal_order_date'			=> $sal_order_date,
													
													'per_sal_sub_total' =>$this->input->post('sub_t'),
													'per_sal_tax_amount' => $this->input->post('vat_amount'),
													'per_sal_discount' => $this->input->post('discount'),
													'per_sal_grand_total'			=>	$this->input->post('total'),
													'per_sal_invoice_status'		=>	$this->input->post('sal_invoice_status'),
													'status'					=> '1',
													'remarks' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',
													'sal_bank' =>($this->input->post('client_bank')!='') ? ($this->input->post('client_bank')) : '',
													
													'per_sal_created_by'			=>  $this->auth_user_id
												// 	'sal_created_on'  			=>  date('Y-m-d H:i:s')
						);

						$value_array['po_num']= $this->input->post('po_no');
						$value_array['payment_term']= $this->input->post('payment_term');

						
						$value_array['our_ref']= $this->input->post('our_ref');	
					

						$where_array	=	array('per_sal_id'=>$this->input->post('sal_id'));
						$resultupdate	=	$this->sal_common->common_edit1('per_sales_order',$value_array,$where_array);
						

						if($resultupdate)
						{
							$where		=	array('per_sal_id'=> $this->input->post("sal_id"));
							$result		=	$this->sal_common->common_delete('per_sales_order_item',$where);
	
						   if($company_abb=="NH" ||$company_abb=="ARA")
							{
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic				    =	$this->input->post('itemarabic');
							$unitengArr				=	$this->input->post('uniteng');
							// $unitarabicArr			= 	$this->input->post('unitarabic');
							$qtyArr		= 	$this->input->post('qty');
							$unitpriceArr	        =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');

						    foreach($item_Arr as $key => $val)
							{
								if($item_Arr[$key]!='')
								{
									$value_array1 = array
														(									
															'per_sal_id'		=>	$this->input->post('sal_id'),
															'item_description'	=>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
														
															'uniteng'		=>	$unitengArr[$key],
															
															'qty'		=>	$qtyArr[$key],
															'unit_price'     => $unitpriceArr[$key],
														
															'total_cost'	=> $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('per_sales_order_item',$value_array1);
								}

							}
						}
					

							
						
								
						}
					}
					else
					{
					

						$sal_order_date		=	($this->input->post('sal_order_date')!='') ? date('Y-m-d', strtotime($this->input->post('sal_order_date'))) : date('Y-m-d');
						$proformaNumber 	= 	$this->sal_common->GetProformaNo();
						$value_array 	=	array(
													'per_sal_company_name'			=>  $sal_company_name,
													'per_sal_client_rep' =>($this->input->post('sal_client_rep')!='') ? ($this->input->post('sal_client_rep')) : '',
												
													'per_sal_order'					=> 	$proformaNumber,
													'per_sal_order_date'			=>  $sal_order_date,
													
													'per_sal_sub_total' =>$this->input->post('sub_t'),
													'per_sal_tax_amount' => $this->input->post('vat_amount'),
													// 'sal_discount' => $this->input->post('discount'),
													'per_sal_grand_total'			=>	$this->input->post('total'),
													'per_sal_invoice_status'		=>	'0',
													'status'					=> '1',
													'remarks' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'sal_bank' =>($this->input->post('client_bank')!='') ? ($this->input->post('client_bank')) : '',											
													'per_sal_created_by'			=>  $this->auth_user_id,
													'per_sal_created_on'  			=>  date('Y-m-d H:i:s')
												);
					
							$value_array['po_num']= $this->input->post('po_no');
							$value_array['payment_term']= $this->input->post('payment_term');

					
						    $value_array['our_ref']= $this->input->post('our_ref');	
					// print_r($value_array);die;
	
						$sal_id= $this->sal_common->common_insert('per_sales_order',$value_array);

						$this->sal_common->set_pref_no('tbl_preferences', 'pro_inv_number');
					
					
						if($sal_id)
						{	
							
							
							if($company_abb=="NH"|| $company_abb=="ARA")
							{
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic				    =	$this->input->post('itemarabic');
							$unitengArr				=	$this->input->post('uniteng');
						
							$qtyArr		= 	$this->input->post('qty');
							$unitpriceArr	        =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');

							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'per_sal_id'		=>	$sal_id,
															'item_description'	=>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															'uniteng'		=>	$unitengArr[$key],
														
															'qty'		=>	$qtyArr[$key],
															'unit_price'     => $unitpriceArr[$key],
														
															'total_cost'	=> $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('per_sales_order_item',$value_array1);
								}

							}
						}
						
							
							
						}
					}
				}
			}

			if($sal_id)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Proforma/manage'));
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Proforma/manage'), 'refresh');
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
			
		$where_array=array('per_sal_id'=>$id);
		$data['value']=$this->sal_common->get_fulldata('per_sales_order',$where_array);
		
		$data['evalue']=$this->sal_common->get_data_proforma_product($id);
	
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

	public function loadaddress()
	{
			$Customer_id 		= $this->input->get('con_id');
			$drop_menu_address 	= $this->sal_common->drop_menu_client_rep($Customer_id);
			echo form_dropdown('sal_client_rep', $drop_menu_address, set_value('sal_client_rep', (isset($sal_client_rep)) ? $sal_client_rep : ''), $attrib);
	}
	
	public function printSalesorder( $id='' )
	{
		$organization_detail    =   $this->common->getCompanyProfiles('1');	
		foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
		
				$data['spvalue']=$this->sal_common->get_data_proforma_product1($id);
		

		// if($company_abb=="NH")
		// {

		// 		$data['spvalue']=$this->sal_common->get_data_product11($id);
		// }
		$bank_id				   =	$this->sal_common->get_proforma_bank_id($id);
		// print_r($bank_id);die;
		$where_array	=	array('per_sal_id'=>$id);
		$data['value']	=	$this->sal_common->get_fulldata('per_sales_order',$where_array);

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
		
		$this->load->view('proforma_invoice/print_invoicesARA1', $data); 
		
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
			$msg['value']=$this->sal_common->get_fulldata('per_sales_order',array('per_sal_id'=>$id));
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

				$msg['spvalue']=$this->sal_common->get_data_proforma_product1($id);
		// }

		// if($company_abb=="NH")
		// {

		// 		$msg['spvalue']=$this->sal_common->get_data_product11($id);
		// }
		


		$company_detail=$this->sal_common->get_company_detail_proforma($id);
	
		
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
		$msg['form_url1']='Proforma/paymentadd/'.$id;
		$msg['notification'] = $sessionArr['successMsg'];
		$msg['drop_menu_accountheads']=$this->common->drop_menu_accountheads();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Proforma Management',
				'content'   =>$this->load->view('proforma_invoice/paymentdetail',$msg,TRUE)
			);

			
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
 	}
 	function ApplyToInvoice($per_id ='')
 	{
 		if($this->require_min_level(1))
		{
 		$per_id=$this->input->post('id');
 		$msg['value']=$this->sal_common->get_fulldata('per_sales_order',array('per_sal_id'=>$per_id));
 		$msg['spvalue']=$this->sal_common->get_data_proforma_product1($per_id);

			foreach($msg['value']->result() as $row)
			{
				$sal_customer_address       = $row->per_sal_customer_address;
    			$sal_order_date             = $row->per_sal_order_date; 
    			$sal_company_name           = $row->per_sal_company_name;
    			$sal_reference              = $row->per_sal_reference; 
    			$sal_order                  = $row->per_sal_order; 
    			$sal_person                 = $row->per_sal_person;    
    			$sal_delivery_date          = $row->per_sal_delivery_date;
    			$sal_customer_notes         = $row->per_sal_customer_notes;  
    			$sal_sub_total              = $row->per_sal_sub_total;
    			$sal_discount               = $row->per_sal_discount;
    			$sal_grand_total            = $row->per_sal_grand_total;
    			$sal_tax_amount             = $row->per_sal_tax_amount;
    			$sal_tax_id                 = $row->per_sal_tax_id;
    			$sal_delivery_amount        = $row->per_sal_delivery_amount;
    			$sal_created_on             = $row->per_sal_created_on;
    			$sal_created_by             = $row->per_sal_created_by;
    			$po_no                       = $row->po_num;
    			$payment_term                = $row->payment_term;
    			$remarks = $row->remarks;
    			$our_ref =$row->our_ref; 
    			$attain = $row->per_sal_client_rep;
    			$sal_bank = $row->sal_bank;
    			
    		}
    		$invoiceDraftNumber 	= 	$this->sal_common->getInvoiceDraftNo();

    		$value_array 	=	array(
													'sal_company_name'			=>  $sal_company_name,
													'sal_client_rep'    =>      ($attain!='') ? ($attain) : '',
												
													'sal_order'					=> 	$invoiceDraftNumber,
													'sal_order_date'			=>  date('Y-m-d H:i:s'),
													
													'sal_sub_total' =>$sal_sub_total,
													'sal_tax_amount' => $sal_tax_amount ,
													// 'sal_discount' => $this->input->post('discount'),
													'sal_grand_total'			=>	$sal_grand_total ,
													'sal_invoice_status'		=>	'0',
													'status'					=> '1',
													'remarks' => ($remarks!='') ? ($remarks) : '',	
													'sal_bank' =>($sal_bank !='') ? ($sal_bank ) : '',											
													'sal_created_by'			=>  $this->auth_user_id,
													'sal_created_on'  			=>  date('Y-m-d H:i:s')
												);
					
							$value_array['po_num']= $po_no ;
							$value_array['payment_term']= $payment_term ;

					
						    $value_array['our_ref']= $our_ref;	
					
	
						$sal_id= $this->sal_common->common_insert('sales_order',$value_array);
						
					if($sal_id)
					{
				    
					foreach($msg['spvalue'] as $key =>$row)
					{

							 $pro_item_name    = $row->item_description;
      						 $discriptionArabic    = $row->item_description_arabic;
                             $unit     = $row->uniteng;
                             $qty         = $row->qty;
                             $unit_price           = $row->unit_price;
                             $total            = $row->total_cost;
     
						      $value_array1 = array
														(									
															'sal_id'		=>	$sal_id,
															'item_description'	=>	$pro_item_name,
															'item_description_arabic'	=>	$discriptionArabic,
															'uniteng'		=>	 $unit,
															'qty'		=>	$qty,
															'unit_price'     => $unit_price,
															'total_cost'	=> $total	
														);
					      $this->sal_common->common_insert('sales_order_item',$value_array1);

					}
					   $value_array_per 	=	array( 'per_sal_invoice_status'  => '1',);
					   $where_array_per 	=	array('per_sal_id' =>$per_id);
					   $this->sal_common->common_edit('per_sales_order',$value_array_per,$where_array_per);
					   $this->sal_common->set_pref_no('tbl_preferences', 'inv_number_draft');
					}
			


   $this->session->set_userdata('successMsg', 'Proforma updated as Invoice...');
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
//     $sal_order1                  = explode('-',$data);
//     $elements = array();
// 	foreach($sal_order1 as $data1) {
//     $elements[] = $data1 ;
// 	}
// 	$dd =  implode('/', $elements);
// 	$name1                  = explode('-',$name);
//     $elements1 = array();
// 	foreach($name1 as $data2) {
//     $elements1[] = $data2 ;
// 	}
// 	$name2 =  implode(' ', $elements1);

// 	$vat1                  = explode('-',$vat_no);
//     $elements2 = array();
// 	foreach($vat1 as $data3) {
//     $elements2[] = $data3 ;
// 	}
// 	$vat =  implode(' ', $elements2);

//     $Qr_data .= "Vendor Name :".$name2."\n";
//     $Qr_data .= "VAT Number  :".$vat."\n";
//     $Qr_data .= "Date & Time :".$date.' '.$time."\n";
//     $Qr_data .= "VAT Amount :".$tax."\n";
//     $Qr_data .= "Total Amount :".$total."\n";
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
	$invoiceNumber 	= 	$this->sal_common->getInvoiceDraftNo();
	echo $invoiceNumber;
}
public function get_invoice_no()
{
	$invoiceNumber 	= 	$this->sal_common->getInvoiceNo();
	echo $invoiceNumber;
}
public function GetProformaNo()
{
	$proformaNumber 	= 	$this->sal_common->GetProformaNo();
	echo $proformaNumber;
}
}