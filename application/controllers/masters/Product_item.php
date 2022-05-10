<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_item extends MY_Controller {

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
			$msg['form_url']			=	'masters/Product_item/add';
	        $msg['form_toptittle']		=	'Product Item Management';
        	$msg['datatable_url']		=	'masters/Product_item/datatable';
        	
			
        	$msg['drop_menu_product']	=	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();
        	$msg['drop_menu_unit']		=	$this->Mdropdown->drop_menu_unit();
        	$msg['drop_menu_tax']		=	$this->Mdropdown->drop_menu_tax();
        	$msg['drop_menu_vendor']	=	$this->Mdropdown->drop_menu_vendor();
        	$msg['product_code'] 		=	$this->mcommon->getProductCode();

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','Add Vendor', 'Product Code', 'Product Name', 'Cost Price', 'Selling Price', 'Unit', 'Current Stock', 'Pieces/Unit', 'Pieces Stock', 'Reordered Level', 'Updated By', 'Updated On', 'Status'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Product Item Management',
							'content'   =>	$this->load->view('masters/product_item/viewform',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('b.pro_item_id,b.pro_item_id as P_id, b.pro_item_code, b.pro_item_name, b.pro_item_cost_price, b.pro_item_sell_price, v.unit_name, b.pro_item_stock, b.pieces_per_unit, b.pieces_stock, b.reorder_level, u.username, b.pro_item_updated_on, b.pro_item_status')
        ->from('tbl_pro_item AS b')
       	->join('users AS u', 'u.user_id = b.pro_item_updated_by','left')
       	->join('tbl_unit AS v', 'v.unit_id =b.unit_id','left')
       	/*->join('tbl_tax AS t', 't.tax_id =b.tax_id','left') */
       	 ->join('users AS f', 'f.user_id =b.pro_item_updated_by','left')  
        ->where('b.prduct_delete_status',1)
		->edit_column('b.pro_item_id', get_buttons_new('$1','masters/Product_item/'), 'b.pro_item_id');
				$this->datatables->edit_column('P_id', '$1', 'get_vender_add(P_id)');	
		$this->datatables->edit_column('b.pro_item_updated_on', '$1', 'get_date_timeformat(b.pro_item_updated_on)');
		$this->datatables->edit_column('b.pro_item_status', '$1', 'get_statusbase(b.pro_item_status)');		
        echo $this->datatables->generate();
    }

	function datatablevendor()
    {
			 $product_id =$form_name = $_POST['pro_id'];
	
    	$this->datatables->select('b.id, b.pro_code,b.pro_name,t.con_company_name, m.pro_group_name, b.cost_price, b.selling_price, u.username, b.pro_updated_on')
        ->from('tbl_pro_item_vendor AS b')
       	->join('users AS u', 'u.user_id = b.pro_updated_by','left') 
       	->join('tbl_contacts AS t', 't.con_id = b.vender_id','left') 
       	->join('tbl_pro_group AS m', 'm.pro_group_id = b.manufacture_id','left') 
        ->where('b.pro_delete_status',1)
        ->where('b.pro_id', $product_id)
		->edit_column('b.id', get_buttons_newvender('$1','masters/Product_item/'), 'b.id');
		$this->datatables->edit_column('b.pro_updated_on', '$1', 'get_date_timeformat(b.pro_updated_on)');
		
        echo $this->datatables->generate();
    }

	public function add()
	{
		if($this->require_min_level(1))
		{	
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('pro_item_name', 'Product Name', 'required');
				//$this->form_validation->set_rules('pro_item_code', 'Product Code', 'required');
				$this->form_validation->set_rules('unit_id', 'Unit', 'required');
				$this->form_validation->set_rules('pro_item_sell_price', 'Selling Price', 'required|numeric');
				$this->form_validation->set_rules('pro_item_cost_price', 'Cost Price', 'required|numeric');
				/*$this->form_validation->set_rules('tax_id', 'Tax', 'required');*/
				$this->form_validation->set_rules('pro_item_stock', 'Product Stock', 'required');
				$this->form_validation->set_rules('pro_group_id', 'Group Name', 'required');			
				$this->form_validation->set_rules('category_id', 'Category Name', 'required');			
				$this->form_validation->set_rules('con_id', 'Vendor', 'required');			
			
				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('pro_item_id')!='')
					{
						$value_array	=	array(
													'category_id'			=>	$this->input->post('category_id'),
													'pro_group_id'			=>	$this->input->post('pro_group_id'),
													'pro_item_name'			=>	$this->input->post('pro_item_name'),
													'pro_item_code'			=>	$this->input->post('pro_item_code'),
													'unit_id'				=>	$this->input->post('unit_id'),
													'pieces_per_unit'	    =>	$this->input->post('pieces_per_unit'),
													'pro_item_sell_price'	=>	$this->input->post('pro_item_sell_price'),
													'pro_item_cost_price'	=>	$this->input->post('pro_item_cost_price'),
													'pieces_stock'          =>	$this->input->post('pro_item_stock')*$this->input->post('pieces_per_unit'),
													'tax_id'				=>	$this->input->post('tax_id'),
													'pro_item_stock'		=>	$this->input->post('pro_item_stock'),
													'con_id'				=>	$this->input->post('con_id'),
													'reorder_level'			=>	$this->input->post('pro_item_level'),
													'pro_item_status'       => 	$this->input->post('pro_item_status'),
													'pro_item_updated_by'	=> 	$this->auth_user_id,
													'pro_item_updated_on'   => 	date('Y-m-d H:i:s'),
												);
					
						$where_array	=	array('pro_item_id'=>$this->input->post('pro_item_id'));
						$resultupdate	=	$this->mcommon->common_edit('tbl_pro_item',$value_array,$where_array);
					}
					else
					{
						$value_array	=	array(
													'category_id'			=>	$this->input->post('category_id'),
													'pro_group_id'			=>	$this->input->post('pro_group_id'),
													'pro_item_name'			=>	$this->input->post('pro_item_name'),
													'pro_item_code'			=>	$this->input->post('pro_item_code'),
													'unit_id'				=>	$this->input->post('unit_id'),
													'pieces_per_unit'	    =>	$this->input->post('pieces_per_unit'),
													'pro_item_sell_price'	=>	$this->input->post('pro_item_sell_price'),
													'pro_item_cost_price'	=>	$this->input->post('pro_item_cost_price'),
													'pieces_stock'          =>	$this->input->post('pro_item_stock')*$this->input->post('pieces_per_unit'),
													'tax_id'				=>	$this->input->post('tax_id'),
													'pro_item_stock'		=>	$this->input->post('pro_item_stock'),
													'con_id'				=>	$this->input->post('con_id'),
													'reorder_level'			=>	$this->input->post('pro_item_level'),
													'pro_item_status'       => 	$this->input->post('pro_item_status'),
													'pro_item_created_by'	=> 	$this->auth_user_id,
													'pro_item_created_on'   => 	date('Y-m-d H:i:s'),
													'pro_item_updated_by'	=> 	$this->auth_user_id,
													'pro_item_updated_on'   => 	date('Y-m-d H:i:s'),
												);
					

			
						$result=$this->mcommon->common_insert('tbl_pro_item',$value_array);

						if($result)
						{
							$value_array=array(
												'product_id'		=> 	$this->input->post('pro_group_id'),
												'opening_stock'		=> 	$this->input->post('pro_item_stock'),
												'entry_date'		=> 	date('Y-m-d'),
												'piece_quantity'	=>	$this->input->post('pro_item_stock')*$this->input->post('pieces_per_unit'),
											 );
							$result1=$this->mcommon->common_insert('opening_stock',$value_array);

							if( $result1 ){
								$this->mcommon->set_pref_no('tbl_preferences', 'prdcode_number');
							}
						}
					}
				}
			}
			if($result1)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Product_item'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Product_item'), 'refresh');
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
							'pro_item_id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_pro_item',$where_array);

		$this->index($data);
	}
		public function operationVender( $id = '' )
	{
		
	if($this->require_min_level(1))
        {
			$msg['form_url']			=	'masters/Product_item/addVendor';
	        $msg['form_toptittle']		=	'Product Item Management';
        	$msg['datatable_url']		=	'masters/Product_item/datatablevendor';
        	
			
        	$msg['drop_menu_product']	=	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();
        	$msg['drop_menu_unit']		=	$this->Mdropdown->drop_menu_unit();
        	$msg['drop_menu_tax']		=	$this->Mdropdown->drop_menu_tax();
        	$msg['drop_menu_vendor']	=	$this->Mdropdown->drop_menu_vendor();
        	// $msg['product_code'] 		=	$this->mcommon->getProductCode();
           	$where_array=array(
							'id'=>$id
						);
		$msg['value']=$this->mcommon->get_fulldata('tbl_pro_item_vendor',$where_array);
			// $where_array=array(
			// 				'pro_item_id'=>$id
			// 			);
			// $msg['value']=$this->mcommon->get_fulldata('tbl_pro_item',$where_array);
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','Product Code','Product Name', 'Vender Name','Manufacture Name','Cost Price', 'Selling Price','Updated By', 'Updated On'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Product Item Management',
							'content'   =>	$this->load->view('masters/product_item/addVendor1',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}

	}
public function addCost($id)
	{

		if($this->require_min_level(1))
        {
			$msg['form_url']			=	'masters/Product_item/addVendor';
	        $msg['form_toptittle']		=	'Product Item Management';
        	$msg['datatable_url']		=	'masters/Product_item/datatablevendor';
        	
			
        	$msg['drop_menu_product']	=	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();
        	$msg['drop_menu_unit']		=	$this->Mdropdown->drop_menu_unit();
        	$msg['drop_menu_tax']		=	$this->Mdropdown->drop_menu_tax();
        	$msg['drop_menu_vendor']	=	$this->Mdropdown->drop_menu_vendor();
        	// $msg['product_code'] 		=	$this->mcommon->getProductCode();
           	$msg['pro_item_id']=$id;
		  	$msg['pro_item_name']=$this->mcommon->get_pro_name($id);
		    $msg['product_code']=$this->mcommon->get_pro_code($id);
			// $where_array=array(
			// 				'pro_item_id'=>$id
			// 			);
			// $msg['value']=$this->mcommon->get_fulldata('tbl_pro_item',$where_array);
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','Product Code','Product Name', 'Vender Name','Manufacture Name','Cost Price', 'Selling Price','Updated By', 'Updated On'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Product Item Management',
							'content'   =>	$this->load->view('masters/product_item/addVendor',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function addVendor()
	{
		if($this->require_min_level(1))
		{	
			if(isset($_POST['Submit']))
			{
					$this->form_validation->set_rules('pro_item_code', 'Product Code', 'required');
				$this->form_validation->set_rules('pro_item_name', 'Product Name', 'required');
				$this->form_validation->set_rules('pro_item_sell_price', 'Selling Price', 'required|numeric');
				$this->form_validation->set_rules('pro_item_cost_price', 'Cost Price', 'required|numeric');
				
				$this->form_validation->set_rules('pro_group_id', 'Group Name', 'required');				
				$this->form_validation->set_rules('con_id', 'Vendor', 'required');			
			
				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('pro_vender_id')!='')
					{
						
						$value_array	=	array(
													'pro_id'			=>	$this->input->post('pro_item_id'),
													'pro_name'			=>	$this->input->post('pro_item_name'),
													'pro_code'			=>	$this->input->post('pro_item_code'),
													'vender_id'			=>	$this->input->post('con_id'),
													'manufacture_id'	=>	$this->input->post('pro_group_id'),
													'cost_price'	    =>	$this->input->post('pro_item_cost_price'),
													'selling_price'	    =>	$this->input->post('pro_item_sell_price'),
													'pro_updated_by'	=> 	$this->auth_user_id,
													'pro_updated_on'   => 	date('Y-m-d H:i:s'),
													
												);
					
						$where_array	=	array('id'=>$this->input->post('pro_vender_id'));
						$resultupdate	=	$this->mcommon->common_edit('tbl_pro_item_vendor',$value_array,$where_array);
					}
					else
					{
						// print_r('new data');die;
						$value_array	=	array(
													'pro_id'			=>	$this->input->post('pro_item_id'),
													'pro_name'			=>	$this->input->post('pro_item_name'),
													'pro_code'			=>	$this->input->post('pro_item_code'),
													'vender_id'			=>	$this->input->post('con_id'),
													'manufacture_id'	=>	$this->input->post('pro_group_id'),
													'cost_price'	    =>	$this->input->post('pro_item_cost_price'),
													'selling_price'	    =>	$this->input->post('pro_item_sell_price'),
													'pro_created_by'	=> 	$this->auth_user_id,
													'pro_created_on'   => 	date('Y-m-d H:i:s'),
													'pro_updated_by'	=> 	$this->auth_user_id,
													'pro_updated_on'   => 	date('Y-m-d H:i:s'),
												);
					

			
						$result=$this->mcommon->common_insert('tbl_pro_item_vendor',$value_array);

						
					}
				}
			}
			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Product_item'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Product_item'), 'refresh');
			}
			else
			{
				$this->addCost($data);
			}
 		}
		
	}
	public function delete( $id = '' )
	{
		$value_array=array(
							'prduct_delete_status'			=>'0',
							'pro_item_created_by'	    => $this->auth_user_id,
							'pro_item_created_on'  		=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'pro_item_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_pro_item',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/product_item'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
	public function deletevender( $id = '' )
	{
		$value_array=array(
							'pro_delete_status'			=>'0',
							'pro_created_by'	    => $this->auth_user_id,
							'pro_created_on'  		=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_pro_item_vendor',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/product_item'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}

	public function resetProductCode()
	{
		$this->db->select('pro_item_id');
		$this->db->from('tbl_pro_item');
		$results = $this->db->get()->result();
		
		foreach ($results as $data) {

			$value_array  	=	array( 'pro_item_code' => $this->mcommon->getProductCode() );
			$where_array	=	array( 'pro_item_id' => $data->pro_item_id );
			$resultupdate	=	$this->mcommon->common_edit( 'tbl_pro_item', $value_array, $where_array );

			$this->mcommon->set_pref_no('tbl_preferences', 'prdcode_number');
		}
	}
	public function getModal($id = '')
    {    
    	$view_data['id'] = $this->input->get('i');	
    //     parse_str($_POST['postdata'], $_POST);//This will convert the string to array
    //     if(isset($_POST['submit']))
    //     {
				// $value_array=array(
				// 	'name'				=>	strtoupper($this->input->post('name')),
				// );
				
				// $result=$this->mcommon->common_insert('transmittal_type',$value_array);

    //     }

     //    $fields_arraycat = array(
    	// 	'ts.id','ts.name'
    	// );
    	
		

 		// if($result){ 
   //      	$view_data['result'] = 'Success';
   //      	$view_data['res_type'] = 'success';
   //      	$view_data['res'] = lang('common_message_create');
   //          echo json_encode($view_data);
           
   //      } else{
        	
  // echo $this->load->view('hrm/staffs/addUpdateDepartmentDataModal', $view_data,TRUE);
           echo $this->load->view('masters/product_item/addVendor', $view_data,TRUE);
        // }
    }

}
?>