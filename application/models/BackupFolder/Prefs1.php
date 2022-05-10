<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Prefs extends CI_Model
{
    function __construct()
    {
        parent::__construct();      
        $pre = array();
        $CI = &get_instance();

        if ($this->config->item("useDatabaseConfig")) 
		{
			
            $pr = $this->db->get("tbl_preferences")->result();
			
            foreach($pr as $p)
            {
                $pre[addslashes($p->key)] = addslashes($p->key_value);
            }       
        }
        else
        {
            $pre = (object) $CI->config->config;
        }   
        $CI->pref = (object) $pre;      
    } 

    public function getContactTypes($value='')
    {
        $this->db->select('*');
        $this->db->from('contact_types');
        $this->db->where('cont_status','1');
        $results = $this->db->get()->result();
        return $results;
    }
}
?>