<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Credict_notes extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		// $this->load->model('common_model','mcommon',TRUE);
		$this->load->library('upload');
		$this->load->helper('datatables_helper');
		// $this->load->model('Mdropdown','Mdropdown',TRUE);
		$this->load->model('Purchaseorder','mpurchase',TRUE);
		$this->load->model('Prefs','pre',TRUE);
		$this->load->model('Sal_common_model','sal_common',TRUE);
		$this->load->model('Proforma_model','proforma',TRUE);
		$this->load->model('common_model','common',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);


	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {

        	$cur_languege = $this->session->userdata('site_lang');
        	// print_r($cur_languege);die;
			// $msg['form_url']			=	'masters/Client/add';
	        $msg['form_toptittle']		=	"Credit Note";
        	$msg['datatable_url']		=	'Credict_notes/datatable';
     
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','Credit Note No','Credit Note Date','Client Name','Invoice No','Invoice Date','Status','Amount','Balance'); 
			
			
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;

 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Credit Note  Management',
							'content'   =>	$this->load->view('credict_notes/viewform',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
        // $this->datatables->select('cn.credict_id,cn.credit_number,cn.credict_id as attac,c.client_name,s.sal_order,u.username, cn.credictnote_createdOn,v.username AS s,cn.credictnotes_updatedOn,u.username')
           $this->datatables->select('cn.credict_id,cn.credit_number,cn.credictnote_createdOn,c.client_name,s.sal_order,s.sal_created_on,cn.balance_amount,cn.credict_total,cn.balance_amount as balance,cn.credit_status')
        ->from('tbl_credicts_notes AS cn')
       	->join('tbl_client AS c', 'c.id = cn.client_id','left')
       	->join('sales_order AS s', 's.sal_id = cn.salesorder_id','left')
       	// ->join('users AS u', 'u.user_id = cn.credictnote_createdBy','left')
       	// ->join('users AS v', 'v.user_id = cn.credictnote_updatedBy','left') 
        ->where('cn.credict_note_delete_status',1);
		// ->edit_column('cn.credict_id', get_buttons_newcredict('$1','Credict_notes/'), 'cn.credict_id');
		// ->edit_column('attac',credit_attachment('$1','attac'),'attac');
		$this->datatables->edit_column('cn.credict_id', '$1', "get_buttons_newcredict('cn.credict_id', 'Credict_notes/', 'cn.credit_status')");
		$this->datatables->edit_column('cn.credictnote_createdOn', '$1', 'get_date_format(cn.credictnote_createdOn)');
		$this->datatables->edit_column('s.sal_created_on', '$1', 'get_date_format(s.sal_created_on)');
			$this->datatables->edit_column('cn.balance_amount', '$1', 'get_credit_status(cn.balance_amount)');
		// $this->datatables->edit_column('cn.credictnotes_updatedOn', '$1', 'get_date_timeformat(cn.credictnotes_updatedOn)');
		
        echo $this->datatables->generate();
    }


	public function add_credict_notes( $msg = array() )
	{  

		
		if($this->require_min_level(1))
        {
			
			$msg['form_url']		=	'Credict_notes/add';
	        $msg['form_toptittle']	=	'Credit Note Management';
        	$msg['list_tittle']		=	'Credit Note list';
        	$msg['drop_menu_client']	=	$this->mdropdown->drop_menu_client();
			$msg['notification'] 			= 	$sessionArr['successMsg'];
			// $msg['credit_num']				=	$this->sal_common->getPer_CriditNoteNo();


			$cr_prifix = $this->sal_common->getPer_CriditNoteNoprefix();
			$cr_num =$this->sal_common->getPer_CriditNoteNonumber();
			$cr_padd_num = str_pad($cr_num, 4, "0", STR_PAD_LEFT);
			$msg['credit_num'] = $cr_prifix.$cr_padd_num;

 			$auth_model 					= 	$this->authentication->auth_model; 
 			$sessionArr						=	$this->session->all_userdata();
 			// $msg['drop_menu_tax'] = $this->mdropdown->drop_menu_invoice_tax();
 			// $msg['drop_menu_currency'] = $this->mdropdown->drop_menu_currency();
 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Credit Note Management',
								'content'   =>$this->load->view('credict_notes/add_credict_notes',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);
		}
	}

	public function add()
	{

		if($this->require_min_level(1))
		{	
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('sal_company_name', 'Client  Name', 'required');
				if($this->form_validation->run() == TRUE) 
				{


					if($this->input->post('credict_id')!='')
					{
						$value_array 	= array(
													'client_id'			           => $this->input->post('sal_company_name'),
													'credit_number'                =>    $this->input->post('cr_no'),
													'reason'                =>    $this->input->post('reason'),
													'subject'                =>    $this->input->post('subject'),
													'salesorder_id'                =>($this->input->post('sal_client_rep')!='') ? ($this->input->post('sal_client_rep')) : '',	
													'credictnote_createdBy'		    =>  $this->auth_user_id,
													'credict_total'     =>$this->input->post('total'),
													'credict_sub_total' =>$this->input->post('sub_t'),
													'credit_vat_per'    =>$this->input->post('vat_per'),
													'credit_vat_amount' =>$this->input->post('vat_amount'),
													'credit_currency' =>$this->input->post('sal_curency'),
													'balance_amount'   =>$this->input->post('total'),
													'credictnote_createdOn'  		=>  date('Y-m-d H:i:s'),
													'credictnote_updatedBy'			=>  $this->auth_user_id,
													'credictnotes_updatedOn'  		=>  date('Y-m-d H:i:s')
						);

					

						$where_array	=	array('credict_id'=>$this->input->post('credict_id'));
						$resultupdate	=	$this->sal_common->common_edit1('tbl_credicts_notes',$value_array,$where_array);
						$credit_status = $this->input->post('sal_invoice_status');
						if($credit_status==1)
						{
							$this->sal_common->set_pref_no('tbl_preferences','credit_number');
						}

						if($resultupdate)
						{
							$where		=	array('credict_id'=> $this->input->post("credict_id"));
							$result		=	$this->sal_common->common_delete('tbl_credictnotes_item',$where);
							$item_Arr		 =	$this->input->post('item');
							$item_Arr_Arabic =	$this->input->post('itemarabic');
							$qtyArr	 =	$this->input->post('qty');
							$unit_priceArr		 = 	$this->input->post('unit_price');
							$total_amontArr		 = 	$this->input->post('total_amont');
							$grand_total = array_sum($total_amontArr);
							$sl_noArr		 = 	$this->input->post('slno');
							$unitArr		 = 	$this->input->post('unit');
							$wbno   = $this->input->post('wbno');
						    foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'credict_id'		     =>	$this->input->post('credict_id'),
															'item_description'	     =>	$item_Arr[$key],
															'item_description_arabic'=>	$item_Arr_Arabic[$key],
															'unit'             => $unitArr[$key],
															'qty'		             =>	$qtyArr[$key],
															'unit_price'             => $unit_priceArr[$key],
															'total'		             => $total_amontArr[$key],
														
														);

									$this->sal_common->common_insert('tbl_credictnotes_item',$value_array1);
								}

							}
							// $inv_total = $this->input->post('invoice_total');
							// // $balance_amount = $inv_total - $grand_total;
							// $balance_amount = $grand_total;
							// 	$value_arraytotal 	=	array(
							// 									'credict_total'		     =>	$grand_total,
							// 									'invoice_total'         => $inv_total,
							// 									'balance_amount'   =>$balance_amount,
							// 								  );
							
							// 		$where_arraytotal 	=	array('credict_id' =>$this->input->post('credict_id'));
									

							// 		$this->sal_common->common_edit('tbl_credicts_notes',$value_arraytotal,$where_arraytotal);
						}
					}
					else
					{
						$credit_status = $this->input->post('sal_invoice_status');
						$credit_order_num	= 	$this->sal_common->getCriditNoteNo();
						$credit_order_performanum 	= 	$this->sal_common->getPer_CriditNoteNo();
						if($credit_status == 0)
						{
						$value_array 	= array(
													'client_id'			=> $this->input->post('sal_company_name'),
													'credit_number'  => $this->input->post('cr_no'),
													'reason'                =>    $this->input->post('reason'),
													'subject'                =>    $this->input->post('subject'),
													'salesorder_id' =>($this->input->post('sal_client_rep')!='') ? ($this->input->post('sal_client_rep')) : '',	
													'credictnote_createdBy'			=>  $this->auth_user_id,
													'credict_total'     =>$this->input->post('total'),
													'credict_sub_total' =>$this->input->post('sub_t'),
													'credit_vat_per'    =>$this->input->post('vat_per'),
													'credit_vat_amount' =>$this->input->post('vat_amount'),
													'credit_currency' =>$this->input->post('sal_curency'),
													'balance_amount'   =>$this->input->post('total'),
													'credictnote_createdOn'  			=>  date('Y-m-d H:i:s')
						);
						
						$result	=	$this->sal_common->common_insert('tbl_credicts_notes',$value_array);
						$this->sal_common->set_pref_no('tbl_preferences', 'per_credit_number');
						}
						if($credit_status == 1)
						{
						$value_array 	= array(
													'client_id'			=> $this->input->post('sal_company_name'),
													'credit_number'  =>$credit_order_num,
													'reason'                =>    $this->input->post('reason'),
													'subject'                =>    $this->input->post('subject'),
													'salesorder_id' =>($this->input->post('sal_client_rep')!='') ? ($this->input->post('sal_client_rep')) : '',	
													'credictnote_createdBy'			=>  $this->auth_user_id,
													'credict_total'     =>$this->input->post('total'),
													'credict_sub_total' =>$this->input->post('sub_t'),
													'credit_vat_per'    =>$this->input->post('vat_per'),
													'credit_vat_amount' =>$this->input->post('vat_amount'),
													'credit_currency' =>$this->input->post('sal_curency'),
													'balance_amount'   =>$this->input->post('total'),
													'credictnote_createdOn'  			=>  date('Y-m-d H:i:s')
						);
					
						$result	=	$this->sal_common->common_insert('tbl_credicts_notes',$value_array);
						$this->sal_common->set_pref_no('tbl_preferences', 'credit_number');
						}
						if($result)
						{
							$item_Arr		 =	$this->input->post('item');
							$item_Arr_Arabic =	$this->input->post('itemarabic');
							$qtyArr	 =	$this->input->post('qty');
							$unit_priceArr		 = 	$this->input->post('unit_price');
							$unitArr		 = 	$this->input->post('unit');
							$total_amontArr		 = 	$this->input->post('total_amont');
							
							$grand_total = array_sum($total_amontArr);
							$sl_noArr		 = 	$this->input->post('slno');
	
							$wbno   = $this->input->post('wbno');
						    foreach($qtyArr as $key => $val)
							{
								if($qtyArr[$key]!='')
								{
									$value_array1 = array
														(									
															'credict_id'		=>	$result,
															'item_description'	=>	$item_Arr[$key],
															'item_description_arabic'	=>	$item_Arr_Arabic[$key],
															'unit' => $unitArr[$key],
															'qty'		=>	$qtyArr[$key],
															'unit_price'     => $unit_priceArr[$key],
															'total'		=> $total_amontArr[$key],
													
														);
													
									$this->sal_common->common_insert('tbl_credictnotes_item',$value_array1);
								}
							

							}
							// $inv_total = $this->input->post('invoice_total');
							// // $balance_amount = $inv_total - $grand_total;
							// $balance_amount = $grand_total;
							// 	$value_arraytotal 	=	array(
							// 									'credict_total'		     =>	$grand_total,
							// 									'invoice_total'         => $inv_total,
							// 									'balance_amount'   =>$balance_amount,
							// 								  );
							
							// 		$where_arraytotal 	=	array('credict_id' =>$result);


							// 		$this->sal_common->common_edit('tbl_credicts_notes',$value_arraytotal,$where_arraytotal);
						}

					}
				

				
			}
			if($result)
			{
			
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('Credict_notes'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('Credict_notes'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
		
	}
}

	public function operation( $id = '' )
	{
		$saleorder_id				=	$this->sal_common->get_invoice_saleorder_id($id);
		// $invoice_type = $this->sal_common->get_credit_invoice_type($id);
		$where_array=array(
							'credict_id'=>$id
						);
		$data['value']=$this->common->get_fulldata('tbl_credicts_notes',$where_array);
		$data['evalue']	=	$this->sal_common->get_credict_notes_items($id);
		$where_arraysal	=	array('sal_id'=>$saleorder_id);
		$data['sal_data']	=	$this->sal_common->get_fulldata('sales_order',$where_arraysal);

		$this->add_credict_notes($data);
	}
		
	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
		$value_array=array(
							'credict_note_delete_status'			=>'0',
							'credictnote_updatedBy'	    => $this->auth_user_id,
							'credictnotes_updatedOn'  		=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'credict_id'=>$id
						   );
		$result=$this->common->common_edit(' tbl_credicts_notes',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('Credict_notes'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
	}
	

	public function getPartNoContent()
	{
		$msg['i']	=	$this->input->get('i');
		echo $this->load->view('masters/client/addaddress',$msg,TRUE);
	}
	
public function loadaddress()
{
	$Customer_id 		= $this->input->get('con_id');
	$drop_menu_address 	= $this->sal_common->drop_menu_invoice_no($Customer_id);
	echo form_dropdown('sal_client_rep', $drop_menu_address, set_value('sal_client_rep', (isset($sal_client_rep)) ? $sal_client_rep : ''), $attrib);
}
public function get_invoice_data()
{
	$id = $this->input->get('invoice_num');

	$msg['invoice_items'] = $this->mpurchase->get_invoice_items($id);
	echo $this->load->view('credict_notes/credict_items', $msg,TRUE);
}
public function printCredict_notes($id='' )
{
	$saleorder_id			=	$this->sal_common->get_invoice_saleorder_id($id);
	$client_id				=	$this->sal_common->get_invoice_client_id($id);
	$where_array			=	array('sal_id'=>$saleorder_id);
	$data['value']			=	$this->sal_common->get_fulldata('sales_order',$where_array);
	$data['evalue']			=	$this->sal_common->get_credict_notes_items($id);
	$where_array2			=	array( 'id'=>$client_id );
	$where_arraycredit		=	array( 'credict_id'=>$id );
	$data['organization_detail']    =   $this->common->getCompanyProfiles('1');	
	$data['company_detail']			=	$this->sal_common->get_fulldata('tbl_client',$where_array2);
	$bank_id				   =	$this->sal_common->get_bank_id($saleorder_id);
	$where_arraybank					=	array(
													'bank_id'=>$bank_id
												);
		$data['bank_detail']			=	$this->sal_common->get_fulldata('tbl_bank_details',$where_arraybank);
	$data['credict_data']			=	$this->sal_common->get_fulldata('tbl_credicts_notes',$where_arraycredit);
	$this->load->view('credict_notes/Cr_print', $data); 

}
public function printCredict_notes1($id='' )
{
	$saleorder_id			=	$this->sal_common->get_invoice_saleorder_id($id);
	$client_id				=	$this->sal_common->get_invoice_client_id($id);
	$where_array			=	array('sal_id'=>$saleorder_id);
	$data['value']			=	$this->sal_common->get_fulldata('sales_order',$where_array);
	$data['evalue']			=	$this->sal_common->get_credict_notes_items($id);
	$where_array2			=	array( 'id'=>$client_id );
	$where_arraycredit		=	array( 'credict_id'=>$id );
	$data['organization_detail']    =   $this->common->getCompanyProfiles('1');	
	$data['company_detail']			=	$this->sal_common->get_fulldata('tbl_client',$where_array2);
	$bank_id				   =	$this->sal_common->get_bank_id($saleorder_id);
	$where_arraybank					=	array(
													'bank_id'=>$bank_id
												);
		$data['bank_detail']			=	$this->sal_common->get_fulldata('tbl_bank_details',$where_arraybank);
	$data['credict_data']			=	$this->sal_common->get_fulldata('tbl_credicts_notes',$where_arraycredit);
	$this->load->view('credict_notes/Cr_printwithHeader', $data); 

}
public function get_credit_no()
{
	$cr_prifix = $this->sal_common->getCriditNoteNoprefix();
			$cr_num =$this->sal_common->getCriditNoteNonumber();
			$cr_padd_num = str_pad($cr_num, 4, "0", STR_PAD_LEFT);
			$invoiceNumber = $cr_prifix.$cr_padd_num;
	echo $invoiceNumber;
}
public function get_credit_perfoma_no()
{
	// $invoiceNumber 	= 	$this->sal_common->getPer_CriditNoteNo();
		$cr_prifix = $this->sal_common->getPer_CriditNoteNoprefix();
			$cr_num =$this->sal_common->getPer_CriditNoteNonumber();
			$cr_padd_num = str_pad($cr_num, 4, "0", STR_PAD_LEFT);
			$invoiceNumber = $cr_prifix.$cr_padd_num;
	echo $invoiceNumber;
}
public function getInvoiceTotal()
{
	$id = $this->input->get('invoice_num');
	$total 	= 	$this->sal_common->find_invoice_total($id);
	echo $total;
}
public function get_vat_per()
{
	$id = $this->input->get('invoice_num');
	$vat 	= 	$this->sal_common->find_invoice_vat_per($id);
	echo $vat;
}
public function get_vat_amount()
{
	$id = $this->input->get('invoice_num');
	$vat_amount 	= 	$this->sal_common->find_invoice_vat_amount($id);
	echo $vat_amount;
}
public function getInvoice_Type()
{
	$id = $this->input->get('invoice_num');
	$type 	= 	$this->sal_common->find_invoice_type($id);
	echo $type;
}
public function getInvoice_subTotal()
{
	$id = $this->input->get('invoice_num');
	$sub_total 	= 	$this->sal_common->find_invoice_sub_total($id);
	echo $sub_total;
}
public function addAttachment($id = '')
{
	
	if(isset($_POST['submit']))
            {

            	$value_array=array(
					'credict_id'				=>	($this->input->post('credict_id')!='') ? $this->input->post('credict_id') : '',
					'attachement_type_name'	=>	($this->input->post('attachement_type_name')!='') ? $this->input->post('attachement_type_name') : ''
				);

				
				if($_FILES['attachement_file_name']['name']!='')
				{
					$config = array();
					$config['upload_path'] = 'MasterAttachments/~cdn/CredictNotes/attachment/';
					$config['allowed_types'] = 'gif|jpg|png|pdf';
					$config['max_size'] = '5000';
					$config['max_width'] = '3500';
					$config['max_height'] = '3500';
					$config['max_filename'] = '500';
					$config['overwrite'] = false;
					$this->upload->initialize($config);
					$this->load->library('image_lib');
					$this->load->library('upload', $config);
					$images = array();

					if($this->upload->do_upload('attachement_file_name'))
					{	
						$this->load->helper('inflector');
						$file_name = underscore($_FILES['attachement_file_name']['name']);
						$config['file_name'] = $file_name;
						$image_data['message'] = $this->upload->data(); 

						$_POST[attachement_file_name]="MasterAttachments/~cdn/CredictNotes/attachment/".$image_data['file_name'];
						$_POST[attachement_file_size]= $_FILES['attachement_file_name']['size'];
						$_POST[attachement_file_type]= $_FILES['attachement_file_name']['type'];
					} 
					else
					{
						$data['attachement_file_name'] = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
						$this->form_validation->set_rules('attachement_file_name', $this->upload->display_errors(), 'required');                
					}	
				}

                if($this->input->post('attachement_welder_id')!='')
				{
					
					$resultupdate=1;
				}
				else
				{
					if($_FILES['attachement_file_name']['name']!=''){
						//if($alreadyExistRecord == '' && $alreadyExistRecord == 0 && $this->input->post('welderID')!=''){

							$value_array['attachement_file_name'] = ($this->input->post('attachement_file_name')!='') ? $this->input->post('attachement_file_name') : '';
							$value_array['attachement_file_size'] = ($this->input->post('attachement_file_size')!='') ? $this->input->post('attachement_file_size') : '';
							$value_array['attachement_file_type'] = ($this->input->post('attachement_file_type')!='') ? $this->input->post('attachement_file_type') : '';
						            
							$result=$this->mcommon->common_insert('tbl_credit_notes_attachement',$value_array);
						/*} else {
							$resultExistRecord=1;
						}*/
					}
				}
				
	            //}       
            }


            if($result){ 
            	$view_data['result'] = 'Success';
        		$view_data['res_type'] = 'success';
        		$view_data['res'] = 'Added Successfully';
            	echo json_encode($view_data);
            }elseif($resultupdate){             	
            $view_data['result'] = 'Success1';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Updated Successfully';
        
            echo json_encode($view_data);
            } 
            else{
            	if(isset($_GET['credit_id'])){
            	
            		$view_data['credit_id'] = $_GET['credit_id'];
            	}else{
            		$view_data['credit_id'] = $this->input->post('credit_id');
            	}


            	/*echo "<pre>";
            	print_r($view_data);
            	echo "</pre>";
*/
               echo $this->load->view('credict_notes/attachmentModal', $view_data,TRUE);
            }
	
}

 	public function paymentdetail( $id='' )
 	{
 		if($this->require_min_level(1))
        {
			$msg['value']=$this->sal_common->get_fulldata(' tbl_credicts_notes',array('credict_id'=>$id));
		
			$msg['organization_detail']=$this->sal_common->get_fulldata('tbl_org_profile',array('org_id'=>'1'));
			
			$organization_detail    =   $this->common->getCompanyProfiles('1');	
		foreach($organization_detail->result() as $row) 
		{
			$company_abb 	=	$row->c_org_abb;
			
		}
		
				$msg['spvalue']=$this->sal_common->get_credict_notes_items($id);
		

		
		

		$saleorder_id				=	$this->sal_common->get_invoice_saleorder_id($id);
		$msg['client_id']			=	$this->sal_common->get_invoice_client_id($id);
	
		$where_arraySal	=	array('sal_id'=>$saleorder_id);
	    $msg['valuesal']	=	$this->sal_common->get_fulldata('sales_order',$where_arraySal);
	   	foreach($msg['valuesal']->result() as $row)
			{
				$con_id=$row->sal_company_name;
			}

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
				'title'     => 'Credit Note Management',
				'content'   =>$this->load->view('credict_notes/paymentDetails',$msg,TRUE)
			);

			
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
 	}
 	public function applyInvoice($credit_id ='',$client_id ='' )
	{
	  
        parse_str($_POST['postdata'], $_POST);//This will convert the string to array
        if(isset($_POST['submit']))
        {

        	$inv_numArr      =	$this->input->post('inv_num');
			$inv_idArr	     =	$this->input->post('inv_id');
			$inv_dateArr	 = 	$this->input->post('inv_date');
			$inv_amtArr		 = 	$this->input->post('inv_amt');
			$inv_balArr		 = 	$this->input->post('inv_bal');
			$amount_crtArr   =  $this->input->post('amount_crt');
			$credit_balance  =  $this->input->post('credit_bal');
			$credit_id       =  $this->input->post('credit_id');
			foreach($inv_numArr as $key => $val)
							{
								$invoice_id         	=   $inv_idArr[$key];
								$inv_numArr1		    =	$inv_numArr[$key];
								$credict_amont          =   $amount_crtArr[$key];
								$invoice_paid_amount    = $this->common->find_invoice_paid_amount($invoice_id);
								$new_paid_amount = $invoice_paid_amount + $credict_amont ;
								$value_arraytotal 	=	array(
															'paid_amount'		     =>	$new_paid_amount,
															
												);
							
					            $where_arraytotal 	=	array('sal_id' =>$invoice_id  );
					            $result= $this->sal_common->common_edit('sales_order',$value_arraytotal,$where_arraytotal);

					            // Update cridict Blance 
					            $credit_balance_amount    = $this->common->find_credict_balance_amount($credit_id);
					            $new_balance = $credit_balance_amount - $credict_amont ;
					            $value_array_credit_balance 	=	array(
															'balance_amount'		     =>	$new_balance,
															
												);
							
					            $where_array_credit_balance 	=	array('credict_id' =>$credit_id  );
					            $this->sal_common->common_edit(' tbl_credicts_notes',$value_array_credit_balance,$where_array_credit_balance);



					             $invoice_updated_paid_amount    = $this->common->find_invoice_paid_amount($invoice_id);

					               $invoice_total_amount    = $this->common->find_invoice_sal_grand_total($invoice_id);
					               if($invoice_updated_paid_amount >= $invoice_total_amount)
					               {
					               	$value_arraypayment_status 	=	array(
															'payment_status'		     =>	'1',);
							
									$where_arraypayment_status 	=	array('sal_id' =>$invoice_id );


				                   $this->sal_common->common_edit('sales_order',$value_arraypayment_status,$where_arraypayment_status);
					               }

							}
							 $credit_balance_amount_last    = $this->common->find_credict_balance_amount($credit_id);
							  $credit_total_amount    = $this->common->find_credict_total_amount($credit_id);
							 if($credit_balance_amount_last  =='0')
							 {
							 	  $value_array_credit_status 	=	array(
															'credit_status'		     =>	'1',
															
												);
							
					            $where_array_credit_status 	=	array('credict_id' =>$credit_id  );
					            $this->sal_common->common_edit('tbl_credicts_notes',$value_array_credit_status,$where_array_credit_status);
							 }
				
				

        }   

        if($result){ 
        	$view_data['result'] = 'Success';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Added Successfully';
            echo json_encode($view_data);
           
        }
        else if($resultupdate){ 
        	$view_data['result'] = 'Success1';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Added Successfully';
        
            echo json_encode($view_data);
           
        }
         else{

        	$client_id 				=  $this->input->get('client_id');
        	$credit_id				=  $this->input->get('credit_id');
        	$view_data['client_id'] = $client_id;
        	$view_data['credit_data']=	$this->common->get_credit_notes_num($credit_id);
        	$view_data['values'] = $this->common->GetCreditInvoiceDetails($client_id);
 			echo $this->load->view('credict_notes/applyinvoice',$view_data,TRUE);	
        }                       
	
}
public function PrintModal()
{
	$view_data['id'] 				=  $this->input->get('invoice_id');
 	echo $this->load->view('credict_notes/print_modal',$view_data,TRUE);	
        
}
}
?>