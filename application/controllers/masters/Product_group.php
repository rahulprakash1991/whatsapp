<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_group extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('Mdropdown','Mdropdown',TRUE);
		$this->load->model('common_model','mcommon',TRUE);
	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']			=	'masters/Product_group/add';
	        $msg['form_toptittle']		=	'Manufacturer Management';
        	$msg['datatable_url']		=	'masters/Product_group/datatable';
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();
        	

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation', 'Category', 'Manufacturer Name', 'Status', 'Created By', 'Created On', 'Updated By', 'Updated On'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=> '',
							'sb_type'	=> '0',
							'title'     => 'Manufacturer Management',
							'content'   =>$this->load->view('masters/product_group/viewform',$msg,TRUE)
						);
			
			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.pro_group_id, c.category_name, b.pro_group_name, b.pro_group_status, u.username, b.pro_group_created_on, v.username AS s, b.pro_group_updated_on')
        ->from('tbl_pro_group AS b')
       	->join('tbl_category AS c', 'c.category_id = b.category_id','left')
       	->join('users AS u', 'u.user_id = b.pro_group_created_by','left')
       	->join('users AS v', 'v.user_id = b.pro_group_updated_by','left')
      	->where('b.pro_group_delete_status=1')
		->edit_column('b.pro_group_id', get_buttons_new('$1','masters/product_group/'), 'b.pro_group_id');
		$this->datatables->edit_column('b.pro_group_created_on', '$1', 'get_date_timeformat(b.pro_group_created_on)');
		$this->datatables->edit_column('b.pro_group_updated_on', '$1', 'get_date_timeformat(b.pro_group_updated_on)');
		$this->datatables->edit_column('b.pro_group_status', '$1', 'get_statusbase(b.pro_group_status)');		
        echo $this->datatables->generate();
    }
 
	public function add()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('pro_group_name', 'Manufacturer Name', 'required');
				$this->form_validation->set_rules('category_id', 'Category', 'required');

				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('pro_group_id')!='')
					{

						$value_array	=	array(
													'category_id'			=>	$this->input->post('category_id'),
													'pro_group_name'		=>	$this->input->post('pro_group_name'),
													'pro_group_created_by'	=> 	$this->auth_user_id,
													'pro_group_created_on' 	=> 	date('Y-m-d H:i:s'),
													'pro_group_updated_by'	=> 	$this->auth_user_id,
													'pro_group_updated_on' 	=> 	date('Y-m-d H:i:s'),
													'pro_group_status'      => 	$this->input->post('pro_group_status'),
												 );

						$where_array	=	array('pro_group_id'	=>	$this->input->post('pro_group_id'));
						$resultupdate	=	$this->mcommon->common_edit('tbl_pro_group',$value_array,$where_array);
					}
					else
					{
						$value_array	=	array(
													'category_id'			=> $this->input->post('category_id'),
													'pro_group_name'		=> $this->input->post('pro_group_name'),
													'pro_group_created_by'	=> $this->auth_user_id,
													'pro_group_created_on'  => date('Y-m-d H:i:s'),
													'pro_group_updated_by'	=> $this->auth_user_id,
													'pro_group_updated_on' 	=>  date('Y-m-d H:i:s'),
													'pro_group_status'      => $this->input->post('pro_group_status'),
												);

						$result=$this->mcommon->common_insert('tbl_pro_group',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Product_group'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Product_group'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}	
	}

	public function operation( $id = '' )
	{
		$where_array	=	array('pro_group_id'	=>	$id);
		$data['value']	=	$this->mcommon->get_fulldata('tbl_pro_group',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'pro_group_delete_status'	=>	'0',
							'pro_group_created_by'	    => 	$this->auth_user_id,
							'pro_group_created_on'  	=> 	date('Y-m-d H:i:s'),
						   );
		$where_array=array('pro_group_id'	=>	$id);
		$result=$this->mcommon->common_edit('tbl_pro_group', $value_array, $where_array);
		
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Product_group'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}

	public function loadCategoryGroups()
	{
		$category_id = $this->input->get('category_id');

		$results = $this->mcommon->records_all( 'tbl_pro_group', array( 'category_id' => $category_id ) );

		$html .= '<option value="">-- Select --</option>';
	    foreach ($results as $item)
	    {
	    	$html .= '<option value="'.$item->pro_group_id.'" >'.$item->pro_group_name.'</option>';
	    }

		echo $html;
	}


}
?>