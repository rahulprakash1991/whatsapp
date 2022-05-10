<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
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
		$this->db->update($table , $data , $where_array);
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

	public function set_pref_no($table,$field)
	{
	  	$this->db->set('key_value','key_value+'.'1', FALSE);
	  	$this->db->where('key',$field);
		$this->db->update($table);
		
		return TRUE;
	}

	
   
   
}







