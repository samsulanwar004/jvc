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

	function get_idjabatan()
	{
		$this->db->select("id");
		$this->db->from("generatorid");
		$this->db->where("idtype","idjabatan");
		$this->db->where("TO_DAYS(this_date)=TO_DAYS(now())");
		$query=$this->db->get();

		if($query->num_rows() <=0)
		{
			$this->db->set("id",1);
			$this->db->set("this_date","date(now())",FALSE);
			$this->db->where("idtype","idjabatan");
			$this->db->update("generatorid");
		}
		else
		{
			$this->db->where("idtype","idjabatan");
			$this->db->from("generatorid");
			$query2=$this->db->get();
			$row=$query2->row_array();
			$this->db->set("id",$row['id']."+1",FALSE);
			$this->db->where("idtype","idjabatan");
			$this->db->update("generatorid");
		}
		$this->db->select("id");
		$this->db->from("generatorid");
		$this->db->where("idtype","idjabatan");
		$query3=$this->db->get();
		$row2=$query3->row_array();
		//var_dump($row2);exit;
		return $row2;
	}

	function simpan_jadwal($params = array())
	{
		return $this->db->insert('jadwal', $params);
	}

	function simpan_jabatan($params = array())
	{
		return $this->db->insert('jabatan', $params);
	}

	function simpan_noreg($params = array())
	{
		return $this->db->insert('noreg', $params);
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
		$this->db->order_by('id_jadwal', 'DESC');
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	function get_jabatan()
	{
		$this->db->from('jabatan');
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	function get_noreg()
	{
		$this->db->from('noreg');
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	function get_noreg_by_like($noreg)
	{
		$this->db->from('noreg');
		$this->db->like('noreg', $noreg, 'after');
		$this->db->where('status', 0);
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	function get_noreg_by_noreg($noreg)
	{
		$this->db->from('noreg');
		$this->db->where('noreg', $noreg);
		$this->db->where('status', 0);
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

	function get_max_noreg()
	{
		$this->db->select('max(noreg) as noreg');
		$this->db->from('noreg');
		$query = $this->db->get();
		$result = $query->row();

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

	function get_count_kalender()
	{
		$this->db->select('count(*) as count');
		$this->db->from('jadwal');
		$this->db->where('tanggal >= NOW()');
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

	function get_count_jabatan()
	{
		$this->db->select('count(*) as count');
		$this->db->from('jabatan');
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

	function get_count_noreg()
	{
		$this->db->select('count(*) as count');
		$this->db->from('noreg');
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

	function get_member_by_reg($reg)
	{
		$this->db->from('members');
		$this->db->where('register', $reg);
		$query = $this->db->get();
		$result = $query->row();

		return $result;
	}

	function hapus_jadwal($id_jadwal)
	{
		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->delete('jadwal');
	}

	function update_jadwal($params = array())
	{
		$this->db->where('id_jadwal', $params['id_jadwal']);
		$this->db->update('jadwal', $params);
	}

	function hapus_jabatan($id_jabatan)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$this->db->delete('jabatan');
	}

	function update_jabatan($params = array())
	{
		$this->db->where('id_jabatan', $params['id_jabatan']);
		$this->db->update('jabatan', $params);
	}

	function update_noreg($params = array())
	{
		$this->db->where('id_reg', $params['id_reg']);
		$this->db->update('noreg', $params);
	}

	function update_noreg_by_reg($params = array())
	{
		$this->db->where('noreg', $params['noreg']);
		$this->db->update('noreg', $params);
	}

}