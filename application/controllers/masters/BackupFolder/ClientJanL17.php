<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
 		$this->load->model('common_model','mcommon',TRUE);
		$this->load->library('upload');
		$this->load->helper('datatables_helper');
		$this->load->model('Mdropdown','Mdropdown',TRUE);
		$this->load->model('Purchaseorder','mpurchase',TRUE);


	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {


        	$cur_languege = $this->session->userdata('site_lang');
        	// print_r($cur_languege);die;
			// $msg['form_url']			=	'masters/Client/add';
	        $msg['form_toptittle']		=	$this->lang->line('form_toptittle');
        	$msg['datatable_url']		=	'masters/Client/datatable';
     
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			if($cur_languege =="arabic")
			{
				$this->table->set_heading($this->lang->line('client_operation'),$this->lang->line('client_namelist'), $this->lang->line('client_abb'),$this->lang->line('client_email'),$this->lang->line('client_mob'),$this->lang->line('client_web')); 
			}
			else
			{
				$this->table->set_heading('Operations','Client ID',' Client Name','Abbrevation','Client Representative','Email', 'Mobile', 'Website'); 
			}
			
			
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;

 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Client  Management',
							'content'   =>	$this->load->view('masters/client/viewform',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
   $this->datatables->select('c.id,c.client_no,c.client_name,c.client_abb,c.id as rep,c.client_email,c.client_mobile, c.client_website,c.id as client_id')
        ->from('tbl_client AS c')
       	// ->join('users AS u', 'u.user_id = c.client_updatedBy','left')
       
        ->where('c.client_delete_status',1)

		->edit_column('c.id', get_buttons_new('$1','masters/Client/'), 'c.id');
		
		$this->datatables->edit_column('rep',client_rep('$1','rep'),'rep');
		// $this->datatables->edit_column('suplier',assign_As_vendor('$1','suplier'),'suplier');
		// $this->datatables->edit_column('c.assign_vender', '$1', 'assign_As_vendor(client_id,c.assign_vender)');
	
		

				
		// $this->datatables->edit_column('c.client_updatedOn', '$1', 'get_date_timeformat(c.client_updatedOn)');
				
        echo $this->datatables->generate();
    }


	public function add_client( $msg = array() )
	{  

		
		if($this->require_min_level(1))
        {
			$msg['form_url']			=	'masters/Client/add';;
			$msg['form_cancel_url']			=	'masters/Client';
	        $msg['form_toptittle']		=	$this->lang->line('form_toptittle');	
			$sessionArr 			= $this->session->all_userdata();
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
 			// $msg['client_no']				=	$this->mpurchase->getClientNo();
 			$msg['drop_menu_bank']	=	$this->Mdropdown->drop_menu_bank();
 			
 
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	$this->lang->line('form_toptittle'),
							'content'   =>	$this->load->view('masters/client/add_client_new',$msg,TRUE)
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

				$this->form_validation->set_rules('client_name',$this->lang->line('client_name'), 'required');
				// $this->form_validation->set_rules('client_ab',  $this->lang->line('client_ab'), 'required');
				// $this->form_validation->set_rules('email', $this->lang->line('email'), 'required');
				// $this->form_validation->set_rules('contact_no',  $this->lang->line('client_contact_no'), 'required');
				// $this->form_validation->set_rules('address1',  $this->lang->line('client_address'), 'required');
						
			
				if($this->form_validation->run() == TRUE) 
				{	
				if($_FILES['client_logo']['name']!='')
				{

				if (!file_exists(FCPATH.'/MasterAttachments/~cdn/Client/logo'))
		        {
				    mkdir(FCPATH.'/MasterAttachments/~cdn/Client/logo/', 0777, true);
				}

				$config = array();
				$config['upload_path'] = 'MasterAttachments/~cdn/Client/logo/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '5000';
				$config['max_width'] = '3500';
				$config['max_height'] = '3500';
				$config['max_filename'] = '500';
				$config['overwrite'] = false;
				$this->upload->initialize($config);
				$this->load->library('image_lib');
				$this->load->library('upload', $config);

				if($this->upload->do_upload('client_logo'))
				{	
					$this->load->helper('inflector');
					$file_name = underscore($_FILES['client_logo']['name']);
				
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

					$_POST[client_logo]="MasterAttachments/~cdn/Client/logo/".$image_data['file_name'];
						
				} 
				else
				{
					 $data['client_logo'] = $this->upload->display_errors('<div class="alert alert-error">', '</div>');
					 $this->form_validation->set_rules('client_logo', $this->upload->display_errors(), 'required');                
				}
				}

					if($this->input->post('client_id')!='')
					{
						$value_array	=	array(
													'client_name'			=>	strtoupper($this->input->post('client_name')),
													'client_arabic_name' =>$this->input->post('client_arabic_name'),
													'client_no'			    =>	$this->input->post('client_no'),
													'client_abb'			=>	$this->input->post('client_ab'),
													'client_bank'			=>	$this->input->post('client_bank'),
													'client_email'			=>	$this->input->post('email'),
													'client_mobile'			=>	$this->input->post('contact_no'),
													'address'				=>	$this->input->post('address1'),
													'cr_no'	    =>	$this->input->post('cr_no'),
													'vendor_no'	=>	$this->input->post('vendor_no'),
													'land_line_no'	=>	$this->input->post('landline_no'),
													
													'fax_no'				=>	$this->input->post('fax'),
													'client_website'		=>	$this->input->post('website'),
													'client_logo'				=>	
													($this->input->post('client_logo')!='') ? $this->input->post('client_logo') : '',
													'client_area'				=>	$this->input->post('area'),
													'client_city'				=>	$this->input->post('city'),
													'client_state'				=>	($this->input->post('state')!='') ? $this->input->post('state') : '',
													'client_zip'				=>	$this->input->post('zip'),
													
													'client_street'				=>	$this->input->post('street'),
													'client_district'				=>	$this->input->post('district'),
													'client_province'				=>	$this->input->post('province'),
													'landline_no1'				=>	$this->input->post('landline_no1'),
													'cr_no_arabic'				=>	$this->input->post('cr_no_arabic'),
													'street_arabic'				=>	$this->input->post('street_arabic'),
													'client_district_arabic'				=>	$this->input->post('district_arabic'),
													'client_province_arabic'				=>	$this->input->post('province_arabic'),
													'landline_no_arabic'				=>	$this->input->post('landline_no_arabic'),
													'landline_no1_arabic'				=>	$this->input->post('landline_no1_arabic'),
													'fax_arabic'				=>	$this->input->post('fax_arabic'),
													'contact_no_arabic'				=>	$this->input->post('contact_no_arabic'),
													'email_arabic'				=>	$this->input->post('email_arabic'),
													'website_arabic'				=>	$this->input->post('website_arabic'),



													'address1'				=>	$this->input->post('address11'),
													'client_country'				=>	$this->input->post('country'),
													'client_area1'				=>	$this->input->post('po_box_arabic'),
													'client_city1'				=>	$this->input->post('city_arabic'),
													'client_state1'				=>	($this->input->post('state_arabic')!='') ? $this->input->post('state_arabic') : '',
													'client_zip1'				=>	$this->input->post('zip_arabic'),
													'client_country1'				=>	$this->input->post('country_arabic'),
													'client_vat_arabic'				=>	$this->input->post('vendor_no1'),
													'client_updatedBy'	=> 	$this->auth_user_id,
													'client_updatedOn'   => 	date('Y-m-d H:i:s'),
												);
				
						if($_FILES['client_logo']['name']=='')
						{
							$client_id =$this->input->post('client_id');
							$site_img_path =  $this->mcommon->old_client_logo($client_id); 
							$value_array['client_logo']=$site_img_path;
						}
						else
						{
							$value_array['client_logo'] = $this->input->post('client_logo');
						}
					
								$where_array	=	array('id'=>$this->input->post('client_id'));
								$resultupdate	=	$this->mcommon->common_edit('tbl_client',$value_array,$where_array);
								// print_r($value_array);die;

						$where_array_addrees	=	array('client_id'	=>	$this->input->post('client_id'));
						
						$delete			=	$this->mcommon->common_delete('table_client_address', $where_array_addrees);
						
						// foreach ($this->input->post('address') as $key => $shipAddress)
						// {
						// 	if($shipAddress!='')
						// 	{
						// 		$value_array1	=	array(	
						// 									'client_id'			=>	$this->input->post('client_id'),								
						// 									'client_address'		=>  $shipAddress,
						// 								 );
							
						// 		$rerer=$this->mcommon->common_insert('table_client_address',$value_array1);
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


							$address_arabicArr		=	$this->input->post('contact_address_arabic');
							$area_arabicArr			=	$this->input->post('contact_area_arabic');
							$city_arabicArr			= 	$this->input->post('contact_city_arabic');
							$state_arabicArr		= 	$this->input->post('contact_state_arabic');
							$zip_arabicArr			=	$this->input->post('contact_zip_arabic');
							$country_arabicArr		=	$this->input->post('contact_country_arabic');
							$phone_arabicArr		=	$this->input->post('contact_phone_arabic');
							$mobile_arabicArr		=	$this->input->post('contact_mobile_arabic');
							$email_arabicArr		= 	$this->input->post('contact_email_arabic');
							$fax_arabicArr			= 	$this->input->post('contact_fax_arabic');
							$website_arabicArr		=	$this->input->post('contact_website_arabic');


							foreach($addressArr as $key => $val)
							{
								
									$value_array1	=	array
														(	
															'client_id'		    =>	$this->input->post('client_id'),
															
															'client_address'	=>	$addressArr[$key],
				
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


														'client_address_arabic'		=>	$address_arabicArr[$key],
				
														'area_arabic'			    =>	$area_arabicArr[$key],
														'city_arabic'				=>	$city_arabicArr[$key],
															
														'state_arabic'			    => 	$state_arabicArr[$key],
														'post_code_arabic'			=> 	$zip_arabicArr[$key],

														'country_arabic'			=>	$country_arabicArr[$key],
														'phone_arabic'				=>	$phone_arabicArr[$key],
															
														'mobile_arabic'				=> 	$mobile_arabicArr[$key],
														'email_arabic'				=> 	$email_arabicArr[$key],
														'fax_arabic'				=> 	$fax_arabicArr[$key],
														'website_arabic'			=> 	$website_arabicArr[$key],
														);	
   									// print_r($value_array1);die;
									$this->mcommon->common_insert('table_client_address',$value_array1);											
								
							}
					}
					else
					{
						if($_FILES['client_logo']['name']!='')
						{
							$value_array['client_logo'] = $this->input->post('client_logo');
							
						}
					
		

				
						$value_array	=	array(
													'client_name'			=>	strtoupper($this->input->post('client_name'))s,
													'client_arabic_name' =>$this->input->post('client_arabic_name'),
													
													'client_no'			    =>	$this->mpurchase->getClientNo(),
													'client_abb'			=>	$this->input->post('client_ab'),
													'client_bank'			=>	$this->input->post('client_bank'),
													'client_email'			=>	$this->input->post('email'),
													'client_mobile'			=>	$this->input->post('contact_no'),
													'address'				=>	$this->input->post('address1'),
													'cr_no'	    =>	$this->input->post('cr_no'),
													'vendor_no'	=>	$this->input->post('vendor_no'),
													'land_line_no'	=>	$this->input->post('landline_no'),
													
													'fax_no'				=>	$this->input->post('fax'),
													'client_website'		=>	$this->input->post('website'),
													'client_logo'				=>	$this->input->post('client_logo'),
													'client_area'				=>	$this->input->post('area'),
													'client_city'				=>	$this->input->post('city'),
													'client_state'				=>	($this->input->post('state')!='') ? $this->input->post('state') : '',
													'client_zip'				=>	$this->input->post('zip'),
													'client_street'				=>	$this->input->post('street'),
													'client_district'				=>	$this->input->post('district'),
													'client_province'				=>	$this->input->post('province'),
													'landline_no1'				=>	$this->input->post('landline_no1'),
													'cr_no_arabic'				=>	$this->input->post('cr_no_arabic'),
													'street_arabic'				=>	$this->input->post('street_arabic'),
													'client_district_arabic'				=>	$this->input->post('district_arabic'),
													'client_province_arabic'				=>	$this->input->post('province_arabic'),
													'landline_no_arabic'				=>	$this->input->post('landline_no_arabic'),
													'landline_no1_arabic'				=>	$this->input->post('landline_no1_arabic'),
													'fax_arabic'				=>	$this->input->post('fax_arabic'),
													'contact_no_arabic'				=>	$this->input->post('contact_no_arabic'),
													'email_arabic'				=>	$this->input->post('email_arabic'),
													'website_arabic'				=>	$this->input->post('website_arabic'),

													'client_country'				=>	$this->input->post('country'),
													'address1'				=>	$this->input->post('address11'),
													'client_area1'				=>	$this->input->post('po_box_arabic'),
													'client_city1'				=>	$this->input->post('city_arabic'),
													'client_state1'				=> ($this->input->post('state_arabic')!='') ? $this->input->post('state_arabic') : '',
													'client_zip1'				=>	$this->input->post('zip_arabic'),
													'client_country1'				=>	$this->input->post('country_arabic'),
													'client_vat_arabic'				=>	$this->input->post('vendor_no1'),
													
													'client_updatedBy'	=> 	$this->auth_user_id,
													'client_updatedOn'   => 	date('Y-m-d H:i:s'),
													'client_createdBy'	=> 	$this->auth_user_id,
													'client_createdOn'   => 	date('Y-m-d H:i:s'),
													
												);
					
// print_r($value_array);die;
			
						$result=$this->mcommon->common_insert('tbl_client',$value_array);

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

							
							$address_arabicArr		=	$this->input->post('contact_address_arabic');
							$area_arabicArr			=	$this->input->post('contact_area_arabic');
							$city_arabicArr			= 	$this->input->post('contact_city_arabic');
							$state_arabicArr		= 	$this->input->post('contact_state_arabic');
							$zip_arabicArr			=	$this->input->post('contact_zip_arabic');
							$country_arabicArr		=	$this->input->post('contact_country_arabic');
							$phone_arabicArr		=	$this->input->post('contact_phone_arabic');
							$mobile_arabicArr		=	$this->input->post('contact_mobile_arabic');
							$email_arabicArr		= 	$this->input->post('contact_email_arabic');
							$fax_arabicArr			= 	$this->input->post('contact_fax_arabic');
							$website_arabicArr		=	$this->input->post('contact_website_arabic');


							foreach($addressArr as $key => $val)
							{
								
									$value_array1	=	array
														(	
															'client_id'		    =>	$result,
															
															'client_address'	=>	$addressArr[$key],
				
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

														'client_address_arabic'		=>	$address_arabicArr[$key],
				
														'area_arabic'			    =>	$area_arabicArr[$key],
														'city_arabic'				=>	$city_arabicArr[$key],
															
														'state_arabic'			    => 	$state_arabicArr[$key],
														'post_code_arabic'			=> 	$zip_arabicArr[$key],

														'country_arabic'			=>	$country_arabicArr[$key],
														'phone_arabic'				=>	$phone_arabicArr[$key],
															
														'mobile_arabic'				=> 	$mobile_arabicArr[$key],
														'email_arabic'				=> 	$email_arabicArr[$key],
														'fax_arabic'				=> 	$fax_arabicArr[$key],
														'website_arabic'			=> 	$website_arabicArr[$key],
														);	
   									// print_r($value_array1);die;
									$this->mcommon->common_insert('table_client_address',$value_array1);											
								
							}
						
						// foreach ($this->input->post('address') as $key => $shipAddress)
						// {
						// 	if($shipAddress!='')
						// 	{
						// 		$value_array1	=	array(	
						// 									'client_id'			=>	$result,								
						// 									'client_address'		=>  $shipAddress,
						// 								 );
							
						// 		$rerer=$this->mcommon->common_insert('table_client_address',$value_array1);
						// 	}
						// }

					}
				}
			}
			if($result)
			{
				$this->mcommon->set_pref_no('tbl_preferences', 'client_number');
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Client'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Client'), 'refresh');
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
		$data['value']=$this->mcommon->get_fulldata('tbl_client',$where_array);
		$data['evalue']	=	$this->mcommon->get_client_address($id);

		$this->add_client($data);
	}
		
	public function delete( $id = '' )
	{
		if($this->require_min_level(1))
		{
		$value_array=array(
							'client_delete_status'			=>'0',
							'client_createdBy'	    => $this->auth_user_id,
							'client_createdOn'  		=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_client',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Client'), 'refresh');
		}else
		{
			$this->index($data);
		}
	}
	}
	public function DeleteClientRep()
	{
		// $res = $this->sal_common->common_delete('sales_order_list',array('po_pdt_id' => $this->input->get('pro_item_id') ));
		$this->mcommon->common_delete('tbl_client_rep',array('id' => $this->input->get('rep_id') ));
		    $view_data['result'] = 'Success1';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Deleted Successfully';
        
            echo json_encode($view_data);
	}
	public function addClientRep()
	{
		
		$client_id	=	$this->input->get('client_id');	
		$view_data['drop_menu_client']	=	$this->Mdropdown->drop_menu_client1($client_id);
		$view_data['drop_menu_title']	=	$this->Mdropdown->drop_menu_title();
		$view_data['drop_menu_designation']	=	$this->Mdropdown->drop_menu_designation();
		
        parse_str($_POST['postdata'], $_POST);//This will convert the string to array
        if(isset($_POST['submit']))
        {
				
				if($this->input->post('rep_id')!='')
				{
				
					$value_array=array(
					'client_id'				=>	strtoupper($this->input->post('client_name')),
					'title_id'				=>	strtoupper($this->input->post('title')),
					'rep_name'				=>	strtoupper($this->input->post('rep_name')),
					'email'					=>	strtoupper($this->input->post('email')),
					'mobile'				=>	strtoupper($this->input->post('contact_num')),
					'mobile1'				=>	strtoupper($this->input->post('contact_num1')),
					'designation'			=>	strtoupper($this->input->post('designation')),
				);
				$where_array	=	array('id'=>$this->input->post('rep_id'));
				$resultupdate	=	$this->mcommon->common_edit('tbl_client_rep',$value_array,$where_array);
				}
				else
				{
				
					$value_array=array(
					'client_id'				=>	strtoupper($this->input->post('client_name')),
					'title_id'				=>	strtoupper($this->input->post('title')),
					'rep_name'				=>	strtoupper($this->input->post('rep_name')),
					'email'					=>	strtoupper($this->input->post('email')),
					'mobile'				=>	strtoupper($this->input->post('contact_num')),
					'mobile1'				=>	strtoupper($this->input->post('contact_num1')),
					'designation'			=>	strtoupper($this->input->post('designation')),
				);
				$result=$this->mcommon->common_insert('tbl_client_rep',$value_array);	
				}

        }

        $fields_arraycat = array(
    		'ts.id','ts.name'
    	);
    	
		$data['drop_menu_client_rep']	=	$this->Mdropdown->drop_menu_client_rep();
    	// $data['drop_down_cat'] =   $this->mcommon->join_records_all($fields_arraycat, 'transmittal_cat as ts','','','', '`ts.id` ASC ','object');
		$view_data['datatablevalueForm'] = $this->load->view('masters/enquiry/client_rep_drop_down',$data,TRUE);

        if($result){ 
        	$view_data['result'] = 'Success';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Added Successfully';
            echo json_encode($view_data);
           
        }
        else if($resultupdate){ 
        	$view_data['result'] = 'Success1';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Updated Successfully';
        
            echo json_encode($view_data);
           
        }
         else{

        	$id 				=  $this->input->get('client_id');
        	// $view_data['values'] = $this->mcommon->get_fulldata1('tbl_client_rep',array('client_id'=>$id));
        	$view_data['values'] = $this->mcommon->ClientRepdetails($id);
 			echo $this->load->view('masters/client/clientrep',$view_data,TRUE);	
        }
	}

	public function getPartNoContent()
	{
		$msg['i']	=	$this->input->get('i');
		echo $this->load->view('masters/client/addaddress',$msg,TRUE);
	}
	function AssignSupplier()
	{
		if($this->require_min_level(1))
		{
		$id = $this->input->get('user_id');
		$status = $this->input->get('status');
		
			$value_array=array(
							'assign_vender'  	=> 1,
						  );

		$where_array=array(
							'id'=>$id
						  );
		$this->mcommon->common_edit('tbl_client',$value_array,$where_array);
		$where_array=array(
							'id'=>$id
						);
	$data=$this->mcommon->get_fulldata('tbl_client',$where_array);
	$address	=	$this->mcommon->get_client_address($id);
	foreach($data->result() as $row)
    {
        $id            =   $row->id;
        $client_name   =   $row->client_name;  
        $client_ab     =   $row->client_abb;
        $email         =   $row->client_email;
        $contact_no    =   $row->client_mobile;
        $address1      =   $row->address;
        $cr_no         =   $row->cr_no;
        $vendor_no     =   $row->vendor_no;     
        $landline_no   =   $row->land_line_no;      
        $fax           =   $row->fax_no;      
        $website       =   $row->client_website; 
        $logo          =   $row->client_logo;    
             
    }
    	$value_array=array(
							'vendor_name'  	=> $client_name  ,
							'vendor_key'  	=> $this->mpurchase->getVendorNo(),
							'vendor_ab'  	=> $client_ab,
							'vendor_email'  	=> $email,
							'vendor_mobile'  	=>  $contact_no,
							'address'  	=> $address1,
							'cr_no'  	=>  $cr_no ,
							'vendor_no'  	=> $vendor_no,
							'land_line_no'  	=> $landline_no,
							'fax_no'  	=> $fax,
							'vendor_website'  	=> $website,
							'vendor_logo'  	=> $logo,
							'vendor_delete_status'  	=> 1,
							'vendor_updatedBy' =>$this->auth_user_id,
							'vendor_createdBy' =>$this->auth_user_id,
							'vendor_updatedOn'  	=> date('Y-m-d H:i:s'),
							
							'vendor_createdOn'  	=> date('Y-m-d H:i:s'),
							'asClient' =>1,

						  );
    	$result=$this->mcommon->common_insert('tbl_vendor',$value_array);
    	$this->mcommon->set_pref_no('tbl_preferences', 'vendor_number');
	}
	foreach($address as $key =>$row)
  	{
          
    $value_array1	=	array
							(	
							'vendor_id'		    =>	$result,
															
							'vendor_address'	=>	$row->client_address,
				
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
public function getRepDetailsDataModal()
{
	$fields_arraySatip = array(
    		'cr.id','cr.client_id','cr.title_id','cr.rep_name','cr.email','cr.mobile','cr.mobile1','cr.designation','t.name','d.desgination_name'
    	);
		$whereArrSatip = array('cr.id' =>$_GET['rep_id']);

		$join_arraySatip = array(
			'tbl_desgination AS d' => 'd.desgination_id = cr.designation',
			'titles AS t' => 't.id = cr.title_id',
			
		);

	    $satipDataDetails =   $this->mcommon->join_records_all($fields_arraySatip,'tbl_client_rep as cr', $join_arraySatip, $whereArrSatip, '', '`cr.id` ASC ','','array');
	    echo json_encode($satipDataDetails[0]);
}

}
?>