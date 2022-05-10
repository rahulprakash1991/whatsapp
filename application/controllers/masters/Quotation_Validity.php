<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation_Validity extends MY_Controller {

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
			$msg['form_url']			=	'masters/Quotation_Validity/add';
	        $msg['form_toptittle']		=	'Quotation_Validity Management';
        	$msg['datatable_url']		=	'masters/Quotation_Validity/datatable';
        	

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operations','Quotation Validity','Status','Created By','Created On','Updated By','Updated On'); 
			
			$sessionArr				=$this->session->all_userdata(); 
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Quotation_Validity Management',
				'content'   =>$this->load->view('masters/quotation_validity/viewform',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.quotation_validity_id, b.	quotation_validity, b.quotation_validity_status, u.username, b.quotation_validity_created_on, v.username AS s, b.quotation_validity_updated_on')
        ->from('tbl_quotation_validity AS b')
       	->join('users AS u', 'u.user_id = b.quotation_validity_created_by','left') 
       	->join('users AS v', 'v.user_id =b.quotation_validity_updated_by','left') 
       	->where('b.quotation_validity_delete_status=1')
		->edit_column('b.quotation_validity_id', get_buttons_new('$1','masters/Quotation_Validity/'), 'b.quotation_validity_id');
		$this->datatables->edit_column('b.quotation_validity_created_on', '$1', 'get_date_timeformat(b.quotation_validity_created_on)');
		$this->datatables->edit_column('b.quotation_validity_updated_on', '$1', 'get_date_timeformat(b.quotation_validity_updated_on)');
		$this->datatables->edit_column('b.quotation_validity_status', '$1', 'get_statusbase(b.quotation_validity_status)');		
        echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{

				$this->form_validation->set_rules('quotation_validity','Quotation Validity', 'required');
			
				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('quotation_validity_id')!='')
					{

				$value_array=array(
					'quotation_validity'				=>$this->input->post('quotation_validity'),
					'quotation_validity_created_by'	    => $this->auth_user_id,
					'quotation_validity_created_on'  		=> date('Y-m-d H:i:s'),
					'quotation_validity_updated_by'	    => $this->auth_user_id,
					'quotation_validity_updated_on'  		=> date('Y-m-d H:i:s'),
					'quotation_validity_status'      		=> $this->input->post('quotation_validity_status'),
									);

						$where_array=array(
											'quotation_validity_id'=>$this->input->post('quotation_validity_id')
										);
						$resultupdate=$this->mcommon->common_edit('tbl_quotation_validity',$value_array,$where_array);
					}
					else
					{
					$value_array=array(
						'quotation_validity'			=>$this->input->post('quotation_validity'),
						'quotation_validity_created_by'	=> $this->auth_user_id,
						'quotation_validity_created_on'  	=> date('Y-m-d H:i:s'),
						'quotation_validity_updated_by'	    => $this->auth_user_id,
						'quotation_validity_updated_on'  		=> date('Y-m-d H:i:s'),
						'quotation_validity_status'      	=> $this->input->post('quotation_validity_status'),
									);
					
						$result=$this->mcommon->common_insert('tbl_quotation_validity',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Quotation_Validity'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Quotation_Validity'), 'refresh');
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
							'quotation_validity_id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_quotation_validity',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'quotation_validity_delete_status'		=>'0',
							'quotation_validity_created_by'	    => $this->auth_user_id,
							'quotation_validity_created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'quotation_validity_id'=>$id
						   );
		$result=$this->mcommon->common_edit('quotation_validity',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Quotation_Validity'), 'refresh');
		}else
		{
			$this->index($data);
		}

	}


}
?>