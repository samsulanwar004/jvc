<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function member()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_cek_login');

		if ($this->form_validation->run() == FALSE)
		{	

			$data['title'] = "Gagal Login";
			$data['content'] 	= "Ayo Boskuh, coba di ingat - ingat ? :)";
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');

		}
		else
		{
			$data['title'] = "Berhasil Login";
			$data['content'] 	= "Have Fun Boskuh :)";
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
	}

	public function cek_login($password)
	{
		$email = $this->input->post('email');
		$result = $this->login_model->login_member($email, $password);

		if ($result)
		{
			foreach ($result as $row) {
				$session = array(
					'id_member' => $row->id_member,
					'nama' => $row->nama
				);
				$this->session->set_userdata('logged_in', $session);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('cek_login', 'Email/Password salah');
			return FALSE;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();

		$data['title'] 		= "Berhasil Logout";
		$data['content'] 	= "Kembali lagi nanti ya Boskuh :)";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_notif');
		$this->load->view('templates/home/footer');
}
}