<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Preference extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);
		$this->load->library('upload');
	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'masters/Preference/add';
	        $msg['form_tittle']		=	'';
	        $msg['form_toptittle']	=	'Preference Management';
        	$msg['value'] 			= 	'1'; 
			$msg['notification'] 	= 	$sessionArr['successMsg'];
				$msg['drop_menu_currency']		=	$this->mdropdown->drop_menu_currency();
 			$auth_model			 	= 	$this->authentication->auth_model;
 				$where_array=array(
							'c_id'=>1
						);
		$msg['value1']=$this->mcommon->get_fulldata('tbl_company_profile',$where_array);
 
 			$data	=	array(
							'sidebar'	=> '',
							'sb_type'	=> '0',
							'title'     => 'Preference Management',
							'content'   =>$this->load->view('masters/preference/viewform',$msg,TRUE)
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
				$this->form_validation->set_rules('po_number', 'Purchase Order Number', 'required|numeric');
				$this->form_validation->set_rules('re_number', 'Receive Order Number', 'required|numeric');
				//$this->form_validation->set_rules('dc_number', 'Delivery Challan Number', 'required|numeric');
				//$this->form_validation->set_rules('quo_number', 'Invoice Number', 'required|numeric');
				$this->form_validation->set_rules('pro_inv_number', 'Proforma Invoice Number', 'required|numeric');
		
				
				if($this->form_validation->run() == TRUE) 
				{	
					foreach ($_POST as $key_id => $key_value) 
					{
						if($key_id != 'token')
						{	
							$result = $this->mcommon->common_edit('tbl_preferences', array('key_value' => $key_value), array('key' => $key_id));
						}
					}

					$this->session->set_userdata('successMsg', 'Added Successfully...');
					redirect(base_url('masters/Preference'), 'refresh');							
				}
			}
			if(isset($_POST['Submit1']))
			{
				$this->form_validation->set_rules('company_name', 'Company Name', 'required');
				$this->form_validation->set_rules('c_mobile', 'Company Mobile Number', 'required');
				$this->form_validation->set_rules('c_currency', 'Currency', 'required');
				// $this->form_validation->set_rules('c_logo', 'Logo', 'required');
				$this->form_validation->set_rules('c_email', 'Company Email', 'required');

				if($this->form_validation->run() == TRUE) 
				{	
					
				if($_FILES['c_logo']['name']!='')
				{

				if (!file_exists(FCPATH.'/img/logo'))
		        {
				    mkdir(FCPATH.'/img/logo/', 0777, true);
				}

				$config = array();
				$config['upload_path'] = 'img/logo/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '5000';
				$config['max_width'] = '3500';
				$config['max_height'] = '3500';
				$config['max_filename'] = '500';
				$config['overwrite'] = false;
				$this->upload->initialize($config);
				$this->load->library('image_lib');
				$this->load->library('upload', $config);

				if($this->upload->do_upload('c_logo'))
				{	
					$this->load->helper('inflector');
					$file_name = underscore($_FILES['c_logo']['name']);
				
					$config['file_name'] = $file_name;
					$image_data = $this->upload->data(); 
					$configer = array(
                      'image_library' => 'gd2',
                       'source_image' => $image_data['full_path'],
                       'create_thumb' => FALSE,//tell the CI do not create thumbnail on image
                        'maintain_ratio' => FALSE,
                        // 'quality' => '40%', //tell CI to reduce the image quality and affect the image size
                        
                        );
            		$this->image_lib->clear();
            		$this->image_lib->initialize($configer);
            		$this->image_lib->resize();

					$_POST[c_logo]="img/logo/".$image_data['file_name'];
						
				} 
				else
				{
					 $data['c_logo'] = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
					 $this->form_validation->set_rules('c_logo', $this->upload->display_errors(), 'required');                
				}
			}
				// Update Company data
				$value_array	=	array(
													'c_org_name'		=>	$this->input->post('company_name'),
													'c_street'			=>	$this->input->post('c_street'),
													'c_area'			=>	$this->input->post('c_area'),
													'c_city'			=>	$this->input->post('c_city'),
													'c_state'			=>	$this->input->post('c_state'),
													'c_pincode'	    =>	$this->input->post('c_pincode'),
													'c_country'	=>	$this->input->post('c_country'),
													'c_phone'	=>	$this->input->post('c_phone'),
													
													'c_mobile'	=>	$this->input->post('c_mobile'),
													'c_fax'		=>	$this->input->post('c_fax'),
													'c_website'	=>	$this->input->post('c_website'),
													'c_email'	=>	$this->input->post('c_email'),
													
													'c_currency'=>	$this->input->post('c_currency'),
													'c_tax'		=>	$this->input->post('c_tax'),
													'c_cst'		=>	$this->input->post('c_cst'),
													'c_logo'    =>	$this->input->post('c_logo'),
													
													
												);
						if($_FILES['c_logo']['name']=='')
						{
							$client_id =1;
							$site_img_path =  $this->mcommon->old_company_logo($client_id); 
							$value_array['c_logo']=$site_img_path;
						}
						else
						{
							$value_array['c_logo'] = $this->input->post('c_logo');
						}
					
								$where_array	=	array('c_id'=>1);
								$resultupdate	=	$this->mcommon->common_edit('tbl_company_profile',$value_array,$where_array);		
					$this->session->set_userdata('successMsg', 'Updated  Successfully...');
					redirect(base_url('masters/Preference'), 'refresh');							
				}
			}
			
			$this->index($data);
		}
	}

	public function operation( $id = '' )
	{
		$where_array 	=	array( 'key_id'	=>	$id );
		$data['value']	=	$this->mcommon->get_fulldata('tbl_preferences',$where_array);
		$this->index($data);
	}
}
?>