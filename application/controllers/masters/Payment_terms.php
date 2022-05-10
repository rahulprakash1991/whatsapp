<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_terms extends MY_Controller {

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
			$msg['form_url']			=	'masters/Payment_terms/add';
	        $msg['form_toptittle']		=	'Payment Terms Management';
        	$msg['datatable_url']		=	'masters/Payment_terms/datatable';
        	

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operations','Payment Terms','No Of Days','Status','Created By','Created On','Updated By','Updated On'); 
			
			$sessionArr				=$this->session->all_userdata(); 
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Payment Terms Management',
				'content'   =>$this->load->view('masters/payment_terms/viewform',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.payment_terms_id, b.payment_terms, b.payment_no_days, b.payment_status, u.username, b.payment_created_on, v.username AS s, b.payment_updated_on')
        ->from('tbl_payment_terms AS b')
       	->join('users AS u', 'u.user_id = b.payment_created_by','left') 
       	->join('users AS v', 'v.user_id =b.payment_updated_by','left') 
       	->where('b.payment_delete_status=1')
		->edit_column('b.payment_terms_id', get_buttons_new('$1','masters/Payment_terms/'), 'b.payment_terms_id');
		$this->datatables->edit_column('b.payment_created_on', '$1', 'get_date_timeformat(b.payment_created_on)');
		$this->datatables->edit_column('b.payment_updated_on', '$1', 'get_date_timeformat(b.payment_updated_on)');
		$this->datatables->edit_column('b.payment_status', '$1', 'get_statusbase(b.payment_status)');		
        echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('payment_terms', 'Payment Terms', 'required');
			
				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('payment_terms_id')!='')
					{

						$value_array=array(
									'payment_terms'				=>$this->input->post('payment_terms'),
									'payment_no_days'			=>$this->input->post('payment_no_days'),
									'payment_created_by'	    => $this->auth_user_id,
									'payment_created_on'  		=> date('Y-m-d H:i:s'),
									'payment_updated_by'	    => $this->auth_user_id,
									'payment_updated_on'  		=> date('Y-m-d H:i:s'),
									'payment_status'      		=> $this->input->post('payment_status'),
									);

						$where_array=array(
											'payment_terms_id'=>$this->input->post('payment_terms_id')
										);
						$resultupdate=$this->mcommon->common_edit('tbl_payment_terms',$value_array,$where_array);
					}
					else
					{
						$value_array=array(
									'payment_terms'			=>$this->input->post('payment_terms'),
									'payment_no_days'			=>$this->input->post('payment_no_days'),
									'payment_created_by'	=> $this->auth_user_id,
									'payment_created_on'  	=> date('Y-m-d H:i:s'),
									'payment_updated_by'	    => $this->auth_user_id,
									'payment_updated_on'  		=> date('Y-m-d H:i:s'),
									'payment_status'      	=> $this->input->post('payment_status'),
									);

						$result=$this->mcommon->common_insert('tbl_payment_terms',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Payment_terms'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Payment_terms'), 'refresh');
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
							'payment_terms_id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_payment_terms',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'payment_delete_status'		=>'0',
							'payment_created_by'	    => $this->auth_user_id,
							'payment_created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'payment_terms_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_payment_terms',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Payment_terms'), 'refresh');
		}else
		{
			$this->index($data);
		}

	}


}
?>