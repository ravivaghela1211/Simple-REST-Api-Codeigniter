<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Usermodel extends CI_Model{

	function __construct()
	{
		$this->load->database();
	}
	public function getData($table,$id=0)
	{
		if(!empty($id))
		{
			return $this->db->get_where($table,array('id'=>$id))->result();
			
		}
		else{
			return $this->db->get('users')->result();
		}
		
	}
	public function deleteData($table,$id=0)
	{
		if(!empty($id))
		{
			$delete=$this->db->delete($table,array('id'=>$id));
			return $delete?true:false;	
		}
		else{
			return $this->db->get('users')->result();
		}	
	}
	public function insertData($table,$data)
	{
	 return $this->db->insert($table,$data);	
	}

	public function updateData($table,$data,$where,$id)
	{
	 return $this->db->where($where,$id)->update($table,$data);	
	}

}
