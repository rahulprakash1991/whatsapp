<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_order extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->library('email');
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');

		$this->load->model('Prefs','pre',TRUE);
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->model('Purchaseorder','mpurchase',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);
	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'Purchase_order/add';
	        $msg['form_tittle']		=	'Purchase Order Management';
	        $msg['form_toptittle']	=	'Purchase Order Management';
        	$msg['datatable_url']	=	'Purchase_order/datatable';
        	$msg['drop_menu_client']	=	$this->mdropdown->drop_menu_client();
			$msg['drop_menu_vendor']		=	$this->mdropdown->drop_menu_vendor();
			$msg['drop_menu_item']			=	$this->mdropdown->drop_menu_item();
			$msg['drop_menu_tax1']			=	$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
			$msg['drop_menu_ship_pref']		=	$this->mdropdown->drop_menu_ship_pref();
			$msg['drop_menu_unit']			=	$this->mdropdown->drop_menu_unit();
			$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
			$msg['drop_menu_bank']			=	$this->mdropdown->drop_menu_bank();
			$msg['drop_menu_expenses']		=	$this->mdropdown->drop_menu_expenses();
			$msg['po_number']				=	$this->mpurchase->getPoNo();
			$msg['re_number']				=	$this->mpurchase->getReceiveNo();
			$msg['drop_menu_address'] 	= $this->mcommon->drop_menu_address_vendor();

			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model;
 			
			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Purchase Order Management',
								'content'   =>	$this->load->view('purchase_order/viewform',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function receive_po($msg = array() )
	{  
		if($this->require_min_level(1))
        {
        	$msg['form_url']		=	'Purchase_order/receive_add';
	        $msg['form_tittle']		=	'Purchase Order Management';
	        $msg['form_toptittle']	=	'Purchase Order Management';
        	$msg['datatable_url']	=	'Purchase_order/datatable';

			$msg['drop_menu_vendor']		=	$this->mdropdown->drop_menu_vendor();
			$msg['drop_menu_item']			=	$this->mdropdown->drop_menu_item();
			$msg['drop_menu_tax1']			=	$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
			$msg['drop_menu_ship_pref']		=	$this->mdropdown->drop_menu_ship_pref();
			$msg['drop_menu_expenses']		=	$this->mdropdown->drop_menu_expenses();

			$msg['drop_menu_unit']			=	$this->mdropdown->drop_menu_unit();
			$msg['re_number']				=	$this->mpurchase->getReceiveNo();
		
			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model; 
			
 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Purchase Order Management',
								'content'   =>$this->load->view('purchase_order/receive_po',$msg,TRUE)
							);

			$array_sess_items 	= array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function manage()
	{  
		if($this->require_min_level(1))
        {	
        	$from_date 		=   $this->input->post('from_date');
        	$from_date1 	= 	date("Y-m-d", strtotime($from_date));
        	$to_date  		= 	$this->input->post('to_date');
        	$to_date1 		= 	date("Y-m-d", strtotime($to_date));
			$vendor_id  	=	$this->input->post('vendor_id');
			$rec_status  	=	$this->input->post('rec_status');
			$payment_status  	=	$this->input->post('payment_status');

		
			$msg['form_url']		=	'Purchase_order/add';
	        $msg['form_tittle']		=	'Purchase Order Management';
	        $msg['form_toptittle']	=	'Purchase Order Management';
			
        	if($this->input->post('searchFilter')=='1')
        	{
        		// print_r($vendor_id );die;
        		$msg['datatable_url']	=	'Purchase_order/datatable/'.$from_date1.'/'.$to_date1.'/'.$vendor_id.'/'.$rec_status.'/'.$payment_status ;
        	}
        	else
        	{
        		$msg['datatable_url']	=	'Purchase_order/datatable';
        	}
        	$msg['drop_menu_vendor']		=	$this->mdropdown->drop_menu_vendor();
        	$msg['drop_menu_client']	=	$this->mdropdown->drop_menu_client();
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','Vendor Name', 'PO Date', 'PO Number', 'PO Items', 'Amount', 'Paid Amount', 'PO Status', 'Payment Status', 'Updated By', 'Updated On'); 
			
			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model; 
			
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Purchase Order Management',
								'content'   =>	$this->load->view('purchase_order/viewlist',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function datatable($from_date1='', $to_date1='', $vendor_id='', $rec_status='', $payment_status='')
    {
    	$this->datatables->select('b.po_id, c.client_name, b.order_date, b.po_no, count(pd.po_pdt_id) as items, b.total_cost_price, b.paid_amt, b.rec_status, b.payment_status, u.username, b.po_created_on');
        $this->datatables->from('purchase_order AS b');       
        $this->datatables->join('purchase_order_product AS pd', 'pd.po_id = b.po_id','left');
        $this->datatables->join(' tbl_client AS c', 'c.id	 = b.vendor','left');
        $this->datatables->join('users AS u', 'u.user_id = b.po_created_by','left');
        $this->datatables->where('b.po_status','1');
   		if(!empty($from_date1))
   		{
   			$this->datatables->where('b.order_date >=', $from_date1);
   		}
   		if(!empty($to_date1))
   		{
			$this->datatables->where('b.order_date <=', $to_date1);
		}
		if(!empty($vendor_id))
		{
			$this->datatables->where('b.vendor =', $vendor_id);
		}
		if(!empty($rec_status))
   		{
			$this->datatables->where('b.rec_status =', $rec_status);
		}
		if(!empty($payment_status))
   		{
			$this->datatables->where('b.payment_status =', $payment_status);
		}

       	$this->datatables->group_by('pd.po_id');
        $this->db->order_by('pd.po_id', 'DESC');
        $this->datatables->edit_column('b.order_date', '$1', 'get_dateformat(b.order_date)');
        $this->datatables->edit_column('Actions1', '$1', "get_buttons('b.po_id','Purchase_order/','b.rec_status')");
        $this->datatables->edit_column('b.rec_status', '$1', 'get_status(b.rec_status)');
     
		$this->datatables->edit_column('b.po_created_on', '$1', 'get_date_timeformat(b.po_created_on)');
		$this->datatables->edit_column('b.payment_status', '$1', 'get_paystatus(b.payment_status)');	
		echo $this->datatables->generate();
    }

    public function text()
	{
		echo $this->mpurchase->getPoNo();
	}

	public function add()
	{	
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				// print_r($this->input->post('pro_customer_address'));die;
				$this->form_validation->set_rules('vendor_id', 'Vendor', 'required|numeric|greater_than[0.99]');

				for ($i=0; $i < $this->input->post('attproduct'); $i++)
				{ 
					$this->form_validation->set_rules('quantity['.$i.']', 'Quantity', 'required|numeric|greater_than[0.99]');
					$this->form_validation->set_rules('item['.$i.']', 'Item', 'required');
				}

				if($this->form_validation->run() == TRUE) 
				{	
					//If Po_id exists Update the purchase order value 
					if($this->input->post('po_id')	!=	'')
					{

						$order_date		=	($this->input->post('order_date')!='') ? date('Y-m-d', strtotime($this->input->post('order_date'))) : date('Y-m-d');
						$del_date   	= 	$this->input->post('del_date');

						$value_array	=	array(
													

													'vendor'				=>	$this->input->post('vendor_id'),
													'po_no'					=>	$this->input->post('po_no'),
													'order_date'			=>	$order_date,
													//'del_date'			=>	date_format($order_date, 'Y-m-d'),
													'ref_no'				=>	$this->input->post('ref_no'),
												
								
													'total_cost_price'		=>	$this->input->post('total'),
													'vat_amount'		=>	$this->input->post('vat_amount'),
												
													'po_status'      		=> 	1,
													'po_rev'		    => 	0,
													'delivery_address' =>$this->input->post('pro_customer_address'),
													'po_created_by'		    => 	$this->auth_user_id,
													'po_created_on'  		=> 	date('Y-m-d H:i:s')
												 );
												 
						$where_array	=	array('po_id'	=>	$this->input->post('po_id'));
						$resultupdate	=	$this->mcommon->common_edit1('purchase_order', $value_array, $where_array);
										
						

						

						//If payment status 1 means update payment Values 
						if($this->input->post('status') == 1)
						{						
							$neft_date		=	($this->input->post('neft_date')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date'))) : date('Y-m-d');

							$value_array5	=	array(		
														'po_id'				=> 	$this->input->post('po_id'),							
														'transaction_no	'	=>	$this->input->post('voucher_number'),
														'paid_amt'			=>	$this->input->post('amt'),
														'transaction_date'	=>  $neft_date,
														'bank_name'			=>	$this->input->post('bank_id'),
														'mode'				=>	$this->input->post('payment_mode_id'),
														'vendor_id'			=>	$this->input->post('vendor_id'),
													);
							$re 			= 	$this->mcommon->common_insert('po_payment',$value_array5);

						    //Get advance amount value from the purchase order table
							echo $advance 		=	$this->mcommon->specific_row_value('purchase_order', array('po_id' =>$this->input->post('po_id')), 'adv_amt');

							//Adding paid advance amount value and new payment value
							$advance_amt 	= 	$advance+$this->input->post('amt');	

							//update the advance amount
							$resultupdate	=	$this->mcommon->common_edit1(
																				'purchase_order', 
																				array('paid_amt' => $advance_amt), 
																				array('po_id' => $this->input->post('po_id'))
																			);
						}
						
						// Update purchase order product values
						if($resultupdate)
						{
							// $po_pdt_idArr				=	$this->input->post('po_pdt_id');
							// $pro_item_idArr				=	$this->input->post('pro_item_id');
							// $pieces_per_unitArr  	    =   $this->input->post('pieces_per_unit');
							// $selling_priceArr			=	$this->input->post('selling_price');
							// $cost_priceArr				=	$this->input->post('price_amt');
							// //$unitArr					=	$this->input->post('unit');
							// $quantityArr				=	$this->input->post('quantity');
							// $tax_typeArr			    = 	$this->input->post('tax_id');
							// $cost_tax_amountArr			= 	$this->input->post('pdt_tax_amt');
							// $selling_tax_amountArr		= 	$this->input->post('selling_tax');
							// $selling_total_amountArr	=	$this->input->post('amount');
							// $cost_total_amountArr		=	$this->input->post('cost_amount');

							$qus_pdt_idArr				=	$this->input->post('item_id');
							$item_idArr				    =	$this->input->post('item');
							$quantityArr				=	$this->input->post('quantity');
							$price_amountArr			= 	$this->input->post('price_amt');
							$sub_total_amountArr		= 	$this->input->post('sub_total');
							$discount_amountArr	=	$this->input->post('discount');
							$cost_total_amountArr		=	$this->input->post('total_amont');

							foreach ($quantityArr as $key => $value)
							{								
								if($item_idArr[$key]	!=	'')
								{									
									$value_array1	=	array(					
																

															'item_name'					   =>	$item_idArr[$key],
															'quantity'						=>	$quantityArr[$key],
															
															'price'					        =>	$price_amountArr[$key],
															'sub_total'					    =>	$sub_total_amountArr[$key],
															
															'discount'						=> 	$discount_amountArr[$key],
															'total_amount'				=> 	$cost_total_amountArr[$key],
															);

									if($qus_pdt_idArr[$key]!='')
									{

										$this->mcommon->common_edit1(
																		'purchase_order_product', 
																		$value_array1, 
																		array('po_id' => $this->input->post('po_id'), 'po_pdt_id' => $qus_pdt_idArr[$key])
																	);
										
									}									
									else 
									{
										$value_array1['po_id'] = $this->input->post('po_id');
										$this->mcommon->common_insert('purchase_order_product',$value_array1);
									}
								}
							}
							
							
							// Receive purchase order generated, when user choose the option for Save As Receive PO
							// Save As PO = 1
							// Save As Receive PO = 0 
							if($resultupdate && $this->input->post('po') == 0)
							{					
								$order_date		=	($this->input->post('order_date')!='') ? date('Y-m-d', strtotime($this->input->post('order_date'))) : date('Y-m-d');						
								$value_array	=	array(
															'po_id'				    =>	$this->input->post('po_id'),
															'receive_number'	    =>  $this->input->post('receive_number'),
															'receive_date'		    =>	date('Y-m-d',strtotime($order_date)),
															'ship_pref_id'		    =>	$this->input->post('ship_pref_id'),
															'bill_no'			    =>	$this->input->post('ref_no'),														
															'cost_price'			=> 	$this->input->post('sub_total'),
															'selling_price'			=> 	$this->input->post('selling_total'),
															'total_cost_price'	    =>	$this->input->post('total'),
															'total_selling_price'	=>	$this->input->post('selling_price_total_tax'),
														);
	       
								$result1 		= $this->mcommon->common_insert('receive_po', $value_array);

								if($result1)
								{
									$this->mcommon->set_pref_no('tbl_preferences', 're_number');
									
									
								

									foreach($item_idArr as $key => $val)
									{
										if($quantityArr[$key] > 0)
										{
											$value_array1	=	array(									
																	'rec_po_id'				=>	$result1,
																	'item_name'				=>	$item_idArr[$key],
																	'quantity'				=>	$quantityArr[$key],
															
																	'price'					=>	$price_amountArr[$key],
																	'sub_total'			 =>	$sub_total_amountArr[$key],
															
																	'discount'			=> 	$discount_amountArr[$key],
																	'total_amount'		=> 	$cost_total_amountArr[$key]
																	);	
	          								$this->mcommon->common_insert('receive_po_products',$value_array1);

			          						// Received quantity update in Purchase order product			         
			          						$this->mcommon->common_edit1(
																			'purchase_order_product', 
																			array('recd_qty'	=> $quantityArr[$key]), 
																			array('po_id' 		=> $result, 'po_pdt_id' => $qus_pdt_idArr[$key])
																		);

			          						
										}
									}

									//Receive Status update as complete(2) in Purchase order table
			          				$this->mcommon->common_edit1('purchase_order', array('rec_status' => '2'), array('po_id' =>	$this->input->post('po_id')));
								}
							}
							//END IF Receive PO Entry
						}
					}
					 // END ELSE IF PO Update
					else
					{
						// Purchase Order Insert
						$order_date	=	date_create(($this->input->post('order_date')!='') ? date('Y-m-d', strtotime($this->input->post('order_date'))) : date('Y-m-d'));
						$del_date   = 	$this->input->post('del_date');

						if($this->input->post('del_date'))
						{
							date_add($order_date, date_interval_create_from_date_string("$del_date days"));
						}
						
						$order_date		=	($this->input->post('order_date')!='') ? date('Y-m-d', strtotime($this->input->post('order_date'))) : date('Y-m-d');
						$value_array	=	array(
													'vendor'				=>	$this->input->post('vendor_id'),
													'po_no'					=>	$this->input->post('po_no'),
													'order_date'			=>	$order_date,
													//'del_date'			=>	date_format($order_date, 'Y-m-d'),
													'ref_no'				=>	$this->input->post('ref_no'),
												
								
													'total_cost_price'		=>	$this->input->post('total'),
													'vat_amount'		=>	$this->input->post('vat_amount'),
												
													'po_status'      		=> 	1,
													'delivery_address'  =>  $this->input->post('pro_customer_address'),
													'po_created_by'		    => 	$this->auth_user_id,
													'po_created_on'  		=> 	date('Y-m-d H:i:s')
												);
					
							$result 	= 	$this->mcommon->common_insert('purchase_order',	$value_array);

						// PO Successfully Inserted
						if($result)
						{							
							$this->mcommon->set_pref_no('tbl_preferences',	'po_number');
							
							// $pro_item_idArr				=	$this->input->post('pro_item_id');
							// $pieces_per_unitArr  	    =   $this->input->post('pieces_per_unit');
							// $selling_priceArr			=	$this->input->post('selling_price');
							// $cost_priceArr				=	$this->input->post('price_amt');
							// //$unitArr					=	$this->input->post('unit');
							// $tax_typeArr			    = 	$this->input->post('tax_id');
							// $quantityArr				=	$this->input->post('quantity');
							// $cost_tax_amountArr			= 	$this->input->post('pdt_tax_amt');
							// $selling_tax_amountArr		= 	$this->input->post('selling_tax');
							// $selling_total_amountArr	=	$this->input->post('amount');
							// $cost_total_amountArr		=	$this->input->post('cost_amount');


							/// New Data 
							$item_idArr				    =	$this->input->post('item');
							$quantityArr				=	$this->input->post('quantity');
							$price_amountArr			= 	$this->input->post('price_amt');
							$sub_total_amountArr		= 	$this->input->post('sub_total');
							$discount_amountArr			=	$this->input->post('discount');
							$cost_total_amountArr		=	$this->input->post('total_amont');
							///

							// Purchase order product data insert
							foreach($item_idArr as $key => $val)
							{
								if($quantityArr[$key] > 0)
								{
									$value_array1	=	array
														(	
															'po_id'						    =>	$result,
															'item_name'					   =>	$item_idArr[$key],
															'quantity'						=>	$quantityArr[$key],
															
															'price'					        =>	$price_amountArr[$key],
															'sub_total'					    =>	$sub_total_amountArr[$key],
															
															'discount'						=> 	$discount_amountArr[$key],
															'total_amount'				=> 	$cost_total_amountArr[$key],
														);	
   									
									$this->mcommon->common_insert('purchase_order_product',$value_array1);											
								}
							}

							

							// Receive purchase order generated, when user choose the option for Save As Receive PO
							// Save As PO = 1
							// Save As Receive PO = 0 
							if($result && $this->input->post('po') == 0)
							{					
								$order_date		=	($this->input->post('order_date')!='') ? date('Y-m-d', strtotime($this->input->post('order_date'))) : date('Y-m-d');						
								$value_array	=	array(
															'po_id'				    =>	$result,
															'receive_number'	    =>  $this->input->post('receive_number'),
															'receive_date'		    =>	$order_date,
															// 'ship_pref_id'		    =>	$this->input->post('ship_pref_id'),
															'bill_no'			    =>	$this->input->post('ref_no'),														
															// 'cost_price'			=> 	$this->input->post('sub_total1'),
															// 'selling_price'			=> 	$this->input->post('selling_total1'),
															'total_cost_price'	    =>	$this->input->post('total'),
															// 'total_selling_price'	=>	$this->input->post('selling_price_total_tax'),
														);
	       

								$result1 		= $this->mcommon->common_insert('receive_po', $value_array);

								if($result1)
								{
									$this->mcommon->set_pref_no('tbl_preferences', 're_number');
									
								
									

									foreach($item_idArr as $key => $val)
									{
										if($quantityArr[$key] > 0)
										{
											$value_array1	=	array(									
																	'rec_po_id'				=>	$result1,
																	'item_name'				=>	$item_idArr[$key],
																	'quantity'				=>	$quantityArr[$key],
															
																	'price'					=>	$price_amountArr[$key],
																	'sub_total'			 =>	$sub_total_amountArr[$key],
															
																	'discount'			=> 	$discount_amountArr[$key],
																	'total_amount'		=> 	$cost_total_amountArr[$key]
																	);	

	          								$this->mcommon->common_insert('receive_po_products',$value_array1);

			          						// Received quantity update in Purchase order product			         
			          						$this->mcommon->common_edit1(
																			'purchase_order_product', 
																			array('recd_qty'	=> $quantityArr[$key]), 
																			array('po_id' 		=> $result, 'item_name' => $item_idArr[$key])
																		);

			          						// Product Table Update 
			          						//Selling Price, Cost Price, Product Stock, PCS Stock updated

										}
									}

									//Receive Status update as complete(2) in Purchase order table
			          				$this->mcommon->common_edit1('purchase_order', array('rec_status' => '2'), array('po_id' =>$result));
								}
							}
							//END IF Receive PO Entry
							
							
							// PO Pre payment / Advance payment insert
							if($this->input->post('status') == 1)
							{
								$neft_date		=	($this->input->post('neft_date	')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date	'))) : date('Y-m-d');
								$value_array3	=	array(		
															'po_id'				=> 	$result,							
															'transaction_no	'	=>	$this->input->post('voucher_number'),
															'paid_amt'			=>	$this->input->post('amt'),
															'transaction_date'	=>  $neft_date,
															'bank_nam'			=>	$this->input->post('bank_id'),
															'mode'				=>	$this->input->post('payment_mode_id'),
															'vendor_id'			=>	$this->input->post('vendor_id'),
														);

								$this->mcommon->common_insert('purchase_order_payment',$value_array3);

								$value_array=array(
													'vendor_id'			=>	$this->input->post('vendor_id'),
													'mode'				=>	$this->input->post('payment_mode_id'),
													'date'		        =>	date('Y-m-d',strtotime($this->input->post('date'))),
													'transaction_no'	=>	$this->input->post('voucher_number'),
													'transaction_date'	=>	$neft_date,
													'paid_amt'			=>	$this->input->post('amt'),					
													'bank_name'			=>	$this->input->post('bank_id'),
													'po_id' 			=>  $result,
													'created_on'  		=>  date('Y-m-d H:i:s'),
												);	

								$this->mcommon->common_insert('vendor_payment',$value_array);

								if($this->input->post('total') <= $this->input->post('amt'))
								{
									$value_array = array('paid_amt' => $this->input->post('amt'), 'payment_status' => '1');
								}else
								{
									$value_array = array('paid_amt' => $this->input->post('amt'));
								}

								$this->mcommon->common_edit1('purchase_order', $value_array, array('po_id' => $result));
							}
							
						}

					}
					//END ELSE IF PO Insert
				}
				//END IF Form Validation	
			}
			//END IF Form Submit

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Purchase_order/manage'), 'refresh');	
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Purchase_order/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
	}

	public function receive_add()
	{	
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$receive_date	=	($this->input->post('receive_date')!='') ? date('Y-m-d', strtotime($this->input->post('receive_date'))) : date('Y-m-d');
				//Insert receive purchase order  values
				$value_array	=	array(
											'po_id'					=>	$this->input->post('po_id'),
											'receive_number'		=>	$this->input->post('receive_number'),
											'receive_date'			=>	date('Y-m-d',strtotime($receive_date)),
											'bill_no'				=>	$this->input->post('bill_no'),
											
											'total_cost_price'		=>	$this->input->post('total')
											
										);
				
	
					$result = $this->mcommon->common_insert('receive_po',$value_array);
		
					if($result)
					{
						


						//Get receive number from the preference table 
						$this->mcommon->set_pref_no('tbl_preferences','re_number');

							$pro_item_idArr				=	$this->input->post('item');
							$po_pro_item_id  	    =   $this->input->post('po_pdt_id');
							// $selling_priceArr			=	$this->input->post('selling_price');
							$cost_priceArr				=	$this->input->post('price_amt');
							// $unitArr					=	$this->input->post('unit');
							$quantityArr				=	$this->input->post('rec_qty');
							$recd_qtyArr				=	$this->input->post('recd_qty');
							// $tax_typeArr			    = 	$this->input->post('tax_id');
							// $cost_tax_amountArr			= 	$this->input->post('pdt_tax_amt');
							// $selling_tax_amountArr		= 	$this->input->post('selling_tax');
							// $selling_total_amountArr	=	$this->input->post('amount');
							$cost_total_amountArr		=	$this->input->post('cost_amount');
			
						foreach($pro_item_idArr as $key => $val)
						{
							if($quantityArr[$key] > 0)
							{
								$value_array1	=	array
														(									
															'rec_po_id'					=>	$result,
															'item_name'				=>	$pro_item_idArr[$key],
															'price'				=>	$cost_priceArr[$key],
															
														
															'quantity'					=>	$quantityArr[$key],
															
															'total_amount'			=>	$cost_total_amountArr[$key]
														);	

								for ($i=0; $i < $quantityArr[$key]; $i++) { 

									//Barcode generated
									$barcode 			= uniqid();
									$rendererOptions 	= array('imageType' => 'png');
									$file 				= Zend_Barcode::draw('code128', 'image', array('text' => $barcode), $rendererOptions);
									imagepng($file,"assets/barcode/{$barcode}.png");
									$barcode_array	=	array(
																'rec_po_id'	 	=>	$result,
																'pro_item_id'	=>	$pro_item_idArr[$key],
																'barcode'		=> 	$barcode,
															);
									// Inserting receive product items barcode
									$this->mcommon->common_insert('item_barcode', $barcode_array);
									
								}

								
								
								
								// Inserting receive po products values
								$this->mcommon->common_insert('receive_po_products', $value_array1);

								//Adding already received quantity and current received quantity
								$recd_qty = $recd_qtyArr[$key] + $quantityArr[$key];

								//Updating received quantity values
								$this->mcommon->common_edit1(
																'purchase_order_product', 
																array('recd_qty'	=> $recd_qty), 
																array('po_id' 		=> $this->input->post('po_id'), '	po_pdt_id' => $po_pro_item_id[$key])
															);
							}
						}
						
						if($result)
						{
							//check received status if all product received or not 
							$res = $this->mpurchase->check_po_status('purchase_order_product', $this->input->post('po_id'));
	
							//if return status value zero means updating rec_status 2
							if($res == 0)
							{
								$this->mcommon->common_edit1('purchase_order', array('rec_status' => '2'), array('po_id' =>$this->input->post('po_id')));
							}
	
							//if return value 1 means updating receive status 1
							else if($res != 0)
							{
								$this->mcommon->common_edit1('purchase_order', array('rec_status' => '1'), array('po_id' =>$this->input->post('po_id')));
							}
	
							//if returned value o means updatind receive status 0
							else
							{
								$this->mcommon->common_edit1('purchase_order', array('rec_status' => '0	'), array('po_id' =>$this->input->post('po_id')));
							}
						}
						
					}
					
			}
			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Purchase_order/manage'), 'refresh');
			}
			else
			{
				$this->receive_po($data);
			}
 		}		
	}

	public function operation($id = '')
	{
        $data['value']		=	$this->mcommon->get_fulldata('purchase_order',array('po_id'=>$id));
  //       $data['expense']	=	$this->mcommon->records_all('purchase_order_expense',array('po_id'=>$id));
        $data['evalue']		=	$this->mpurchase->get_data_product1($id);
		// $data['get_tax']	=	$this->mpurchase->get_tax1($id);
		
		$this->index($data);
	}

	public function receive($id = '')
	{
		$data['value']		=	$this->mcommon->get_fulldata('purchase_order',array('po_id'=>$id));
		// $data['expense']	=	$this->mcommon->records_all('purchase_order_expense',array('po_id'=>$id));
		// $data['evalue1']	=	$this->mpurchase->get_name($id);
		$data['evalue']		=	$this->mpurchase->get_data_product1($id);
		// $data['get_tax']	=	$this->mpurchase->get_tax1($id);
		
		$this->receive_po($data);
	}

	public function deleteproduct()
	{
		$res = $this->mcommon->common_delete('purchase_order_product',array('po_pdt_id' => $this->input->get('prid') ));
	}

	public function deleteexpense()
	{
		$res = $this->mcommon->common_delete('purchase_order_expense',array('expense_id' => $this->input->get('prid') ));
	}
	
	public function deletereceiveproduct()
	{
		$res = $this->mcommon->common_delete('receive_po_products',array('rec_po_id' => $this->input->get('prid') ));
	}

	public function deletereceiveexpense()
	{
		$res = $this->mcommon->common_delete('receive_po_expense',array('rec_po_id' => $this->input->get('prid') ));
	}

	public function viewdetails()
	{
		$id 				= 	$this->input->get('pro_item_id');
		$con_id 			= 	$this->input->get('con_id');
		
		$data['details'] 		= 	$this->mpurchase->get_po_details($id);	
		$data['sales_details'] 	= 	$this->mcommon->get_sales_details($id, $con_id);	
		
		echo $this->load->view('purchase_order/po_details', $data,TRUE);	
	}

	public function receivedpo()
	{
		$id							    =	$this->input->get('rec_po_id');
		$id1							=	$this->input->get('po_id');
		$data['value1']				    =	$this->mcommon->get_fulldata('purchase_order',array('po_id'=>$id1));
		$data['value']				    =	$this->mcommon->get_fulldata('receive_po',array('po_id'=>$id1));
		$data['receivedetails'] 	    = 	$this->mpurchase->get_receive_po_details($id);	
		$data['podetails'] 			    = 	$this->mpurchase->get_data_receive_product($id);
		$data['get_tax']				=	$this->mpurchase->get_tax1($id);
		$data['expense']				=	$this->mpurchase->expense($id);
		$data['evalue1']				=	$this->mpurchase->get_name($id1);
		$data['evalue']				    =	$this->mpurchase->get_data_product1($id);

		foreach ($data['evalue'] as $key => $value)
		{
			$data['taxsvalue'][$value->pro_item_id] = $this->mpurchase->get_data1($value->pro_item_id);
		}
		echo $this->load->view('purchase_order/receivepodetails', $data, TRUE);	
	}

	function viewpodetails( $id = '' )
	{
		$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
		$msg['drop_menu_bank']			=	$this->mdropdown->drop_menu_bank();
		$msg['drop_menu_tax1']			=	$this->mdropdown->drop_menu_tax1();
		$msg['value1']					=	$this->mpurchase->getPurchaseOrderData1($id);
		$msg['value']					=	$this->mcommon->get_fulldata('receive_po', array('po_id'=>$id));
		$msg['podetailss'] 				= 	$this->mpurchase->get_data_receive_product1($id);
		$msg['poproduct']				=	$this->mpurchase->poproduct1($id);
		$msg['expense']					=	$this->mpurchase->expense($id);
		$msg['poexpense']				=	$this->mpurchase->poexpense($id);
		$msg['get_tax']					=	$this->mpurchase->get_tax1($id);
		$msg['get_tax1_receive']		=	$this->mpurchase->get_tax1_receive($id);
		$msg['podetails'] 				= 	$this->mpurchase->get_receive_po_details1($id);
		$msg['payment_detail'] 			= 	$this->mpurchase->get_payment_details($id);
		$sessionArr				=	$this->session->all_userdata();
		$msg['notification'] 	= 	$sessionArr['successMsg'];
		$data	=	array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Purchase Order Management',
							'content'   =>	$this->load->view('purchase_order/payment_details',$msg,TRUE)
						);
		$this->load->view('templates/main_template', $data);	
	}

	function receivepodetails( $id = '' )
	{
		$msg['podetails'] 	= 	$this->mpurchase->get_receive_po_details($id);
		$data	=	array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Purchase Order Management',
							'content'   =>	$this->load->view('purchase_order/payment_details',$msg,TRUE)
						);

		$array_sess_items = array('successMsg'=>'');
		$this->session->set_userdata($array_sess_items);
		$this->load->view('templates/main_template', $data);	
	}

	public function delete( $id = '' )
	{
		$value_array	=	array(
									'po_status'		 =>	'0',
									'po_created_by'	 => $this->auth_user_id,
									'po_created_on'  => date('Y-m-d H:i:s'),
								 );
								 
		$where_array	=	array('po_id'	=>	$id);
		$result			=	$this->mcommon->common_edit('purchase_order', $value_array, $where_array);
	
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('Purchase_order/manage'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}

	public function getProductUnit()
	{
		$data['drop_menu_unit']	=	$this->mdropdown->drop_menu_unit();
		$unit1 					= 	$this->input->get('pro_unit_id');
		$i 						= 	$this->input->get('i');
		
		$htmlCont 				= '';
		$attrib1 				= 'class="bootstrap-select" data-live-search="true" data-width="100%" id="unit'.$i.'" ';
		$htmlCont.=form_dropdown('unit[]', $data['drop_menu_unit'], set_value('unit1', (isset($unit1)) ? $unit1 : ''), $attrib1);
		
		echo $htmlCont;	 
	}

	public function add_payment()
	{
		$this->form_validation->set_rules('bank_id', 'Bank Name', 'required');
		$poid=$this->input->post('po_id');
		if($this->form_validation->run() == TRUE) 
		{	
					
			if(isset($_POST['addpayment']))
			{
				$neft_date		=	($this->input->post('neft_date')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date'))) : date('Y-m-d');
				
				$value_array	=	array(
					'po_id'				=>	$this->input->post('po_id'),
					'vendor_id'			=>	$this->input->post('vendor_id'),
					'mode'				=>	$this->input->post('payment_mode_id'),
					'date'		        =>	date('Y-m-d',strtotime($this->input->post('date'))),
					'transaction_no'	=>	$this->input->post('voucher_number'),
					'transaction_date'	=>	$neft_date,
					'paid_amt'			=>	$this->input->post('amt'),					
					'bank_name'			=>	$this->input->post('bank_id'),
				
				);	
				// print_r($value_array);die;
		
				$this->mcommon->common_insert('po_payment', $value_array);
				$value_array1	=	array(
					'po_id'				=>	$this->input->post('po_id'),
					'vendor_id'			=>	$this->input->post('vendor_id'),
					'mode'				=>	$this->input->post('payment_mode_id'),
					'date'		        =>	date('Y-m-d',strtotime($this->input->post('date'))),
					'transaction_no'	=>	$this->input->post('voucher_number'),
					'transaction_date'	=>	$neft_date,
					'paid_amt'			=>	$this->input->post('amt'),		
					'vendor_remark' 	=>  $this->input->post('po_no'),			
					'bank_name'			=>	$this->input->post('bank_id'),
					'created_on'  			=>  date('Y-m-d H:i:s'),
				);
			 	$result = $this->mcommon->common_insert('vendor_payment', $value_array1);

				$paid_amount 	=	$this->mcommon->specific_row_value('purchase_order', array('po_id' =>$this->input->post('po_id')), 'paid_amt');

				$total_cost 	=	$this->mcommon->specific_row_value('purchase_order', array('po_id' =>$this->input->post('po_id')), 'total_cost_price');
				$amount_paid 	= 	$paid_amount+$this->input->post('amt');

				$amount_paid1=$this->mcommon->common_edit1('purchase_order', array('paid_amt' => $amount_paid), array('po_id' => $this->input->post('po_id')));
				if($total_cost<= $amount_paid )
				{
					$this->mcommon->common_edit1('purchase_order', array('payment_status' => '1'), array('po_id' => $this->input->post('po_id')));
				}

						
				foreach($this->input->post('ReceiveId') as $key => $value) 
				{
					$this->mcommon->common_edit1('receive_po', array('pay_status' => '1'), array('rec_po_id' => $value));
				}
					
				if($result)
				{
					$paid_amounts =	$this->mcommon->specific_row_value('purchase_order', array('po_id' =>$this->input->post('po_id')), 'paid_amt');

					$total_amount =	$this->mcommon->specific_row_value('purchase_order', array('po_id' =>$this->input->post('po_id')), 'total_cost_price');

					if($paid_amounts == $total_amount)
					{
						 $this->mcommon->common_edit1('purchase_order', array('payment_status' => '1'), array('po_id' =>$this->input->post('po_id')));
					}
					

					$po_id 	=	$this->input->post('po_id');
					$this->session->set_userdata('successMsg', 'You payment added successfully ...');	
					redirect(base_url('Purchase_order/viewpodetails/'.$po_id), 'refresh');
				}
			}
		}

		$this->session->set_userdata('successMsg', 'You payment not added successfully ...');	
		redirect(base_url('Purchase_order/viewpodetails/'.$poid), 'refresh');		
	}

	public function printPo( $id = '' )
	{

		$where_array	=	array('po_id'=>$id);
		$where_array1	=	array('org_id'	=>	'1');
		
		$data['organization_detail']	=	$this->mcommon->getCompanyProfiles('1');
		$data['get_tax']				=	$this->mpurchase->get_tax1($id);
		$data['poproduct']				=	$this->mpurchase->poproduct($id);
		$data['poexpense']				=	$this->mpurchase->poexpense($id);
		$data['value1']					=	$this->mpurchase->getPurchaseOrderData($id);
		$company_detail					=	$this->mpurchase->get_company_detail($id);
		
		$where_array2					=	array('id'	=>	$company_detail);
		$data['company_details']		=	$this->mcommon->get_fulldata('tbl_vendor',$where_array2);

		$this->load->view('purchase_order/print_po', $data); 
	}

	public function printBarcode( $rec_po_id = '' )
	{
		$data['barcode_details']	=	$this->mcommon->getBarcodeList( $rec_po_id );
		$data['barcode_per_row']	=	$this->mcommon->getBarcodeRow();

		$this->load->view('purchase_order/print_barcode', $data);
	}

	public function mailPo()
	{
		$id=$this->input->post('id');
		$where_array	=	array('po_id'=>$id);
		$where_array1	=	array('org_id'	=>	'1');
		

		$data['organization_detail']	=	$this->mcommon->getCompanyProfiles('1');

		$data['get_tax']				=	$this->mpurchase->get_tax1($id);
		$data['poproduct']				=	$this->mpurchase->poproduct($id);
		$data['poexpense']				=	$this->mpurchase->poexpense($id);
		$data['value1']					=	$this->mpurchase->getPurchaseOrderData($id);

		$company_detail					=	$this->mpurchase->get_company_detail($id);
		$where_array2					=	array('con_id'	=>	$company_detail);

		$data['company_details']		=	$this->mcommon->get_fulldata('tbl_contacts',$where_array2);

		foreach($data['company_details']->result() as $row)
		{
			$con_company_name 	=	$row->con_company_name;		
			$con_address 		=	$row->con_address;	
			$con_phone 			=	$row->con_phone;	
			$con_email 			=	$row->con_email;
			$con_first_name 	= 	$row->con_first_name;
		}
		foreach($data['organization_detail']->result() as $row)
		{
		    $c_org_name           = ucwords($row->c_org_name);
		}

		foreach($data['value1']->result() as $row)
	  	{     
			$po_no                = $row->po_no;
			
		}


		/*
		$from_email 	= "admin@heuristicsoft.com"; 
		$to_email 		=  $con_email; 
		//$to_email 		= "admin@heuristicsoft.com"; 
        $config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($from_email, $con_company_name); 
		$this->email->to($to_email);
		$this->email->subject('Purchase Order'); 

		$content = 'Please find below is the purchase order for the products required by us.<br/>';
		$body = 'Dear '.$con_first_name.',<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
		$body.= $content.'<br/><br/>';
        $body.= $this->load->view('purchase_order/email_po', $data, TRUE);

		$this->email->message($body); 
		*/

		$this->load->library('email');
		$this->email->from($con_email,$c_org_name);
		$list = array($c_org_name);
        $this->email->to('admin@heuristicsoft.com');
		$this->email->subject('Purchase Order #'.$po_no );

		$content = 'Please find below is the purchase order for the products required by us.<br/>';
		$body = 'Dear '.$con_first_name.',<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
		$body.= $content.'<br/><br/>';
        $body.= $this->load->view('purchase_order/email_po', $data, TRUE);

		$this->email->message($body); 


		//$this->email->message($this->load->view('purchase_order/email_po', $data, TRUE));

		$this->email->set_mailtype("html");
		

		//Send mail 
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
		     
		//$this->load->view('purchase_order/email_po', $data);
	}
	
	public function getPartNoContent()
	{
		$msg['i']						=	$this->input->get('i');
		
			
		echo $this->load->view('purchase_order/view_form_new_item',$msg,TRUE);
	}
	
	public function getPartNopriceContent()
	{
		$msg['i']					=	$this->input->get('i');
		$msg['drop_menu_expenses']	=	$this->mdropdown->drop_menu_expenses();		
		
		echo $this->load->view('purchase_order/add_new_expenses',$msg,TRUE);
	}
	
	public function getreceivepriceContent()
	{
		$msg['i']					=	$this->input->get('i');
		$msg['drop_menu_expenses']	=	$this->mdropdown->drop_menu_expenses();		
		
		echo $this->load->view('purchase_order/add_receive_new_expenses',$msg,TRUE);
	}

	public function getProductPriceDetails()
	{
		$res 	= $this->mpurchase->get_data($this->input->get('pro_item_id'));
		$res	= implode('|',$res);
		echo $res;	
	}

	//This function use only when delete receive po based quatity and pieces quantity update in item product master
	public function deletePOManual( $re_po_id = '' )
	{	
		if($this->require_min_level(1))
		{
			$podetails 	= 	$this->mpurchase->get_data_receive_product($re_po_id);
			foreach($podetails as $key => $row)
			{
				//get product item stock from the tbl_pro_item based on the current id 
				$pro_item_stock		=	$this->mcommon->specific_row_value(
																		'tbl_pro_item', 
																		array('pro_item_id'	=>	$row->pro_item_id),
																		'pro_item_stock'
																	 );
				$pieces_stock		=	$this->mcommon->specific_row_value(
																		'tbl_pro_item', 
																		array('pro_item_id'	=>	$row->pro_item_id),
																		'pieces_stock'
																	 );				
				//Adding product stock to the current quantity 
				$pro_item_stock	=	$pro_item_stock	-	$row->quantity;
				$pieces_stock	=	$pieces_stock	-	($row->quantity * $row->pieces_per_unit);
					
					$value_array	=	array(
												'pro_item_stock	'	 	 =>	$pro_item_stock,
												'pieces_stock'       	 => $pieces_stock,
												'pro_item_id'			 =>	$row->pro_item_id
											);

					$where_array	=	array('pro_item_id'	=>	$row->pro_item_id);
					
					//Updating tbl_pro_item values
					echo "<br /> Result " . $this->mcommon->common_edit('tbl_pro_item', $value_array, $where_array);
			}
		}
	}
	public function Revision($id = '')
	{
		
		
		// $this->receive_po($data);
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'Purchase_order/update_po';
	        $msg['form_tittle']		=	'Purchase Order Management';
	        $msg['form_toptittle']	=	'Purchase Order Management';
        	$msg['datatable_url']	=	'Purchase_order/datatable';
        	$msg['list_tittle']		=	'Purchase Order list';
			
			$msg['drop_menu_vendor']		=	$this->mdropdown->drop_menu_vendor();
			$msg['drop_menu_item']			=	$this->mdropdown->drop_menu_item();
			$msg['drop_menu_tax1']			=	$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
			$msg['drop_menu_ship_pref']		=	$this->mdropdown->drop_menu_ship_pref();
			$msg['drop_menu_unit']			=	$this->mdropdown->drop_menu_unit();
			$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
			$msg['drop_menu_bank']			=	$this->mdropdown->drop_menu_bank();
			$msg['drop_menu_expenses']		=	$this->mdropdown->drop_menu_expenses();
			// $msg['po_number']				=	$this->mpurchase->getPoNo();
			$msg['re_number']				=	$this->mpurchase->getReceiveNo();
			$msg['value']		=	$this->mcommon->get_fulldata('purchase_order',array('po_id'=>$id));
			$msg['expense']	=	$this->mcommon->records_all('purchase_order_expense',array('po_id'=>$id));
			$msg['evalue1']	=	$this->mpurchase->get_name($id);
			$msg['evalue']		=	$this->mpurchase->get_data_product($id);
			$msg['get_tax']	=	$this->mpurchase->get_tax1($id);
		
			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model; 
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Purchase Order Management',
								'content'   =>	$this->load->view('purchase_order/revision',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function update_po()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				
				$this->form_validation->set_rules('vendor_id', 'Vendor', 'required|numeric|greater_than[0.99]');
				$this->form_validation->set_rules('quantity[]', 'Quantity', 'required|numeric|greater_than[0.99]');
				$this->form_validation->set_rules('pro_item_id[]', 'Product', 'required');

				if($this->form_validation->run() == TRUE) 
				{	
					//If Po_id exists Update the purchase order value 
					if($this->input->post('po_id')!='')
					{

						$order_date	= ($this->input->post('order_date')!='') ? date('Y-m-d', strtotime($this->input->post('order_date'))) : date('Y-m-d');
						$del_date   	= 	$this->input->post('del_date');
						$old_rev = $this->mcommon->find_old_po_rev($this->input->post('po_id'));
						$new_rev = $old_rev+1;
				$str = "PO/19/21-20 Rev-1";
$po_ref = $this->input->post('po_no');
$t = (explode(" ",$po_ref));
$p_n = $t[0]. ' Rev - '.$new_rev;
// print_r($p_n);die;
						$value_array	=	array(
													'vendor'				=>	$this->input->post('vendor_id'),
													'po_no'					=>	$p_n ,
													'order_date'			=>	$order_date,
													//'del_date'			=>	date_format($order_date, 'Y-m-d'),
													'ref_no'				=>	$this->input->post('ref_no'),
													//'ship_pref_id'		=>	$this->input->post('ship_pref_id'),
													'del_addr'				=>	$this->input->post('del_addr'),
													'cost_price'			=> 	$this->input->post('sub_total'),
													'selling_price'         =>	$this->input->post('selling_total'),
													'total_cost_price'		=>	$this->input->post('total'),
													'total_selling_price'	=>	$this->input->post('selling_price_total_tax'),
													'po_status'      		=> 	1,
													'rec_status'			=> 1,
													'payment_status'       => 0,
													'po_rev'      		    => 	$new_rev,
													'po_created_by'		    => 	$this->auth_user_id,
													'po_created_on'  		=> 	date('Y-m-d H:i:s')
												 );
												 
						$where_array	=	array('po_id'	=>	$this->input->post('po_id'));
						$resultupdate	=	$this->mcommon->common_edit1('purchase_order', $value_array, $where_array);
								
						//Delete purchase order current po_id old tax values
						$delete			=	$this->mcommon->common_delete('purchase_order_tax', $where_array);

						//Insert purchase order tax values
						$taxTypeArr			=	$this->input->post('tax_type');
						$totalSellingTaxArr	=	$this->input->post('total_selling_tax');
						$totalTaxAmtArr		=	$this->input->post('total_tax_amt');
								
						foreach ($this->input->post('total_selling_tax') as $key => $value)
						{
							
							if($totalTaxAmtArr[$key] > 0)
							{
								$value_array3=array(
														'po_id'			=> $this->input->post('po_id'),
														'po_tax_id'		=> $taxTypeArr[$key] ,
														'selling_tax'	=> $totalSellingTaxArr[$key],
														'cost_tax'		=> $totalTaxAmtArr[$key],
													);

								$ss= $this->mcommon->common_insert('purchase_order_tax',$value_array3);							
							}
						}
					
						//Delete  purchase order current po_id  old expanse values
						$delete=$this->mcommon->common_delete('purchase_order_expense',$where_array);

						//Insert purchase order expense values
						$expensesMenuIdArr	=	$this->input->post('expenses_menu_id');
						$expensePriceArr	=	$this->input->post('expense_price');
	
						foreach ($this->input->post('expenses_menu_id') as $key => $value)
						{
							
							if($expensePriceArr[$key] > 0)
							{
								$value_array4=array(
														'po_id'				    => $this->input->post('po_id'),
														'po_expense_id'			=> $expensesMenuIdArr[$key],
														'po_expense_amount'		=> $expensePriceArr[$key],
													);

								$this->mcommon->common_insert('purchase_order_expense',$value_array4);							
							}
						}
			
						//If payment status 1 means update payment Values 
						if($this->input->post('status') == 1)
						{		
								
							$neft_date		=	($this->input->post('neft_date')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date'))) : date('Y-m-d');
							$value_array5	=	array(		
														'po_id'				=> 	$where_array,							
														'transaction_no	'	=>	$this->input->post('voucher_number'),
														'paid_amt'			=>	$this->input->post('amt'),
														'transaction_date'	=>  $neft_date,
														'bank_nam'			=>	$this->input->post('bank_id'),
														'mode'				=>	$this->input->post('payment_mode_id'),
														'vendor_id'			=>	$this->input->post('vendor_id'),
													);

							$re 			= 	$this->mcommon->common_insert('po_payment',$value_array5);

						    //Get advance amount value from the purchase order table
							$advance 		=	$this->mcommon->specific_row_value('purchase_order', array('po_id' =>$this->input->post('po_id')), 'adv_amt');

							//Adding paid advance amount value and new payment value
							$advance_amt 	= 	$advance+$this->input->post('amt');	

							//update the advance amount
							$resultupdate	=	$this->mcommon->common_edit1(
																				'purchase_order', 
																				array('paid_amt' => $advance_amt), 
																				array('po_id' => $this->input->post('po_id'))
																			);
						}
						// print_r($resultupdate);die;
						// Update purchase order product values

						// for ($i=0; $i <$this->input->post('attproduct') ; $i++) { 
							
						// 	print_r($i);die;
						// }
						if($resultupdate)
						{
							
							$po_pdt_idArr				=	$this->input->post('po_pdt_id');
							$pro_item_idArr				=	$this->input->post('pro_item_id');
							$pieces_per_unitArr  	    =   $this->input->post('pieces_per_unit');
							$selling_priceArr			=	$this->input->post('selling_price');
							$cost_priceArr				=	$this->input->post('price_amt');
							//$unitArr					=	$this->input->post('unit');
							$quantityArr				=	$this->input->post('quantity');
							$tax_typeArr			    = 	$this->input->post('tax_type');
							$cost_tax_amountArr			= 	$this->input->post('pdt_tax_amt');
							$selling_tax_amountArr		= 	$this->input->post('selling_tax');
							$selling_total_amountArr	=	$this->input->post('amount');
							$cost_total_amountArr		=	$this->input->post('cost_amount');
							foreach ($this->input->post('quantity') as $key => $value)
							{	

								if($pro_item_idArr[$key]!='')
								{									
									$value_array1	=	array(					
																'pro_item_id'					=>	$pro_item_idArr[$key],
																'pieces_per_unit'  	    		=>  $pieces_per_unitArr[$key],
																'selling_price'					=>	$selling_priceArr[$key],
																'cost_price'					=>	$cost_priceArr[$key],
																//'unit'						=>	$unitArr[$key],
																'quantity'						=>	$quantityArr[$key],
																'tax_id'						=> 	$tax_typeArr[$key],
																'cost_tax_amount'				=> 	$cost_tax_amountArr[$key],
																'selling_tax_amount'			=> 	$selling_tax_amountArr[$key],
																'selling_total_amount'			=>	$selling_total_amountArr[$key],
																'cost_total_amount'				=>	$cost_total_amountArr[$key]
															);


									if($po_pdt_idArr[$key]!='')
									{

										$this->mcommon->common_edit1(
																		'purchase_order_product', 
																		$value_array1, 
																		array('po_id' => $this->input->post('po_id'), 'po_pdt_id' => $po_pdt_idArr[$key])
																	);
										
									}									
									else 
									{

										$value_array1['po_id'] = $this->input->post('po_id');

										$this->mcommon->common_insert('purchase_order_product',$value_array1);
									}
								}
							}
						}//END IF product ADD
					}
				}
			}
					
			}
			//END IF Form Submit

			
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Purchase_order/manage'), 'refresh');
		
 		}
 	public function loadaddress()
	{
			$Customer_id 		= $this->input->get('con_id');
			$drop_menu_address 	= $this->mcommon->drop_menu_address_vendor($Customer_id);
			echo form_dropdown('sal_customer_address', $drop_menu_address, set_value('sal_customer_address', (isset($sal_customer_address)) ? $sal_customer_address : ''), $attrib);
	}

}
?>
