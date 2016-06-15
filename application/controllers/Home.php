<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = "Home";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_home');
		$this->load->view('templates/home/footer');
	}

	public function sejarah()
	{
		$data['title'] = "Sejarah";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_sejarah');
		$this->load->view('templates/home/footer');
	}

	public function visi_misi()
	{
		$data['title'] = "Visi dan Misi";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_visi_misi');
		$this->load->view('templates/home/footer');
	}

	public function program()
	{
		$data['title'] = "Program";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_program');
		$this->load->view('templates/home/footer');
	}

	public function jadwal()
	{
		$data['title'] = "Jadwal";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_jadwal');
		$this->load->view('templates/home/footer');
	}

	public function blog()
	{
		$data['title'] = "Blog";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_blog');
		$this->load->view('templates/home/footer');
	}

	public function pengurus()
	{
		$data['title'] = "Pengurus";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_pengurus');
		$this->load->view('templates/home/footer');
	}

	public function sekretariat()
	{
		$data['title'] = "Sekretariat";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_sekretariat');
		$this->load->view('templates/home/footer');
	}

	public function kontak()
	{
		$data['title'] = "Kontak Kami";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_kontak');
		$this->load->view('templates/home/footer');
	}

	public function galery()
	{
		$data['title'] = "Galery";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_galery');
		$this->load->view('templates/home/footer');
	}

	public function tentang()
	{
		$data['title'] = "Tentang Kami";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_tentang');
		$this->load->view('templates/home/footer');
	}

	public function download()
	{
		$data['title'] = "Download";
		$this->load->view('templates/home/header', $data);
		$this->load->view('view_download');
		$this->load->view('templates/home/footer');
	}

}
