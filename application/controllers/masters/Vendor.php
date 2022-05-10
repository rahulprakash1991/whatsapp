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
			$this->table->set_heading('Operation','Supplier Key','Name', 'Abbrevation','Vendor Representative', 'Email', 'Mobile', 'Website'); 
			
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
    	$this->datatables->select('v.id,v.vendor_key,v.vendor_name,v.vendor_abb,v.id as rep,v.vendor_email,v.vendor_mobile, v.vendor_website')
        ->from('tbl_vendor AS v')
       	// ->join('users AS u', 'u.user_id = c.client_updatedBy','left')
       
        ->where('v.vendor_delete_status',1)
		->edit_column('v.id', get_buttons_new('$1','masters/Vendor/'), 'v.id');
		$this->datatables->edit_column('rep',client_rep('$1','rep'),'rep');
				
		// $this->datatables->edit_column('c.client_updatedOn', '$1', 'get_date_timeformat(c.client_updatedOn)');
		// $this->datatables->edit_column('v.asClient', '$1', 'assign_As_Client(vendor_id,v.asClient)');
				
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
 			$msg['drop_menu_bank']	=	$this->Mdropdown->drop_menu_bank();
 
 			$data=array(
							'sidebar'	=> 	'',
							'sb_type'	=> 	'0',
							'title'     => 	'Supplier  Management',
							'content'   =>	$this->load->view('masters/vendor/add_new_vendor',$msg,TRUE)
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
													'vendor_arabic_name' =>$this->input->post('vendor_arabic_name'),
													
													'vendor_key'			    =>	$this->input->post('vendor_key'),
													'vendor_abb'			=>	$this->input->post('vendor_ab'),
													'vendor_bank'			=>	$this->input->post('vendor_bank'),
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
													'vendor_state'				=>	($this->input->post('state')!='') ? $this->input->post('state') : '',
													'vendor_zip'				=>	$this->input->post('zip'),
													'vendor_street'				=>	$this->input->post('street'),
													'vendor_district'				=>	$this->input->post('district'),
													'vendor_province'				=>	$this->input->post('province'),
													'landline_no1'				=>	$this->input->post('landline_no1'),
													'cr_no_arabic'				=>	$this->input->post('cr_no_arabic'),
													'street_arabic'				=>	$this->input->post('street_arabic'),
													'vendor_district_arabic'				=>	$this->input->post('district_arabic'),
													'vendor_province_arabic'				=>	$this->input->post('province_arabic'),
													'landline_no_arabic'				=>	$this->input->post('landline_no_arabic'),
													'landline_no1_arabic'				=>	$this->input->post('landline_no1_arabic'),
													'fax_arabic'				=>	$this->input->post('fax_arabic'),
													'contact_no_arabic'				=>	$this->input->post('contact_no_arabic'),
													'email_arabic'				=>	$this->input->post('email_arabic'),
													'website_arabic'				=>	$this->input->post('website_arabic'),

													'vendor_country'				=>	$this->input->post('country'),
													'address1'				=>	$this->input->post('address11'),
													'vendor_area1'				=>	$this->input->post('po_box_arabic'),
													'vendor_city1'				=>	$this->input->post('city_arabic'),
													'vendor_state1'				=> ($this->input->post('state_arabic')!='') ? $this->input->post('state_arabic') : '',
													'vendor_zip1'				=>	$this->input->post('zip_arabic'),
													'vendor_country1'				=>	$this->input->post('country_arabic'),
													'vendor_vat_arabic'				=>	$this->input->post('vendor_no1'),
													
													'vendor_updatedBy'	=> 	$this->auth_user_id,
													'vendor_updatedOn'   => 	date('Y-m-d H:i:s'),
													'vendor_createdBy'	=> 	$this->auth_user_id,
													'vendor_createdOn'   => 	date('Y-m-d H:i:s'),
													
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
						
						// $delete			=	$this->mcommon->common_delete('table_vendor_address', $where_array_addrees);
						$where_array_id_mang	=	array('vendor_id'	=>	$this->input->post('vendor_id'));
						
						$this->mcommon->common_delete(' vendor_ids', $where_array_addrees);
						
						    $idArr		=	$this->input->post('scontact_address_id');
							$cr_noEngArry =  $this->input->post('scr_no');//new
							// print_r($value_array);die;
							$vat_num_engArray = $this->input->post('svendor_no');//new
							$street_engArray = $this->input->post('sstreet');//new

						    $addressEngArr		=	$this->input->post('saddress1');
						    $cityArr		= 	$this->input->post('scity');
						    $districtEngArry = $this->input->post('sdistrict');//new
						    $stateArr		= 	$this->input->post('sprovince');
						    $zipArr			=	$this->input->post('szip');
							$POArr		=	$this->input->post('sarea');
						
							$countryArr		=	$this->input->post('scountry');
							$phoneArr		=	$this->input->post('slandline_no');
							$phoneArr1		=	$this->input->post('slandline_no1');//new
							$mobileArr		=	$this->input->post('scontact_no');
							$emailArr		= 	$this->input->post('semail');
							$faxArr			= 	$this->input->post('sfax');
							$websiteArr		=	$this->input->post('swebsite');


							$cr_noArabicArry =  $this->input->post('scr_no_arabic');//new
							$vat_num_ArabicArray = $this->input->post('svendor_no1');//new
							$address_arabicArr		=	$this->input->post('saddress11');
							$street_Arabic_Array = $this->input->post('sstreet_arabic');//new
							
							$city_arabicArr			= 	$this->input->post('scity_arabic');
							$state_arabicArr		= 	$this->input->post('sprovince_arabic');
							$districtArabic_Arry = $this->input->post('sdistrict_arabic');//new
							$zip_arabicArr			=	$this->input->post('szip_arabic');
							$Po_arabicArr			=	$this->input->post('spo_box_arabic');
							$country_arabicArr		=	$this->input->post('scountry_arabic');
							$phone_arabicArr		=	$this->input->post('slandline_no_arabic');
							$phone1_arabicArr		=	$this->input->post('slandline_no1_arabic');//new
							$mobile_arabicArr		=	$this->input->post('scontact_no_arabic');
							$email_arabicArr		= 	$this->input->post('semail_arabic');
							$fax_arabicArr			= 	$this->input->post('sfax_arabic');
							$website_arabicArr		=	$this->input->post('swebsite_arabic');


							foreach($addressEngArr as $key => $val)
							{
								if($idArr[$key]!='')
								{
									$value_array1	=	array
														(	
															'vendor_id'		    =>	$this->input->post('vendor_id'),
															
															'vendor_cr_no'      =>$cr_noEngArry[$key],
															'vendor_vat_no'      =>$vat_num_engArray[$key],
															'vendor_address'	=>	$addressEngArr[$key],
															'vendor_street'     =>$street_engArray[$key],
															'district'          => $districtEngArry[$key],
															'area'			    =>	$POArr[$key],
															'city'				=>	$cityArr[$key],
															
															'state'			    => 	$stateArr[$key],
															'post_code'			=> 	$zipArr[$key],

															'country'			=>	$countryArr[$key],
															'phone'				=>	$phoneArr[$key],
															'phone1'		    =>	$phoneArr1[$key],
															
															'mobile'			=> 	$mobileArr[$key],
															'email'				=> 	$emailArr[$key],
															'fax'				=> 	$faxArr[$key],
															'website'			=> 	$websiteArr[$key],

															'vendor_cr_no_arabic'      =>$cr_noArabicArry[$key],
															'vendor_vat_no_arabic'      =>$vat_num_ArabicArray[$key],
															
															'vendor_street_arabic'     =>$street_Arabic_Array[$key],
															'district_arabic'          => $districtEngArry[$key],
														'vendor_address_arabic'		=>	$address_arabicArr[$key],
				
														'area_arabic'			    =>	$Po_arabicArr[$key],
														'city_arabic'				=>	$city_arabicArr[$key],
															
														'state_arabic'			    => 	$state_arabicArr[$key],
														'post_code_arabic'			=> 	$zip_arabicArr[$key],

														'country_arabic'			=>	$country_arabicArr[$key],
														'phone_arabic'				=>	$phone_arabicArr[$key],
														'phone1_arabic'				=>	$phone1_arabicArr[$key],
														'mobile_arabic'				=> 	$mobile_arabicArr[$key],
														'email_arabic'				=> 	$email_arabicArr[$key],
														'fax_arabic'				=> 	$fax_arabicArr[$key],
														'website_arabic'			=> 	$website_arabicArr[$key],
														);	
														// print_r($value_array1);die;
   									$where_array=array(
											'id'=>$idArr[$key]
										);
   									$this->mcommon->common_edit('table_vendor_address',$value_array1,$where_array);
									// $this->mcommon->common_insert('table_vendor_address',$value_array1);											
								}
								else
								{
									$value_array1	=	array
														(	
															'vendor_id'		    =>	$this->input->post('vendor_id'),
															
															'vendor_cr_no'      =>$cr_noEngArry[$key],
															'vendor_vat_no'      =>$vat_num_engArray[$key],
															'vendor_address'	=>	$addressEngArr[$key],
															'vendor_street'     =>$street_engArray[$key],
															'district'          => $districtEngArry[$key],
															'area'			    =>	$POArr[$key],
															'city'				=>	$cityArr[$key],
															
															'state'			    => 	$stateArr[$key],
															'post_code'			=> 	$zipArr[$key],

															'country'			=>	$countryArr[$key],
															'phone'				=>	$phoneArr[$key],
															'phone1'		    =>	$phoneArr1[$key],
															
															'mobile'			=> 	$mobileArr[$key],
															'email'				=> 	$emailArr[$key],
															'fax'				=> 	$faxArr[$key],
															'website'			=> 	$websiteArr[$key],

															'vendor_cr_no_arabic'      =>$cr_noArabicArry[$key],
															'vendor_vat_no_arabic'      =>$vat_num_ArabicArray[$key],
															
															'vendor_street_arabic'     =>$street_Arabic_Array[$key],
															'district_arabic'          => $districtEngArry[$key],
														'vendor_address_arabic'		=>	$address_arabicArr[$key],
				
														'area_arabic'			    =>	$Po_arabicArr[$key],
														'city_arabic'				=>	$city_arabicArr[$key],
															
														'state_arabic'			    => 	$state_arabicArr[$key],
														'post_code_arabic'			=> 	$zip_arabicArr[$key],

														'country_arabic'			=>	$country_arabicArr[$key],
														'phone_arabic'				=>	$phone_arabicArr[$key],
														'phone1_arabic'				=>	$phone1_arabicArr[$key],
														'mobile_arabic'				=> 	$mobile_arabicArr[$key],
														'email_arabic'				=> 	$email_arabicArr[$key],
														'fax_arabic'				=> 	$fax_arabicArr[$key],
														'website_arabic'			=> 	$website_arabicArr[$key],
														);
														
										$this->mcommon->common_insert('table_vendor_address',$value_array1);	

								}
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
						
						

						$vendor_prifix = $this->mpurchase->getVendorPrifix();
						$vendor_num =$this->mpurchase->getVendorNum();
						
						$vendor_padd_num = str_pad($vendor_num, 4, "0", STR_PAD_LEFT);
						$vendor_number= $vendor_prifix.$vendor_padd_num;
				

						$value_array	=	array(
													'vendor_name'			=>	$this->input->post('vendor_name'),
													'vendor_arabic_name' =>$this->input->post('vendor_arabic_name'),
													
													'vendor_key'			    =>	$vendor_number,
													'vendor_abb'			=>	$this->input->post('vendor_ab'),
													'vendor_bank'			=>	$this->input->post('vendor_bank'),
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
													'vendor_state'				=>	($this->input->post('state')!='') ? $this->input->post('state') : '',
													'vendor_zip'				=>	$this->input->post('zip'),
													'vendor_street'				=>	$this->input->post('street'),
													'vendor_district'				=>	$this->input->post('district'),
													'vendor_province'				=>	$this->input->post('province'),
													'landline_no1'				=>	$this->input->post('landline_no1'),
													'cr_no_arabic'				=>	$this->input->post('cr_no_arabic'),
													'street_arabic'				=>	$this->input->post('street_arabic'),
													'vendor_district_arabic'				=>	$this->input->post('district_arabic'),
													'vendor_province_arabic'				=>	$this->input->post('province_arabic'),
													'landline_no_arabic'				=>	$this->input->post('landline_no_arabic'),
													'landline_no1_arabic'				=>	$this->input->post('landline_no1_arabic'),
													'fax_arabic'				=>	$this->input->post('fax_arabic'),
													'contact_no_arabic'				=>	$this->input->post('contact_no_arabic'),
													'email_arabic'				=>	$this->input->post('email_arabic'),
													'website_arabic'				=>	$this->input->post('website_arabic'),

													'vendor_country'				=>	$this->input->post('country'),
													'address1'				=>	$this->input->post('address11'),
													'vendor_area1'				=>	$this->input->post('po_box_arabic'),
													'vendor_city1'				=>	$this->input->post('city_arabic'),
													'vendor_state1'				=> ($this->input->post('state_arabic')!='') ? $this->input->post('state_arabic') : '',
													'vendor_zip1'				=>	$this->input->post('zip_arabic'),
													'vendor_country1'				=>	$this->input->post('country_arabic'),
													'vendor_vat_arabic'				=>	$this->input->post('vendor_no1'),
													
													'vendor_updatedBy'	=> 	$this->auth_user_id,
													'vendor_updatedOn'   => 	date('Y-m-d H:i:s'),
													'vendor_createdBy'	=> 	$this->auth_user_id,
													'vendor_createdOn'   => 	date('Y-m-d H:i:s'),
													
												);
					

			
						$result=$this->mcommon->common_insert('tbl_vendor',$value_array);

						   $vender_insert_id = $result;
							$idArr		=	$this->input->post('scontact_address_id');
							$cr_noEngArry =  $this->input->post('scr_no');//new
							// print_r($value_array);die;
							$vat_num_engArray = $this->input->post('svendor_no');//new
							$street_engArray = $this->input->post('sstreet');//new

						    $addressEngArr		=	$this->input->post('saddress1');
						    $cityArr		= 	$this->input->post('scity');
						    $districtEngArry = $this->input->post('sdistrict');//new
						    $stateArr		= 	$this->input->post('sprovince');
						    $zipArr			=	$this->input->post('szip');
							$POArr		=	$this->input->post('sarea');
						
							$countryArr		=	$this->input->post('scountry');
							$phoneArr		=	$this->input->post('slandline_no');
							$phoneArr1		=	$this->input->post('slandline_no1');//new
							$mobileArr		=	$this->input->post('scontact_no');
							$emailArr		= 	$this->input->post('semail');
							$faxArr			= 	$this->input->post('sfax');
							$websiteArr		=	$this->input->post('swebsite');


							$cr_noArabicArry =  $this->input->post('scr_no_arabic');//new
							$vat_num_ArabicArray = $this->input->post('svendor_no1');//new
							$address_arabicArr		=	$this->input->post('saddress11');
							$street_Arabic_Array = $this->input->post('sstreet_arabic');//new
							
							$city_arabicArr			= 	$this->input->post('scity_arabic');
							$state_arabicArr		= 	$this->input->post('sprovince_arabic');
							$districtArabic_Arry = $this->input->post('sdistrict_arabic');//new
							$zip_arabicArr			=	$this->input->post('szip_arabic');
							$Po_arabicArr			=	$this->input->post('spo_box_arabic');
							$country_arabicArr		=	$this->input->post('scountry_arabic');
							$phone_arabicArr		=	$this->input->post('slandline_no_arabic');
							$phone1_arabicArr		=	$this->input->post('slandline_no1_arabic');//new
							$mobile_arabicArr		=	$this->input->post('scontact_no_arabic');
							$email_arabicArr		= 	$this->input->post('semail_arabic');
							$fax_arabicArr			= 	$this->input->post('sfax_arabic');
							$website_arabicArr		=	$this->input->post('swebsite_arabic');


							foreach($addressEngArr as $key => $val)
							{
								
									$value_array1	=	array
														(	
															'vendor_id'		    =>	$result,
															'vendor_cr_no'      =>$cr_noEngArry[$key],
															'vendor_vat_no'      =>$vat_num_engArray[$key],
															'vendor_address'	=>	$addressEngArr[$key],
															'vendor_street'     =>$street_engArray[$key],
															'district'          => $districtEngArry[$key],
															'area'			    =>	$POArr[$key],
															'city'				=>	$cityArr[$key],
															
															'state'			    => 	$stateArr[$key],
															'post_code'			=> 	$zipArr[$key],

															'country'			=>	$countryArr[$key],
															'phone'				=>	$phoneArr[$key],
															'phone1'		    =>	$phoneArr1[$key],
															
															'mobile'			=> 	$mobileArr[$key],
															'email'				=> 	$emailArr[$key],
															'fax'				=> 	$faxArr[$key],
															'website'			=> 	$websiteArr[$key],

															'vendor_cr_no_arabic'      =>$cr_noArabicArry[$key],
															'vendor_vat_no_arabic'      =>$vat_num_ArabicArray[$key],
															
															'vendor_street_arabic'     =>$street_Arabic_Array[$key],
															'district_arabic'          => $districtEngArry[$key],
														'vendor_address_arabic'		=>	$address_arabicArr[$key],
				
														'area_arabic'			    =>	$Po_arabicArr[$key],
														'city_arabic'				=>	$city_arabicArr[$key],
															
														'state_arabic'			    => 	$state_arabicArr[$key],
														'post_code_arabic'			=> 	$zip_arabicArr[$key],

														'country_arabic'			=>	$country_arabicArr[$key],
														'phone_arabic'				=>	$phone_arabicArr[$key],
														'phone1_arabic'				=>	$phone1_arabicArr[$key],
														'mobile_arabic'				=> 	$mobile_arabicArr[$key],
														'email_arabic'				=> 	$email_arabicArr[$key],
														'fax_arabic'				=> 	$fax_arabicArr[$key],
														'website_arabic'			=> 	$website_arabicArr[$key],
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
public function addVendorRep()
	{
		
		$vendor_id	=	$this->input->get('vendor_id');	
		$view_data['drop_menu_client']	=	$this->Mdropdown->drop_menu_vendor1($vendor_id);
		$view_data['drop_menu_title']	=	$this->Mdropdown->drop_menu_title();
		$view_data['drop_menu_designation']	=	$this->Mdropdown->drop_menu_designation();
		
        parse_str($_POST['postdata'], $_POST);//This will convert the string to array
        if(isset($_POST['submit']))
        {
				
				if($this->input->post('rep_id')!='')
				{
				
					$value_array=array(
					'vendor_id'				=>	strtoupper($this->input->post('client_name')),
					'title_id'				=>	strtoupper($this->input->post('title')),
					'rep_name'				=>	strtoupper($this->input->post('rep_name')),
					'email'					=>	strtoupper($this->input->post('email')),
					'mobile'				=>	strtoupper($this->input->post('contact_num')),
					'mobile1'				=>	strtoupper($this->input->post('contact_num1')),
					'designation'			=>	strtoupper($this->input->post('designation')),
				);
				$where_array	=	array('id'=>$this->input->post('rep_id'));
				$resultupdate	=	$this->mcommon->common_edit('tbl_vendor_rep',$value_array,$where_array);
				}
				else
				{
				
					$value_array=array(
					'vendor_id'				=>	strtoupper($this->input->post('client_name')),
					'title_id'				=>	strtoupper($this->input->post('title')),
					'rep_name'				=>	strtoupper($this->input->post('rep_name')),
					'email'					=>	strtoupper($this->input->post('email')),
					'mobile'				=>	strtoupper($this->input->post('contact_num')),
					'mobile1'				=>	strtoupper($this->input->post('contact_num1')),
					'designation'			=>	strtoupper($this->input->post('designation')),
				);
				$result=$this->mcommon->common_insert('tbl_vendor_rep',$value_array);	
				}

        }

        $fields_arraycat = array(
    		'ts.id','ts.name'
    	);
    	
		$data['drop_menu_client_rep']	=	$this->Mdropdown->drop_menu_vendor_rep();
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

        	$id 				=  $this->input->get('vendor_id');
        	// $view_data['values'] = $this->mcommon->get_fulldata1('tbl_client_rep',array('client_id'=>$id));
        	$view_data['values'] = $this->mcommon->VendorRepdetails($id);
 			echo $this->load->view('masters/vendor/add_vendor_rep',$view_data,TRUE);	
        }
	}
	public function getRepDetailsDataModal()
{
	$fields_arraySatip = array(
    		'cr.id','cr.vendor_id','cr.title_id','cr.rep_name','cr.email','cr.mobile','cr.mobile1','cr.designation','t.name','d.desgination_name'
    	);
		$whereArrSatip = array('cr.id' =>$_GET['rep_id']);

		$join_arraySatip = array(
			'tbl_desgination AS d' => 'd.desgination_id = cr.designation',
			'titles AS t' => 't.id = cr.title_id',
			
		);

	    $satipDataDetails =   $this->mcommon->join_records_all($fields_arraySatip,'tbl_vendor_rep as cr', $join_arraySatip, $whereArrSatip, '', '`cr.id` ASC ','','array');
	    echo json_encode($satipDataDetails[0]);
}
public function DeleteVendorRep()
	{
		// $res = $this->sal_common->common_delete('sales_order_list',array('po_pdt_id' => $this->input->get('pro_item_id') ));
		$this->mcommon->common_delete('tbl_vendor_rep',array('id' => $this->input->get('rep_id') ));
		    $view_data['result'] = 'Success1';
        	$view_data['res_type'] = 'success';
        	$view_data['res'] = 'Deleted Successfully';
        
            echo json_encode($view_data);
	}
	public function deleteshipAddress()
	{
		$res = $this->mcommon->common_delete('table_vendor_address',array('id' => $this->input->get('prid') ));
	}

}

?>