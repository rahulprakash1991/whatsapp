<?php defined('BASEPATH') OR exit('No direct script access allowed');

class So_payment extends MY_Controller {

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
        
        	$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
			$msg['drop_menu_bank']=$this->mdropdown->drop_menu_bank();
			$msg['drop_menu_tax1']=$this->mdropdown->drop_menu_tax1();
			$msg['drop_menu_customer']=$this->mdropdown->drop_menu_customer();
			$msg['drop_menu_client']	=	$this->mdropdown->drop_menu_client();

			$auth_model = $this->authentication->auth_model; 
 			$sessionArr=$this->session->all_userdata();
 			$data=array(
				'sidebar'	=> '',
				'sb_type'	=> '0',
				'title'     => 'Invoice Management',
				'content'   =>$this->load->view('payment/salesorderviewform',$msg,TRUE)
			);

			$array_sess_items = array('successMsg'=>'');
			$this->session->set_userdata($array_sess_items);
			$this->load->view('templates/main_template', $data);	
		}
	}
	
	public function menu_terms()
	{
		$id = $this->input->get('sal_company_name');

		$msg['drop_menu_payment_mode']	=	$this->mdropdown->drop_menu_payment_mode();
		$msg['drop_menu_bank']=$this->mdropdown->drop_menu_bank();
		$msg['drop_menu_tax1']=$this->mdropdown->drop_menu_tax1();

		$msg['company_ids'] = $id;

		$msg['opening_balance'] = $this->mcommon->specific_row_value('tbl_client',array('id' =>$id),'opening_balance');

		$msg['menu_terms_sales'] = $this->mpurchase->menu_terms_sales($id);
	
		echo $this->load->view('payment/salesorderpaymentdetail', $msg,TRUE);
	}

	public function add_payment()
	{	

		if(isset($_POST['addpayment']))
		{

				$credit       =	$this->mcommon->specific_row_value('tbl_contacts',array('con_id' =>$this->input->post('sal_company_name')),'credit_amount');
				$salIdArr      	=	array();
				$salPaymentArr	=	array();
				$customer_remark =  array();
				$sal_order	 	=	$this->input->post('sal_order');
				$paid_amt	 	=	$this->input->post('amt');
				$sal_id	 		=	$this->input->post('sal_id');
				$sal_balanceArr	=	$this->input->post('sal_balance');

				$opening_balance	=	$this->input->post('opening_balance');

				$totalcredit 	=	$credit + $paid_amt;//3500

	

				if($opening_balance > 0)
				{

					if($totalcredit <= $opening_balance)
					{
						$customer_remark[]= array('0' =>"Opening Balance");
						$balanceopenningamount=$opening_balance-$totalcredit;//2000-1500=>1500
						$balanceactualamount=$opening_balance-$totalcredit;
					}
					else
					{
						$balanceactualamount=$totalcredit-$opening_balance;//3500-2000=>1500

					
						foreach($sal_id as  $key => $sal_Id)
						{
							$balanceAmt =	$sal_balanceArr[$key];//938


							if($balanceAmt>$balanceactualamount) //1938 > 1500
							{
								$salIdArr[]         =	$sal_Id;
								$customer_remark[] =	$sal_order;
								$salPaymentArr[]	=	$balanceactualamount;
								

								$result2		=	$this->mcommon->dataUpdate('sales_order', 'paid_amount', $balanceactualamount, array('sal_id' =>$sal_Id));

								$balanceactualamount 	=	0;
								break;
								
							}
							else
							{
								$salIdArr[]      	=	$sal_Id;
								$customer_remark[] =	$sal_order;
								$salPaymentArr[]	=	$balanceAmt;

								$result2		=	$this->mcommon->dataUpdate('sales_order', 'paid_amount', $balanceAmt, array('sal_id' =>$sal_Id));


								$result2		=	$this->mcommon->common_edit1('sales_order', array('payment_status' => '1'), array('sal_id' =>$sal_Id));

								$balanceactualamount	=	$balanceactualamount - $balanceAmt;//1500-938=>562
					
							}
						}

					}
				}
				else
				{
					$balanceactualamount = $totalcredit;

					foreach($sal_id as  $key => $sal_Id)
					{
						$balanceAmt =	$sal_balanceArr[$key];
			
						if($balanceAmt>$balanceactualamount)
						{
							$salIdArr[]         =	$sal_Id;
							$customer_remark[] =	$sal_order;
							$salPaymentArr[]	=	$balanceactualamount;

							$result2		=	$this->mcommon->dataUpdate('sales_order', 'paid_amount', $balanceactualamount, array('sal_id' =>$sal_Id));


							$balanceactualamount 	=	0;
							break;
							
						}
						else
						{
							$salIdArr[]      =	$sal_Id;
							$customer_remark[] =	$sal_order;
							$salPaymentArr[]	=	$balanceAmt;
							$result2		=	$this->mcommon->dataUpdate('sales_order', 'paid_amount', $balanceAmt, array('sal_id' =>$sal_Id));
							$result2		=	$this->mcommon->common_edit1('sales_order', array('payment_status' => '1'), array('sal_id' =>$sal_Id));
							$balanceactualamount	=	$balanceactualamount - $balanceAmt;
						}
					}
				}

			
				if($opening_balance > 0)
				{
					
					$res=$this->mcommon->common_edit1('tbl_contacts',array('opening_balance' => $balanceopenningamount),array('con_id' =>$this->input->post('sal_company_name')));
				}
					foreach($customer_remark as $key => $value)
					{
							$value_array=array(
							'sal_id'			=>	implode(", ",$salIdArr),
							'customer_id'		=>	$this->input->post('sal_company_name'),
							'collection_date'	=>	($this->input->post('coll_date')!='') ? date('Y-m-d', strtotime($this->input->post('coll_date'))) : date('Y-m-d'),
							
							'mode'				=>	$this->input->post('payment_mode_id'),
							'transaction_no'	=>	$this->input->post('voucher_number'),
							'transaction_date'	=>	($this->input->post('neft_date')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date'))) : date('Y-m-d'),
							'paid_amt'			=>	$this->input->post('amt'),	
							'transaction_bank_name'	=>  $this->input->post('bank_name'),				
							'bank_name'			=>	$this->input->post('bank_id'),
							'customer_remark' 	=>  implode(",",$customer_remark[$key]),
							'created_on'  			=>  date('Y-m-d H:i:s')
							);

							$customet_payment       = $this->mcommon->common_insert('customet_payment', $value_array);
					}
					foreach($salIdArr as $key => $value)
					{

						$salpayment=array(
							'invoice_id'			=>	$salIdArr[$key],
							'amount'				=>	$salPaymentArr[$key],
							'date'					=>	($this->input->post('collection_date')!='') ? date('Y-m-d', strtotime($this->input->post('collection_date'))) : date('Y-m-d'),
							'transaction_date'		=>	($this->input->post('neft_date')!='') ? date('Y-m-d', strtotime($this->input->post('neft_date'))) : date('Y-m-d'),
							'payment_mode'			=>	$this->input->post('payment_mode_id'),
							'transaction_number'	=>	$this->input->post('voucher_number'),
							'transaction_bank_name'	=>  $this->input->post('bank_name'),
							'account_heads'			=>	$this->input->post('bank_id'),
						
							'payment_id'			=>	$customet_payment,
							'created_by'  			=>  date('Y-m-d H:i:s')
					 	);
						$sal_payment  = $this->mcommon->common_insert('sal_payment',$salpayment);
					}

			if($sal_payment)
			{
				$res=$this->mcommon->common_edit1('tbl_contacts',array('credit_amount' => $balanceactualamount),array('con_id' =>$this->input->post('sal_company_name')));
			}
			
			$this->session->set_userdata('successMsg', 'Added Successfully...');
			redirect(base_url('So_payment/index'), 'refresh');

		}			
	}
}

/*
foreach($msg['menu_terms'] as $key =>$r	)				
{
	$po_no[$key] 						=	$row->po_no;
	$total_cost_price[$key] 			=	$row->total_cost_price;
	$paid_amt[$key] 					=	$row->paid_amt;
	$total=$paid_amt[$key]+$credit_amount+$total_cost_price[$key];
	
	$result1=$total-$this->input->post('amt');
	if($result1<0)
	{
		$creditAmount=abs($result1);
	}
	else
	{
		$creditAmount=abs($result1);
	}
}

if($result2)
{
	$this->session->set_userdata('successMsg', 'Added Successfully...');
	redirect(base_url('Payment/index'), 'refresh');
}
*/