<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Organisation_profile extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
	}

	public function index()
	{
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('org_email', 'Email', 'required|valid_email|is_unique[users.email]');
				$this->form_validation->set_rules('org_phone', 'Contact', 'required|regex_match[/^[0-9]{10}$/]	');
			
				if($this->form_validation->run() == TRUE) 
				{

					if($this->input->post('org_id')!='s')
					{

						$config = array();
						$config['upload_path'] 		= './assets/images';
						$config['allowed_types'] 	= 'gif|jpg|png';
						$config['max_size'] 		= '5000';
						$config['max_width'] 		= '2500';
						$config['max_height'] 		= '2500';
						$config['max_filename'] 	= '500';
						$config['overwrite'] 		= false;

						$this->load->library('upload', $config);

						if($_FILES['org_logo']['name']!='1')
						{
							if($this->upload->do_upload('org_logo'))
							{
								$image_data =$this->upload->data();
								$this->load->library('image_lib');
								
								$config1['image_library'] 	= 'gd2';
								$config1['source_image'] 	= $image_data['full_path'];
								$config1['create_thumb'] 	= FALSE;
								$config1['maintain_ratio']	= TRUE;
								$config1['width']     		= 150;
								
								$this->image_lib->clear();
								$this->image_lib->initialize($config1);
								$this->image_lib->resize();
								
								$org_logo = "assets/images/".$image_data['file_name'];
							}
							else
							{
								echo $this->upload->display_errors();
							}
						}

						$value_array=array(
								'org_logo'			=>$org_logo,
								'org_name'			=>$this->input->post('org_name'),
								'org_street'		=>$this->input->post('org_street'),
								'org_area'			=>$this->input->post('org_area'),
								'org_city'			=>$this->input->post('org_city'),
								'org_state'			=>$this->input->post('org_state'),
								'org_pincode'		=>$this->input->post('org_pincode'),
								'org_country'		=>$this->input->post('org_country'),
								'org_phone'			=>$this->input->post('org_phone'),
								'org_mobile'		=>$this->input->post('org_mobile'),
								'org_website'		=>$this->input->post('org_website'),
								'org_fax'			=>$this->input->post('org_fax'),
								'org_email'			=>$this->input->post('org_email'),
								'org_created_by'	=> $this->auth_user_id,
								'org_created_on'  	=> date('Y-m-d H:i:s'),
								);

						$where_array=array(
											'org_id'=>$this->input->post('org_id')
										);
						$resultupdate=$this->mcommon->common_edit('tbl_org_profile',$value_array,$where_array);
					}

				}

				if($resultupdate)
				{
					$this->session->set_userdata('successMsg', 'Updated Successfully...');
					redirect(base_url('masters/Organisation_profile'), 'refresh');
				}				
			}
			
			$where_array=array(
							'org_id'=>'1'
						  );
			
			$msg['value']			=$this->mcommon->get_fulldata('tbl_org_profile',$where_array);
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model; 

 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Organisation_profile Management',
				'content'   =>$this->load->view('masters/organisation_profile/viewform',$msg,TRUE)
			);

			//$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	



 		}
	}

	public function operation( $id = '' )
	{
		$where_array=array(
							'org_id'=>$id
						  );
		$data['value']=$this->mcommon->get_fulldata('tbl_org_profile',$where_array);
		$this->index($data);
	}
}
?>