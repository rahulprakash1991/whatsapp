<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desgination extends MY_Controller {

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
			$msg['form_url']		=	'masters/Desgination/add';
	        $msg['form_toptittle']	=	'Desgination Management';
        	$msg['datatable_url']	=	'masters/Desgination/datatable';

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Operation', 'Name', 'Status', 'Created By', 'Created On', 'Updated By', 'Updated On');
			
 			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model;
 			
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Desgination Management',
								'content'   =>	$this->load->view('masters/desgination/viewform',$msg,TRUE)
							);
			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.desgination_id, b.desgination_name, b.desgination_status, u.username, b.created_on, v.username AS s, b.updated_on')
		->from('tbl_desgination AS b')
		->join('users AS u', 'u.user_id = b.created_by','left')
		->join('users AS v', 'v.user_id = b.updated_by','left')
		->where('b.desgination_delete_status=1')
		->edit_column('b.desgination_id', get_buttons_new('$1','masters/Desgination/'), 'b.desgination_id');
		$this->datatables->edit_column('b.created_on', '$1', 'get_date_timeformat(b.created_on)');
		$this->datatables->edit_column('b.updated_on', '$1', 'get_date_timeformat(b.updated_on)');
		$this->datatables->edit_column('b.desgination_status', '$1', 'get_statusbase(b.desgination_status)');
		echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('desgination_name', 'Desgination', 'required');
				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('desgination_id')!='')
					{
						$value_array 	=	array(
													'desgination_name'		=> $this->input->post('desgination_name'),				
													'created_by'	    	=> $this->auth_user_id,
													'created_on'  			=> date('Y-m-d H:i:s'),
													'updated_by'	    	=> $this->auth_user_id,
													'updated_on'  			=> date('Y-m-d H:i:s'),
													'desgination_status'	=> $this->input->post('desgination_status'),
												);
						$where_array 	= 	array('	desgination_id' => $this->input->post('desgination_id'));
						$resultupdate 	=	$this->mcommon->common_edit('tbl_desgination',$value_array,$where_array);
					}
					else
					{
						$value_array 	=	array(
													'desgination_name'	=> $this->input->post('desgination_name'),					
													'created_by'	    => $this->auth_user_id,
													'created_on'  		=> date('Y-m-d H:i:s'),
													'updated_by'	    => $this->auth_user_id,
													'updated_on'  		=> date('Y-m-d H:i:s'),
													'desgination_status'	=> $this->input->post('desgination_status'),
												);
						$result=$this->mcommon->common_insert('tbl_desgination',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Desgination'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Desgination'), 'refresh');
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
		$where_array 	=	array('desgination_id' => $id);
		$data['value'] 	=	$this->mcommon->get_fulldata('tbl_desgination',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array =array(
							'desgination_delete_status'		=>'0',
							'created_by'	    => $this->auth_user_id,
							'created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'desgination_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_desgination',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Desgination'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
}
?>