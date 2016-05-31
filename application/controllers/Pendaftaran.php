<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
		$this->load->model('notification_model');
	}

	public function index()
	{
		$data['title'] = "Pendaftaran";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_pendaftaran');
		$this->load->view('templates/home/footer');
	}

	public function daftar()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|is_unique[members.email]');
		$this->form_validation->set_rules('namaDepan', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('jnsKelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tmpLahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('blnLahir', 'Bulan Lahir', 'required');
		$this->form_validation->set_rules('thnLahir', 'Tahun Lahir', 'required');
		$this->form_validation->set_rules('noTelpon', 'Nomor Telepon', 'trim|required|min_length[11]|max_length[12]|is_unique[members.noTelpon]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('passwordUlang', 'Ulangi Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('persetujuan', 'Kebijakan dan Ketentuan', 'required');

        $email 			= $this->input->post('email');
        $namaDepan 		= $this->input->post('namaDepan');
        $namaBelakang 	= $this->input->post('namaBelakang');
        $jnsKelamin 	= $this->input->post('jnsKelamin');
        $tmpLahir 		= $this->input->post('tmpLahir');
        $tglLahir 		= $this->input->post('tglLahir');
        $blnLahir 		= $this->input->post('blnLahir');
        $thnLahir 		= $this->input->post('thnLahir');
        $noTelpon 		= $this->input->post('noTelpon');
        $alamat 		= $this->input->post('alamat');
        $password 		= $this->input->post('password');
        $passwordUlang 	= $this->input->post('passwordUlang');

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = "Pendaftaran";
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_pendaftaran');
			$this->load->view('templates/home/footer');
        }
        else
        {
        	$email 			= $this->input->post('email');
	        $namaDepan 		= $this->input->post('namaDepan');
	        $namaBelakang 	= $this->input->post('namaBelakang');
	        $jnsKelamin 	= $this->input->post('jnsKelamin');
	        $tmpLahir 		= $this->input->post('tmpLahir');
	        $tglLahir 		= $this->input->post('tglLahir');
	        $blnLahir 		= $this->input->post('blnLahir');
	        $thnLahir 		= $this->input->post('thnLahir');
	        $noTelpon 		= $this->input->post('noTelpon');
	        $alamat 		= $this->input->post('alamat');
	        $password 		= $this->input->post('password');
	        $active_code	= md5(mt_rand(0,99999999));
	        $idmember1		= date("ymd");
			$idmember2		= $this->members_model->get_idmember();
			$id_member 		= sprintf("%06d%04d",intval($idmember1),intval($idmember2['id']));

	        $params = array(
	        	'id_member'		=> $id_member,
	        	'email' 		=> $email,
	        	'password' 		=> md5($password),
	        	'nama' 			=> ucfirst($namaDepan).' '.ucfirst($namaBelakang),
	        	'jnsKelamin' 	=> $jnsKelamin,
	        	'tmpLahir' 		=> ucfirst($tmpLahir),
	        	'tglLahir' 		=> $thnLahir."-".$blnLahir."-".$tglLahir,
	        	'noTelpon' 		=> $noTelpon,
	        	'alamat' 		=> $alamat,
	        	'jabatan'		=> "Anggota",
	        	'status'		=> "0",
	        	'created_at'	=> date('Y-m-d H:i:s'),
	        	'active_code' 	=> $active_code
	        );	        
	        //var_dump($params);die();

	        //$this->members_model->simpan_member($params);
	        $this->notification_model->kirim_email_pendaftaran($params);

            $data['title'] = "Berhasil Mendaftar";
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_sukses');
			$this->load->view('templates/home/footer');
        }
	}

}
