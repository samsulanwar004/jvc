<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function index()
	{
		$data['title'] = "Pendaftaran";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_pendaftaran');
		$this->load->view('templates/home/footer');
	}

	public function daftar()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[members.email]');
		$this->form_validation->set_rules('namaDepan', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('jnsKelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tmpLahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tglLahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('noTelpon', 'Nomor Telepon', 'trim|required|min_length[11]|max_length[12]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('passwordUlang', 'Ulangi Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('persetujuan', 'Kebijakan dan Ketentuan', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = "Pendaftaran";
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_pendaftaran');
			$this->load->view('templates/home/footer');
        }
        else
        {
            $data['title'] = "Berhasil Mendaftar";
			$this->load->view('templates/home/header', $data);
			$this->load->view('view_sukses');
			$this->load->view('templates/home/footer');
        }
	}

}
