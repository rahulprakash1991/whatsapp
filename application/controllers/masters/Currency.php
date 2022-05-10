<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->model('common_model','mcommon',TRUE);
		// $this->load->library('excel');
		// $this->load->library('upload');
	}

	public function index( $msg = array() )
	{  
		if($this->require_min_level(1))
        {
			$msg['form_url']		=	'masters/Currency/add';
	        $msg['form_toptittle']	=	'Currency Management';
        	$msg['datatable_url']	=	'masters/Currency/datatable';
        	

			$tmpl = array ( 'table_open'  => '<table id="example" cellpadding="2" cellspacing="1" class="table datatable-responsive-column-controlled">' );
			$this->table->set_template($tmpl); 
			$this->table->set_heading('Operations','Country',' Currency Name',' Currency Symbol','Status','ISO Code','Fractional Unit','Number to Basic'); 
		
			$sessionArr=$this->session->all_userdata(); 
			$msg['notification'] = $sessionArr['successMsg'];
 			$auth_model = $this->authentication->auth_model;
 
 			$data=array(
							'sidebar'	=> '',
							'sb_type'	=> '0',
							'title'     => 'Currency Management',
							'content'   =>$this->load->view('masters/currency/viewform',$msg,TRUE)
						);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}

	}

	function datatable()
    {
    	$this->datatables->select('b.cur_id,b.state,b.cur_name,b.currency,b.cur_status,b.iso_code,b.unit,b.num_to_basic')
        ->from('tbl_currency AS b')
       	->join('users AS u', 'u.user_id = b.cur_created_by','left')
       	   ->join('users AS v', 'v.user_id = b.cur_updated_by','left')  
    	->where('b.currency_delete_status=1')
		->edit_column('b.cur_id', get_buttons_new('$1','masters/Currency/'), 'b.cur_id');
		
		// $this->datatables->edit_column('b.cur_created_on', '$1', 'get_date_timeformat(b.cur_created_on)');
		// $this->datatables->edit_column('b.cur_updated_on', '$1', 'get_date_timeformat(b.cur_updated_on)');
		$this->datatables->edit_column('b.cur_status', '$1', 'get_statusbase(b.cur_status)');		
        echo $this->datatables->generate();
    }
 



	public function add()
	{
		// if($this->require_min_level(1))
		// {
	
  //      			if(isset($_POST['Submit'])) {
  //  				$path = '~cdn/importSatip/';
  //               require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';              
  //               $config['upload_path'] = $path;
  //               $config['allowed_types'] = 'xlsx|xls|csv';
  //               $config['remove_spaces'] = TRUE;
  //               $this->load->library('upload', $config);
  //               $this->upload->initialize($config);            
  //               if (!$this->upload->do_upload('uploadFile')) {
  //                   $error = array('error' => $this->upload->display_errors());
  //               } else {
  //                   $data = array('upload_data' => $this->upload->data());
  //               }
  //               if(empty($error)){
  //                 if (!empty($data['upload_data']['file_name'])) {
  //                   $import_xls_file = $data['upload_data']['file_name'];
  //               } else {
  //                   $import_xls_file = 0;
  //               }
  //               $inputFileName = $path . $import_xls_file;
                 
  //               try {
  //                   $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
  //                   $objReader = PHPExcel_IOFactory::createReader($inputFileType);
  //                   $objPHPExcel = $objReader->load($inputFileName);
  //                   $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
  //                   $flag = true;
  //                   $i=0;
  //                   foreach ($allDataInSheet as $value) {
  //                     if($flag){
  //                       $flag =false;
  //                       continue;
  //                     }
                     
  //                      $inserdata[$i]['state'] = $value['A'];
  //                      $inserdata[$i]['cur_name'] = $value['B'];
  //                      $inserdata[$i]['currency'] = $value['C'];
  //                      $inserdata[$i]['iso_code'] = $value['D'];
  //                      $inserdata[$i]['unit'] = $value['E'];
  //                      $inserdata[$i]['num_to_basic'] = $value['F'];
                    
              
  //                     $inserdata[$i]['cur_updated_by'] =  $this->auth_user_id;   
		// 			  $inserdata[$i]['cur_updated_on'] =  date('Y-m-d H:i:s');
		// 			  $inserdata[$i]['cur_created_by'] = $this->auth_user_id;   
		// 			  $inserdata[$i]['cur_created_on'] =  date('Y-m-d H:i:s');
		// 			  $inserdata[$i]['cur_status'] = '1';
  //                    $result=$this->mcommon->common_insert('tbl_currency',$inserdata[$i]);
                     
  //                     $i++;
  //                   }     
                    
  //                   if($result){
                   
		// 				$this->session->set_userdata('successMsg', 'Added Successfully...');
		// 				redirect(base_url('masters/Currency'), 'refresh');
  //                   }
  //                   if($resultupdate)
		// 			{
		// 			$this->session->set_userdata('successMsg', 'Added Successfully...');
		// 				redirect(base_url('masters/Currency'), 'refresh');
		// 			}
  //                   else{
                   
  //                   }             
      
  //             } catch (Exception $e) {
  //                  die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
  //                           . '": ' .$e->getMessage());
  //               }
  //             }else{
  //                  $this->session->set_userdata('successMsg', 'Added Successfully...');
		// 				redirect(base_url('masters/Currency'), 'refresh');
  //               }
		// 	}	
		// }	
		if($this->require_min_level(1))
		{
			if(isset($_POST['Submit']))
			{
				$this->form_validation->set_rules('cur_name', 'Currency Name', 'required');
				$this->form_validation->set_rules('cur_symbol', 'Currency Symbol', 'required');


				if($this->form_validation->run() == TRUE) 
				{	
					if($this->input->post('cur_id')!='')
					{

						$value_array=array(
									'state'  => $this->input->post('country'),
									'iso_code' =>$this->input->post('cur_iso'),
									'unit' => $this->input->post('unit'),
									'num_to_basic' => $this->input->post('basic'),
									'cur_name'			=>$this->input->post('cur_name'),
									'currency'		=>$this->input->post('cur_symbol'),		
									'cur_created_by'	    => $this->auth_user_id,
									'cur_created_on'  		=> date('Y-m-d H:i:s'),
									'cur_updated_by'	    => $this->auth_user_id,
									'cur_updated_on'  		=> date('Y-m-d H:i:s'),
									'cur_status'      	=> $this->input->post('cur_status'),
									);

						$where_array=array(
											'cur_id'=>$this->input->post('cur_id')
										);
						$resultupdate=$this->mcommon->common_edit('tbl_currency',$value_array,$where_array);
					}
					else
					{
						$value_array=array(
							        'state'  => $this->input->post('country'),
									'iso_code' =>$this->input->post('cur_iso'),
									'unit' => $this->input->post('unit'),
									'num_to_basic' => $this->input->post('basic'),
									'cur_name'			=>$this->input->post('cur_name'),
									'currency'		    =>$this->input->post('cur_symbol'),		
									'cur_created_by'	=> $this->auth_user_id,
									'cur_created_on'  	=> date('Y-m-d H:i:s'),
									'cur_updated_by'	    => $this->auth_user_id,
									'cur_updated_on'  		=> date('Y-m-d H:i:s'),
									'cur_status'      	=> $this->input->post('cur_status'),
									);

						$result=$this->mcommon->common_insert('tbl_currency',$value_array);
					}
				}
			}

			if($result)
			{
				$this->session->set_userdata('successMsg', 'Added Successfully...');
				redirect(base_url('masters/Currency'), 'refresh');
			}
			elseif($resultupdate)
			{
				$this->session->set_userdata('successMsg', 'Updated Successfully...');
				redirect(base_url('masters/Currency'), 'refresh');
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
							'cur_id'=>$id
						);
		$data['value']=$this->mcommon->get_fulldata('tbl_currency',$where_array);
		$this->index($data);
	}

	public function delete( $id = '' )
	{
		$value_array=array(
							'currency_delete_status'		=>'0',
							'cur_created_by'	    => $this->auth_user_id,
							'cur_created_on'  	=> date('Y-m-d H:i:s'),
						   );
		$where_array=array(
							'cur_id'=>$id
						   );
		$result=$this->mcommon->common_edit('tbl_currency',$value_array,$where_array);
		if($result)
		{
			$this->session->set_userdata('successMsg', 'Deleted Successfully...');
			redirect(base_url('masters/Currency'), 'refresh');
		}else
		{
			$this->index($data);
		}

	}


}
?>