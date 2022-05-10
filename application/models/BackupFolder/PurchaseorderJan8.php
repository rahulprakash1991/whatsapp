<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchaseorder extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function getPurchaseOrderData($id = '')
	{
		$this->db->select('p.po_id, p.po_no, p.order_date, p.vendor, p.ref_no, p.order_date, p.ship_pref_id, p.cost_price, p.selling_price, p.total_cost_price, p.total_selling_price, p.terms, p.notes, p.rec_status,p.payment_status,p.del_addr, p.po_status, p.po_created_by, p.po_created_on, c.con_company_name, c.contact_address, c.contact_city, c.con_email, c.con_phone, c.con_id, c.con_first_name, sp.ship_pre_type')
		->from('purchase_order AS p')	
		->join('tbl_contacts c','c.con_id = p.vendor', 'left')
		->join('shipment_preferences sp','sp.ship_pref_id = p.ship_pref_id', 'left')
		->where('p.po_id',$id);
		$this->db->where('p.po_status','1');
		return $query=$this->db->get();
	}
	function getPurchaseOrderData1($id = '')
	{
		$this->db->select('p.po_id, p.po_no, p.order_date, p.vendor, p.ref_no, p.order_date, p.ship_pref_id, p.cost_price, p.selling_price, p.total_cost_price, p.total_selling_price, p.terms, p.notes, p.rec_status,p.payment_status,p.del_addr, p.po_status, p.po_created_by, p.po_created_on, v.vendor_name, v.	address, v.vendor_mobile, v.vendor_email, v.vendor_website, v.id')
		->from('purchase_order AS p')	
		->join('tbl_vendor v','v.id = p.vendor', 'left')
		
		->where('p.po_id',$id);
		$this->db->where('p.po_status','1');
		return $query=$this->db->get();
	}
	
	
	function get_data($id = '')
	{
		$this->db->select('s.pro_item_id, s.pro_item_name, s.pro_item_cost_price, s.tax_id, t.tax_id, t.tax_name, t.tax_percent, s.unit_id, s.pieces_per_unit, s.pro_item_sell_price')
		->from('tbl_pro_item AS s')
		->where('pro_item_id',	$id)
		->join('tbl_tax t', 't.tax_id = s.tax_id', 'left');
		$query	=	$this->db->get();
		$result = 	$query->row_array();
		return $result;
	}
	
	function get_data1($id = '')
	{
		$data = array();
		$this->db->select('s.pro_item_id, s.pro_item_name, s.pro_item_sell_price, s.tax_id, t.tax_id, t.tax_name, t.tax_percent')
		->from('tbl_pro_item AS s')
		->where('pro_item_id',$id)
		->join('tbl_tax t','t.tax_id = s.tax_id');
		$this->db->where('s.prduct_delete_status','1');
		$query	=	$this->db->get();
		$result = 	$query->result();

		return $result;
	}
	
	function get_name($id = '')
	{
		$data = array();
		$this->db->select('t.con_primary')
		->from('purchase_order AS s')
		->where('po_id',$id)
		->join('tbl_contacts t','t.con_id = s.vendor');
		$this->db->where('s.po_status','1');
		$query	=	$this->db->get();
		$result = 	$query->result();
		return $result;
	}

	function get_tax1($id = '')
	{ 
		$data = array();
		$this->db->select('t.po_id AS pro_item_id,s.tax_name,t.selling_tax,t.cost_tax')
			->from('purchase_order_tax AS t')
			->join('tbl_tax s', 's.tax_id = t.po_tax_id')
			->where('t.po_id',$id);
		
		$query=$this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function get_tax1_receive($id = '')
	{ 
		$data = array();
		$this->db->select('t.rec_po_id AS pro_item_id,s.tax_name,t.selling_tax,t.cost_tax')
			->from('receive_po_tax AS t')
			->join('tbl_tax s', 's.tax_id = t.re_tax_id')
			->where('t.rec_po_id',$id);
		
		$query=$this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function expense($id = '')
	{ 
		$data = array();
		$this->db->select('pd.rec_po_id,pd.re_expense_amount,p.expenses')
			->from('receive_po_expense AS pd')
			->join('other_expenses p', 'p.expenses_id = pd.re_expense_id')
			->where('pd.rec_po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

	function menu_terms($id = '')
	{
		$this->db->select('p.po_id,p.po_no,p.po_no, p.order_date, p.ref_no, p.paid_amt, p.total_cost_price, p.payment_status')
		->from('purchase_order As p')
		// ->join('tbl_contacts h', 'h.con_id = p.vendor')
		->where('p.vendor',$id)
		->where('p.rec_status','2')
		->where('p.payment_status','0');
		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
	function menu_terms_report($id = '')
	{
		$this->db->select('h.vendor_name,h.id as vendor, (COALESCE(SUM(p.total_cost_price - p.paid_amt),0) + h.opening_balance) AS outstanding');
		$this->db->from(' tbl_vendor As h');
		$this->db->join('purchase_order As p', 'h.id = p.vendor AND p.rec_status > 0','left');
		if(!empty($id))
		{
		$this->db->where('h.id',$id);
		}
	
		$this->db->where('h.vendor_delete_status','1');
		// $this->db->having('outstanding > ','0'); 
		$this->db->group_by('h.id');
		$query=$this->db->get();
		$result = $query->result_array();
		return $result;	
	}

	
	function menu_terms_sales($id = '')
	{
		$this->db->select('p.sal_id,p.sal_order,p.sal_order_date,p.sal_reference, p.paid_amount, p.sal_grand_total, p.payment_status')
		->from('sales_order As p')
		
		->where('p.sal_company_name',$id)
		->where('p.sal_invoice_status','1')
		->where('p.payment_status','1');
		
		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
	function menu_terms_sales_report($id = '')
	{
		$this->db->select('h.client_name,(h.id) AS sal_company_name,(COALESCE(SUM(p.sal_grand_total - p.paid_amount),0) + h.opening_balance) AS outstanding');
		$this->db->from('tbl_client as h');
		$this->db->join('sales_order as p', 'h.id = p.sal_company_name AND p.sal_invoice_status=1 ', 'left');
		if(!empty($id))
		{
			$this->db->where('h.id',$id);
		}
		
		// $this->db->where('h.con_type','1');
		$this->db->where('h.client_delete_status','1');
		// $this->db->having('outstanding > ','0'); 
		$this->db->group_by('h.id');
		$query=$this->db->get();
		$result = $query->result_array();
		return $result;	
	}
	function payment($id = '')
	{
		$this->db->select('p.po_no,p.order_date,p.ref_no,p.paid_amt,p.total_cost_price,p.payment_status')
		->from('purchase_order As p')
		->where('p.vendor',$id);
		$this->db->where('p.po_status','1');
		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	function salespayment($id = '')
	{
		$this->db->select('p.sal_id, p.sal_order, p.sal_order_date, p.sal_reference, p.paid_amount, p.sal_grand_total, p.payment_status')
		->from('sales_order As p')
		->where('p.sal_company_name',$id);
		$this->db->where('p.status','1');
		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
		
	function poexpense($id = '')
	{ 
		$data = array();
		$this->db->select('pd.po_id,pd.po_expense_amount,p.expenses')
			->from('purchase_order_expense AS pd')
			->join('other_expenses p', 'p.expenses_id = pd.po_expense_id')
			->where('pd.po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

	function get_data_product($id = '')
	{ 
		$data = array();
		$this->db->select('pd.tax_id,pd.po_id,pd.po_pdt_id,pd.pro_item_id,pd.pieces_per_unit,pd.selling_price,pd.cost_price,pd.unit,pd.quantity,pd.recd_qty,pd.cost_tax_amount,pd.selling_tax_amount,pd.selling_total_amount,pd.cost_total_amount,pd.po_pdt_id')
			->from('purchase_order_product AS pd')
			
			->where('pd.po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function get_data_product1($id = '')
	{ 
		$data = array();
		$this->db->select('pd.po_pdt_id,pd.po_id,pd.item_name,pd.price,pd.sub_total,pd.discount,pd.quantity,pd.recd_qty,pd.total_amount')
			->from('purchase_order_product AS pd')
			
			->where('pd.po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function get_data_productcosting($id = '')
	{ 
		$data = array();
		$this->db->select('pd.co_pro_id,pd.pro_item_id,pd.cost,pd.cost1,pd.cost2,pd.cost3')
			->from('tbl_costing_product AS pd')
			
			->where('pd.co_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

	function poproduct($id = '')
	{ 
		$data = array();
		$this->db->select('pd.po_id	,pd.po_pdt_id,pd.item_name  As pro_item_name,pd.quantity,pd.recd_qty,pd.po_pdt_id,pd.price,pd.total_amount,pd.discount')
			->from('purchase_order_product AS pd')
			
			// ->join('tbl_pro_item t', 't.pro_item_id = pd.pro_item_id')
			
			->where('pd.po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

	function poproduct1($id = '')
	{ 
		$data = array();
		$this->db->select('pd.po_id	,pd.po_pdt_id,pd.item_name,pd.price,pd.sub_total,pd.discount,pd.quantity,pd.recd_qty,pd.total_amount')
			->from('purchase_order_product AS pd')
			
			
			
			->where('pd.po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

	function get_data_receive_product($id = '')
	{ 
		$data = array();
		$this->db->select('pd.rec_po_id,pd.pieces_per_unit,pd.pro_item_id,t.pro_item_name,pd.selling_price,pd.cost_price,pd.unit,pd.quantity,pd.cost_tax_amount,pd.selling_tax_amount,pd.selling_total_amount,pd.cost_total_amount')
			->from('receive_po_products AS pd')
		
			->join('tbl_pro_item t', 't.pro_item_id = pd.pro_item_id')
			
			->where('pd.rec_po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function get_data_receive_product1($id = '')
	{ 
		$data = array();
		$this->db->select('pd.rec_po_id,pd.item_name,pd.price,pd.sub_total,pd.discount,pd.total_amount,pd.quantity,')
			->from('receive_po_products AS pd')
		
		
			
			->where('pd.rec_po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	
	function get_receive_po_details($id = '')
	{
		
		$this->db->select('rp.rec_po_id,rp.po_id,rp.receive_number,rp.receive_date,rp.bill_no,rp.pay_status,SUM(rpo.quantity) AS quantity,rp.total_cost_price,count(rpo.rec_po_pdt_id) as product,rpo.unit,c.con_company_name,c.con_id,p.payment_status,p.adv_amt')
		->from('receive_po AS rp')	
		->join('receive_po_products rpo','rpo.rec_po_id = rp.rec_po_id')
		->join('purchase_order p','p.po_id = rp.po_id')
		->join('tbl_contacts c','c.con_id ')
		->where('rp.po_id',$id)		
		->order_by('rp.receive_date','ASC')
		->order_by('rp.receive_number','ASC')
		->group_by('rp.rec_po_id');

		$query=$this->db->get();
		$result = $query->result();
		return $result;		
	}


	function get_receive_po_detail($id = '')
	{
		$this->db->select('rp.rec_po_id,rp.po_id,rp.receive_number,rp.receive_date,rp.bill_no,rp.pay_status,SUM(rpo.quantity) AS quantity,rp.total_cost_price,COUNT(rpo.rec_po_pdt_id) as product,rpo.unit,c.con_company_name,c.con_id,p.payment_status,p.adv_amt')
		->from('receive_po AS rp')	
		->join('receive_po_products rpo','rpo.rec_po_id = rp.rec_po_id')
		->join('purchase_order p','p.po_id = rp.po_id')
		->join('tbl_contacts c','c.con_id ')
		->where('rp.po_id',$id)		
		->order_by('rp.receive_date','ASC')
		->order_by('rp.receive_number','ASC')
		->group_by('rp.rec_po_id');

		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
	function get_receive_po_details1($id = '')
	{
		$this->db->select('rp.rec_po_id,rp.po_id,rp.receive_number,rp.receive_date,rp.bill_no,rp.pay_status,rpd.rec_po_id,rpd.quantity,rpd.item_name,p.po_no,p.vendor,p.order_date,rpd.total_amount')
			->from('receive_po AS rp')
			->join('receive_po_products rpd','rpd.rec_po_id = rp.rec_po_id')
			->join('purchase_order p','p.po_id = rp.po_id')
			->where('rp.po_id',$id);
			$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	function get_receive_details($id = '')
	{
		$this->db->select('rp.rec_po_id,rp.po_id,rp.receive_number,rp.receive_date,rp.bill_no,rp.pay_status,rpd.rec_po_id,rpd.pro_item_id,rpd.pieces_per_unit,rpd.selling_price,rpd.cost_price,rpd.unit,rpd.quantity,rpd.cost_tax_amount,rpd.selling_tax_amount,rpd.selling_total_amount,rpd.cost_total_amount,p.po_no,p.vendor,p.order_date')
		->from('receive_po AS rp')
		->join('receive_po_products rpd','rpd.rec_po_id = rp.rec_po_id')
		->join('purchase_order p','p.po_id = rp.po_id')
		->where('rp.rec_po_id',$id);
	}
	function get_tax($id = '')
	{ 
		$data = array();
		$this->db->select('t.po_id,s.tax_name,t.selling_tax,t.cost_tax')
			->from('purchase_order_tax AS t')
			->join('tbl_tax s', 's.tax_id = t.po_tax_id')
			->where('t.po_id',$id);
			
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

	function get_receive_product($id = '')
	{ 
		$data = array();
		$this->db->select('pd.po_id	,pd.pro_item_id,pd.unit,pd.quantity,pd.recd_qty,pd.rec_qty,pd.price_amt,pd.pdt_tax_amt,pd.amount,pd.rec_po_pdt_id')
			->from('rec_po_pdt_details AS pd')
			->join('tbl_receive_po s', 's.po_id = pd.po_id')
			->where('pd.po_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	
	function get_po_details($id = '')
	{
		$this->db->select('p.po_no, r.receive_date, c.con_company_name, pp.pro_item_id, pr.pro_item_name, pp.quantity, u.unit_name, pp.pieces_per_unit, pp.selling_price, pp.cost_price, pp.selling_total_amount, pp.cost_total_amount')
		->from('receive_po_products AS pp')
		->join('receive_po r', 'r.rec_po_id = pp.rec_po_id', 'left')
		->join('purchase_order p', 'p.po_id = r.po_id', 'left')
		->join('tbl_pro_item pr', 'pr.pro_item_id = pp.pro_item_id', 'left')
		->join('tbl_contacts c', 'c.con_id = p.vendor', 'left')
		->join('tbl_unit u', 'u.unit_id = pp.unit', 'left')
		->where('pp.pro_item_id', $id)
		->order_by('p.order_date', 'DESC');
		$this->db->limit(10);

		$query=$this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function view_po_details($id = '')
	{
		$this->db->select('pp.pro_item_id,pp.quantity,pp.price_amt,pp.amount,pp.po_id,p.po_id,p.ref_no,p.vendor,p.order_date,p.po_no,p.ref_no,pr.pro_item_name,c.con_company_name,c.con_address,c.con_email,c.con_phone,c.con_id,pp.unit,u.unit_name')
		->from('po_product_details AS pp')	
		->join('tbl_purchase_order p','p.po_id = pp.po_id')
		->join('tbl_pro_item pr','pr.pro_item_id = pp.pro_item_id')
		->join('tbl_contacts c','c.con_id = p.vendor')
		->join('tbl_unit u','u.unit_id = pp.unit')
		->where('pp.po_id',$id);		

		$query=$this->db->get();
		$result = $query->result();
		return $result;
		
	}
	
	function check_po_status($table = '', $po_id = '')
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('po_id', $po_id);
		$this->db->where('quantity > ','recd_qty',FALSE);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
	
	function viewpo($id = '')
	{		
		$this->db->select('p.po_id,p.ref_no,p.vendor,p.order_date,p.ship_pref_id,p.po_no,p.del_date,p.rec_status,p.payment_status,p.adv_amt,c.con_company_name,c.con_address,c.con_email,c.con_phone,c.con_id,c.con_first_name,sp.ship_pre_type')
		->from('purchase_order AS p')	
		->join('tbl_contacts c','c.con_id = p.vendor')
		->join('shipment_preferences sp','sp.ship_pref_id = p.ship_pref_id')
		->where('p.po_id',$id);
		$this->db->where('po_status','1');

		$query=$this->db->get();
		$result = $query->result();
		return $result;
		
	}
	
	function viewrepo($id = '')
	{		
		$this->db->select('p.price_amt,p.pdt_tax_amt,p.amount')
		->from('rec_po_pdt_details AS p')	

		->where('p.po_pdt_id',$id);

		$query=$this->db->get();
		$result = $query->result();
		return $result;
		
	}
	
	function get_receivedpo_details($id = '')
	{
		
		$this->db->select('rpo.rec_po_id,rpo.po_pdt_id,rpo.pieces_per_unit,rpo.selling_price,rpo.pro_item_id,rpo.quantity,rpo.pdt_tax_amt,rpo.price_amt,rp.rec_po_id,rp.vendor_id,rp.receive_date,rp.bill_no,rpo.rec_qty,pr.pro_item_name,c.con_company_name,c.con_id,rpo.unit,rpo.amount,u.unit_name,rp.po_id')
		->from('rec_po_pdt_details AS rpo')	
		->join('tbl_receive_po rp','rp.rec_po_id = rpo.rec_po_id')
		->join('tbl_pro_item pr','pr.pro_item_id = rpo.pro_item_id')
		->join('tbl_contacts c','c.con_id = rp.vendor_id')
		->join('tbl_unit u','u.unit_id = rpo.unit')
		->where('rpo.rec_po_id',$id);		
		$query=$this->db->get();
		$result = $query->result();
		return $result;		
	}

	function get_payment_details($id = '')
	{
		
		$this->db->select('pt.po_id,pt.vendor_id,pt.transaction_no,pt.transaction_date,pt.bank_name,pt.paid_amt,pt.mode,c.con_company_name,b.bank_name,p.payment_mode')
		->from('po_payment AS pt')	
		->join('tbl_contacts c','c.con_id = pt.vendor_id','left')
		->join('tbl_bank_details b','b.bank_id = pt.bank_name','left')
		->join('tbl_payment_mode p','p.payment_mode_id = pt.mode','left')
		->where('pt.po_id',$id);		

		$query=$this->db->get();
		$result = $query->result();
		return $result;		
	}

	function getPoNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['po_prefix'].$pre['po_number'].$pre['po_suffix'];
    }
    function getClientNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['client_prefix'].$pre['client_number'];
    }
       function getVendorNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['vendor_prefix'].$pre['vendor_number'];
    }
    function getEnqNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['enq_prifix'].$pre['enq_number'].$pre['enq_suffix'];
    }
     function getQusNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['quo_prefix'].$pre['quo_number'].$pre['quo_suffix'];
    }
    function getCoNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['cost_prifix'].$pre['cost_number'].$pre['po_suffix'];
    }


	function getReceiveNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['re_prefix'].$pre['re_number'].$pre['re_suffix'];
    }

	function get_company_detail($id = '')
	{ 
		
		$this->db->select('p.po_id,p.vendor')
		->from('purchase_order AS p')
		->where('p.po_id',$id);
		$this->db->where('po_status','1');
		$query=$this->db->get()->row_array();
		return $query['vendor'];
	}

	function getSalesReport($data = '')
	{
			$this->db->select('b.sal_id,b.sal_order,b.sal_order_date,q.client_name,b.sal_grand_total,b.paid_amount,b.payment_status,b.sal_invoice_status,b.sal_created_on,b.sal_created_by,v.dev_name,b.sal_person,b.sal_delivery_date,')
			->from('sales_order AS b');

			if(!empty($data['vendor_id']))
			{
				$this->db->where('sal_company_name',$data['vendor_id']);
			}
			if(!empty($data['from_date']))
			{
					$this->db->where('b.sal_order_date >=',date("Y-m-d",strtotime($data['from_date'])));
			}
			if(!empty($data['to_date']))
			{
					$this->db->where('b.sal_order_date <=',date("Y-m-d",strtotime($data['to_date'])));
			}
			$this->db->where('b.status','1');
			$this->db->join('tbl_client AS q', 'q.id = b.sal_company_name','left');
			$this->db->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
						

		
			$this->db->order_by('b.sal_id','ASC');
			
			return $query1 = $this->db->get()->result();
	}
	
	function getPurchaseReport($data = '')
	{

			$this->db->select('b.po_id ,v.vendor_name,b.order_date,b.po_no, count(pd.po_pdt_id) as items, b.total_cost_price,b.paid_amt,b.rec_status,b.payment_status,b.po_created_on')
			->from('purchase_order AS b');
			$this->db->join('purchase_order_product AS pd', 'pd.po_id = b.po_id','left');
			$this->db->join('tbl_vendor AS v', 'v.id	 = b.vendor','left');
			if(!empty($data['vendor_id']))
			{
				$this->db->where('vendor',$data['vendor_id']);
			}
			if(!empty($data['from_date']))
			{
				$this->db->where('b.order_date >=',date("Y-m-d",strtotime($data['from_date'])));
			}
			if(!empty($data['to_date']))
			{
				$this->db->where('b.order_date <=',date("Y-m-d",strtotime($data['to_date'])));
			}
			$this->db->group_by('b.po_id');
			$this->db->where('b.po_status','1');
			return $query1 = $this->db->get()->result();
	}
	function getPurchasrOrder($data = '')
	{
		$this->db->select('b.sal_id,b.sal_order,b.sal_order_date,q.con_company_name,b.sal_grand_total,b.paid_amount,b.payment_status,b.sal_invoice_status,b.sal_created_on,b.sal_created_by,v.dev_name,b.sal_person,b.sal_delivery_date,')
		->from('sales_order AS b');

		if($data['vendor_id'])
		{
			$this->db->where('sal_company_name',$data['vendor_id']);
		}

		if($data['from_date'] != '')
		{
			if($data['to_date'] != '')
			{
				$this->db->where('b.sal_order_date >=',date("Y-m-d",strtotime($data['from_date'])));
				$this->db->where('b.sal_order_date <=',date("Y-m-d",strtotime($data['to_date'])));
			}else
			{
				$this->db->where('b.sal_order_date =',date("Y-m-d",strtotime($data['from_date'])));
			}
		}
		
		$this->db->join('tbl_contacts AS q', 'q.con_id = b.sal_company_name','left');
		$this->db->join('deliver_method AS v', 'v.dev_id = b.sal_delivery_method','left');
		
		$this->db->where('b.sal_order_date <=',date("Y-m-d",strtotime($data['to_date'])));
		$this->db->where('b.status','1');

		$this->db->order_by('b.sal_id','ASC');
		
		return $query1 = $this->db->get()->result();
	}
	function payable($data = '')
	{
		$this->db->select('pt.po_id,pt.vendor_id,pt.date,c.vendor_name,pt.transaction_date,pt.transaction_no,pt.bank_name,pt.paid_amt,pt.mode,c.vendor_name,b.bank_name,p.payment_mode', FALSE)
		->from('vendor_payment AS pt');	
		
		$this->db->join(' tbl_vendor c','c.id = pt.vendor_id','left');
		$this->db->join('tbl_bank_details b','b.bank_id = pt.bank_name','left');
		$this->db->join('tbl_payment_mode p','p.payment_mode_id = pt.mode','left');
		// $this->db->join('tbl_contacts AS q', 'q.con_id = pt.vendor_id','left');
		if(!empty($data['from_date']))
		{
			$this->db->where('pt.transaction_date >=',date("Y-m-d",strtotime($data['from_date'])));
		}
		if(!empty($data['to_date']))
		{
			$this->db->where('pt.transaction_date <=',date("Y-m-d",strtotime($data['to_date'])));
		}
		if(!empty($data['vendor_id']))
		{
			$this->db->where('pt.vendor_id',$data['vendor_id']);
		}
		if(!empty($data['payment_mode']))
		{
			$this->db->where('pt.mode',$data['payment_mode']);
		}
		if(!empty($data['menu_bank']))
		{
			$this->db->where('pt.bank_name',$data['menu_bank']);
		}

		$this->db->order_by('pt.po_payment_id','ASC');
		$this->db->group_by('pt.po_payment_id');
		
		return $query1 = $this->db->get()->result();
	}
	

	function receivable($data = '')
	{
		$this->db->select('pt.sal_id,pt.customer_id,c.client_name,pt.transaction_date,pt.collection_date,pt.transaction_no,pt.paid_amt,pt.mode,pt.transaction_bank_name,b.bank_name,p.payment_mode', FALSE)
		->from('customet_payment AS pt');	
		
		$this->db->join('tbl_client as c','c.id = pt.customer_id','left');
		$this->db->join('tbl_bank_details b','b.bank_id = pt.bank_name','left');
		$this->db->join('tbl_payment_mode p','p.payment_mode_id = pt.mode','left');
		// $this->db->join('tbl_contacts AS q', 'q.con_id = pt.customer_id','left');

		if(!empty($data['from_date']))
		{
			$this->db->where('pt.transaction_date >=',date("Y-m-d",strtotime($data['from_date'])));
		}
		if(!empty($data['to_date']))
		{
			$this->db->where('pt.transaction_date <=',date("Y-m-d",strtotime($data['to_date'])));
		}
		if(!empty($data['vendor_id']))
		{
			$this->db->where('pt.customer_id',$data['vendor_id']);
		}
		if(!empty($data['payment_mode']))
		{
			$this->db->where('pt.mode',$data['payment_mode']);
		}
		if(!empty($data['menu_bank']))
		{
			$this->db->where('pt.bank_name',$data['menu_bank']);
		}
		$this->db->order_by('pt.sal_payment_id','ASC');
		$this->db->group_by('pt.sal_payment_id');
		
		return $query1 = $this->db->get()->result();
	}
	function vendorpaidamount($data = '')
	{
		 $this->db->select('sum(paid_amt) AS paid_amt'); 
	    $this->db->from('vendor_payment');
	     if(!empty($data)) 
	    {     
	    	$this->db->where('vendor_id', $data);
	    }
	    return $this->db->get()->result();
	}
	function vendorpayment($data = '')
	{
		$this->db->select('sum(total_cost_price) AS total_cost_price'); 
	    $this->db->from('purchase_order');  
	     if(!empty($data)) 
	    {   
	    	$this->db->where('vendor', $data);
		}
	    return $this->db->get()->result();
	}
	function customerpaidamount($data = '')
	{
		 $this->db->select('sum(paid_amt) AS paid_amt'); 
	    $this->db->from('customet_payment');  
	    if(!empty($data)) 
	    {
	   		 $this->db->where('customer_id', $data);
		}
	    return $this->db->get()->result();
	}
	function customerpayment($data = '')
	{
		$this->db->select('sum(sal_grand_total) AS sal_grand_total'); 
	    $this->db->from('sales_order'); 
	     if(!empty($data)) 
	    {  
	    	$this->db->where('sal_company_name', $data);
	    }
	   $this->db->where('status','1');

	    return $this->db->get()->result();
	}
	function drop_menu_productreport($category_id,$pro_item_id)
    {

		$this->db->select('pro_item_id,pro_item_name');		
		$this->db->order_by('pro_item_id', 'ASC');
		if(!empty($category_id))
		{
			$this->db->where('category_id=', $category_id);
		}
		if(!empty($pro_item_id))
		{
			$this->db->where('pro_group_id=', $pro_item_id);
		}
		$query=$this->db->get('tbl_pro_item');
		$this->db->where('prduct_delete_status','1');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->pro_item_id] = $item->pro_item_name;
		}
      return $options;
    }
    function productreport($data = '')
	{
		$this->db->select('b.po_no,b.order_date,b.vendor,pt.receive_date,c.quantity,c.item_name,c.sub_total,c.price,c.sub_total,c.	discount,c.total_amount')
		->from('purchase_order AS b');	
		$this->db->join('receive_po pt','pt.po_id = b.po_id','left');
		$this->db->join('receive_po_products c','c.rec_po_id = pt.rec_po_id','left');
		
		
		if(!empty($data['from_date']))
		{
			$this->db->where('pt.receive_date >=',date("Y-m-d",strtotime($data['from_date'])));
		}
		if(!empty($data['to_date']))
		{
			$this->db->where('pt.receive_date <=',date("Y-m-d",strtotime($data['to_date'])));
		}
		if(!empty($data['vendor_id']))
		{
			$this->db->where('b.vendor',$data['vendor_id']);
		}
		
		return $query1 = $this->db->get()->result();
	}
	 function salproductreport($data = '')
	{
		$this->db->select('pt.sal_order,q.pro_group_name,d.category_name,pt.sal_company_name,pt.sal_order_date,z.pro_item_name,b.quantity,b.price_amt,b.sal_amount,b.pro_item_id,b.discount,b.total_cost,b.sub_total')
		->from('sales_order AS pt');	
		$this->db->join('sales_order_item b','b.sal_id = pt.sal_id','left');
		$this->db->join('tbl_pro_item z','z.pro_item_id = b.pro_item_id','left');
		$this->db->join('tbl_category d','d.category_id = z.category_id','left');
		$this->db->join('tbl_pro_group q','q.pro_group_id = z.pro_group_id','left');
		if(!empty($data['from_date']))
		{
			$this->db->where('pt.sal_order_date >=',date("Y-m-d",strtotime($data['from_date'])));
		}
		if(!empty($data['to_date']))
		{
			$this->db->where('pt.sal_order_date <=',date("Y-m-d",strtotime($data['to_date'])));
		}
		if(!empty($data['vendor_id']))
		{
			$this->db->where('pt.sal_company_name',$data['vendor_id']);
		}
			if(!empty($data['category_id']))
		{
			$this->db->where('z.category_id',$data['category_id']);
		}
			if(!empty($data['pro_group_id']))
		{
			$this->db->where('z.pro_group_id',$data['pro_group_id']);
		}
			if(!empty($data['pro_item_id']))
		{
			$this->db->where('z.pro_item_id',$data['pro_item_id']);
		}
		$this->db->where('pt.sal_invoice_status','1');
		$this->db->where('pt.status','1');
		return $query1 = $this->db->get()->result();




	}
	function reorderitem($data = '')
	{
		$this->db->select('pt.pro_item_name,q.pro_group_name,pt.pro_item_stock,b.category_name,pt.pro_item_cost_price,pt.pro_item_sell_price,pt.pro_item_sell_price,pt.pieces_per_unit,pt.pieces_per_unit,pt.pieces_stock,pt.reorder_level');
		$this->db->from('tbl_pro_item AS pt');	
		$this->db->join('tbl_category b','b.category_id = pt.category_id','left');
		$this->db->join('tbl_pro_group q','q.pro_group_id = pt.pro_group_id','left');
		$this->db->where('pt.reorder_level > pt.pro_item_stock');
		if(!empty($data['category_id']))
		{
			$this->db->where('pt.category_id',$data['category_id']);
		}
		if(!empty($data['pro_group_id']))
		{
			$this->db->where('pt.pro_group_id',$data['pro_group_id']);
		}
		$this->db->where('pt.prduct_delete_status','1');
		return $query1 = $this->db->get()->result();
	}
	function product_report($data = '')
	{
		$this->db->select('pt.pro_item_name,pt.reorder_level,k.con_company_name,q.pro_group_name,pt.pro_item_stock,b.category_name,pt.pro_item_cost_price,pt.pro_item_sell_price,pt.pro_item_sell_price,pt.pieces_per_unit,pt.pieces_per_unit,pt.pieces_stock,pt.reorder_level');
		$this->db->from('tbl_pro_item AS pt');	
		$this->db->join('tbl_category b','b.category_id = pt.category_id','left');
		$this->db->join('tbl_contacts k','k.con_id = pt.con_id','left');
		$this->db->join('tbl_pro_group q','q.pro_group_id = pt.pro_group_id','left');

		if($data['category_id']!='')
		{
			$this->db->where('pt.category_id',$data['category_id']);
		}
		if($data['pro_group_id']!='')
		{
			$this->db->where('pt.pro_group_id',$data['pro_group_id']);
		}
		if($data['vendor_id']!='')
		{
			$this->db->where('pt.con_id',$data['vendor_id']);
		}
		$this->db->where('pt.prduct_delete_status','1');
		return $query1 = $this->db->get()->result();
	}
	 function stackproductreport($data = '')
	{
		$this->db->select('sum(c.quantity) AS quantity')
		->from('receive_po_products AS c');	
		$this->db->join('receive_po pt','pt.rec_po_id = c.rec_po_id','left');	
		
		if(!empty($data['from_date']))
		{
			$this->db->where('pt.receive_date >=',date("Y-m-d",strtotime($data['from_date'])));
		}
		if(!empty($data['to_date']))
		{
			$this->db->where('pt.receive_date <=',date("Y-m-d",strtotime($data['to_date'])));
		}
		if(!empty($data['vendor_id']))
		{
			$this->db->where('b.vendor',$data['vendor_id']);
		}
		
		$this->db->group_by('c.pro_item_id');
		return $query1 = $this->db->get()->result();
	}
	function stacksalproductreport($data = '')
	{
		$this->db->select('q.pro_group_name,d.category_name,z.pro_item_name,sum(b.quantity) AS quantity,b.price_amt,b.sal_amount,b.pro_item_id')
		->from('sales_order_item AS b');
		$this->db->join('sales_order pt','pt.sal_id = b.sal_id','left');	
		$this->db->join('tbl_pro_item z','z.pro_item_id = b.pro_item_id','left');
		$this->db->join('tbl_category d','d.category_id = z.category_id','left');
		$this->db->join('tbl_pro_group q','q.pro_group_id = z.pro_group_id','left');
		if(!empty($data['from_date']))
		{
			$this->db->where('pt.sal_order_date >=',date("Y-m-d",strtotime($data['from_date'])));
		}
		if(!empty($data['to_date']))
		{
			$this->db->where('pt.sal_order_date <=',date("Y-m-d",strtotime($data['to_date'])));
		}
		if(!empty($data['vendor_id']))
		{
			$this->db->where('pt.sal_company_name',$data['vendor_id']);
		}
		if(!empty($data['category_id']))
		{
			$this->db->where('z.category_id',$data['category_id']);
		}
		if(!empty($data['pro_group_id']))
		{
			$this->db->where('z.pro_group_id',$data['pro_group_id']);
		}
		if(!empty($data['pro_item_id']))
		{
			$this->db->where('z.pro_item_id',$data['pro_item_id']);
		}
		$this->db->where('pt.sal_invoice_status','1');
		$this->db->where('pt.status','1');
		$this->db->group_by('b.pro_item_id');
		return $query1 = $this->db->get()->result();

	}
	function Current_Month_purchase($data = '')
	{
		$this->db->select('sum(total_cost_price) AS total_cost_price');
		$this->db->from('purchase_order');
		$this->db->where('po_status','1');
		$this->db->where('month(order_date)',date('m'));
		 $query1 = $this->db->get()->row_array();
		 return $query1['total_cost_price'];
	}
	function Current_Month_sales($data = '')
	{
		$this->db->select('sum(sal_grand_total) AS sal_grand_total');
		$this->db->from('sales_order');
		$this->db->where('status','1');
		$this->db->where('month(sal_order_date)',date('m'));
		 $query1 = $this->db->get()->row_array();
		 return $query1['sal_grand_total'];
	}


	function Outstanding_Receivable_pay1()
	{
		$this->db->select('p.po_id,h.con_company_name,SUM(h.opening_balance) AS opening_balance, p.paid_amt, p.total_cost_price');
		$this->db->from('tbl_contacts As h');
		$this->db->join('purchase_order p', 'h.con_id = p.vendor');
		$this->db->where('p.rec_status','2');
		$this->db->where('p.payment_status','0');
		$this->db->group_by('p.vendor');
		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
	function Outstanding_Receivable_sal1()
	{
		$this->db->select('p.sal_id,h.con_company_name,p.sal_order, p.sal_order_date, p.sal_reference, p.paid_amount, p.sal_grand_total,h.opening_balance, p.payment_status');
		$this->db->from('sales_order As p');
		$this->db->join('tbl_contacts h', 'h.con_id = p.sal_company_name');
		$this->db->where('p.sal_invoice_status','1');
		$this->db->where('p.payment_status','0');
		$this->db->group_by('p.sal_company_name');
		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
		function Outstanding_Receivable_paid($data = '')
	{
		$this->db->select('sum(paid_amt) AS paid_amt');
		$this->db->from('customet_payment');
		$query1 = $this->db->get()->row_array();
		return $query1['paid_amt'];
	}
	function Outstanding_Payable_pay($data = '')
	{
		$this->db->select('sum(total_cost_price) AS total_cost_price');
		$this->db->from('purchase_order');
		$this->db->where('po_status','1');
		$query1 = $this->db->get()->row_array();
		return $query1['total_cost_price'];
	}
	function Outstanding_Payable_paid($data = '')
	{
		$this->db->select('sum(paid_amt) AS paid_amt');
		$this->db->from('vendor_payment');

		$query1 = $this->db->get()->row_array();
		return $query1['paid_amt'];
	}
	function Stock_value($data = '')
	{
		$this->db->select('(pro_item_stock*pro_item_cost_price) AS total_cost_price');
		$this->db->from('tbl_pro_item');
		$this->db->where('prduct_delete_status','1');
		return $query1 = $this->db->get()->result();
	}
	function reorder($data = '')
	{
		$this->db->select('COUNT(reorder_level) AS reorder_level');
		$this->db->from('tbl_pro_item');
		$this->db->where('prduct_delete_status','1');
		$query1 = $this->db->get()->row_array();
		return $query1['reorder_level'];
	}
	
	function customer_balance_sheet($fromDate = '', $toDate='', $vendor_id='')
	{
		$where = "sal_invoice_status = '1'";
		$where1 = "sal_payment_id > '0'";
		if($vendor_id > 0)
		{
			$where.=" AND sal_company_name = '".$vendor_id."'";
		}
		if(!empty($fromDate))
		{                  
			$fromDate 	= date('Y-m-d', strtotime($fromDate));
			$toDate 	= date('Y-m-d', strtotime($toDate));
			
			$where.=" AND s.sal_order_date >= '$fromDate'";
			$where.=" AND s.sal_order_date <= '$toDate'";
		}

		if($vendor_id > 0)
		{
			$where1.="AND p.customer_id = '".$vendor_id."'";
		}

		if(!empty($fromDate))
		{                  
			$fromDate 	= date('Y-m-d', strtotime($fromDate));
			$toDate 	= date('Y-m-d', strtotime($toDate));
			if($vendor_id)
			{
			$where1.=" AND p.collection_date >= '$fromDate'";
			}
			else
			{
			$where1.=" AND p.collection_date >= '$fromDate'";

			}
			$where1.=" AND p.collection_date <= '$toDate'";
		}

		$query1=$this->db->query("(
										SELECT s.sal_order_date as date,s.sal_created_on as created_on,CONCAT('SALES ', ' ', s.sal_order) as particular, s.sal_grand_total AS debit, NULL AS credit
										FROM sales_order AS s
										WHERE $where
								)
								UNION 
								(
									SELECT p.collection_date as date,p.created_on as created_on,CONCAT('PAYMENT ', ' ', p.customer_remark) as particular, NULL AS debit, p.paid_amt AS credit
									FROM customet_payment AS p
									WHERE $where1
								)
								ORDER BY `created_on` ASC
							");
		
		return $query1->result_array();
	}

	function vendor_balance_sheet($fromDate,$toDate,$vendor_id)
	{
		$where = "rec_status = '2'";
		$where1 = "po_payment_id > '0'";

		if($vendor_id > 0)
		{
			$where.=" AND p.vendor = '".$vendor_id."'";
			$where1.="AND v.vendor_id = '".$vendor_id."'";
		}

		if(!empty($fromDate))
		{                  
			$fromDate 	= date('Y-m-d', strtotime($fromDate));
			$toDate 	= date('Y-m-d', strtotime($toDate));
			
			$where.=" AND p.order_date >= '$fromDate'";
			$where.=" AND p.order_date <= '$toDate'";
		}

		if(!empty($fromDate))
		{                  
			$fromDate 	= date('Y-m-d', strtotime($fromDate));
			$toDate 	= date('Y-m-d', strtotime($toDate));
			if($vendor_id)
			{
				$where1.=" AND v.date >= '$fromDate'";
			}
			else
			{
				$where1.=" AND v.date >= '$fromDate'";
			}

			$where1.=" AND v.date <= '$toDate'";
		}

		$query1=$this->db->query("(
										SELECT p.order_date as date,p.po_created_on as created_on,CONCAT('PURCHASE ', ' ', p.po_no) as particular, p.total_cost_price AS debit , NULL AS credit
										FROM purchase_order AS p
										WHERE $where
									)
									UNION 
									(
										SELECT v.date as date,v.created_on as created_on,CONCAT('PAYMENT ', ' ', v.vendor_remark) as particular, NULL AS debit, v.paid_amt AS credit 
										FROM vendor_payment AS v
										WHERE $where1
									)
									ORDER BY `created_on` ASC
								");
		
		return $query1->result_array();
	}
	function dateWisecustomerOpeningBalance($fromDate='-1',$vendor_id)
	{  
		
		$fromDate1 	= date('Y-m-d', strtotime($fromDate));
	   	$this->db->select('sum(sal_grand_total)  as amount');
		$this->db->from('sales_order');
		$this->db->where('sal_order_date < "'.$fromDate1.'" AND sal_company_name = "'.$vendor_id.'" ');	
		$result= $this->db->get()->row_array();

		$this->db->select('sum(paid_amt)  as amount1');
		$this->db->from('customet_payment');
		$this->db->where('collection_date < "'.$fromDate1.'" AND customer_id = "'.$vendor_id.'"');
		$result1= $this->db->get()->row_array();
		
		return $result['amount']-$result1['amount1'];
	}
	function dateWisevendorOpeningBalance($fromDate='-1',$vendor_id)
	{  
		
		$fromDate1 	= date('Y-m-d', strtotime($fromDate));
	   	$this->db->select('sum(total_cost_price)  as amount');
		$this->db->from('purchase_order');
		$this->db->where('order_date < "'.$fromDate1.'" AND vendor = "'.$vendor_id.'" ');	
		$result= $this->db->get()->row_array();

		$this->db->select('sum(paid_amt)  as amount1');
		$this->db->from('vendor_payment');
		$this->db->where('date < "'.$fromDate1.'" AND vendor_id = "'.$vendor_id.'"');
		$result1= $this->db->get()->row_array();
		
		return $result['amount']-$result1['amount1'];
	}
	function get_invoice_items($id = '')
	{
		$this->db->select('p.sl_no,p.qty,p.unit_price,p.item_description, p.item_description_arabic')
		->from('sales_order_item As p')
		
		->where('p.sal_id',$id);
		
		$query=$this->db->get();
		$result = $query->result();
		return $result;	
	}
	
}


