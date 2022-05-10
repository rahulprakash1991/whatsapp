<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdropdown extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

   /* function drop_menu_category()
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
    } */

    function drop_menu_role()
    {
    	$this->db->select('r.role_id,r.role_name');
		$this->db->from('tbl_user_role AS r');
		$this->db->where( array('r.role_status' => '1', 'r.role_delete_status' => '0'));
		$query=$this->db->get();
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->role_id] = $item->role_name;
		}
      return $options;
    }

    function drop_menu_unit1()
    {
    	$this->db->select('p.unit_id,u.unit_name,p.pro_item_id');
		$this->db->from('tbl_pro_item AS p');
		$this->db->join('tbl_unit u','u.unit_id = p.unit_id');
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
		$this->db->where('tax_status', '1');
		$this->db->where('tax_delete_status', '1');
		$query=$this->db->get('tbl_tax');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->tax_id] = $item->tax_name;
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
 
    function drop_menu_tax1()
    {
		$this->db->select('tax_id, tax_name');		
		$this->db->order_by('tax_name', 'ASC');
		$this->db->where('tax_status', '1');
		$this->db->where('tax_delete_status', '1');
		$query=$this->db->get('tbl_tax');
		$result = $query->result();
		
      return $result;
    } 

    function drop_menu_contact_group()
    {
		$this->db->select('cg_id, cg_name');		
		$this->db->order_by('cg_id', 'ASC');
		$this->db->where('cg_status', '1');
		$this->db->where('cg_delete_status', '1');
		$query=$this->db->get('tbl_contact_group');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->cg_id] = $item->cg_name;
		}
      return $options;
    }

    function drop_menu_department()
    {
		$this->db->select('department_id, department_name');		
		$this->db->order_by('department_id', 'ASC');
		$this->db->where('department_status', '1');
		$this->db->where('department_delete_status', '1');
		$query=$this->db->get('tbl_department');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->department_id] = $item->department_name;
		}
      return $options;
    }
      function drop_menu_vendorManagemet()
    {
		$this->db->select('id, vendor_id_name');		
		$this->db->order_by('id', 'ASC');
		$this->db->where('vendor_id_status', '1');
		$this->db->where('vendor_id_delete_status', '1');
		$query=$this->db->get('vendor_id_management');
		$result = $query->result();
		$options[''] = '-- Select Vendor Name --' ;
		foreach($result as $item)
		{
			$options[$item->id] = $item->vendor_id_name;
		}
      return $options;
    }
    function drop_menu_mode()
    {
		$this->db->select('id,name');		
		$this->db->order_by('id', 'ASC');
		$query=$this->db->get('contact_mode');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->id] = $item->name;
		}
      return $options;
    }
