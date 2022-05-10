<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->library('email'); 
		$this->load->model('Prefs','pre',TRUE);
		$this->load->model('Purchaseorder','mpurchase',TRUE);
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);
	}

	public function text()
	{
		echo $this->mcommon->getInvoiceNo();
	}
	
	
	public function SalesReport()
	{  
		$msg['form_toptittle']='Sales Report';
		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
				$this->session->set_userdata(
					array(
                           	'from_date'	 		=> $this->input->post('from_date'),
                            'to_date' 			=> $this->input->post('to_date'),
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'searchFilter'    	    => $this->input->post('searchFilter'),
                		)

                    );
	        	$msg['from_date']		=	$this->input->post('from_date');
	    		$msg['to_date']			=	$this->input->post('to_date');
	    		$msg['vendor_id']		=	$this->input->post('vendor_id');
	        	$msg['searchFilter']	=	$this->input->post('searchFilter');
				$msg['values']			= 	$this->mpurchase->getSalesReport($msg);

			}
			$msg['values']			= 	$this->mpurchase->getSalesReport($msg);
			$msg['drop_menu_customer']	=	$this->mdropdown->drop_menu_client();
			$data=array(
							'sidebar'	=> '',
							'sb_type'	=> '0',
							'title'     => 'Invoice Management',
							'content'   =>$this->load->view('report/salesviewform',$msg,TRUE)
						);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function export_excel_sales($type = '')
	{  
		$msg['form_toptittle']='Sales';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['searchFilter']	=	$this->session->userdata('searchFilter');
    		$msg['values']			= 	$this->mpurchase->getSalesReport($msg);
    		
	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_sales_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_sales_report',$msg,TRUE);
	   		}
		}
	}

	public function purchase_report()
	{  
		$msg['form_toptittle']='Purchase Report';
		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
        		$this->session->set_userdata(
					array(
                           	'from_date'	 		=> $this->input->post('from_date'),
                            'to_date' 			=> $this->input->post('to_date'),
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'searchFilter'    	    => $this->input->post('searchFilter'),
                		)
                    );
	        	$msg['from_date']		=	$this->input->post('from_date');
	    		$msg['to_date']			=	$this->input->post('to_date');
	    		$msg['vendor_id']		=	$this->input->post('vendor_id');
				$msg['searchFilter']	=	$this->input->post('searchFilter');
        	}
			$msg['values']			= 	$this->mpurchase->getPurchaseReport($msg);
			$msg['drop_menu_vendor']=$this->mdropdown->drop_menu_vendor();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/purchaseviewform',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function export_excel_purchase($type = '')
	{  
		$msg['form_toptittle']='Purchase';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['searchFilter']	=	$this->session->userdata('searchFilter');

    		$msg['values']			= 	$this->mpurchase->getPurchaseReport($msg);
	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_purchase_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_purchase_report',$msg,TRUE);
	   		}
			
		}
	}

	public function payables()
	{  
		$msg['form_toptittle']='Payable Report';
		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
        		

        		$this->session->set_userdata(
					array(
                           	'from_date'	 		=> $this->input->post('from_date'),
                            'to_date' 			=> $this->input->post('to_date'),
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'payment_mode'    	    => $this->input->post('payment_mode'),
                            'menu_bank'    	    => $this->input->post('menu_bank'),
                            'searchFilter'    	=> $this->input->post('searchFilter'),
                		)
                    );
        		$msg['searchFilter']=$this->input->post('searchFilter');
        	}
			
    		$msg['from_date']		    =	$this->session->userdata('from_date');
    		$msg['to_date']			    =	$this->session->userdata('to_date');
    		$msg['vendor_id']		    =	$this->session->userdata('vendor_id');
    		$msg['payment_mode']		    =	$this->session->userdata('payment_mode');
    		$msg['menu_bank']		    =	$this->session->userdata('menu_bank');
			
			$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
			$msg['drop_menu_bank']			=	$this->mdropdown->drop_menu_bank();

    		$msg['vendorpayment']		= 	$this->mpurchase->vendorpayment($msg['vendor_id']);
			$msg['vendorpaidamount']	= 	$this->mpurchase->vendorpaidamount($msg['vendor_id']);
			$msg['values']			    = 	$this->mpurchase->payable($msg);
	
			$msg['drop_menu_vendor']=$this->mdropdown->drop_menu_vendor();
 			
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/payableform',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}
	
	public function Outstanding_payables()
	{  
		$msg['form_toptittle']='Outstanding Payables';
		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
        		$id = $this->input->post('vendor_id');
				$msg['company_ids'] = $id;
 	
				$msg['opening_balance'] = $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$id),'opening_balance');

				$msg['menu_terms'] = $this->mpurchase->menu_terms_report($id);

        		$this->session->set_userdata(
					array(
                          
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'searchFilter'    	=> $this->input->post('searchFilter'),
                		)
                    );
        		$msg['searchFilter']=$this->input->post('searchFilter');
        	}
			
			$msg['menu_terms']          = $this->mpurchase->menu_terms_report($id);


	
    		$msg['vendor_id']		    =	$this->session->userdata('vendor_id');
			
			$msg['drop_menu_vendor']=$this->mdropdown->drop_menu_vendor();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/Outstanding_payables_form',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}

	/*public function menu_terms()
	{
		$id = $this->input->get('vendor_id');
		$msg['company_ids'] = $id;

		$msg['opening_balance'] = $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$id),'opening_balance');

		$msg['menu_terms'] = $this->mpurchase->menu_terms($id);
	
		echo $this->load->view('report/Outstanding_payables_form_detail', $msg,TRUE);
	}*/
	public function Outstanding_receivables()
	{  
		
		$msg['form_toptittle']='Outstanding  Receivables';
		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
        		$id = $this->input->post('vendor_id');
        		$this->session->set_userdata(
					array(
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'searchFilter'    	=> $this->input->post('searchFilter'),
                		)
                    );
        	}
			
    		$msg['vendor_id']		    =	$this->session->userdata('vendor_id');
    		$msg['menu_terms'] 			= 	$this->mpurchase->menu_terms_sales_report($id);
			$msg['drop_menu_customer']	=	$this->mdropdown->drop_menu_client(); 		

 			$data	=	array(
								'sidebar'	=> '',
								'sb_type'	=> '0',
								'title'     => 'Invoice Management',
								'content'   =>$this->load->view('report/Outstanding_receivables_form',$msg,TRUE)
							);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function menu_terms_receivables()
	{
		$id = $this->input->get('sal_company_name');

		$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
		$msg['drop_menu_bank']=$this->mdropdown->drop_menu_bank();
		$msg['drop_menu_tax1']=$this->mdropdown->drop_menu_tax1();

		$msg['company_ids'] = $id;

		$msg['opening_balance'] = $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$id),'opening_balance');

		$msg['menu_terms_sales'] = $this->mpurchase->menu_terms_sales($id);
		echo $this->load->view('report/Outstanding_receivables_form_detail', $msg,TRUE);
	}

	public function receivables()
	{  
		$msg['form_toptittle']='Receivable Report';
		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
	        	$this->session->set_userdata(
					array(
                           	'from_date'	 		=> $this->input->post('from_date'),
                            'to_date' 			=> $this->input->post('to_date'),
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'searchFilter'      => $this->input->post('searchFilter'),
                            'payment_mode'    	=> $this->input->post('payment_mode'),
                            'menu_bank'    	    => $this->input->post('menu_bank'),
                            
                           
                		)
                    );
			}
			$msg['from_date']		    =	$this->session->userdata('from_date');
    		$msg['to_date']			    =	$this->session->userdata('to_date');
    		$msg['vendor_id']		    =	$this->session->userdata('vendor_id');
    		$msg['payment_mode']		=	$this->session->userdata('payment_mode');
    		$msg['menu_bank']		    =	$this->session->userdata('menu_bank');
    		$msg['searchFilter']	    =	$this->input->post('searchFilter');

    		$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
			$msg['drop_menu_bank']			=	$this->mdropdown->drop_menu_bank();



			$msg['values']			    = 	$this->mpurchase->receivable($msg);
			$msg['customerpayment']		= 	$this->mpurchase->customerpayment($msg['vendor_id']);
			$msg['customerpaidamount']	= 	$this->mpurchase->customerpaidamount($msg['vendor_id']);
			$msg['drop_menu_customer']	=	$this->mdropdown->drop_menu_client();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/receivableform',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function export_excel_receivable($type = '')
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['payment_mode']		=	$this->session->userdata('payment_mode');
    		$msg['menu_bank']			=	$this->session->userdata('menu_bank');
    		$msg['vendor_id']		   =	$this->session->userdata('vendor_id');
    		$msg['customerpayment']		= 	$this->mpurchase->customerpayment($msg['vendor_id']);
			$msg['customerpaidamount']	= 	$this->mpurchase->customerpaidamount($msg['vendor_id']);
			$msg['values']			= 	$this->mpurchase->receivable($msg);
	   		  
			if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_receivable_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_receivable_report',$msg,TRUE);
	   		}
			
		}
	}
	
	public function export_excel_payables($type = '')
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['menu_bank']		=	$this->session->userdata('menu_bank');
    		$msg['payment_mode']		=	$this->session->userdata('payment_mode');
    		$msg['vendorpayment']		= 	$this->mpurchase->vendorpayment($msg['vendor_id']);
			$msg['vendorpaidamount']	= 	$this->mpurchase->vendorpaidamount($msg['vendor_id']);
			$msg['values']			= 	$this->mpurchase->payable($msg);
	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_payables_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_payables_report',$msg,TRUE);
	   		}
			
		}
	}

	public function customer_balance_sheet($id = '')
	{ 
		$msg['form_toptittle']='Customer Balance Sheet';
		if($this->require_min_level(1))
        {
			 if(isset($_POST['searchFilter']))
        	{
	        	$this->session->set_userdata(
					array(
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'from_date'    	    => $this->input->post('from_date'),
                            'to_date'    	    => $this->input->post('to_date'),
                		)
                    );
			}
			elseif(!empty($id))
			{
				$this->session->set_userdata(
					array(
                            'vendor_id'    	    => $id,
                            'from_date'    	    => $this->input->post('from_date'),
                            'to_date'    	    => $this->input->post('to_date'),
                		)
                    );
			}

			$msg['vendor_id']		                =	$this->session->userdata('vendor_id');
			$msg['from_date']	                    =	$this->session->userdata('from_date');
			$msg['to_date']	                        =	$this->session->userdata('to_date');
			$msg['customer_balance_sheet']          =   $this->mpurchase->customer_balance_sheet($msg['from_date'],$msg['to_date'],$msg['vendor_id']);

			$msg['dateWiseOpeningBalance']			=	$this->mpurchase->dateWisecustomerOpeningBalance($msg['from_date']	,$msg['vendor_id']);
			$msg['opening_balance']                 =   $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'opening_balance_actual');
			$msg['con_created_on']                  =   $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'con_created_on');
		
			$msg['drop_menu_customer']	            =	$this->mdropdown->drop_menu_client();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/customer_balance_sheet',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}

	}
	public function vendor_balance_sheet($id = '')
	{ 
		$msg['form_toptittle']='Vendor Balance Sheet';
		if($this->require_min_level(1))
        {
			 if(isset($_POST['searchFilter']))
        	{
	        	$this->session->set_userdata(
					array(
                            'vendor_id'    	    => $this->input->post('vendor_id'),
                            'from_date'    	    => $this->input->post('from_date'),
                            'to_date'    	    => $this->input->post('to_date'),
                		)
                    );
			}
			elseif(!empty($id))
			{
				$this->session->set_userdata(
					array(
                            'vendor_id'    	    => $id,
                            'from_date'    	    => $this->input->post('from_date'),
                            'to_date'    	    => $this->input->post('to_date'),
                		)
                    );
			}
			
			$msg['vendor_id']				=	$this->session->userdata('vendor_id');
			$msg['from_date']	            =	$this->session->userdata('from_date');
			$msg['to_date']	                =	$this->session->userdata('to_date');
			$msg['vendor_balance_sheet']    =	$this->mpurchase->vendor_balance_sheet($msg['from_date'],$msg['to_date'],$msg['vendor_id']);
			$msg['dateWiseOpeningBalance']	=	$this->mpurchase->dateWisevendorOpeningBalance($msg['from_date'],$msg['vendor_id']);
			$msg['opening_balance']         =	$this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'opening_balance_actual');
			$msg['con_created_on']          = 	$this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'con_created_on');
			$msg['drop_menu_vendor']        =   $this->mdropdown->drop_menu_vendor();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/vendor_balance_sheet',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}

	}

	public function customer_balance_sheet_print($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
			$msg['vendor_id']		                =	$this->session->userdata('vendor_id');
			$msg['from_date']	                    =	$this->session->userdata('from_date');
			$msg['to_date']	                        =	$this->session->userdata('to_date');
			$msg['customer_balance_sheet']          =   $this->mpurchase->customer_balance_sheet($msg['from_date'],$msg['to_date'],$msg['vendor_id']);
			$msg['dateWiseOpeningBalance']			=	$this->mpurchase->dateWisecustomerOpeningBalance($msg['from_date']	,$msg['vendor_id']);
			$msg['opening_balance']                 =   $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'opening_balance_actual');
			$msg['con_created_on']                 =    $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'con_created_on');
 	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/customer_balencesheet_print_sheet',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/customer_balencesheet_print',$msg,TRUE);
	   		}
			
		}
	}
	public function vendor_balance_sheet_print($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  		
    		$msg['vendor_id']		        =	$this->session->userdata('vendor_id');
    		$msg['from_date']	            =	$this->session->userdata('from_date');
			$msg['to_date']	                =	$this->session->userdata('to_date');
			$msg['vendor_balance_sheet']    =	$this->mpurchase->vendor_balance_sheet($msg['from_date'],$msg['to_date'],$msg['vendor_id']);
			$msg['dateWiseOpeningBalance']	=	$this->mpurchase->dateWisevendorOpeningBalance($msg['from_date'],$msg['vendor_id']);
    		$msg['opening_balance']         =   $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'opening_balance_actual');
			$msg['con_created_on']          =   $this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$msg['vendor_id']),'con_created_on');

	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/vendor_balencesheet_print_sheet',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/vendor_balencesheet_print',$msg,TRUE);
	   		}
			
		}
	}
	public function outstanding_payable_export($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  		
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');

    		
    			$msg['menu_terms']          = $this->mpurchase->menu_terms_report($id);



	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_outstanding_payable_form',$msg,TRUE);
	   		}
	   		else
	   		{
				echo $this->load->view('report/export_Outstanding_Payable_excel',$msg,TRUE);
	   		}
			
		}
	}
	public function outstanding_receivable_export($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  		
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');

    		$msg['menu_terms']          = $this->mpurchase->menu_terms_sales_report($id);



	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_outstanding_receivable_form',$msg,TRUE);
	   		}
	   		else
	   		{
				echo $this->load->view('report/export_Outstanding_receivable_excel',$msg,TRUE);
	   		}
			
		}
	}
}
	