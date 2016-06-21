<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_model extends CI_Model {

	function get_idjadwal()
	{
		$this->db->select("id");
		$this->db->from("generatorid");
		$this->db->where("idtype","idjadwal");
		$this->db->where("TO_DAYS(this_date)=TO_DAYS(now())");
		$query=$this->db->get();

		if($query->num_rows() <=0)
		{
			$this->db->set("id",1);
			$this->db->set("this_date","date(now())",FALSE);
			$this->db->where("idtype","idjadwal");
			$this->db->update("generatorid");
		}
		else
		{
			$this->db->where("idtype","idjadwal");
			$this->db->from("generatorid");
			$query2=$this->db->get();
			$row=$query2->row_array();
			$this->db->set("id",$row['id']."+1",FALSE);
			$this->db->where("idtype","idjadwal");
			$this->db->update("generatorid");
		}
		$this->db->select("id");
		$this->db->from("generatorid");
		$this->db->where("idtype","idjadwal");
		$query3=$this->db->get();
		$row2=$query3->row_array();
		//var_dump($row2);exit;
		return $row2;
	}

	function simpan_jadwal($params = array())
	{
		return $this->db->insert('jadwal', $params);
	}

	function get_jadwal_by_tgl($params = array())
	{
		$awal = $params['tgl_awal'];
		$akhir = $params['tgl_akhir'];
		$this->db->from('jadwal');
		$this->db->where('tanggal BETWEEN "'.$awal.'" AND "'.$akhir.'"');
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	function get_jadwal()
	{
		$this->db->from('jadwal');
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	function get_count_members()
	{
		$this->db->select('count(*) as count');
		$this->db->from('members');
		$this->db->where('status', 1);
		$this->db->or_where('status', 2);
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

}