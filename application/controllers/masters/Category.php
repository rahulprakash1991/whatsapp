<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

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
			$msg['form_url']='masters/Category/add';
	        $msg['form_tittle']='Category Management';
	        $msg['form_toptittle']='Category Management';


        	$msg['datatable_url']='masters/Category/datatable';
        	$msg['list_tittle']='Category list';
        	//$msg['back_url']='masters/Maincategory/add';
        	//$msg['back_urlstatus']='1';

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 

			$this->table->set_heading('Operaton','Status','Name','Order','Update On','Update By');
			
 
			$msg['notification'] = $sessionArr['successMsg'];
 			$auth_model = $this->authentication->auth_model;
 
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Category Management',
				'content'   =>$this->load->view('masters/category/viewform',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.c_id, b.c_status, b.c_name, b.c_order, b.c_updated_date, u.username')
        ->from('category AS b')
        ->join('users AS u', 'u.user_id = b.c_updated_by','left') 
        ->where('b.c_delistatus','0')
		->edit_column('b.c_id', get_buttons_new('$1','masters/Category/'), 'b.c_id');
		$this->datatables->edit_column('b.c_updated_date', '$1', 'get_date_timeformat(b.c_updated_date)');
		$this->datatables->edit_column('b.c_status', '$1', 'get_statusbase(b.c_status)');
		
         echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('c_name', 'Category Name', 'required');
				$this->form_validation->set_rules('c_order', 'Category Order', 'required');
				$this->form_validation->set_rules('c_status', 'Status', 'required');


				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('c_id')!='')
					{

						$value_array=array(
									'c_name'			=>$this->input->post('c_name'),
									'c_order'			=>$this->input->post('c_order'),
									'c_indextype'		=>$this->input->post('c_indextype'),
									'c_updated_by'	    => $this->auth_user_id,
									'c_updated_date'  	=> date('Y-m-d H:i:s'),
									'c_status'      	=> $this->input->post('c_status'),
									);

						$where_array=array(
											'c_id'=>$this->input->post('c_id')
										);
						$resultupdate=$this->mcommon->common_edit('category',$value_array,$where_array);
					}
					else
					{
						$value_array=array(
										'c_name'			=>$this->input->post('c_name'),
										'c_order'			=>$this->input->post('c_order'),
										'c_indextype'		=>$this->input->post('c_indextype'),
										'c_created_by'	    =>$this->auth_user_id,
										'c_created_date'  	=>date('Y-m-d H:i:s'),
										'c_status'      	=>$this->input->post('c_status')
									);

						$result=$this->mcommon->common_insert('category',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_flashdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Category'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_flashdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Category'), 'refresh');
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
							'c_id'=>$id
						  );
		$data['value']=$this->mcommon->get_fulldata('category',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'c_delistatus'		=>'1',
							'c_updated_by'	    => $this->auth_user_id,
							'c_updated_date'  	=> date('Y-m-d H:i:s'),
						  );
		$where_array=array(
							'c_id'=>$id
						  );
		$result=$this->mcommon->common_edit('category',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Category'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
}
?>