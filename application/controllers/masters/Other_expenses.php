<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Other_expenses extends MY_Controller {

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
			$msg['form_url'] 		=	'masters/Other_expenses/add';
	        $msg['form_toptittle']	=	'Expense Management';
        	$msg['datatable_url']	=	'masters/Other_expenses/datatable';
        

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation', 'Other Expenses', 'Status', 'Created By', 'Created On', 'Updated By', 'Updated On');
			
			$sessionArr				=	$this->session->all_userdata(); 
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model 			= 	$this->authentication->auth_model;
 
 			$data	=	array(
								'sidebar'	=> 	'',
								'sb_type'	=> 	'0',
								'title'     => 	'Expense Management',
								'content'   =>	$this->load->view('masters/other_expenses/view_form',$msg,TRUE)
							);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('t.expenses_id, t.expenses, t.expenses_status, u.username, t.expenses_created_on, v.username AS s, t.expenses_updated_on', 'u.username')
        ->from('other_expenses AS t')
       	->join('users AS u', 'u.user_id = t.expenses_created_by','left') 
       	->join('users AS v', 'v.user_id = t.expenses_updated_by','left') 
        ->where('t.expenses_delete_status=1')
		->edit_column('b.expenses_id', get_buttons_new('$1','masters/Other_expenses/'), 't.expenses_id');
		$this->datatables->edit_column('t.expenses_created_on', '$1', 'get_date_timeformat(t.expenses_created_on)');
		$this->datatables->edit_column('t.expenses_updated_on', '$1', 'get_date_timeformat(t.expenses_updated_on)');
		$this->datatables->edit_column('t.expenses_status', '$1', 'get_statusbase(t.expenses_status)');		
        echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('expenses', 'Expenses', 'required');

				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('expenses_id')!='')
					{
						$value_array	=	array(
													'expenses'				=>	$this->input->post('expenses'),								
													'expenses_updated_by'	=> 	$this->auth_user_id,
													'expenses_updated_on'  	=> 	date('Y-m-d H:i:s'),
													'expenses_status'      	=> 	$this->input->post('expenses_status'),
												);
			
						$where_array	=	array('expenses_id'	=>	$this->input->post('expenses_id'));
						$resultupdate	=	$this->mcommon->common_edit('other_expenses', $value_array,	$where_array);
					}
					else
					{
						$value_array	=	array(
													'expenses'				=>	$this->input->post('expenses'),								
													'expenses_created_by'	=> 	$this->auth_user_id,
													'expenses_created_on'  	=> 	date('Y-m-d H:i:s'),
													'expenses_updated_by'	=> 	$this->auth_user_id,
													'expenses_updated_on'  	=> 	date('Y-m-d H:i:s'),
													'expenses_status'      	=> 	$this->input->post('expenses_status'),
												);
						$result=$this->mcommon->common_insert('other_expenses', $value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Other_expenses'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Other_expenses'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
		
	}
	
	public function customAlpha( $str = '' ) 
	{
	    if ( !preg_match('/^[A-Za-z .,\-]+$/i',$str) )
	    {
	        return false;
	    }
	}

	public function operation( $id = '' )
	{
		$where_array=array('expenses_id'	=>	$id);
		$data['value']=$this->mcommon->get_fulldata('other_expenses',$where_array);

		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array	=	array(
									'expenses_delete_status'	=>	'0',
									'expenses_created_by'		=> 	$this->auth_user_id,
									'expenses_created_on'  		=> 	date('Y-m-d H:i:s'),
							   );
		$where_array	=	array('expenses_id'	=>	$id);
		$result=$this->mcommon->common_edit('other_expenses', $value_array, $where_array);
		
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Other_expenses'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
}
?>