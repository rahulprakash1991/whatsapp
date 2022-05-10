<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->library('upload');
		$this->load->helper('datatables_helper');
		$this->load->model('Purchaseorder','mpurchase',TRUE);
		$this->load->model('Mdropdown','Mdropdown',TRUE);



	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			// $msg['form_url']			=	'masters/Client/add';
	        $msg['form_toptittle']		=	'Supplier  Management';
        	$msg['datatable_url']		=	'masters/Vendor/datatable';
     
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operation','Supplier Key','Name', 'Abbrevation','Assign  As Client', 'Email', 'Mobile', 'Website'); 
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;

 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Supplier  Management',
							'content'   =>	$this->load->view('masters/vendor/viewform',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	$this->datatables->select('v.id,v.vendor_key,v.vendor_name,v.vendor_ab,v.asClient,v.vendor_email,v.vendor_mobile, v.vendor_website,v.id as vendor_id')
        ->from('tbl_vendor AS v')
       	// ->join('users AS u', 'u.user_id = c.client_updatedBy','left')
       
        ->where('v.vendor_delete_status',1)
		->edit_column('v.id', get_buttons_new('$1','masters/Vendor/'), 'v.id');
				
		// $this->datatables->edit_column('c.client_updatedOn', '$1', 'get_date_timeformat(c.client_updatedOn)');
		$this->datatables->edit_column('v.asClient', '$1', 'assign_As_Client(vendor_id,v.asClient)');
				
        echo $this->datatables->generate();
    }


	public function add_vendor( $msg = array() )
	{  

		
		if($this->require_min_level(1))
        {
			$msg['form_url']			=	'masters/Vendor/add';
			$msg['form_cancel_url']			=	'masters/Vendor';
	        $msg['form_toptittle']		=	'Supplier  Management';	
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 			$msg['drop_menu_vendor_id_Manag']	=	$this->Mdropdown->drop_menu_vendorManagemet();
 
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Supplier  Management',
							'content'   =>	$this->load->view('masters/vendor/add_vendor',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function add()
	{

		if($this->require_min_level(1))
		{	
			if(isset($_POST['Submit']))
			{

				$this->form_validation->set_rules('vendor_name', 'Client Name', 'required');
				$this->form_validation->set_rules('vendor_ab', 'Client Abbrevation', 'required');
				$this->form_validation->set_rules('email', 'Client Email', 'required');
				$this->form_validation->set_rules('contact_no', 'Contact Number', 'required');
				$this->form_validation->set_rules('address1', 'Client Address', 'required');
						
			
				if($this->form_validation->run() == TRUE) 
				{	
				if($_FILES['vendor_logo']['name']!='')
				{

				if (!file_exists(FCPATH.'/MasterAttachments/~cdn/Vendor/logo'))
		        {
				    mkdir(FCPATH.'/MasterAttachments/~cdn/Vendor/logo/', 0777, true);
				}

				$config = array();
				$config['upload_path'] = 'MasterAttachments/~cdn/Vendor/logo/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '5000';
				$config['max_width'] = '3500';
				$config['max_height'] = '3500';
				$config['max_filename'] = '500';
				$config['overwrite'] = false;
				$this->upload->initialize($config);
				$this->load->library('image_lib');
				$this->load->library('upload', $config);

				if($this->upload->do_upload('vendor_logo'))
				{	
					$this->load->helper('inflector');
					$file_name = underscore($_FILES['vendor_logo']['name']);
				
					$config['file_name'] = $file_name;
					$image_data = $this->upload->data(); 
					$configer = array(
                      'image_library' => 'gd2',
                       'source_image' => $image_data['full_path'],
                       'create_thumb' => FALSE,//tell the CI do not create thumbnail on image
                        'maintain_ratio' => FALSE,
                        // 'quality' => '40%', //tell CI to reduce the image quality and affect the image size
                         'width' => 736,//new size of image
                         'height' => 1000,//new size of image
                        );
            		$this->image_lib->clear();
            		$this->image_lib->initialize($configer);
            		$this->image_lib->resize();

					$_POST[vendor_logo]="MasterAttachments/~cdn/Vendor/logo/".$image_data['file_name'];
						
				} 
				else
				{
					 $data['vendor_logo'] = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
					 $this->form_validation->set_rules('vendor_logo', $this->upload->display_errors(), 'required');                
				}
				}

					if($this->input->post('vendor_id')!='')
					{
						$value_array	=	array(
													'vendor_name'			=>	$this->input->post('vendor_name'),
													'vendor_key'			=>	$this->input->post('vendor_key'),
													'vendor_ab'			=>	$this->input->post('vendor_ab'),
													'vendor_email'			=>	$this->input->post('email'),
													'vendor_mobile'			=>	$this->input->post('contact_no'),
													'address'				=>	$this->input->post('address1'),
													'cr_no'	    =>	$this->input->post('cr_no'),
													'vendor_no'	=>	$this->input->post('vendor_no'),
													'land_line_no'	=>	$this->input->post('landline_no'),
													
													'fax_no'				=>	$this->input->post('fax'),
													'vendor_website'		=>	$this->input->post('website'),
													'vendor_logo'				=>	$this->input->post('vendor_logo'),
													'vendor_area'				=>	$this->input->post('area'),
													'vendor_city'				=>	$this->input->post('city'),
													'vendor_state'				=>	$this->input->post('state'),
													'vendor_zip'				=>	$this->input->post('zip'),
													'vendor_country'				=>	$this->input->post('country'),
													
													'vendor_updatedBy'	=> 	$this->auth_user_id,
													'vendor_updatedOn'   => 	date('Y-m-d H:i:s'),
												);
							if($_FILES['vendor_logo']['name']=='')
						{
							$vendor_id =$this->input->post('vendor_id');
							$old_vendor_img =  $this->mcommon->old_vendor_logo($vendor_id); 
							$value_array['vendor_logo']=$old_vendor_img;
						}
						else
						{
							$value_array['vendor_logo'] = $this->input->post('vendor_logo');
						}
					
								$where_array	=	array('id'=>$this->input->post('vendor_id'));
								$resultupdate	=	$this->mcommon->common_edit('tbl_vendor',$value_array,$where_array);
						$where_array_addrees	=	array('vendor_id'	=>	$this->input->post('vendor_id'));
						
						$delete			=	$this->mcommon->common_delete('table_vendor_address', $where_array_addrees);
						$where_array_id_mang	=	array('vendor_id'	=>	$this->input->post('vendor_id'));
						
						$this->mcommon->common_delete(' vendor_ids', $where_array_addrees);
						
						// foreach ($this->input->post('address') as $key => $shipAddress)
						// {
						// 	if($shipAddress!='')
						// 	{
						// 		$value_array1	=	array(	
						// 									'vendor_id'			=>	$this->input->post('vendor_id'),								
						// 									'vendor_address'		=>  $shipAddress,
						// 								 );
							
						// 		$rerer=$this->mcommon->common_insert('table_vendor_address',$value_array1);
						// 	}
						// }
						    $addressArr		=	$this->input->post('contact_address');
							$areaArr		=	$this->input->post('contact_area');
							$cityArr		= 	$this->input->post('contact_city');
							$stateArr		= 	$this->input->post('contact_state');
							$zipArr			=	$this->input->post('contact_zip');
							$countryArr		=	$this->input->post('contact_country');
							$phoneArr		=	$this->input->post('contact_phone');
							$mobileArr		=	$this->input->post('contact_mobile');
							$emailArr		= 	$this->input->post('contact_email');
							$faxArr			= 	$this->input->post('contact_fax');
							$websiteArr		=	$this->input->post('contact_website');


							foreach($addressArr as $key => $val)
							{
								
									$value_array1	=	array
														(	
															'vendor_id'		    =>	$this->input->post('vendor_id'),
															
															'vendor_address'	=>	$addressArr[$key],
				
															'area'			    =>	$areaArr[$key],
															'city'				=>	$cityArr[$key],
															
															'state'			    => 	$stateArr[$key],
															'post_code'			=> 	$zipArr[$key],

															'country'			=>	$countryArr[$key],
															'phone'				=>	$phoneArr[$key],
															
															'mobile'			=> 	$mobileArr[$key],
															'email'				=> 	$emailArr[$key],
															'fax'				=> 	$faxArr[$key],
															'website'			=> 	$websiteArr[$key],
														);	
   									// print_r($value_array1);die;
									$this->mcommon->common_insert('table_vendor_address',$value_array1);											
								
							}
							$Vendor_management_idArr		=	$this->input->post('vendor_mana_id');
							$Vendor_management_noArr		=	$this->input->post('vendor_manag_No');
							foreach($Vendor_management_idArr as $key => $val)
							{
								
									$value_array2	=	array
														(	
															'vendor_id'		    =>	$this->input->post('vendor_id'),
															
															'vendor_management_id'	=>	$Vendor_management_idArr[$key],
				
															'vendor_mng_no'			    =>	$Vendor_management_noArr[$key],
															
														);	
   									// print_r($value_array1);die;
									$this->mcommon->common_insert('vendor_ids',$value_array2);											
								
							}
					}
					else
					{
						if($_FILES['vendor_logo']['name']!='')
						{
							$value_array['vendor_logo'] = $this->input->post('vendor_logo');
							
						}
						
						$value_array	=	array(
													'vendor_name'			=>	$this->input->post('vendor_name'),
													'vendor_key'			=>	$this->mpurchase->getVendorNo(),
													'vendor_ab'			=>	$this->input->post('vendor_ab'),
													'vendor_email'			=>	$this->input->post('email'),
													'vendor_mobile'			=>	$this->input->post('contact_no'),
													'address'				=>	$this->input->post('address1'),
													'cr_no'	    =>	$this->input->post('cr_no'),
													'vendor_no'	=>	$this->input->post('vendor_no'),
													'land_line_no'	=>	$this->input->post('landline_no'),
													
													'fax_no'				=>	$this->input->post('fax'),
													'vendor_website'		=>	$this->input->post('website'),
													'vendor_logo'				=>	
													($this->input->post('vendor_logo')!='') ? $this->input->post('vendor_logo') : '',
													'vendor_area'				=>	$this->input->post('area'),
													'vendor_city'				=>	$this->input->post('city'),
													'vendor_state'				=>	$this->input->post('state'),
													'vendor_zip'				=>	$this->input->post('zip'),
													'vendor_country'				=>	$this->input->post('country'),
													
													'vendor_updatedBy'	=> 	$this->auth_user_id,
													'vendor_updatedOn'   => 	date('Y-m-d H:i:s'),
													'vendor_createdBy'	=> 	$this->auth_user_id,
													'vendor_createdOn'   => 	date('Y-m-d H:i:s'),
													
												);
					
// print_r($value_array);die;
			
						$result=$this->mcommon->common_insert('tbl_vendor',$value_array);
						// foreach ($this->input->post('address') as $key => $shipAddress)
						// {
						// 	if($shipAddress!='')
						// 	{
						// 		$value_array1	=	array(	
						// 									'vendor_id'			=>	$result,								
						// 									'vendor_address'		=>  $shipAddress,
						// 								 );
							
						// 		$rerer=$this->mcommon->common_insert('table_vendor_address',$value_array1);
						// 	}
						// }
						 $addressArr		=	$this->input->post('contact_address');
							$areaArr		=	$this->input->post('contact_area');
							$cityArr		= 	$this->input->post('contact_city');
							$stateArr		= 	$this->input->post('contact_state');
							$zipArr			=	$this->input->post('contact_zip');
							$countryArr		=	$this->input->post('contact_country');
							$phoneArr		=	$this->input->post('contact_phone');
							$mobileArr		=	$this->input->post('contact_mobile');
							$emailArr		= 	$this->input->post('contact_email');
							$faxArr			= 	$this->input->post('contact_fax');
							$websiteArr		=	$this->input->post('contact_website');


							foreach($addressArr as $key => $val)
							{
								
									$value_array1	=	array
														(	
															'vendor_id'		    =>	$result,
															
															'vendor_address'	=>	$addressArr[$key],
				
															'area'			    =>	$areaArr[$key],
															'city'				=>	$cityArr[$key],
															
															'state'			    => 	$stateArr[$key],
															'post_code'			=> 	$zipArr[$key],

															'country'			=>	$countryArr[$key],
															'phone'				=>	$phoneArr[$key],
															
															'mobile'			=> 	$mobileArr[$key],
															'email'				=> 	$emailArr[$key],
															'fax'				=> 	$faxArr[$key],
															'website'			=> 	$websiteArr[$key],
														);	
   									// print_r($value_array1);die;
									$this->mcommon->common_insert('table_vendor_address',$value_array1);											
								
							}

							$Vendor_management_idArr		=	$this->input->post('vendor_mana_id');
							$Vendor_management_noArr		=	$this->input->post('vendor_manag_No');
							foreach($Vendor_management_idArr as $key => $val)
							{
								
									$value_array2	=	array
														(	
															'vendor_id'		    =>	$result,
															
															'vendor_management_id	'	=>	$Vendor_management_idArr[$key],
				
															'vendor_mng_no'			    =>	$Vendor_management_noArr[$key],
															
														);	
   									// print_r($value_array1);die;
									$this->mcommon->common_insert('vendor_ids',$value_array2);											
								
							}


					}
				}
			}
			if($result)
			{
					$this->mcommon->set_pref_no('tbl_preferences', 'vendor_number');
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Vendor'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Vendor'), 'refresh');
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
							'id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_vendor',$where_array);
		$data['evalue']	=	$this->mcommon->get_vendor_address($id);
		$data['idmanagement']	=	$this->mcommon->get_vendor_managementID($id);

		$this->add_vendor($data);
	}
		
	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
		$value_array=array(
							'vendor_delete_status'			=>'0',
							'vendor_createdBy'	    => $this->auth_user_id,
							'vendor_createdOn'  		=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_vendor',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Vendor'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
	}
public function getPartNoContent()
	{
		$msg['i']	=	$this->input->get('i');
		echo $this->load->view('masters/vendor/addaddress',$msg,TRUE);
	}
	public function getPartNoContent1()
	{
		$msg['i']	=	$this->input->get('i');
		$msg['drop_menu_vendor_id_Manag']	=	$this->Mdropdown->drop_menu_vendorManagemet();
		echo $this->load->view('masters/vendor/addvendormanagement',$msg,TRUE);
	}
	function AssignClient()
	{
		if($this->require_min_level(1))
		{
		$id = $this->input->get('user_id');
		$status = $this->input->get('status');
		
			$value_array=array(
							'asClient'  	=> 1,
						  );

		$where_array=array(
							'id'=>$id
						  );
		$this->mcommon->common_edit('tbl_vendor',$value_array,$where_array);
		$where_array=array(
							'id'=>$id
						);
		$value=$this->mcommon->get_fulldata('tbl_vendor',$where_array);
		$address	=	$this->mcommon->get_vendor_address($id);
		foreach($value->result() as $row)
    	{
        $id            =   $row->id;
        $vendor_name   =   $row->vendor_name;  
        $vendor_ab      =   $row->vendor_ab;
        $email          =   $row->vendor_email;
        $contact_no      =   $row->vendor_mobile;
        $address1         =   $row->address;
        $cr_no           =   $row->cr_no;
        $vendor_no       =   $row->vendor_no;     
        $landline_no    =   $row->land_line_no;      
        $fax            =   $row->fax_no;      
        $website        =   $row->vendor_website; 
        $logo = $row->vendor_logo;    
        $vendor_key = $row->vendor_key;
             
    	}
    	$value_array	=	array(
									'client_name'			=>	$vendor_name ,
									'client_no'			    =>	$this->mpurchase->getClientNo(),
									'client_abb'			=>	$vendor_ab  ,
									'client_email'			=>	$email ,
									'client_mobile'			=>	 $contact_no,
									'address'				=>	$address1 ,
									'cr_no'	                =>	$cr_no ,
									'vendor_no'	            =>	$vendor_no ,
									'land_line_no'	        =>	$landline_no,
													
									'fax_no'				=>	$fax,
									'client_website'		=>	$website,
									'client_logo'			=>	$logo,
													
									'client_updatedBy'	=> 	$this->auth_user_id,
									'client_updatedOn'   => 	date('Y-m-d H:i:s'),
									'client_createdBy'	=> 	$this->auth_user_id,
									'client_createdOn'   => 	date('Y-m-d H:i:s'),
									'assign_vender' =>1,
													
												);
    $result=$this->mcommon->common_insert('tbl_client',$value_array);
	$this->mcommon->set_pref_no('tbl_preferences', 'client_number');			
	
	foreach($address as $key =>$row)
  	{
          
    $value_array1	=	array
							(	
							'client_id'		    =>	$result,
															
							'client_address'	=>	 $row->vendor_address,
				
							'area'			    =>	$row->area,
							'city'				=>	$row->city,
															
							'state'			    => 	$row->state,
							'post_code'			=> 	$row->post_code,

							'country'			=>	$row->country,
							'phone'				=>	$row->phone,
															
							'mobile'			=> 	$row->mobile,
							'email'				=> 	$row->email,
							'fax'				=> 	$row->fax,
							'website'			=> 	$row->website,
							);	
   									// print_r($value_array1);die;
	$this->mcommon->common_insert('table_vendor_address',$value_array1);
   
  }
}
}
	

}
?>