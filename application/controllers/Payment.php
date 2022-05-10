<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','language'));
		$this->lang->load('auth'); 
		$this->load->library('email'); 
		$this->load->model('Purchaseorder','mpurchase',TRUE);
		$this->load->model('common_model','mcommon',TRUE);
		$this->load->model('Mdropdown','mdropdown',TRUE);
	}

	public function text()
	{
		echo $this->mcommon->getInvoiceNo();
	}

	public function index( $msg = array() )
	{
		if($this->require_min_level(1))
        {
        	$msg['form_url']='Proforma_invoice/add';
        	$msg['drop_menu_payment_mode']=$this->mdropdown->drop_menu_payment_mode();
			$msg['drop_menu_bank']=$this->mdropdown->drop_menu_bank();
			$msg['drop_menu_tax1']=$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_vendor']=$this->mdropdown->drop_menu_vendor();
			  	$msg['drop_menu_client']	=	$this->mdropdown->drop_menu_client();
			$auth_model = $this->authentication->auth_model; 
 			$sessionArr=$this->session->all_userdata();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('payment/viewform',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}

	public function menu_terms()
	{
		$id = $this->input->get('vendor_id');
		
		$msg['drop_menu_payment_mode']=$this->mdropdown->drop_menu_payment_mode();
		$msg['drop_menu_bank']=$this->mdropdown->drop_menu_bank();
		$msg['drop_menu_tax1']=$this->mdropdown->drop_menu_tax1();

		$msg['company_ids'] = $id;

		$msg['opening_balance'] = $this->mcommon->specific_row_value('tbl_vendor',array('id' =>$id),'opening_balance');


		$msg['menu_terms'] = $this->mpurchase->menu_terms($id);
	
		echo $this->load->view('payment/vendorpaymentdetail', $msg,TRUE);
	}

	public function add_payment()
	{	
		if(isset($_POST['addpayment']))
		{	
			$credit 			=	$this->mcommon->specific_row_value('tbl_contacts', array('con_id' =>$this->input->post('vendor_id')), 'credit_amount');

			$poIdArr      	 =	array();
			$poPaymentArr	 =	array();
			$customer_remark =  array();
		

			$paid_amt	 	=	$this->input->post('amt');
			$po_id	 		=	$this->input->post('po_id');
			$po_no	 		=	$this->input->post('po_no');
			$po_balanceArr	=	$this->input->post('po_balance');

			$totalcredit 	=	$credit + $paid_amt;

			$opening_balance	=	$this->input->post('opening_balance');


			if($opening_balance > 0)
			{
				if($totalcredit <= $opening_balance)
				{
					
					$customer_remark[]= array('0' =>"Opening balance");
					$balanceopenningamount=$opening_balance-$totalcredit;//2000-1500=>1500
					$balanceactualamount=$opening_balance-$totalcredit;

				}
				else
				{
					$balanceactualamount=$totalcredit-$opening_balance;//3500-2000=>1500

					foreach($po_id as $key => $po_Id)
					{
						$balanceAmt =	$po_balanceArr[$key];

						if($balanceAmt > $balanceactualamount)
						{
							$poIdArr[]         =	$po_Id;
							$customer_remark[] =	$po_no;
							$poPaymentArr[]	=	$balanceactualamount;

							$result2		=	$this->mcommon->dataUpdate('purchase_order', 'paid_amt', $balanceactualamount, array('po_id' =>$po_Id));
							$balanceactualamount	=	0;

							break;
						}
						else
						{
							$poIdArr[]         =	$po_Id;
							$customer_remark[] =	$po_no;
							$poPaymentArr[]	   =	$balanceAmt;

							$result2		   =	$this->mcommon->dataUpdate('purchase_order', 'paid_amt', $balanceAmt, array('po_id' =>$po_Id));
							$result2		   =	$this->mcommon->common_edit1('purchase_order', array('payment_status' => '1'), array('po_id' =>$po_Id));
							$balanceactualamount	=	$balanceactualamount - $balanceAmt;
						}
					}
				}
			}
			else
			{
				 $balanceactualamount = $totalcredit;

				foreach($po_id as $key => $po_Id)
				{
					$balanceAmt =	$po_balanceArr[$key];

					if($balanceAmt > $balanceactualamount)
					{
						$poIdArr[]         =	$po_Id;
						$customer_remark[] =	$po_no;
						$poPaymentArr[]	   =	$balanceactualamount;

						$result2		   =	$this->mcommon->dataUpdate('purchase_order', 'paid_amt', $balanceactualamount, array('po_id' =>$po_Id));
						$balanceactualamount	=	0;

						break;
					}
					else
					{
						$poIdArr[]         =	$po_Id;
						$customer_remark[] =	$po_no;
						$poPaymentArr[]	   =	$balanceAmt;

						$result2		=	$this->mcommon->dataUpdate('purchase_order', 'paid_amt', $balanceAmt, array('po_id' =>$po_Id));
						$result2		=	$this->mcommon->common_edit1('purchase_order', array('payment_status' => '1'), array('po_id' =>$po_Id));
						$balanceactualamount	=	$balanceactualamount - $balanceAmt;
					}
				}
			}

			if($opening_balance > 0)
			{

				$res=$this->mcommon->common_edit1('tbl_contacts',array('opening_balance' => $balanceopenningamount),array('con_id' =>$this->input->post('vendor_id')));
			}
	
			foreach($customer_remark as $key => $value)
			{
	
		
				$value_array=array(
						
						'vendor_id'			=>	$this->input->post('vendor_id'),
						'mode'				=>	$this->input->post('payment_mode_id'),
						'date'		        =>	date('Y-m-d',strtotime($this->input->post('date'))),
						'transaction_no'	=>	$this->input->post('voucher_number'),
						'transaction_date'	=>	($this->input->post('neft_date')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date'))) : date('Y-m-d'),
						'paid_amt'			=>	$this->input->post('amt'),					
						'bank_name'			=>	$this->input->post('bank_id'),
						'po_id' 			=>  implode(", ",$poIdArr),
						'vendor_remark' 	=>  implode(",",$customer_remark[$key]),
						'created_on'  			=>  date('Y-m-d H:i:s')
					);	

				$vendor_payment_id 			=	$this->mcommon->common_insert('vendor_payment',$value_array);
			}

			foreach($poIdArr as $key => $value)
			{				
				$value_array2=array(
					'po_id'				=>	$poIdArr[$key],
					'vendor_id'			=>	$this->input->post('vendor_id'),
					'date'				=>	$this->input->post('date'),
					'date'		        =>	date('Y-m-d',strtotime($this->input->post('date'))),
					'mode'				=>	$this->input->post('payment_mode_id'),
					'transaction_no'	=>	$this->input->post('voucher_number'),
					'transaction_date'	=>	($this->input->post('neft_date')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date'))) : date('Y-m-d'),
					'paid_amt'			=>	$poPaymentArr[$key],					
					'bank_name'			=>	$this->input->post('bank_id'),
					'payment_id'		=>	$vendor_payment_id,
				);

				$po_payment 			=	$this->mcommon->common_insert('po_payment',$value_array2);
			}
			
			if($po_payment)
			{
				$res=$this->mcommon->common_edit1('tbl_contacts', array('credit_amount' => $balanceactualamount), array('con_id' =>$this->input->post('vendor_id')));
			}

			$this->session->set_userdata('successMsg', 'Added Successfully...');
			redirect(base_url('Payment/index'), 'refresh');
		}			
	}
}