<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
	}

	public function index()
	{
		$session = $this->session->userdata('logged_in');
		if (isset($session)? $session : null)
		{
			$member 	= $this->members_model->get_member($session['id_member']);

			$data = array(
				'title'	=> "Profil",
				'id'	=> $member->id_member,
				'email' => $member->email,
				'nama' 	=> $member->nama,
				'ttl'	=> $member->tmpLahir.', '.nice_date($member->tglLahir, 'd-m-Y'),
				'gender'=> $member->jnsKelamin,
				'alamat'=> $member->alamat,
				'nohp'	=> $member->noTelpon,
				'jbtn'	=> $member->jabatan,
				'reg'	=> $member->register
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_profil');
			$this->load->view('templates/home/footer');
		}
		else
		{
			$data = array(
				'title' => "Belum Login",
				'content' => "Silahkan Boskuh login dulu jika mengakses halaman ini!"
			);
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_notif');
			$this->load->view('templates/home/footer');
		}
		
	}

	public function edit()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('namaDepan', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('noTelpon', 'Nomor Telepon', 'trim|required|min_length[11]|max_length[12]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]|max_length[50]');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->index();
        }
        else
        {
        	$idMember 	= $this->input->post('idMember');
        	$email 		= $this->input->post('email');
        	$namaDepan 	= $this->input->post('namaDepan');
        	$namaBlkng 	= $this->input->post('namaBelakang');
        	$noTelpon 	= $this->input->post('noTelpon');
        	$alamat 	= $this->input->post('alamat');

        	$params = array(
        		'id_member' => $idMember,
        		'email' 	=> $email,
        		'nama' 		=> $namaDepan.' '.$namaBlkng,
        		'noTelpon' 	=> $noTelpon,
        		'alamat' 	=> $alamat
        	);
        	
        	$this->members_model->update_member($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil Update Profil</div>');
        	$this->index();
        }	
	}

	public function ganti_password()
	{
		$this->form_validation->set_rules('passwordLama', 'Password Lama', 'trim|required|callback_cek_password');
		$this->form_validation->set_rules('passwordBaru', 'Password Baru', 'trim|required|min_length[6]|max_length[12]');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->unset_userdata('success_msg');
        	$this->index();
        }
        else
        {
        	$id_member		= $this->input->post('idMember');
        	$passwordBaru 	= $this->input->post('passwordBaru');
        	$params = array(
        		'id_member'	=> $id_member,
        		'password' 	=> md5($passwordBaru)
        	);
        	$this->members_model->update_member($params);
        	$this->session->set_flashdata('success_msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berhasil Update Password</div>');
        	$this->index();
        }
	}

	public function cek_password($password)
	{
		$id_member = $this->input->post('idMember');
		$result = $this->members_model->get_member($id_member);

		if ($result->password === md5($password))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('cek_password', 'Password Lama Salah');
			return FALSE;
		}
	}
}