<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_mode extends MY_Controller {

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
			$msg['form_url']		=	'masters/Payment_mode/add';
	        $msg['form_toptittle']	=	'Payment Mode Management';
        	$msg['datatable_url']	=	'masters/Payment_mode/datatable';
        	

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operations','Payment Mode','Status','Created By','Created On','Updated By','Updated On'); 
			
			$sessionArr				=	$this->session->all_userdata(); 
			$msg['notification'] 	= 	$sessionArr['successMsg'];
 			$auth_model = $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=>	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Payment Mode Management',
							'content'   =>	$this->load->view('masters/payment_mode/view_form',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('t.payment_mode_id, t.payment_mode,t.pay_status,  u.username,	t.payment_created_on,v.username AS s,t.payment_updated_on','u.username')
        ->from('tbl_payment_mode AS t')
		->join('users AS u', 'u.user_id = t.payment_created_by','left') 
		->join('users AS v', 'v.user_id = t.payment_updated_by','left') 
        ->where('t.payment_delete_status=1')
		->edit_column('b.payment_mode_id', get_buttons_new('$1','masters/Payment_mode/'), 't.payment_mode_id');
		$this->datatables->edit_column('t.payment_created_on', '$1', 'get_date_timeformat(t.payment_created_on)');
		$this->datatables->edit_column('t.payment_updated_on', '$1', 'get_date_timeformat(t.payment_updated_on)');
		$this->datatables->edit_column('t.pay_status', '$1', 'get_statusbase(t.pay_status)');		
        echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');
				


				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('payment_mode_id')!='')
					{

						$value_array=array(
									'payment_mode'				=>$this->input->post('payment_mode'),								
									
									'payment_updated_by'	    => $this->auth_user_id,
									'payment_updated_on'  		=> date('Y-m-d H:i:s'),
									'pay_status'      		=> $this->input->post('pay_status'),
									);

						$where_array=array(
											'payment_mode_id'=>$this->input->post('payment_mode_id')
										);
						$resultupdate=$this->mcommon->common_edit('tbl_payment_mode',$value_array,$where_array);
					}
					else
					{
						$value_array=array(
									'payment_mode'			=>$this->input->post('payment_mode'),								
									'payment_created_by'	=> $this->auth_user_id,
									'payment_created_on'  	=> date('Y-m-d H:i:s'),
									'payment_updated_by'	    => $this->auth_user_id,
									'payment_updated_on'  		=> date('Y-m-d H:i:s'),
									'pay_status'      	=> $this->input->post('pay_status'),
									);

						$result=$this->mcommon->common_insert('tbl_payment_mode',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Payment_mode'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Payment_mode'), 'refresh');
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
		
		$where_array=array(
							'payment_mode_id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_payment_mode',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'payment_delete_status'			=>'0',
							'payment_created_by'	=> $this->auth_user_id,
							'payment_created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'payment_mode_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_payment_mode',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Payment_mode'), 'refresh');
		}else
		{
			$this->index($data);
		}

	}


}
?>