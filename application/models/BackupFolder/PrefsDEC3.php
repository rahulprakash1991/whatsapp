<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prefs extends CI_Model
{
    function __construct()
    {
        parent::__construct();      
        $pre        = array();
        $comp_pre   = array();
        $CI = &get_instance();

        if ($this->config->item("useDatabaseConfig"))
		{
            $pr = $this->db->get("tbl_preferences")->result();
            foreach($pr as $p)
            {
                $pre[addslashes($p->key)] = addslashes($p->key_value);
            } 

            $cpr = $this->db->get("tbl_company_profile")->result_array();
            foreach($cpr as $p)
            {
                $CI->comp_pre   = (object) $p;
            }
        }
        else
        {
            $pre        = (object) $CI->config->config;
            $comp_pre   = (object) $CI->config->config;
        }   

        $CI->pref       = (object) $pre;      
    } 

    public function getContactTypes($value='')
    {
        $this->db->select('*');
        $this->db->from('contact_types');
        $this->db->where('cont_status','1');
        $results = $this->db->get()->result();
        return $results;
    }

    function getInvoiceNo()
    {
        $pr = $this->db->get("tbl_preferences")->result();
        
        foreach($pr as $p)
        {
            $pre[addslashes($p->key)] = addslashes($p->key_value);
        }       
        return $pre['pro_inv_prefix'].$pre['pro_inv_number'].$pre['pro_inv_suffix'];
    }
    public function getCurrency()
    {
        $this->db->select('cr.cur_symbol');
        $this->db->from('tbl_company_profile AS d');
        $this->db->where('c_id','1');
        $this->db->join('tbl_currency cr', 'cr.cur_id = d.c_currency');
        $results = $this->db->get()->row_array();
        return $results['cur_symbol'];
    }
    
    public function getCurrencynew()
    {
        //$this->db->select('cr.currency');
        $this->db->select('cr.currency');
        $this->db->from('tbl_company_profile AS d');
        $this->db->where('c_id','1');
        $this->db->join('tbl_currency cr', 'cr.cur_id = d.c_currency');
        $results = $this->db->get()->row_array();
        return $results['currency'];
    }

    public function getTopTenSalesItem($value='')
    {
        $this->db->select('i.pro_item_name, u.unit_name, SUM(si.quantity) as sales_qty, SUM(si.sal_amount) as sales_amount', false);
        $this->db->from('sales_order_item as si');
        $this->db->join('tbl_pro_item as i', 'i.pro_item_id = si.pro_item_id', 'left');
        $this->db->join('tbl_unit as u', 'u.unit_id = i.unit_id', 'left');
        $this->db->group_by('si.pro_item_id');
        $this->db->order_by('sales_amount', 'DESC');
        $this->db->limit(10);
        $results = $this->db->get()->result();
        return $results;
    }

    public function getTopTenMovingItem($value='')
    {
        $this->db->select('i.pro_item_name, u.unit_name, SUM(si.quantity) as sales_qty, SUM(si.sal_amount) as sales_amount', false);
        $this->db->from('sales_order_item as si');
        $this->db->join('tbl_pro_item as i', 'i.pro_item_id = si.pro_item_id', 'left');
        $this->db->join('tbl_unit as u', 'u.unit_id = i.unit_id', 'left');
        $this->db->group_by('si.pro_item_id');
        $this->db->order_by('sales_qty', 'DESC');
        $this->db->limit(10);
        $results = $this->db->get()->result();
        return $results;
    }

    public function getGroupWiseSales($value='')
    {
        $this->db->select('g.pro_group_name, SUM(si.quantity) as sales_qty, SUM(si.sal_amount) as sales_amount', false);
        $this->db->from('sales_order_item as si');
        $this->db->join('tbl_pro_item as i', 'i.pro_item_id = si.pro_item_id', 'left');
        $this->db->join('tbl_pro_group as g', 'g.pro_group_id = i.pro_group_id', 'left');
        $this->db->group_by('i.pro_group_id');
        $this->db->order_by('sales_amount', 'DESC');
        $this->db->limit(10);
        $results = $this->db->get()->result();
        return $results;
    }
}
?>