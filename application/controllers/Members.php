<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
		$this->load->model('notification_model');
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

	public function reset($id, $code)
	{
		$member = $this->members_model->get_member($id);
		if ($member->active_code === $code)
		{
			$password = $this->members_model->random_password();

			$params = array(
				'id_member' => $id,
				'password' 	=> md5($password)
			);
			$params2 = array(
				'email' => $member->email,
				'password' => $password
			);
			$this->members_model->update_member($params);
			$this->notification_model->kirim_password($params2);
			$data = array(
				'title' => 'Reset Password',
				'content' => 'Reset Password Berhasil di kirim ke email '.$member->email
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
		else
		{
			$data = array(
				'title' => 'Reset Password',
				'content' => 'Reset Password Gagal'
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
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|callback__cek_email');
		$email = $this->input->post('email');
		if ($this->form_validation->run() == FALSE)
        {
        	$this->lupa_password();            
        }
        else
        {
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kode konfirmasi kami kirim ke email '.$email.'</div>');
        	redirect('members/lupa_password');
        	$this->session->unset_userdata('success_msg');
        }
	}

	public function _cek_email($email)
	{
		$member = $this->members_model->get_member_by_email($email);
		if ($member == FALSE)
		{
			$this->form_validation->set_message('cek_email', 'Email belum pernah terdaftar');
			return FALSE;
		}
		else
		{
			$active_code = md5(mt_rand(0,99999999));
	    	$params = array(
	    		'id_member'		=> $member->id_member,
	    		'email'			=> $email,
	    		'active_code' 	=> $active_code
	    	);
	    	$this->members_model->update_member($params);
	    	$this->notification_model->konfirmasi_reset_password($params);
	    	return TRUE;
	    }
	}
}
