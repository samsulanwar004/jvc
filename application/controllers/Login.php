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
		$session = $this->session->userdata('logged_in');
		if (isset($session)? $session : null)
		{
			$data = array(
				'title' => "Sudah Login",
				'content' => "Boskuh sudah login :)"
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
		else
		{
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback__cek_login');

			if ($this->form_validation->run() == FALSE)
			{	

				$data['title'] 		= "Gagal Login";
				$data['content'] 	= "Ayo Boskuh, coba di ingat - ingat ? :)";
				$this->load->view('templates/home/header', $data);
				$this->load->view('view_notif');
				$this->load->view('templates/home/footer');

			}
			else
			{
				$data['title'] 		= "Berhasil Login";
				$data['content'] 	= "Have Fun Boskuh :)";
				$this->load->view('templates/home/header', $data);
				$this->load->view('view_notif');
				$this->load->view('templates/home/footer');
			}
		}
	}

	public function admin()
	{
		$session = $this->session->userdata('logged_in_admin');
		if (isset($session)? $session : null)
		{
			redirect('admin/dashboard');
		}
		else
		{
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback__cek_login_admin');

			if ($this->form_validation->run() == FALSE)
			{	
				$data['title'] = "Admin JVC";
				$this->load->view('admin/view_login', $data);
			}
			else
			{
				redirect('admin/dashboard');
			}
		}

	}

	public function _cek_login($password)
	{
		$email = $this->input->post('email');
		$result = $this->login_model->login_member($email, $password);

		if ($result)
		{
			foreach ($result as $row) {
				$session = array(
					'id_member' => $row->id_member,
					'nama' 		=> $row->nama
				);
				$this->session->set_userdata('logged_in', $session);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('_cek_login', 'Email/Password salah');
			return FALSE;
		}
	}

	public function _cek_login_admin($password)
	{
		$email = $this->input->post('email');
		$result = $this->login_model->login_admin($email, $password);

		if ($result)
		{
			foreach ($result as $row) {
				$session = array(
					'id_member' => $row->id_member,
					'nama' 		=> $row->nama,
					'foto' 		=> $row->foto,
					'jabatan'	=> $row->jabatan,
					'register' 	=> $row->register
				);
				$this->session->set_userdata('logged_in_admin', $session);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('_cek_login_admin', 'Email/Password salah');
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

	public function logout_admin()
	{
		$this->session->unset_userdata('logged_in_admin');
		$this->session->sess_destroy();
		redirect('admin');
	}

}