<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_Management extends MY_Controller {

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
			$msg['form_url']		=	'masters/Vendor_Management/add';
	        $msg['form_toptittle']	=	'Vendor ID Management';
        	$msg['datatable_url']	=	'masters/Vendor_Management/datatable';

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">');
			$this->table->set_template($tmpl);
			$this->table->set_heading('Operation','Vendor Name','Status','Created By','Created On', 'Updated By','Updated On');
			
 			$sessionArr				=	$this->session->all_userdata();
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model;
 			
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Vendor ID Management',
								'content'   =>	$this->load->view('masters/vendor_managemet/viewform',$msg,TRUE)
							);
			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.id, b.vendor_id_name, b.vendor_id_status, u.username, b.created_on, v.username AS s, b.updated_on')
		->from('vendor_id_management AS b')
		->join('users AS u', 'u.user_id = b.created_by','left')
		->join('users AS v', 'v.user_id = b.updated_by','left')
		->where('b.vendor_id_delete_status=1')
		->edit_column('b.id', get_buttons_new('$1','masters/Vendor_Management/'), 'b.id');
		$this->datatables->edit_column('b.created_on', '$1', 'get_date_timeformat(b.created_on)');
		$this->datatables->edit_column('b.updated_on', '$1', 'get_date_timeformat(b.updated_on)');
		$this->datatables->edit_column('b.vendor_id_status', '$1', 'get_statusbase(b.vendor_id_status)');
		echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('vendor_id_data', 'Vendor ID', 'required');
				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('vendor_id')!='')
					{
						$value_array 	=	array(
													'vendor_id_name'		=> $this->input->post('vendor_id_data'),
													'created_by'	    	=> $this->auth_user_id,
													'created_on'  			=> date('Y-m-d H:i:s'),
													'updated_by'	    	=> $this->auth_user_id,
													'updated_on'  			=> date('Y-m-d H:i:s'),
													'vendor_id_status'	=> $this->input->post('vendor_id_status'),
												);
						$where_array 	= 	array('id' => $this->input->post('vendor_id'));
						$resultupdate 	=	$this->mcommon->common_edit('vendor_id_management',$value_array,$where_array);
					}
					else
					{
						$value_array 	=	array(
													'vendor_id_name'	=> $this->input->post('vendor_id_data'),	
													'created_by'	    => $this->auth_user_id,
													'created_on'  		=> date('Y-m-d H:i:s'),
													'updated_by'	    => $this->auth_user_id,
													'updated_on'  		=> date('Y-m-d H:i:s'),
													'vendor_id_status'	=> $this->input->post('vendor_id_status'),
												);
						$result=$this->mcommon->common_insert('vendor_id_management',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Vendor_Management'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Vendor_Management'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
	}



	public function operation( $id = '' )
	{
		$where_array 	=	array('id' => $id);
		$data['value'] 	=	$this->mcommon->get_fulldata('vendor_id_management',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
		$value_array =array(
							'vendor_id_delete_status'		=>'0',
							'created_by'	    => $this->auth_user_id,
							'created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'id'=>$id
						   );
		$result=$this->mcommon->common_edit('vendor_id_management',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Vendor_Management'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
	}
}
?>