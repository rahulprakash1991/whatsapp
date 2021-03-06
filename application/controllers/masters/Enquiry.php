<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->library('upload');
		$this->load->helper('datatables_helper');
		$this->load->model('Mdropdown','Mdropdown',TRUE);
			$this->load->model('Purchaseorder','mpurchase',TRUE);
		

	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			// $msg['form_url']			=	'masters/Client/add';
	        $msg['form_toptittle']		=	'Enquiry  Management';
        	$msg['datatable_url']		=	'masters/Enquiry/datatable';
     
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','View','Enq No','Client Name', 'Department', 'Mode', 'Client Representative','Enq Reference'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Enquiry  Management',
							'content'   =>	$this->load->view('masters/enquiry/viewform',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('c.id,q.qus_id as qus,c.enq_key,c1.client_name,d.department_name,cm.name,cr.rep_name,c.enq_ref,c.id as enq_id')
        ->from('tbl_enquiry AS c')
     
       	->join('tbl_client AS c1', 'c1.id = c.client_id','left')
       	->join('tbl_quotes AS q', 'q.enq_id = c.id','left')
       	->join('tbl_department AS d', 'd.department_id = c.department_id','left')
       	->join('contact_mode AS cm', 'cm.id = c.mode_id','left')
       	  ->join('tbl_client_rep AS cr', 'cr.id = c.client_rep_id','left')
       
        ->where('c.enq_delete_status',1)
		->edit_column('c.id', get_buttons_new('$1','masters/Enquiry/'), 'c.id');
		$this->datatables->edit_column('qus', '$1','get_create_quote_button1(qus,masters/Enquiry/,enq_id)');
				
		// $this->datatables->edit_column('qus', '$1','get_create_quote_button(qus,Quotation/,enq_id)');
		
        echo $this->datatables->generate();
    }


	public function add_enquiry( $msg = array() )
	{  

		
		if($this->require_min_level(1))
        {
			$msg['form_url']			=	'masters/Enquiry/add';
			$msg['form_cancel_url']			='masters/Enquiry';
	        $msg['form_toptittle']		=	'Enquiry Management';	
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 			$msg['drop_menu_client']	=	$this->Mdropdown->drop_menu_client();
 			$msg['drop_menu_department']	=	$this->Mdropdown->drop_menu_department();
 			$msg['drop_menu_mode']	=	$this->Mdropdown->drop_menu_mode();
 			
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Enquiry Management',
							'content'   =>	$this->load->view('masters/enquiry/add_enquiry',$msg,TRUE)
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

				$this->form_validation->set_rules('client_name', 'Client Name', 'required');
			
						
			
				if($this->form_validation->run() == TRUE) 
				{	
					$enq_date		=	($this->input->post('response_date')!='') ? date('Y-m-d', strtotime($this->input->post('response_date'))) : date('Y-m-d');
				
					if($this->input->post('enquiry_id')!='')
					{
						$value_array	=	array(
													'client_id'			=>	$this->input->post('client_name'),
													'department_id'			=>	$this->input->post('depatment'),
													'mode_id'			=>	$this->input->post('mode'),
													'client_rep_id'			=>	$this->input->post('client_rep'),
													'enq_ref'				=>	$this->input->post('reff'),
													'enq_ref_date'	    =>	$enq_date,
													'enq_notes'	        =>	$this->input->post('enq_note'),
													'enq_created_by'	=> 	$this->auth_user_id,
													'enq_created_on'   => 	date('Y-m-d H:i:s'),
													'enq_updated_by'	=> 	$this->auth_user_id,
													'enq_updated_on'   => 	date('Y-m-d H:i:s'),
												);
					
								$where_array	=	array('id'=>$this->input->post('enquiry_id'));
								$resultupdate	=	$this->mcommon->common_edit('tbl_enquiry',$value_array,$where_array);
					}
					else
					{
						
						$enq_prifix = $this->mpurchase->getEnqPrifix();
						$enq_num =$this->mpurchase->getEnqNum();
						$enq_suffix =$this->mpurchase->getEnqSuffix();
						$enq_padd_num = str_pad($enq_num, 4, "0", STR_PAD_LEFT);
						$enq_number= $enq_prifix.$enq_padd_num.$enq_suffix;
						$value_array	=	array(
													'enq_key'           =>$enq_number,
													'client_id'			=>	$this->input->post('client_name'),
													'department_id'			=>	$this->input->post('depatment'),
													'mode_id'			=>	$this->input->post('mode'),
													'client_rep_id'			=>	$this->input->post('client_rep'),
													'enq_ref'				=>	$this->input->post('reff'),
													'enq_ref_date'	    =>	$enq_date,
													'enq_notes'	        =>	$this->input->post('enq_note'),
													'enq_created_by'	=> 	$this->auth_user_id,
													'enq_created_on'   => 	date('Y-m-d H:i:s'),
													'enq_updated_by'	=> 	$this->auth_user_id,
													'enq_updated_on'   => 	date('Y-m-d H:i:s'),
													
												);

			
						$result=$this->mcommon->common_insert('tbl_enquiry',$value_array);
						if($result)
						{
							$this->mcommon->set_pref_no('tbl_preferences',	'enq_number');
						}

					}
				}
			}
			if($result1)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Enquiry'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Enquiry'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
		
	}


	public function operation( $id = '' )
	{
		
		$where_array=array(
							'id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_enquiry',$where_array);
		$client_id = $this->mcommon->find_client_id($id);
		
		$data['drop_menu_client_rep']	=	$this->Mdropdown->drop_menu_client_rep_enq($client_id);
		$this->add_enquiry($data);
	}
		
	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
		$value_array=array(
							'enq_delete_status'			=>'0',
							'enq_created_by'	    => $this->auth_user_id,
							'enq_created_on'  		=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_enquiry',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Enquiry'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
	}
	public function addClientRep()
	{
		
			
		$view_data['drop_menu_client']	=	$this->Mdropdown->drop_menu_client();
		$view_data['drop_menu_title']	=	$this->Mdropdown->drop_menu_title();
		$view_data['drop_menu_designation']	=	$this->Mdropdown->drop_menu_designation();
		
        parse_str($_POST['postdata'], $_POST);//This will convert the string to array
        if(isset($_POST['submit']))
        {
				
				if($this->input->post('rep_id')!='')
				{
				
					$value_array=array(
					'client_id'				=>	strtoupper($this->input->post('client_name')),
					'title_id'				=>	strtoupper($this->input->post('title')),
					'rep_name'				=>	strtoupper($this->input->post('rep_name')),
					'email'					=>	strtoupper($this->input->post('email')),
					'mobile'				=>	strtoupper($this->input->post('contact_num')),
					'mobile1'				=>	strtoupper($this->input->post('contact_num1')),
					'designation'			=>	strtoupper($this->input->post('designation')),
				);
				$where_array	=	array('id'=>$this->input->post('rep_id'));
				$resultupdate	=	$this->mcommon->common_edit('tbl_client_rep',$value_array,$where_array);
				}
				else
				{
				
					$value_array=array(
					'client_id'				=>	strtoupper($this->input->post('client_name')),
					'title_id'				=>	strtoupper($this->input->post('title')),
					'rep_name'				=>	strtoupper($this->input->post('rep_name')),
					'email'					=>	strtoupper($this->input->post('email')),
					'mobile'				=>	strtoupper($this->input->post('contact_num')),
					'mobile1'				=>	strtoupper($this->input->post('contact_num1')),
					'designation'			=>	strtoupper($this->input->post('designation')),
				);
				$result=$this->mcommon->common_insert('tbl_client_rep',$value_array);	
				}

        }

        $fields_arraycat = array(
    		'ts.id','ts.name'
    	);
    	
		$data['drop_menu_client_rep']	=	$this->Mdropdown->drop_menu_client_rep();
    	// $data['drop_down_cat'] =   $this->mcommon->join_records_all($fields_arraycat, 'transmittal_cat as ts','','','', '`ts.id` ASC ','object');
		$view_data['datatablevalueForm'] = $this->load->view('masters/enquiry/client_rep_drop_down',$data,TRUE);

        if($result){ 
        	$view_data['result'] = 'Success';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Added Successfully';
            echo json_encode($view_data);
           
        }
        else if($resultupdate){ 
        	$view_data['result'] = 'Success1';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Updated Successfully';
        
            echo json_encode($view_data);
           
        }
         else{

        	$id 				=  $this->input->get('rep_id');
        	$view_data['values'] = $this->mcommon->get_fulldata('tbl_client_rep',array('id'=>$id));
 			echo $this->load->view('masters/enquiry/clientrep',$view_data,TRUE);	
        }
	}
	public function view_enquiry($id)
	{
		
		if($this->require_min_level(1))
        {
        	
			$msg['form_url']			=	'masters/Enquiry/add';
			$msg['form_cancel_url']			='masters/Enquiry';
	        $msg['form_toptittle']		=	'Enquiry Details';	
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 			$msg['enq_id'] = $id;
 			$msg['quote_id'] = $this->mcommon->find_quote_id($id);
 			$msg['quote_value'] = $this->mcommon->find_quote_value($id);
 			$msg['quote_key'] = $this->mcommon->find_quote_key($id);
 			$fields_arrayPackage = array(
			'e.id','d.department_name','m.name','cr.rep_name','cr.email','cr.mobile','cr.designation','e.enq_ref_date','c.client_name','c.client_email','c.client_mobile','e.client_id','e.enq_key,cr.id as rep_id,u.username'
			);
			$join_arrayPackage = array(
			'tbl_client AS c' => 'c.id = e.client_id',
			' tbl_department AS d' => 'd.department_id = e.department_id',
			' contact_mode AS m' => 'm.id = e.mode_id',
			' tbl_client_rep AS cr' => 'cr.id = e.client_rep_id',
			// 'rfi_project AS p' => 't.transmittal_project = p.project_id',
			'users AS u' => 'u.user_id = e.enq_created_by',
			// 'jr_staffs as s'    => "s.user_id = u2.id",
			// 'transmittal_status as ts'    => 'ts.id = t.transmittal_status',
			// 'transmittal_response_status as trs'    => 'trs.id = t.sapid_response',
			
		);

		$where_arrayPackage = array('e.id' =>$id);

		
		$msg['value'] = $this->mcommon->join_records_all($fields_arrayPackage,'tbl_enquiry as e', $join_arrayPackage, $where_arrayPackage, '', '`e.id` ASC','object');



 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Enquiry Details',
							'content'   =>	$this->load->view('masters/enquiry/view_enquiry',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function loadaddress()
	{
			$Client_id 		= $this->input->get('con_id');
			$drop_menu_client_rep 	= $this->mcommon->drop_menu_client_rep_name($Client_id);
			echo form_dropdown('sal_customer_address', $drop_menu_client_rep , set_value('sal_customer_address', (isset($sal_customer_address)) ? $sal_customer_address : ''), $attrib);
	}
	
	

}
?>