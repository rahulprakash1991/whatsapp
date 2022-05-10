<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends MY_Controller {

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
			$msg['form_url']='masters/Product_category/add';
	        $msg['form_toptittle']='Product Category Management';
        	$msg['datatable_url']='masters/Product_category/datatable';
        	

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','Category Name','Status','Created By','Created On','Updated By','Updated On'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=> '',
							'sb_type'	=> '0',
							'title'     => 'Product Category Management',
							'content'   =>$this->load->view('masters/product_category/viewform',$msg,TRUE)
						);
			
			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}

	}

	function datatable()
    {
    	$this->datatables->select('b.category_id, b.category_name, b.category_status, u.username, b.category_created_on, v.username AS s, b.category_updated_on')
        ->from('tbl_category AS b')
       	->join('users AS u', 'u.user_id = b.category_created_by','left') 
       	->join('users AS v', 'v.user_id = b.category_updated_by','left') 
      	->where('b.category_delete_status=1')
		->edit_column('b.category_id', get_buttons_new('$1','masters/Product_category/'), 'b.category_id');
		$this->datatables->edit_column('b.category_created_on', '$1', 'get_date_timeformat(b.category_created_on)');
		$this->datatables->edit_column('b.category_updated_on', '$1', 'get_date_timeformat(b.category_updated_on)');
		$this->datatables->edit_column('b.category_status', '$1', 'get_statusbase(b.category_status)');		
        echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('category_name', 'Category Name', 'required');

				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('category_id')!='')
					{

						$value_array=array(
											'category_name'		=>	$this->input->post('category_name'),
											'category_created_by'	=> 	$this->auth_user_id,
											'category_created_on' 	=> 	date('Y-m-d H:i:s'),
											'category_updated_by'	=> 	$this->auth_user_id,
											'category_updated_on' 	=> 	date('Y-m-d H:i:s'),
											'category_status'      => 	$this->input->post('category_status'),
										 );

						$where_array=array('category_id'	=>	$this->input->post('category_id'));
						$resultupdate=$this->mcommon->common_edit('tbl_category',$value_array,$where_array);
					}
					else
					{
						$value_array	=	array(
													'category_name'		=>$this->input->post('category_name'),
													'category_created_by'	=> $this->auth_user_id,
													'category_created_on'  => date('Y-m-d H:i:s'),
													'category_updated_by'	=> $this->auth_user_id,
													'category_updated_on' => date('Y-m-d H:i:s'),
													'category_status'      => $this->input->post('category_status'),
												);

						$result=$this->mcommon->common_insert('tbl_category',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Product_category'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Product_category'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
		
	}

	public function operation( $id = '' )
	{
		$where_array	=	array('category_id'	=>	$id);
		$data['value']	=	$this->mcommon->get_fulldata('tbl_category',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'category_delete_status'	=>	'0',
							'category_created_by'	    => 	$this->auth_user_id,
							'category_created_on'  	=> 	date('Y-m-d H:i:s'),
						   );
		$where_array=array('category_id'	=>	$id);
		$result=$this->mcommon->common_edit('tbl_category', $value_array, $where_array);
		
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Product_category'), 'refresh');
		}else
		{
			$this->index($data);
		}

	}


}
?>