function drop_menu_title()
    {
		$this->db->select('id,name');		
		$this->db->order_by('id', 'ASC');
		$query=$this->db->get('titles');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->id] = $item->name;
		}
      return $options;
    }
    function drop_menu_designation()
    {
		$this->db->select('desgination_id,desgination_name');		
		$this->db->order_by('desgination_id', 'ASC');
		$this->db->where('desgination_status', '1');
		$this->db->where('desgination_delete_status','1');
		$query=$this->db->get('tbl_desgination');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->desgination_id] = $item->desgination_name;
		}
      return $options;
    }
    function drop_menu_client_rep()
    {
		$this->db->select('id,rep_name');		
		$this->db->order_by('id', 'ASC');
		$query=$this->db->get('tbl_client_rep');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->id] = $item->rep_name;
		}
      return $options;
    }
    function drop_menu_contact()
    {
		$this->db->select('con_id, con_type,con_company_name');		
		$this->db->order_by('con_id', 'ASC');
		$this->db->where('con_status', '1');
		$this->db->where('con_delete_status', '1');
		$query=$this->db->get('tbl_contacts');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->con_id] = $item->con_company_name;
		}
      return $options;
    }

    function drop_menu_vendor()
    {
		$this->db->select('vendor_name,id');	
		$this->db->where('vendor_delete_status', '1');
		$query=$this->db->get('tbl_vendor');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->id] = $item->vendor_name;
		}
      return $options;
    }
    
    function drop_menu_customer()
    {
		$this->db->select('con_company_name,con_id, con_type');	
		$this->db->where('con_type','1');
		$this->db->where('con_status', '1');
		$this->db->where('con_delete_status', '1');
		$query=$this->db->get('tbl_contacts');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->con_id] = $item->con_company_name;
		}
      return $options;
    }
    
    function drop_menu_payment_mode()
    {
		$this->db->select('payment_mode_id, payment_mode');		
		$this->db->order_by('payment_mode', 'ASC');
		$this->db->where('pay_status', '1');
		$this->db->where('payment_delete_status', '1');
		$query=$this->db->get('tbl_payment_mode');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->payment_mode_id] = $item->payment_mode;
		}
      return $options;
    }
    
    function drop_menu_expenses()
    {
    	$this->db->select('expenses_id, expenses');
    	$this->db->order_by('expenses','ASC');
    	$this->db->where('expenses_status', '1');
    	$this->db->where('expenses_delete_status','1');
    	$query=$this->db->get('other_expenses');
    	$result=$query->result();
    	$options['']='-- Select Expense --';
    	foreach($result as $item)
    	{
    		$options[$item->expenses_id]=$item->expenses;
    	}
    	return $options;
    } 
    
    function drop_menu_bank()
    {
		$this->db->select('bank_id, bank_name');		
		$this->db->order_by('bank_name', 'ASC');
		$this->db->where('bank_status', '1');
		$this->db->where('bank_delete_status', '1');
		$query=$this->db->get('tbl_bank_details');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->bank_id] = $item->bank_name;
		}
      return $options;
    } 
 
    function drop_menu_item()
    {
		$this->db->select('item_id, item_rate');	
		$query=$this->db->get('item_rate_as');
		//$this->db->where('payment_delete_status', '1');
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
		$this->db->select('pro_item_id, pro_item_name, pro_item_code');
		$this->db->where('prduct_delete_status','1');
		$this->db->where('pro_item_status','1');		
		$query=$this->db->get('tbl_pro_item');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->pro_item_id] = $item->pro_item_code .' - '. $item->pro_item_name;
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
		$this->db->where('cur_status','1');
		$this->db->where('currency_delete_status','1');
		$query=$this->db->get('tbl_currency');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->cur_id] = $item->cur_name;
		}
      		return $options;
    }

	function drop_menu_terms()
    {
		$this->db->select('payment_terms_id, payment_terms');
		$this->db->where('payment_delete_status','1');		
		$this->db->where('payment_status','1');
		$query=$this->db->get('tbl_payment_terms');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->payment_terms_id] = $item->payment_terms;
		}
     		 return $options;
    }

	function drop_menu_product( $category_id = '' )
    {
		$this->db->select('pro_group_id, pro_group_name');
		$this->db->order_by('pro_group_name', 'ASC');
		$this->db->where('pro_group_status','1');
		$this->db->where('pro_group_delete_status','1');
		if ($category_id) {
			$this->db->where('category_id', $category_id);
		}
		$query=$this->db->get('tbl_pro_group');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->pro_group_id] = $item->pro_group_name;
		}

    	return $options;
    } 
    function drop_menu_client( $id = '' )
    {
		$this->db->select('id, client_name');
		$this->db->order_by('id', 'ASC');
		$this->db->where('client_delete_status','1');
		if ($id) {
			$this->db->where('id', $id);
		}
		$query=$this->db->get('tbl_client');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->id] = $item->client_name;
		}

    	return $options;
    } 
    function drop_menu_client1( $id = '' )
    {
		$this->db->select('id, client_name');
		$this->db->order_by('id', 'ASC');
		$this->db->where('client_delete_status','1');
		if ($id) {
			$this->db->where('id', $id);
		}
		$query=$this->db->get('tbl_client');
		$result = $query->result();
		foreach($result as $item)
		{
			$options[$item->id] = $item->client_name;
		}

    	return $options;
    } 
		
	function drop_menu_category()
	{
		$this->db->select('category_id, category_name');		
		$this->db->order_by('category_name', 'ASC');
		$this->db->where('category_status','1');	
		$this->db->where('category_delete_status','1');	
		$query=$this->db->get('tbl_category');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		
		foreach($result as $item)
		{
			$options[$item->category_id] = $item->category_name;
		}
		
		return $options;
	}

	function drop_menu_unit()
    {
		$this->db->select('unit_id, unit_name');		
		$this->db->order_by('unit_name', 'ASC');
		$this->db->where('unit_status', '1');
		$this->db->where('unit_delete_status', '1');
		$query=$this->db->get('tbl_unit');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->unit_id] = $item->unit_name;
		}
     		 return $options;
   	}

   	function drop_menu_productitem()
	{
		$this->db->select('pro_item_id, pro_item_name');		
		$this->db->order_by('pro_item_id', 'ASC');
		$this->db->where('pro_item_status', '1');
		$this->db->where('prduct_delete_status', '1');
		$query=$this->db->get('tbl_pro_item');
		$result = $query->result();
		$options[''] = '-- Select --' ;
		foreach($result as $item)
		{
			$options[$item->pro_item_id] = $item->pro_item_name;
		}
	     		 return $options;
   	 }
   	}