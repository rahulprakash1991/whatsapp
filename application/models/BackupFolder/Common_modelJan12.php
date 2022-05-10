<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function clean_url($string)
	{
		$url = strtolower($string);
		$url = str_replace(array(
						"'",
						'"'
		), '', $url);
		$url = str_replace(array(
						' ',
						'+',
						'!',
						'&',
						'-',
						'/'
		), '-', $url);
		$url = str_replace("?", "", $url);
		$url = str_replace("---", "-", $url);
		$url = str_replace("--", "-", $url);
		return $url;
	}
	
	function add_post()
	{
		$this->db->from('tbl_contacts');
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	/**
	* [record_counts description]
	* @param  [type] $user_id [users id]
	* @return [INT]   user's id [description]
	* @author Ganesh Ananthan
	*/
	public function record_counts($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
	
	public function specific_record_counts($table, $constraint_array)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($constraint_array);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
	
	public function check_po_status($table, $po_id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('po_id', $po_id);
		$this->db->where('quantity > ', 'recd_qty', FALSE);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
	
	public function specific_row_value($table, $constraint_array = '', $get_field)
	{
		$this->db->select($get_field);
		$this->db->from($table);
		if (!empty($constraint_array)) {
			$this->db->where($constraint_array);
		}
		$result = $this->db->get()->row_array();
		return $result[$get_field];
	}

	public function records_all($table, $constraint_array = '')
	{
		$this->db->select('*');
		$this->db->from($table);
		if (!empty($constraint_array)) {
			$this->db->where($constraint_array);
		}
		$results = $this->db->get()->result();
		return $results;
	}
	
	public function get_fulldata($table, $constraint_array)
	{
		$query = $this->db->get_where($table, $constraint_array, 1);
		return $query;
	}
	public function get_fulldata1($table, $constraint_array)
	{
		$query = $this->db->get_where($table, $constraint_array);
		return $query;
	}
	public function common_insert($table, $data)
	{
		$this->db->insert($table, $data);
		$result = $this->db->insert_id();
		return $result;
	}
	
	public function common_edit($table, $data, $where_array)
	{
		$this->db->update($table, $data, $where_array);
		$result = $this->db->affected_rows();
		return $result;
	}
	
	public function common_edit1($table, $data, $where_array)
	{
		$result = $this->db->update($table, $data, $where_array);
		return $result;
	}
	
	public function dataUpdate($table, $field, $value, $where)
	{
		$this->db->set("$field", "$field+$value", FALSE);
		$this->db->where($where);
		$this->db->update($table);
		return $result = $this->db->affected_rows();
	}
	
	public function common_delete($table, $where_array)
	{
		return $this->db->delete($table, $where_array);
	}

	public function getCompanyProfiles($company_id)
	{
		$this->db->select('c.c_id, c.c_logo, c.c_org_name, c.c_street, c.c_area, c.c_city, c.c_state, c.c_pincode, c.c_country, c.c_phone, c.c_mobile, c.c_fax, c.c_website, c.c_email, cr.cur_name, cr.cur_symbol, c.c_tax, c.c_cst,c_org_abb');
		$this->db->from('tbl_company_profile c');
		$this->db->where('c_id', $company_id);
		$this->db->join('tbl_currency cr', 'cr.cur_id = c.c_currency', 'left');
		return $this->db->get();
	}

	public function getACLActions()
	{
		$this->db->select('a.action_id, a.action_code, a.action_desc, a.category_id, c.category_code, c.category_desc');
		$this->db->from('acl_actions a');
		$this->db->join('acl_categories c', 'c.category_id = a.category_id');
		$this->db->order_by('a.action_id', 'ASC');
		$this->db->where('a.show_status',1);
		return $this->db->get()->result();		
	}

	public function userACLCategories( $user_id ='' )
	{
		$this->db->select('a.category_id, c.category_code');
		$this->db->from('acl ac');
		$this->db->join('acl_actions a', 'a.action_id = ac.action_id');
		$this->db->join('acl_categories c', 'c.category_id = a.category_id');
		$this->db->where('ac.user_id', $user_id);
		$this->db->group_by('a.category_id');
		$result = $this->db->get()->result();
		$aclPermission = array();

		foreach ($result as $row) {
			$aclPermission[ $row->category_id ] = $row->category_code;
		}

		return $aclPermission;
	}

	public function drop_menu_category()
	{
		$this->db->select('c_id, c_name');
		$this->db->where('c_delistatus', '1');
		$this->db->where('c_status', '1');
		$this->db->order_by('c_order', 'ASC');
		$query       = $this->db->get('category');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->c_id] = $item->c_name;
		}
		return $options;
	}
	
	public function drop_menu_salutation()
	{
		$this->db->select('sal_id, sal_name');
		$this->db->order_by('sal_name', 'ASC');
		$this->db->where('c_delistatus', '1');
		$query       = $this->db->get('tbl_salutation');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->sal_id] = $item->sal_name;
		}
		return $options;
	}
	
	public function drop_menu_currency()
	{
		$this->db->select('cur_id, cur_name');
		$this->db->order_by('cur_name', 'ASC');
		$this->db->where('currency_delete_status', '1');
		$query       = $this->db->get('tbl_currency');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->cur_id] = $item->cur_name;
		}
		return $options;
	}
	
	public function drop_menu_accountheads()
	{
		$this->db->select('payment_terms_id, payment_terms');
		$this->db->order_by('payment_terms', 'ASC');
		$this->db->where('payment_delete_status', '1');
		$query       = $this->db->get('tbl_payment_terms');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->payment_terms_id] = $item->payment_terms;
		}
		return $options;
	}
	
	public function drop_menu_CreditPeriod()
	{
		$this->db->select('payment_terms_id, payment_no_days');
		$this->db->order_by('payment_terms', 'ASC');
		$this->db->where('payment_delete_status', '1');
		$query       = $this->db->get('tbl_payment_terms');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->payment_terms_id] = $item->payment_no_days;
		}
		return $options;
	}
	
	public function drop_menu_product()
	{
		$this->db->select('pro_group_id, pro_group_name');
		$this->db->order_by('pro_group_name', 'ASC');
		$this->db->where('pro_group_delete_status', '1');
		$query       = $this->db->get('tbl_pro_group');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->pro_group_id] = $item->pro_group_name;
		}
		return $options;
	}
	
	public function sales_order_tax($id)
	{
		$data = '';
		$this->db->select('s.tbl_tax_id,s.sal_tax_amount,t.tax_name')->from('sales_order_tax AS s')->join('tbl_tax t', 't.tax_id = s.sal_tax_id')->where('s.invoice_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
						$data[] = $row;
		}
		return $data;
	}
	
	public function drop_menu_unit()
	{
		$this->db->select('unit_id, unit_name');
		$this->db->order_by('unit_name', 'ASC');
		$this->db->where('unit_status', '1');
		$query       = $this->db->get('tbl_unit');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->unit_id] = $item->unit_name;
		}
		return $options;
	}
	
	public function drop_menu_unit1()
	{
		$this->db->select('p.unit_id,u.unit_name,p.pro_item_id');
		$this->db->from('tbl_pro_item AS p');
		$this->db->join('tbl_unit u', 'u.unit_id = p.unit_id');
		$this->db->where('unit_delete_status', '1');
		$query       = $this->db->get();
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->unit_id] = $item->unit_name;
		}
		return $options;
	}
	
	public function drop_menu_tax()
	{
		$this->db->select('tax_id, tax_name');
		$this->db->order_by('tax_name', 'ASC');
		$this->db->where('tax_delete_status', '1');
		$query       = $this->db->get('tbl_tax');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->tax_id] = $item->tax_name;
		}
		return $options;
	}
	
	public function drop_menu_tax1()
	{
		$this->db->select('tax_id, tax_name');
		$this->db->order_by('tax_name', 'ASC');
		$this->db->where('tax_delete_status', '1');
		$query  = $this->db->get('tbl_tax');
		$result = $query->result();
		return $result;
	}
	
	public function drop_menu_contact()
	{
		$this->db->select('con_id, con_type,con_company_name');
		$this->db->order_by('con_id', 'ASC');
		$this->db->where('con_status', '1');
		$query       = $this->db->get('tbl_contacts');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->con_id] = $item->con_company_name;
		}
		return $options;
	}
	
	public function drop_menu_address($id)
	{
		$this->db->select('con_id,tbl_id,sal_address');
		$this->db->order_by('sal_address', 'ASC');
		$this->db->where('con_id', $id);
		$query       = $this->db->get('tbl_address');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->sal_address] = $item->sal_address;
		}
		return $options;
	}
	public function drop_menu_address_vendor($id='')
	{
		$this->db->select('vendor_id,id,vendor_address');
		$this->db->order_by('vendor_address', 'ASC');
		if($id!='')
		{
		$this->db->where('vendor_id', $id);	
		}
		
		$query       = $this->db->get('table_vendor_address');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->vendor_address] = $item->vendor_address;
		}
		return $options;
	}
	public function drop_menu_client_rep_name($id='')
	{
		$this->db->select('client_id,id,rep_name');
		$this->db->order_by('rep_name', 'ASC');
		if($id!='')
		{
		$this->db->where('client_id', $id);	
		}
		
		$query       = $this->db->get('tbl_client_rep');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->id] = $item->rep_name;
		}
		return $options;
	}
	public function drop_menu_address1()
	{
		$this->db->select('con_id,tbl_id,sal_address');
		$this->db->order_by('sal_address', 'ASC');
		$query       = $this->db->get('tbl_address');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->sal_address] = $item->sal_address;
		}
		return $options;
	}
	
	public function drop_menu_vendor()
	{
		$this->db->select('con_company_name,con_id, con_type');
		$this->db->where('con_type', '0');
		$this->db->where('con_delete_status', '1');
		$query       = $this->db->get('tbl_contacts');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->con_id] = $item->con_company_name;
		}
		return $options;
	}
	
	public function drop_menu_item()
	{
		$this->db->select('item_id, item_rate');
		$query       = $this->db->get('item_rate_as');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->item_id] = $item->item_rate;
		}
		return $options;
	}
	
	public function drop_menu_product_item()
	{
		$this->db->select('pro_item_id, pro_item_name');
		$this->db->where('pro_item_status', '1');
		$query       = $this->db->get('tbl_pro_item');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->pro_item_id] = $item->pro_item_name;
		}
		return $options;
	}
	
	public function drop_menu_ship_pref()
	{
		$this->db->select('ship_pref_id, ship_pre_type');
		$query       = $this->db->get('shipment_preferences');
		$result      = $query->result();
		$options[''] = '-- Select --';
		foreach ($result as $item) {
						$options[$item->ship_pref_id] = $item->ship_pre_type;
		}
		return $options;
	}
	


	
	public function get_data_product($id)
	{
		$data = '';
		$this->db->select('s.sal_item_id,s.sal_id,p.pro_item_name,p.pro_item_id,s.unit,s.price_amt,s.quantity,s.sal_amount as amount,t.tax_id,t.tax_name,t.tax_percent,p.pro_item_stock AS available_qty')->from('sales_order_item AS s')->join('sales_order so', 'so.sal_id = s.sal_id')->join('tbl_pro_item p', 'p.pro_item_id = s.pro_item_id')->join('tbl_tax t', 't.tax_id = so.sal_tax_id')->join('tbl_unit u', 'u.unit_id = s.unit')->where('s.sal_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
						$data[] = $row;
		}
		return $data;
	}
	
	public function get_pro_item($id, $data)
	{
		$this->db->select('s.pro_item_id,s.pro_item_stock AS pro_item_stock')->from('tbl_pro_item AS s')->where('s.pro_item_id', $id);
		$query = $this->db->get()->row_array();
		return $data = $query['pro_item_stock'] - $data;
	}
	
	public function get_pro_item1($id, $qty)
	{
		$this->db->select('s.pro_item_id')->from('tbl_pro_item AS s')->where('s.pro_item_id', $id)->where('s.pro_item_stock >=', $qty);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
			
	public function get_company_detail($id)
	{
		$this->db->select('s.sal_id,s.sal_company_name')->from('sales_order AS s')->where('s.sal_id', $id);
		$query = $this->db->get()->row_array();
		return $query['sal_company_name'];
	}
			
	public function poproduct($id)
	{
		$data = '';
		$this->db->select('pd.po_id    ,pd.pro_item_id,pd.unit1,pd.uom2,pd.quantity1,pd.price1,pd.unit,pd.quantity,pd.recd_qty,pd.price_amt,pd.pdt_tax_amt,pd.amount,pd.po_pdt_id,pr.pro_item_name,pr.pro_item_id')->from('po_product_details AS pd')->join('tbl_pro_item pr', 'pr.pro_item_id = pd.pro_item_id')->join('tbl_purchase_order s', 's.po_id = pd.po_id')->where('pd.po_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
						$data[] = $row;
		}
		return $data;
	}
			
	public function get_receive_product($id)
	{
		$data = '';
		$this->db->select('pd.po_id    ,pd.pro_item_id,pd.unit1,pd.uom2,pd.quantity1,pd.price1,pd.unit,pd.quantity,pd.recd_qty,pd.rec_qty,pd.price_amt,pd.pdt_tax_amt,pd.amount,pd.rec_po_pdt_id')->from('rec_po_pdt_details AS pd')->join('tbl_receive_po s', 's.po_id = pd.po_id')->where('pd.po_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
						$data[] = $row;
		}
		return $data;
	}
			
	public function adddate($sal_order)
	{
		$this->db->select('DATE_ADD(sal_order_date,INTERVAL sal_credit_period DAY) as sal_next_duedate')->from('sales_order')->where('sal_order', $sal_order);
		$query = $this->db->get()->row_array();
		return $data = $query['sal_next_duedate'];
	}
			
	public function payment_detail($id)
	{
		$data = '';
		$this->db->select('s.payment_id,u.sal_person,s.date,s.invoice_id,s.amount,s.payment_mode,s.transaction_number,s.transaction_date,s.transaction_date,s.transaction_bank_name,s.transaction_bank_name,t.payment_terms AS account_heads')->from('sal_payment AS s')->join('sales_order u', 'u.sal_id = s.invoice_id')->join('tbl_payment_terms t', 't.payment_terms_id = s.account_heads')->where('s.invoice_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
						$data[] = $row;
		}
		return $data;
	}
			
	public function view_po_details($id)
	{
		$this->db->select('pp.pro_item_id,pp.quantity,pp.price_amt,pp.amount,pp.po_id,p.po_id,p.ref_no,p.vendor,p.order_date,p.po_no,p.ref_no,pr.pro_item_name,c.con_company_name,c.con_address,c.con_email,c.con_phone,c.con_id,pp.unit,u.unit_name')->from('po_product_details AS pp')->join('tbl_purchase_order p', 'p.po_id = pp.po_id')->join('tbl_pro_item pr', 'pr.pro_item_id = pp.pro_item_id')->join('tbl_contacts c', 'c.con_id = p.vendor')->join('tbl_unit u', 'u.unit_id = pp.unit')->where('pp.po_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
			
	public function viewpo($id)
	{
		$this->db->select('p.po_id,p.ref_no,p.vendor,p.order_date,p.po_no,c.con_company_name,c.con_address,c.con_email,c.con_phone,c.con_id')->from('tbl_purchase_order AS p')->join('tbl_contacts c', 'c.con_id = p.vendor')->where('p.po_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
			
	public function get_receive_po_details($id)
	{
		$this->db->select('rp.rec_po_id,rp.po_id,rp.vendor_id,rp.receive_number,rp.receive_date,rp.ref_no,rp.bill_no,COUNT(rpo.rec_po_pdt_id) as product,rp.total,sum(rpo.quantity) as quantity,rpo.unit,c.con_company_name,c.con_id')->from('tbl_receive_po AS rp')->join('rec_po_pdt_details rpo', 'rpo.rec_po_id = rp.rec_po_id')->join('tbl_unit u', 'u.unit_id = rpo.unit')->join('tbl_contacts c', 'c.con_id = rp.vendor_id')->where('rp.po_id', $id)->order_by('rp.receive_date', 'ASC')->order_by('rp.receive_number', 'ASC')->group_by('rp.rec_po_id');
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
			
	public function get_receivedpo_details($id)
	{
		$this->db->select('rp.rec_po_id,rp.po_id,rp.vendor_id,rp.receive_number,rp.receive_date,rp.ref_no,rp.bill_no,rpo.rec_po_pdt_id,rp.total,rp.total')->from('tbl_receive_po AS rp')->join('rec_po_pdt_details rpo', 'rpo.rec_po_id = rp.rec_po_id')->join('tbl_unit u', 'u.unit_id = rpo.unit')->join('tbl_contacts c', 'c.con_id = rp.vendor_id')->where('rp.rec_po_id', $id)->order_by('rp.receive_date', 'ASC')->group_by('rp.rec_po_id');
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
			
	public function get_address($id)
	{
		$data = array();
		$this->db->select('s.tbl_id,s.sal_address')->from('tbl_address AS s')->where('s.con_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}
	public function get_vendor_address($id)
	{
		$data = array();
		$this->db->select('s.id,s.vendor_address,s.area,s.city,s.state,s.post_code,s.country,s.phone,s.mobile,s.email,s.fax,s.website')->from('table_vendor_address AS s')->where('s.vendor_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}
	public function get_vendor_managementID($id)
	{
		$data = array();
		$this->db->select('s.id,s.vendor_management_id,s.vendor_mng_no')->from('vendor_ids AS s')->where('s.vendor_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}
	public function get_client_address($id)
	{
		$data = array();
		$this->db->select('s.id,s.client_address,s.area,s.city,s.state,s.post_code,s.country,s.phone,s.mobile,s.email,s.fax,s.website')->from('table_client_address AS s')->where('s.client_id', $id);
		$query  = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row) {
			$data[] = $row;
		}
		return $data;
	}
			
	public function get_paid_amount($id)
	{
		$this->db->select('sum(s.amount) As amount')->from('payment_detail AS s')->where('s.invoice_id', $id);
		$query = $this->db->get()->row_array();
		return $data = $query['amount'];
	}
			

	
	public function set_pref_no($table, $field)
	{
		$this->db->set('key_value', 'key_value+' . '1', FALSE);
		$this->db->where('key', $field);
		$this->db->update($table);
		return TRUE;
	}

	function get_sales_details($id, $con_id)
	{
		$this->db->select('r.sal_order, r.sal_order_date, c.con_company_name, pp.pro_item_id, pr.pro_item_name, pr.pieces_per_unit, pp.quantity, u.unit_name, pp.price_amt, pp.sal_amount')
		->from('sales_order_item AS pp')
		->join('sales_order r', 'r.sal_id = pp.sal_id', 'left')
		->join('tbl_pro_item pr', 'pr.pro_item_id = pp.pro_item_id', 'left')
		->join('tbl_contacts c', 'c.con_id = r.sal_company_name', 'left')
		->join('tbl_unit u', 'u.unit_id = pp.unit', 'left')
		->where('pp.pro_item_id', $id);
		if($con_id)
		{
			$this->db->where('r.sal_company_name', $con_id);
		}
		$this->db->order_by('r.sal_order', 'DESC');
		$this->db->limit(10);

		$query=$this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getBarcodeList($rec_po_id)
	{
		$this->db->select('i.barcode, p.pro_item_code, p.pro_item_name')
				->from('item_barcode AS i')
				->join('tbl_pro_item p', 'p.pro_item_id = i.pro_item_id')
				->where(array( 'i.rec_po_id' =>	$rec_po_id, 'i.sold' => '0' ));
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function getBarcodeItemDetails($barcode)
	{
		$this->db->select('i.barcode_id, i.sold, p.pro_item_id, p.pro_item_stock')
				->from('item_barcode AS i')
				->join('tbl_pro_item p', 'p.pro_item_id = i.pro_item_id')
				->where(array( 'i.barcode' =>	$barcode));
		$query  = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	// Generate Product Code
	function getProductCode()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['prdcode_prefix'].$pre['prdcode_number'];
    }

	// Barcode per row
	function getBarcodeRow()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['barcode_per_row'];
    }
    public function find_old_po_rev($po_id)
	{
    	$po_rev = $this->db->select_max('po_rev')->where('po_id',$po_id)->limit(1)->get('purchase_order')->row('po_rev');   
    	return $po_rev; 
	}	
	public function find_min_cost($p_id,$v_id)
	{

    // $cost = $this->db->select_min('pro_item_cost_price')->where('pro_item_id',$p_id)->where('con_id',$v_id)->get('tbl_pro_item')->row('pro_item_cost_price');
   
    // return $cost;   
		$cost = $this->db->select_min('cost_price')->where('pro_id',$p_id)->where('vender_id',$v_id)->get(' tbl_pro_item_vendor')->row('cost_price');
   
    return $cost;   

	}
	public function get_pro_name($id)
	{
		// $this->db->select('p.pro_item_id,p.pro_item_name,p.pro_item_code')->from(' tbl_pro_item AS p')->where('p.pro_item_id', $id);
		// $query  = $this->db->get();
		// // $result = $query->result();
		// return $result;
		$pro_item_name = $this->db->select_max('pro_item_name')->where('pro_item_id',$id)->limit(1)->get('tbl_pro_item')->row('pro_item_name');   
    	return $pro_item_name; 
	}
		public function get_pro_code($id)
	{
		// $this->db->select('p.pro_item_id,p.pro_item_name,p.pro_item_code')->from(' tbl_pro_item AS p')->where('p.pro_item_id', $id);
		// $query  = $this->db->get();
		// // $result = $query->result();
		// return $result;
		$pro_item_code = $this->db->select_max('pro_item_code')->where('pro_item_id',$id)->limit(1)->get('tbl_pro_item')->row('pro_item_code');   
    	return $pro_item_code; 
	}
		function getCostingData($id = '')
	{
		$this->db->select('co.co_id,co.co_no,co.order_date,co.ref_no,c.con_company_name,c1.con_company_name as name1,c2.con_company_name as name2,c3.con_company_name as name3')
		->from(' tbl_costing AS co')	
		->join('tbl_contacts c','c.con_id = co.vendor', 'left')
		->join('tbl_contacts c1','c1.con_id = co.vendor2', 'left')
		->join('tbl_contacts c2','c2.con_id = co.vendor3', 'left')
		->join('tbl_contacts c3','c3.con_id = co.vendor4', 'left')
		// ->join('shipment_preferences sp','sp.ship_pref_id = p.ship_pref_id', 'left')
		->where('co.co_id',$id);
		$this->db->where('co.co_delete_status','1');
		return $query=$this->db->get();
	}
	function coproduct($id = '')
	{ 
		$data = array();
		$this->db->select('pd.co_pro_id	,pd.co_id,pd.pro_item_id,t.pro_item_name,pd.cost,pd.cost1,pd.cost2,pd.cost3')
			->from('tbl_costing_product AS pd')
			
			->join('tbl_pro_item t', 't.pro_item_id = pd.pro_item_id')
			
			->where('pd.co_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	public function old_client_logo($id)
	{
	
		$image_site_path = $this->db->select_max('client_logo')->where('id',$id )->limit(1)->get('tbl_client')->row('client_logo');
		

    return $image_site_path;
	}
	public function old_vendor_logo($id)
	{
	
		$old_vendor_img = $this->db->select_max('vendor_logo')->where('id',$id )->limit(1)->get('tbl_vendor')->row('vendor_logo');
		

    return $old_vendor_img;
	}
	// JOIN query
	public function join_records_all($fields, $table, $joinArr, $constraint_array = '', $groupBy = '', $orderby = '', $limit='', $resultType='' , $or_constraint_array=''  , $joinVal='left' )
	{

		$this->db->select(implode(',', $fields), FALSE);
		$this->db->from($table);

		foreach ($joinArr as $tableName => $condition) 
		{
			$this->db->join($tableName, $condition, $joinVal);
		}

		if (!empty($constraint_array))
		{
			$this->db->where($constraint_array);
		}

		if ($or_constraint_array != '')
		{
			$this->db->where($or_constraint_array);
		}

		if($groupBy != '')
		{
			$this->db->group_by($groupBy);
		}

		if(!empty($orderby))
		{
			$this->db->order_by($orderby);	
		}

		if($limit != '')
		{
			$this->db->limit($limit);	
		}

		if($resultType == 'object')
		{
			$results= $this->db->get();
			
		}
		if($resultType == 'array')
		{
			$results= $this->db->get()->result_array();
			
		}
		else
		{
			$results= $this->db->get();
		}

		return $results;
	}
	public function find_quote_id($id)
	{

    $quote_id = $this->db->select_max('qus_id')->where('enq_id',$id)->limit(1)->get('tbl_quotes')->row('qus_id');
   
    return $quote_id;    
	}
	public function find_quote_value($id)
	{

    $quote_id = $this->db->select_max('grand_total')->where('enq_id',$id)->limit(1)->get('tbl_quotes')->row('grand_total');
   
    return $quote_id;    
	}
	public function find_quote_key($id)
	{

    $quote_id = $this->db->select_max('qus_key')->where('enq_id',$id)->limit(1)->get('tbl_quotes')->row('qus_key');
   
    return $quote_id;    
	}
	function get_quotation_product_items($id = '')
	{ 
		$data = array();
		$this->db->select('qp.item_name,qp.quantity,qp.price,qp.sub_total,qp.discount,qp.total_amount,qp.qus_pro_id')
			->from('quotation_product AS qp')
			
			->where('qp.quo_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function getallDataEnquiryandQuote($id = '')
	{
		
		$this->db->select('e.id,e.enq_key,e.enq_ref,e.enq_notes,c.client_name,c.client_email,c.client_mobile,c.address,d.department_name,m.name,q.qus_id,q.qus_key,q.subject,q.general_terms,q.commer_terms,q.note,q.bank_details,q.grand_total')
		->from('tbl_enquiry AS e')	
		->join('tbl_client c','c.id = e.client_id','left')
		->join('tbl_department d','d.department_id = e.	department_id','left')
		->join('contact_mode m','m.id = e.mode_id','left')
		->join('tbl_quotes q','q.enq_id = e.id','left')
		->where('e.id',$id);		

		$query=$this->db->get();
		$result = $query->result();
		return $result;		
	}
		
		function GetQuoteProducts($id='')
		{
			$data = array();
		$this->db->select('qp.item_name,qp.quantity,qp.price,qp.sub_total,qp.discount,qp.total_amount,qp.qus_pro_id')
			->from('quotation_product AS qp')
			
			->where('qp.quo_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
		}
	public function old_company_logo($id)
	{
	
		$image_site_path = $this->db->select_max('c_logo')->where('c_id',$id)->limit(1)->get('tbl_company_profile')->row('c_logo');
		

    return $image_site_path;
	}
	public function find_user_password($id)
	{
	

		// $data = array();
		// $this->db->select('up.password')
		// 	->from('users_passwords AS up')
			
		// 	->where('up.user_id',$id);
		
		// $query = $this->db->get();
	
		
	
		
		// return $query;


		$this->db->select('up.password');
		$this->db->from('users_passwords AS up');
	
		$this->db->where('up.user_id',$id);

		$result = $this->db->get()->result();
		$data = array();

		foreach ($result as $row) {
			$data[ $row->password ] = $row->password;
		}

		return $data;
	}
	public function find_pass_update_date($id)
	{
	
	// $update_date = $this->db->select('updated_at')->where('user_id',$id)->get('users_passwords')->row('updated_at');
 //    return $update_date;



		$this->db->select('up.updated_at');
		$this->db->from('users_passwords AS up');
	
		$this->db->where('up.user_id',$id);

		$result = $this->db->get()->result();
	

		foreach ($result as $row) {
			$data = $row->updated_at;
		}

		return $data;
	}
	public function find_email_user_id($id)
	{
		$user_id = $this->db->select_max('user_id')->where('email',$id )->limit(1)->get('users')->row('user_id');
    	return $user_id;
	}
	public function find_user_last_password($id)
	{

		$this->db->select('up.password');
		$this->db->from('users_passwords AS up');
	
		$this->db->where('up.user_id',$id);

		$result = $this->db->get()->result();
	

		foreach ($result as $row) {
			$data = $row->password;
		}

		return $data;
	}
	public function find_log_user_role($id)
	{
		$auth_level = $this->db->select_max('auth_level')->where('user_id',$id )->limit(1)->get('users')->row('auth_level');
    	return $auth_level;
	}
	public function find_user_id_email($id)
	{
		$email = $this->db->select_max('email')->where('user_id',$id )->limit(1)->get('users')->row('email');
    	return $email;
	}
	public function find_user_id_password($id)
	{
		$email = $this->db->select_max('psname')->where('user_id',$id )->limit(1)->get('users')->row('psname');
    	return $email;
	}
	public function find_client_role($id)
	{

		// $ci =& get_instance();
		// $ci->db->from('tbl_client AS c1');   
  //   	$ci->db->where('c1.id',$id);
  //   	$result =  	$ci->db->get()->result();
		// foreach ($result as $row) {
		// 	$data = $row->assign_vender;
		// }
	
    	// return $data;

    	$role = $this->db->select_max('tbl_client.assign_vender')->where('tbl_client.id',$id )->from('tbl_client');
    	return $role;
	}

	function ClientRepdetails($id = '')
	{
		
		$this->db->select('cr.id,cr.rep_name,cr.email,cr.mobile,d.desgination_name')
		->from('tbl_client_rep AS cr')	
		->join('tbl_desgination d','d.desgination_id = cr.designation','left')
		
		->where('cr.client_id',$id);		

		$query=$this->db->get();
		
		return $query;		
	}
	function get_com_pany_email()
	{
		 $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['com_email'];
	}
	function get_com_pany_email_pass()
	{
		 $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['com_pass'];
	}
	function get_com_pany_ssl()
	{
		 $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['com_ssl'];
		
	}
	function GetCreditInvoiceDetails($id = '')
	{
		
		$this->db->select('cr.sal_id,cr.sal_order,cr.sal_grand_total,cr.paid_amount,cr.sal_created_on')
		->from('sales_order AS cr')			
		->where('cr.sal_company_name',$id)
		->where('cr.sal_invoice_status',1)
		->where('cr.payment_status',0);				

		$query=$this->db->get();
	
		return $query;		
	}
	function get_credit_notes_num($id)
	{ 
		$this->db->select('cr.credict_id,cr.credit_number,cr.balance_amount')
		->from('tbl_credicts_notes AS cr')			
		->where('cr.credict_id',$id)
		->where('cr.credict_note_delete_status',1);				

		$query=$this->db->get();
	
		return $query;	
	}
	
	public function find_invoice_paid_amount($id)
	{
	$invoice_total = $this->db->select_max('paid_amount')->where('sal_id',$id )->limit(1)->get('sales_order')->row('paid_amount');
    	return $invoice_total;
	}
	public function find_invoice_sal_grand_total($id)
	{
	$sal_grand_total = $this->db->select_max('sal_grand_total')->where('sal_id',$id )->limit(1)->get('sales_order')->row('sal_grand_total');
    	return $sal_grand_total;
	}
	public function find_credict_balance_amount($id)
	{
	$credit_balance = $this->db->select_max('balance_amount')->where('credict_id',$id )->limit(1)->get(' tbl_credicts_notes')->row('balance_amount');
    	return $credit_balance;
	}
	public function find_credict_total_amount($id)
	{
	$credit_total = $this->db->select_max('credict_total')->where('credict_id',$id )->limit(1)->get(' tbl_credicts_notes')->row('credict_total');
    	return $credit_total;
	}
}

