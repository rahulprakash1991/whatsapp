<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_type extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
	}


	public function index($msg)
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'masters/Contact_type/add';
	        $msg['form_toptittle']	=	'Contact Type Management';
        	$msg['datatable_url']	=	'masters/Contact_type/datatable';
        

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 

			$this->table->set_heading('Operation', 'Name', 'Status', 'Created By', 'Created On', 'Updated By', 'Updated On');
			
 			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model;
 			
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Contact Type Management',
								'content'   =>	$this->load->view('masters/Contact_type/viewform',$msg,TRUE)
							);
			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.ct_id, b.ct_name,b.ct_status, u.username, b.created_on,v.username AS s, b.updated_on')
		->from('tbl_contact_type AS b')
		->join('users AS u', 'u.user_id = b.created_by','left')
		->join('users AS v', 'v.user_id = b.updated_by','left')
		->where('b.ct_delete_status=1')
		->edit_column('b.ct_id', get_buttons_new('$1','masters/Contact_type/'), 'b.ct_id');
		$this->datatables->edit_column('b.created_on', '$1', 'get_date_timeformat(b.created_on)');
		$this->datatables->edit_column('b.updated_on', '$1', 'get_date_timeformat(b.updated_on)');
		$this->datatables->edit_column('b.ct_status', '$1', 'get_statusbase(b.ct_status)');
		echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('ct_name', 'Contact Type', 'required');
				


				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('ct_id')!='')
					{

						$value_array=array(
									'ct_name'			=>$this->input->post('ct_name'),				
									'created_by'	    => $this->auth_user_id,
									'created_on'  		=> date('Y-m-d H:i:s'),
									'updated_by'	    => $this->auth_user_id,
									'updated_on'  		=> date('Y-m-d H:i:s'),
									'ct_status'      	=> $this->input->post('ct_status'),
									);

						$where_array=array(
											'ct_id'=>$this->input->post('ct_id')
										);
						$resultupdate=$this->mcommon->common_edit('tbl_contact_type',$value_array,$where_array);
					}
					else
					{
						$value_array=array(
									'ct_name'			=>$this->input->post('ct_name'),					
									'created_by'	    => $this->auth_user_id,
									'created_on'  		=> date('Y-m-d H:i:s'),
									'updated_by'	    => $this->auth_user_id,
									'updated_on'  		=> date('Y-m-d H:i:s'),
									'ct_status'      	=> $this->input->post('ct_status'),
									);

						$result=$this->mcommon->common_insert('tbl_contact_type',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Contact_type'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Contact_type'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
		
	}

	public function customAlpha($str) 
	{
	    if ( !preg_match('/^[A-Za-z .,\-]+$/i',$str) )
	    {
	        return false;
	    }
	}

	public function operation($id)
	{
		
		$where_array=array(
							'ct_id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_contact_type',$where_array);
		$this->index($data);
	}

	public function delete($id)
	{
		$value_array=array(
							'ct_delete_status'		=>'0',
							'created_by'	    => $this->auth_user_id,
							'created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'ct_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_contact_type',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Contact_type'), 'refresh');
		}else
		{
			$this->index($data);
		}

	}


}
?>