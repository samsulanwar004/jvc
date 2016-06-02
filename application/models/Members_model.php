<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_model extends CI_Model {

	function simpan_member($params = array())
	{
		return $this->db->insert('members', $params);
	}

	function get_member($id_member)
	{
		$this->db->from('members');
		$this->db->where('id_member', $id_member);
		$this->db->limit(1);
		$query 	= $this->db->get();
		$result = $query->row();

		return $result;
	}

	function get_idmember()
	{
		$this->db->select("id");
		$this->db->from("generatorid");
		$this->db->where("idtype","idmember");
		$this->db->where("TO_DAYS(this_date)=TO_DAYS(now())");
		$query=$this->db->get();

		if($query->num_rows() <=0)
		{
			$this->db->set("id",1);
			$this->db->set("this_date","date(now())",FALSE);
			$this->db->where("idtype","idmember");
			$this->db->update("generatorid");
		}
		else
		{
			$this->db->where("idtype","idmember");
			$this->db->from("generatorid");
			$query2=$this->db->get();
			$row=$query2->row_array();
			$this->db->set("id",$row['id']."+1",FALSE);
			$this->db->where("idtype","idmember");
			$this->db->update("generatorid");
		}
		$this->db->select("id");
		$this->db->from("generatorid");
		$this->db->where("idtype","idmember");
		$query3=$this->db->get();
		$row2=$query3->row_array();
		//var_dump($row2);exit;
		return $row2;
	}
}