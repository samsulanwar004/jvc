<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function login_member($email, $password)
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$this->db->where('status', 1);
		$this->db->or_where('status', 2);
		$this->db->limit(1);

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	function login_admin($email, $password)
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$this->db->where('status', 2);
		$this->db->limit(1);

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

}