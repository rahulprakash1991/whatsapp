<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Costing extends MY_Controller {

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
			$msg['form_url']		=	'Costing/add';
	        $msg['form_tittle']		=	'Costing Management';
	        $msg['form_toptittle']	=	'Costing Management';
        	$msg['datatable_url']	=	'Costing/datatable';

			$msg['drop_menu_vendor']		=	$this->mdropdown->drop_menu_vendor();
			$msg['drop_menu_item']			=	$this->mdropdown->drop_menu_item();
		
			$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
		
			$msg['co_number']				=	$this->mpurchase->getCoNo();
		

			$msg['notification'] 			= 	$sessionArr['successMsg'];
 			$auth_model 					= 	$this->authentication->auth_model;
 			
			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Costing Management',
								'content'   =>	$this->load->view('costing/addcosting',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	
	// Adding Costing Data 
	public function add()
	{	
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{

				$this->form_validation->set_rules('vendor_id', 'Vendor', 'required|numeric|greater_than[0.99]');

				for ($i=0; $i < $this->input->post('attproduct'); $i++)
				{ 
					
					$this->form_validation->set_rules('pro_item_id['.$i.']', 'Product', 'required');

				}

				if($this->form_validation->run() == TRUE) 
				{	

					//If Po_id exists Update the purchase order value 
					if($this->input->post('co_id')	!=	'')
					{

					    $order_date1	=	$this->input->post('order_date'); 
						$order_date = date('Y-m-d', strtotime($order_date1));
						$value_array	=	array(
													
													'co_no'					=>	$this->input->post('co_number'),
													'order_date'			=>	$order_date,
													'ref_no'				=>	$this->input->post('ref_no'),
													'vendor'				=>	$this->input->post('vendor_id'),
													'vendor2'				=>	$this->input->post('vendor_id2'),
													'vendor3'				=>	$this->input->post('vendor_id3'),
													'vendor4'				=>	$this->input->post('vendor_id4'),
													
													'co_created_by'		    => 	$this->auth_user_id,
													'co_created_on'  		=> 	date('Y-m-d H:i:s')
												);
												 
						$where_array	=	array('co_id'	=>	$this->input->post('co_id'));
						$resultupdate	=	$this->mcommon->common_edit1('tbl_costing', $value_array, $where_array);
					
						if($resultupdate)
						{
							$po_pdt_idArr				=	$this->input->post('co_pdt_id');
							$pro_item_idArr				=	$this->input->post('pro_item_id');
							$cost  	    =   $this->input->post('cost');
							$cost1			=	$this->input->post('cost1');
							$cost2				=	$this->input->post('cost2');
							$cost3			    = 	$this->input->post('cost3');

							foreach ($this->input->post('pro_item_id') as $key => $value)
							{								
								if($pro_item_idArr[$key]!='')
								{									
									
									$value_array1	=	array
														(									
															'pro_item_id'					=>	$pro_item_idArr[$key],
															'cost'  	    		=>  $cost[$key],
															'cost1'					=>	$cost1[$key],
															'cost2'					=>	$cost2[$key],
															//'unit'						=>	$unitArr[$key],
															'cost3'						=>	$cost3[$key],
															
														);


									if($po_pdt_idArr[$key]!='')
									{
										// print_r($po_pdt_idArr[$key]);die;
										$this->mcommon->common_edit1(
																		'tbl_costing_product', 
																		$value_array1, 
																		array('co_id' => $this->input->post('co_id'), 'co_pro_id' => $po_pdt_idArr[$key])
																	);
										
									}									
									else 
									{
										
										$value_array1['co_id'] = $this->input->post('co_id');
										$this->mcommon->common_insert('tbl_costing_product',$value_array1);
									}
								}
							}
							
						
						}
					}
					 // END ELSE IF PO Update
					else
					{
					
						// Purchase Order Insert
						$order_date1	=	$this->input->post('order_date'); 
						$order_date = date('Y-m-d', strtotime($order_date1));
						$value_array	=	array(
													
													'co_no'					=>	$this->input->post('co_number'),
													'order_date'			=>	$order_date,
													'ref_no'				=>	$this->input->post('ref_no'),
													'vendor'				=>	$this->input->post('vendor_id'),
													'vendor2'				=>	$this->input->post('vendor_id2'),
													'vendor3'				=>	$this->input->post('vendor_id3'),
													'vendor4'				=>	$this->input->post('vendor_id4'),
													
													'co_created_by'		    => 	$this->auth_user_id,
													'co_created_on'  		=> 	date('Y-m-d H:i:s')
												);

							$result 	= 	$this->mcommon->common_insert('tbl_costing',$value_array);

						// PO Successfully Inserted
						if($result)
						{							
							$this->mcommon->set_pref_no('tbl_preferences',	'cost_number');
							
							$pro_item_idArr				=	$this->input->post('pro_item_id');
							$cost  	    =   $this->input->post('cost');
							$cost1			=	$this->input->post('cost1');
							$cost2				=	$this->input->post('cost2');
							$cost3			    = 	$this->input->post('cost3');
							

							// Purchase order product data insert
							foreach($pro_item_idArr as $key => $val)
							{
								
									$value_array1	=	array
														(									
															'co_id'						    =>	$result,
															'pro_item_id'					=>	$pro_item_idArr[$key],
															'cost'  	    		=>  $cost[$key],
															'cost1'					=>	$cost1[$key],
															'cost2'					=>	$cost2[$key],
															//'unit'						=>	$unitArr[$key],
															'cost3'						=>	$cost3[$key],
															
														);	
   									
									$this->mcommon->common_insert('tbl_costing_product',$value_array1);											
								
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
				redirect(base_url('Costing/manage'), 'refresh');	
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Costing/manage'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
		}
 		
	}

	

	public function deleteproduct()
	{
		$res = $this->mcommon->common_delete('tbl_costing_product',array('co_pro_id' => $this->input->get('prid') ));
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

	

	public function delete( $id = '' )
	{
		$value_array	=	array(
									'co_delete_status'		 =>	'0',
									'co_created_by'	 => $this->auth_user_id,
									'co_created_on'  => date('Y-m-d H:i:s'),
								 );
								 
		$where_array	=	array('co_id'	=>	$id);
		$result			=	$this->mcommon->common_edit(' tbl_costing', $value_array, $where_array);
	
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('Costing/manage'), 'refresh');
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

	
	public function getPartNoContent()
	{
		$msg['i']						=	$this->input->get('i');
		$msg['drop_menu_product_item']	=	$this->mdropdown->drop_menu_product_item();
		$msg['drop_menu_unit']			=	$this->mdropdown->drop_menu_unit();
		$msg['drop_menu_unit1']			=	$this->mdropdown->drop_menu_unit1();	
			
		echo $this->load->view('costing/add_row',$msg,TRUE);
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


 	public function find_min_cost()
	{
		$Inspector_Id = array();
		$pro_id = $this->input->get('pro_item_id');
		$vender_id1 = $this->input->get('vender_id1');
		$vender_id2 = $this->input->get('vender_id2');
		$vender_id3 = $this->input->get('vender_id3');
		$vender_id4 = $this->input->get('vender_id4');
		if($vender_id1!='')
		{
			
			$cost =  $this->mcommon->find_min_cost($pro_id,$vender_id1);
			array_push($Inspector_Id,$cost);
		}
		if($vender_id2!='')
		{
		
			$cost2 =  $this->mcommon->find_min_cost($pro_id,$vender_id2);
			array_push($Inspector_Id,$cost2);
		}
		if($vender_id3!='')
		{
			$cost3 =  $this->mcommon->find_min_cost($pro_id,$vender_id3);
			array_push($Inspector_Id,$cost3);
		}
		if($vender_id4!='')
		{
			$cost4 =  $this->mcommon->find_min_cost($pro_id,$vender_id4);
			array_push($Inspector_Id,$cost4);
		}
	
    		$Inspector_Id	= implode('|',$Inspector_Id);
		echo $Inspector_Id;	
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

			$msg['payment_status']  =	$this->input->post('payment_status');
			$msg['rec_status']      =	$this->input->post('rec_status');
			$msg['form_url']		=	'Purchase_order/add';
	        $msg['form_tittle']		=	'Costing Management';
	        $msg['form_toptittle']	=	'Costing  Management';
			
        	if($this->input->post('searchFilter')=='1')
        	{
        		$msg['datatable_url']	=	'Costing/datatable/'.$from_date1.'/'.$to_date1.'/'.$vendor_id.'/'.$msg['rec_status'].'/'.$msg['payment_status'] ;
        	}
        	else
        	{
        		$msg['datatable_url']	=	'Costing/datatable';
        	}
        	$msg['drop_menu_vendor']		=	$this->mdropdown->drop_menu_vendor();
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation', 'Vendor','CO Number', 'CO Date', 'Updated By', 'Updated On'); 
			
			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model; 
			
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Costing  Management',
								'content'   =>	$this->load->view('costing/view_list',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function datatable($from_date1='', $to_date1='', $vendor_id='', $rec_status='', $payment_status='')
    {
    	$this->datatables->select('b.co_id,c.con_company_name,b.co_no, b.order_date, u.username, b.co_created_on');
        $this->datatables->from('tbl_costing AS b');       
        // $this->datatables->join('tbl_costing_product AS pd', 'pd.co_id = b.co_id','left');
        $this->datatables->join('tbl_contacts AS c', 'c.con_id	 = b.vendor','left');
        // $this->datatables->join('tbl_contacts AS c1', 'c1.con_id	 = b.vendor2','left');
        // $this->datatables->join('tbl_contacts AS c2', 'c2.con_id	 = b.vendor3','left');
        // $this->datatables->join('tbl_contacts AS c3', 'c3.con_id	 = b.vendor4','left');
        $this->datatables->join('users AS u', 'u.user_id = b.co_created_by','left');
         $this->datatables->where('b.co_delete_status','1');

   	
   	
  //  		if(!empty($from_date1))
  //  		{
  //  			$this->datatables->where('b.order_date >=', $from_date1);
  //  		}
  //  		if(!empty($to_date1))
  //  		{
		// 	$this->datatables->where('b.order_date <=', $to_date1);
		// }
		// if(!empty($vendor_id))
		// {
		// 	$this->datatables->where('b.vendor =', $vendor_id);
		// }
		// if($rec_status !='')
  //  		{
		// 	$this->datatables->where('b.rec_status =', $rec_status);
		// }
		// if($payment_status !='')
  //  		{
		// 	$this->datatables->where('b.payment_status =', $payment_status);
		// }

       
        $this->datatables->edit_column('b.order_date', '$1', 'get_dateformat(b.order_date)');
        // $this->datatables->edit_column('Actions1', '$1', "get_buttons('b.co_id','Purchase_order/','b.rec_status')");
       $this->datatables->edit_column('b.co_id', get_buttons_newco('$1','Costing/'), 'b.co_id');
     
		$this->datatables->edit_column('b.co_created_on', '$1', 'get_date_timeformat(b.co_created_on)');
	
		echo $this->datatables->generate();
    }
    public function operation($id = '')
	{
        $data['value']		=	$this->mcommon->get_fulldata('tbl_costing',array('co_id'=>$id));
     
        $data['evalue']		=	$this->mpurchase->get_data_productcosting($id);
	
		
		$this->index($data);
	}
	public function printCO( $id = '' )
	{

		$where_array	=	array('po_id'=>$id);
		$where_array1	=	array('org_id'	=>	'1');
		
		$data['organization_detail']	=	$this->mcommon->getCompanyProfiles('1');
		$data['get_tax']				=	$this->mpurchase->get_tax1($id);
		$data['poproduct']				=	$this->mcommon->coproduct($id);
		$data['poexpense']				=	$this->mpurchase->poexpense($id);
		$data['value1']					=	$this->mcommon->getCostingData($id);
		$company_detail					=	$this->mpurchase->get_company_detail($id);
		$where_array2					=	array('con_id'	=>	$company_detail);
		$data['company_details']		=	$this->mcommon->get_fulldata('tbl_contacts',$where_array2);

		$this->load->view('costing/print_co', $data); 
	}

}
?>
