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

	public function lupa_password()
	{
		$data = array(
			'title' => 'Lupa Password'
		);
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_lupa_password');
		$this->load->view('templates/home/footer');
	}

	public function konfirmasi_reset_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|callback_cek_email');
		if ($this->form_validation->run() == FALSE)
        {
        	$this->lupa_password();            
        }
        else
        {
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kode konfirmasi kami kirim ke email</div>');
        	redirect('members/lupa_password');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function cek_email($email)
	{
		$member = $this->members_model->get_member_by_email($email);
		if ($member == FALSE)
		{
			$this->form_validation->set_message('cek_password', 'Password Lama Salah');
			return FALSE;
		}
		else
		{
			$active_code = md5(mt_rand(0,99999999));
	    	$params = array(
	    		'active_code' => $active_code
	    	);
	    	$this->members_model->update_member($params);

	    	return TRUE;
	    }
	}
}
