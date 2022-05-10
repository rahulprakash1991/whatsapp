<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quotation_model extends CI_Model
{
	function get_data_product($id)
	{ 
		$data = array();
		$this->db->select('s.quo_item, s.quo_id, p.pro_item_name, p.pro_item_id, p.pieces_per_unit, s.unit, s.price_amt, s.quantity, s.quo_amount as amount, t.tax_id, t.tax_name, t.tax_percent, p.pro_item_stock AS available_qty')
			->from('quotation_item AS s')
			->join('quotation so', 'so.quo_id = s.quo_id', 'left')
			->join('tbl_pro_item p', 'p.pro_item_id = s.quo_item_id', 'left')
			->join('tbl_tax t', 't.tax_id = p.tax_id', 'left')
			->join('tbl_unit u', 'u.unit_id = s.unit', 'left')
			->where('s.quo_id', $id);
		
		$query 	= $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}
		
	function getQuotationNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['quo_prefix'].$pre['quo_number'].$pre['quo_suffix'];
    }

	public function set_pref_no($table,$field)
	{
	  	$this->db->set('key_value','key_value+'.'1', FALSE);
	  	$this->db->where('key',$field);
		$this->db->update($table);
		
		return TRUE;
	}
	
	function get_company_detail($id)
	{ 
		$this->db->select('s.quo_id, s.quo_company_name')
		->from('quotation AS s')
		->where('s.quo_id',$id);
		$query=$this->db->get()->row_array();
		return $query['quo_company_name'];
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

	function quotation_tax($id)
	{ 
		$data = array();
		$this->db->select('s.tbl_tax_id, s.quo_tax_amount, t.tax_name')
			->from('quotation_tax AS s')
			->join('tbl_tax t','t.tax_id = s.quo_tax_id')
			->where('s.quo_id',$id);
		$query = $this->db->get();
		$result = $query->result();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		
		return $data;
	}

	function menu_terms($id)
    {
		$this->db->select('payment_terms_id,payment_no_days')
		->from('tbl_payment_terms')
		->where('payment_terms_id',$id);
		$query=$this->db->get();
		$result = $query->row_array();
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
}
