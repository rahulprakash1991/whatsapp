<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_role extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'masters/User_role/add';
	        $msg['form_toptittle']	=	'User Role Management';
        	$msg['datatable_url']	=	'masters/User_role/datatable';
        	$msg['getACLActions']   =	$this->mcommon->getACLActions();

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Operation', 'User Role', 'Status', 'Created By', 'Created On', 'Updated By', 'Updated On');
			
 			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model;
 			
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'User Role Management',
								'content'   =>	$this->load->view('masters/user_role/viewform',$msg,TRUE)
							);
			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.role_id, b.role_name, b.role_status, u.username, b.created_on, v.username AS s, b.updated_on')
		->from('tbl_user_role AS b')
		->join('users AS u', 'u.user_id = b.created_by','left')
		->join('users AS v', 'v.user_id = b.updated_by','left')
		->where('b.role_delete_status=0')
		->edit_column('b.role_id', get_buttons_new('$1','masters/User_role/'), 'b.role_id');
		$this->datatables->edit_column('b.created_on', '$1', 'get_date_timeformat(b.created_on)');
		$this->datatables->edit_column('b.updated_on', '$1', 'get_date_timeformat(b.updated_on)');
		$this->datatables->edit_column('b.role_status', '$1', 'get_statusbase(b.role_status)');
		echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('role_name', 'User role', 'required');
				$aclActions = $this->input->post('acl_actions[]');

				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('role_id')!='')
					{
						$value_array 	=	array(
													'role_name'				=> $this->input->post('role_name'),				
													'created_by'	    	=> $this->auth_user_id,
													'created_on'  			=> date('Y-m-d H:i:s'),
													'updated_by'	    	=> $this->auth_user_id,
													'updated_on'  			=> date('Y-m-d H:i:s'),
													'role_status'			=> $this->input->post('role_status'),
												);
						$where_array 	= 	array('role_id' => $this->input->post('role_id'));
						$resultupdate 	=	$this->mcommon->common_edit('tbl_user_role', $value_array, $where_array);

						//ACL actions updated in user roles
						$this->db->delete('acl_role', $where_array);

						foreach ($aclActions as $action_id) {
							$this->mcommon->common_insert('acl_role', array('action_id' => $action_id, 'role_id' => $this->input->post('role_id')));
						}
					}
					else
					{
						$value_array 	=	array(
													'role_name'			=> $this->input->post('role_name'),					
													'created_by'	    => $this->auth_user_id,
													'created_on'  		=> date('Y-m-d H:i:s'),
													'updated_by'	    => $this->auth_user_id,
													'updated_on'  		=> date('Y-m-d H:i:s'),
													'role_status'		=> $this->input->post('role_status'),
												);
						$result=$this->mcommon->common_insert('tbl_user_role', $value_array);
						
						//ACL actions added in user roles
						foreach ($aclActions as $action_id) {
							$this->mcommon->common_insert('acl_role', array('action_id' => $action_id, 'role_id' => $result));
						}
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/User_role'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/User_role'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
	}

	public function customAlpha( $str ='' ) 
	{
	    if (!preg_match('/^[A-Za-z .,\-]+$/i',$str))
	    {
	        return false;
	    }
	}

	public function operation( $id = '' )
	{
		$where_array 			=	array('role_id' => $id);
		$data['value'] 			=	$this->mcommon->get_fulldata('tbl_user_role',$where_array);
		$data['aclActions'] 	=	$this->mcommon->records_all('acl_role',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array =array(
							'role_delete_status'		=>'1',
							'created_by'	    => $this->auth_user_id,
							'created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'role_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_user_role',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/User_role'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
}
?>