<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
	}

	public function aktif($id, $code)
	{
		$member = $this->members_model->get_member($id);
		if ($member->active_code === $code)
		{
			$params = array(
				'id_member' => $id,
				'status' 	=> 1
			);
			$this->members_model->update_member($params);
			$data = array(
				'title' => 'Aktifasi Akun',
				'content' => 'Aktifasi Berhasil'
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
		else
		{
			$data = array(
				'title' => 'Aktifasi Akun',
				'content' => 'Aktifasi Gagal'
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
	}
}
