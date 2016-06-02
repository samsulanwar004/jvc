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
		$session 	= $this->session->userdata('logged_in');
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
}