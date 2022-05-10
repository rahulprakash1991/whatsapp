<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_details extends MY_Controller {

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
			$msg['form_url']		=	'masters/Bank_details/add';
	        $msg['form_toptittle']	=	'Bank Details Management';
			$msg['datatable_url']	=	'masters/Bank_details/datatable';
			$msg['drop_menu_currency'] = $this->Mdropdown->drop_menu_currency();
        	
        	//$msg['back_url']='masters/MainTax/add';
        	//$msg['back_urlstatus']='1';

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 

			$this->table->set_heading('Operations', 'A/C No', 'Account Name', 'Bank Name', 'Status', 'Created By', 'Created On', 'Updated By', 'Updated On');
			
 			$sessionArr = $this->session->all_userdata();
			$msg['notification'] = $sessionArr['successMsg'];
 			$auth_model = $this->authentication->auth_model;
 
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Bank Details Management',
				'content'   =>$this->load->view('masters/bank_details/viewform',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}

	}

	function datatable()
    {
    	$this->datatables->select('b.bank_id,b.account_no,b.account_name, b.bank_name,b.bank_status,u.username, b.created_on,v.username AS s,b.updated_on')
        ->from('tbl_bank_details AS b')
        ->join('users AS u', 'u.user_id = b.created_by','left') 
        ->join('users AS v', 'v.user_id = b.updated_by','left') 
        ->where('b.bank_delete_status',1)
		->edit_column('b.tax_id', get_buttons_new('$1','masters/Bank_details/'), 'b.bank_id');
		$this->datatables->edit_column('b.created_on', '$1', 'get_date_timeformat(b.created_on)');
		$this->datatables->edit_column('b.updated_on', '$1', 'get_date_timeformat(b.updated_on)');
		$this->datatables->edit_column('b.bank_status', '$1', 'get_statusbase(b.bank_status)');		
        echo $this->datatables->generate();
    }



	public function add()
	{

		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('account_no', 'Account Number', 'required|numeric|greater_than[0]');
				$this->form_validation->set_rules('account_name', 'Account Name', 'required|callback_customAlpha');
				$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
				// $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
				/*$this->form_validation->set_rules('ifs_code', 'IFS Code', 'required');
				$this->form_validation->set_rules('micr_no', 'MICR Number', 'required');
				$this->form_validation->set_rules('cur_bal', 'Current Balance', 'required|numeric');
				$this->form_validation->set_rules('min_bal', 'Minimum Balance', 'required|numeric');*/


				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('bank_id')!='')
					{
						$value_array=array(
											'account_no'      =>	$this->input->post('account_no'),
											'account_name'    =>   	$this->input->post('account_name'),
											'bank_name'		  => 	$this->input->post('bank_name'),
											'branch_name'     =>   	$this->input->post('branch_name'),
											'ifs_code'        =>   	$this->input->post('ifs_code'),
											'micr_no'         =>   	$this->input->post('micr_no'),
											'cur_bal'         =>   	$this->input->post('cur_bal'),
											'min_bal'         => 	$this->input->post('min_bal'),	
											'bank_curency'         => 	$this->input->post('bank_curency'),	
											'created_by'	  => 	$this->auth_user_id,
											'updated_by'	  => 	$this->auth_user_id,
											'created_on'  	  => 	date('Y-m-d H:i:s'),
											'updated_on'  	  => 	date('Y-m-d H:i:s'),
											'bank_status'     => 	$this->input->post('bank_status'),
										);

						$where_array=array('bank_id'	=>	$this->input->post('bank_id'));
						$resultupdate=$this->mcommon->common_edit('tbl_bank_details',$value_array,$where_array);
					}
					else
					{

						$value_array	=	array(
													'account_no'    =>	$this->input->post('account_no'),
													'account_name'  =>  $this->input->post('account_name'),
													'bank_name'		=> 	$this->input->post('bank_name'),
													'branch_name'   =>  $this->input->post('branch_name'),
													'ifs_code'      =>  $this->input->post('ifs_code'),
													'micr_no'       =>  $this->input->post('micr_no'),
													'cur_bal'       =>  $this->input->post('cur_bal'),
													'min_bal'       => 	$this->input->post('min_bal'),
													'bank_curency'         => 	$this->input->post('bank_curency'),		
													'created_by'	=> 	$this->auth_user_id,
													'updated_by'	=> 	$this->auth_user_id,
													'created_on'  	=> 	date('Y-m-d H:i:s'),
													'updated_on'  	=> 	date('Y-m-d H:i:s'),
													'bank_status'   => 	$this->input->post('bank_status'),
												);
						$result=$this->mcommon->common_insert('tbl_bank_details',$value_array);
						
					}
				}
			}

			if($result)
			{

				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Bank_details'), 'refresh');

			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Bank_details'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
		
	}


	public function customAlpha($str = '') 
	{
	    if ( !preg_match('/^[A-Za-z .,\-]+$/i',$str) )
	    {
	        return false;
	    }
	}

	public function operation($id = '')
	{
		
		$where_array=array(
							'bank_id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_bank_details',$where_array);
		$this->index($data);
	}

	public function delete($id = '')
	{
		$value_array=array(
							'bank_delete_status'		=>'0',
							'created_by'	    => $this->auth_user_id,
							'created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'bank_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_bank_details',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Bank_details'), 'refresh');
		}else
		{
			$this->index($data);
		}

	}


}
?>