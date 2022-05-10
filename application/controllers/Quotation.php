<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
			$this->load->model('Prefs','pre',TRUE);
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->library('upload');
		$this->load->helper('datatables_helper');
		$this->load->model('Mdropdown','mdropdown',TRUE);
		$this->load->model('Purchaseorder','mpurchase',TRUE);
		$this->load->model('Sal_common_model','sal_common',TRUE);
			$this->load->library('Ciqrcode');
		

	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'Quotation/add';
	        $msg['form_toptittle']	=	'Quotation Management';
        	// $msg['datatable_url']	=	'Quotation/datatable';
        	$msg['list_tittle']		=	'Quotation list';
        	//$msg['back_url']='masters/Maincontacts/add';
        	//$msg['back_urlstatus']='1';
        	$msg['organization_detail']    =   $this->mcommon->getCompanyProfiles('1');
        	// $msg['drop_menu_vendor']	=	$this->mdropdown->drop_menu_vendor1();
        	$msg['drop_menu_vendor']	    =	$this->mdropdown->drop_menu_client();
        	$msg['drop_menu_payment_terms'] = $this->mdropdown->drop_menu_payment_terms();
			$msg['drop_menu_customer']		=	$this->mdropdown->drop_menu_customer();
			$msg['drop_menu_item']			=	$this->mdropdown->drop_menu_item();
			$msg['drop_menu_tax1']			=	$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
			$msg['drop_menu_ship_pref']		=	$this->mdropdown->drop_menu_ship_pref();
			$msg['drop_menu_unit']			=	$this->mdropdown->drop_menu_unit();
			$msg['drop_menu_accountheads']	=	$this->mdropdown->drop_menu_accountheads();
			$qus_prifix						=	$this->sal_common->getQuotationprifix();
			$qus_number						=	$this->sal_common->getQuotationNumber();
			$qus_sufix						=	$this->sal_common->getQuotationSufix();
			$qus_padd_num = str_pad($qus_number, 4, "0", STR_PAD_LEFT);
			$msg['quotation_num'] = $qus_prifix.$qus_padd_num.$qus_sufix;
			// $msg['quotation_num']			=	$this->sal_common->getQuotationNo();
			$msg['drop_menu_bank']	        =	$this->mdropdown->drop_menu_bank();
			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model; 
 			$sessionArr						=	$this->session->all_userdata();
 			$msg['drop_menu_tax_item'] = $this->mdropdown->drop_menu_invoice_tax_item();
 			// $msg['drop_menu_currency'] = $this->mdropdown->drop_menu_currency();
 			$msg['drop_menu_quotation_validity'] = $this->mdropdown->drop_menu_quotation_validity();
			
 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Quotation Management',
								'content'   =>$this->load->view('quotation/add_new_quotation',$msg,TRUE)
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

			$msg['form_url']           =	'Quotation/add';
	        $msg['form_tittle']        =	'Quotation Management';
	        $msg['form_toptittle']     =	'Quotation Management';
			$msg['datatable_url']      =	'Quotation/datatable1';
        	

        	$from_date 			=   $this->input->post('from_date');
        	$from_date1 		= 	date("Y-m-d", strtotime($from_date));
        	$to_date  			= 	$this->input->post('to_date');
        	$to_date1 			= 	date("Y-m-d", strtotime($to_date));
			$vendor_id  		=	$this->input->post('vendor_id');
			$msg['status']      =	$this->input->post('status');

			if($this->input->post('searchFilter')=='1')
        	{
        		$msg['datatable_url']	=	'Quotation/datatable1/'.$from_date1.'/'.$to_date1.'/'.$vendor_id.'/'.$msg['status'];
        	}
        	else
        	{
        		$msg['datatable_url']	=	'Quotation/datatable1';
        	}
        	$msg['drop_menu_customer']       =	$this->mdropdown->drop_menu_customer();
        	$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation ','Quotation Number', 'Quotation Date','Revision','Client', 'Subject', 'Total Amount'); 
			$sessionArr=$this->session->all_userdata();
			$msg['notification'] = $sessionArr['successMsg'];
 			$auth_model = $this->authentication->auth_model; 
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'proes Order Management',
				'content'   =>$this->load->view('quotation/viewlist',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable1($from_date1 = '', $to_date1 = '', $vendor_id = '', $status = '')
    {
    	$this->datatables->select('b.quo_id,b.quotation_no,b.quotation_date,b.qus_rev,c.client_name, b.subject, b.quotation_grand_total');
       	$this->datatables->from('quotation AS b');  
       	$this->datatables->join(' tbl_client AS c', 'c.id = b.quotation_vendor','left');
		// $this->datatables->join('users AS u', 'u.user_id = b.quo_created_by','left');
		if(!empty($from_date1))
   		{
   			$this->datatables->where('quo_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('quo_date <=', $to_date1);
   		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('quo_company_name =', $vendor_id);
		}
		if($status !='')
   		{
			$this->datatables->where('b.quo_status =', $status);
		}
		$this->datatables->group_by('b.quo_id');
       	$this->datatables->where('b.status','1');
       		// $this->datatables->where('b.delete_status','1');
		$this->db->order_by('b.quo_id','DESC');
     	$this->datatables->edit_column('b.quo_id', '$1', "get_quotation_buttons('b.quo_id', 'Quotation/', 'b.quo_id')");
 		$this->datatables->edit_column('b.quotation_date', '$1', 'get_dateformat(b.quotation_date)');
 		 $this->datatables->edit_column('b.qus_rev', '$1', 'get_status_po(b.qus_rev)');
		// $this->datatables->edit_column('b.quo_created_on', '$1', "get_date_timeformat('b.quo_created_on')");
      	echo $this->datatables->generate();
    }

	
	public function loadaddress()
	{
			$Customer_id 		= $this->input->get('con_id');
			// $drop_menu_address 	= $this->sal_common->drop_menu_vendor_rep($Customer_id);
			$drop_menu_address 	= $this->sal_common->drop_menu_client_rep($Customer_id);
			echo form_dropdown('vendor_rep', $drop_menu_address, set_value('vendor_rep', (isset($vendor_rep)) ? $vendor_rep : ''), $attrib);
	}
	public function getDeliverAddress()
	{
			$Customer_id 		= $this->input->get('con_id');
			// $drop_menu_address1 	= $this->sal_common->drop_menu_vendor_address($Customer_id);
				$drop_menu_address1 	= $this->sal_common->drop_menu_client_address($Customer_id);
			echo form_dropdown('delivery', $drop_menu_address1, set_value('delivery', (isset($delivery)) ? $delivery : ''), $attrib);
	}
	public function getPartNoContent()
	{
		$msg['drop_menu_tax_item'] = $this->mdropdown->drop_menu_invoice_tax_item();
		$msg['i']						=	$this->input->get('i');
		echo $this->load->view('quotation/view_form_new',$msg,TRUE);
	}
	public function deleteproduct()
	{
		// $res = $this->sal_common->common_delete('sales_order_list',array('po_pdt_id' => $this->input->get('pro_item_id') ));
		$res = $this->mcommon->common_delete('quotation_item',array('qus_item_id' => $this->input->get('prid') ));
	}

	public function add()
	{
		if($this->require_min_level(1))
		{	
			if(isset($_POST['draft']))
			{

				$vendor_name		=	$this->input->post('vendor_name');
				$this->form_validation->set_rules('vendor_name', 'Vendor  Name', 'required');
				if($this->form_validation->run() == TRUE) 
				{
					if($this->input->post('quo_id')!='')
					{
				    $old_number = $this->mpurchase->find_qus_draft_number($this->input->post('quo_id'));
						
						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');
						
						// Manage invoice
						
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 => $old_number,
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
													'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'0',
													'qus_rev'		    => 	'0',
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',									
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					

						$where_array	=	array('quo_id'=>$this->input->post('quo_id'));
						$resultupdate	=	$this->sal_common->common_edit1('quotation',$value_array,$where_array);
						

						if($resultupdate)
						{
							$where		  =	array('qus_id'=> $this->input->post("quo_id"));
							$result		   =	$this->sal_common->common_delete('quotation_item',$where);
	
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic			=	$this->input->post('itemarabic');
							// $unitengArr				    =	$this->input->post('uniteng');
							$qtyArr		                = 	$this->input->post('qty');
							$unitpriceArr	            =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		            =>	$this->input->post("quo_id"),
															'item_description'	        =>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		                =>	$unitengArr[$key],
															'qty'		                =>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'                => $unitpriceArr[$key],
														
															'total_cost'	             => $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
								
						}
					}
					else
					{

			$dqus_prifix						=	$this->sal_common->getDraftQuotationprifix();
			$dqus_number						=	$this->sal_common->getDraftQuotationNumber();
			$dqus_sufix						=	$this->sal_common->getDraftQuotationSufix();
			$dqus_padd_num = str_pad($dqus_number, 4, "0", STR_PAD_LEFT);
			$draft_qus_num = $dqus_prifix.$dqus_padd_num.$dqus_sufix;
					

						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');

						$quotationNo 	= 	$draft_qus_num ;
						
				
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 =>  $quotationNo,
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
													'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'0',
														'qus_rev'		    => 	'0',
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',	
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					

						$sal_id= $this->sal_common->common_insert('quotation',$value_array);
						$this->sal_common->set_pref_no('tbl_preferences', 'dquo_number');
				
					
						if($sal_id)
						{	
							
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic				    =	$this->input->post('itemarabic');
							// $unitengArr				=	$this->input->post('uniteng');
							$qtyArr		= 	$this->input->post('qty');
							$unitpriceArr	        =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		=>	$sal_id,
															'item_description'	=>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		=>	$unitengArr[$key],
															'qty'		=>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'     => $unitpriceArr[$key],
														
															'total_cost'	=> $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
						
						}
					}
				}
			}
			// end draft
			if(isset($_POST['savequotation']))
			{
				$vendor_name		=	$this->input->post('vendor_name');
				
				$this->form_validation->set_rules('vendor_name', 'Vendor  Name', 'required');
				if($this->form_validation->run() == TRUE) 
				{
					if($this->input->post('quo_id')!='')
					{
						$qus_status1 = $this->mpurchase->find_qus_status1($this->input->post('quo_id'));
						$qus_rev_number = $this->mpurchase->find_qus_rev_number($this->input->post('quo_id'));
						if($qus_status1=='0')
						{
						$qus_prifix						=	$this->sal_common->getQuotationprifix();
						$qus_number						=	$this->sal_common->getQuotationNumber();
						$qus_sufix						=	$this->sal_common->getQuotationSufix();
						$qus_padd_num = str_pad($qus_number, 4, "0", STR_PAD_LEFT);
						$quotationNo = $qus_prifix.$qus_padd_num.$qus_sufix;
						$new_rev_number = $qus_rev_number;

						$this->sal_common->set_pref_no('tbl_preferences', 'quo_number');
					    }
					   else
					   {

					   $quotationNo = $this->mpurchase->find_qus_draft_number($this->input->post('quo_id'));
					    $new_rev_number = $qus_rev_number+1;
					   
					   }
						
						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');
						
						// Manage invoice
						
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 => $quotationNo,
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
														'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'1',
													'qus_rev' =>$new_rev_number,
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',									
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					

						$where_array	=	array('quo_id'=>$this->input->post('quo_id'));
						$resultupdate	=	$this->sal_common->common_edit1('quotation',$value_array,$where_array);
						

						if($resultupdate)
						{
							$where		  =	array('qus_id'=> $this->input->post("quo_id"));
							$result		   =	$this->sal_common->common_delete('quotation_item',$where);
	
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic			=	$this->input->post('itemarabic');
							// $unitengArr				    =	$this->input->post('uniteng');
							$qtyArr		                = 	$this->input->post('qty');
							$unitpriceArr	            =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		            =>	$this->input->post("quo_id"),
															'item_description'	        =>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		                =>	$unitengArr[$key],
															'qty'		                =>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'                => $unitpriceArr[$key],
														
															'total_cost'	             => $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
								
						}
					}
					else
					{
					$qus_prifix						=	$this->sal_common->getQuotationprifix();
					$qus_number						=	$this->sal_common->getQuotationNumber();
					$qus_sufix						=	$this->sal_common->getQuotationSufix();
					$qus_padd_num = str_pad($qus_number, 4, "0", STR_PAD_LEFT);
					$quotationNo = $qus_prifix.$qus_padd_num.$qus_sufix;

						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');

						// $quotationNo 	= 	$this->input->post('quotation_num');
						
				
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 =>  $quotationNo,
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
													'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'1',
													'qus_rev'		    => 	'0',
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',	
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					
					
	
						$sal_id= $this->sal_common->common_insert('quotation',$value_array);
						$this->sal_common->set_pref_no('tbl_preferences', 'quo_number');
				
					
						if($sal_id)
						{	
							
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic				    =	$this->input->post('itemarabic');
							// $unitengArr				=	$this->input->post('uniteng');
							$qtyArr		= 	$this->input->post('qty');
							$unitpriceArr	        =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		=>	$sal_id,
															'item_description'	=>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		=>	$unitengArr[$key],
															'qty'		=>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'     => $unitpriceArr[$key],
														
															'total_cost'	=> $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
						
						}
					}
				}
			}
			if($sal_id)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Quotation/manage'));
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Quotation/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}

		}
	}
	public function operation( $id = '' )
	{
			
		$where_array=array('quo_id'=>$id);
		$data['value']=$this->sal_common->get_fulldata('quotation',$where_array);
		
		$data['evalue']=$this->sal_common->get_quotation_product($id);
		$client_id = $this->mcommon->find_client_id_qus($id);
		$data['drop_menu_address'] 	=	$this->sal_common->drop_menu_client_rep($client_id);
	 	$data['drop_menu_currency'] = $this->mdropdown->drop_menu_currency();
	
		$this->index($data);
	}
	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
			$value_array=array(
								'status'		     =>	0,
								
							  );
			$where_array=array(
								'quo_id' =>$id
							  );
			$result=$this->sal_common->common_edit('quotation',$value_array,$where_array);
			
			if($result)
			{
				$this->session->set_userdata('successMsg', 'Deleted Successfully...');
				redirect(base_url('Quotation/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
		}
	}
	public function printModal()
	{
	$view_data['id'] 				=  $this->input->get('invoice_id');
 	echo $this->load->view('quotation/print_modal',$view_data,TRUE);	
        
	}
	public function printSalesorder1( $id='' )
	{

		$organization_detail    =   $this->mcommon->getCompanyProfiles('1');	
		foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
		
		$data['spvalue'] = $this->sal_common->get_quotation_product($id);
		$bank_id				   =	$this->sal_common->get_quotation_bank_id($id);
		$where_array	=	array('quo_id'=>$id);
		$data['value']	=	$this->sal_common->get_fulldata('quotation',$where_array);

		$data['organization_detail']	=	$this->mcommon->getCompanyProfiles('1');
		$company_detail					=	$this->sal_common->get_vendor_detail($id);
		
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
		$this->load->library('MyPDF');
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Quotation');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10,35,10);
	    $pdf->setHeaderMargin(200);
		$pdf->SetFooterMargin(300);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$lg = Array();
		$lg['a_meta_charset'] = 'UTF-8';
		$lg['a_meta_language'] = 'fa';
		$pdf->setLanguageArray($lg);
		$pdf->SetFont('dejavusans', '', 10);

		$pdf->AddPage();
		$html=$this->load->view('quotation/printwithheader',$data, TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_end_clean();
		$pdf->Output('Quotation.pdf', 'I');
	
	}
		public function printSalesorder( $id='' )
	{

		$organization_detail    =   $this->mcommon->getCompanyProfiles('1');	
		foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
		
		$data['spvalue'] = $this->sal_common->get_quotation_product($id);
		$bank_id				   =	$this->sal_common->get_quotation_bank_id($id);
		$where_array	=	array('quo_id'=>$id);
		$data['value']	=	$this->sal_common->get_fulldata('quotation',$where_array);

		$data['organization_detail']	=	$this->mcommon->getCompanyProfiles('1');
		$company_detail					=	$this->sal_common->get_vendor_detail($id);
		
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
		$this->load->library('MyPDF1');
		$pdf = new MYPDF1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Quotation');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10,35,10);
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
		$html=$this->load->view('quotation/printwithheader',$data, TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_end_clean();
		$pdf->Output('Quotation.pdf', 'I');
	
	}
	public function add_newquotation($enq_id='',$quote_id='')
	{  
		
		if($this->require_min_level(1))
        {
        	$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;

			$msg['form_url']		=	'Quotation/add1';
	        $msg['form_toptittle']	=	'Quotation Management';
     		$msg['enq_id'] 			=    $enq_id;
     		$client_id = $this->mpurchase->find_enquiry_client_num($enq_id);
     		$client_rep = $this->mpurchase->find_enquiry_client_rep_id($enq_id);
     		$msg['refference'] = $this->mpurchase->find_enquiry_reff($enq_id);

        	$msg['list_tittle']		=	'Quotation list';
       
        	$msg['organization_detail']    =   $this->mcommon->getCompanyProfiles('1');
        	
        	$msg['drop_menu_vendor']	    =	$this->mdropdown->drop_menu_client_enquiry($client_id);
        	$msg['drop_menu_address']	    =	$this->mdropdown->drop_menu_client_rep_enquiry($client_rep);
        	$msg['drop_menu_payment_terms'] = $this->mdropdown->drop_menu_payment_terms();
			$msg['drop_menu_customer']		=	$this->mdropdown->drop_menu_customer();
			$msg['drop_menu_item']			=	$this->mdropdown->drop_menu_item();
			$msg['drop_menu_tax1']			=	$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
			$msg['drop_menu_ship_pref']		=	$this->mdropdown->drop_menu_ship_pref();
			$msg['drop_menu_unit']			=	$this->mdropdown->drop_menu_unit();
			$msg['drop_menu_accountheads']	=	$this->mdropdown->drop_menu_accountheads();
			$qus_prifix						=	$this->sal_common->getQuotationprifix();
			$qus_number						=	$this->sal_common->getQuotationNumber();
			$qus_sufix						=	$this->sal_common->getQuotationSufix();
			$qus_padd_num = str_pad($qus_number, 4, "0", STR_PAD_LEFT);
			$msg['quotation_num'] = $qus_prifix.$qus_padd_num.$qus_sufix;
			// $msg['quotation_num']			=	$this->sal_common->getQuotationNo();
			$msg['drop_menu_bank']	        =	$this->mdropdown->drop_menu_bank();
			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model; 
 			$sessionArr						=	$this->session->all_userdata();
 			$msg['drop_menu_tax_item'] = $this->mdropdown->drop_menu_invoice_tax_item();
 			// $msg['drop_menu_currency'] = $this->mdropdown->drop_menu_currency();
 			$msg['drop_menu_quotation_validity'] = $this->mdropdown->drop_menu_quotation_validity();
			$currency_id	= $this->sal_common->find_client_currency_id($client_id);
			$msg['drop_menu_currency'] 	= $this->sal_common->drop_menu_client_Enquiry_Currency($currency_id);
 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Quotation Management',
								'content'   =>$this->load->view('quotation/add_enquiry_quotation',$msg,TRUE)
							);

			// $array_sess_items = array('successMsg'=>'');
			// $this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);		
		}

	}
	public function add1()
	{
		if($this->require_min_level(1))
		{	
			if(isset($_POST['draft']))
			{

				$vendor_name		=	$this->input->post('vendor_name');
				$this->form_validation->set_rules('vendor_name', 'Vendor  Name', 'required');
				if($this->form_validation->run() == TRUE) 
				{
					if($this->input->post('quo_id')!='')
					{
						print_r($this->input->post('enq_no'));die;
				    $old_number = $this->mpurchase->find_qus_draft_number($this->input->post('quo_id'));
						
						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');
						
						// Manage invoice
						
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 => $old_number,
													'enq_no' => $this->input->post('enq_id'),
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
													'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'0',
													'qus_rev'		    => 	'0',
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',									
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					

						$where_array	=	array('quo_id'=>$this->input->post('quo_id'));
						$resultupdate	=	$this->sal_common->common_edit1('quotation',$value_array,$where_array);
						

						if($resultupdate)
						{
							$where		  =	array('qus_id'=> $this->input->post("quo_id"));
							$result		   =	$this->sal_common->common_delete('quotation_item',$where);
	
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic			=	$this->input->post('itemarabic');
							// $unitengArr				    =	$this->input->post('uniteng');
							$qtyArr		                = 	$this->input->post('qty');
							$unitpriceArr	            =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		            =>	$this->input->post("quo_id"),
															'item_description'	        =>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		                =>	$unitengArr[$key],
															'qty'		                =>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'                => $unitpriceArr[$key],
														
															'total_cost'	             => $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
								
						}
					}
					else
					{

			$dqus_prifix						=	$this->sal_common->getDraftQuotationprifix();
			$dqus_number						=	$this->sal_common->getDraftQuotationNumber();
			$dqus_sufix						=	$this->sal_common->getDraftQuotationSufix();
			$dqus_padd_num = str_pad($dqus_number, 4, "0", STR_PAD_LEFT);
			$draft_qus_num = $dqus_prifix.$dqus_padd_num.$dqus_sufix;
					

						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');

						$quotationNo 	= 	$draft_qus_num ;
						
				
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 =>  $quotationNo,
													'enq_no' => $this->input->post('enq_id'),
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
													'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'0',
														'qus_rev'		    => 	'0',
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',	
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					

						$sal_id= $this->sal_common->common_insert('quotation',$value_array);
						$this->sal_common->set_pref_no('tbl_preferences', 'dquo_number');
				
					
						if($sal_id)
						{	
							
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic				    =	$this->input->post('itemarabic');
							// $unitengArr				=	$this->input->post('uniteng');
							$qtyArr		= 	$this->input->post('qty');
							$unitpriceArr	        =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		=>	$sal_id,
															'item_description'	=>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		=>	$unitengArr[$key],
															'qty'		=>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'     => $unitpriceArr[$key],
														
															'total_cost'	=> $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
						
						}
					}
				}
			}
			// end draft
			if(isset($_POST['savequotation']))
			{
				$vendor_name		=	$this->input->post('vendor_name');
				
				$this->form_validation->set_rules('vendor_name', 'Vendor  Name', 'required');
				if($this->form_validation->run() == TRUE) 
				{
					if($this->input->post('quo_id')!='')
					{
						$qus_status1 = $this->mpurchase->find_qus_status1($this->input->post('quo_id'));
						$qus_rev_number = $this->mpurchase->find_qus_rev_number($this->input->post('quo_id'));
						if($qus_status1=='0')
						{
						$qus_prifix						=	$this->sal_common->getQuotationprifix();
						$qus_number						=	$this->sal_common->getQuotationNumber();
						$qus_sufix						=	$this->sal_common->getQuotationSufix();
						$qus_padd_num = str_pad($qus_number, 4, "0", STR_PAD_LEFT);
						$quotationNo = $qus_prifix.$qus_padd_num.$qus_sufix;
						$new_rev_number = $qus_rev_number;

						$this->sal_common->set_pref_no('tbl_preferences', 'quo_number');
					    }
					   else
					   {

					   $quotationNo = $this->mpurchase->find_qus_draft_number($this->input->post('quo_id'));
					    $new_rev_number = $qus_rev_number+1;
					   
					   }
						
						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');
						
						// Manage invoice
						
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 => $quotationNo,
													'enq_no' => $this->input->post('enq_id'),
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
														'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'1',
													'qus_rev' =>$new_rev_number,
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',									
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					

						$where_array	=	array('quo_id'=>$this->input->post('quo_id'));
						$resultupdate	=	$this->sal_common->common_edit1('quotation',$value_array,$where_array);
						

						if($resultupdate)
						{
							$where		  =	array('qus_id'=> $this->input->post("quo_id"));
							$result		   =	$this->sal_common->common_delete('quotation_item',$where);
	
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic			=	$this->input->post('itemarabic');
							// $unitengArr				    =	$this->input->post('uniteng');
							$qtyArr		                = 	$this->input->post('qty');
							$unitpriceArr	            =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		            =>	$this->input->post("quo_id"),
															'item_description'	        =>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		                =>	$unitengArr[$key],
															'qty'		                =>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'                => $unitpriceArr[$key],
														
															'total_cost'	             => $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
								
						}
					}
					else
					{
					$qus_prifix						=	$this->sal_common->getQuotationprifix();
					$qus_number						=	$this->sal_common->getQuotationNumber();
					$qus_sufix						=	$this->sal_common->getQuotationSufix();
					$qus_padd_num = str_pad($qus_number, 4, "0", STR_PAD_LEFT);
					$quotationNo = $qus_prifix.$qus_padd_num.$qus_sufix;

						$quotation_order_date		=	($this->input->post('quotation_date')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_date'))) : date('Y-m-d');
						$quotation_validity		=	($this->input->post('quotation_validity')!='') ? date('Y-m-d', strtotime($this->input->post('quotation_validity'))) : date('Y-m-d');

						// $quotationNo 	= 	$this->input->post('quotation_num');
						
				
						$value_array 	=	array(
													'quotation_vendor'			=>  $vendor_name,
													'quotation_verndor_rep'     =>($this->input->post('vendor_rep')!='') ? ($this->input->post('vendor_rep')) : '',
												
													'quotation_no'			 =>  $quotationNo,
													'enq_no' => $this->input->post('enq_id'),
													'quotation_date'		 =>  $quotation_order_date,
													'refference'=> ($this->input->post('reference')!='') ? ($this->input->post('reference')) : '',
													'quotation_validity'=> $quotation_validity,
													'delivery'=> ($this->input->post('delivery')!='') ? ($this->input->post('delivery')) : '',
													'payment_term'    => ($this->input->post('payment_term')!='') ? ($this->input->post('payment_term')) : '',
													'quotation_bank' =>($this->input->post('vendor_bank')!='') ? ($this->input->post('vendor_bank')) : '',	
													'subject'       => ($this->input->post('subject')!='') ? ($this->input->post('subject')) : '',		
													
													'quotation_sub_total' =>$this->input->post('sub_t'),
													'quotation_tax_amount' => $this->input->post('vat_amount'),
													'quotation_grand_total'			=>	$this->input->post('total'),
													'quotation_discount'			=>	$this->input->post('dis_amount'),
													'status'					=> '1',
													'qus_status' =>'1',
													'qus_rev'		    => 	'0',
													'general_terms' => ($this->input->post('remarks')!='') ? ($this->input->post('remarks')) : '',	
													'co_terms' => ($this->input->post('co_terms')!='') ? ($this->input->post('co_terms')) : '',									
													'deliverytearms' => ($this->input->post('deliverytearms')!='') ? ($this->input->post('deliverytearms')) : '',	
													'support_maintenance' => ($this->input->post('support_maintenance')!='') ? ($this->input->post('support_maintenance')) : '',	
													'installation' => ($this->input->post('installation')!='') ? ($this->input->post('installation')) : '',	
													'quo_created_by'			=>  $this->auth_user_id,
													'qus_curency'			=>  $this->input->post('qus_curency'),
													'quo_created_on'  			=>  date('Y-m-d H:i:s')
												);
					
					
	
						$sal_id= $this->sal_common->common_insert('quotation',$value_array);
						$this->sal_common->set_pref_no('tbl_preferences', 'quo_number');
				
					
						if($sal_id)
						{	
							
							$item_Arr				    =	$this->input->post('item');
							$item_Arr_Arabic				    =	$this->input->post('itemarabic');
							// $unitengArr				=	$this->input->post('uniteng');
							$qtyArr		= 	$this->input->post('qty');
							$unitpriceArr	        =	$this->input->post('unit_price');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							$vat_per	            =	$this->input->post('vat_per1');
							$discount_per		=	$this->input->post('discount');
							$discout_amount = $this->input->post('discount_amount');
							$vat_amount = $this->input->post('vat_amount1');
							foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'qus_id'		=>	$sal_id,
															'item_description'	=>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															// 'unit'		=>	$unitengArr[$key],
															'qty'		=>	$qtyArr[$key],
															'dis_per' =>$discount_per[$key],
															'dis_amt' =>$discout_amount[$key],
															'vat_per'=>$vat_per[$key],
															'vat_amt' =>$vat_amount[$key],
															'unit_price'     => $unitpriceArr[$key],
														
															'total_cost'	=> $cost_total_amountArr[$key]	
														);
									$this->sal_common->common_insert('quotation_item',$value_array1);
								}

							}
						
						}
					}
				}
			}
			if($sal_id)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Quotation/manage'));
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Quotation/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}

		}
	}
	public function operation1( $id = '',$q_id='')
	{
			
		$where_array=array('quo_id'=>$q_id);
		$data['value']=$this->sal_common->get_fulldata('quotation',$where_array);
		
		$data['evalue']=$this->sal_common->get_quotation_product($q_id);
		$data['drop_menu_currency'] = $this->mdropdown->drop_menu_currency();
		$this->add_newquotation($data);
	}
	 public function QRcode($qus_no,$qus_date,$name)
    {
    $qus_num1                  = explode('-',$qus_no);
    $elements = array();
	foreach($qus_num1 as $data1) {
    $elements[] = $data1 ;
	}
	$qus_num =  implode('/', $elements);
	$qus_date1                  = explode('-',$qus_date);
    $elements1 = array();
	foreach($qus_date1 as $data2) {
    $elements1[] = $data2 ;
	}
	$qus_date=  implode('/', $elements1);
	$qus_name                  = explode('-',$name);
    $elements2 = array();
	foreach($qus_name as $data3) {
    $elements2[] = $data3 ;
	}
	$c_name=  implode(' ', $elements2);
	// $name1                  = explode('/',$link);
 //    $elements1 = array();
	// foreach($name1 as $data2) {
 //    $elements1[] = $data2 ;
	// }
	// $name2 =  implode(' ', $elements1);

	// $vat1                  = explode('-',$vat_no);
 //    $elements2 = array();
	// foreach($vat1 as $data3) {
 //    $elements2[] = $data3 ;
	// }
	// $vat =  implode(' ', $elements2);

 //    $Qr_data .= "Vendor Name :".$name2."\n";
 //    $Qr_data .= "VAT Number  :".$vat."\n";
 //    $Qr_data .= "Date & Time :".$date.' '.$time."\n";
 //    $Qr_data .= "VAT Amount :".$tax."\n";
 //    $Qr_data .= "Total Amount :".$total."\n";




  //     $Qr_data = $link;
  // QRcode::png(
  //   		$Qr_data ,
  //   		$outfile=false,
  //   		$level=QR_ECLEVEL_H,
  //   		$size=1,
  //   		$margin=2
  //   	);
    	// $img = base_url('img/logo/AGM.png');
	 	$img = '';
    	$data .= "Quotation No :".$qus_num."\n";
    	$data .= "Quotation Date :".$qus_date."\n";
    	$data .= "Client Name :".$c_name."\n";
$size = isset($_GET['size']) ? $_GET['size'] : '200x200';
$logo = isset($_GET['logo']) ? $_GET['logo'] : $img;

header('Content-type: image/png');
// Get QR Code image from Google Chart API
// http://code.google.com/apis/chart/infographics/docs/qr_codes.html
$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
if($logo !== FALSE){
	$logo = imagecreatefromstring(file_get_contents($logo));

	$QR_width = imagesx($QR);
	$QR_height = imagesy($QR);
	
	$logo_width = imagesx($logo);
	$logo_height = imagesy($logo);
	
	// Scale logo to fit in the QR Code
	$logo_qr_width = $QR_width/3;
	$scale = $logo_width/$logo_qr_width;
	$logo_qr_height = $logo_height/$scale;
	
	imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
}
imagepng($QR);
imagedestroy($QR);
}
public function getClientCurrency()
	{
			$client_id 		= $this->input->get('con_id');
			$currency_id	= $this->sal_common->find_client_currency_id($client_id);
				$drop_menu_address1 	= $this->sal_common->drop_menu_client_Currency($currency_id);
			echo form_dropdown('qus_curency', $drop_menu_address1, set_value('qus_curency', (isset($qus_curency)) ? $qus_curency : ''), $attrib);
	}
}
?>