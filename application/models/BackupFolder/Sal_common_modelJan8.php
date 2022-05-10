<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sal_common_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
		
	
	function clean_url($string)
    {
        $url=strtolower($string);
        $url=str_replace(array("'",'"'), '', $url);
        $url=str_replace(array(' ','+', '!', '&','-','/'), '-', $url);
        $url=str_replace("?", "", $url);
        $url=str_replace("---", "-", $url);
        $url=str_replace("--", "-", $url);
        return $url;
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

	public function specific_record_counts($table,$constraint_array)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($constraint_array);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}

	public function specific_row_value($table,$constraint_array='',$get_field)
	{
		$this->db->select($get_field);
		$this->db->from($table);
		if(!empty($constraint_array))
		{
			$this->db->where($constraint_array);	
		}
		$result= $this->db->get()->row_array();
		return $result[$get_field];
	}
	
	public function records_all($table,$constraint_array='')
	{
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($constraint_array))
		{
			$this->db->where($constraint_array);	
		}
		$results= $this->db->get()->result();
		return $results;
	}
	
	function get_fulldata($table,$constraint_array)
	{
		$query = $this->db->get_where($table,$constraint_array,1);
		return $query;

	}

	public function common_insert($table,$data)
	{
	    $this->db->insert($table, $data);
		$result = $this->db->insert_id();
		return $result;
	}
	
	function common_edit($table,$data,$where_array)
	{
		$this->db->update($table, $data, $where_array);
		$result = $this->db->affected_rows();
		return $result;	
	}


	function common_edit1($table,$data,$where_array)
	{
		$result =  $this->db->update($table , $data , $where_array);
		return $result;	
	}
		
	public function common_delete($table,$where_array)
	{
	   return $this->db->delete($table, $where_array);
	}

    function drop_menu_category()
    {
		$this->db->select('c_id, c_name');
		$this->db->where('c_delistatus','0');
		$this->db->where('c_status','1');
		$this->db->order_by('c_order', 'ASC');
		$query=$this->db->get('category');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->c_id] = $item->c_name;
		}
      return $options;
    } 
    function drop_menu_salutation()
    {
		$this->db->select('sal_id, sal_name');		
		$this->db->order_by('sal_name', 'ASC');
		$query=$this->db->get('tbl_salutation');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->sal_id] = $item->sal_name;
		}
      return $options;
    } 
    function drop_menu_currency()
    {
		$this->db->select('cur_id, cur_name');		
		$this->db->order_by('cur_name', 'ASC');
		$this->db->where('currency_delete_status','0');

		$query=$this->db->get('tbl_currency');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->cur_id] = $item->cur_name;
		}
      return $options;
    } 

    function drop_menu_CreditPeriod()
    {
		$this->db->select('payment_terms_id, payment_no_days');
			
		$this->db->order_by('payment_terms', 'ASC');
		$this->db->where('payment_delete_status','0');
		$query=$this->db->get('tbl_payment_terms');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->payment_terms_id] = $item->payment_no_days;
		}
      return $options;
    }
    function drop_menu_product()
    {
		$this->db->select('pro_group_id, pro_group_name');		
		$this->db->order_by('pro_group_name', 'ASC');
		$this->db->where('pro_group_delete_status','0');	

		$query=$this->db->get('tbl_pro_group');

		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->pro_group_id] = $item->pro_group_name;
		}
      return $options;
    } 
    function drop_menu_unit()
    {
		$this->db->select('unit_id, unit_name');		
		$this->db->order_by('unit_name', 'ASC');
		$this->db->where('unit_status', '1');
		$this->db->where('unit_delete_status','0');	
		$query=$this->db->get('tbl_unit');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->unit_id] = $item->unit_name;
		}
      return $options;
    }

    function drop_menu_unit1()
    {
    	$this->db->select('p.unit_id,u.unit_name,p.pro_item_id');
		$this->db->from('tbl_pro_item AS p');
		$this->db->join('tbl_unit u','u.unit_id = p.unit_id');
		$this->db->where('prduct_delete_status','0');	
	
		$query=$this->db->get();
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->unit_id] = $item->unit_name;
		}
      return $options;
    } 
    function drop_menu_tax()
    {
		$this->db->select('tax_id, tax_name');		
		$this->db->order_by('tax_name', 'ASC');
		$this->db->where('tax_delete_status', '0');
		$query=$this->db->get('tbl_tax');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->tax_id] = $item->tax_name;
		}
      return $options;
    } 
    function drop_menu_tax1()
    {
		$this->db->select('tax_id, tax_name');		
		$this->db->order_by('tax_name', 'ASC');
		$this->db->where('tax_delete_status', '0');
		$query=$this->db->get('tbl_tax');
		$result = $query->result();
		
      return $result;
    } 
    function drop_menu_contact()
    {
		$this->db->select('con_id, con_type,con_company_name');		
		$this->db->order_by('con_id', 'ASC');
		$this->db->where('con_status', '1');
		$this->db->where('con_delete_status','0');	

		$query=$this->db->get('tbl_contacts');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->con_id] = $item->con_company_name;
		}
      return $options;
    }
     function drop_menu_address($id)
    {
		$this->db->select('con_id,tbl_id,sal_address');		
		$this->db->order_by('sal_address', 'ASC');
		$this->db->where('con_id', $id);
		$query=$this->db->get('tbl_address');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->sal_address] = $item->sal_address;
		}
      return $options;
    }
     function drop_menu_client_rep($id = '')
    {
		$this->db->select('client_id,rep_name');		
		$this->db->order_by('rep_name', 'ASC');
		if($id)
		{
			$this->db->where('client_id', $id);
		}
		
		$query=$this->db->get('tbl_client_rep');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->rep_name] = $item->rep_name;
		}
      return $options;
    }
	
      function drop_menu_address1()
    {
		$this->db->select('con_id,tbl_id,sal_address');		
		$this->db->order_by('sal_address', 'ASC');
		$query=$this->db->get('tbl_address');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->sal_address] = $item->sal_address;
		}
      return $options;
    }

    function drop_menu_vendor()
    {
		$this->db->select('con_company_name,con_id, con_type');	
		$this->db->where('con_type','1');	
		$this->db->where('con_delete_status','0');	
		$query=$this->db->get('tbl_contacts');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->con_id] = $item->con_company_name;
		}
      return $options;
    }
    function drop_menu_item()
    {
		$this->db->select('item_id, item_rate');	
		$query=$this->db->get('item_rate_as');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->item_id] = $item->item_rate;
		}
      return $options;
    }
    function drop_menu_product_item()
    {
		$this->db->select('pro_item_id, pro_item_name');
		$this->db->where('pro_item_status','1');	
		$query=$this->db->get('tbl_pro_item');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->pro_item_id] = $item->pro_item_name;
		}
      return $options;
    }
    function drop_menu_ship_pref()
    {
		$this->db->select('ship_pref_id, ship_pre_type');	
		$query=$this->db->get('shipment_preferences');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->ship_pref_id] = $item->ship_pre_type;
		}
      return $options;
    }
    
    function drop_menu_terms()
    {
		$this->db->select('payment_terms_id, payment_no_days');
		$this->db->where('payment_delete_status','0');		
		
		$query=$this->db->get('tbl_payment_terms');

		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->payment_terms_id] = $item->payment_no_days;
		}
      return $options;
    } 
    function get_dataheadhead($id)
	{
		$this->db->select('s.pro_item_id,s.pro_item_name,s.pro_item_sell_price,s.tax_id,t.tax_id,t.tax_name,t.tax_percent AS total_tax_amt,s.unit_id,s.pro_item_stock')
		->from('tbl_pro_item AS s')
		->where('pro_item_id',$id)
		->join('tbl_tax t','t.tax_id = s.tax_id');
		
		$query=$this->db->get();
		$result = $query->row_array();
		return $result;
	}

	  function get_address1($id)
	{
		$this->db->select('s.tbl_id,s.sal_address')
		->from('tbl_address AS s')
		->where('s.con_id',$id);
		$query = $this->db->get();
		
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function get_data1($id)
	{
		$data = array();
		$this->db->select('s.pro_item_id,s.pro_item_name,s.pro_item_sell_price,s.tax_id,t.tax_id,t.tax_name,t.tax_percent ')
		->from('tbl_pro_item AS s')
		->where('pro_item_id',$id)
		->join('tbl_tax t','t.tax_id = s.tax_id');
		
		$query=$this->db->get();
		$result = $query->result();

			
		return $result;
	}
	function get_data($id)
	{
		$this->db->select('s.pro_item_id,s.pro_item_name,s.pro_item_sell_price,t.tax_id,t.tax_name,t.tax_percent AS total_tax_amt,s.unit_id,s.pro_item_stock')
		->from('tbl_pro_item AS s')
		->where('pro_item_id',$id)
		->join('tbl_tax t','t.tax_id = s.tax_id', 'left');
		
		$query=$this->db->get();
		$result = $query->row_array();
		return $result;
	}


    function get_data_product($id)
	{ 
		$data = array();
$this->db->select('s.sal_item_id,s.sal_id,s.item_description, s.nationality,s.total,s.total_hour,s.rate_hour,s.total_cost,s.	sl_no,s.qty,s.unit_price,s.uniteng,s.item_description_arabic')
			->from('sales_order_item AS s')
			->join('sales_order so','so.sal_id = s.sal_id', 'left')
		
			->where('s.sal_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function get_data_proforma_product1($id)
	{ 
		$data = array();
$this->db->select('s.per_sal_item_id,s.per_sal_id,s.item_description, s.nationality,s.total,s.total_hour,s.rate_hour,s.total_cost,s.	sl_no,s.qty,s.unit_price,s.uniteng,s.item_description_arabic')
			->from('per_sales_order_item AS s')
			->join('per_sales_order so','so.per_sal_id = s.per_sal_id', 'left')
		
			->where('s.per_sal_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

    function get_data_product1($id)
	{ 
		$data = array();
		$this->db->select('s.sal_item_id, s.sal_id, s.item_description,s.item_description_arabic,s.nationality,s.total,s.total_hour,s.rate_hour,s.total_cost,s.sl_no,s.qty,s.unit_price,s.uniteng,s.unitarabic')
			->from('sales_order_item AS s')
		
			->where('s.sal_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	 function get_data_proforma_product($id)
	{ 
		$data = array();
		$this->db->select('s.per_sal_item_id, s.per_sal_id, s.item_description,s.item_description_arabic,s.nationality,s.total,s.total_hour,s.rate_hour,s.total_cost,s.sl_no,s.qty,s.unit_price,s.uniteng,s.unitarabic')
			->from('per_sales_order_item AS s')
		
			->where('s.per_sal_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	
    function get_data_product11($id)
	{ 
		$data = array();
		$this->db->select('s.sal_item_id, s.sal_id, s.item_description,s.item_description_arabic,s.uniteng,s.unitarabic,s.	qty,s.unit_price,s.total_cost')
			->from('sales_order_item AS s')
		
			->where('s.sal_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	 function get_pro_item($id,$data)
	{ 
		
		$this->db->select('s.pro_item_id,s.pro_item_stock AS pro_item_stock')
		->from('tbl_pro_item AS s')
		->where('s.pro_item_id',$id);
		$query=$this->db->get()->row_array();
	
		return $data=$query['pro_item_stock']-$data;

	}	
	
	function get_pro_item1($id, $qty)
	{ 
		
		$this->db->select('s.pro_item_id')
		->from('tbl_pro_item AS s')
		->where('s.pro_item_id',$id)
		->where('s.pro_item_stock >=',$qty);
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
	function get_company_detail($id)
	{ 
		
		$this->db->select('s.sal_id,s.sal_company_name')
		->from('sales_order AS s')
		->where('status','1')
		->where('s.sal_id',$id);

		$query=$this->db->get()->row_array();
		return $query['sal_company_name'];
	}
	
	function add_post(){
	   $this->db->from('tbl_contacts');
	   $insert_id = $this->db->insert_id();

	   return  $insert_id;
	}
    function get_address($id)
	{ 
		$data = array();
		$this->db->select('s.tbl_id,s.sal_address')
			->from('tbl_address AS s')
			->where('s.con_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	

	 
	 function adddate($sal_order)
	{
		$this->db->select('DATE_ADD(sal_order_date,INTERVAL sal_credit_period DAY) as sal_next_duedate')
		->from('sales_order')
		->where('status','1')
		->where('sal_order',$sal_order);
		
			$query=$this->db->get()->row_array();
	
		return $data=$query['sal_next_duedate'];
	}
	function sales_order_tax($id)
	{ 
		$data = array();
		$this->db->select('s.tbl_tax_id,s.sal_tax_amount,t.tax_name')
			->from('sales_order_tax AS s')
			->join('tbl_tax t','t.tax_id = s.sal_tax_id')
			->where('s.sal_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	 function payment_detail($id)
	{ 
		$data = array();
		$this->db->select('s.payment_id,u.sal_person,s.date,s.invoice_id,s.amount,s.payment_mode,s.transaction_number,s.transaction_date,s.transaction_date,s.transaction_bank_name,s.transaction_bank_name,t.payment_terms AS account_heads')
			->from('sal_payment AS s')
			->join('sales_order u', 'u.sal_id = s.invoice_id')
			->join('tbl_payment_terms t', 't.payment_terms_id = s.account_heads')
			->where('s.invoice_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	
	function get_po_details($id)
	{
		
		$this->db->select('s.sal_company_name,c.con_company_name as sal_company_name1,p.pro_item_name,u.unit_name,so.quantity,so.price_amt,s.sal_order_date')
		->from('sales_order_item AS so')	
		->join('sales_order s','s.sal_id = so.sal_id')
		->join('tbl_contacts c','c.con_id = s.sal_company_name')
		->join('tbl_pro_item p','p.pro_item_id = so.pro_item_id')
		->join('tbl_unit u','u.unit_id = so.unit')
		->where('so.sal_item_id',$id)		
		->order_by('so.sal_item_id','DESC');
		$this->db->limit(3);

		$query=$this->db->get();
		$result = $query->result();
		return $result;
		
	}
	function get_paid_amount($id)
	{ 
		
		$this->db->select('sum(s.amount) As amount')
		->from('sal_payment AS s')
		->where('s.invoice_id',$id);
		$query=$this->db->get()->row_array();
	
		return $data=$query['amount'];

	}	

	public function set_pref_no($table,$field)
	{
	  	$this->db->set('key_value','key_value+'.'1', FALSE);
	  	$this->db->where('key',$field);
		$this->db->update($table);
		
		return TRUE;
	}
	
	public function getInvoiceNo()
	{
		$pr = $this->db->get("tbl_preferences")->result();
		foreach ($pr as $p) {
						$pre[addslashes($p->key)] = addslashes($p->key_value);
		}
		return $pre['inv_prefix'] . $pre['inv_number'] . $pre['inv_suffix'];
	}
	public function getInvoiceDraftNo()
	{
		$pr = $this->db->get("tbl_preferences")->result();
		foreach ($pr as $p) {
						$pre[addslashes($p->key)] = addslashes($p->key_value);
		}
		return $pre['inv_prefix_draft'] . $pre['inv_number_draft'] . $pre['inv_suffix_draft'];
	}
	public function GetProformaNo()
	{
		$pr = $this->db->get("tbl_preferences")->result();
		foreach ($pr as $p) {
						$pre[addslashes($p->key)] = addslashes($p->key_value);
		}
		return $pre['pro_inv_prefix'] . $pre['pro_inv_number'] . $pre['pro_inv_suffix'];
	}

	function menu_terms($id)
    {
		$this->db->select('payment_terms_id,payment_no_days')
		->from('tbl_payment_terms')
		->where('payment_delete_status','1')
		->where('payment_terms_id',$id);
		
		$query=$this->db->get();
		$result = $query->row_array();
		return $result;
    } 
    function tbl_preferences()
	{
		$where = "s.pre_id='18' or s.pre_id='19'";
			$this->db->select('s.pre_id,s.key,s.key_value')
			->from(' tbl_preferences AS s')
			->where($where);
			
		
			$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function getLength($value) {
    return strlen($value); 
}

function toHex($value) {
    return pack("H*", sprintf("%02X", $value));
}

function  toString($tag, $value, $length) {
    $value = (string) $value;
    return $this->toHex($tag) . $this->toHex($length) . $value;
}

function getTLV($dataToEncode) {
    $TLVS = '';
    for ($i = 0; $i < count($dataToEncode); $i++) {
        $tag = $dataToEncode[$i][0];
        $value = $dataToEncode[$i][1];
        $length = $this->getLength($value);
        $TLVS .= $this->toString($tag, $value, $length);
    }
    return $TLVS;
}
function get_bank_id($id)
	{ 
		
		$this->db->select('s.sal_id,s.sal_bank')
		->from('sales_order AS s')
		->where('status','1')
		->where('s.sal_id',$id);

		$query=$this->db->get()->row_array();
		return $query['sal_bank'];
	}
	function get_proforma_bank_id($id)
	{ 
		
		$this->db->select('s.per_sal_id,s.sal_bank')
		->from('per_sales_order AS s')
		->where('status','1')
		->where('s.per_sal_id',$id);

		$query=$this->db->get()->row_array();
		return $query['sal_bank'];
	}
	public function getPer_CriditNoteNo()
	{
		$pr = $this->db->get("tbl_preferences")->result();
		foreach ($pr as $p) {
						$pre[addslashes($p->key)] = addslashes($p->key_value);
		}
		return $pre['per_credit_prefix'] . $pre['per_credit_number'] ;
	}
	public function getCriditNoteNo()
	{
		$pr = $this->db->get("tbl_preferences")->result();
		foreach ($pr as $p) {
						$pre[addslashes($p->key)] = addslashes($p->key_value);
		}
		return $pre['credit_prefix'] . $pre['credit_number'] ;
	}
	   function drop_menu_invoice_no($id = '')
    {
		$this->db->select('sal_company_name,sal_order,sal_id');		
		$this->db->order_by('sal_id', 'ASC');
		if($id)
		{
			$this->db->where('sal_company_name', $id);
		}
		$this->db->where('sal_invoice_status','1');
		$query=$this->db->get('sales_order');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->sal_id] = $item->sal_order;
		}
      return $options;
    }
    public function find_invoice_total($id)
	{
	$invoice_total = $this->db->select_max('sal_grand_total')->where('sal_id',$id )->limit(1)->get('sales_order')->row('sal_grand_total');
    	return $invoice_total;
	}
	public function find_invoice_vat_per($id)
	{
	$vat_per = $this->db->select_max('vat_per')->where('sal_id',$id )->limit(1)->get('sales_order')->row('vat_per');
    	return $vat_per;
	}
	public function find_invoice_vat_amount($id)
	{
	$vat_amount = $this->db->select_max('sal_tax_amount')->where('sal_id',$id )->limit(1)->get('sales_order')->row('sal_tax_amount');
    	return $vat_amount;
	}
	public function find_invoice_type($id)
	{
	$shiping_type = $this->db->select_max('shiping_type')->where('sal_id',$id )->limit(1)->get('sales_order')->row('shiping_type');
    	return $shiping_type;
	}
	public function find_invoice_sub_total($id)
	{
	$sal_sub_total = $this->db->select_max('sal_sub_total')->where('sal_id',$id )->limit(1)->get('sales_order')->row('sal_sub_total');
    	return $sal_sub_total;
	}
	function get_invoice_saleorder_id($id)
	{ 
		
		$this->db->select('cn.credict_id,cn.salesorder_id')
		->from('tbl_credicts_notes AS cn')
		->where('credict_note_delete_status','1')
		->where('cn.credict_id',$id);

		$query=$this->db->get()->row_array();
		return $query['salesorder_id'];
	}
	 function get_credict_notes_items($id)
	{ 
		$data = array();
		$this->db->select('cn.credict_item_id,cn.credict_id,cn.item_description,cn.item_description_arabic,cn.qty,cn.unit_price,cn.total')
			->from('tbl_credictnotes_item AS cn')
		
			->where('cn.credict_id',$id);
		
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
	function get_invoice_client_id($id)
	{ 
		
		$this->db->select('cn.credict_id,cn.client_id')
		->from('tbl_credicts_notes AS cn')
		->where('credict_note_delete_status','1')
		->where('cn.credict_id',$id);

		$query=$this->db->get()->row_array();
		return $query['client_id'];
	}
}






