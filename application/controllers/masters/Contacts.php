<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->model('Mdropdown','Mdropdown',TRUE);
	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']				=	'masters/Contacts/add';
	        $msg['form_toptittle']			=	'Contact Management';
        	$msg['datatable_url']			=	'masters/Contacts/datatable';
        	
			$msg['drop_menu_contact_group']	=	$this->Mdropdown->drop_menu_contact_group();
			$msg['drop_menu_salutation']	=	$this->Mdropdown->drop_menu_salutation();
			$msg['drop_menu_department']	=	$this->Mdropdown->drop_menu_department();
			$msg['drop_menu_currency']		=	$this->Mdropdown->drop_menu_currency();
			$msg['drop_menu_terms']			=	$this->Mdropdown->drop_menu_terms();
			
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation', 'Contact Type', 'Company Name', 'Contact Name', 'Email', 'Phone Number', 'Address', 'Status', 'Created By', 'Created On'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model; 
 			
			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Contacts Management',
								'content'   =>	$this->load->view('masters/contacts/viewform',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function view()
	{
		if($this->require_min_level(1))
        {
			$msg['form_url']		='masters/Contacts/add';
	        $msg['form_toptittle']	='Contact Management';
        	$msg['datatable_url']	='masters/Contacts/datatable';
        	$msg['list_tittle']		='Contacts List';
			
			$tmpl = array ('table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation', 'Contact Type', 'Company Name', 'Contact Person', 'Email', 'Phone Number', 'Status', 'Created By', 'Created On', 'Updated by', 'Updated on'); 
			
			$sessionArr = $this->session->all_userdata();
			$msg['notification'] = $sessionArr['successMsg'];
 			$auth_model = $this->authentication->auth_model; 
			
 			$data	=	array(
								'sidebar'	=>	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Contacts Management',
								'content'   =>	$this->load->view('masters/contacts/viewlist',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}
	
	function datatable()
    {
    	$this->datatables->select('b.con_id, b.con_type, b.con_company_name, b.con_primary ,b.con_email, b.con_phone, b.con_status, u.username, b.con_created_on, v.username AS s, b.updated_on')
			->from('tbl_contacts AS b')
			->join('users AS u', 'u.user_id = b.con_created_by','left')
			->join('users AS v', 'v.user_id = b.updated_by','left') 
			->where('b.con_delete_status','1')		
			->edit_column('b.con_id', get_buttons_new('$1','masters/Contacts/'), 'b.con_id');
		
		$this->datatables->edit_column('b.con_created_on', '$1', 'get_date_timeformat(b.con_created_on)');
		$this->datatables->edit_column('b.updated_on', '$1', 'get_date_timeformat(b.updated_on)');
		$this->datatables->edit_column('b.con_type', '$1', 'get_contype(b.con_type)');
		$this->datatables->edit_column('b.con_status', '$1', 'get_statusbase(b.con_status)');		
        echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('sal_id', 'Salutation', 'required');
				$this->form_validation->set_rules('con_first_name', 'First Name', 'required');
				//$this->form_validation->set_rules('con_last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('con_company_name', 'Company Name', 'required');
				//$this->form_validation->set_rules('con_primary', 'Primary Contact', 'required');
				$this->form_validation->set_rules('con_email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('con_phone', 'Contact', 'required|callback_customAlpha');
				/*$this->form_validation->set_rules('contact_address', 'Address', 'required');
				$this->form_validation->set_rules('contact_area', 'Area', 'required');
				$this->form_validation->set_rules('contact_city', 'City', 'required');
				$this->form_validation->set_rules('contact_state', 'State', 'required');
				$this->form_validation->set_rules('contact_zip', 'Zip', 'required');
				$this->form_validation->set_rules('contact_country', 'Country', 'required');
				$this->form_validation->set_rules('contact_phone', 'Phone', 'required|callback_customAlpha');
				$this->form_validation->set_rules('contact_email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('contact_fax', 'Fax', 'required');
				$this->form_validation->set_rules('contact_website', 'Website', 'required');*/
				$this->form_validation->set_rules('con_payment_terms', 'Payment Terms', 'required');
				$this->form_validation->set_rules('cur_id', 'Currency', 'required');

				if($this->form_validation->run() == TRUE) 
				{	
					$con_primary = 	$this->input->post('con_first_name');
					$con_primary .= ($this->input->post('con_middle_name')) ? ' '.$this->input->post('con_middle_name') : '';
					$con_primary .= ($this->input->post('con_last_name')) ? ' '.$this->input->post('con_last_name') : '';

					if($this->input->post('con_id')!='')
					{
						$value_array	=	array(
													'con_type'				=>	$this->input->post('con_type'),
													'department_id'			=>	$this->input->post('department_id'),
													'sal_id'				=>	$this->input->post('sal_id'),
													'con_primary'			=>	$con_primary,
													'con_first_name'		=>	$this->input->post('con_first_name'),
													'con_middle_name'		=>	$this->input->post('con_middle_name'),
													'con_last_name'			=>	$this->input->post('con_last_name'),
													'con_company_name'		=>	$this->input->post('con_company_name'),
													'con_email'				=>	$this->input->post('con_email'),
													'con_phone'				=>	$this->input->post('con_phone'),
													'cur_id'				=>	$this->input->post('cur_id'),
													'con_payment_terms'		=>	$this->input->post('con_payment_terms'),
													'opening_balance'		=>	$this->input->post('opening_balance'),
													'opening_balance_actual'=>	$this->input->post('opening_balance'),
													'contact_address'		=>	$this->input->post('contact_address'),
													'contact_area'			=>	$this->input->post('contact_area'),
													'contact_city'      	=> 	$this->input->post('contact_city'),
													'contact_state'     	=> 	$this->input->post('contact_state'),
													'contact_zip'			=>	$this->input->post('contact_zip'),
													'contact_country'		=>	$this->input->post('contact_country'),
													'contact_phone'	    	=>	$this->input->post('contact_phone'),
													'contact_email'			=>	$this->input->post('contact_email'),
													'contact_fax'      		=> 	$this->input->post('contact_fax'),
													'contact_website'		=>	$this->input->post('contact_website'),
													'con_notes'		    	=>	$this->input->post('con_notes'),
													'con_created_by'		=> 	$this->auth_user_id,
													'con_created_on'  		=> 	date('Y-m-d H:i:s'),
													'updated_by'			=> 	$this->auth_user_id,
													'updated_on'			=> 	date('Y-m-d H:i:s')
												);

						$where_array	=	array('con_id'	=>	$this->input->post('con_id'));
						$resultupdate	=	$this->mcommon->common_edit('tbl_contacts',	$value_array, $where_array);
						$delete			=	$this->mcommon->common_delete('tbl_address', $where_array);
						
						foreach ($this->input->post('address') as $key => $shipAddress)
						{
							if($shipAddress!='')
							{
								$value_array1	=	array(	
															'con_id'			=>	$this->input->post('con_id'),								
															'sal_address'		=>  $shipAddress,
														 );
								$rerer=$this->mcommon->common_insert('tbl_address',$value_array1);
							}
						}
					}
					else
					{
						$value_array=array(
											'con_type'			=>	$this->input->post('con_type'),
											'department_id' 	=>	$this->input->post('department_id'),
											'sal_id'			=>	$this->input->post('sal_id'),
											'con_primary'		=>	$con_primary,
											'con_first_name'	=>	$this->input->post('con_first_name'),
											'con_middle_name'	=>	$this->input->post('con_middle_name'),
											'con_last_name'		=>	$this->input->post('con_last_name'),
											'con_company_name'	=>	$this->input->post('con_company_name'),
											'con_email'			=>	$this->input->post('con_email'),
											'con_phone'			=>	$this->input->post('con_phone'),
											'cur_id'			=>	$this->input->post('cur_id'),
											'con_payment_terms'	=>	$this->input->post('con_payment_terms'),
											'opening_balance'			=>	$this->input->post('opening_balance'),
											'opening_balance_actual'	=>	$this->input->post('opening_balance'),
											'contact_address'	=>	$this->input->post('contact_address'),
											'contact_area'		=>	$this->input->post('contact_area'),
											'contact_city'      => 	$this->input->post('contact_city'),
											'contact_state'     => 	$this->input->post('contact_state'),
											'contact_zip'		=>	$this->input->post('contact_zip'),
											'contact_country'   =>	$this->input->post('contact_country'),
											'contact_phone'	    =>	$this->input->post('contact_phone'),
											'contact_email'		=>	$this->input->post('contact_email'),
											'contact_fax'      	=> 	$this->input->post('contact_fax'),
											'contact_website'	=>	$this->input->post('contact_website'),
											'con_notes'		    =>	$this->input->post('con_notes'),
											'con_created_by'	=> 	$this->auth_user_id,
											'con_created_on'  	=> 	date('Y-m-d H:i:s'),
											'updated_by'		=> 	$this->auth_user_id,
											'updated_on'		=> 	date('Y-m-d H:i:s')
										);
						
						$result		=	$this->mcommon->common_insert('tbl_contacts', $value_array);
						$contacts	=	$this->mcommon->add_post();
						
						foreach ($this->input->post('address') as $key => $shipAddress)
						{
							if($shipAddress!='')
							{
								$value_array1	=	array(	
															'con_id'			=>  $contacts,					
															'sal_address'		=>  $shipAddress,
														);
								$this->mcommon->common_insert('tbl_address', $value_array1);
							}
						}
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Contacts/view'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Contacts/view'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
		}
    }
	
	public function customAlpha( $str = '' ) 
	{
	    if ( !preg_match('/^[0-9 .,\-]+$/i',$str) )
	    {
	        return false;
	    }
	}

	public function operation( $id = '' )
	{
		$where_array	=	array('con_id'	=>	$id);
		$data['value']	=	$this->mcommon->get_fulldata('tbl_contacts',$where_array);
		$data['evalue']	=	$this->mcommon->get_address($id);
				
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array	=	array(
									'con_delete_status'	=>'0',
									'con_created_by'	=> $this->auth_user_id,
									'con_created_on'  	=> date('Y-m-d H:i:s'),
								  );
						  
		$where_array	=	array('con_id'	=>	$id);
		$result			=	$this->mcommon->common_edit('tbl_contacts', $value_array, $where_array);
		
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Contacts/view'), 'refresh');
		}
		else
		{
			$this->index($data);
		}
	}
	
	public function getPartNoContent()
	{
		$msg['i']	=	$this->input->get('i');
		echo $this->load->view('masters/contacts/addaddress',$msg,TRUE);
	}
	
	public function deleteproduct()
	{
		$res = $this->mcommon->common_delete('tbl_contacts', array('con_id' => $this->input->get('con_id')) );
	}
}
?>
