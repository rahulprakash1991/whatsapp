<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_profile extends MY_Controller 
{

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
			$sessionArr				=	$this->session->all_userdata();
			$msg['form_url']		=	'masters/Company_profile/add';
			$msg['form_toptittle']	=	'Company Profile';
			$msg['notification'] 	= 	$sessionArr['successMsg'];
			$auth_model 			= 	$this->authentication->auth_model;

			$msg['drop_menu_currency']		=	$this->Mdropdown->drop_menu_currency();

 			$data=array(
				'sidebar'	=> 	'',
				'sb_type'	=> 	'0',
				'title'     => 	'Company Profile Management',
				'content'   =>	$this->load->view('masters/company_profile/viewform',$msg,TRUE)
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
				$this->form_validation->set_rules('c_org_name', 'Organization Name', 'required');
				$this->form_validation->set_rules('c_street', 'Street', 'required');
				//$this->form_validation->set_rules('c_area', 'Area', 'required');
				$this->form_validation->set_rules('c_city', 'City', 'required');
				$this->form_validation->set_rules('c_pincode', 'Pincode', 'required');
				$this->form_validation->set_rules('c_country', 'Country', 'required');
				$this->form_validation->set_rules('c_phone', 'Phone', 'required|callback_customAlpha');
				$this->form_validation->set_rules('c_email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('c_currency', 'Currency', 'required');
				
				$c_mobile	=	$this->input->post('c_mobile');
				if(!empty($c_mobile))
				{
					$this->form_validation->set_rules('c_mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]');
				}
				
								
				if($this->form_validation->run() == TRUE) 
				{	
					$value2	=	array(
										'c_org_name'     =>$this->input->post('c_org_name'),
										'c_street'       =>$this->input->post('c_street'),
										'c_area'         =>$this->input->post('c_area'),
										'c_city'         =>$this->input->post('c_city'),
										'c_state'        =>$this->input->post('c_state'),
										'c_pincode'      =>$this->input->post('c_pincode'),
										'c_country'      =>$this->input->post('c_country'),
										'c_phone'        =>$this->input->post('c_phone'),
										'c_mobile'       =>$this->input->post('c_mobile'),
										'c_fax'          =>$this->input->post('c_fax'),
										'c_website'      =>$this->input->post('c_website'),
										'c_email'        =>$this->input->post('c_email'),
										'c_currency'     =>$this->input->post('c_currency'),
										'c_tax'          =>$this->input->post('c_tax'),
										'c_cst'          =>$this->input->post('c_cst'),
										'created_by'	 =>$this->auth_user_id,
										'created_on'  	 => date('Y-m-d H:i:s')
									);

				
					$config = array();
					$config['upload_path'] 		= './img/logo/';
					$config['allowed_types'] 	= 'gif|jpg|png';
					$config['max_size'] 		= '5000';
					$config['max_width'] 		= '3500';
					$config['max_height'] 		= '3500';
					$config['max_filename'] 	= '500';
					$config['overwrite'] 		= false;
					
					$this->load->library('upload', $config);
					$this->load->library('image_lib');
					
					if($_FILES['c_logo']['name']!='')
					{
						if($this->upload->do_upload('c_logo'))
						{
							$data['message'] = $this->upload->data(); 
	
							$image_data['full_path'];
	
							$config1['image_library'] 	= 'gd2';
							$config1['source_image'] 	= $image_data['full_path'];
							$config1['create_thumb'] 	= FALSE;
							$config1['maintain_ratio'] 	= TRUE;
							$config1['width']     		= 150;
							
							
							$this->image_lib->clear();
							$this->image_lib->initialize($config1);
							$this->image_lib->resize();
	
							$value2['c_logo']	=	"img/logo/".$data['message']['file_name'];
	
						}
					}

					$where_array	=	array('c_id'	=>	1);
					$resultupdate	=	$this->mcommon->common_edit1('tbl_company_profile',$value2,$where_array);
				}
			}
			
			if($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Company_profile/operation'), 'refresh');
			}
			else
			{
				$this->index($data);
			}
 		}
		
	}
	
	public function customAlpha( $str = '' ) 
	{
	    if ( !preg_match('/^[0-9 .,\-]+$/i',$str) )
	    {
	        return false;
	    }
	}
	
	public function operation()
	{
		$where_array	=	array('c_id'	=>	1);
		$data['value']	=	$this->mcommon->get_fulldata('tbl_company_profile',$where_array);
		
		$this->index($data);
	}

}
?>