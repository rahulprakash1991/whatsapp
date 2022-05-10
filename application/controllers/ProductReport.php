<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductReport extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->library('email'); 
		$this->load->model('Prefs','pre',TRUE);
		$this->load->model('Purchaseorder','mpurchase',TRUE);
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->model('Mdropdown','Mdropdown',TRUE);
	}

	public function text()
	{
		echo $this->mcommon->getInvoiceNo();
	}

	public function export_excel_product($type)
	{  
		$msg['form_toptittle']='Product stock ';
		if($this->require_min_level(1))
        {
  		
			$msg['category_id']		=	$this->session->userdata('category_id');
			$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
			$msg['vendor_id']	    =	$this->session->userdata('vendor_id');   
			     	
        	$msg['values']			= 	$this->mpurchase->product_report($msg);
	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_product_stock',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/exportexce',$msg,TRUE);
	   		}
			
		}
	}
	public function export_excel_reorder($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  			$msg['category_id']		=	$this->session->userdata('category_id');
			$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
		  	$msg['values']			= 	$this->mpurchase->reorderitem($msg);
	   		

	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_reorder_stock',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_to_excel_reorder',$msg,TRUE);
	   		}
			
		}
	}
	public function export_excel_stack_customer_report($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['category_id']		=	$this->session->userdata('category_id');
    		$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
    		$msg['pro_item_id']		=	$this->session->userdata('pro_item_id');
    		$msg['searchFilter']	=	$this->session->userdata('searchFilter');
			$msg['productreport']	=	$this->mpurchase->stacksalproductreport($msg);
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_stack_customer_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_excel_stack_customer_report',$msg,TRUE);
	   		}
			
		}
	}
	public function export_excel_stack_vendor_report($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['category_id']		=	$this->session->userdata('category_id');
    		$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
    		$msg['pro_item_id']		=	$this->session->userdata('pro_item_id');
    		$msg['searchFilter']	=	$this->session->userdata('searchFilter');
			// $msg['productreport']	=	$this->mpurchase->stackproductreport($msg);
				$msg['productreport']	=	$this->mpurchase->productreport($msg);
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/print_stack_vendor_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_excel_stack_vendor_report',$msg,TRUE);
	   		}
			
		}
	}
	public function export_excel_customer_report($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['category_id']		=	$this->session->userdata('category_id');
    		$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
    		$msg['pro_item_id']		=	$this->session->userdata('pro_item_id');
    		$msg['searchFilter']	=	$this->session->userdata('searchFilter');
			$msg['productreport']	=	$this->mpurchase->salproductreport($msg);
	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/export_print_sal_customer_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_Sales_Wise_customer_report',$msg,TRUE);
	   		}
			
		}
	}
	public function export_excel_vendor_report($type)
	{  
		$msg['form_toptittle']='Reorder item';
		
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['category_id']		=	$this->session->userdata('category_id');
    		$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
    		$msg['pro_item_id']		=	$this->session->userdata('pro_item_id');
    		$msg['searchFilter']	=	$this->session->userdata('searchFilter');
			
			$msg['productreport']	=	$this->mpurchase->productreport($msg);
	   		
	   		if($type == 'print')
	   		{
	   			echo $this->load->view('report/export_print_po_vendor_report',$msg,TRUE);
	   		}else
	   		{
				echo $this->load->view('report/export_Purchase_Wise_vendor_report',$msg,TRUE);
	   		}
			
		}
	}
	public function export_excel_payables($type)
	{  
		$msg['form_toptittle']='Reorder item';
		if($this->require_min_level(1))
        {
  			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
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
	public function vendor_report()
	{  
		$msg['form_toptittle']='Purchase Wise ';
		if($this->require_min_level(1))
        {
        
        	if($this->input->post('searchFilter')==1)
        	{

				$this->session->set_userdata(
											array(
						                           	'from_date'	 		=> $this->input->post('from_date'),
						                            'to_date' 			=> $this->input->post('to_date'),
						                            'vendor_id'    	    => $this->input->post('vendor_id'),
						                            'category_id'       => $this->input->post('category_id'),
						                            'pro_group_id'      => $this->input->post('pro_group_id'),
						                            'pro_item_id'       => $this->input->post('pro_item_id'),
						                            'searchFilter'      => $this->input->post('searchFilter'),
						                           
					                    		)
						                    );
	    		$msg['searchFilter']	=	$this->input->post('searchFilter');

        	}
    		$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['category_id']		=	$this->session->userdata('category_id');
    		$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
    		$msg['pro_item_id']		=	$this->session->userdata('pro_item_id');
    		
    		
    		$msg['productreport']	=	$this->mpurchase->productreport($msg);

			$msg['drop_menu_productitem']	=	$this->Mdropdown->drop_menu_productitem();
			$msg['drop_menu_product']	    =	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']		=	$this->Mdropdown->drop_menu_category();
			$msg['drop_menu_vendor']   	    =   $this->Mdropdown->drop_menu_vendor();
			$data=array(
							'sidebar'	=> '',
							'sb_type'	=> '0',
							'title'     => 'Invoice Management',
							'content'   =>$this->load->view('report/vendor_product_report_form',$msg,TRUE)
						);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function customer_report()
	{  
		$msg['form_toptittle']='Sales Wise';

		if($this->require_min_level(1))
        {
        	
        	if($this->input->post('searchFilter')==1)
        	{
				$this->session->set_userdata(
											array(
						                           	
						                            'vendor_id'    	    => $this->input->post('vendor_id'),
						                           
						                            'searchFilter'      => $this->input->post('searchFilter'),
						                           
					                    		)
						                    );
					$msg['searchFilter']			=	$this->input->post('searchFilter');
				}

				$msg['from_date']				=	$this->session->userdata('from_date');
	    		$msg['to_date']					=	$this->session->userdata('to_date');
	    		$msg['vendor_id']				=	$this->session->userdata('vendor_id');
	    		$msg['category_id']				=	$this->session->userdata('category_id');
	    		$msg['pro_group_id']			=	$this->session->userdata('pro_group_id');
	    		$msg['pro_item_id']				=	$this->session->userdata('pro_item_id');
	    	

	    		$msg['productreport']			=	$this->mpurchase->salproductreport($msg);
	    		
	    		$msg['drop_menu_productitem']	=	$this->Mdropdown->drop_menu_productitem();
				$msg['drop_menu_product']		=	$this->Mdropdown->drop_menu_product();
	        	$msg['drop_menu_category']		=	$this->Mdropdown->drop_menu_category();
				$msg['drop_menu_vendor']   		=   $this->Mdropdown->drop_menu_client();

		
			
	 			$data	=	array(
									'sidebar'	=> '',
									'sb_type'	=> '0',
									'title'     => 'Invoice Management',
									'content'   =>$this->load->view('report/customer_product_report_form',$msg,TRUE)
								);

				$this->load->view('templates/main_template', $data);	
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
						                         
						                            
						                           
					                    		)
						                    );
        		
        	}
			
    		$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		
			$msg['values']			= 	$this->mpurchase->payable($msg);
	
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
	public function receivables()
	{  
		$msg['form_toptittle']='Purchase Report';
		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
        		$post['from_date']	=	($this->input->post('from_date') == '') ? date('Y-m-d') : $this->input->post('from_date');
        		$post['to_date']	=	($this->input->post('to_date') == '') 	? date('Y-m-d') : $this->input->post('to_date');
        		$post['vendor_id']	=	$this->input->post('vendor_id');

        		$this->session->set_userdata($post);
        	}
			
    		$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');

			$msg['values']				= 	$this->mpurchase->receivable($msg);

			
			$msg['drop_menu_vendor']=$this->mdropdown->drop_menu_customer();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/receivableform',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function loadaddress()
	{
		$category_id 		= $this->input->get('category_id');
		$pro_item_id 		= $this->input->get('pro_item_id');

		$drop_menu_productitem 	= $this->mpurchase->drop_menu_productreport($category_id,$pro_item_id);

		echo form_dropdown('pro_item_id', $drop_menu_productitem, set_value('pro_item_id', (isset($pro_item_id)) ? $pro_item_id : ''), $attrib);
	}
	public function rendor_item()
	{  
		$msg['form_toptittle']='Reorder item ';
		if($this->require_min_level(1))
        {
        	
        		if(isset($_POST['searchFilter']))
        	{
				$this->session->set_userdata(
												array(
							                            'category_id'	=> $this->input->post('category_id'),
							                            'pro_group_id' 	=> $this->input->post('pro_group_id'),
							                           
						                    		)
						                    );	    
        	}
	    		$msg['category_id']		=	$this->input->post('category_id');
	    		$msg['pro_group_id']	=	$this->input->post('pro_group_id');
	    		$msg['searchFilter']	=	$this->input->post('searchFilter');
	    		$msg['values']			= 	$this->mpurchase->reorderitem($msg);
	    
        	
			$msg['drop_menu_product']	=	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();
			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/reorder_item_form',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function product_report()
	{  
		$msg['form_toptittle']	=	'Product stock ';

		if($this->require_min_level(1))
        {
        	if(isset($_POST['searchFilter']))
        	{
				$this->session->set_userdata(
												array(
							                            'category_id'	=> $this->input->post('category_id'),
							                            'pro_group_id' 	=> $this->input->post('pro_group_id'),
							                            'vendor_id'     => $this->input->post('vendor_id'),
						                    		)
						                    );	    
        	}
	    		
			$msg['category_id']		=	$this->session->userdata('category_id');
			$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
			$msg['vendor_id']	    =	$this->session->userdata('vendor_id');

	    	$msg['values']				= 	$this->mpurchase->product_report($msg);

        	$msg['drop_menu_vendor']   	=   $this->Mdropdown->drop_menu_vendor();
			$msg['drop_menu_product']	=	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();

			$data=array(
						'sidebar'	=> '',
						'sb_type'	=> '0',
						'title'     => 'Invoice Management',
						'content'   =>$this->load->view('report/productreport',$msg,TRUE)
					);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function stack_vendor_report()
	{  
		$msg['form_toptittle']='Cumulative-Purchase Wise ';
		if($this->require_min_level(1))
        {

        	if($this->input->post('searchFilter')==1)
        	{
					$this->session->set_userdata(
												array(
							                            'from_date'	 		=> $this->input->post('from_date'),
							                            'to_date' 			=> $this->input->post('to_date'),
							                            'vendor_id'    	    => $this->input->post('vendor_id'),
							                            'category_id'       => $this->input->post('category_id'),
							                            'pro_group_id'      => $this->input->post('pro_group_id'),
							                            'pro_item_id'       => $this->input->post('pro_item_id'),
							                            'searchFilter'      => $this->input->post('searchFilter'),
						                    		)
						                    );
					$msg['searchFilter']	=	$this->input->post('searchFilter');

        	}
		
			$msg['from_date']		=	$this->session->userdata('from_date');
    		$msg['to_date']			=	$this->session->userdata('to_date');
    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
    		$msg['category_id']		=	$this->session->userdata('category_id');
    		$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
    		$msg['pro_item_id']		=	$this->session->userdata('pro_item_id');
    		
			
			// $msg['productreport']	=	$this->mpurchase->stackproductreport($msg);
			$msg['productreport']	=	$this->mpurchase->productreport($msg);

			$msg['drop_menu_productitem']	=	$this->Mdropdown->drop_menu_productitem();
			$msg['drop_menu_product']	=	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();
			$msg['drop_menu_vendor']    =   $this->Mdropdown->drop_menu_vendor();

		
			
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/stack_vendor_product_report_form',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function stack_customer_report()
	{  
		$msg['form_toptittle']='Cumulative-Sales Wise ';
		if($this->require_min_level(1))
        {
        	
        	if($this->input->post('searchFilter')==1)
        	{
        		$this->session->set_userdata(
												array(
							                            'from_date'	 		=> $this->input->post('from_date'),
							                            'to_date' 			=> $this->input->post('to_date'),
							                            'vendor_id'    	    => $this->input->post('vendor_id'),
							                            'category_id'       => $this->input->post('category_id'),
							                            'pro_group_id'      => $this->input->post('pro_group_id'),
							                            'pro_item_id'       => $this->input->post('pro_item_id'),
							                            'searchFilter'      => $this->input->post('searchFilter'),
						                    		)
						                    );
        		$msg['searchFilter']	=	$this->input->post('searchFilter');
			}				
				$msg['from_date']		=	$this->session->userdata('from_date');
	    		$msg['to_date']			=	$this->session->userdata('to_date');
	    		$msg['vendor_id']		=	$this->session->userdata('vendor_id');
	    		$msg['category_id']		=	$this->session->userdata('category_id');
	    		$msg['pro_group_id']	=	$this->session->userdata('pro_group_id');
	    		$msg['pro_item_id']		=	$this->session->userdata('pro_item_id');
	    		
	    		$msg['productreport']	=	$this->mpurchase->stacksalproductreport($msg);
        		

			$msg['drop_menu_productitem']	=	$this->Mdropdown->drop_menu_productitem();
			$msg['drop_menu_product']	=	$this->Mdropdown->drop_menu_product();
        	$msg['drop_menu_category']	=	$this->Mdropdown->drop_menu_category();
			$msg['drop_menu_vendor']    =   $this->Mdropdown->drop_menu_client();

		
			
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/stack_customer_product_report_form',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}
	}
	public function customer_balance_sheet()
	{ 
		$msg['form_toptittle']='Payable Report';
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
			
			$msg['customer_balance_sheet']          = $this->mpurchase->customer_balance_sheet($id);
	
    		$msg['vendor_id']		    =	$this->session->userdata('vendor_id');
			
			$msg['drop_menu_vendor']    =   $this->Mdropdown->drop_menu_vendor();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('report/customer_balance_sheet',$msg,TRUE)
			);
			$this->load->view('templates/main_template', $data);	
		}

	}
}
	