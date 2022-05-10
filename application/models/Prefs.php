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
    //   public function getpayment_term($id)
    // {
    //     //$this->db->select('cr.currency');
    //     $this->db->select('d.payment_no_days');
    //     $this->db->from('tbl_payment_terms AS d');
    //     $this->db->where('d.payment_terms_id',$id);
    //     $results = $this->db->get()->row_array();
    //     return $results['payment_no_days'];
    // }

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
      public function getpayment_term($id)
    {
        //$this->db->select('cr.currency');
        $this->db->select('d.payment_terms');
        $this->db->from('tbl_payment_terms AS d');
        $this->db->where('d.payment_terms_id',$id);
        $results = $this->db->get()->row_array();
        return $results['payment_terms'];
    }
      public function getdelivery_data($id)
    {
        //$this->db->select('cr.currency');
        $this->db->select('va.vendor_address');
        $this->db->from('table_vendor_address AS va');
        $this->db->where('va.id',$id);
        $results = $this->db->get()->row_array();
        return $results['vendor_address'];
    }
    public function getvendor_designation_id($id)
    {
        $this->db->select('va.designation');
        $this->db->from('tbl_vendor_rep AS va');
        $this->db->where('va.rep_name',$id);
        $results = $this->db->get()->row_array();
        return $results['designation'];
    }
    public function getvendor_rep_designation($id)
    {
        $this->db->select('va.desgination_name');
        $this->db->from('tbl_desgination AS va');
        $this->db->where('va.desgination_id',$id);
        $results = $this->db->get()->row_array();
        return $results['desgination_name'];
    }
    public function getclient_rep_designation_id($id)
    {
        $this->db->select('va.designation');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.rep_name',$id);
        $results = $this->db->get()->row_array();
        return $results['designation'];
    }
     public function getclientrep_contact_num($id)
    {
        $this->db->select('va.mobile');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.rep_name',$id);
        $results = $this->db->get()->row_array();
        return $results['mobile'];
    }
     public function getclientrep_contact_num1($id)
    {
        $this->db->select('va.mobile1');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.rep_name',$id);
        $results = $this->db->get()->row_array();
        return $results['mobile1'];
    }
     public function getclientrep_email($id)
    {
        $this->db->select('va.email');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.rep_name',$id);
        $results = $this->db->get()->row_array();
        return $results['email'];
    }
      public function getclient_rep_title_id($id)
    {
        $this->db->select('va.title_id');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.rep_name',$id);
        $results = $this->db->get()->row_array();
        return $results['title_id'];
    }
      public function getclient_rep_title($id)
    {
        $this->db->select('va.titleName');
        $this->db->from('tbl_title AS va');
        $this->db->where('va.titleId',$id);
        $this->db->where('va.IsActive','1');
        $results = $this->db->get()->row_array();
        return $results['titleName'];
    }
    //march 14 
      public function getCurrencyQuotation($id='')
    {
        //$this->db->select('cr.currency');
        $this->db->select('c.iso_code');
        $this->db->from('tbl_currency AS c');
        $this->db->where('c.cur_id',$id);
     
        $results = $this->db->get()->row_array();
        return $results['iso_code'];
    }
        public function getCurrencyQuotationName($id='')
    {
        //$this->db->select('cr.currency');
        $this->db->select('c.cur_name');
        $this->db->from('tbl_currency AS c');
        $this->db->where('c.cur_id',$id);
     
        $results = $this->db->get()->row_array();
        return $results['cur_name'];
    }
      public function getCurrencyQuotationFraction($id='')
    {
        //$this->db->select('cr.currency');
        $this->db->select('c.unit');
        $this->db->from('tbl_currency AS c');
        $this->db->where('c.cur_id',$id);
     
        $results = $this->db->get()->row_array();
        return $results['unit'];
    }
     //April 5
     public function getclient_rep_title_id_inv($id)
    {
        $this->db->select('va.title_id');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.id',$id);
        $results = $this->db->get()->row_array();
        return $results['title_id'];
    }
    public function  getclient_rep_designation_id_inv($id)
    {
        $this->db->select('va.designation');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.id',$id);
        $results = $this->db->get()->row_array();
        return $results['designation'];
    }
      public function getclientrep_contact_num_inv($id)
    {
        $this->db->select('va.mobile');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.id',$id);
        $results = $this->db->get()->row_array();
        return $results['mobile'];
    }
     public function getclientrep_contact_num1_inv($id)
    {
        $this->db->select('va.mobile1');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.id',$id);
        $results = $this->db->get()->row_array();
        return $results['mobile1'];
    }
      public function getclientrep_email_inv($id)
    {
        $this->db->select('va.email');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.id',$id);
        $results = $this->db->get()->row_array();
        return $results['email'];
    }
     public function getclient_rep_name($id)
    {
        $this->db->select('va.  rep_name');
        $this->db->from('tbl_client_rep AS va');
        $this->db->where('va.id',$id);
        $results = $this->db->get()->row_array();
        return $results['rep_name'];
    }

    // May 7-2022
    public function get_currency_name($id)
    {
        $this->db->select('va.cur_name');
        $this->db->from('tbl_currency AS va');
        $this->db->where('va.cur_id',$id);
        $results = $this->db->get()->row_array();
        return $results['cur_name'];
    }
    public function get_currency_iso($id)
    {
        $this->db->select('va.iso_code');
        $this->db->from('tbl_currency AS va');
        $this->db->where('va.cur_id',$id);
        $results = $this->db->get()->row_array();
        return $results['iso_code'];
    }
}
?>