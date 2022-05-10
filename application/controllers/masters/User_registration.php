<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_registration extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('Mdropdown','Mdropdown',TRUE);
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->library('email');
	}

	public function index( $msg = array() )
	{
		if($this->require_min_level(1))
        {
        	$log_user_id			=	$this->auth_user_id;
        	$msg['log_user_role'] = $this->mcommon->find_log_user_role($log_user_id);
        	$log_user_role = $msg['log_user_role'];
        	
			$msg['form_url']			=	base_url('masters/User_registration/add');
	        $msg['form_toptittle']		=	'User Management';
        	$msg['datatable_url']		=	'masters/User_registration/datatable';
        	$msg['drop_menu_role']		=	$this->Mdropdown->drop_menu_role();
        	$msg['getACLActions']   	=	$this->mcommon->getACLActions();
        	$msg['alerturl']			=	base_url('masters/User_registration');

        	//$msg['back_url']='masters/Maincontacts/add';
        	//$msg['back_urlstatus']='1';

        		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';
    			$pass = array(); 
    			$alphaLength = strlen($alphabet) - 1; 
    			for ($i = 0; $i < 8; $i++) 
    			{
        				$n = rand(0, $alphaLength);
        				$pass[] = $alphabet[$n];
    			}
   			$msg['auto_pass'] =  implode($pass); 
			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			if(($log_user_role=='10') ||($log_user_role=='9' )  ){
			$this->table->set_heading('Operation','User Name', 'Reset Password','Locked','Status','User Role', 'Email','Created By','Created On','Updated By','Updated On'); 
			}
			else
			{
			$this->table->set_heading('Operation','User Name','User Role', 'Email','Created By','Created On','Updated By','Updated On'); 
			}
			$sessionArr 	=	$this->session->all_userdata();
			
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model; 
 		
 			$data=array(
				'sidebar'	=> 	'',
				'sb_type'	=> 	'0',
				'title'     => 	'User Management',
				'content'   =>	$this->load->view('masters/user_registration/viewform',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	function datatable()
    {
    	 $log_user_role =$form_name = $_POST['pro_id'];
    	if(($log_user_role=='10') ||($log_user_role=='9' )  ){
    	$this->datatables->select('b.user_id, b.username,b.user_id as U_id,b.user_id as lock_id,b.banned, r.role_name, b.email, b.created_by, b.created_at, b.updated_by, b.modified_at')
	        ->from('users AS b')
	        ->join('tbl_user_role AS r', 'r.role_id=b.auth_level', 'left')
	      	// ->where('b.banned','0')
			->edit_column('b.user_id', get_buttons_new('$1','masters/User_registration/', 'b.user_id'), 'b.user_id');
			$this->datatables->edit_column('U_id', '$1', 'get_Lock_Status(U_id)');
			$this->datatables->edit_column('lock_id', '$1', 'get_Lock_Status1(lock_id,b.banned)');
			$this->datatables->edit_column('b.banned', '$1', 'get_Lock_user_Status(b.banned)');

        echo $this->datatables->generate();
    }
    else
    {
    	$this->datatables->select('b.user_id, b.username, r.role_name, b.email, b.created_by, b.created_at, b.updated_by, b.modified_at')
	        ->from('users AS b')
	        ->join('tbl_user_role AS r', 'r.role_id=b.auth_level', 'left')
	      	// ->where('b.banned','0')
			->edit_column('b.user_id', get_buttons_new('$1','masters/User_registration/', 'b.user_id'), 'b.user_id');
			// $this->datatables->edit_column('U_id', '$1', 'get_Lock_Status(U_id)');

        echo $this->datatables->generate();
    }
    }

	public function add()
	{
		$this->load->model('auth_model');
        $this->load->model('validation_callables');
        $this->load->model('examples_model');
        $this->load->library('form_validation');

		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{			
				if($this->input->post('user_id') > 0)
				{
					$aclActions = $this->input->post('acl_actions[]');
					$user_data = array(
										
										'email'      		=> ($this->input->post('email'))    		? $this->input->post('email') : '',
										'auth_level'      	=> ($this->input->post('auth_level'))		? $this->input->post('auth_level') : '',
									);

					$this->form_validation->set_data( $user_data );

					$validation_rules = array(
												array(
									                'field'  => 'email',
									                'label'  => 'email',
									                'rules'  => 'trim|required|valid_email',
									                'errors' => array(
									                    'valid_email' => 'Email address already in use.'
									                )
												),
												array(
													'field'  => 'auth_level',
													'label'  => 'auth_level',
													'rules'  => 'trim|required',
													'errors' => array(
														'required' => 'The user role is required'
													)
												)
											);
				

					$this->form_validation->set_rules( $validation_rules );

					if( $this->form_validation->run() )
					{
						
						$user_data['passwd']     = $this->input->post('old_pass');
					
						
						//$user_data['banned']		=	$this->input->post('banned');$this->auth_user_id
						$user_data['modified_at'] 	= 	date('Y-m-d H:i:s');
						//commited 12-2-2022
						$user_data['updated_by'] 	= 	$this->auth_username;
					   // $user_data['updated_by'] 	= 	$this->auth_user_id;
					    
						$user_data['auth_level']	= 	$this->input->post('auth_level');
						 $user_data['psname'] = $this->input->post('old_string');

						$this->db->set($user_data)
							->where('user_id', $this->input->post('user_id'))
							->update(config_item('user_table'));

						if( $this->db->affected_rows() == 1 )
						{
							if( $this->input->post('aclRecords') <= 0 || ($this->input->post('auth_level') != $this->input->post('current_role')) ) {

								//Delete all acl permission before insert again
								$this->db->delete('acl', array('user_id' => $this->input->post('user_id')));

								//Get ACL actions from acl_role table
								$aclActions = $this->mcommon->records_all('acl_role', array('role_id' => $this->input->post('auth_level')));

								foreach($aclActions as $row)
								{
									$this->mcommon->common_insert('acl', array('action_id' => $row->action_id, 'user_id' => $this->input->post('user_id')));
								}
								
							}else if(! empty($aclActions)){

								//Delete all acl permission before insert again
								$this->db->delete('acl', array('user_id' => $this->input->post('user_id')));

								//Get ACL actions from form POST
								foreach ($aclActions as $action_id) {
									$this->mcommon->common_insert('acl', array('action_id' => $action_id, 'user_id' => $this->input->post('user_id')));
								}
							} 

							$this->session->set_userdata('successMsg', '<p>User <b>' . $this->input->post('username') . '</b> has been updated.</p>');
							redirect(base_url('masters/User_registration'), 'refresh');
						}
					}
					else
					{
						$msg['message']	= validation_errors();
					}
				}
				else
				{
					$user_data=array(
								'username'			=>	$this->input->post('username'),
								'email'				=>	$this->input->post('email'),
								'passwd'			=>	$this->input->post('passwd'),
								'created_by'	    =>	$this->auth_username,
								// 'created_by' 	    => 	$this->auth_user_id,
								'created_at'  		=>	date('Y-m-d H:i:s'),
								'auth_level'		=> 	$this->input->post('auth_level'),
							);

			 		$this->form_validation->set_data( $user_data );

				   		$validation_rules = array(
				   			array(
			                'field'  => 'username',
			                'label'  => 'username',
			                'rules'  => 'trim|required|max_length[12]|is_unique[' . config_item('user_table') . '.username]',
			                'errors' => array(
			                    'is_unique' => 'Username address already in use.'
			                )
						),

						array(
							'field' => 'passwd',
							'label' => 'passwd',
							'rules' => array(
			                    'trim',
			                    'required',
			                    array( 
			                        '_check_password_strength', 
			                        array( $this->validation_callables, '_check_password_strength' ) 
			                    )
			                ),
			                'errors' => array(
			                    'required' => 'The password field is required.'
			                )
						),

						array(
			                'field'  => 'email',
			                'label'  => 'email',
			                'rules'  => 'trim|required|valid_email|is_unique[' . config_item('user_table') . '.email]',
			                'errors' => array(
			                    'is_unique' => 'Email address already in use.'
			                )
						),

						array(
							'field'  => 'auth_level',
							'label'  => 'auth_level',
							'rules'  => 'trim|required',
							'errors' => array(
								'required' => 'The user role is required'
							)
						)				 
					);	
					
					$this->form_validation->set_rules( $validation_rules );
					
					if( $this->form_validation->run() )
					{
			            $user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
			            $user_data['user_id']    = $this->examples_model->get_unused_id();
			            $user_data['created_at'] = date('Y-m-d H:i:s');
			            $user_data['psname'] = $this->input->post('psname');
			            // If username is not used, it must be entered into the record as NULL
			            if( empty( $user_data['username'] ) )
			            {
			                $user_data['username'] = NULL;
			            }

						$this->db->set($user_data)
							->insert(config_item('user_table'));
							                   		
           				$results = $this->db->affected_rows();

						if( $this->db->affected_rows() == 1 )
						{
							$aclActions = $this->mcommon->records_all('acl_role', array('role_id' => $this->input->post('auth_level')));
							foreach($aclActions as $row)
							{
								$this->mcommon->common_insert('acl', array('action_id' => $row->action_id, 'user_id' => $user_data['user_id']));
							}							
						}
					}
				}
					
					//Send mail 	
				if($results)
				{
					$e_host='ssl://smtp.googlemail.com';
            		// $e_port='465';
            		// $e_user='rahulrithu2016@gmail.com';
            		// $e_pass='Rithu@2016';
            		 $e_user=$this->mcommon->get_com_pany_email();
					$e_pass= $this->mcommon->get_com_pany_email_pass();
					$e_port = $this->mcommon->get_com_pany_ssl();
            		$config = array(
                		'protocol'  => 'sendmail',
                		'smtp_host' => $e_host,
                		'smtp_port' => $e_port,
                		'smtp_user' => $e_user,
                		'smtp_pass' => $e_pass,
                		'mailtype'  => 'html',
                		'charset'   => 'iso-8859-1'
            			);
            		$data['flag'] = $flag;
					$data['use_name'] =$this->input->post('email');
					$data['sys_pass']=$this->input->post('psname');
					$data['organization_detail']	=	$this->mcommon->getCompanyProfiles('1');
					foreach($data['organization_detail']->result() as $row)
					{
		    			$c_org_name           = ucwords($row->c_org_name);
					}

					$to_email =   strip_tags( $this->input->post('email'));
					$this->load->library('email');
					$this->email->initialize($config);
					$this->email->from($e_user);
					$list = array($c_org_name);
        			$this->email->to($to_email);
					$this->email->subject('Login Password Information' );

					$content = 'Please be informed that your '.$c_org_name.' App password has been created. You may login using below username and password. <br/>';
					$body = 'PRIVATE & CONFIDENTIAL <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
					$body.= $content.'<br/><br/>';
        			$body.= $this->load->view('masters/user_registration/conformationemail', $data, TRUE);
        			// print_r($body);die;
					$this->email->message($body); 
					$this->email->set_mailtype("html");
					if($this->email->send()) 
					{
						$this->session->set_userdata('successMsg', 'Added Successfully... Email sent successfully....');
					    redirect(base_url('masters/User_registration'), 'refresh');						
					}
					else
					{
						$this->session->set_userdata('successMsg', 'Added Successfully... Error in sending Email....');
						redirect(base_url('masters/User_registration'), 'refresh');		
					}	
				}	
				else
				{
					$this->index($data);
				}
  			}
  			/// Admin Reset Pass Word
			// if(isset($_POST['Submit1']))
			// {
			// 	$user_data = array(
										
			// 						'email'      		=> ($this->input->post('email'))    		? $this->input->post('email') : '',
			// 						'auth_level'      	=> ($this->input->post('auth_level'))		? $this->input->post('auth_level') : '',
			// 						);

			// 		$this->form_validation->set_data( $user_data );

			// 		$validation_rules = array(
			// 									array(
			// 						                'field'  => 'email',
			// 						                'label'  => 'email',
			// 						                'rules'  => 'trim|required|valid_email',
			// 						                'errors' => array(
			// 						                    'valid_email' => 'Email address already in use.'
			// 						                )
			// 									),
			// 									array(
			// 										'field'  => 'auth_level',
			// 										'label'  => 'auth_level',
			// 										'rules'  => 'trim|required',
			// 										'errors' => array(
			// 											'required' => 'The user role is required'
			// 										)
			// 									)
			// 								);
				

			// 		$this->form_validation->set_rules( $validation_rules );
			// 		if( $this->form_validation->run() )
			// 		{
			// 			$user_data['passwd']     = $this->authentication->hash_passwd($this->input->post('passwd'));
			// 			$user_data['psname'] = $this->input->post('psname');
			// 			$user_data['modified_at'] 	= 	date('Y-m-d H:i:s');
			// 			$user_data['updated_by'] 	= 	$this->auth_username;
			// 			$user_data['auth_level']	= 	$this->input->post('auth_level');
			// 			$this->db->set($user_data)
			// 				->where('user_id', $this->input->post('user_id'))
			// 				->update(config_item('user_table'));

			// 			// Send Password to Mail
			// 			$e_host='ssl://smtp.googlemail.com';
   //          		$e_port='465';
   //          		$e_user='rahulrithu2016@gmail.com';
   //          		$e_pass='Rithu@2016';
   //          		$config = array(
   //              		'protocol'  => 'sendmail',
   //              		'smtp_host' => $e_host,
   //              		'smtp_port' => $e_port,
   //              		'smtp_user' => $e_user,
   //              		'smtp_pass' => $e_pass,
   //              		'mailtype'  => 'html',
   //              		'charset'   => 'iso-8859-1'
   //          			);
   //          		$data['flag'] = $flag;
			// 		$data['use_name'] =$this->input->post('email');
			// 		$data['sys_pass']=$this->input->post('psname');
			// 		$data['organization_detail']	=	$this->mcommon->getCompanyProfiles('1');
			// 		foreach($data['organization_detail']->result() as $row)
			// 		{
		 //    			$c_org_name           = ucwords($row->c_org_name);
			// 		}

			// 		$to_email =   strip_tags( $this->input->post('email'));
			// 		$this->load->library('email');
			// 		$this->email->initialize($config);
			// 		$this->email->from('rahulrithu2016@gmail.com');
			// 		$list = array($c_org_name);
   //      			$this->email->to($to_email);
			// 		$this->email->subject('Login Password Information' );

			// 		$content = 'Please be informed that your '.$c_org_name.' App password has been created. You may login using below username and password. <br/>';
			// 		$body = 'PRIVATE & CONFIDENTIAL <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
			// 		$body.= $content.'<br/><br/>';
   //      			$body.= $this->load->view('masters/user_registration/conformationemail', $data, TRUE);
   //      			// print_r($body);die;
			// 		$this->email->message($body); 
			// 		$this->email->set_mailtype("html");
			// 		if($this->email->send()) 
			// 		{
			// 			$this->session->set_userdata('successMsg',' Password sent successfully....');
			// 		    redirect(base_url('masters/User_registration'), 'refresh');						
			// 		}
			// 		else
			// 		{
			// 			$this->session->set_userdata('successMsg', 'Error in sending Password....');
			// 			redirect(base_url('masters/User_registration'), 'refresh');		
			// 		}			
			// 		}
			// 	}

  			// End 
		}	
	}

	public function operation( $id = '', $acl = '' )
	{
		$where_array 	= 	array( 'user_id'=>$id );
		$data['value']			=	$this->mcommon->get_fulldata('users', $where_array);
		$data['aclActions'] 	=	$this->mcommon->records_all('acl',$where_array);
		
	
		
		if($acl){
			$data['acl'] 			=	1;		
		}

		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'modified_at'  	=> date('Y-m-d H:i:s'),
							'banned'  	=> '1',
						  );
		$where_array=array(
							'user_id'=>$id
						  );
		$result=$this->mcommon->common_edit('users',$value_array,$where_array);

		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/User_registration'), 'refresh');
		}
		else
		{
			$this->index($data);
		}
	}
	public function Change_Password( $msg = array() )
	{
		if($this->require_min_level(1))
        {
        	// print_r($this->auth_user_id);die;
			$msg['form_url']			=	base_url('masters/User_registration/update_password');
	        $msg['form_toptittle']		=	'Password Management';
       
        	$msg['user_id1']					=	$this->auth_user_id;
        	$msg['u_name'] = $this->auth_username;
			$sessionArr 	=	$this->session->all_userdata();
			
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model; 
 			
 			$data=array(
				'sidebar'	=> 	'',
				'sb_type'	=> 	'0',
				'title'     => 	'User Management',
				'content'   =>	$this->load->view('masters/user_registration/changepassword',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function update_password()
	{
		$this->load->model('auth_model');
        $this->load->model('validation_callables');
        $this->load->model('examples_model');
        $this->load->library('form_validation');

		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{			
				// print_r($this->input->post('passwd'));die;

				$rules = array(
				
				[
					'field' => 'passwd',
					'label' => 'New Password',
					'rules' => 'callback_valid_password',
				],
				[
					'field' => 'c_passwd',
					'label' => 'Confirm Password',
					'rules' => 'matches[passwd]',
				],
			);
			$this->form_validation->set_rules($rules);
		
		
			if($this->form_validation->run()==FALSE)
			{
			$msg['form_url']			=	base_url('masters/User_registration/update_password');
	        $msg['form_toptittle']		=	'Password Management';
        	$msg['user_id1']					=	$this->auth_user_id;
        	$msg['u_name'] = $this->auth_username;
       
			$sessionArr 	=	$this->session->all_userdata();
			
			$msg['notification'] 	= $sessionArr['successMsg'];
 			$auth_model 			= $this->authentication->auth_model;
			$data=array(
				'sidebar'	=> 	'',
				'sb_type'	=> 	'0',
				'title'     => 	'User Management',
				'content'   =>	$this->load->view('masters/user_registration/changepassword',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);
			}
			else
			{
			
			$user_id = $this->auth_user_id;
			$password = $this->input->post('passwd');
			$has_pass = $this->authentication->hash_passwd($password);
			$value_array['passwd']= $has_pass ;
			$value_array['psname']= $password;
			$where_array	=	array('user_id'=>$user_id);
			$this->mcommon->common_edit('users',$value_array,$where_array);
			$value_array1	=	array(
										'user_id'			=>	$this->auth_user_id,
										'password'			=>	$password,
										'updated_at'   => 	date('Y-m-d H:i:s'),
													
									);
					
			$this->mcommon->common_insert('users_passwords',$value_array1);

			$this->session->set_userdata('successMsg', 'Updated Successfully...');
			
			// redirect(base_url('masters/User_registration/Change_Password'));	
			redirect('auth/logout', 'refresh');
			}

  			}
		}	
	}
	public function valid_password($password = '')
	{
			// $data = array();
		$user_id = $this->auth_user_id;
		$password = trim($password);
		// $pass = $this->authentication->hash_passwd($password);
		$pass_check = $this->mcommon->find_user_password($user_id);


		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';
		if(in_array($password, $pass_check))

		{
				$this->form_validation->set_message('valid_password', 'The {field} already Use this password please use another one .');

			return FALSE;
		
		}
		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');

			return FALSE;
		}
		if(!empty($password))
		{
			if(strlen($password > 16))
			{
					$this->form_validation->set_message('valid_password', 'The {field} Password not Exceed 16 Charactors');

			return FALSE;
			}
			// if(strlen($password < 8))  
			// {
			// 	$this->form_validation->set_message('valid_password', 'The {field} Password Minimum 8 Charactors');

			// return FALSE;
			// }
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');

			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));

			return FALSE;
		}

		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');

			return FALSE;
		}

		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

			return FALSE;
		}

		return TRUE;
	}
	public function BannedUser()
	{
		$id = $this->input->get('user_id');
			$data = $this->input->get('data');
			if($data =='1'){
		$value_array=array(
							'modified_at'  	=> date('Y-m-d H:i:s'),
							'banned'  	=> '1',
						  );
	}
	else
	{
			$value_array=array(
							'modified_at'  	=> date('Y-m-d H:i:s'),
							'banned'  	=> '0',
						  );
	}
		$where_array=array(
							'user_id'=>$id
						  );
		$this->mcommon->common_edit('users',$value_array,$where_array);

		
		
	}
	public function AdminResetPassword()
	{
		$id = $this->input->get('user_id');
		$data = $this->input->get('data');
   			$user_id = $id;

			$password =  $this->input->get('data');
			$has_pass = $this->authentication->hash_passwd($password);
			$value_array['passwd']= $has_pass ;
			$value_array['psname'] =$data;
			$where_array	=	array('user_id'=>$user_id);
			 $this->mcommon->common_edit('users',$value_array,$where_array);
			 $e_host='ssl://smtp.googlemail.com';
		    $e_user=$this->mcommon->get_com_pany_email();
			$e_pass= $this->mcommon->get_com_pany_email_pass();
			$e_port = $this->mcommon->get_com_pany_ssl();
			// $e_host='ssl://smtp.googlemail.com';
            		// $e_port='465';
            		// $e_user='rahulrithu2016@gmail.com';
            		// $e_pass='Rithu@2016';
            		$config = array(
                		'protocol'  => 'sendmail',
                		'smtp_host' => $e_host,
                		'smtp_port' => $e_port,
                		'smtp_user' => $e_user,
                		'smtp_pass' => $e_pass,
                		'mailtype'  => 'html',
                		'charset'   => 'iso-8859-1'
            			);
            		$data['flag'] = $flag;
					$user_email=$this->mcommon->find_user_id_email($id);
					$user_password=$this->mcommon->find_user_id_password($id);
					// $data['use_name']  = $user_email;

					// $data['sys_pass']=$data;

					$organization_detail	=	$this->mcommon->getCompanyProfiles('1');
					
					foreach($organization_detail->result() as $row)
					{
		    			$c_org_name           = ucwords($row->c_org_name);
					}


					$data_login=['use_name'=>$user_email, 'sys_pass'=> $data];
				
					$to_email =   strip_tags($data_login['use_name']);
					$this->load->library('email');
					$this->email->initialize($config);
					$this->email->from($e_user);
					// $list = array($c_org_name);
        			$this->email->to($to_email);
					$this->email->subject('Login Password Information' );

					$content = 'Please be informed that your'.$c_org_name.'  App password has been created. You may login using below username and password. <br/><br><br><br><br>
					UserId	:	'.$user_email.'<br>
					Password 	:	'.$user_password.'<br>
					(Password is case sensitive)<br>';
					$body = 'PRIVATE & CONFIDENTIAL <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;';
					$body.= $content.'<br/><br/>';
        			$body.= $this->load->view('masters/user_registration/adminpasswordreset',$data);
					$this->email->message($body); 
					$this->email->set_mailtype("html");
					if($this->email->send()) 
					{
						echo 'Password send to registerd Email';			
					}
					else
					{
						echo 'Reset Password sending Error';	
					}			
	}


	
}
?>